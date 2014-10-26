<?php
/**
 * The post view file of thread module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     thread
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php include TPL_ROOT . 'common/kindeditor.html.php';?>

<?php $common->printPositionBar($board);?>

<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-edit'></i> <?php echo $lang->thread->postTo . ' [ ' . $board->name . ' ]'; ?></strong></div>
  <div class='panel-body'>
    <form method='post' class='form-horizontal' id='threadForm' enctype='multipart/form-data'>
      <div class='form-group'>
        <label class='col-md-1 col-sm-2 control-label'><?php echo $lang->thread->title;?></label>
        <div class='col-md-11 col-sm-10'>
        <?php if($canManage):?>
          <div class='input-group'>
            <?php echo html::input('title', '', "class='form-control'");?>
            <?php if($this->app->user->admin == 'super'):?>
            <span class='input-group-addon'>
              <label class='checkbox'>
                <?php echo "<input type='checkbox' name='isLink' id='isLink' value='1'/><span>{$lang->thread->isLink}</span>" ?>
              </label>
            </span>
            <?php endif;?>
            <span class='input-group-addon threadInfo'>
              <label class='checkbox'>
                <?php echo "<input type='checkbox' name='readonly' value='1'/><span>{$lang->thread->readonly}</span>" ?>
              </label>
            </span>
          </div>
        <?php else:?>
          <?php echo html::input('title', '', "class='form-control'");?>
        <?php endif;?>
        </div>
      </div>
      <div class='threadInfo'>
        <div class='form-group'>
          <label class='col-md-1 col-sm-2 control-label'><?php echo $lang->thread->content;?></label>
          <div class='col-md-11 col-sm-10'><?php echo html::textarea('content', '', "rows='15' class='form-control'");?></div>
        </div>
        <?php if($this->loadModel('file')->canUpload()):?>
        <div class='form-group'>
          <label class='col-md-1 col-sm-2 control-label'><?php echo $lang->thread->file;?></label>
          <div class='col-md-7 col-sm-8 col-xs-11'><?php echo $this->fetch('file', 'buildForm');?></div>
        </div>
        <?php endif;?>
        <div class='form-group hiding' id='captchaBox'></div>
      </div>
      <?php if($this->app->user->admin == 'super'):?>
      <div class='form-group link'>
        <label class='col-md-1 col-sm-2 control-label'><?php echo $lang->thread->link;?></label>
        <div class='col-md-11 col-sm-10 required'><?php echo html::input('link', '', "class='form-control' placeholder='{$lang->thread->placeholder->link}'");?></div>
      </div>
      <?php endif;?>
      <div class='form-group'>
        <label class='col-md-1 col-sm-2'></label>
        <div class='col-md-11 col-sm-10'><?php echo html::submitButton();?></div>
      </div>
    </form>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
