<?php

namespace App\Controllers;
use App\Models\ModelPermintaanSuratKeluar;

class Permintaan extends BaseController
{
    public function index()
    {
        return view('permintaan/index');
    }

    public function response()
    {
        return view('permintaan/response');
    }

    public function insert()
    {
        $session = \Config\Services::session();
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'pemohon' => 'required',
            'tujuan_surat' => 'required',
            'perihal' => 'required',
            'catatan' => 'required',
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if($isDataValid){
            $model = new ModelPermintaanSuratKeluar();
            $total_permintaan = $model->countAll();
            
            $model->insert([
                "id_permintaan" => 'PMSK'.date("y").sprintf("%03d", $total_permintaan+1),
                "pemohon" => $this->request->getPost('pemohon'),
                "tujuan_surat" => $this->request->getPost('tujuan_surat'),
                "perihal" => $this->request->getPost('perihal'),
                "catatan" => $this->request->getPost('catatan'),
            ]);

            return redirect()->to('/permintaan/success');  
        } else {
            $_SESSION['error'] = 'input tidak boleh ada yang kosong';
            $session->markAsFlashdata('error');
            return view('permintaan/index');
        }
    }
}