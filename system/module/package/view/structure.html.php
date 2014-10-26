<?php
/**
 * The structure view file of package module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Yangyang Shi <shiyangyang@xirangit.com>
 * @package     package
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php 
$appRoot = $this->app->getAppRoot();
$files   = json_decode($package->files);
echo '<pre>';
foreach($files as $file => $md5) echo $appRoot . $file . "<br />";
echo '</pre>';
?>  
<?php include '../../common/view/footer.modal.html.php';?>
