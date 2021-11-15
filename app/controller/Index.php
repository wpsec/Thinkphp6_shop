<?php
namespace app\controller;

use app\BaseController;
use think\facade\Db;
use think\facade\View;
use think\facade\Request;

class Index extends BaseController
{
    public function index()
    {
        $title = '煌煌商城';
        $login = '惶惶';
        $left = Db::table('shop_menu')
            ->where('fid',0)
            ->select();
        $left = $left->toArray();
        foreach($left as &$left_v){
            $left_v['lists'] = Db::table('shop_menu')
                ->where('fid',$left_v['id'])
                ->select();
        }
        $right = Db::table('shop_goods')->select();
        $right = $right->toArray();
        foreach($right as &$right_v){
            $right_v['cat'] = Db::table('shop_cat')
                ->where('id',$right_v['cat'])
                ->value('name');
        }
        View::assign([
            'title' => $title,
            'login' => $login,
            'left' => $left,
            'right' => $right
        ]);
        return View::fetch();
    }

    public function edit(){
        if (Request::method() == "GET") {
            $id = Request::param('id');
            $shop = Db::table('shop_goods')
                ->where('id', $id)
                ->find();
            $cat = Db::table('shop_cat')
                ->where('status', 1)
                ->select();
            View::assign([
                'shop' => $shop,
                'cat' => $cat
            ]);
            return View::fetch();
        } elseif (Request::method() == "POST") {
            $all = Request::param();
            $update = Db::table('shop_goods')
                ->where('id', $all['id'])
                ->update($all);
            if ($update) {
                echo json_encode(['code' => 0, 'msg' => '修改成功']);
            } else {
                echo json_encode(['code' => 1, 'msg' => '修改失败']);
            }
        } else {
            echo json_encode(['code' => 1, 'msg' => '操作错误']);
        }
//        return View::fetch();
    }
    public function add(){
        if (Request::method() == "POST"){
            $all = Request::param();
            $all['add_time'] = time();
            $install = Db::table('shop_goods')
                ->insert($all);
            if ($install){
                echo json_encode(['code' => 0, 'msg' => '添加成功']);
            }else{
                echo json_encode(['code' => 1,'msg' => '添加失败']);
            }
        }elseif(Request::method() == "GET"){
            $cat = Db::table('shop_cat')
                ->where('status',1)
                ->select();
            View::assign(['cat' => $cat]);
            return View::fetch();
        }else{
            echo "操作错误";
        }
    }
    public function del(){
        if (Request::method() == "POST"){
            $id = Request::param('id');
            $delete = Db::table('shop_goods')
                ->where('id',$id)
                ->delete();
            if ($delete){
                echo json_encode(['code' => 0, 'msg' => '删除成功']);
            }else{
                echo json_encode(['code' => 1, 'msg' => '删除失败']);
            }
        }else{
            echo json_encode(['code' => 1, 'msg' => '操作错误']);
        }
    }
}
