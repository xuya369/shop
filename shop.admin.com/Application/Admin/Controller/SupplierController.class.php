<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/24
 * Time: 13:35
 */

namespace Admin\Controller;

use Think\Controller;

class SupplierController extends Controller
{
    /**
     * @var \Admin\Model\SupplierModel
     */
    private $_model = null;

    protected function _initialize()
    {
        $this->_model = D('Supplier');
    }

    /**
     * 显示供货商列表页面
     */
    public function index()
    {
        $name = I('get.name');
        $condition['status']=['egt',0];
        if($name){
            $condition['name'] = ['like','%'.$name.'%'];
        }

        $rows = $this->_model->getPage($condition);
        $this->assign($rows);
        // 选择模板
        $this->display('index');
    }

    // 添加供货商
    public function add()
    {
        if (IS_POST) {
            // 收集表单数据,如果收集表单数据失败
            if ($this->_model->create('', 'add') === false) {
                $this->error(get_error($this->_model));
            }
            // 添加数据
            if ($this->_model->add() === false) {
                $this->error(get_error($this->_model));
            } else {
                $this->success('添加成功', U('index'));
            }
        } else {
            // 调用视图
            $this->display('add');
        }
    }

    // 修改供应商
    public function edit($id)
    {
        if (IS_POST) {
            // 收集数据并判断
            if ($this->_model->create() === false) {
                $this->error(get_error($this->_model));
            }
            if ($this->_model->save() === false) {
                $this->error(get_error($this->_model));
            }
            $this->success('修改成功', U('index'));
        } else {
            $row = $this->_model->find($id);
            $this->assign($row);
            $this->display('add');
        }
    }

    // 删除供应商 逻辑删除，删除的同时修改供应商的名字
    public function remove($id)
    {
        $data = [
            'id' => $id,
            'status' => -1,
            'name' => ['exp', 'concat(name,"_del")'],
        ];
        if ($this->_model->setField($data) === false) {
            $this->error(get_error($this->_model));
        } else {
            $this->success('删除成功', U('index'));
        }
    }
}