<?php


/******   备份数据库结构 ******/
  
      /*
      函数名称：table2sql()
      函数功能：把表的结构转换成为SQL
      函数参数：$table: 要进行提取的表名
      返 回 值：返回提取后的结果，SQL集合
      函数作者：heiyeluren
      */
     function table2sql($table)
      {
          global $db;
         $tabledump = "DROP TABLE IF EXISTS $table;\n";
         $createtable = $db->query("SHOW CREATE TABLE $table");
         $create = $db->fetch_row($createtable);
         $tabledump .= $create[1].";\n\n";
          return $tabledump;
      }
  
  
     /****** 备份数据库结构和所有数据 ******/
      /*
      函数名称：data2sql()
      函数功能：把表的结构和数据转换成为SQL
      函数参数：$table: 要进行提取的表名
      返 回 值：返回提取后的结果，SQL集合
      函数作者：heiyeluren
      */
     function data2sql($table)
      {
          global $db;
         $tabledump = "DROP TABLE IF EXISTS $table;\n";
         $createtable = $db->query("SHOW CREATE TABLE $table");
         $create = $db->fetch_row($createtable);
         $tabledump .= $create[1].";\n\n";
  
         $rows = $db->query("SELECT * FROM $table");
         $numfields = $db->num_fields($rows);
         $numrows = $db->num_rows($rows);
          while ($row = $db->fetch_row($rows))
          {
             $comma = "";
             $tabledump .= "INSERT INTO $table VALUES(";
              for($i = 0; $i < $numfields; $i++)
              {
                 $tabledump .= $comma."'".mysqli_escape_string($row[$i])."'";
                 $comma = ",";
              }
             $tabledump .= ");\n";
          }
         $tabledump .= "\n";
  
          return $tabledump;
      }
?>

<?php     
$host="localhost"; //主机名     
$user="root"; //MYSQL用户名     
$password="min"; //密码     
$dbname="dedecmsv4"; //备份的数据库     
   
mysqli_connect($host,$user,$password);     
mysqli_select_db($dbname);     
   
$q1=mysqli_query($DB_Conn, "show tables");     
while($t=mysqli_fetch_array($q1)){     
$table=$t[0];     
$q2=mysqli_query($DB_Conn, "show create table `$table`");     
$sql=mysqli_fetch_array($q2);     
$mysql.=$sql['Create Table'].";\r\n\r\n";#DDL     
   
$q3=mysqli_query($DB_Conn, "select * from `$table`");     
while($data=mysqli_fetch_assoc($q3))     
{     
$keys=array_keys($data);     
$keys=array_map('addslashes',$keys);     
$keys=join('`,`',$keys);     
$keys="`".$keys."`";     
$vals=array_values($data);     
$vals=array_map('addslashes',$vals);     
$vals=join("','",$vals);     
$vals="'".$vals."'";     
   
$mysql.="insert into `$table`($keys) values($vals);\r\n";     
}     
$mysql.="\r\n";     
   
}     
$filename=date('Ymd')."_".$dbname.".sql"; //文件名为当天的日期     
$fp = fopen($filename,'w');     
fputs($fp,$mysql);     
fclose($fp);     
echo "数据备份成功,生成备份文件".$filename;     
?>
