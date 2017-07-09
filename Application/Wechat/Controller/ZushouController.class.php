<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/7
 * Time: 16:37
 */

namespace Wechat\Controller;


class ZushouController extends WechatController
{
    public function zushou(){
        $Property = M('Property');
        $list = $Property->where('types=2')->select();
        $this->assign('list',$list);
        $list2 = $Property->where('types=1')->select();
        $this->assign('list2',$list2);
        $this->display();
    }
    public function detail(){
        $id = i('get.id',0);
        $Property = M('Property');
        $list = $Property->where('id='.$id)->find();
        $this->assign('list',$list);
        $this->display();
    }
}