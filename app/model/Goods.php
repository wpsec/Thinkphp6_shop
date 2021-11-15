<?php
namespace app\model;
use think\Model;

class Goods extends Model{
    public function getsql(){
        $find = Goods::find(1);
        $find = Goods::where('id',1)
            ->find();
//        return $find;
        return $find->toArray();
    }
}