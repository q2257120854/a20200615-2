<?php
if (!defined('IN_CRONLITE')) exit();

class Price
{
    private        $zid;
    private        $upzid;
    private        $power;
    private        $user;
    private        $price_array    = array();
    private        $up_price_array = array();
    private        $iprice_array   = array();
    private        $tool           = array();
    private static $price_rules;

    public function __construct($zid, $siterow = null)
    {
        global $DB;
        if ($zid == 1) return;
        if (!$siterow) $siterow = $this->getSiteInfo($zid);
        $this->endtime = $siterow['endtime'];
        if ($siterow['power'] == 2) {// 专业版
            $this->zid          = $zid;
            $this->power        = $siterow['power'];
            $this->price_array  = @unserialize($siterow['price']);
            $this->iprice_array = isset($siterow['iprice']) ? @unserialize($siterow['iprice']) : [];
        } elseif ($siterow['power'] == 1) { // 普及版
            $this->zid          = $zid;
            $this->power        = $siterow['power'];
            $this->price_array  = @unserialize($siterow['price']);
            $this->iprice_array = isset($siterow['iprice']) ? @unserialize($siterow['iprice']) : [];

            $data = $DB->get('site', ['zid', 'price'], [
                'AND' => [
                    'zid'   => $siterow['upzid'],
                    'power' => 2
                ]
            ]);

            if (!empty($data)) {
                $this->up_price_array = @unserialize($data['price']);
                $this->upzid          = $data['zid'];
            }
        } elseif ($siterow['power'] == 0) {
            $this->user = true;

            try {
                $data = $DB->get('site', ['zid', 'upzid', 'power', 'price', 'iprice'], ['zid' => $siterow['upzid']]);
                if (empty($data))
                    throw  new Exception('查无站点');
            } catch (Exception $exception) {
                $data = $DB->get('site', ['zid', 'upzid', 'power', 'price'], ['zid' => $siterow['upzid']]);
            }
            if (!empty($data)) {
                $this->zid          = $data['zid'];
                $this->power        = $data['power'];
                $this->price_array  = @unserialize($data['price']);
                $this->iprice_array = isset($data['iprice']) ? @unserialize($data['iprice']) : [];

                if ($this->power == 1 && $data['upzid'] > 1 && $data = $DB->get('site', ['zid', 'price'], ['AND' => ['zid' => $data['upzid'], 'power' => 2]])) {
                    $this->up_price_array = @unserialize($data['price']);
                    $this->upzid          = $data['zid'];
                }
            }
        }
    }

    public function setToolInfo($tid, $row = null)
    {
        global $DB;
        if (!$row)
            $row = $this->getToolInfo($tid);
        if ($row['prid'] == 0) {
            //不加价
        } else if ($price_rules = $this->getPriceRules($row['prid'])) {
            //应用加价模板
            $price        = $row['price'];
            $row['price'] = round($price_rules['kind'] == 1 ? $price + $price_rules['p_0'] : $price * $price_rules['p_0'], 2);
            $row['cost']  = round($price_rules['kind'] == 1 ? $price + $price_rules['p_1'] : $price * $price_rules['p_1'], 2);
            $row['cost2'] = round($price_rules['kind'] == 1 ? $price + $price_rules['p_2'] : $price * $price_rules['p_2'], 2);
        } else { //对应加价模板被删除
            $row['cost']  = $row['price'];
            $row['cost2'] = $row['price'];
        }
        //应用自定义密价
        if ($this->power == 1 && $this->iprice_array[$tid] > 0) {
            $row['cost'] = $this->iprice_array[$tid];
        } else if ($this->power == 2 && $this->iprice_array[$tid] > 0) {
            $row['cost2'] = $this->iprice_array[$tid];
        }
        $this->tool = $row;
    }

