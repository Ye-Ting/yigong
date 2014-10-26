<?php
/**
 * The block module zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青島息壤網絡信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->block->default = new stdclass();
$lang->block->default->typeList['html']    = '自定義區塊';
$lang->block->default->typeList['code']    = '原始碼';
$lang->block->default->typeList['phpcode'] = 'php原始碼';

$lang->block->default->typeList['latestArticle']   = '最新文章';
$lang->block->default->typeList['hotArticle']      = '熱門文章';

$lang->block->default->typeList['latestProduct']   = '最新產品';
$lang->block->default->typeList['featuredProduct'] = '首頁推薦產品';
$lang->block->default->typeList['hotProduct']      = '熱門產品';

$lang->block->default->typeList['articleTree']     = '文章分類';
$lang->block->default->typeList['productTree']     = '產品分類';
$lang->block->default->typeList['blogTree']        = '博客分類';

$lang->block->default->typeList['contact']         = '聯繫我們';
$lang->block->default->typeList['about']           = '公司簡介';
$lang->block->default->typeList['links']           = '友情連結';
$lang->block->default->typeList['slide']           = '幻燈片';
$lang->block->default->typeList['header']          = '網站頭部';

$lang->block->default->typeGroups = array();
$lang->block->default->typeGroups['html']    = 'input';
$lang->block->default->typeGroups['code']    = 'input';
$lang->block->default->typeGroups['phpcode'] = 'input';

$lang->block->default->typeGroups['latestArticle'] = 'article';
$lang->block->default->typeGroups['hotArticle']    = 'article';

$lang->block->default->typeGroups['latestProduct']   = 'product';
$lang->block->default->typeGroups['featuredProduct'] = 'product';
$lang->block->default->typeGroups['hotProduct']      = 'product';

$lang->block->default->typeGroups['articleTree'] = 'category';
$lang->block->default->typeGroups['productTree'] = 'category';
$lang->block->default->typeGroups['blogTree']    = 'category';

$lang->block->default->typeGroups['contact'] = 'system';
$lang->block->default->typeGroups['about']   = 'system';
$lang->block->default->typeGroups['links']   = 'system';
$lang->block->default->typeGroups['slide']   = 'system';
$lang->block->default->typeGroups['header']  = 'system';

$lang->block->default->pages['all']            = '全部頁面';
$lang->block->default->pages['index_index']    = '首頁';

$lang->block->default->pages['article_browse'] = '文章列表頁面';
$lang->block->default->pages['article_view']   = '文章詳情頁面';

$lang->block->default->pages['product_browse'] = '產品列表頁面';
$lang->block->default->pages['product_view']   = '產品詳情頁面';

$lang->block->default->pages['blog_index']     = '博客列表頁面';
$lang->block->default->pages['blog_view']      = '博客詳情頁面';

$lang->block->default->pages['forum_index']    = '論壇首頁';
$lang->block->default->pages['forum_board']    = '帖子列表頁面';
$lang->block->default->pages['thread_view']    = '帖子查看頁面';
$lang->block->default->pages['search_list']    = '搜索結果頁';

$lang->block->default->pages['book_index']     = '手冊中心';
$lang->block->default->pages['book_browse']    = '手冊首頁';
$lang->block->default->pages['book_read']      = '手冊章節';

$lang->block->default->pages['message_index']  = '留言';

$lang->block->default->pages['page_view']      = '單頁';

/* page layou>default-> list. */
$lang->block->default->regions = new stdclass();
$lang->block->default->regions->all['start']  = '開始部分';
$lang->block->default->regions->all['header'] = '頭部';
$lang->block->default->regions->all['footer'] = '底部';
$lang->block->default->regions->all['end']    = '結束部分';

$lang->block->default->regions->index_index['header']  = '上部';
$lang->block->default->regions->index_index['middle']  = '中部';
$lang->block->default->regions->index_index['footer']  = '底部';

$lang->block->default->regions->article_browse['side'] = '側邊';
$lang->block->default->regions->article_view['side']   = '側邊';

$lang->block->default->regions->product_browse['side'] = '側邊';
$lang->block->default->regions->product_view['side']   = '側邊';

$lang->block->default->regions->blog_index['side']     = '側邊';
$lang->block->default->regions->blog_view['side']      = '側邊';

$lang->block->default->regions->forum_index['header']  = '上部';
$lang->block->default->regions->forum_board['header']  = '上部';
$lang->block->default->regions->thread_view['header']  = '上部';
$lang->block->default->regions->forum_index['footer']  = '下部';
$lang->block->default->regions->forum_board['footer']  = '下部';
$lang->block->default->regions->thread_view['footer']  = '下部';

$lang->block->default->regions->book_browse['side']    = '側邊';
$lang->block->default->regions->book_read['header']    = '上部';
$lang->block->default->regions->book_read['footer']    = '下部';

$lang->block->default->regions->message_index['side']  = '側邊';

$lang->block->default->regions->page_view['side']      = '側邊';
