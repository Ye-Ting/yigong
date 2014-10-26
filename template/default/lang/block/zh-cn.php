<?php
/**
 * The block module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->block->default = new stdclass();
$lang->block->default->typeList['html']     = '自定义区块';
$lang->block->default->typeList['htmlcode'] = 'html源代码';
$lang->block->default->typeList['phpcode']  = 'php源代码';

$lang->block->default->typeList['latestArticle']   = '最新文章';
$lang->block->default->typeList['hotArticle']      = '热门文章';

$lang->block->default->typeList['latestProduct']   = '最新产品';
$lang->block->default->typeList['featuredProduct'] = '首页推荐产品';
$lang->block->default->typeList['hotProduct']      = '热门产品';

$lang->block->default->typeList['articleTree']     = '文章分类';
$lang->block->default->typeList['productTree']     = '产品分类';
$lang->block->default->typeList['blogTree']        = '博客分类';

$lang->block->default->typeList['contact']         = '联系我们';
$lang->block->default->typeList['followUs']        = '关注我们';
$lang->block->default->typeList['about']           = '公司简介';
$lang->block->default->typeList['links']           = '友情链接';
$lang->block->default->typeList['slide']           = '幻灯片';
$lang->block->default->typeList['header']          = '网站头部';

$lang->block->default->typeGroups = array();
$lang->block->default->typeGroups['html']     = 'input';
$lang->block->default->typeGroups['htmlcode'] = 'input';
$lang->block->default->typeGroups['phpcode']  = 'input';

$lang->block->default->typeGroups['latestArticle'] = 'article';
$lang->block->default->typeGroups['hotArticle']    = 'article';

$lang->block->default->typeGroups['latestProduct']   = 'product';
$lang->block->default->typeGroups['featuredProduct'] = 'product';
$lang->block->default->typeGroups['hotProduct']      = 'product';

$lang->block->default->typeGroups['articleTree'] = 'category';
$lang->block->default->typeGroups['productTree'] = 'category';
$lang->block->default->typeGroups['blogTree']    = 'category';

$lang->block->default->typeGroups['contact']  = 'system';
$lang->block->default->typeGroups['followUs'] = 'system';
$lang->block->default->typeGroups['about']    = 'system';
$lang->block->default->typeGroups['links']    = 'system';
$lang->block->default->typeGroups['slide']    = 'system';
$lang->block->default->typeGroups['header']   = 'system';

$lang->block->default->pages['all']            = '全部页面';
$lang->block->default->pages['index_index']    = '首页';
$lang->block->default->pages['company_index']  = '关于我们';

$lang->block->default->pages['article_browse'] = '文章列表页面';
$lang->block->default->pages['article_view']   = '文章详情页面';

$lang->block->default->pages['product_browse'] = '产品列表页面';
$lang->block->default->pages['product_view']   = '产品详情页面';

$lang->block->default->pages['blog_index']     = '博客列表页面';
$lang->block->default->pages['blog_view']      = '博客详情页面';

$lang->block->default->pages['forum_index']    = '论坛首页';
$lang->block->default->pages['forum_board']    = '帖子列表页面';
$lang->block->default->pages['thread_view']    = '帖子查看页面';
$lang->block->default->pages['search_list']    = '搜索结果页';

$lang->block->default->pages['book_index']     = '手册中心';
$lang->block->default->pages['book_browse']    = '手册首页';
$lang->block->default->pages['book_read']      = '手册章节';

$lang->block->default->pages['message_index']  = '留言';

$lang->block->default->pages['page_view']      = '单页';

/* page layout list. */
$lang->block->default->regions = new stdclass();
$lang->block->default->regions->all['header'] = 'Header(不可见)';
$lang->block->default->regions->all['top']    = '页头';
$lang->block->default->regions->all['bottom'] = '页尾';
$lang->block->default->regions->all['footer'] = 'Footer(不可见)';

$lang->block->default->regions->index_index['top']     = '上部';
$lang->block->default->regions->index_index['middle']  = '中部';
$lang->block->default->regions->index_index['bottom']  = '底部';

$lang->block->default->regions->company_index['side']  = '侧边';

$lang->block->default->regions->article_browse['side'] = '侧边';
$lang->block->default->regions->article_view['side']   = '侧边';

$lang->block->default->regions->product_browse['side'] = '侧边';
$lang->block->default->regions->product_view['side']   = '侧边';

$lang->block->default->regions->blog_index['side']     = '侧边';
$lang->block->default->regions->blog_view['side']      = '侧边';

$lang->block->default->regions->forum_index['top']     = '上部';
$lang->block->default->regions->forum_index['bottom']  = '底部';
$lang->block->default->regions->forum_board['top']     = '上部';
$lang->block->default->regions->forum_board['bottom']  = '底部';
$lang->block->default->regions->thread_view['top']     = '上部';
$lang->block->default->regions->thread_view['bottom']  = '底部';

$lang->block->default->regions->book_browse['side']    = '侧边';
$lang->block->default->regions->book_read['top']       = '上部';
$lang->block->default->regions->book_read['bottom']    = '底部';

$lang->block->default->regions->message_index['side']  = '侧边';

$lang->block->default->regions->page_view['side']      = '侧边';
