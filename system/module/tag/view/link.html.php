<?php
/**
 * The link magange view file of tag of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan<guanxiying@xirangit.com>
 * @package     tag
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<form id='linkForm' class='form-horizontal' action='<?php echo inlink('link', "tageID={$tag->id}")?>'  method='post'>
  <div class='form-group'>
    <label for='link' class='col-xs-3 control-label'><?php echo $tag->tag;?></label>
    <div class='col-xs-8'>
      <?php echo html::input('link', $tag->link, "class='form-control' placeholder='{$lang->tag->inputLink}'");?>
    </div>
  </div>
  <div class='form-group'>
    <div class='col-xs-3'></div>
    <div class='col-xs-8'>
      <?php echo html::submitButton();?>
    </div>
  </div>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
