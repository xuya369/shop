<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/24
 * Time: 18:27
 */

namespace Admin\Model;

use Think\Model;
use Think\Page;

class SupplierModel extends Model
{
    // 开启批量认证
    protected $patchValidate = true;
    /**
     * 供应商名称：必填，唯一
     * 排序 sort 必须为数字
     * 状态 status 0或1
     */
    protected $_validate = [
        ['name', 'require', '供应商名字不能为空'],
        ['name', '', '供应商已经存在', self::EXISTS_VALIDATE, 'unique', 'add'],
        ['sort', 'number', '排序必须为数字'],
        ['status', '0,1', '供货商状态不合法', self::EXISTS_VALIDATE, 'in'],
    ];

    public function getPage(array $conditon = [])
    {
        // 获取配置文件内容
        $page_setting = C('PAGE_SETTING');
        // 获取数据总条数
        $count = $this->where($conditon)->count();
        $page = new Page($count, $page_setting['PAGE_SIZE']);
        // 设置样式，显示总条数
        $page->setConfig('theme', $page_setting['PAGE_THEME']);
        $page_html = $page->show();
        // 获取分页数据
        $rows = $this->where($conditon)->page(I('get.p', 1), $page_setting['PAGE_SIZE'])->select();
        return compact(['rows', 'page_html']);
    }
}