    public function getToolPrice($tid, $userID = 0)
    {
        global $islogin2, $conf, $date, $DB;

        if (!empty($userID) && strlen($userID) != 32) {
            $userPower = $DB->get('site', 'power', ['zid' => $userID]);
            if (!empty($userPower)) {
                if ($userPower == 1) {
                    return $this->getToolCost($tid);
                } else if ($userPower == 2) {
                    return $this->getToolCost2($tid);
                }
            }
        } else if ($islogin2 == 1) {
            if ($this->user == true && $conf['user_level'] == 1) {
                return $this->getToolCost($tid);
            } else if ($this->user == true || $conf['fenzhan_expiry'] > 0 && $this->endtime < $date) {

            } else if ($this->power == 1) {
                return $this->getToolCost($tid);
            } elseif ($this->power == 2) {
                return $this->getToolCost2($tid);
            }
        }
        $cost = $this->getToolCost($tid);
        if ($this->price_array[$tid]['price'] && $this->price_array[$tid]['price'] >= $cost && $cost > 0) {
            $price = $this->price_array[$tid]['price'];
        } elseif ($this->up_price_array[$tid]['price'] && $this->up_price_array[$tid]['price'] >= $cost && $cost > 0) {
            $price = $this->up_price_array[$tid]['price'];
        } elseif ($cost > 0 && $cost > $this->tool['price']) {
            $price = $cost;
        } else {
            $price = $this->tool['price'];
        }
        return $price;
    }

    /**
     * 获取商品价格
     * @param $tid //商品ID
     * @return mixed
     */
    public function getToolCost($tid)
    {
        $cost2 = $this->getToolCost2($tid);
        if ($this->power < 2 && $this->up_price_array[$tid]['cost'] && $this->up_price_array[$tid]['cost'] >= $cost2) {
            $cost = $this->up_price_array[$tid]['cost'];
        } else if ($this->power == 2 && $this->price_array[$tid]['cost'] && $this->price_array[$tid]['cost'] >= $cost2) {
            $cost = $this->price_array[$tid]['cost'];
        } elseif ($this->tool['cost'] > 0) {
            $cost = $this->tool['cost'];
            //疑似没有使用加价模板
        } else {
            $cost = $this->tool['price'];
        }
        return $cost;
    }

    public function getToolCost2($tid)
    {
        if ($this->tool['cost2'] > 0) {
            $cost = $this->tool['cost2'];
        } elseif ($this->tool['cost'] > 0) {
            $cost = $this->tool['cost'];
        } else {
            $cost = $this->tool['price'];
        }
        return $cost;
    }

    public function getToolDel($tid)
    {
        return $this->price_array[$tid]['del'];
    }

    public function getFinalPrice($price, $num)
    {
        if (!empty($this->tool['prices'])) {
            $prices = explode(',', $this->tool['prices']);
            foreach ($prices as $item) {
                $arrs = explode('|', $item);
                if ($num >= $arrs[0]) $discount = $arrs[1];
            }
            $price -= $discount;
            if ($price <= 0) return false;
        }
        return $price;
    }

    public function getTooliPrice($tid)
    {
        if ($this->power > 0 && $this->iprice_array[$tid] > 0) {
            return $this->iprice_array[$tid];
        } else {
            return null;
        }
    }

    public function setToolProfit($tid, $num, $name, $money, $orderid, $userid = 0)
    {
        global $DB, $islogin2;
        if ($userid == $this->zid)
            $islogin2 = 1;
        $toolPrice = $this->getFinalPrice($this->getToolPrice($tid, $userid), $num);
        if (round($toolPrice * $num, 2) != round($money, 2))
            return false;
        //0.05 0.0.2
        if ($this->power == 2) {
            $profit = $toolPrice - $this->getToolCost2($tid);
            if ($profit > 0 && $profit < $money) {
                $tc_point = round($profit * $num, 2);
                $rs       = $DB->update('site', [
                    'rmb[+]' => $tc_point
                ], [
                    'zid' => $this->zid
                ]);
                $this->addPointRecord($this->zid, $tc_point, '提成', '你网站用户下单 ' . $name . ' 获得' . $tc_point . '元提成 (' . $orderid . ')', $orderid);
            }
        } else if ($this->power == 1) {
            $profit = $toolPrice - $this->getToolCost($tid);
            if ($profit > 0 && $profit < $money) {
                $tc_point = round($profit * $num, 2);
                $rs       = $DB->update('site', [
                    'rmb[+]' => $tc_point
                ], [
                    'zid' => $this->zid
                ]);
                $this->addPointRecord($this->zid, $tc_point, '提成', '你网站用户下单 ' . $name . ' 获得' . $tc_point . '元提成 (' . $orderid . ')', $orderid);
            }

            $profit2 = $this->getToolCost($tid) - $this->getToolCost2($tid);
            //default price

            if ($this->upzid != 0) {
                $upSiteInfo = $this->getSiteInfo($this->upzid);
                if (!empty($upSiteInfo['iprice'])) {
                    $iPrice = @unserialize($upSiteInfo['iprice']);
                    if (!empty($iPrice[$tid])) {
                        $profit2 = $this->getToolCost($tid) - $iPrice[$tid];
                    }
                }
            }
            //如果是存在密价

            if ($profit2 > 0 && $profit2 < $money && $this->upzid > 1) {
                $tc_point = round($profit2 * $num, 2);
                $rs       = $DB->update('site', [
                    'rmb[+]' => $tc_point
                ], [
                    'zid' => $this->upzid
                ]);
                $this->addPointRecord($this->upzid, $tc_point, '提成', '你下级网站(ZID:' . $this->zid . ')用户下单 ' . $name . ' 获得' . $tc_point . '元提成 (' . $orderid . ')', $orderid);
            }
        }

        if (!empty($rs)) {
            return $rs->rowCount() > 0 ? true : false;
        }
        return false;
    }

