<?php
/**
 * The set js view file of product module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php include '../../common/view/codeeditor.html.php';?>
<form id='ajaxForm' action="<?php echo inlink('setjs', "productID=$product->id");?>" method='post'>
  <table class="table table-form">
    <tr><td><?php echo html::textarea('js', $product->js, "rows=5 class='form-control codeeditor' data-mode='javascript' data-height='300px'");?></td></tr>
    <tr><td><div class='editor-actions'><?php echo html::submitButton();?></div></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
