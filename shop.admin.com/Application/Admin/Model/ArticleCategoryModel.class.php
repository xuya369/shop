<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/25
 * Time: 11:08
 */

namespace Admin\Model;

use Think\Model;
use Think\Page;

class ArticleCategoryModel extends Model
{
    // 开启批量验证
    protected  $patchValidate = true;
    // 自动验证
    protected $_validate = [
        ['name','require','分类名不能为空'],
        ['name','','分类名称已经存在',self::EXISTS_VALIDATE,'unique','add'],
        ['sort','number','排序输入不合法'],
    ];

    // 获取分页数据
    public function getPage($cond){
        $page_setting = C('PAGE_SETTING');
        $count = $this->where($cond)->count();
        $page = new Page($count,$page_setting['PAGE_SIZE']);
        $page_html = $page->show();
        $page->setConfig('theme',$page_setting['PAGE_THEME']);
        // 获取分页代码
        $page_html = $page->show();
        // 获取分页数据
        $rows = $this->where($cond)->page(I('get.p',1),$page_setting['PAGE_SIZE'])->select();
        return compact(['rows','page_html']);
    }
}