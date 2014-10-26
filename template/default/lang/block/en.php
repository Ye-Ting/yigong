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
$lang->block->default->typeList['html']     = 'Html block';
$lang->block->default->typeList['htmlcode'] = 'Html codes';
$lang->block->default->typeList['phpcode']  = 'php codes';

$lang->block->default->typeList['latestArticle'] = 'Latest Articles';
$lang->block->default->typeList['hotArticle']    = 'Hot Articles';

$lang->block->default->typeList['latestProduct']   = 'Latest Products';
$lang->block->default->typeList['featuredProduct'] = 'Featured Products';
$lang->block->default->typeList['hotProduct']      = 'Hot Products';

$lang->block->default->typeList['articleTree'] = 'Article Categories';
$lang->block->default->typeList['productTree'] = 'Product Categories';
$lang->block->default->typeList['blogTree']    = 'Blog Categories';

$lang->block->default->typeList['contact']  = 'Contact Us';
$lang->block->default->typeList['followUs'] = 'Follow Us';
$lang->block->default->typeList['about']    = 'About Us';
$lang->block->default->typeList['links']    = 'Links';
$lang->block->default->typeList['slide']    = 'Slide';
$lang->block->default->typeList['header']   = 'Header';

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

$lang->block->default->pages['all']            = 'All';
$lang->block->default->pages['index_index']    = 'Home';
$lang->block->default->pages['company_index']  = 'About Us';

$lang->block->default->pages['article_browse'] = 'Browse article page';
$lang->block->default->pages['article_view']   = 'View article page';

$lang->block->default->pages['product_browse'] = 'Browse product page';
$lang->block->default->pages['product_view']   = 'View product page';

$lang->block->default->pages['blog_index']     = 'Browse blog page';
$lang->block->default->pages['blog_view']      = 'View blog page';

$lang->block->default->pages['forum_index']    = 'Forum home';
$lang->block->default->pages['forum_board']    = 'Forum board';
$lang->block->default->pages['thread_view']    = 'View thread';
$lang->block->default->pages['search_list']    = 'Search';

$lang->block->default->pages['book_index']     = 'Book';
$lang->block->default->pages['book_browse']    = 'Book catalogue';
$lang->block->default->pages['book_read']      = 'Book content';

$lang->block->default->pages['message_index']  = 'Inquire';

$lang->block->default->pages['page_view']      = 'Page';

/* page layou>default-> list. */
$lang->block->default->regions = new stdclass();
$lang->block->default->regions->all['header'] = 'Header(invisible)';
$lang->block->default->regions->all['top']    = 'Top';
$lang->block->default->regions->all['bottom'] = 'Bottom';
$lang->block->default->regions->all['footer'] = 'Footer(invisible)';

$lang->block->default->regions->index_index['top']     = 'Top';
$lang->block->default->regions->index_index['middle']  = 'Middle';
$lang->block->default->regions->index_index['bottom']  = 'Bottom';

$lang->block->default->regions->company_index['side']  = 'Side';

$lang->block->default->regions->article_browse['side'] = 'Side';
$lang->block->default->regions->article_view['side']   = 'Side';

$lang->block->default->regions->product_browse['side'] = 'Side';
$lang->block->default->regions->product_view['side']   = 'Side';

$lang->block->default->regions->blog_index['side']     = 'Side';
$lang->block->default->regions->blog_view['side']      = 'Side';

$lang->block->default->regions->forum_index['top']     = 'Top';
$lang->block->default->regions->forum_index['bottom']  = 'Bottom';
$lang->block->default->regions->forum_board['top']     = 'Top';
$lang->block->default->regions->forum_board['bottom']  = 'Bottom';
$lang->block->default->regions->thread_view['top']     = 'Top';
$lang->block->default->regions->thread_view['bottom']  = 'Bottom';

$lang->block->default->regions->book_browse['side']    = 'Side';
$lang->block->default->regions->book_read['top']       = 'Top';
$lang->block->default->regions->book_read['bottom']    = 'Bottom';

$lang->block->default->regions->message_index['side']  = 'Side';

$lang->block->default->regions->page_view['side']      = 'Side';
