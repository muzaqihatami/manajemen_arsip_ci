<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use App\Models\ModelSuratMasuk;
use App\Models\ModelAgendaSuratMasuk;
use App\Models\ModelDisposisi;

class Disposisi extends BaseController
{
    public function __construct()
    { 
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        helper(['form', 'url']);
    }

    public function insert() {
        if($this->request->isAJAX()){
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'diteruskan_kpd' => 'required',
                'catatan' => 'required',
            ]);
    
            $isDataValid = $validation->withRequest($this->request)->run();
            if($isDataValid){
                $file = $this->request->getFile('file_disposisi');
                if($file != null) {
                    $file_ext = $file->getClientMimeType();
                    if($file_ext == 'application/pdf') {
                        $model = new ModelDisposisi();
                        $total = $model->countAll();
                        $file_name = 'disposisi_'.date("Y").strval($total+1).'.pdf';
                        $file->move(FCPATH . '/disposisi/'.date("Y"), $file_name);
                        
                        $model->insert([
                            "id_disposisi" => 'DSP'.date("y").sprintf("%04d", $total+1),
                            "diteruskan_kpd" => $this->request->getPost('diteruskan_kpd'),
                            "catatan" => $this->request->getPost('catatan'),
                            "file" => $file_name
                        ]);
            
                        $model_sm = new ModelSuratMasuk();
                        $model_sm->where('id_surat', $this->request->getPost('id_surat'))->set('id_disposisi', 'DSP'.date("y").sprintf("%04d", $total+1))->update();
            
                        $resp = [
                            'message' => 'success'
                        ];
                        return $this->response->setJSON($resp);
                    } else {
                        $resp = [
                            'message' => 'File Disposisi harus berformat pdf. Mohon di cek kembali',
                            'errors' => $validation->getErrors(),
                        ];
                        return $this->response->setStatusCode(400)->setJSON($resp);
                    }
                } else {
                    $resp = [
                        'message' => 'File Disposisi harus diinput. Mohon di cek kembali',
                        'errors' => $validation->getErrors(),
                    ];
                    return $this->response->setStatusCode(400)->setJSON($resp);
                }
            } else {
                $resp = [
                    'message' => 'Input tidak valid. Mohon di cek kembali',
                    'errors' => $validation->getErrors(),
                ];
                return $this->response->setStatusCode(400)->setJSON($resp);
            }
        } else {
            $resp = [
                'message' => 'Input tidak valid. Mohon di cek kembali',
                'errors' => $validation->getErrors(),
            ];
            return $this->response->setStatusCode(400)->setJSON($resp);
        }
    }

    public function get($id) {
        $model = new ModelDisposisi();
        $data = $model->where('id_disposisi', $id)->get()->getRow();
        $resp = array(
            'result' => $data
        );
        return $this->response->setJSON($resp);
    }

    public function download_file($id) {
        $model = new ModelDisposisi();
        $data = $model->select('disposisi.*, surat_masuk.tgl_surat')->join('surat_masuk', 'surat_masuk.id_disposisi = disposisi.id_disposisi')->where('disposisi.id_disposisi', $id)->get()->getRow();
        
        $folderpath = FCPATH.'disposisi/'.date('Y', strtotime($data->tgl_surat));
        $filepath = $folderpath.'/'.$data->file;
        return $this->response->download($filepath, null);
    }
}