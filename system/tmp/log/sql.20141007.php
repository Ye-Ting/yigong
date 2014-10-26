<?php die();?> 
20141007 23:15:04: /install.php?m=install&f=step1

20141007 23:15:08: /install.php?m=install&f=step2

20141007 23:15:09: /install.php

20141007 23:15:43: /install.php?m=install&f=step3

20141007 23:15:55: /install.php?m=install&f=step3

20141007 23:16:15: /install.php?m=install&f=step3

20141007 23:16:21: /install.php?m=install&f=step3

20141007 23:18:23: /install.php?m=install&f=step4

20141007 23:18:32: /install.php?m=install&f=step4
  INSERT INTO yg_user SET `account` = 'admin',`realname` = 'admin',`password` = 'e533d72be7f43e504d5eb911ac764524',`admin` = 'super',`join` = '2014-10-07 23:18:32'
  REPLACE yg_config SET `owner` = 'system',`module` = 'common',`section` = 'global',`key` = 'version',`value` = '2.5.3'

20141007 23:18:32: /install.php?m=install&f=step5
  REPLACE yg_config SET `owner` = 'system',`module` = 'common',`section` = 'site',`key` = 'lang',`value` = 'zh-cn'

