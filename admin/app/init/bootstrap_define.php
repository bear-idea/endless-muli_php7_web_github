<?php
define('BASEPATH', dirname(__DIR__, 3));
define('SITEPATH', dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'site');
define('ADMINPATH', dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'admin');
define('BASEURL', rtrim($SiteBaseUrl, '/'));
define('ADMINURL', $SiteBaseUrl . rtrim($SiteBaseAdminPath, '/'));
define('CONNPATH', dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . '');
