<?php
$config->ui = new stdclass();
$config->ui->groups = array('basic', 'navbar', 'block', 'button', 'footer');

$config->ui->selectorOptions = array();

$config->ui->selectorOptions['basic']['colorset'] = array();
$config->ui->selectorOptions['basic']['colorset']['primary'] = array('type' => 'color', 'default' => '#3280FC', 'name' => 'color-primary');

$config->ui->selectorOptions['basic']['border'] = array();
$config->ui->selectorOptions['basic']['border']['radius'] = array('type' => 'size', 'default' => '3px', 'name' => 'border-radius');

$config->ui->selectorOptions['basic']['pageBackground'] = array();
$config->ui->selectorOptions['basic']['pageBackground']['backcolor']       = array('type' => 'color', 'default' => 'transparent', 'name' => 'background-color');
$config->ui->selectorOptions['basic']['pageBackground']['backgroundImage'] = array('type' => 'image', 'default' => 'none', 'name' => 'background-image');
$config->ui->selectorOptions['basic']['pageBackground']['repeat']          = array('type' => 'repeat', 'default' => 'repeat', 'name' => 'background-image-repeat');
$config->ui->selectorOptions['basic']['pageBackground']['position']        = array('type' => 'position', 'default' => '0 0', 'name' => 'background-image-position');

$config->ui->selectorOptions['basic']['pageText'] = array();
$config->ui->selectorOptions['basic']['pageText']['color']      = array('type' => 'color', 'default' => '#333', 'name' => 'text-color');
$config->ui->selectorOptions['basic']['pageText']['fontSize']   = array('type' => 'fontSize', 'default' => '13px', 'name' => 'font-size');
$config->ui->selectorOptions['basic']['pageText']['fontFamily'] = array('type' => 'fontFamily', 'default' => '"Helvetica Neue", Helvetica, Tahoma, Arial, sans-serif', 'name' => 'font-family');
$config->ui->selectorOptions['basic']['pageText']['fontWeight'] = array('type' => 'fontWeight', 'default' => 'normal', 'name' => 'font-weight');

$config->ui->selectorOptions['basic']['aLink'] = array();
$config->ui->selectorOptions['basic']['aLink']['color']     = array('type' => 'color', 'default' => '#0D3D88', 'name' => 'link-color');
$config->ui->selectorOptions['basic']['aLink']['underline'] = array('type' => 'underline', 'default' => 'none', 'name' => 'link-decoration');

$config->ui->selectorOptions['basic']['aVisited'] = array();
$config->ui->selectorOptions['basic']['aVisited']['color'] = array('type' => 'color', 'default' => '#0D3D88', 'name' => 'link-visited-color');

$config->ui->selectorOptions['basic']['aHover'] = array();
$config->ui->selectorOptions['basic']['aHover']['color']     = array('type' => 'color', 'default' => '#347AEB', 'name' => 'link-hover-color');
$config->ui->selectorOptions['basic']['aHover']['underline'] = array('type' => 'underline', 'default' => 'none', 'name' => 'link-decoration');

$config->ui->selectorOptions['basic']['column'] = array();
$config->ui->selectorOptions['basic']['column']['sidebarLayout'] = array('type' => 'sidebarLayout', 'default' => 'false', 'name' => 'sidebar-pull-left');
$config->ui->selectorOptions['basic']['column']['sidebarWidth']  = array('type' => 'sidebarWidth', 'default' => '25%', 'name' => 'sidebar-width');

$config->ui->selectorOptions['navbar']['layout'] = array();
$config->ui->selectorOptions['navbar']['layout']['layout'] = array('type' => 'navLayout', 'default' => 'true', 'name' => 'navbar-table-layout');

$config->ui->selectorOptions['navbar']['navbar'] = array();
$config->ui->selectorOptions['navbar']['navbar']['backcolor']       = array('type' => 'color', 'default' => '#f1f1f1', 'name' => 'navbar-backcolor');
$config->ui->selectorOptions['navbar']['navbar']['backgroundImage'] = array('type' => 'image', 'default' => 'none', 'name' => 'navbar-background-image');
$config->ui->selectorOptions['navbar']['navbar']['repeat']          = array('type' => 'repeat', 'default' => 'repeat', 'name' => 'navbar-background-image-repeat');
$config->ui->selectorOptions['navbar']['navbar']['position']        = array('type' => 'position', 'default' => '0 0', 'name' => 'navbar-background-image-position');
$config->ui->selectorOptions['navbar']['navbar']['border']          = array('type' => 'border', 'default' => 'solid', 'name' => 'navbar-border-style');
$config->ui->selectorOptions['navbar']['navbar']['borderColor']     = array('type' => 'color', 'default' => '#D5D5D5', 'name' => 'navbar-border-color');
$config->ui->selectorOptions['navbar']['navbar']['borderWidth']     = array('type' => 'size', 'default' => '1px', 'name' => 'navbar-border-width');
$config->ui->selectorOptions['navbar']['navbar']['radius']          = array('type' => 'size',  'default' => '4px', 'name' => 'navbar-border-radius');

