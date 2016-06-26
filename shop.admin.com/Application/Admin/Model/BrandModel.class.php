<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/25
 * Time: 9:32
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;
class BrandModel extends Model
{
    // 开启批量验证
    protected $patchValidate = true;
    // 自动验证
    protected $_validate=[
        ['name','require','品牌名字不能为空'],
        ['name', '', '品牌已经存在', self::EXISTS_VALIDATE, 'unique', 'add'],
        ['sort','number','排序必须为数字'],
    ];
    // 获取分页数据
    public function getPage($condition){
        $pageConfig = C('PAGE_SETTING');
        $count = $this->where($condition)->count();
        $page = new Page($count,$pageConfig['PAGE_SIZE']);
        // 设置样式
        $page->setConfig('theme',$pageConfig['PAGE_THEME']);
        // 获取分页代码
        $page_html = $page->show();
        // 获取分页数据
        $rows = $this->where($condition)->page(I('get.p',1),$pageConfig['PAGE_SIZE'])->select();
        return compact(['rows','page_html']);
    }
}