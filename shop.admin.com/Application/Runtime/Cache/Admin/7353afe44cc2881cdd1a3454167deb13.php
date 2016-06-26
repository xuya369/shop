<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>品牌--管理中心</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://shop.admin.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://shop.admin.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://shop.admin.com/Public/Admin/css/page.css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('add');?>">添加品牌</a></span>
    <span class="action-span1"><a href="#">管理中心--></a></span>
    <span id="search_id" class="action-span1">品牌</span>
    <div style="clear:both"></div>
</h1>
<div class="form-div">
    <form action="<?php echo U();?>" name="searchForm">
    <img src="http://shop.admin.com/Public/Admin/images/icon_search.gif" width="26" height="22" border="0" alt="search" />
    <input type="text" name="keyWord" size="15" value="<?php echo I('get.keyWord');?>" />
    <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>品牌名称</th>
                <th>简介</th>
                <th>排序</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr>
                    <td align="center" class="first-cell"><?php echo ($row["name"]); ?></td>
                    <td align="center"><?php echo ($row["intro"]); ?></td>
                    <td align="center"><?php echo ($row["sort"]); ?></td>
                    <td align="center">
                        <?php if($row["status"] == 1): ?><img src="http://shop.admin.com/Public/Admin/images/yes.gif"/><?php else: ?><img src="http://shop.admin.com/Public/Admin/images/no.gif"/><?php endif; ?>
                    </td>
                    <td align="center">
                    <a href="<?php echo U('edit',['id'=>$row['id']]);?>" title="编辑">编辑</a> |
                    <a href="<?php echo U('remove',['id'=>$row['id']]);?>" title="删除" onclick="return confirm('你确定要删除么？')">移除</a>
                    </td>
                </tr><?php endforeach; endif; ?>
            <tr>
                <td align="right" nowrap="true" colspan="6">
                    <div id="turn-page" class="page">
                        <?php echo ($page_html); ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>

<div id="footer">
共执行 3 个查询，用时 0.021251 秒，Gzip 已禁用，内存占用 2.194 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>