<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php
$webRoot   = $config->webRoot;
$jsRoot    = $webRoot . "js/";
$themeRoot = $webRoot . "template/default/theme/";
?>
<!DOCTYPE html>
<html xmlns:wb="http://open.weibo.com/wb">
<head profile="http://www.w3.org/2005/10/profile">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Cache-Control"  content="no-transform">
  <meta name="Generator" content="<?php echo 'chanzhi' . $this->config->version . ' www.chanzhi.org'; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php if($this->app->getModuleName() == 'user' and $this->app->getMethodName() == 'deny'):?>
  <meta http-equiv='refresh' content="5;url='<?php echo helper::createLink('index');?>'">
  <?php endif;?>
  <?php
  if(!isset($title))   $title    = '';
  if(!empty($title))   $title   .= $lang->minus;
  if(empty($keywords)) $keywords = $config->site->keywords;
  if(empty($desc))     $desc     = $config->site->desc;

  echo html::title($title . $config->site->name);
  echo html::meta('keywords',    strip_tags($keywords));
  echo html::meta('description', strip_tags($desc));

  js::exportConfigVars();
  if($config->debug)
  {
      js::import($jsRoot . 'jquery/min.js');
      js::import($jsRoot . 'zui/min.js');
      js::import($jsRoot . 'chanzhi.js');
      js::import($jsRoot . 'jquery/treeview/min.js');
      js::import($jsRoot . 'my.js');

      css::import($webRoot . 'zui/css/min.css');
      css::import($themeRoot . 'common/style.css');
      css::import($jsRoot    . 'jquery/treeview/min.css');
  }
  else
  {
      css::import($themeRoot . 'default/all.css');
      js::import($jsRoot     . 'all.js');
  }

  if($config->template->theme != 'default' and $config->template->theme != 'colorful')
  {
      css::import($themeRoot . $config->template->theme . '/style.css');
  }

  /* Import customed css file if it exists. */
  $customCssFile = $this->app->getDataRoot() . 'css' . DS . $this->config->template->name . DS . $this->config->template->theme . DS . 'style.css';
  if(file_exists($customCssFile)) css::import(sprintf($webRoot . 'data/css/%s/%s/style.css?' . $this->config->template->customVersion, $config->template->name, $config->template->theme));

  if(isset($pageCSS)) css::internal($pageCSS);

  echo isset($this->config->site->favicon) ? html::icon(json_decode($this->config->site->favicon)->webPath) : html::icon($webRoot . 'favicon.ico');
  echo html::rss($this->createLink('rss', 'index', '', '', 'xml'), $config->site->name);
?>
<!--[if lt IE 9]>
<?php
if($config->debug)
{
    js::import($jsRoot . 'html5shiv/min.js');
    js::import($jsRoot . 'respond/min.js');
}
else
{
    js::import($jsRoot . 'all.ie8.js');
}
?>
<![endif]-->
<!--[if lt IE 10]>
<?php
if($config->debug)
{
    js::import($jsRoot . 'jquery/placeholder/min.js');
}
else
{
    js::import($jsRoot . 'all.ie9.js');
}
?>
<![endif]-->
<?php
js::set('lang', $lang->js);

if(!empty($config->oauth->sina)) $sina = json_decode($config->oauth->sina);
if(!empty($config->oauth->qq))   $qq   = json_decode($config->oauth->qq);
if(!empty($sina->verification)) echo $sina->verification; 
if(!empty($qq->verification))   echo $qq->verification;
if(!empty($sina->widget)) js::import('http://tjs.sjs.sinajs.cn/open/api/js/wb.js');

$this->block->printRegion($layouts, 'all', 'header');

if(isset($this->config->site->basestyle)) css::internal($this->config->site->basestyle);
?>
</head>
<body>
