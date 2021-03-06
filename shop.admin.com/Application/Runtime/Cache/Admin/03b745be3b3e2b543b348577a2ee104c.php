<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>ECSHOP 管理中心 - 添加品牌 </title>
        <meta name="robots" content="noindex, nofollow"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="http://shop.admin.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
        <link href="http://shop.admin.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1>
            <span class="action-span"><a href="<?php echo U('index');?>">品牌列表</a></span>
            <span class="action-span1"><a href="#"> 管理中心</a></span>
            <span id="search_id" class="action-span1"> - 添加品牌 </span>
        </h1>
        <div style="clear:both"></div>
        <div class="main-div">
            <form method="post" action="<?php echo U();?>" enctype="multipart/form-data" >
                <table cellspacing="1" cellpadding="3" width="100%">
                    <tr>
                        <td class="label">品牌名称</td>
                        <td>
                            <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>" />
                            <span class="require-field">*</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">品牌描述</td>
                        <td>
                            <textarea  name="intro" cols="60" rows="4"><?php echo ($intro); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">排序</td>
                        <td>
                            <input type="text" name="sort" maxlength="40" size="15" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):50); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="label">是否显示</td>
                        <td>
                            <input type="radio" name="status" value="1" class="status"/> 是
                            <input type="radio" name="status" value="0" class="status" /> 否(首页及分类页的品牌商区将不会显示该品牌。)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><br />
                            <input type="hidden" name="id" value="<?php echo ($id); ?>" />
                            <input type="submit" class="button" value=" 确定 " />
                            <input type="reset" class="button" value=" 重置 " />
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <div id="footer">
            共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br />
            版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
        </div>
    <script type="text/javascript" src="http://shop.admin.com/Public/Admin/js/jquery.min.js"></script>
    <script type='text/javascript'>
        $(function(){
            //回显供应商状态
            $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);
        });
    </script>
    </body>
</html>