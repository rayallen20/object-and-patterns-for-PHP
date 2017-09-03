<?php
// 现在，需求变更了。要求支持xml格式的文件读取

function readParams($file)
{
    $params = [];
    if(preg_match("/\.xml$/i",$file))
    {
        // 从$file中读取xml参数
    }
    else
    {
        // 从$file中读取文本参数
    }

    return $params;
}

function writeParams($params, $file)
{
    if(preg_match("/\.xml$/i",$file))
    {
        // 写入XML到$file
    }
    else
    {
        // 写入key:value到$file
    }
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

/*
 * 对比procedure-oriented.php和procedure-oriented2.php
 * 我们可以发现 readParams和writeParams两个方法中 总有些代码是重复的
 * 且必须保持这些重复代码的一致性 不利于维护
 * */