<?php
/**
 * Created by PhpStorm.
 * User: chenwenyue
 * Date: 2017/8/10
 * Time: 14:25
 */

namespace Admin\Controller;


class EstateController extends  AdminController
{
    /**
     * 保修管理
     */
    public function manage(){
        $nickname       =   I('nickname');
        $map['status']  =   array('egt',0);
        if(is_numeric($nickname)){
            $map['uid|nickname']=   array(intval($nickname),array('like','%'.$nickname.'%'),'_multi'=>true);
        }else{
            $map['nickname']    =   array('like', '%'.(string)$nickname.'%');
        }

        $list   = $this->lists('Member', $map);
        int_to_string($list);
        $this->assign('_list', $list);
        $this->meta_title = '用户信息';
        $this->display();
    }

}