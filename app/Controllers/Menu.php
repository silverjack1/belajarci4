<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Menu extends BaseController
{
    protected $MenuModel;

    public function index()
    {

        $model = new MenuModel();
        $all_data = $model->getSubMenu()->getResultArray();
        $sorted = getMenuku($all_data);
        d($sorted);
        echo '<ul>';
        foreach ($sorted as $s => $x) {
            echo '<li>' . $s . '</li>';
            if (is_array($x)) {
                echo '<ul>';
                foreach ($x as $v => $h) {
                    echo '<li>' . $h['title'] . '</li>';
                }
                echo '</ul>';
            }
        }
        echo '</ul>';
    }
}