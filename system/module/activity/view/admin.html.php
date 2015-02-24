<?php
/**
 * The admin view file of activity of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     activity
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/treeview.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
  <strong><i class="icon-list-ul"></i> <?php echo $lang->activity->list;?></strong>
  <div class='panel-actions'><?php echo html::a($this->inlink('create', "type={$type}"), '<i class="icon-plus"></i> ' . $lang->activity->create, 'class="btn btn-primary"');?></div>
  </div>
  <table class='table table-hover table-striped tablesorter'>
    <thead>
      <tr>
        <?php $vars = "type=$type&categoryID=$categoryID&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
        <th class='text-center w-60px'><?php commonModel::printOrderLink('id', $orderBy, $vars, $lang->activity->id);?></th>
        <th class='text-center'><?php commonModel::printOrderLink('title', $orderBy, $vars, $lang->activity->title);?></th>
        <th class='text-center'><?php commonModel::printOrderLink('place', $orderBy, $vars, $lang->activity->place);?></th>
        <th class='text-center w-160px'><?php commonModel::printOrderLink('date', $orderBy, $vars, $lang->activity->activityDate);?></th>
        <th class='text-center w-160px'><?php commonModel::printOrderLink('addedDate', $orderBy, $vars, $lang->activity->addedDate);?></th>
        <th class='text-center w-220px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php $maxOrder = 0; foreach($activitys as $activity):?>
      <tr>
        <td class='text-center'><?php echo $activity->id;?></td>
        <td>
          <?php echo $activity->title;?>
          <?php if($activity->status == 'draft') echo '<span class="label label-xsm label-warning">' . $lang->activity->statusList[$activity->status] .'</span>';?>
        </td>
        <td>
          <?php echo $activity->place;?>
        </td>
        <td class='text-center'><?php echo $activity->date;?></td>
        <td class='text-center'><?php echo $activity->addedDate;?></td>
        <td class='text-center'>
          <?php
          echo html::a($this->createLink('activity', 'edit', "activityID=$activity->id&type=$activity->type"), $lang->edit);
          echo html::a($this->createLink('activity', 'delete', "activityID=$activity->id"), $lang->delete, 'class="deleter"');
          ?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='7'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
