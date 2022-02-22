<?php

namespace App\Models;

class MenuModel
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }
    public function getMenu($key)
    {
        $builder = $this->db->table('user_access_menu');
        $builder->join('user_menu', 'user_access_menu.menu_id = user_menu.id');
        $builder->join('user_sub_menu', 'user_access_menu.menu_id = user_sub_menu.id');
        $builder->where('role_id', $key);
        $query = $builder->get();
        return $query;
    }
    public function getSubMenu()
    {
        $builder = $this->db->table('user_sub_menu as sub');
        $builder->select('sub.*, menu.menu as menu');
        $builder->join('user_menu as menu', 'sub.menu_id = menu.id', "left");
        $builder->orderBy('menu.id', 'ASC');
        $query = $builder->get();
        return $query;
    }
}