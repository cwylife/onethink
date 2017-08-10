<?php
/**
 * Created by PhpStorm.
 * User: chenwenyue
 * Date: 2017/8/10
 * Time: 14:47
 */

namespace Admin\Controller;


use Think\Controller;

class RepairController extends AdminController
{
    /**
     * 配置管理
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
        /* 查询条件初始化 */
//
//        $pid = i('get.pid', 0);
        /* 获取频道列表 */
     //   $map  = array('status' => array('gt', -1), 'pid'=>$pid);
         $list = M('Repair')->select();
         $this->assign('list', $list);
          $this->meta_title = '保修管理';
         $this->display();
    }

    public function add(){
        if(IS_POST){
            $Repair = D('Repair');
            $data = $Repair->create();
            $Repair->num=uniqid();
           // var_dump($data);exit;
            if($data){
                $id = $Repair->add();
              //  var_dump($id);exit;
                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_channel', 'channel', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Repair->getError());
            }
        } else {
            $pid = i('get.pid', 0);
            //获取父导航
            if(!empty($pid)){
                $parent = M('Channel')->where(array('id'=>$pid))->field('title')->find();
                $this->assign('parent', $parent);
            }

            $this->assign('pid', $pid);
            $this->assign('info',null);
            $this->meta_title = '新增导航';
            $this->display('edit');
        }
    }

    public function edit($id = 0){
        if(IS_POST){
            $Repair = D('Repair');
            $data = $Repair->create();
            if($data){
                if($Repair->save()){
                    //记录行为
                    action_log('update_channel', 'channel', $data['id'], UID);
                    $this->success('编辑成功', U('index'));
                } else {
                    $this->error('编辑失败');
                }

            } else {
                $this->error($Repair->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Repair')->find($id);

            if(false === $info){
                $this->error('获取配置信息错误');
            }

            $pid = i('get.pid', 0);
            //获取父导航
            if(!empty($pid)){
                $parent = M('Repair')->where(array('id'=>$pid))->field('title')->find();
                $this->assign('parent', $parent);
            }

            $this->assign('pid', $pid);
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
        if(M('Repair')->where($map)->delete()){
            //记录行为
            action_log('update_channel', 'channel', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}