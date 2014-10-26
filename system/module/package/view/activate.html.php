<?php
/**
 * The deactivate view file of package module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @package     package
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php if(isset($error) and $error):?>
<div class='alert alert-danger'>
  <i class='icon-info-sign'></i>
  <div class='content'><?php $error;?></div>
</div>
<?php else:?>
<div class='alert alert-success'>
  <i class='icon-ok-sign'></i>
  <div class='content'>
    <h3><?php echo $title;?></h3>
    <p class='text-center'><?php echo html::a(inlink('browse', 'type=installed'), $lang->package->viewInstalled, "class='btn'");?></p>
  </div>
</div>
<?php endif;?>
<?php include '../../common/view/footer.modal.html.php';?>
