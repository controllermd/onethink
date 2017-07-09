<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/7
 * Time: 19:18
 */

namespace Wechat\Controller;


class NoticeController extends WechatController
{
    public function notice()
    {

        $p=I('get.p');
        $Document = M('Document');
        $pageSize = 2;
        $list = $Document->table(array('Document' => 'd','Picture' => 'p'))->where('d.id = p.id and d.category_id=2')->limit(0,$pageSize)->select();
        if($p){
            $list = $Document->table(array('Document' => 'd','Picture' => 'p'))->where('d.id = p.id and d.category_id=2')->limit(($p-1)*$pageSize,$pageSize)->select();
            if($list){
                $data=[
                    'status'=>1,
                    'data'=>$list,
                ];
            }else{
                $data=[
                    'status'=>0,
                ];
            }
            $this->ajaxReturn($data);
        }
        $this->assign('list', $list);

        $this->display();
    }

    public function detail()
    {
        $id = i('get.id', 0);
        $result = M('Document')->table(array('Document' => 'd', 'Ucenter_member' => 'u', 'Document_article' => 'dl'))->where('d.id = dl.id and u.id=d.uid and d.id=' . $id)->find();
        M('Document')->where('id=' . $id)->setInc('view', 1);
        $this->assign('list', $result);
        $this->display();
    }
}