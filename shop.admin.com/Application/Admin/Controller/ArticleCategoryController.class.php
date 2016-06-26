<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/25
 * Time: 10:53
 */

namespace Admin\Controller;

use Think\Controller;

class ArticleCategoryController extends Controller
{
    /**
     * @var \Admin\Model\ArticleCategoryModel
     */
    protected $_model;

    protected function _initialize()
    {
        $this->_model = D('ArticleCategory');
    }

    // 分类列表
    public function index()
    {
        $name = I('get.name');
        $cond['status'] = ['egt', 0];
        if(!empty($name)){
            $cond['name'] = ['like','%'.$name.'%'];
        }
        $rows = $this->_model->getPage($cond);
        $this->assign($rows);
        $this->display();
    }
    public function add(){
        if(IS_POST){
            if($this->_model->create('','add')===false){
                $this->error(get_error($this->_model));
            }
            if($this->_model->add()===false){
                $this->error(get_error($this->_model));
            }else{
                $this->success('添加成功',U('index'));
            }

        }else{
            $this->display();
        }
    }


    public function edit($id){
        if(IS_POST){
            if($this->_model->create()===false){
                $this->error(get_error($this->_model));
            }
            if($this->_model->save()===false){
                $this->error(get_error($this->_model));
            }else{
                $this->success('修改成功',U('index'));
            }

        }else{
            $row = $this->_model->find($id);
            $this->assign($row);
            $this->display('add');
        }
    }


    public function remove($id){
        $arr = [
            'id'=>$id,
            'status'=>-1,
            'name'=>['exp',"concat(name,'_del')"],
        ];
        if($this->_model->setField($arr)===false){
            $this->error(get_error($this->_model));
        }else{
            $this->success('删除成功',U('index'));
        }
    }
}