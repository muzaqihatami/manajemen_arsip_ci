<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use App\Models\ModelKategori;
use App\Models\ModelSubKategori;

class SubKategori extends BaseController
{
    public function __construct()
    { 
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        helper(['form', 'url', 'array']);
    }

    public function insert()
    {
        if($this->request->isAJAX()) {
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'kategori' => 'required',
                'sub_kategori' => 'required'
            ]);
    
            $isDataValid = $validation->withRequest($this->request)->run();
            if($isDataValid){
                    $model_kategori = new ModelKategori();
                    $kategori = $model_kategori->select('id_kategori,inisial')->where('kategori', $this->request->getPost('kategori'))->get()->getRow();
                    
                    $model = new ModelSubKategori();
    
                    $file = $this->request->getFile('file');
            
                    $file_name = 'format_kat_'.$this->request->getPost('kategori').'_sub_'.$this->request->getPost('sub_kategori').'_'.date("YmdHis").'.docx';

                    $file->move(ROOTPATH . 'public/sub_kategori/format', $file_name);
    
                    $total_sub_kategori = $model->countAll();
            
                    $suratmasuk = $model->insert([
                        "id_kategori" => $kategori->id_kategori,
                        "id_sub_kategori" => 'SUB'.$kategori->inisial.sprintf("%02d", $total_sub_kategori+1),
                        "sub_kategori" => $this->request->getPost('sub_kategori'),
                        "format_file" => $file_name,
                    ]);

                    $resp = [
                        'message' => 'success'
                    ];
                    return $this->response->setJSON($resp);
            } else {
                $resp = [
                    'message' => 'error',
                    'errors' => $validation->getErrors(),
                ];
                return $this->response->setStatusCode(400)->setJSON($resp);
            }
        } else {
            $resp = [
                'message' => 'error',
                'errors' => 'Terjadi kesalahan Server',
            ];
            return $this->response->setStatusCode(500)->setJSON($resp);
        }
    }

    public function get($id)
    {
        $model = new ModelSubKategori();
        $sub = $model->where("id_sub_kategori", $id)->get()->getRow();

        $resp = array(
            'result' => $sub
        );

        return $this->response->setJSON($resp);
    }

    public function edit($id)
    {
        if($this->request->isAJAX()) {
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'sub_kategori' => 'required'
            ]);
    
            $isDataValid = $validation->withRequest($this->request)->run();
            if($isDataValid){
                    $model_kategori = new ModelKategori();
                    $kategori = $model_kategori->select('id_kategori,inisial')->where('kategori', $this->request->getPost('kategori'))->get()->getRow();
                    
                    $model = new ModelSubKategori();

                    $model->where('id_sub_kategori', $id)
                        ->set('sub_kategori', $this->request->getPost('sub_kategori'));

                    if(file_exists($this->request->getFile('file'))){
                        $file = $this->request->getFile('file');
            
                        $file_name = 'format_kat_'.$this->request->getPost('kategori').'_sub_'.$this->request->getPost('sub_kategori').'_'.date("YmdHis").'.docx';
    
                        $file->move(ROOTPATH . 'public/sub_kategori/format', $file_name);
                        $model->set("format_file", $file_name);
                    }
                    $model->update();
            
                    $resp = [
                        'message' => 'success'
                    ];
                    return $this->response->setJSON($resp);
            } else {
                $resp = [
                    'message' => 'error',
                    'errors' => $validation->getErrors(),
                ];
                return $this->response->setStatusCode(400)->setJSON($resp);
            }
        } else {
            $resp = [
                'message' => 'error',
                'errors' => 'Terjadi kesalahan Server',
            ];
            return $this->response->setStatusCode(500)->setJSON($resp);
        }
    }

    public function delete($id)
    {
        $model = new ModelSubKategori();
        $data_sub = $model->where("id_sub_kategori", $id)->get()->getRow();

        $model_kat = new ModelKategori();
        $kat = $model_kat->where("id_kategori", $data_sub->id_kategori)->get()->getRow();

        $model->where("id_sub_kategori", $id)
            ->delete();

        return redirect()->to('/kategori/'.$kat->kategori); 
    }
}