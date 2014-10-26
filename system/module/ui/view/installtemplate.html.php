<?php
/**
 * The upload view file of package module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @package     package
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<?php if(!empty($authorities)):?>
<div>
  <h3><?php echo $lang->ui->template->error->paths;?></h3>
  <pre><?php echo $authorities;?></pre>
  <h3><?php echo $lang->ui->template->commands->execute;?></h3>
  <pre><?php echo $commands;?></pre>
  <p><?php echo html::a('', $lang->ui->template->reload, "class='btn'");?></p>
</div>
<?php elseif(!$_FILES and empty($package)):?>
<form method='post' enctype='multipart/form-data' id='uploadForm' action='<?php echo inlink('installTemplate')?>'>
  <div class='input-group'>
    <input type='file' name='file' class='form-control' />
    <span class='input-group-btn'><?php echo html::submitButton($lang->ui->installTemplate);?></span>
  </div>
</form>
<?php endif;?>
<?php if(!empty($conflicts)):?>
<div class='alert alert-default'>
  <div>
    <?php printf($lang->ui->template->conflicts, $package);?>
    <?php echo html::a(inlink('installTemplate', "package={$package}&overridePackage=yes"), $lang->ui->template->override, "class='btn'");?>
    <?php echo html::a(inlink('installTemplate'), $lang->ui->template->reupload, "class='btn'");?>
  </div>
</div>
<?php endif;?>
<?php if(!empty($template) and !$installed):?>
<div class='alert alert-default'>
  <h4><?php echo $lang->ui->template->info;?></h4>
  <p><?php echo $lang->ui->template->name . $lang->colon . $template->name;?></p>
  <p><?php echo $lang->ui->template->author . $lang->colon . $template->author;?></p>
  <p><?php echo $lang->ui->template->chanzhiVersion . $lang->colon . $template->chanzhiVersion;?></p>
  <pre><?php echo $template->desc;?></pre>
  <p><?php echo html::a(inlink('installTemplate', "package={$package}&overridePackage=yes&install=yes"), $lang->ui->template->doInstall, "class='btn btn-primary'");?></p>
</div>
<?php endif;?>
<?php if($installed):?>
<div class='container'>
  <div class='modal-dialog w-450px'>
    <div class='modal-body'>
      <div class='alert alert-success text-center'><h4><?php echo $lang->ui->template->installSuccess;?></h4></div>
      <div class='text-center'>
        <?php echo html::a(inlink('settemplate'), $lang->ui->template->manageTemplate, "class='btn' target='_parent'");?>
        <?php echo html::a($this->createLink('block', 'admin', "template=$package"), $lang->ui->template->manageBlock, "target='_parent' class='btn'");?>
      </div>
    </div>
  </div>
</div>
<?php endif;?>
<?php include '../../common/view/footer.iframe.html.php';?>
