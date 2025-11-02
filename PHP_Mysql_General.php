<?php 
function SQLCreator($type = 'insert',$params){
    $type = strtolower($type);
    if(!in_array($type,array('insert','update'))){
        die('errors');
    }
    $data = array();
    $result = '';
    foreach($params['value'] as $key=>$value){
        if(in_array($key,$params['field'])){
            $field = sprintf('`%s`',$key);
            $value = sprintf("'%s'",(!get_magic_quotes_gpc())?addslashes($value):$value);
            $data[$field] = $value;
        }
    }
     
    switch($type){
        case 'insert':
            $table = $params['table'];
            $fields = implode(",",array_keys($data));
            $values = implode(",",array_values($data));
            $result = sprintf("INSERT INTO `%s` (%s) VALUES (%s)",$table,$fields,$values);
            break;
        case 'update':
            $table = $params['table'];
            $fields = array();
            foreach($data as $key => $value){
                $fields[] = sprintf('%s=%s',$key,$value);
            }
            $fields = implode(',',$fields);
            $result = sprintf("UPDATE SET `%s` (%s)",$table,$fields);
            if($params['condition']){
                $result .= ' ' . $params['condition'];
            }
            break;
    }
    return $result;
}
 
$params = array(
    //定義資料表名
    'table'=>'test',
    //定義資料表欄位
    'field'=>array('field'),
    //定義欄位的值array('欄位'=>'值'); 
    'value'=>array(
        'field'=>'test'
    ),
    //在使用UPDATE時所需的條件
    'condition'=>'WHERE s_id = 1'
);
//第一個參數是傳入insert或者是update
echo SQLCreator('update',$params);
//PS.無法在值裡面定義MySQL的函式喔，這一點要注意，如果要在欄位裡面用成MySQL的函式就要再修正一下傳入值的方法，有要用的人就自行修改，不夠這個目前足以應付很多的INSERT或是UPDATE了
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
</body>
</html>