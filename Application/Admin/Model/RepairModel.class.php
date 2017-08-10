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
    protected $_auto = array(
        array('status', 1, self::MODEL_INSERT),
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        //array('num','uniqid()', self::MODEL_INSERT),
    );
}