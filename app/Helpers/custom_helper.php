<?php

function getMenuArray($all_data)
{
    $array = array();

    foreach ($all_data as $a => $v) {
        if (!array_key_exists($v['menu'], $array)) {
            $array[$v['menu']] = [];
        }

        $array[$v['menu']][]['title'] = $v['title'];
        $array[$v['menu']][]['icon'] = $v['icon'];
    }
    return $array;
}

function getMenuku($arr)
{
    $new = [];

    foreach ($arr as $row) {
        if (!isset($row['menu'])) $new[$row['id']] = $row;
    }

    foreach ($arr as $child) {
        if (isset($child['menu'])) {
            $new[$child['menu']][] = $child;
        }
    }

    return $new;
}