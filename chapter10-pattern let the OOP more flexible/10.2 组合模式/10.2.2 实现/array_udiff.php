<?php
// Arrays to compare
$array1 = array(new stdclass, new stdclass,
    new stdclass, new stdclass,
);

$array2 = array(
    new stdclass, new stdclass,
);

// Set some properties for each object
$array1[0]->width = 11; $array1[0]->height = 3; // 第1次的$a
$array1[1]->width = 7;  $array1[1]->height = 1; // 第1次的$b   第2次的$b
$array1[2]->width = 2;  $array1[2]->height = 9; // 第2次的$a
$array1[3]->width = 5;  $array1[3]->height = 7;

$array2[0]->width = 7;  $array2[0]->height = 5;
$array2[1]->width = 9;  $array2[1]->height = 2;

/*
 * array_udiff的一些说明
 * 首先 在自定义的callback函数中 必须遵循以下规则:
 * 在第一个参数<第二个参数时 返回一个<0的整数
 * 在第一个参数>第二个参数时 返回一个>0的整数
 * 在第一个参数=第二个参数时 返回0
 * 其中 返回0就被判定是$a和$b相同 不会被过滤出来
 *
 * 其次 $a $b 是什么
 * 指的是两个数组中的每一个value 不包括key
 *
 * 第三 自定义callback函数的意义何在
 * 如同下面这个例子 我现在不想单纯的比较大小
 * 而是想通过一些计算后 比较大小
 * 在这个例子中 面积相同的情况下 自定义callback函数return 0
 * 即认为面积相同的stdClass就是一样的value 不会被过滤出来
 * */
function compare_by_area($a, $b) {
    $areaA = $a->width * $a->height;
    $areaB = $b->width * $b->height;

    if ($areaA < $areaB) {
        return -1;
    } elseif ($areaA > $areaB) {
        return 1;
    } else {
        return 0;
    }
}

var_dump(array_udiff($array1, $array2, 'compare_by_area'));
