<?php
/**
 * The edit view file of activity module of chanzhiEPS.
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
<?php include '../../common/view/datepicker.html.php';?>
<?php js::set('type',$type);?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<?php include '../../common/view/codeeditor.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-edit'></i> <?php echo $type == 'blog' ? $lang->blog->edit : ($type == 'page' ? $lang->page->edit : $lang->activity->edit);?></strong></div>
  <div class='panel-body'>
  <form method='post' id='ajaxForm'>
    <table class='table table-form'>
      <?php if($type != 'page'):?>
      <tr>
        <th class='w-100px'><?php echo $lang->activity->category;?></th>
        <td class='w-p40'><?php echo html::select("categories[]", $categories, array_keys($activity->categories), "multiple='multiple' class='form-control chosen'");?></td><td></td>
      </tr>
      <tbody class='activityInfo'>
      <tr>
        <th><?php echo $lang->activity->author;?></th>
        <td><?php echo html::input('author', $activity->author, "class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->activity->source;?></th>
        <td><?php echo html::select('source', $lang->activity->sourceList, $activity->source, "class='form-control chosen'");?></td>
        <td>
          <div id='copyBox' class='row'>
            <div class='col-sm-4'><?php echo html::input('copySite', $activity->copySite, "class='form-control' placeholder='{$lang->activity->copySite}'"); ?> </div>
            <div class='col-sm-8'><?php echo html::input('copyURL',  $activity->copyURL, "class='form-control' placeholder='{$lang->activity->copyURL}'"); ?></div>
          </div>
        </td>
      </tr>
      </tbody>
      <?php endif; ?>
      <tr>
        <th><?php echo $lang->activity->title;?></th>
        <td colspan='2'>
          <div class='input-group'>
            <?php echo html::input('title', $activity->title, "class='form-control'");?>
            <span class="input-group-addon w-70px">
              <label class='checkbox'>
                <?php $checked = $activity->link ? 'checked' : '';?>
                <?php echo "<input type='checkbox' name='isLink' id='isLink' value='1' {$checked} /><span>{$lang->activity->isLink}</span>"?>
              </label>
            </span>
          </div>
        </td>
      </tr>
      <tr class='link'>
        <th><?php echo $lang->activity->link;?></th>
        <td colspan='2'>
          <div class='required required-wrapper'></div>
          <?php echo html::input('link', $activity->link, "class='form-control' placeholder='{$lang->activity->placeholder->link}'");?>
        </td>
      </tr>
      <tbody class='activityInfo'>
      <tr>
        <th><?php echo $lang->activity->alias;?></th>
        <td colspan='2'>
          <div class='input-group'>
            <?php if($type == 'page'):?>
            <span class="input-group-addon">http://<?php echo $this->server->http_host . $config->webRoot?>page/</span>
            <?php else:?>
            <span class="input-group-addon">http://<?php echo $this->server->http_host . $config->webRoot . $type?>/id_</span>
            <?php endif;?>
            <?php echo html::input('alias', $activity->alias, "class='form-control' placeholder='{$lang->alias}'");?>
            <span class='input-group-addon w-70px'>.html</span>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->activity->keywords;?></th>
        <td colspan='2'> <?php echo html::input('keywords', $activity->keywords, "class='form-control'");?></td>
      </tr>
      </tbody>
      <tr>
        <th><?php echo $lang->activity->summary;?></th>
        <td colspan='2'><?php echo html::textarea('summary', $activity->summary, "rows='2' class='form-control'");?></td>
      </tr>
      <tbody class='activityInfo'>
      <tr>
        <th><?php echo $lang->activity->content;?></th>
        <td colspan='2'><?php echo html::textarea('content', htmlspecialchars($activity->content), "rows='10' class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->activity->addedDate;?></th>
        <td>
          <div class='input-append date'>
            <?php echo html::input('addedDate', formatTime($activity->addedDate), "class='form-control'");?>
            <span class='add-on'><button class="btn btn-default" type="button"><i class="icon-calendar"></i></button></span>
          </div>
        </td>
        <td><span class='help-inline'><?php echo $lang->activity->placeholder->addedDate;?></span></td>
      </tr>
      <tr>
        <th><?php echo $lang->activity->status;?></th>
        <td><?php echo html::radio('status', $lang->activity->statusList, $activity->status);?></td>
      </tr>
      </tbody>
      <tr>
        <th></th><td colspan='2'><?php echo html::submitButton();?></td>
      </tr>
    </table>
  </form>
  </div>
</div>

<?php include '../../common/view/treeview.html.php';?>
<?php include '../../common/view/footer.admin.html.php';?>
