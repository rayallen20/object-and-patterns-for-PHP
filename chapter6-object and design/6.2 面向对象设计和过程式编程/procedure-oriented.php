<?php
// 以 key:value的格式读取文本

function readParams($file)
{
    $params = [];
    // 从$file中读取文本参数
    return $params;
}

function writeParams($params, $file)
{
    // 写入参数到$file中
}

// 调用
$file = "./param.txt";
$array['key1'] = 'val1';
$array['key2'] = 'val2';
$array['key3'] = 'val3';
writeParams($array, $file);
$output = readParams($file);
var_dump($output);
die;