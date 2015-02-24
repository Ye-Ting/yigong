<?php
/**
 * The admin view file of volunteer of chanzhiEPS.
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
<?php include '../../common/view/treeview.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
  <strong><i class="icon-list-ul"></i> <?php echo $lang->volunteer->list;?></strong>
  <div class='panel-actions'><?php echo html::a($this->inlink('create'), '<i class="icon-plus"></i> ' . $lang->volunteer->create, 'class="btn btn-primary"');?></div>
  </div>
  <table class='table table-hover table-striped tablesorter'>
    <thead>
      <tr>
        <?php $vars = "orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
        <th class='text-center w-60px'><?php commonModel::printOrderLink('id', $orderBy, $vars, $lang->volunteer->id);?></th>
        <th class='text-center'><?php commonModel::printOrderLink('name', $orderBy, $vars, $lang->volunteer->name);?></th>
        <th class='text-center'><?php commonModel::printOrderLink('volunteer_no', $orderBy, $vars, $lang->volunteer->volunteer_no);?></th>
        <th class='text-center'><?php commonModel::printOrderLink('id_card', $orderBy, $vars, $lang->volunteer->id_card);?></th>
        <th class='text-center w-160px'><?php commonModel::printOrderLink('addedDate', $orderBy, $vars, $lang->volunteer->addedDate);?></th>
        <th class='text-center w-220px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php $maxOrder = 0; foreach($volunteers as $volunteer):?>
      <tr>
        <td class='text-center'><?php echo $volunteer->id;?></td>
        <td class='text-center'>
          <?php echo $volunteer->name;?>
        </td>
        <td class='text-center'>
          <?php echo $volunteer->volunteer_no;?>
        </td>
        <td class='text-center'><?php echo $volunteer->id_card;?></td>
        <td class='text-center'><?php echo $volunteer->addedDate;?></td>
        <td class='text-center'>
          <?php
          echo html::a($this->createLink('volunteer', 'edit', "volunteerID=$volunteer->id"), $lang->edit);
          echo html::a($this->createLink('volunteer', 'delete', "volunteerID=$volunteer->id"), $lang->delete, 'class="deleter"');
          ?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='7'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
