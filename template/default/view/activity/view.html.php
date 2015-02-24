<?php
/**
 * The view file of activity view method of chanzhiEPS.
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
$path = !empty($category->pathNames) ? array_keys($category->pathNames) : array();
js::set('path', $path);
js::set('categoryID', $category->id);
js::set('activityID', $activity->id);
css::internal($activity->css);
js::execute($activity->js);
include TPL_ROOT . 'common/treeview.html.php';
?>
<?php
$root = '<li>' . $this->lang->currentPos . $this->lang->colon .  html::a($this->inlink('index'), $lang->activity->home) . '</li>';
$common->printPositionBar($category, $activity, '', $root);
?>
<div class='row'>
  <div class='col-md-12 col-main'>
    <div class='activity'>
      <header>
        <h1><?php echo $activity->title;?> 
        <a class="pull-right btn btn-primary" data-href='<?php echo $this->inlink('join') ?>'>
         <?php printf($lang->activity->lblEnrollBtn) ?>
        </a></h1>
        <dl class='dl-inline'>
          <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->activity->lblAddedDate, formatTime($activity->addedDate));?>'><i class="icon-time icon-large"></i> <?php echo formatTime($activity->addedDate);?></dd>
          <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->activity->lblAuthor, $activity->author);?>'><i class='icon-user icon-large'></i> <?php echo $activity->author; ?></dd>
          <?php if($activity->source and $activity->source != 'original'):?>
          <dt><?php echo $lang->activity->lblSource; ?></dt>
          <dd><?php $activity->copyURL ? print(html::a($activity->copyURL, $activity->copySite, "target='_blank'")) : print($activity->copySite); ?></dd>
          <?php endif; ?>
          <dd class='pull-right'>
            <?php
            if(!empty($this->config->oauth->sina))
            {
                $sina = json_decode($this->config->oauth->sina);
                if($sina->widget) echo "<div class='sina-widget'>" . $sina->widget . '</div>';
            }
            ?>
                <?php if($activity->source):?><span class='label label-success'><?php echo $lang->activity->sourceList[$activity->source]; ?></span><?php endif;?>
            <span class='label label-warning' data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->activity->lblViews, $activity->views);?>'><i class='icon-eye-open'></i> <?php echo $activity->views; ?></span>
          </dd>
        </dl>
        <?php if($activity->summary):?>
        <section class='abstract'><strong><?php echo $lang->activity->summary;?></strong><?php echo $lang->colon . $activity->summary;?></section>
        <?php endif; ?>
      </header>
      <section class='activity-content'>
        <?php echo $activity->content;?>
      </section>
      <section>
        <?php $this->loadModel('file')->printFiles($activity->files);?>
      </section>
      <footer>
        <?php if($activity->keywords):?>
        <p class='small'><strong class='text-muted'><?php echo $lang->activity->keywords;?></strong><span class='activity-keywords'><?php echo $lang->colon . $activity->keywords;?></span></p>
        <?php endif; ?>
        <?php extract($prevAndNext);?>
        <ul class='pager pager-justify'>
          <?php if($prev): ?>
          <li class='previous'><?php echo html::a(inlink('view', "id=$prev->id", "category={$category->alias}&name={$prev->alias}"), '<i class="icon-arrow-left"></i> ' . $prev->title); ?></li>
          <?php else: ?>
          <li class='preious disabled'><a href='###'><i class='icon-arrow-left'></i> <?php print($lang->activity->none); ?></a></li>
          <?php endif; ?>
          <?php if($next):?>
          <li class='next'><?php echo html::a(inlink('view', "id=$next->id", "category={$category->alias}&name={$next->alias}"), $next->title . ' <i class="icon-arrow-right"></i>'); ?></li>
          <?php else:?>
          <li class='next disabled'><a href='###'> <?php print($lang->activity->none); ?><i class='icon-arrow-right'></i></a></li>
          <?php endif; ?>
        </ul>
      </footer>
    </div>
    <div><?php // echo $this->fetch('activity', 'people', "activityID={$activity->id}");?> </div>

    <div id='commentBox'><?php echo $this->fetch('message', 'comment', "objectType=activity&objectID={$activity->id}");?></div>
  </div>
</div>
<?php include './footer.html.php';?>
