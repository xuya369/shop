<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/25
 * Time: 15:56
 */

namespace Admin\Model;
use Think\Model;

class ArticleContentModel extends Model
{
    public function getContent($id){
        $row = $this->select($id);
        return $row;
    }
}