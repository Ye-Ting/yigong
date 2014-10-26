<?php
/**
 * The setpage view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
  <form id='ajaxForm' action="<?php echo inlink('setregion', "page={$page}&region={$region}&template={$template}");?>" method='post'>
    <div id='blockList'>
      <?php $key = 0; foreach($blocks as $block){ echo $this->block->createEntry($template, $block, $key); $key = $this->block->counter; $key ++;}?>
    </div>
    <div><?php echo html::submitButton();?></div>
  </form>
  <div class='hide'>
    <div id='entry'><?php echo $this->block->createEntry($template, null, 'key');?></div>
    <div id='child'><?php echo $this->block->createEntry($template, null, 'key', 2);?></div>
  </div>
</div>
<div class='modal-footer'>
<?php js::set('key', $key);?>
<?php include '../../common/view/footer.modal.html.php';?>
