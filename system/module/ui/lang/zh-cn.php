<?php
/**
 * The ui module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->ui->common       = "站点";

$lang->ui->logo            = 'Logo';
$lang->ui->setLogo         = "Logo设置";
$lang->ui->setTemplate     = '模板设置';
$lang->ui->installTemplate = '上传模板';
$lang->ui->setTheme        = '主题设置';
$lang->ui->setFavicon      = "Favicon设置";
$lang->ui->setBaseStyle    = "全局样式设置";

$lang->ui->noStyleTag        = "请填写全局CSS样式代码，不需要&lt;style&gt;&lt;/style&gt;标签";
$lang->ui->setLogoFailed     = "设置Logo失败";
$lang->ui->noSelectedFile    = "没有选择图片";
$lang->ui->notAlloweFileType = "请选择正确的%s文件.";
$lang->ui->suitableLogoSize  = '最佳高度范围：50px~80px，最佳宽度范围：80px~240px';

$lang->ui->favicon = new stdclass();
$lang->ui->favicon->help  = "帮助";

$lang->ui->template = new stdclass();
$lang->ui->template->name            = '名称';
$lang->ui->template->version         = '版本';
$lang->ui->template->author          = '作者';
$lang->ui->template->charge          = '费用';
$lang->ui->template->chanzhiVersion  = '兼容版本';
$lang->ui->template->desc            = '简介';
$lang->ui->template->theme           = '主题';
$lang->ui->template->license         = '版权';
$lang->ui->template->availableThemes = '<strong>%s</strong> 款可用主题';
$lang->ui->template->currentTheme    = '正在使用 <strong>%s</strong>';
$lang->ui->template->changeTheme     = '切换主题';
$lang->ui->template->apply           = '应用模板';
$lang->ui->template->current         = '当前模板';
$lang->ui->template->conflicts       = "警告！已有名为<strong> %s </strong> 的模板。";
$lang->ui->template->override        = "覆盖并安装";
$lang->ui->template->reupload        = "重新上传";
$lang->ui->template->installSuccess  = '恭喜，模板上传成功';
$lang->ui->template->manageTemplate  = '设置模板';
$lang->ui->template->manageBlock     = '设置区块';
$lang->ui->template->enable          = '启用';
$lang->ui->template->reload          = '刷新页面';
$lang->ui->template->doInstall       = '确认安装';
$lang->ui->template->info            = '模板信息';

$lang->ui->template->error = new stdclass();
$lang->ui->template->error->paths    = '目录权限错误';
$lang->ui->template->error->exists   = "<p>目录%s不存在</p>";
$lang->ui->template->error->writable = "<p>目录%s不可写</p>";

$lang->ui->template->commands = new stdclass();
$lang->ui->template->commands->execute  = '如果是Linux系统，请执行以下命令继续';
$lang->ui->template->commands->exists   = "mkdir -p %s<br/>";
$lang->ui->template->commands->writable = "chmod 777 -R %s<br/>"; 

$lang->ui->customtheme = '自定义主题';
$lang->ui->custom      = '自定义';
$lang->ui->themeSaved  = '主题配置已保存';

$lang->ui->theme                  = new stdclass();
$lang->ui->theme->colorPlates                          = '#333333|#000000|#CA1407|#45872B|#148D00|#F25D03|#2286D2|#D92958|#A63268|#04BFAD|#D1270A|#FF9400|#299182|#63731A|#3D4DBE|#7382D9|#754FB9|#F2E205|#B1C502|#364245|#C05036|#8A342A|#E0DDA2|#B3D465|#EEEEEE|#FFD0E5|#D0FFFD|#FFFF84|#F4E6AE|#E5E5E5|#F1F1F1|#FFFFFF|transparent';
$lang->ui->theme->reset                                = '重置为默认';
$lang->ui->theme->default                              = '默认';
$lang->ui->theme->resetTip                             = '参数已重置，保存后生效';
$lang->ui->theme->sizeTip                              = '默认单位为像素，如1px';
$lang->ui->theme->colorTip                             = '如: red 或 #FFF';
$lang->ui->theme->positionTip                          = '如: 100px, 50%, left, top, center';
$lang->ui->theme->backImageTip                         = '图片地址，如: image.jpg';
$lang->ui->theme->borderStyleList['none']              = '无边框';
$lang->ui->theme->borderStyleList['solid']             = '实线';
$lang->ui->theme->borderStyleList['dashed']            = '虚线';
$lang->ui->theme->borderStyleList['dotted']            = '点线';
$lang->ui->theme->borderStyleList['double']            = '双线条';
$lang->ui->theme->imageRepeatList['repeat']            = '默认';
$lang->ui->theme->imageRepeatList['repeat']            = '重复';
$lang->ui->theme->imageRepeatList['repeat-x']          = 'X轴重复';
$lang->ui->theme->imageRepeatList['repeat-y']          = 'Y轴重复';
$lang->ui->theme->imageRepeatList['no-repeat']         = '不重复';
$lang->ui->theme->fontWeightList['inherit']            = '默认';
$lang->ui->theme->fontWeightList['normal']             = '正常';
$lang->ui->theme->fontWeightList['bold']               = '加粗';
$lang->ui->theme->fontList['inherit']                  = '默认';
$lang->ui->theme->fontList['宋体']                     = '宋体';
$lang->ui->theme->fontList['仿宋']                     = '仿宋';
$lang->ui->theme->fontList['黑体']                     = '黑体';
$lang->ui->theme->fontList['微软雅黑']                 = '微软雅黑';
$lang->ui->theme->fontList['Arial']                    = 'Arial';
$lang->ui->theme->fontList['Courier']                  = 'Courier';
$lang->ui->theme->fontList['Console']                  = 'Console';
$lang->ui->theme->fontList['Tahoma']                   = 'Tahoma';
$lang->ui->theme->fontList['Verdana']                  = 'Verdana';
$lang->ui->theme->fontList['ZenIcon']                  = '图标字体 ZenIcon';
$lang->ui->theme->fontSizeList['inherit']              = '默认';
$lang->ui->theme->fontSizeList['12px']                 = '12px';
$lang->ui->theme->fontSizeList['13px']                 = '13px';
$lang->ui->theme->fontSizeList['14px']                 = '14px';
$lang->ui->theme->fontSizeList['15px']                 = '15px';
$lang->ui->theme->fontSizeList['16px']                 = '16px';
$lang->ui->theme->fontSizeList['18px']                 = '18px';
$lang->ui->theme->fontSizeList['20px']                 = '20px';
$lang->ui->theme->fontSizeList['24px']                 = '24px';
$lang->ui->theme->navbarLayoutList['false']            = '普通';
$lang->ui->theme->navbarLayoutList['true']             = '自适应宽度';
$lang->ui->theme->sidebarPullLeftList['false']         = '靠右';
$lang->ui->theme->sidebarPullLeftList['true']          = '靠左';
$lang->ui->theme->sidebarWidthList["16.666666666667%"] = "1/6";
$lang->ui->theme->sidebarWidthList["25%"]              = "1/4";
$lang->ui->theme->sidebarWidthList["33.333333333333%"] = "1/3";
$lang->ui->theme->sidebarWidthList["50%"]              = "1/2";
$lang->ui->theme->underlineList['none']                = '无';
$lang->ui->theme->underlineList['underline']           = '带下划线';

$lang->ui->groups = new stdclass();
$lang->ui->groups->basic  = '基本样式';
$lang->ui->groups->navbar = '导航条';
$lang->ui->groups->block  = '区块';
$lang->ui->groups->button = '按钮';
$lang->ui->groups->footer = '页脚';

$lang->ui->color          = '颜色';
$lang->ui->colorset       = '配色';
$lang->ui->pageBackground = '页面背景';
$lang->ui->pageText       = '页面文字';
$lang->ui->aLink          = '普通链接';
$lang->ui->aVisited       = '已访问链接';
$lang->ui->aHover         = '高亮链接';
$lang->ui->underline      = '下划线';
$lang->ui->transparent    = '透明';
$lang->ui->none           = '无';

$lang->ui->layout        = '布局';
$lang->ui->navbar        = '导航条';
$lang->ui->panel         = '子面板';
$lang->ui->menuBorder    = '菜单边框';
$lang->ui->submenuBorder = '子菜单边框';
$lang->ui->menuNormal    = '菜单普通';
$lang->ui->menuHover     = '菜单高亮';
$lang->ui->menuActive    = '菜单选中';
$lang->ui->submenuNormal = '子菜单普通';
$lang->ui->submenuHover  = '子菜单高亮';
$lang->ui->submenuActive = '子菜单选中';
$lang->ui->heading       = '标题';
$lang->ui->body          = '主体';
$lang->ui->background    = '背景';
$lang->ui->button        = '按钮';
$lang->ui->text          = '文字';
$lang->ui->column        = '分栏';
$lang->ui->sidebarLayout = '侧边栏布局';
$lang->ui->sidebarWidth  = '侧边栏宽度';

$lang->ui->primaryColor    = '基色';
$lang->ui->backcolor       = '背景色';
$lang->ui->forecolor       = '前景色';
$lang->ui->backgroundImage = '背景图片';
$lang->ui->repeat          = '重复方式';
$lang->ui->position        = '位置';
$lang->ui->style           = '样式';
$lang->ui->fontSize        = '字号';
$lang->ui->fontFamily      = '字体';
$lang->ui->fontWeight      = '加粗';
$lang->ui->layout          = '布局';
$lang->ui->border          = '边框';
$lang->ui->borderColor     = '边框颜色';
$lang->ui->borderWidth     = '边框宽度';
$lang->ui->width           = '宽度';
$lang->ui->radius          = '圆角';
$lang->ui->linkColor       = '链接颜色';
$lang->ui->default         = '普通';
$lang->ui->primary         = '主要';
$lang->ui->info            = '信息';
$lang->ui->danger          = '危险';
$lang->ui->warning         = '警告';
$lang->ui->success         = '积极';
