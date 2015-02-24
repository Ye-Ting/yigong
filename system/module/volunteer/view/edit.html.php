<?php
/**
 * The edit view file of volunteer module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     volunteer
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-edit'></i> <?php echo $lang->volunteer->edit;?></strong></div>
  <div class='panel-body'>
  <form method='post' id='ajaxForm'>
    <table class='table table-form'>
      <tr>
        <th><?php echo $lang->volunteer->name;?></th>
        <td colspan='2'>
          <div class='input-group'>
            <?php echo html::input('name', $volunteer->name, "class='form-control'");?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->volunteer->volunteer_no;?></th>
        <td colspan='2'><?php echo html::input('volunteer_no', $volunteer->volunteer_no, " class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->volunteer->id_card;?></th>
        <td colspan='2'><?php echo html::input('id_card', $volunteer->id_card, " class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->volunteer->phone;?></th>
        <td colspan='2'><?php echo html::input('phone', $volunteer->phone, " class='form-control'");?></td>
      </tr>
      <!-- <tbody class='volunteerInfo'>
      <tr>
        <th><?php echo $lang->volunteer->addedDate;?></th>
        <td>
          <div class='input-append date'>
            <?php echo html::input('addedDate', formatTime($volunteer->addedDate), "class='form-control'");?>
            <span class='add-on'><button class="btn btn-default" type="button"><i class="icon-calendar"></i></button></span>
          </div>
        </td>
        <td><span class='help-inline'><?php echo $lang->volunteer->placeholder->addedDate;?></span></td>
      </tr>
      </tbody> -->
      <tr>
        <th></th><td colspan='2'><?php echo html::submitButton();?></td>
      </tr>
    </table>
  </form>
  </div>
</div>

<?php include '../../common/view/treeview.html.php';?>
<?php include '../../common/view/footer.admin.html.php';?>
