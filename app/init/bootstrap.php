<?php require_once('Connections/DB_Conn.php'); ?>
<?php 
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB;
// 创建链接
$db->addConnection($database);
// 设置全局静态可访问
$db->setAsGlobal();
// 启动Eloquent
$db->bootEloquent();

require_once('app/init/inc_permission.php');
require_once('app/init/inc_setting_fr.php');
require_once('app/init/inc_setting_lang.php');
require_once('app/init/inc_mdname.php');
require_once('app/init/inc_path.php');
require_once('app/init/inc_function.php');
?>