$config->ui->selectorOptions['navbar']['panel'] = array();
$config->ui->selectorOptions['navbar']['panel']['backcolor']   = array('type' => 'color', 'default' => '#FFF', 'name' => 'navbar-panel-backcolor');
$config->ui->selectorOptions['navbar']['panel']['border']      = array('type' => 'border', 'default' => 'solid', 'name' => 'navbar-panel-border-style');
$config->ui->selectorOptions['navbar']['panel']['borderColor'] = array('type' => 'color', 'default' => '#DDD', 'name' => 'navbar-panel-border-color');
$config->ui->selectorOptions['navbar']['panel']['borderWidth'] = array('type' => 'size', 'default' => '1px', 'name' => 'navbar-panel-border-width');
$config->ui->selectorOptions['navbar']['panel']['radius']      = array('type' => 'size',  'default' => '3px', 'name' => 'navbar-paenl-border-radius');

$config->ui->selectorOptions['navbar']['menuNormal'] = array();
$config->ui->selectorOptions['navbar']['menuNormal']['color']      = array('type' => 'color',  'default' => '#555', 'name' => 'navbar-menu-color');
$config->ui->selectorOptions['navbar']['menuNormal']['fontSize']   = array('type' => 'fontSize',  'default' => '14px', 'name' => 'navbar-menu-font-size');
$config->ui->selectorOptions['navbar']['menuNormal']['fontFamily'] = array('type' => 'fontFamily',  'default' => 'inherit', 'name' => 'navbar-menu-font-family');
$config->ui->selectorOptions['navbar']['menuNormal']['fontWeight'] = array('type' => 'fontWeight',  'default' => 'bold', 'name' => 'navbar-menu-font-weight');

$config->ui->selectorOptions['navbar']['menuHover'] = array();
$config->ui->selectorOptions['navbar']['menuHover']['color']     = array('type' => 'color',  'default' => '#000', 'name' => 'navbar-menu-color-hover');
$config->ui->selectorOptions['navbar']['menuHover']['backcolor'] = array('type' => 'color',  'default' => '#FEFEFE', 'name' => 'navbar-menu-backcolor-hover');

$config->ui->selectorOptions['navbar']['menuActive'] = array();
$config->ui->selectorOptions['navbar']['menuActive']['color']     = array('type' => 'color',  'default' => '#151515', 'name' => 'navbar-menu-color-active');
$config->ui->selectorOptions['navbar']['menuActive']['backcolor'] = array('type' => 'color',  'default' => '#FFF', 'name' => 'navbar-menu-backcolor-active');

$config->ui->selectorOptions['navbar']['submenuNormal'] = array();
$config->ui->selectorOptions['navbar']['submenuNormal']['color']      = array('type' => 'color',  'default' => '#333', 'name' => 'navbar-submenu-color');

$config->ui->selectorOptions['navbar']['submenuHover'] = array();
$config->ui->selectorOptions['navbar']['submenuHover']['color']     = array('type' => 'color',  'default' => '#151515', 'name' => 'navbar-submenu-color-hover');
$config->ui->selectorOptions['navbar']['submenuHover']['backcolor'] = array('type' => 'color',  'default' => '#E5E5E5', 'name' => 'navbar-submenu-backcolor-hover');

$config->ui->selectorOptions['navbar']['submenuActive'] = array();
$config->ui->selectorOptions['navbar']['submenuActive']['color']     = array('type' => 'color',  'default' => '#151515', 'name' => 'navbar-submenu-color-active');
$config->ui->selectorOptions['navbar']['submenuActive']['backcolor'] = array('type' => 'color',  'default' => '#E5E5E5', 'name' => 'navbar-submenu-backcolor-active');

$config->ui->selectorOptions['block']['border'] = array();
$config->ui->selectorOptions['block']['border']['border']  = array('type' => 'border', 'default' => 'solid', 'name' => 'block-border-style');
$config->ui->selectorOptions['block']['border']['color']  = array('type' => 'color', 'default' => '#DDD', 'name' => 'block-border-color');
$config->ui->selectorOptions['block']['border']['width']  = array('type' => 'size', 'default' => '1px', 'name' => 'block-border-width');
$config->ui->selectorOptions['block']['border']['radius'] = array('type' => 'size',  'default' => '3px', 'name' => 'block-border-radius');

