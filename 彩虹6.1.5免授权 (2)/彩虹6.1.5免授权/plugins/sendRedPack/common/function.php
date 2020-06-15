<?php
/* 插件自定义函数库 */

// 红包随机金额计算
/**
 * 红包随机金额计算
 * @param $total float 红包总额
 * @param $num int 分成几个红包，支持随机领取
 * @param $min float 每个人最少能收到多少元
 * @return array 随机后每个人的金额
 */
function red_packet_compute($total, $num, $min)
{
    $data = $money = [];
    for ($i = 0; $i < $num; $i++) {
        $data[$i] = mt_rand($min, $total);
    }
    $sum = array_sum($data);
    $last = $num - 1;
    for ($k = 0; $k < $last; $k++) { //0~8
        $money[$k] = round(($data[$k] / $sum) * $total, 2);
    }
    $money[$last] = $total - array_sum($money);
    return $money;
}