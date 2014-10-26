<?php
/**
 * The wechat qrcode front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license 
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
$block->content = json_decode($block->content);
$publicList = $this->loadModel('wechat')->getList();
?>
<?php if(!empty($publicList)):?>
<div id="block<?php echo $block->id;?>" class='panel panel-block hidden-sm hidden-xs <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <strong><?php echo $block->title;?></strong>
    <?php if(!empty($block->content->moreText) and !empty($block->content->moreUrl)):?>
    <div class='pull-right'><?php echo html::a($block->content->moreUrl, $block->content->moreText);?></div>
    <?php endif;?>
  </div>
  <table class='w-p100'>
    <?php foreach($publicList as $public):?>
    <?php if(!$public->qrcode) continue;?>
    <tr class='text-center'>
      <td class='wechat-block'>
        <div class='name'><i class='icon-weixin'>&nbsp;</i><?php echo $public->name;?></div>
        <div class='qrcode'><?php echo html::image($public->qrcode, "class='w-220px'");?></div>
      </td>
    </tr>
    <?php endforeach;?>
  </table>
</div>
<?php endif;?>
