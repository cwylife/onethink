<?php
/**
 * Created by PhpStorm.
 * User: chenwenyue
 * Date: 2017/8/11
 * Time: 18:58
 */

namespace Home\Controller;



class RepairController extends HomeController
{
    public function index(){

        $this->display();
    }

    public function add(){
        if(IS_POST){
            $Repair = D('Repair');
            $data = $Repair->create();
            //$Repair->num=uniqid();
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
}