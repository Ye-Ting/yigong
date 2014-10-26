<?php
/**
 * The base style view file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/codeeditor.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-html5'></i> <?php echo $lang->ui->setBaseStyle;?></strong>
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <td><?php echo html::textarea('content', isset($content) ? $content : '', "rows=20 class='form-control codeeditor' data-mode='css'");?></td>
        </tr>
        <tr>
          <td>
            <div class='form-action'>
              <?php echo html::submitButton();?>
              <strong class="text-info">&nbsp;&nbsp;<?php echo $this->lang->ui->noStyleTag?></strong>
            </div>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
