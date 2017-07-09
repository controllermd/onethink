<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/6
 * Time: 14:15
 */

namespace Admin\Model;
use Think\Model;

class PropertyModel extends Model
{
    protected $_validate = array(
        array('title', 'require', '标题不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('price', 'require', 'URL不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('tel', 'require', '手机号码不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('tel','/^1[34578]{1}\d{9}$/','手机号码格式不对',self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );
    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('status', '1', self::MODEL_BOTH),
    );
}