<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/6
 * Time: 11:42
 */

namespace Admin\Controller;

class PropertyController extends AdminController
{
    public function index(){
        $list = M('Property')->select();
        //var_dump($list);exit;
        $this->assign('list', $list);
        $this->meta_title = '物业管理';
        $this->display();
    }
    public function add(){
        if(IS_POST){
            $Property = D('Property');
            $data = $Property->create();
            if($data){
                $id = $Property->add();
                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    /*action_log('update_channel', 'channel', $id, UID);*/
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Property->getError());
            }
        }else{
            $this->meta_title = '添加租售';
            $this->display('edit');
        }
    }
    public function edit($id)
    {
        if (IS_POST) {
            $Property = D('Property');
            $data = $Property->create();
                if ($Property->save($data)) {
                    $this->success('编辑成功', U('index'));
                } else {
                    $this->error('编辑失败');
                }

            } else {
                $id = i('get.id', 0);
                $info = M('Property')->find($id);
                $this->assign('info', $info);
                $this->meta_title = '编辑导航';
                $this->display();
            }
        }
    public function del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(M('Property')->where($map)->delete()){
            //记录行为
            //action_log('update_channel', 'channel', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}