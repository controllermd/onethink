<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/6
 * Time: 11:42
 */

namespace Admin\Controller;

use Think\Page;

class PropertyController extends AdminController
{
    public function index(){
        $list = M('Property');
        import('ORG.Util.Page');// 导入分页类
        $count = $list->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count,3);// 实例化分页类 传入总记录数
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询
        $list = $list->order('id')->limit($Page->firstRow.','.$Page->listRows)->select(); // $Page->firstRow 起始条数 $Page->listRows 获取多少条
        $this->assign('page',$show);// 赋值分页输出
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
            //create才是验证方法,要判断这里才能打印出错误信息
            if($data!==false){
                if ($Property->save($data)!==false) {
                    $this->success('编辑成功', U('index'));
                } else {
                    $this->error($Property->getError());
                }
            }else{
                $this->error($Property->getError());
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