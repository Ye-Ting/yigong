<?php
/**
 * The create view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/chosen.html.php';?>

<?php
js::set('type', $type);
js::set('cancreatephp', isset($canCreatePHP) ? $canCreatePHP : '');
js::set('setOkFile', isset($okFile) ? sprintf($lang->block->setOkFile, $okFile) : '');

$colorPlates = '';
foreach (explode('|', $lang->block->colorPlates) as $value)
{
    $colorPlates .= "<div class='color color-tile' data='#" . $value . "'><i class='icon-ok'></i></div>";
}
?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-plus'></i> <?php echo $lang->block->create;?></strong>
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm'>
      <?php if(strpos(',htmlcode, phpcode, slide, header', $type) == false or $type == 'html'):?>
        <div id='panelPreview' class='panel-preview'>
          <div class='heading'>
            <div class='pull-right'><button type='button' class='btn' data-target='#customPanelModal' data-toggle='modal'><?php echo $lang->block->custom?></button></div>
            <strong><?php echo $lang->block->preview?></strong>
          </div>
          <div class='panel panel-block' data-target='#customPanelModal' data-toggle='modal' >
            <div class='panel-heading'><i class='icon-heart-empty icon'></i> <strong class='title'><?php echo $lang->block->title;?></strong></div>
            <div class='panel-body text-center'>
              <?php echo $lang->block->textExample;?>
            </div>
          </div>
        </div>
      <?php endif;?>
      <table align='center' class='table table-form'>
        <tr>
          <th class='w-80px'><?php echo $lang->block->type;?></th>
          <td><?php echo $this->block->createTypeSelector($template, $type);?></td>
        </tr>
        <tr>
          <th><?php echo $lang->block->title;?></th>
          <td id='titleTDCell'>
            <div class='row'>
              <div class='col-sm-6'><?php echo html::input('title', strpos(',html,htmlcode,featuredProduct,', $type) == false ? $lang->block->$template->typeList[$type] : '', "class='form-control'");?></div>
            </div>
          </td>
        </tr>
        <?php if(isset($config->block->defaultIcons[$type])):?>
        <tr>
          <th><?php echo $lang->block->icon;?></th>
          <td>
            <div class='row'>
              <div class='col-sm-6'><?php echo html::select('params[icon]', '', '', "class='chosen-icons' data-value='{$config->block->defaultIcons[$type]}'");?></div>
            </div>
          </td>
        </tr>
        <?php endif;?>
        <?php echo $this->fetch('block', 'blockForm', 'type=' . $type);?>
        <?php if(isset($config->block->defaultMoreUrl[$type])):?>
        <tr>
          <th><?php echo $lang->block->moreLink;?></th>
          <td>
            <div class='input-group'>
              <?php echo html::input('params[moreText]', $lang->more, "class='form-control'  placeholder='{$lang->block->placeholder->moreText}'");?>
              <span class="input-group-addon fix-border"><i class="icon icon-link"></i></span>
              <?php echo html::input('params[moreUrl]', $config->block->defaultMoreUrl[$type], "class='form-control' placeholder='{$lang->block->placeholder->moreUrl}'");?>
          </td>
        </tr>
        <?php endif;?>
        <tbody id='blockForm'></tbody>
        <tr>
          <th></th>
          <td>
            <?php echo html::submitButton();?>
            <?php echo html::a($this->session->blockList, $this->lang->goback, "class='btn btn-default'");?>
          </td>
        </tr>
      </table>
      <?php if(strpos(',htmlcode, phpcode, slide, header', $type) == false or $type == 'html'):?>
      <div id='customPanelModal' class='modal fade'>
        <div class='modal-dialog w-600px'>
          <div class='modal-header'><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><i class='icon-cog'></i> <strong><?php echo $lang->block->custom?></strong></div>
          <div class='modal-body'>
            <div id='dialogPanelPreivew' class='panel-preview'>
              <div class='heading'>
                <strong><?php echo $lang->block->preview?></strong>
              </div>
              <div class='panel panel-block' data-target='#customPanelModal' data-toggle='modal' >
                <div class='panel-heading'><i class='icon-heart-empty <?php echo isset($block->content->icon) ? $block->content->icon : '';?> icon'></i> <strong class='title'><?php echo $lang->block->title?></strong></div>
                <div class='panel-body text-center'>
                  <?php echo $lang->block->textExample;?>
                </div>
              </div>
            </div>
            <table class='table table-form mg-0'>
              <?php if(isset($config->block->defaultIcons[$type])):?>
              <tr>
                <th class='w-80px'><?php echo $lang->block->icon;?></th>
                <td>
                  <div class='colorplate'>
                    <div class='input-group color active' data="<?php echo isset($block->content->iconColor) ? $block->content->iconColor : ''?>">
                      <span class='input-group-btn'>
                        <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                          <?php echo $lang->block->iconColor;?> <span class='caret'></span>
                        </button>
                        <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                      </span>
                      <?php echo html::input('params[iconColor]', '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                    </div>
                  </div>
                </td>
              </tr>
              <?php endif;?>
              <tr>
                <th class='w-80px'><?php echo $lang->block->border;?></th>
                <td>
                  <div class='colorplate'>
                    <div class='input-group color active' data="<?php echo isset($block->content->borderColor) ? $block->content->borderColor : ''?>">
                      <span class='input-group-btn'>
                        <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                          <?php echo $lang->block->borderColor;?><span class='caret'></span>
                        </button>
                        <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                      </span>
                      <?php echo html::input('params[borderColor]', isset($block->content->borderColor) ? $block->content->borderColor : '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                    </div>
                  </div>
                </td>
              </tr>
              <?php if($type != 'featuredProduct'):?>
              <tr>
                <th class='w-80px'><?php echo $lang->block->heading;?></th>
                <td>
                  <div class='colorplate'>
                    <div class='input-group color active' data="<?php echo isset($block->content->titleColor) ? $block->content->titleColor : ''?>">
                      <span class='input-group-btn'>
                        <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                          <?php echo $lang->block->textColor;?> <span class='caret'></span>
                        </button>
                        <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                      </span>
                      <?php echo html::input('params[titleColor]', '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                    </div>
                  </div>
                </td>
                <td>
                  <div class='colorplate'>
                    <div class='input-group color active' data="<?php echo isset($block->content->titleBackground) ? $block->content->titleBackground : ''?>">
                      <span class='input-group-btn'>
                        <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                          <?php echo $lang->block->backgroundColor;?> <span class='caret'></span>
                        </button>
                        <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                      </span>
                      <?php echo html::input('params[titleBackground]', '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                    </div>
                  </div>
                </td>
              </tr>
              <?php endif;?>
              <?php if($type != 'followUs'):?>
              <tr>
                <th rowspan='2' class='w-80px'><?php echo $lang->block->content;?></th>
                <td>
                  <div class='colorplate'>
                    <div class='input-group color active' data="<?php echo isset($block->content->textColor) ? $block->content->textColor : ''?>">
                      <span class='input-group-btn'>
                        <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                          <?php echo $lang->block->textColor;?> <span class='caret'></span>
                        </button>
                        <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                      </span>
                      <?php echo html::input('params[textColor]', '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                    </div>
                  </div>
                </td>
                <td>
                  <div class='colorplate'>
                    <div class='input-group color active' data="<?php echo isset($block->content->linkColor) ? $block->content->linkColor : ''?>">
                      <span class='input-group-btn'>
                        <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                          <?php echo $lang->block->linkColor;?> <span class='caret'></span>
                        </button>
                        <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                      </span>
                      <?php echo html::input('params[linkColor]', '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class='colorplate'>
                    <div class='input-group color active' data="<?php echo isset($block->content->backgroundColor) ? $block->content->backgroundColor : ''?>">
                      <span class='input-group-btn'>
                        <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                          <?php echo $lang->block->backgroundColor;?> <span class='caret'></span>
                        </button>
                        <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                      </span>
                      <?php echo html::input('params[backgroundColor]', '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                    </div>
                  </div>
                </td>
              </tr>
              <?php endif;?>
              <tr>
                <td colspan='3' class='text-center'><button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true"><?php echo $lang->confirm;?></button></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <?php endif;?>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