    public function setPriceInfo($tid, $del, $price, $cost = 0)
    {
        global $DB;
        $this->price_array[$tid] = array();
        if ($price != $this->tool['price'] || $cost > 0 && $cost != $this->tool['cost'] || $del != $this->price_array[$tid]['del']) {
            $this->price_array[$tid]['price'] = $price;
            if ($this->power == 2) $this->price_array[$tid]['cost'] = $cost;
            $this->price_array[$tid]['del'] = $del;
        }
        $price_data = serialize($this->price_array);
        return $DB->update('site', ['price' => $price_data], ['zid' => $this->zid])->rowCount() > 0 ? true : false;
    }

    public function setiPriceInfo($tid, $price)
    {
        global $DB;
        if ($price == 0) {
            unset($this->iprice_array[$tid]);
        } else {
            $this->iprice_array[$tid] = $price;
        }
        $iprice_data = serialize($this->iprice_array);

        return $DB->update('site', ['iprice' => $iprice_data], ['zid' => $this->zid])->rowCount() > 0 ? true : false;
    }

    public function getPower()
    {
        return $this->power;
    }

    private function addPointRecord($zid, $point = 0, $action = '提成', $bz = null, $orderid = '')
    {
        global $DB, $date;
        $DB->insert('points', [
            'zid'     => $zid,
            'action'  => $action,
            'point'   => $point,
            'bz'      => $bz,
            'addtime' => $date,
            'orderid' => $orderid
        ]);
    }

    private function getSiteInfo($zid)
    {
        global $DB;

        try {
            $result = $DB->get('site', ['zid', 'upzid', 'power', 'price', 'endtime', 'iprice'], ['zid' => $zid]);
            if (empty($result))
                throw new Exception('查无分站');
        } catch (Exception $exception) {
            $result = $DB->get('site', ['zid', 'upzid', 'power', 'price', 'endtime'], ['zid' => $zid]);
        }

        return $result;
    }

    private function getToolInfo($tid)
    {
        global $DB;
        return $DB->get('tools', '*', ['tid' => $tid]);
    }

    /**
     * 获取加价模板规则
     * @param $id //模板ID
     * @return array|null
     */
    private function getPriceRules($id)
    {
        global $DB;

        if (empty($id))
            return null;
        //加价模板不能为空
        $priceTemplate = $DB->get('price', ['kind', 'p_2', 'p_1', 'p_0'], ['id' => $id]);

        if (empty($priceTemplate))
            return null;
        return $priceTemplate;
        //        global $CACHE;
//        if (self::$price_rules)
//            return self::$price_rules[$id];
//        $price_rules = unserialize($CACHE->read('pricerules'));
//        if (!$price_rules) {
//            $this->updatePriceRules();
//            $this->updatePriceRules();
//        } else {
//            self::$price_rules = $price_rules;
//        }
//        return self::$price_rules[$id];
    }

    private function updatePriceRules()
    {
        global $DB, $CACHE;
        $array = array();
        $rs    = $DB->select('price', '*', [
            'ORDER' => [
                'id' => 'ASC'
            ]
        ]);
        foreach ($rs as $content) {
            $array[$content['id']] = [
                'kind' => $content['kind'],
                'p_2'  => $content['p_2'],
                'p_1'  => $content['p_1'],
                'p_0'  => $content['p_0']
            ];
        }
        $CACHE->save('pricerules', $array);
        self::$price_rules = $array;
    }
}
