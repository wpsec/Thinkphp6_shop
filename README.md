ThinkPHP 6.0
===============

> 运行环境要求PHP7.1+。

## 主要新特性

* 采用`PHP7`强类型（严格模式）
* 支持更多的`PSR`规范
* 原生多应用支持
* 更强大和易用的查询
* 全新的事件系统
* 模型事件和数据库事件统一纳入事件系统
* 模板引擎分离出核心
* 内部功能中间件化
* SESSION/Cookie机制改进
* 对Swoole以及协程支持改进
* 对IDE更加友好
* 统一和精简大量用法


## 一个基于TP6的 单应用 学习项目 笔记




## 一. 下载资源文件
使用 layui ，下载并放 public 下资源目录下

![在这里插入图片描述](https://img-blog.csdnimg.cn/23dec215ebaf45af890a299c5316f15f.png#pic_center)


## 二. 模板变量应用
根据控制器修改模板变量
### 2.1 控制器文件
```php
<?php
namespace app\controller;

use app\BaseController;
use think\facade\Db;
use think\facade\View;

class Index extends BaseController
{
    public function index()
    {
        $title = '商城';
        $login = '欧阳克';
        $left = [
            [
                'title' => '商品管理',
                'lists' => [
                    [
                        'id' => 1,
                        'title' => '商品列表',
                    ],
                    [
                        'id' => 2,
                        'title' => '商品分类',
                    ]
                ]
            ],
            [
                'title' => '用户管理',
                'lists' => [
                    [
                        'id' => 3,
                        'title' => '用户列表',
                    ],
                    [
                        'id' => 4,
                        'title' => '购物车',
                    ],
                    [
                        'id' => 5,
                        'title' => '用户地址',
                    ],
                    [
                        'id' => 6,
                        'title' => '订单管理',
                    ]
                ]
            ],
            [
                'title' => '后台管理',
                'lists' => [
                    [
                        'id' => 7,
                        'title' => '管理员列表',
                    ],
                    [
                        'id' => 8,
                        'title' => '个人中心',
                    ],
                    [
                        'id' => 9,
                        'title' => '左侧菜单列',
                    ]
                ]
            ]
        ];
        $right = [
            [
                'id' => 1,
                'title' => '熙世界2019秋冬新款长袖杏色上衣连帽宽松刺绣文艺落肩袖加厚卫衣BF风',
                'cat' => '女装',
                'price' => 189,
                'discount' => 6,
                'status' => 1,
                // 'status' => '开启',
                'add_time' => '2019-12-12',
                // 'add_time' => '1576080000'
            ],
            [
                'id' => 2,
                'title' => '秋水伊人双面呢冬装2019年新款女装气质西装领撞色羊毛大衣外套女',
                'cat' => '女装',
                'price' => 699,
                'discount' => 7,
                'status' => 1,
                // 'status' => '开启',
                'add_time' => '2019-12-12',
                // 'add_time' => '1576080000'
            ],
            [
                'id' => 3,
                'title' => '微弹中高腰直脚牛仔裤男',
                'cat' => '男装',
                'price' => 179,
                'discount' => 8,
                'status' => 2,
                // 'status' => '关闭',
                'add_time' => '2019-12-12',
                // 'add_time' => '1576080000'
            ],
            [
                'id' => 1,
                'title' => '男士长袖t恤秋季圆领黑白体恤T 纯色上衣服打底衫',
                'cat' => '男装',
                'price' => 99,
                'discount' => 9,
                'status' => 1,
                // 'status' => '开启',
                'add_time' => '2019-12-12',
                // 'add_time' => '1576080000'
            ],
        ];
        View::assign([
            'title'  => $title,
            'login' => $login,
            'left' => $left,
            'right' => $right
        ]);
        return View::fetch();
    }
    
}

```

### 2.2 视图模板
```html
<!DOCTYPE html>
<html>
<head>
    <title>列表页</title>
    <link rel="stylesheet" type="text/css" href="layui/css/layui.css">
    <script type="text/javascript" src="layui/layui.js"></script>
    <style type="text/css">
        .header{width:100%;height: 50px;line-height: 50px;background: #2e6da4;color:#ffffff;}
        .title{margin-left: 20px;font-size: 20px;}
        .userinfo{float: right;margin-right: 10px;}
        .userinfo a{color:#ffffff;}
        .menu{width: 200px;background:#333744;position:absolute;}
        .main{position: absolute;left:200px;right:0px;}

        .layui-collapse{border: none;}
        .layui-colla-item{border-top:none;}
        .layui-colla-title{background:#42485b;color:#ffffff;}
        .layui-colla-content{border-top:none;padding:0px;}

        .content span{background: #009688;margin-left: 30px;padding: 10px;color:#ffffff;}
        .content div{border-bottom: solid 2px #009688;margin-top: 8px;}
        .content button{float: right;margin-top: -5px;}
    </style>
</head>
<body>
    <div class="header">
        <span class="title"><span style="font-size: 20px;">XXX</span>--后台管理系统</span>
        <span class="userinfo">【欧阳克】<span><a href="javascript:;">退出</a></span></span>
    </div>
    <div class="menu" id="menu">
        <div class="layui-collapse" lay-accordion>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">商城管理</h2>
                <div class="layui-colla-content layui-show">
                    <ul class="layui-nav layui-nav-tree" lay-filter="test">
                        <li class="layui-nav-item"><a href="list.html">商品列表</a></li>
                        <li class="layui-nav-item"><a href="list.html">商品列表</a></li>
                        <li class="layui-nav-item"><a href="list.html">商品列表</a></li>
                        <li class="layui-nav-item"><a href="list.html">商品列表</a></li>
                    </ul>
                </div>
            </div>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">商城管理</h2>
                <div class="layui-colla-content">
                    <ul class="layui-nav layui-nav-tree" lay-filter="test">
                        <li class="layui-nav-item"><a href="list.html">商品列表</a></li>
                        <li class="layui-nav-item"><a href="list.html">商品列表</a></li>
                        <li class="layui-nav-item"><a href="list.html">商品列表</a></li>
                        <li class="layui-nav-item"><a href="list.html">商品列表</a></li>
                    </ul>
                </div>
            </div>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">商城管理</h2>
                <div class="layui-colla-content">
                    <ul class="layui-nav layui-nav-tree" lay-filter="test">
                        <li class="layui-nav-item"><a href="list.html">商品列表</a></li>
                        <li class="layui-nav-item"><a href="list.html">商品列表</a></li>
                        <li class="layui-nav-item"><a href="list.html">商品列表</a></li>
                        <li class="layui-nav-item"><a href="list.html">商品列表</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="main" style="padding:10px;">
        <div class="content">
            <span>商品列表</span>
            <div></div>
        </div>
        <table class="layui-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>商品标题</th>
                    <th>分类</th>
                    <th>价格</th>
                    <th>状态</th>
                    <th>添加时间</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>熙世界2019秋冬新款长袖杏色上衣连帽宽松刺绣文艺落肩袖加厚卫衣BF风</td>
                    <td>女装</td>
                    <td>189</td>
                    <td>开启</td>
                    <td>2019-12-12</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>秋水伊人双面呢冬装2019年新款女装气质西装领撞色羊毛大衣外套女</td>
                    <td>女装</td>
                    <td>699</td>
                    <td>开启</td>
                    <td>2019-12-12</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>秋水伊人双面呢冬装2019年新款女装气质西装领撞色羊毛大衣外套女</td>
                    <td>女装</td>
                    <td>699</td>
                    <td>开启</td>
                    <td>2019-12-12</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>秋水伊人双面呢冬装2019年新款女装气质西装领撞色羊毛大衣外套女</td>
                    <td>女装</td>
                    <td>699</td>
                    <td>开启</td>
                    <td>2019-12-12</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>秋水伊人双面呢冬装2019年新款女装气质西装领撞色羊毛大衣外套女</td>
                    <td>女装</td>
                    <td>699</td>
                    <td>关闭</td>
                    <td>2019-12-12</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>秋水伊人双面呢冬装2019年新款女装气质西装领撞色羊毛大衣外套女</td>
                    <td>女装</td>
                    <td>699</td>
                    <td>开启</td>
                    <td>2019-12-12</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
<script>
    layui.use(['element','layer','laypage'], function(){
        var element = layui.element;
        var laypage = layui.laypage;
        $ = layui.jquery;
        layer = layui.layer;
        resetMenuHeight();
    });
    // 重新设置菜单容器高度
    function resetMenuHeight(){
        var height = document.documentElement.clientHeight - 50;
        $('#menu').height(height);
    }
</script>
```

### 2.3 修改后的视图文件
根据控制器的样式修改视图模板
左侧商品管理

![在这里插入图片描述](https://img-blog.csdnimg.cn/e224dfc285764aa2bbe2ac9e9f1e17ca.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)


修改右侧商品列表

```html
<!DOCTYPE html>
<html>
<head>
    <title>列表页</title>
    <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css">
    <script type="text/javascript" src="/static/layui/layui.js"></script>
    <style type="text/css">
        .header{width:100%;height: 50px;line-height: 50px;background: #2e6da4;color:#ffffff;}
        .title{margin-left: 20px;font-size: 20px;}
        .userinfo{float: right;margin-right: 10px;}
        .userinfo a{color:#ffffff;}
        .menu{width: 200px;background:#333744;position:absolute;}
        .main{position: absolute;left:200px;right:0px;}

        .layui-collapse{border: none;}
        .layui-colla-item{border-top:none;}
        .layui-colla-title{background:#42485b;color:#ffffff;}
        .layui-colla-content{border-top:none;padding:0px;}

        .content span{background: #009688;margin-left: 30px;padding: 10px;color:#ffffff;}
        .content div{border-bottom: solid 2px #009688;margin-top: 8px;}
        .content button{float: right;margin-top: -5px;}
    </style>
</head>
<body>
<div class="header">
    <span class="title"><span style="font-size: 20px;">{$title}</span>--后台管理系统</span>
    <span class="userinfo">【{$login}】<span><a href="javascript:;">退出</a></span></span>
</div>
<div class="menu" id="menu">
    <div class="layui-collapse" lay-accordion>
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">{$left[0]['title']}</h2>
            <div class="layui-colla-content layui-show">
                <ul class="layui-nav layui-nav-tree" lay-filter="test">
                    <li class="layui-nav-item"><a href="list.html">{$left[0]['lists'][0]['title']}</a></li>
                    <li class="layui-nav-item"><a href="list.html">{$left[0]['lists'][1]['title']}</a></li>
                </ul>
            </div>
        </div>
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">{$left[1]['title']}</h2>
            <div class="layui-colla-content">
                <ul class="layui-nav layui-nav-tree" lay-filter="test">
                    <li class="layui-nav-item"><a href="list.html">{$left[1]['lists'][0]['title']}</a></li>
                    <li class="layui-nav-item"><a href="list.html">{$left[1]['lists'][1]['title']}</a></li>
                    <li class="layui-nav-item"><a href="list.html">{$left[1]['lists'][2]['title']}</a></li>
                    <li class="layui-nav-item"><a href="list.html">{$left[1]['lists'][3]['title']}</a></li>
                </ul>
            </div>
        </div>
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">{$left[2]['title']}</h2>
            <div class="layui-colla-content">
                <ul class="layui-nav layui-nav-tree" lay-filter="test">
                    <li class="layui-nav-item"><a href="list.html">{$left[2]['lists'][0]['title']}</a></li>
                    <li class="layui-nav-item"><a href="list.html">{$left[2]['lists'][1]['title']}</a></li>
                    <li class="layui-nav-item"><a href="list.html">{$left[2]['lists'][2]['title']}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="main" style="padding:10px;">
    <div class="content">
        <span>商品列表</span>
        <div></div>
    </div>
    <table class="layui-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>商品标题</th>
            <th>分类</th>
            <th>价格</th>
            <th>状态</th>
            <th>添加时间</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{$right[0]['id']}</td>
            <td>{$right[0]['title']}</td>
            <td>{$right[0]['cat']}</td>
            <td>{$right[0]['price']}</td>
            <td>{$right[0]['status']}</td>
            <td>{$right[0]['add_time']}</td>
        </tr>
        <tr>
            <td>{$right[1]['id']}</td>
            <td>{$right[1]['title']}</td>
            <td>{$right[1]['cat']}</td>
            <td>{$right[1]['price']}</td>
            <td>{$right[1]['status']}</td>
            <td>{$right[1]['add_time']}</td>
        </tr>
        <tr>
            <td>{$right[2]['id']}</td>
            <td>{$right[2]['title']}</td>
            <td>{$right[2]['cat']}</td>
            <td>{$right[2]['price']}</td>
            <td>{$right[2]['status']}</td>
            <td>{$right[2]['add_time']}</td>
        </tr>
        <tr>
            <td>{$right[3]['id']}</td>
            <td>{$right[3]['title']}</td>
            <td>{$right[3]['cat']}</td>
            <td>{$right[3]['price']}</td>
            <td>{$right[3]['status']}</td>
            <td>{$right[3]['add_time']}</td>
        </tr>

        </tbody>
    </table>
</div>
</body>
</html>
<script>
    layui.use(['element','layer','laypage'], function(){
        var element = layui.element;
        var laypage = layui.laypage;
        $ = layui.jquery;
        layer = layui.layer;
        resetMenuHeight();
    });
    // 重新设置菜单容器高度
    function resetMenuHeight(){
        var height = document.documentElement.clientHeight - 50;
        $('#menu').height(height);
    }
</script>
```


### 2.4 通过标签优化视图文件（标签循环，文件引入等）
在视图目录下创建一个public目录，将 index.html 视图文件的头与尾 取出来做公共文件
，header.html 引入js，css文件，index.html 引入 头尾 文件。


header.html 文件

```html
<html>
<head>
  <title>列表页</title>
  {load href="/static/layui/css/layui.css"}
  {load href="/static/layui/layui.js"}
  <style type="text/css">
    .header{width:100%;height: 50px;line-height: 50px;background: #2e6da4;color:#ffffff;}
    .title{margin-left: 20px;font-size: 20px;}
    .userinfo{float: rght;margin-right: 10px;}
    .userinfo a{color:#ffffff;}
    .menu{width: 200px;background:#333744;position:absolute;}
    .main{position: absolute;left:200px;right:0px;}

    .layui-collapse{border: none;}
    .layui-colla-item{border-top:none;}
    .layui-colla-title{background:#42485b;color:#ffffff;}
    .layui-colla-content{border-top:none;padding:0px;}

    .content span{background: #009688;margin-left: 30px;padding: 10px;color:#ffffff;}
    .content div{border-bottom: solid 2px #009688;margin-top: 8px;}
    .content button{float: right;margin-top: -5px;}
  </style>
</head>
<body>
```
tail.html 文件

```html
</body>
</html>
<script>
    layui.use(['element','layer','laypage'], function(){
        var element = layui.element;
        var laypage = layui.laypage;
        $ = layui.jquery;
        layer = layui.layer;
        resetMenuHeight();
    });
    // 重新设置菜单容器高度
    function resetMenuHeight(){
        var height = document.documentElement.clientHeight - 50;
        $('#menu').height(height);
    }
</script>
```





![在这里插入图片描述](https://img-blog.csdnimg.cn/6cbeb8485939452a991940a944528a5d.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)



index.php 新增一个打折功能，并引入header与 tail

```html
{include file="public/header"}
<div class="header">
    <span class="title"><span style="font-size: 20px;">{if $title}{$title} {/if}</span>--后台管理系统</span>
    <span class="userinfo">【{$login}】<span><a href="javascript:;">退出</a></span></span>
</div>
<div class="menu" id="menu">
    <div class="layui-collapse" lay-accordion>
        {foreach $left as $k=>$v}
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">{$v['title']}</h2>
            <div class="layui-colla-content {if $k == 0}layui-show{/if}">
                <ul class="layui-nav layui-nav-tree" lay-filter="test">
                    {foreach $v['lists'] as $vv}
                    <li class="layui-nav-item"><a href="list.html">{$vv['title']}</a></li>
                    {/foreach}
                </ul>
            </div>
        </div>
        {/foreach}
    </div>
</div>
<div class="main" style="padding:10px;">
    <div class="content">
        <span>商品列表</span>
        <div></div>
    </div>
    <table class="layui-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>商品标题</th>
            <th>分类</th>
            <th>原价</th>
            <th>现价</th>
            <th>状态</th>
            <th>添加时间</th>
        </tr>
        </thead>
        <tbody>
            {volist name="right" id="rr"}
        <tr>
            <td>{$rr['id']}</td>
            <td>{$rr['title']}</td>
            <td>{$rr['cat']}</td>
            <td>{$rr['price']}</td>
            <td>
                {if $rr['discount']!=0}
                    {$rr['price']*($rr['discount']/10)}
                {else /}
                    {$rr['price']}{/if}
            </td>
            <td>{if $rr['status']==1}开启{elseif $rr['status']==0/}关闭{/if}</td>
            <td>{$rr['add_time']|date='Y-m-d H:i:s'}</td>
        </tr>
            {/volist}
        </tbody>
    </table>
</div>
{include file="public/tail"}
```






## 三. 数据库创建

创建数据库与表，此数据库为项目数据库。


### 3.1 管理员表

```sql
CREATE TABLE `shop_admin` (
    `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
    `account` varchar(50) NOT NULL COMMENT '账户',
    `password` char(32) NOT NULL COMMENT '密码',
    `name` varchar(50) NOT NULL COMMENT '姓名',
    `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1开启 2关闭',
    `add_time` int(10) unsigned NOT NULL COMMENT '添加时间',
    PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='后台管理员';
INSERT INTO `shop_admin` VALUES (1, 'ouyangke', 'e10adc3949ba59abbe56e057f20f883e', '欧阳克', 1, 1576080000);
```


### 3.2 商品分类表

```sql
CREATE TABLE `shop_cat` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `name` varchar(50) NOT NULL COMMENT '分类名',
    `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1开启 2关闭',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='分类表';

INSERT INTO `shop_cat` VALUES (1, '女装', 1);
INSERT INTO `shop_cat` VALUES (2, '男装', 1);
INSERT INTO `shop_cat` VALUES (3, '孕产', 1);
INSERT INTO `shop_cat` VALUES (4, '童装', 1);
INSERT INTO `shop_cat` VALUES (5, '电视', 1);
INSERT INTO `shop_cat` VALUES (6, '手机', 1);
INSERT INTO `shop_cat` VALUES (7, '电脑', 1);
```



### 3.3 商品表

```sql
CREATE TABLE `shop_goods` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT ' 商品ID',
    `cat` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '分类ID',
    `title` varchar(200) NOT NULL COMMENT '商品标题',
    `price` double(10,2) unsigned NOT NULL COMMENT '价格',
    `discount` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '折扣',
    `stock` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '库存',
    `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1开启 2关闭 3删除',
    `add_time` int(10) unsigned NOT NULL COMMENT '添加时间',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COMMENT='商品表';

INSERT INTO `shop_goods` VALUES (1, 1, '云朵般轻盈的仙女裙 高级钉珠收腰长裙 气质无袖连衣裙', 279.99, 0, 1100, 1, 1576080000);
INSERT INTO `shop_goods` VALUES (2, 1, '高冷御姐风灯芯绒a字连衣裙女秋冬2019年新款收腰显瘦复古裙子', 255.90, 0, 100, 1, 1576080000);
```


### 3.4 菜单表

```sql
CREATE TABLE `shop_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(50) NOT NULL COMMENT '菜单名',
  `fid` int(10) NOT NULL COMMENT '父ID',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1开启 2关闭',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='左侧菜单表';

INSERT INTO `shop_menu` VALUES (1, '商品管理', 0, 1);
INSERT INTO `shop_menu` VALUES (2, '商品列表', 1, 1);
INSERT INTO `shop_menu` VALUES (3, '商品分类', 1, 1);
INSERT INTO `shop_menu` VALUES (4, '用户管理', 0, 1);
INSERT INTO `shop_menu` VALUES (5, '用户列表', 4, 1);
INSERT INTO `shop_menu` VALUES (6, '购物车', 4, 1);
INSERT INTO `shop_menu` VALUES (7, '用户地址', 4, 1);
INSERT INTO `shop_menu` VALUES (8, '订单管理', 4, 1);
INSERT INTO `shop_menu` VALUES (9, '后台管理', 0, 1);
INSERT INTO `shop_menu` VALUES (10, '管理员列表', 9, 1);
INSERT INTO `shop_menu` VALUES (11, '个人中心', 9, 1);
INSERT INTO `shop_menu` VALUES (12, '左侧菜单', 9, 1);
```


## 四. 查询构造器应用

thinkphp6 默认操作数据库采用 PDO 处理方式

统一操作入口：Db::

原生查询：query()，execute()

常用构造器：table()，field()，find()，select()，where()，order()

ps:
**V6.0.3+版本开始，原生查询仅支持Db类操作，不支持在模型中调用原生查询方法（包括query和execute方法）。**

创建一个数据库，包括一个表，几个字段，不使用前面创建的项目数据库。


![请添加图片描述](https://img-blog.csdnimg.cn/303d6f0b6fe74755b518f4589db49c68.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)




### 4.1 查询

#### table()：设置表
#### find()：查询单个数据
  参数可加条件，默认主键

```php
public function demo1(){
        $res = Db::table('tp_user')
            ->find(2);
        dump($res);
```


![请添加图片描述](https://img-blog.csdnimg.cn/03ec8f8d761f4e179ccd0f75dafbf07f.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)




#### select()：查询多个数据
也支持主键为参数

```php
    public function demo1(){
        $res = Db::table('tp_user')
            ->select();
        dump($res);
```

![请添加图片描述](https://img-blog.csdnimg.cn/58bfbd257a864dd29fa86b36ade3170b.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)



如果查询的条件有多个参数，可将参数放在数组中查询


![请添加图片描述](https://img-blog.csdnimg.cn/014b221e29804ee5b0a1358df29bd78f.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)



#### field()：设置查询字段
```php
public function demo1(){
        $res = Db::table('tp_user')
            ->field('user_id,user_name')
            ->select();
        dump($res);
```

![请添加图片描述](https://img-blog.csdnimg.cn/01adc9ecabda4645828a9123e3c63cff.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)



#### where()：查询条件

支持字符串，表达式，数组
```php
public function demo1(){
        $res = Db::table('tp_user')
            ->field('user_id,user_name')
            ->where('user_id >= 1')
            ->select();
        dump($res);
```

![请添加图片描述](https://img-blog.csdnimg.cn/77127ccc08ca42808fa62830f0df8ef2.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)



#### order() 与 limit（）
排序与查询数量
多个排序规则放数组中进行


order 默认为升序

```php
    public function demo1(){
        $res = Db::table('tp_user')
            ->field('user_id,user_name')
            ->order('user_id')
            ->select();
        dump($res);
```

降序为 desc 与mysql一致

```php
    public function demo1(){
        $res = Db::table('tp_user')
            ->field('user_id,user_name')
            ->order('user_id','desc')
            ->select();
        dump($res);
```


limit 指定输出数量
```php
    public function demo1(){
        $res = Db::table('tp_user')
            ->field('user_id,user_name')
            ->order('user_id','desc')
            ->limit('1')
            ->select();
        dump($res);
```



#### value()：查询某个值

```php
    public function demo1(){
        $res = Db::table('tp_user')
            ->value('user_name');
        dump($res);
```


#### column()：查询某个列的值
```php
    public function demo1(){
        $res = Db::table('tp_user')
            ->column('user_name');
        dump($res);
```


![请添加图片描述](https://img-blog.csdnimg.cn/9a83950e216e4f00958517640827765c.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)





### 4.2 插入


#### insert()：插入数据
返回 数值 1
```php
    public function demo1(){
        $data = ['user_name' =>'wpsec','password'=>md5('wpsec')];
        $ins = Db::table('tp_user')
            ->insert($data);
        dump($ins);
```

![请添加图片描述](https://img-blog.csdnimg.cn/cf9375454d2748efb6e9a0ff3eca4ef7.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)



#### insertGetid()：插入数据返回主键

```php
    public function demo1(){
        $data = ['user_name' =>'wpsec1','password'=>md5('wpsec')];
        $ins = Db::table('tp_user')
            ->insertGetId($data);
        dump($ins);
```



![请添加图片描述](https://img-blog.csdnimg.cn/2e4bdbf0c24a47d69b7dae8ec6ba155d.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)




#### insertAll()：插入多条数据

```php
    public function demo1(){
        $data =[
            ['user_name' =>'wpsec2','password'=>md5('wpsec2')],
            ['user_name' =>'wpsec3','password'=>md5('wpsec3')]
        ];
        dump($data);
        $ins = Db::table('tp_user')
            ->insertAll($data);
        dump($ins);
```


![请添加图片描述](https://img-blog.csdnimg.cn/59b34a34a2854ad693a1f283846c4b36.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)




### 4.3 修改

#### update()：更新数据


```php
    public function demo1(){
        $data =['password' => md5('123456')];
        $update = Db::table('tp_user')
            ->where('user_id = 4')
            ->update($data);
        dump($update);
```

![请添加图片描述](https://img-blog.csdnimg.cn/ad1857d25385491b899450e6a8e0b43d.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)



#### inc()与dec()
自增与自减

从上个数值+1 或 -1

第二参数为步长（默认1）
```php
    public function demo1(){
        $update = Db::table('tp_user')
            ->where('user_id = 4')
            ->inc('user_id',2)
            ->update());
        dump($update);
```

### 4.4 删除

#### delete()：删除数据

```php
    public function demo1(){
        $delete = Db::table('tp_user')
            ->where('user_id = 6')
            ->delete();
        dump($delete);
```

![请添加图片描述](https://img-blog.csdnimg.cn/3331a4793b5143a2aa0a3af499038b7c.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)



#### useSoftDelete()：软删除

数据没有被真正删除，使用 delete_time 或者 status 将数据标记。



### 4.5 其它操作

#### save()：同一写入数据
自动判断是否是修改还是插入（以写入数据中是否存在主键为依据）

插入数据

```php
    public function demo1(){
        $data = [
            'user_name' => 'cqcet',
            'password' => md5('123'),
            'email' => 'cqcet@admin.com'
        ];
        $save = Db::table('tp_user')
            ->save($data);
        dump($save);
```


修改数据
```php
    public function demo1(){
        $data = [
            'user_id' => '5',
            'user_name' => 'cqucc',
            'password' => md5('123'),
            'email' => 'cqucc@admin.com'
        ];
        $save = Db::table('tp_user')
            ->save($data);
        dump($save);
```

![请添加图片描述](https://img-blog.csdnimg.cn/4a18040f829b49de8dcd5329fde0535a.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)


### 4.8 增删改查的一些进阶操作（链式操作）
#### 数据表

```php
# 必须完整数据库名
$select = Db::table('shop_goods')->where('id','10')->select();
print_r($select->toArray());
# 数据库未设置前缀
$select = Db::name('shop_goods')->where('id','11')->select();
print_r($select->toArray());
# 数据库设置前缀，无前缀访问
$select = Db::name('list')->where('id','12')->select();
print_r($select->toArray());
```
数据表前缀

database.php
```php
return [
    'connections'     => [
        'mysql' => [
            // 数据库表前缀
            'prefix'  => Env::get('database.prefix', 'shop_'),
        ]
    ]
];
```


|连贯操作| 作用 | 支持的参数类型 |
|--|--|--|
where* 	|用于AND查询 	|字符串、数组和对象
table 	|用于定义要操作的数据表名称 	|字符串和数组
name 	|用于定义要操作的数据表名称 	|字符串
field* 	|用于定义要查询的字段（支持字段排除） 	|字符串和数组
order* 	|用于对结果排序 	|字符串和数组
limit 	|用于限制查询结果数量 	|字符串和数字
page 	|用于查询分页（内部会转换成limit） |	字符串和数字
whereOr* |	用于OR查询 |	字符串、数组和对象
whereTime* |	用于时间日期的快捷查询 |	字符串
alias 	|用于给当前数据表定义别名 	|字符串
group 	|用于对查询的group支持 |	字符串
having 	|用于对查询的having支持 |	字符串
join* 	|用于对查询的join支持 	|字符串和数组
union* 	|用于对查询的union支持 |	字符串、数组和对象
view* 	|用于视图查询 	|字符串、数组
distinct |	用于查询的distinct支持 	|布尔值
lock 	|用于数据库的锁机制 	|布尔值
cache 	|用于查询缓存 	|支持多个参数
comment |	用于SQL注释 	|字符串
force 	|用于数据集的强制索引 	|字符串
master 	|用于设置主服务器读取数据 	|布尔值
strict 	|用于设置是否严格检测字段名是否存在 	|布尔值
sequence |	用于设置自增序列名 	|字符串
failException |	用于设置没有查询到数据是否抛出异常 |	布尔值
partition |	用于设置分区信息 	|数组 字符串
replace 	|用于设置使用REPLACE方式写入 |	布尔值
extra |	用于设置额外查询规则 	|字符串
duplicate |	用于设置DUPLCATE信息 	|数组 字符串

#### 表达式

- 表达式是SQL语句的条件
- 表达式不分大小写
- 表达式写在where里



|表达式| 含义 | 方法 |
|--|--|--|
= 	|等于 	|
<> 	|不等于 |	
> 	|大于 	|
>= 	|大于等于| 	
< 	|小于 	|
<= 	|小于等于| 	
[NOT] LIKE 	|模糊查询 	|whereLike/whereNotLike
[NOT] BETWEEN| 	（不在）区间查询 	|whereBetween/whereNotBetween
[NOT] IN 	|（不在）IN 查询 	|whereIn/whereNotIn
[NOT] NULL 	|查询字段是否（不）是NULL 	|whereNull/whereNotNull
#### whire 链式

```php
# 等于（=）
$select = Db::table('shop_goods')->where('id','=','1')->select();
print_r($select->toArray());

# 不等于（<>）
$select = Db::table('shop_goods')->where('id','<>','2')->select();
print_r($select->toArray());

# 大于（>）
$select = Db::table('shop_goods')->where('id','>','3')->select();
print_r($select->toArray());

# 大于等于（>=）
$select = Db::table('shop_goods')->where('id','>=','4')->select();
print_r($select->toArray());

# 小于（<）
$select = Db::table('shop_goods')->where('id','<','5')->select();
print_r($select->toArray());

# 小于等于（<=）
$select = Db::table('shop_goods')->where('id','<=','6')->select();
print_r($select->toArray());

# 多where
$select = Db::table('shop_goods')
            ->where('id','>','3')
            ->where('id','<','8')
            ->select();
print_r($select->toArray());

# LIKE
$select = Db::table('shop_goods')->where('title','like','%连衣裙%')->select();
print_r($select->toArray());

#  NOT LIKE
$select = Db::table('shop_goods')->where('title','not like','%连衣裙%')->select();
print_r($select->toArray());

# BETWEEN
$select = Db::table('shop_goods')->where('id','between','6,10')->select();
print_r($select->toArray());

#  NOT BETWEEN
$select = Db::table('shop_goods')->where('id','not between',[6,10])->select();
print_r($select->toArray());

# IN
$select = Db::table('shop_goods')->where('id','in','4,7,10')->select();
print_r($select->toArray());

#  NOT IN
$select = Db::table('shop_goods')->where('id','not in',[4,7,10])->select();
print_r($select->toArray());
```


#### 聚合查询
- 聚合方法如果没有数据，默认都是0，聚合查询都可以配合其它查询条件


| 方法 |功能  |
|--|--|
count 	|统计数量，参数是要统计的字段名（可选）
max 	|获取最大值，参数是要统计的字段名（必须）
min 	|获取最小值，参数是要统计的字段名（必须）
avg 	|获取平均值，参数是要统计的字段名（必须）
sum 	|获取总数，参数是要统计的字段名（必须）

```php
// 统计数量，参数是要统计的字段名（可选）
$select = Db::table('shop_goods')->count();
print_r($select);

// 获取最大值，参数是要统计的字段名（必须）
$select = Db::table('shop_goods')->max('id');
print_r($select);

// 获取最小值，参数是要统计的字段名（必须）
$select = Db::table('shop_goods')->min('id');
print_r($select);

// 获取平均值，参数是要统计的字段名（必须）
$select = Db::table('shop_goods')->avg('id');
print_r($select);

// 获取总数，参数是要统计的字段名（必须）
$select = Db::table('shop_goods')->sum('id');
print_r($select);
```





### 4.7 调试sql
- getLastSql()：输出上次执行的sql语句，只能获取最后执行的sql语句。
- fetchSql()：方法直接返回当前sql而不执行。
```php
    public function test(){
        $info = Db::table('shop_goods')
            ->where('id','1')
            ->fetchSql()
            ->select();
        echo Db::getLastSql()."</br>";
        echo $info;
    }
```


![在这里插入图片描述](https://img-blog.csdnimg.cn/ca28078b63954725aed6806ee712e089.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)


### 4.8 多数据库配置（动态数据库配置）
配置两个数据库配置信息

在database.php 下可配置多个数据库配置信息
![在这里插入图片描述](https://img-blog.csdnimg.cn/9abb43480dc24d708846efc6e5d253c4.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)




## 五. 数据集

处理数据集的方法
常用的 isEmpty，toArray



| 方法 | 描述 |
| --- | --- |
isEmpty| 是否为空
toArray| 转换为数组
all | 所有数据
merge |  合并其它数据
diff  |  比较数组，返回差集
flip  |  交换数据中的键和值
intersect |  比较数组，返回交集
keys  |  返回数据中的所有键名
pop | 删除数据中的最后一个元素
shift  | 删除数据中的第一个元素
unshift | 在数据开头插入一个元素
push   | 在结尾插入一个元素
reduce | 通过使用用户自定义函数，以字符串返回数组
reverse| 数据倒序重排
chunk  | 数据分隔为多个数据块
each   | 给数据的每个元素执行回调
filter | 用回调函数过滤数据中的元素
column | 返回数据中的指定列
sort   | 对数据排序
order  | 指定字段排序
shuffle| 将数据打乱
slice  | 截取数据中的一部分
map | 用回调函数处理数组中的元素
where  | 根据字段条件过滤数组中的元素
whereLike |  Like查询过滤元素
whereNotLike  |  Not Like过滤元素
whereIn | IN查询过滤数组中的元素
whereNotIn | Not IN查询过滤数组中的元素
whereBetween |   Between查询过滤数组中的元素
whereNotBetween |Not Between查询过滤数组中的元素





#### isEmpty：是否为空

```php
    public function demo1(){
        $res = Db::table('tp_user')
            ->where('user_id = 100')
            ->select();
        if ($res->isEmpty()) {
            echo '没有数据';
        }
```


#### isArray()：转换为数组


```php
    public function demo1(){
        $res = Db::table('tp_user')
            ->select()
            ->toArray();
        dump($res);
```

![请添加图片描述](https://img-blog.csdnimg.cn/ca15a0efed8b445e954e1a25e06370a9.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)






### 5.1 利用数据库查询展现后台数据
修改控制器

```php
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
```









## 六. 请求
- 使用请求必须使用门面方式调用（think\facade\Requert）
- 通过Request对象完成全局输入变量的检测，获取和安全过滤
- 支持 `get,post,request,server,session,cookie,env` 等超全局变量和文件上传信息


|方法| 描述 |
|--|--|
|param	 | 获取当前请求的变量
|get	 | 获取 $_GET 变量
|post	 | 获取 $_POST 变量
|put	 | 获取 PUT 变量
|delete	 | 获取 DELETE 变量
|session | 	获取 SESSION 变量
|cookie	 | 获取 $_COOKIE 变量
|request | 	获取 $_REQUEST 变量
|server	 | 获取 $_SERVER 变量
|env	 | 获取 $_ENV 变量
|route	 | 获取 路由（包括PATHINFO） 变量
|middleware	| 获取 中间件赋值/传递的变量
|file	 | 获取 $_FILES 变量
|all V6.0.8+	| 获取包括 $_FILES 变量在内的请求变量，相当于param+file


### 6.1 param
param 可以获取所有请求方法（自动识别），系统推荐使用此方法
param 会把当前请求类型的参数和路由变量以及get请求合并，并且路由变量是优先的
（请求一个网页时，param会把请求的参数和路由合并为一个数组）


### 6.2 GET请求

视图文件
添加一个操作
插入一条onclick与js

![在这里插入图片描述](https://img-blog.csdnimg.cn/8d976b889fc84dab9e8d5c37e791d93d.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)

```html
...
<th>操作</th>
...
<td><button class="layui-btn layui-btn-xs" onclick="edit({$rr.id})">编辑</button></td>
...

<button class="layui-btn layui-btn-xs" onclick="edit({$right_v.id})">编辑</button>

<script type="text/javascript">
    function edit(id){
        layer.open({
            type: 2,
            title: '修改',
            shade: 0.3,
            area: ['480px', '440px'],
            content: '/index.php/index/edit?id='+id
        });
    }
</script>
```


控制器文件

```php
public function edit(){
    print_r( $_GET );    // 原生get接收
    print_r( Request::param() ); // 获取当前请求的所有变量
    print_r( Request::param('id') );    // 获取当前请求的id变量
    print_r( Request::get() );
}
```
![在这里插入图片描述](https://img-blog.csdnimg.cn/f09160c6be5747858d95e9096b19f9b7.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)











创建 edit.html 前端代码

```html
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css">
  <script type="text/javascript" src="/static/layui/layui.js"></script>
</head>
<body style="padding:10px;">
<form class="layui-form">
  <input type="hidden" name="id" value="{$shop.id}">
  <div class="layui-form-item">
    <label class="layui-form-label">标题</label>
    <div class="layui-input-inline">
      <input type="text" class="layui-input" name="title" value="{$shop.title}">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">分类</label>
    <div class="layui-input-inline">
      <select name="cat">
        <option value=0  selected ></option>

        <option value=0> </option>

      </select>
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">原价</label>
    <div class="layui-input-inline">
      <input type="text" class="layui-input" name="price" value="{$shop.price}">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">折扣</label>
    <div class="layui-input-inline">
      <input type="text" class="layui-input" name="discount" value="{$shop.discount}">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">库存</label>
    <div class="layui-input-inline">
      <input type="text" class="layui-input" name="stock" value="{$shop.stock}">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">状态</label>
    <div class="layui-input-inline">
      <select name="status">
        <option value="1"> </option>
        <option value="0"></option>
      </select>
    </div>
  </div>
</form>
<div class="layui-form-item">
  <div class="layui-input-block">
    <button class="layui-btn" onclick="save()">保存</button>
  </div>
</div>
<script type="text/javascript">
  layui.use(['layer','form'],function(){
    form = layui.form;
    layer = layui.layer;
    $ = layui.jquery;
  });
  function save(){
    $.post('/index.php/Index/edits',$('form').serialize(),function(res){
      if(res.code>0){
        layer.alert(res.msg,{icon:2});
      }else{
        layer.msg(res.msg);
        setTimeout(function(){parent.window.location.reload();},1000);
      }
    },'json');
  }
</script>
</body>
</html>
```


修改 控制器文件中的 edit 方法

```php
    public function edit(){
        $id = Request::param('id');
        $shop = Db::table('shop_goods')
            ->where('id',$id)
            ->find();
        View::assign([
            'shop' => $shop
        ]);
        return View::fetch();
    }
```

![在这里插入图片描述](https://img-blog.csdnimg.cn/5ecbdbb699d841d7b5a3b403c577568e.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)



修改edit 与 控制器 把 商品分类表查询出来（shop_cat表）

```php
    public function edit(){
        $id = Request::param('id');
        $shop = Db::table('shop_goods')
            ->where('id',$id)
            ->find();
        $cat = Db::table('shop_cat')
            ->where('status',1)
            ->select();
        View::assign([
            'shop' => $shop,
            'cat' => $cat
        ]);
        return View::fetch();
    }
```

edit.html

```html
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css">
  <script type="text/javascript" src="/static/layui/layui.js"></script>
</head>
<body style="padding:10px;">
<form class="layui-form">
  <input type="hidden" name="id" value="{$shop.id}">
  <div class="layui-form-item">
    <label class="layui-form-label">标题</label>
    <div class="layui-input-inline">
      <input type="text" class="layui-input" name="title" value="{$shop.title}">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">分类</label>
    <div class="layui-input-inline">
      <select name="cat">
        <option value=0 {if $shop['cat']==0} selected {/if}></option>
        {volist name="cat" id="cat_v"}
        <option value="{$cat_v['id']}" {if $shop['cat']==$cat_v['id']} selected {/if}>{$cat_v['name']}</option>
        {/volist}
      </select>
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">原价</label>
    <div class="layui-input-inline">
      <input type="text" class="layui-input" name="price" value="{$shop.price}">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">折扣</label>
    <div class="layui-input-inline">
      <input type="text" class="layui-input" name="discount" value="{$shop.discount}">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">库存</label>
    <div class="layui-input-inline">
      <input type="text" class="layui-input" name="stock" value="{$shop.stock}">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">状态</label>
    <div class="layui-input-inline">
      <select name="status">
        <option value="1" {if $shop['status']==1} selected {/if}>开启</option>
        <option value="0" {if $shop['status']==0} selected {/if}>关闭</option>
      </select>
    </div>
  </div>
</form>
<div class="layui-form-item">
  <div class="layui-input-block">
    <button class="layui-btn" onclick="save()">保存</button>
  </div>
</div>
<script type="text/javascript">
  layui.use(['layer','form'],function(){
    form = layui.form;
    layer = layui.layer;
    $ = layui.jquery;
  });
  function save(){
    $.post('Index/edits',$('form').serialize(),function(res){
      if(res.code>0){
        layer.alert(res.msg,{icon:2});
      }else{
        layer.msg(res.msg);
        setTimeout(function(){parent.window.location.reload();},1000);
      }
    },'json');
  }
</script>
</body>
</html>
```


### 6.3 POST请求
edit.html 有一个保存的方法是通过 POST执行的
![在这里插入图片描述](https://img-blog.csdnimg.cn/77a54889beac4e34a55c805ec829aeeb.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)

在控制器中创建edits方法


```php
public function edits(){
    $all = Request::param();
    $update = Db::table('shop_goods')
        ->where('id',$all['id'])
        ->update($all);
    if($update){
        echo json_encode(['code'=>0,'msg'=>'修改成功']);
    }else{
        echo json_encode(['code'=>1,'msg'=>'修改失败']); 
```

### 6.4 请求类型








|方法  | 说明 |
|--|--| 	
| method 	 | 获取当前请求类型 |
| has 	 | 判断传值是否存在 |
| isGet 	 | 判断是否GET请求 |
| isPost 	 | 判断是否POST请求|
| isPut 	 | 判断是否PUT请求|
| isDelete |  	判断是否DELETE请求|
| isAjax 	 | 判断是否AJAX请求|
| isPjax 	 | 判断是否PJAX请求|
| isJson 	 | 判断是否JSON请求|
| isMobile |  	判断是否手机访问|
| isHead 	 | 判断是否HEAD请求|
| isPatch  | 	判断是否PATCH请求|
| isOptions |  	判断是否OPTIONS请求|
| isCli |	判断是否为CLI执行|
| isCgi |	判断是否为CGI模式|

### 6.5 利用判断请求方法优化 edit 与 edis 方法，修改完后修改edit.html 的js方法

```php
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
```

### 6.6 利用判断请求方法添加一个添加按钮
新建一个 add.html
```html
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css">
    <script type="text/javascript" src="/static/layui/layui.js"></script>
</head>
<body style="padding:10px;">
<form class="layui-form">
    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="title" value="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">分类</label>
        <div class="layui-input-inline">
            <select name="cat">
                <option value=0 selected></option>
                {volist name="cat" id="cat_v"}
                <option value="{$cat_v['id']}">{$cat_v['name']}</option>
                {/volist}
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">原价</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="price" value="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">折扣</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="discount" value="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">库存</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="stock" value="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-inline">
            <select name="status">
                <option value="1" selected>开启</option>
                <option value="0">关闭</option>
            </select>
        </div>
    </div>
</form>
<div class="layui-form-item">
    <div class="layui-input-block">
        <button class="layui-btn" onclick="save()">保存</button>
    </div>
</div>
<script type="text/javascript">
    layui.use(['layer','form'],function(){
        form = layui.form;
        layer = layui.layer;
        $ = layui.jquery;
    });
    function save(){
        $.post('/Index/add',$('form').serialize(),function(res){
            if(res.code>0){
                layer.alert(res.msg,{icon:2});
            }else{
                layer.msg(res.msg);
                setTimeout(function(){parent.window.location.reload();},1000);
            }
        },'json');
    }
</script>
</body>
</html>
```

在index.html下新建一个 js 与添加按钮

```html
...
<td><button class="layui-btn layui-btn-xs" onclick="add()">添加</button></td>
...
<script type="text/javascript">
    function add(){
        layer.open({
            type: 2,
            title: '添加',
            shade: 0.3,
            area: ['480px', '440px'],
            content: '/index/add'
        });
    }
</script>
```



控制器新建一个add方法

```php
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
```

![在这里插入图片描述](https://img-blog.csdnimg.cn/92e1cdc0be3c4c57b1912b57fd9b9ff3.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)

### 6.6 利用判断请求方法添加一个删除按钮
index.html

```html
...
<td><button class="layui-btn layui-btn-xs" onclick="del({$rr.id})">删除</button></td>
...
<script type="text/javascript">
    function del(id){
        layer.confirm('确定要删除吗？', {
            icon:3,
            btn: ['确定','取消']
        }, function(){
            $.post('/index/del',{'id':id},function(res){
                if(res.code>0){
                    layer.alert(res.msg,{icon:2});
                }else{
                    layer.msg(res.msg);
                    setTimeout(function(){window.location.reload();},1000);
                }
            },'json');
        });
    }
</script>
```

controller

```php
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
```

![在这里插入图片描述](https://img-blog.csdnimg.cn/05d89e0a25c349fd92a85a649d8a1634.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)


## 七. 模型
- 模型是用于操作数据库的
- 模型会自动对应数据表，模型类的命名规则是除去表前缀的数据表名称，采用驼峰法命名，并且首字母大写
- 模型自动对应的数据表名称都是遵循小写+下划线规范，如果你的表名有大写的情况，必须通过设置模型的table属性。

### 7.1 创建模型
条件：
配置表前缀
database.php 文件里 prefix
| 模型名 |数据库前缀  |
|--|--|
|Cat  | shop_cat |
|Goods|shop_goods|
|UserOrder|shop_user_order|



第一步：创建一个跟控制器平级的目录，目录名：model
第二步：在 model 创建 Goods.php 文件


### 7.2 模型操作
在模型中除了可以调用数据库类的方法之外（换句话说，数据库的所有查询构造器方法模型中都可以支持），可以定义自己的方法，所以也可以把模型看成是数据库的增强版

- 模型文件里的自定义方法，尽量不要和 thinkphp 方法一样名称
 - 模型里的 Goods:: 也可以用 static:: 关键词
 - 链式操作，都可以在模型里使用


#### find 查询数据
Goods.php 对应goods 数据库

```php
    public function getsql(){
        $find = Goods::find(1);
        $find = Goods::where('id',1)
            ->find();
        return $find;
    }
```

![在这里插入图片描述](https://img-blog.csdnimg.cn/d9253f034dbc4a27811a80dd109908ad.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)

#### 控制器调用模型
控制器引入Goods类，调用Goods类的getsql方法

返回值都为对象，可以使用 `toArray()` 在模型上 转换数据
```php
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
```
![在这里插入图片描述](https://img-blog.csdnimg.cn/21a9bba35b8d4cbea026c9b810c4f34b.png?x-oss-process=image/watermark,type_ZHJvaWRzYW5zZmFsbGJhY2s,shadow_50,text_Q1NETiBAX2FiY2RlZg==,size_20,color_FFFFFF,t_70,g_se,x_16)

### 7.3 模型设置
为了和数据库更好的适配，模型可以提前设置对应的数据库属性，一个文件配置一个数据表

| 属性 |描述  |
|--|--|
name 	|模型名（相当于不带数据表前后缀的表名，默认为当前模型类名）
table 	|数据表名（默认自动获取）
pk 	|主键名（默认为 id ）
schema 	|模型对应数据表字段及类型
type 	|模型需要自动转换的字段及类型
disuse 	|数据表废弃字段（数组）


### 7.4 模型作用
#### 获取器

    获取器的作用是对模型实例的（原始）数据做出自动处理
    命名规则：get + 字段名 + Attr
    字段名是数据表字段的驼峰转换

```php
class Goods extends Model{
    public function index(){
        $find = Goods::find(10);
        echo $find->status;
        return $find->toArray();
    }
    public function getStatusAttr($v){
        $status = [
            1=>'开启',
            2=>'关闭'
        ];
        return $status[$v];
    }
}
```

#### 修改器

    修改器的主要作用是对模型设置的数据对象值进行处理
    命名规则： set + 字段名 + Attr

```php
class Goods extends Model{
    public function index(){
        $create = Goods::create([
            'cat' =>  3.33,
            'title' =>  '新商品',
            'price' =>  '59.99',
            'add_time' => time()
        ]);
        return $create;
    }
    public function setCatAttr($v,$all){
        // $all 全部参数
        return (int)$v;
    }
}
```

#### 搜索器

    搜索器的作用是用于封装字段（或者搜索标识）的查询条件表达式
    命名规则： search + 字段名 + Attr

```php
class Goods extends Model{
    public function index(){
        $select = Goods::withSearch(['title'],[
            'title' => '新'
        ])->select();
        return $select->toArray();
    }
    public function searchTitleAttr($query,$v){
        $query->where('title','like', $v . '%');
    }
}
```

#### 检查数据

    如果要判断数据集是否为空，不能直接使用 empty 判断
    必须使用数据集对象的 isEmpty 方法判断

```php
class Goods extends Model{
    public function index(){
        $select = Goods::where('title','1')->select();
        if(empty($select)){
            echo 111;
        }
        if($select->isEmpty()){
            echo 111;
        }
    }
}
```



## 摘要

此学习项目一部分来源 PHP 中文网
已上传github：[https://github.com/wpsec/Thinkphp6_shop](https://github.com/wpsec/Thinkphp6_shop)