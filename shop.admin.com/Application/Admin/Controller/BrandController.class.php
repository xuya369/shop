<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/25
 * Time: 9:08
 */

namespace Admin\Controller;

use Think\Controller;

class BrandController extends Controller
{
    // 属性保存模型对象
    protected $_model = null;

    protected function _initialize()
    {
        $this->_model = D('Brand');
    }

    public function index()
    {
        $name = I('get.keyWord');
        // 品牌状态为大于等于0，才显示
        $condition['status'] = ['egt',0];
        if($name){
            $condition['name'] = ['like', '%' . $name . '%'];
        }
        // 查询数据，显示到页面
        $rows = $this->_model->getPage($condition);
        // 发送给模板
        $this->assign($rows);
        $this->display();
    }

    // 添加品牌
    public function add()
    {
        if (IS_POST) {
            // 获取表单提交数据
            if ($this->_model->create('', 'add') === false) {
                $this->error(get_error($this->_model));
            }
            if ($this->_model->add() === false) {
                $this->error(get_error($this->_model));
            } else {
                $this->success('添加成功', U('index'));
            }
        } else {
            $this->display('add');
        }
    }

    // 修改品牌
    public function edit($id)
    {
        if (IS_POST) {
            // post提交修改数据
            if ($this->_model->create() === false) {
                $this->error(get_error($this->_model));
            }
            if ($this->_model->save() === false) {
                $this->error(get_error($this->_model));
            }
            $this->success('修改成功', U('index'));
        } else {
            // 需要将品牌信息回显到修改页面
            $row = $this->_model->find($id);
            $this->assign($row);
            $this->display('add');
        }
    }

    /**
     * 删除方法，删除品牌为逻辑删除，修改商品状态为-1,并且修改品牌名字
     * 删除后不在列表显示，所以需要修改品牌名称，从而不影响添加新的品牌
     */
    public function remove($id){
        $data = [
            'id'=>$id,
            'status'=>-1,
            'name'=>['exp','concat(name,"_del")']
        ];
        $result = $this->_model->setField($data);
        if($result===false){
            $this->error(get_error($this->_model));
        }else{
            $this->success('删除成功',U('index'));
        }
    }
}