<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use App\Models\ModelKategori;

class Kategori extends BaseController
{
    public function __construct()
    { 
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        helper(['form', 'url']);
    }

    public function insert()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'kategori' => 'required',
            'format_no' => 'required',
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if($isDataValid){
            $model = new ModelKategori();
            $total_kategori = $model->countAll();
            
            $model->insert([
                "id_kategori" => 'KTG'.sprintf("%03d", $total_kategori+1),
                "kategori" => $this->request->getPost('kategori'),
                "format_no" => $this->request->getPost('format_no'),
                "inisial" => $this->request->getPost('inisial')
            ]);

            return redirect()->to('/kategori');  
        }
    }

    public function get($id)
    {
        $model = new ModelKategori();
        $kategori = $model->where("id_kategori", $id)->get()->getRow();

        $resp = array(
            'result' => $kategori
        );

        return $this->response->setJSON($resp);
    }

    public function edit($id)
    {
        $model = new ModelKategori();
        $kategori = $model->where("id_kategori", $id)
            ->set("kategori", $this->request->getPost('kategori'))
            ->set("format_no", $this->request->getPost('format_no'))
            ->set("inisial", $this->request->getPost('inisial'))
            ->update();

        return redirect()->to('/kategori'); 
    }

    public function delete($id)
    {
        $model = new ModelKategori();
        $kategori = $model->where("id_kategori", $id)
            ->delete();

        return redirect()->to('/kategori'); 
    }
}