$config->ui->selectorOptions['block']['heading'] = array();
$config->ui->selectorOptions['block']['heading']['backcolor']  = array('type' => 'color', 'default' => '#F5F5F5', 'name' => 'block-heading-backcolor');
$config->ui->selectorOptions['block']['heading']['color']      = array('type' => 'color', 'default' => '#333', 'name' => 'block-heading-color');
$config->ui->selectorOptions['block']['heading']['fontSize']   = array('type' => 'fontSize', 'default' => 'inherit', 'name' => 'block-heading-font-size');
$config->ui->selectorOptions['block']['heading']['fontWeight'] = array('type' => 'fontWeight', 'default' => 'inherit', 'name' => 'block-heading-font-weight');

$config->ui->selectorOptions['block']['body'] = array();
$config->ui->selectorOptions['block']['body']['backcolor'] = array('type' => 'color', 'default' => 'transparent', 'name' => 'block-body-backcolor');
$config->ui->selectorOptions['block']['body']['color']     = array('type' => 'color', 'default' => '#333', 'name' => 'block-body-color');
$config->ui->selectorOptions['block']['body']['linkColor'] = array('type' => 'color', 'default' => '#0D3D88', 'name' => 'block-body-link-color');

$config->ui->selectorOptions['button']['colorset'] = array();
$config->ui->selectorOptions['button']['colorset']['default'] = array('type' => 'color', 'default' => '#F2F2F2', 'name' => 'button-color-default');
$config->ui->selectorOptions['button']['colorset']['primary'] = array('type' => 'color', 'default' => '#3280FC', 'name' => 'button-color-primary');
$config->ui->selectorOptions['button']['colorset']['info']    = array('type' => 'color', 'default' => '#39B3D7', 'name' => 'button-color-info');
$config->ui->selectorOptions['button']['colorset']['success'] = array('type' => 'color', 'default' => '#229F24', 'name' => 'button-color-success');
$config->ui->selectorOptions['button']['colorset']['warning'] = array('type' => 'color', 'default' => '#E48600', 'name' => 'button-color-warning');
$config->ui->selectorOptions['button']['colorset']['danger']  = array('type' => 'color', 'default' => '#D2322D', 'name' => 'button-color-danger');

$config->ui->selectorOptions['button']['border'] = array();
$config->ui->selectorOptions['button']['border']['border'] = array('type' => 'border', 'default' => 'solid', 'name' => 'button-border-style');
$config->ui->selectorOptions['button']['border']['width']  = array('type' => 'size', 'default' => '1px', 'name' => 'button-border-width');
$config->ui->selectorOptions['button']['border']['radius'] = array('type' => 'size',  'default' => '3px', 'name' => 'button-border-radius');

$config->ui->selectorOptions['button']['text'] = array();
$config->ui->selectorOptions['button']['text']['fontWeight']  = array('type' => 'fontWeight', 'default' => 'normal', 'name' => 'button-font-weight');

$config->ui->selectorOptions['footer']['border'] = array();
$config->ui->selectorOptions['footer']['border']['border'] = array('type' => 'border', 'default' => 'solid', 'name' => 'footer-border-style');
$config->ui->selectorOptions['footer']['border']['color']  = array('type' => 'color', 'default' => '#ddd', 'name' => 'footer-border-color');

$config->ui->selectorOptions['footer']['background'] = array();
$config->ui->selectorOptions['footer']['background']['backcolor'] = array('type' => 'color', 'default' => '#f7f7f7', 'name' => 'footer-backcolor');

/* Default theme setting */
$config->ui->themes['default'] = $config->ui->selectorOptions;
unset($config->ui->themes['default']['basic']['border']);
unset($config->ui->themes['default']['basic']['colorset']);

/* Blue theme setting */
$config->ui->themes['blue']    = $config->ui->selectorOptions;
unset($config->ui->themes['blue']['basic']['border']);
unset($config->ui->themes['blue']['basic']['colorset']);
unset($config->ui->themes['blue']['navbar']);
$config->ui->themes['blue']['block']['heading']['backcolor']['default'] = '#145BCC';
$config->ui->themes['blue']['block']['heading']['color']['default'] = '#FFF';

/* Brightdark theme setting */
$config->ui->themes['brightdark']    = $config->ui->selectorOptions;
unset($config->ui->themes['brightdark']['basic']['border']);
unset($config->ui->themes['brightdark']['basic']['colorset']);
unset($config->ui->themes['brightdark']['navbar']);
unset($config->ui->themes['brightdark']['button']);
unset($config->ui->themes['brightdark']['block']);
$config->ui->themes['brightdark']['basic']['pageBackground']['backcolor']['default'] = '#2E353F';
$config->ui->themes['brightdark']['basic']['pageText']['color']['default'] = '#2E353F';
$config->ui->themes['brightdark']['basic']['aLink']['color']['default'] = '#DA3B26';
$config->ui->themes['brightdark']['basic']['aVisited']['color']['default'] = '#DA3B26';
$config->ui->themes['brightdark']['basic']['aHover']['color']['default'] = '#DA3B26';
$config->ui->themes['brightdark']['footer']['border']['border']['default'] = 'none';
$config->ui->themes['brightdark']['footer']['background']['backcolor']['default'] = '#ECF0F5';

