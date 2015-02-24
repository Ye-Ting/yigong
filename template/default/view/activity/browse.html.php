<?php
/**
 * The index view file of activity module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     activity
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php 
// include './header.html.php';
include TPL_ROOT . 'common/header.html.php'; 
include TPL_ROOT . 'common/treeview.html.php';
if(isset($category)) $path = array_keys($category->pathNames);
if(!empty($path))         js::set('path',  $path);
if(!empty($category->id)) js::set('categoryID', $category->id);
?>
<?php
$root = '<li>' . $this->lang->currentPos . $this->lang->colon .  html::a($this->inlink('index'), $lang->activity->home) . '</li>';
if(!empty($category)) echo $common->printPositionBar($category, '', '', $root);
?>
<div class='row'>
  <div class='col-md-12 col-main' id='activitys'>
    <?php foreach($activitys as $activity):?>
    <?php if(!isset($category)) $category = array_shift($activity->categories);?>
      <?php $url = inlink('view', "id=$activity->id", "category={$category->alias}&name=$activity->alias"); ?>
      <div class="card">
        <h4 class='card-heading'><?php echo html::a($url, $activity->title);?>
        <a class="pull-right btn btn-primary join-activity-btn" style="color:#fff;" data-a='<?php echo $activity->id ?>'>
         <?php printf($lang->activity->lblEnrollBtn) ?>
        </a>
        </h4>
        <div class='card-content text-muted'>
          <?php if(!empty($activity->image)):?>
            <div class='media pull-right'>
              <?php
              $title = $activity->image->primary->title ? $activity->image->primary->title : $activity->title;
              echo html::a($url, html::image($activity->image->primary->smallURL, "title='{$title}' class='thumbnail'" ));
              ?>
            </div>
          <?php endif;?>
          <?php echo $activity->summary;?>
        </div>
        <div class="card-actions text-muted">
          <span data-toggle='tooltip' title='<?php printf($lang->activity->lblActivityDate, formatTime($activity->activityDate));?>'><i class="icon-time"></i> 活动时间: <?php echo date('Y/m/d', strtotime($activity->activityDate));?></span>
          &nbsp; <span data-toggle='tooltip' title='<?php printf($lang->activity->lblAuthor, $activity->author);?>'><i class="icon-user"></i> <?php echo $activity->author;?></span>
          &nbsp; <span data-toggle='tooltip' title='<?php printf($lang->activity->lblViews, $activity->views);?>'><i class="icon-eye-open"></i> <?php echo $activity->views;?></span>
          <!-- &nbsp; <a href="<?php echo $url . '#commentForm'?>"><span data-toggle='tooltip' title='<?php printf($lang->activity->lblComments, $activity->comments);?>'><i class="icon-comments-alt"></i> <?php echo $activity->comments;?></span></a> -->
        </div>
      </div>
    <?php endforeach;?>
    <div class='clearfix pager'><?php $pager->show('right', 'short');?></div>
  </div>
 <!--  <div class='col-md-3 col-side'><side class='page-side'><div class='panel-pure panel'><?php echo html::a(helper::createLink('rss', 'index', '?type=activity', '', 'xml'), "<i class='icon-rss text-warning'></i> " . $lang->activity->subscribe, "target='_blank' class='btn btn-lg btn-block'"); ?></div><?php $this->block->printRegion($layouts, 'activity_index', 'side');?></side></div> -->
</div>
<?php include './footer.html.php';?>
