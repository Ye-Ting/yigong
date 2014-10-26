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
<?php include '../../common/view/header.modal.html.php';?>
<form method='post' enctype='multipart/form-data' id='uploadForm' action='<?php echo inlink('upload')?>'>
  <div class='input-group'>
    <input type='file' name='file' class='form-control' />
    <span class='input-group-btn'><?php echo html::submitButton($lang->package->install);?></span>
  </div>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
