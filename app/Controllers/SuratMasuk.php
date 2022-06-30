<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use App\Models\ModelSuratMasuk;
use App\Models\ModelAgendaSuratMasuk;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SuratMasuk extends BaseController
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
        if($this->request->isAJAX()) {
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'tanggal_surat' => 'required',
                'no_surat' => 'required',
                'pengirim' => 'required',
                'perihal' => 'required',
            ]);
    
            $isDataValid = $validation->withRequest($this->request)->run();
            if($isDataValid){
                    $model = new ModelSuratMasuk();
    
                    $file = $this->request->getFile('file');
                    $file_ext = $file->getClientMimeType();
                    if($file_ext == 'application/pdf') {
                        $file_name = 'surat-masuk_'.date("YmdHis").'.pdf';
            
                        $file->move(ROOTPATH . 'public/surat_masuk/'.date("Y"), $file_name);
        
                        $total_surat = $model->countAll();
                
                        $suratmasuk = $model->insert([
                            "id_admin" => 'ADM001',
                            "id_surat" => 'SM'.date("y").sprintf("%04d", $total_surat+1),
                            "tgl_surat" => $this->request->getPost('tanggal_surat'),
                            "no_surat" => $this->request->getPost('no_surat'),
                            "pengirim" => $this->request->getPost('pengirim'),
                            "perihal" => $this->request->getPost('perihal'),
                            "tujuan" => $this->request->getPost('tujuan'),
                            "file" => $file_name,
                        ]);
        
                        $model_agenda = new ModelAgendaSuratMasuk();
                        $model_agenda->insert([
                            "id_agenda" => 'AGSM'.date("ym").sprintf("%03d", $total_surat+1),
                            "id_surat" => 'SM'.date("y").sprintf("%04d", $total_surat+1),
                            "no_msk_surat" => sprintf("%04d", $total_surat+1).'/-1.851.75',
                        ]);
    
                        $resp = [
                            'message' => 'success'
                        ];
                        return $this->response->setJSON($resp);
                    } else {
                        $resp = [
                            'message' => 'File harus berformat pdf. Mohon di cek kembali',
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
                'message' => 'Terjadi kesalahan Server. Harap Mencoba lagi nanti',
                'errors' => 'Invalid Request not Ajax Request',
            ];
            return $this->response->setStatusCode(500)->setJSON($resp);
        }
    }

    public function agenda_filter(){
        $model = new ModelAgendaSuratMasuk();
        $data_agenda = $model->join('surat_masuk', 'surat_masuk.id_surat = agenda_srt_msk.id_surat');

        if($this->request->getPost("from_date") != null && $this->request->getPost("from_date") != "") {
            $data_agenda = $data_agenda->where('tgl_msk_surat >=', $this->request->getPost("from_date"));
        } 

        if($this->request->getPost("to_date") != null && $this->request->getPost("to_date") != "") {
            $to_date = date('Y-m-d H:i:s', strtotime($this->request->getPost("to_date"). ' + 24 hours'));
            $data_agenda = $data_agenda->where('tgl_msk_surat <=', $to_date);
        } 

        $resp = array(
            'result' => $data_agenda->findAll()
        );
        return $this->response->setJSON($resp);
    }

    public function agenda_download(){
        $model = new ModelAgendaSuratMasuk();
        $data_agenda = $model->join('surat_masuk', 'surat_masuk.id_surat = agenda_srt_msk.id_surat');

        if($this->request->getGet("from_date") != null && $this->request->getGet("from_date") != "") {
            $data_agenda = $data_agenda->where('tgl_msk_surat >=', $this->request->getGet("from_date"));
        } 

        if($this->request->getGet("to_date") != null && $this->request->getGet("to_date") != "") {
            $to_date = date('Y-m-d H:i:s', strtotime($this->request->getGet("to_date"). ' + 24 hours'));
            $data_agenda = $data_agenda->where('tgl_msk_surat <=', $to_date);
        } 

        $data = $data_agenda->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No Masuk Surat')
                ->setCellValue('B1', 'Tanggal Masuk')
                ->setCellValue('C1', 'No Surat')
                ->setCellValue('D1', 'Tanggal Surat')
                ->setCellValue('E1', 'Pengirim')
                ->setCellValue('F1', 'Perihal');
        
        $row = 2;
        foreach($data as $d) {
            $sheet->setCellValue('A' . $row, $d['no_msk_surat']);
            $sheet->setCellValue('B' . $row, date('Y F d', strtotime($d["tgl_msk_surat"])));
            $sheet->setCellValue('C' . $row, $d['no_surat']);
            $sheet->setCellValue('D' . $row, date('Y F d', strtotime($d["tgl_surat"])));
            $sheet->setCellValue('E' . $row, $d['pengirim']);
            $sheet->setCellValue('F' . $row, $d['perihal']);
            $row++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Agenda Surat Masuk';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function search(){
        $model = new ModelSuratMasuk();
        $data = $model->join('agenda_srt_msk', 'agenda_srt_msk.id_surat = surat_masuk.id_surat')->like('perihal', '%'.$this->request->getGet("s").'%')->orLike('no_msk_surat', '%'.$this->request->getGet("s").'%')->findAll();
        $resp = array(
            'result' => $data
        );
        return $this->response->setJSON($resp);
    }

    public function searchAgenda(){
        $model = new ModelSuratMasuk();
        $data = $model->join('agenda_srt_msk', 'agenda_srt_msk.id_surat = surat_masuk.id_surat')->like('perihal', '%'.$this->request->getGet("s").'%')->orLike('no_surat', '%'.$this->request->getGet("s").'%')->orLike('pengirim', '%'.$this->request->getGet("s").'%')->orLike('no_msk_surat', '%'.$this->request->getGet("s").'%')->findAll();
        $resp = array(
            'result' => $data
        );
        return $this->response->setJSON($resp);
    }

    public function get($id){
        $model = new ModelSuratMasuk();
        $data = $model->join('agenda_srt_msk', 'agenda_srt_msk.id_surat = surat_masuk.id_surat')->join('admin', 'admin.id_admin = surat_masuk.id_admin')->where('surat_masuk.id_surat', $id)->get()->getRow();
        $resp = array(
            'result' => $data
        );
        return $this->response->setJSON($resp);
    }

    public function delete($id){
        $model = new ModelSuratMasuk();
        $model->where('id_surat', $id)->set("is_deleted", 1)->update();
        $model_agenda = new ModelAgendaSuratMasuk();
        $model_agenda->where('id_surat', $id)->set("is_deleted", 1)->update();
        
        return redirect()->to('/surat/masuk'); 
    }

    public function download_file($id){
        $model = new ModelSuratMasuk();
        $data = $model->where('id_surat', $id)->get()->getRow();

        $folderpath = FCPATH.'surat_masuk/'.date('Y', strtotime($data->tgl_surat));
        $filepath = $folderpath.'/'.$data->file;
        return $this->response->download($filepath, null);
    }

    public function edit($id){
        if($this->request->isAJAX()) {
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'tanggal_surat' => 'required',
                'no_surat' => 'required',
                'pengirim' => 'required',
                'perihal' => 'required',
                'tujuan' => 'required',
            ]);
    
            $isDataValid = $validation->withRequest($this->request)->run();
            if($isDataValid){
                    $model = new ModelSuratMasuk();
    
                    $suratmasuk = $model->set([
                        "id_admin" => 'ADM001',
                        "tgl_surat" => $this->request->getPost('tanggal_surat'),
                        "no_surat" => $this->request->getPost('no_surat'),
                        "pengirim" => $this->request->getPost('pengirim'),
                        "perihal" => $this->request->getPost('perihal'),
                        "tujuan" => $this->request->getPost('tujuan')
                    ])->where("id_surat", $id)->update();

                    $file = $this->request->getFile('file');
                    if($file != null) {
                        $file_ext = $file->getClientMimeType();
                        if($file_ext == 'application/pdf') {
                            $file_name = 'surat-masuk_'.date("YmdHis").'.pdf';
                            $file->move(ROOTPATH . 'public/surat_masuk/'.date("Y"), $file_name);
                            $model->set("file", $file_name)->where("id_surat", $id)->update();
                        } 
                    }
                    $resp = [
                        'message' => 'success'
                    ];
                    return $this->response->setJSON($resp);
            } else {
                $resp = [
                    'message' => 'Input tidak valid. Mohon di cek kembali',
                    'errors' => $validation->getErrors(),
                ];
                return $this->response->setStatusCode(400)->setJSON($resp);
            }
        } else {
            $resp = [
                'message' => 'Terjadi kesalahan Server. Harap Mencoba lagi nanti',
                'errors' => 'Invalid Request not Ajax Request',
            ];
            return $this->response->setStatusCode(500)->setJSON($resp);
        }
    }
}