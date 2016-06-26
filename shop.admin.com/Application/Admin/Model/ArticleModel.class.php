<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/25
 * Time: 13:22
 */

namespace Admin\Model;

use Think\Model;

class ArticleModel extends Model
{
    // 开启批量认证
    protected $patchValidate = true;
    protected $_validate = [
        ['name', 'require', '文章标题不能为空'],
        ['name', '', '品牌已经存在', self::EXISTS_VALIDATE, 'unique', 'add'],
        ['sort', 'number', '排序必须为数字'],
//        ['article_category_id',0, '请选择一个文章分类', self::EXISTS_VALIDATE, 'equal']
    ];

    // 获取分类名字
    public function getCategoryName()
    {
        $category_model = D('ArticleCategory');
        $rows = $category_model->where(['status' => ['egt', 0]])->select();
        return $rows;
    }

    public function addContent($content)
    {
        /**
         * $content 为所有post提交的所有数据
         * $this->data 存放的是文章表的数据
         */
        $article_id = $this->add();
        if ($article_id === false) {
            return false;
        }
        $data = [];
        $article_content = $content['content'];
        $data[] = ['article_id' => $article_id, 'content' => $article_content];
        if (!empty($data)) {
            $article_contentModel = M('ArticleContent');
            $re = $article_contentModel->addAll($data);
            if ($re === false) {
                return false;
            }
        }
    }

    public function saveContent($requestData)
    {
        $result = $this->save();
        if ($result === false) {
            return false;
        }
        $data = [
            'article_id' => $requestData['id'],
            'content' => $requestData['content']
        ];
        $article_contentModel = M('ArticleContent');
        $re = $article_contentModel->save($data);
        if ($re === false) {
            return false;
        }
        return true;
    }

    public function deleteContent($id){
        if($this->delete($id)===false){
            return false;
        }
        // 删除文章的同时删除内容
        $articleContentModel = M('ArticleContent');
        $re = $articleContentModel->delete($id);
        if($re===false){
            return false;
        }
        return true;
    }
}