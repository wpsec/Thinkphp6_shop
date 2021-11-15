<?php

namespace app\controller;
use think\facade\Db;
use app\model\Goods;
class Test
{
    public function test(){
        $info = new Goods();
        $index = $info->getsql();
        print_r($index);

    }

}