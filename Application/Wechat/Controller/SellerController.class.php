<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/7
 * Time: 16:37
 */

namespace Wechat\Controller;


class SellerController extends WechatController
{
    public function seller(){
        $Document = M('Document');
        $list = $Document->where('category_id=40')->select();
        $this->assign('list',$list);
        $this->display();
    }
    public function detail(){
        $id = i('get.id', 0);
        $result = M('Document')->table(array('Document' => 'd', 'Ucenter_member' => 'u', 'Document_article' => 'dl'))->where('d.id = dl.id and u.id=d.uid and d.id=' . $id)->find();
        $this->assign('list', $result);
        $this->display();
    }
}