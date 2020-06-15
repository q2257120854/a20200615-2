<?php

/**
 * 分页类，以组件形式存在
 * 13-5-15 下午8:26 
 */
class Pagination {
    private $total; //数据表中总记录数
    private $listRows; //每页显示行数
    private $limit;
    private $uri;
    private $pageNum; //页数
    private $config = array("prev" => "上一页", "next" => "下一页");
    private $listNum = 8;

    /*
     * $total 
     * $listRows
     */

    public function __construct($total, $listRows = 10,$pa) {
        $this->total = $total;
        $this->listRows = $listRows;
        $this->uri = $this->getUri($pa);
        $this->page = !empty($_GET["page"]) ? $_GET["page"] : 1;
        $this->pageNum = ceil($this->total / $this->listRows);
        $this->limit = $this->setLimit();
    }

    private function setLimit() {
        return "Limit " . ($this->page - 1) * $this->listRows . ", {$this->listRows}";
    }

    private function getUri($pa) {
        return SITE_URL.$pa;
    }

    function __get($args) {
        if ($args == "limit")
            return $this->limit;
        else
            return null;
    }

    private function prev() {
        if ($this->page == 1)
            $html.='';
        else
            $html.="<a href='{$this->uri}/page/" . ($this->page - 1) . "' class='sy'><i><&nbsp;</i>{$this->config["prev"]}</a>";
        return $html;
    }

    private function next() {
        if ($this->page == $this->pageNum)
            $html.='';
        else
            $html.="<a href='{$this->uri}/page/" . ($this->page + 1) . "' class='xy'>{$this->config["next"]}<i>&nbsp;></i></a>";
            
           
        return $html;
    }

    function fpage($display = array(0, 1)) {
        $html[0] = $this->prev();
        $html[1] = $this->next();
        $fpage = '';
        foreach ($display as $index) {
          
            $fpage.=$html[$index];
        }
        return $fpage;
    }

}
