<?php
/**
 * Created by PhpStorm.
 * User: chenwenyue
 * Date: 2017/8/10
 * Time: 15:02
 */

namespace Admin\Model;


use Think\Model;

class RepairModel extends Model
{
//    protected $patchValidate = true;
    protected $_auto = array(
        array('status', 1, self::MODEL_INSERT),
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('num','uniqid', self::MODEL_INSERT,'function'),
    );

    protected $_validate = array(
//        array("name"=>'报修人不能为空','tel'=>'手机号码不能为空','require',self::MUST_VALIDATE ,self::MODEL_INSERT),
        array('name', 'require', '报修人不能为空', self::MUST_VALIDATE ,self::MODEL_INSERT),
        array('tel', 'require', '手机号码不能为空', self::MUST_VALIDATE,self::MODEL_BOTH),
//        array('tel','/^(0|86|17951)?(13[0-9]|15[012356789]|18[0-9]|14[57])[0-9]{8}$/', '手机号码错误', self::MUST_VALIDATE,'regex',self::MODEL_BOTH),
        array('address', 'require', '地址不能为空', self::MUST_VALIDATE, self::MODEL_BOTH),
        array('question', 'require', '问题不能为空', self::MUST_VALIDATE, self::MODEL_BOTH),
        array('content', 'require', '内容不能为空', self::MUST_VALIDATE, self::MODEL_BOTH),
    );

}