<?php
/**
 * The install view file of package module of ChanZhiEPS.
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
<div id='titlebar'>
  <div class='heading'>
    <span class='prefix' title='EXTENSION'><?php echo html::icon($lang->icons['package']);?></span>
    <strong><?php echo $title;?></strong>
  </div>
</div>
<?php if($error):?>
<div class='alert alert-danger'>
  <i class='icon-info-sign'></i>
  <div class='content'>
    <h3><?php echo $lang->package->waringInstall;?></h3>
    <p><?php echo $error;?></p>
    <p class='text-center'><?php echo html::commonButton($lang->package->refreshPage, 'onclick=location.href=location.href');?></p>
  </div>
</div>
<?php endif;?>
</body>
</html>
