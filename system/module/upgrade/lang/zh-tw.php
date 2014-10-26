<?php
/**
 * The upgrade module zh-tw file of ZenTaoPMS.
 *
 * @copyright   Copyright 2013-2013 青島息壤網絡信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license 
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     upgrade
 * @version     $$
 * @link        http://www.chanzhi.org
 */
$lang->upgrade->common  = '升級';

$lang->upgrade->result  = '升級結果';
$lang->upgrade->fail    = '升級失敗';
$lang->upgrade->success = '升級成功';
$lang->upgrade->tohome  = '返迴首頁';

$lang->upgrade->backup        = '備份數據';
$lang->upgrade->selectVersion = '確認升級之前的版本';
$lang->upgrade->confirm       = '確認要執行的SQL語句';
$lang->upgrade->execute       = '確認執行';
$lang->upgrade->next          = '下一步';

$lang->upgrade->backupData = <<<EOT
<pre>
<strong>使用phpMyAdmin或者mysqldump命令備份資料庫。</strong>
<textarea class='autoSelect w-500px red' readonly rows='1' > mysqldump -u %s -p%s %s > chanzhi.sql </textarea>
</pre>
EOT;

$lang->upgrade->versionNote = "務必選擇正確的版本，否則會造成數據丟失。";

$lang->upgrade->fromVersions['1_1']      = '1.1.stable';
$lang->upgrade->fromVersions['1_2']      = '1.2.stable';
$lang->upgrade->fromVersions['1_3']      = '1.3.stable';
$lang->upgrade->fromVersions['1_4']      = '1.4.stable';
$lang->upgrade->fromVersions['1_5']      = '1.5.stable';
$lang->upgrade->fromVersions['1_6']      = '1.6.stable';
$lang->upgrade->fromVersions['1_7']      = '1.7.stable';
$lang->upgrade->fromVersions['1_8']      = '1.8.stable';
$lang->upgrade->fromVersions['2_0']      = '2.0.stable';
$lang->upgrade->fromVersions['2_0_1']    = '2.0.1.stable';
$lang->upgrade->fromVersions['2_1']      = '2.1.stable';
$lang->upgrade->fromVersions['2_2']      = '2.2.stable';
$lang->upgrade->fromVersions['2_2_1']    = '2.2.1.stable';
$lang->upgrade->fromVersions['2_3']      = '2.3.stable';
$lang->upgrade->fromVersions['2_4']      = '2.4.stable';
$lang->upgrade->fromVersions['2_5_beta'] = '2.5.beta';
$lang->upgrade->fromVersions['2_5_1']    = '2.5.1';
$lang->upgrade->fromVersions['2_5_2']    = '2.5.2';
$lang->upgrade->fromVersions['2_5_3']    = '2.5.3';
$lang->upgrade->fromVersions['3_0']      = '3.0';
$lang->upgrade->fromVersions['3_0_1']    = '3.0.1';
