<?php
/**
 * The create view file of activity module of chanzhiEPS.
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
<?php js::set('type', $type);?>
<?php js::set('categoryID', $currentCategory);?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<?php include '../../common/view/codeeditor.html.php';?>

<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-plus'></i>&nbsp;
    <?php if($type == 'blog'):?>
    <?php echo $lang->blog->create;?>
    <?php elseif($type == 'page'):?>
    <?php echo $lang->page->create;?>
    <?php else:?>
    <?php echo $lang->activity->create;?>
    <?php endif;?>
  </strong></div>
  <div class='panel-body'>
    <form method='post' role='form' id='ajaxForm'>
      <table class='table table-form'>
        <?php if($type != 'page'):?>
        <tr>
          <th class='w-100px'><?php echo $lang->activity->category;?></th>
          <td class='w-p40'><?php echo html::select("categories[]", $categories, $currentCategory, "multiple='multiple' class='form-control chosen'");?></td><td></td>
        </tr>
        <tbody class='activityInfo'> 
        <tr>
          <th><?php echo $lang->activity->author;?></th>
          <td><?php echo html::input('author', $app->user->realname, "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->activity->source;?></th>
          <td><?php echo html::select('source', $lang->activity->sourceList, 'original', "class='form-control chosen'");?></td>
          <td>
            <div class='row' id='copyBox'>
              <div class='col-md-4'><?php echo html::input('copySite', '', "class='form-control' placeholder='{$lang->activity->copySite}'"); ?> </div>
              <div class='col-md-8'><?php echo html::input('copyURL',  '', "class='form-control' placeholder='{$lang->activity->copyURL}'"); ?></div>
            </div>
          </td>
        </tr>
        </tbody>
        <?php endif; ?>
        <tr>
          <th><?php echo $lang->activity->title;?></th>
          <td colspan='2'>
            <div class='input-group'>
              <?php echo html::input('title', '', "class='form-control'");?>
              <span class="input-group-addon w-70px">
                <label class='checkbox'>
                  <?php echo "<input type='checkbox' name='isLink' id='isLink' value='1' /><span>{$lang->activity->isLink}</span>" ?>
                </label>
              </span>
            </div>
          </td>
        </tr>
        <tr class='link'>
          <th><?php echo $lang->activity->link;?></th>
          <td colspan='2'>
            <div class='required required-wrapper'></div>
            <?php echo html::input('link', '', "class='form-control' placeholder='{$lang->activity->placeholder->link}'");?>
          </td>
        </tr>
        <tbody class='activityInfo'>
        <tr>
          <th><?php echo $lang->activity->alias;?></th>
          <td colspan='2'>
            <div class='input-group'>
              <?php if($type == 'page'):?>
              <span class='input-group-addon'>http://<?php echo $this->server->http_host . $config->webRoot;?>page/</span>
              <?php else:?>
              <span class='input-group-addon'>http://<?php echo $this->server->http_host . $config->webRoot . $type;?>/id_</span>
              <?php endif;?>
              <?php echo html::input('alias', '', "class='form-control' placeholder='{$lang->alias}'");?>
              <span class="input-group-addon w-70px">.html</span>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->activity->keywords;?></th>
          <td colspan='2'><?php echo html::input('keywords', '', "class='form-control'");?></td>
        </tr>
        </tbody>
        <tr>
          <th><?php echo $lang->activity->summary;?></th>
          <td colspan='2'><?php echo html::textarea('summary', '', "rows='2' class='form-control'");?></td>
        </tr>
        <tbody class='activityInfo'>
        <tr>
          <th><?php echo $lang->activity->content;?></th>
          <td colspan='2'><?php echo html::textarea('content', '', "rows='10' class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->activity->addedDate;?></th>
          <td>
            <div class="input-append date">
              <?php echo html::input('addedDate', date('Y-m-d H:i'), "class='form-control'");?>
              <span class='add-on'><button class="btn btn-default" type="button"><i class="icon-calendar"></i></button></span>
            </div>
          </td>
          <td><span class="help-inline"><?php echo $lang->activity->placeholder->addedDate;?></span></td>
        </tr>
        <tr>
          <th><?php echo $lang->activity->status;?></th>
          <td><?php echo html::radio('status', $lang->activity->statusList, 'normal');?></td>
        </tr>
        </tbody>
        <tr>
          <td></td>
          <td colspan='2'><?php echo html::submitButton();?></td>
        </tr>
      </table>
    </form>
  </div>
</div>

<?php include '../../common/view/footer.admin.html.php';?>
