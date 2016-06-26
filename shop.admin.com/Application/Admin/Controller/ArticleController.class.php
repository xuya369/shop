<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/25
 * Time: 13:00
 */

namespace Admin\Controller;

use Think\Controller;

class ArticleController extends Controller
{
    /**
     * @var null \Admin\Model\ArticleModel
     */
    private $_model = null;

    protected function _initialize()
    {
        $this->_model = D('Article');
    }

    // 显示文章列表
    public function index()
    {
        $rows = $this->_model->select();
        $this->assign('rows', $rows);
        $this->display();
    }

    // 添加文章
    public function add()
    {
        if (IS_POST) {
            if ($this->_model->create('', 'add') === false) {
                $this->error(get_error($this->_model));
            }
            if ($this->_model->addContent(I('post.')) === false) {
                $this->error(get_error($this->_model));
            }
            $this->success('添加文章成功', U('index'));
        } else {
            // 需要将文章分类的名称显示给用户
            $rows = $this->_model->getCategoryName();
            $this->assign('rows', $rows);
            $this->display('add');
        }
    }

    // 修改文章
    public function edit($id)
    {
        if (IS_POST) {
            if ($this->_model->create() === false) {
                $this->error(get_error($this->_model));
            }
            if ($this->_model->saveContent(I('post.')) === false) {
                $this->error(get_error($this->_model));
            }
            $this->success('更新成功', U('index'));

        } else {
            // 需要将以前的数据回显到表单上
            $row = $this->_model->find($id);
            $rows = $this->_model->getCategoryName();
            $this->assign($row);
            $this->assign('rows', $rows);

            // 还要讲内容表的数据回显到表单上
            $aticle_contentModel = D('ArticleContent');
            $contents = $aticle_contentModel->getContent($id);
            foreach ($contents as $content) {
            }
            // 将内容发送给模板
            $this->assign('content', $content);
            $this->display('add');
        }
    }

    // 删除文章
    public function remove($id){
        if($this->_model->deleteContent($id)===false){
            $this->error(get_error($this->_model));
        }else{
            $this->success('删除成功',U('index'));
        }
    }
}