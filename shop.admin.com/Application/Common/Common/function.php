<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/24
 * Time: 17:30
 */
function get_error(\Think\Model $model)
{
    // 获取错误信息
    $errors = $model->getError();
    if(!is_array($errors)){
        $errors = [$errors];
    }
    $html = '<ol>';
    foreach ($errors as $error) {
        $html.='<li>'.$error.'</li>';
    }
    $html .='</ol>';
    return $html;
}