/* Flat theme setting */
$config->ui->themes['flat']    = $config->ui->selectorOptions;
unset($config->ui->themes['flat']['basic']['border']);
unset($config->ui->themes['flat']['basic']['colorset']);
unset($config->ui->themes['flat']['navbar']);
unset($config->ui->themes['flat']['button']);
unset($config->ui->themes['flat']['block']);
$config->ui->themes['flat']['basic']['pageText']['color']['default'] = '#34495E';
$config->ui->themes['flat']['basic']['aLink']['color']['default'] = '#16A085';
$config->ui->themes['flat']['basic']['aVisited']['color']['default'] = '#16A085';
$config->ui->themes['flat']['basic']['aHover']['color']['default'] = '#1ABC9C';
$config->ui->themes['flat']['footer']['border']['border']['default'] = 'none';
$config->ui->themes['flat']['footer']['background']['backcolor']['default'] = '#EDEFF1';

/* Tartan theme setting */
$config->ui->themes['tartan']    = $config->ui->selectorOptions;
unset($config->ui->themes['tartan']['basic']['border']);
unset($config->ui->themes['tartan']['basic']['colorset']);
unset($config->ui->themes['tartan']['navbar']);
unset($config->ui->themes['tartan']['button']);
unset($config->ui->themes['tartan']['block']);
$config->ui->themes['tartan']['basic']['pageBackground']['backgroundImage']['default'] = 'inherit';
$config->ui->themes['tartan']['basic']['pageBackground']['backcolor']['default'] = '#5F7A64';
$config->ui->themes['tartan']['basic']['pageText']['color']['default'] = '#6F6658';
$config->ui->themes['tartan']['basic']['aLink']['color']['default'] = '#254952';
$config->ui->themes['tartan']['basic']['aVisited']['color']['default'] = '#254952';
$config->ui->themes['tartan']['basic']['aHover']['color']['default'] = '#35636E';
$config->ui->themes['tartan']['footer']['border']['border']['default'] = 'none';
$config->ui->themes['tartan']['footer']['background']['backcolor']['default'] = '#F5F0CC';

/* Tree theme setting */
$config->ui->themes['tree']    = $config->ui->selectorOptions;
unset($config->ui->themes['tree']['basic']['border']);
unset($config->ui->themes['tree']['basic']['colorset']);
unset($config->ui->themes['tree']['navbar']);
unset($config->ui->themes['tree']['button']);
unset($config->ui->themes['tree']['block']);
$config->ui->themes['tree']['basic']['pageText']['color']['default'] = '#5F7A64';
$config->ui->themes['tree']['basic']['aLink']['color']['default'] = '#6E2E16';
$config->ui->themes['tree']['basic']['aVisited']['color']['default'] = '#6E2E16';
$config->ui->themes['tree']['basic']['aHover']['color']['default'] = '#6E2E16';
$config->ui->themes['tree']['footer']['border']['border']['default'] = 'none';
$config->ui->themes['tree']['footer']['background']['backcolor']['default'] = '#F5F0CC';

/* Wide theme setting */
$config->ui->themes['wide']    = $config->ui->selectorOptions;
unset($config->ui->themes['wide']['basic']['pageBackground']);
unset($config->ui->themes['wide']['basic']['border']);
unset($config->ui->themes['wide']['basic']['aLink']);
unset($config->ui->themes['wide']['basic']['aVisited']);
unset($config->ui->themes['wide']['basic']['aHover']);
unset($config->ui->themes['wide']['navbar']);
unset($config->ui->themes['wide']['button']);
unset($config->ui->themes['wide']['block']);
unset($config->ui->themes['wide']['footer']);
$config->ui->themes['wide']['basic']['colorset']['primary']['default'] = '#E91B23';

/* Colorful theme setting */
$config->ui->themes['colorful']    = $config->ui->selectorOptions;
unset($config->ui->themes['colorful']['basic']['pageBackground']['repeat']);
unset($config->ui->themes['colorful']['basic']['pageBackground']['position']);
unset($config->ui->themes['colorful']['basic']['aLink']);
unset($config->ui->themes['colorful']['basic']['aVisited']);
unset($config->ui->themes['colorful']['basic']['aHover']);
unset($config->ui->themes['colorful']['navbar']);
unset($config->ui->themes['colorful']['button']);
unset($config->ui->themes['colorful']['block']);
$config->ui->themes['colorful']['basic']['colorset']['primary']['default'] = '#D1270A';
