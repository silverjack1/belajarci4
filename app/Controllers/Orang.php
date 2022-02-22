<?php

namespace App\Controllers;

use App\Models\OrangModel;

class Orang extends BaseController
{
    protected $OrangModel;
    public function __construct()
    {
        $this->OrangModel = new OrangModel();
    }
    public function index()
    { 
        $keyword = $this->request->getVar('keyword');

        if($keyword){
            $orang = $this->OrangModel->search($keyword);
        }else {
            $orang = $this->OrangModel;
        }
        // $komik = $this->OrangModel->findAll();
        $current_page = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;

        $data = [
            'title' => 'Daftar Orang',
            // 'orang' => $this->OrangModel->findAll()
            'orang' => $orang->paginate(10,'orang'),
            'pager' => $this->OrangModel->pager,
            'current_page' => $current_page
        ];

        return view('orang/index', $data);
}
}