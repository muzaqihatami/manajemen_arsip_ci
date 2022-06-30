<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use App\Models\ModelKategori;
use App\Models\ModelAgendaSuratKeluar;
use App\Models\ModelPermintaanSuratKeluar;
use App\Models\ModelSubKategori;
use App\Models\ModelSuratKeluar;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class SuratKeluar extends BaseController
{
    public function __construct()
    { 
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        helper(['form', 'url', 'array', 'download']);
    }

    public function create()
    {
        $model_kategori = new ModelKategori();
        $kategori = $model_kategori->where('id_kategori', $this->request->getPost('kategori'))->get()->getRow();

        $model_sub_kategori = new ModelSubKategori();
        $sub = $model_sub_kategori->where('id_sub_kategori', $this->request->getPost('sub_kategori'))->get()->getRow();

        $sk = new ModelSuratKeluar();
        $total_surat = $sk->where("id_kategori", $this->request->getPost('kategori'))->countAll();
        $no_surat_temp = $kategori->format_no;
        $no_surat = str_replace("{no}",sprintf("%04d", $total_surat+1), $no_surat_temp);
        if(str_contains('{tahun}', $no_surat)){
            $no_surat = str_replace("{tahun}",date("Y"),$no_surat);
        }
        $sk->insert([
            "id_admin" => 'ADM001',
            "id_surat" => 'SK'.$kategori->inisial.date("y").sprintf("%04d", $total_surat+1),
            "id_kategori" => $this->request->getPost('kategori'),
            "id_sub_kategori" => $this->request->getPost('sub_kategori'),
            "no_surat" => $no_surat,
            "keterangan" => $this->request->getPost('keterangan'),
            "perihal" => $this->request->getPost('perihal'),
            "tujuan_surat" => $this->request->getPost('tujuan'),
        ]);

        $model_agenda = new ModelAgendaSuratKeluar();
        $model_agenda->insert([
            "id_agenda" => 'AGSK'.date("ym").sprintf("%04d", $total_surat+1),
            "id_surat" => 'SK'.$kategori->inisial.date("y").sprintf("%04d", $total_surat+1)
        ]);

        $model_permintaan = new ModelPermintaanSuratKeluar();
        $model_permintaan->where('id_permintaan', $this->request->getPost('id_permintaan'))->set('is_created', 1)->set('id_admin', 'ADM001')->update();

        $file_format = FCPATH.'sub_kategori/format/'.$sub->format_file;
        $phpword = new \PhpOffice\PhpWord\TemplateProcessor($file_format);

        $phpword->setValue('{no}',$no_surat);
        $phpword->setValue('{tanggal}',date('d'));
        $phpword->setValue('{bulan}',date('F'));
        $phpword->setValue('{tahun}',date('Y'));

        $folderpath = FCPATH.'surat_keluar/temp/sk-';
        if (!is_dir($folderpath)) {
            mkdir($folderpath, 0777, TRUE);
        }

        $filepath = $folderpath.sprintf("%04d", $total_surat+1).'.docx';
        $phpword->saveAs($filepath);
        return $this->response->download($filepath, null);
    }

    public function init($id_permintaan){
        $model_permintaan = new ModelPermintaanSuratKeluar();
        $permintaan = $model_permintaan->where('id_permintaan', $id_permintaan)->get()->getRow();
        $resp = array(
            'id_permintaan' => $id_permintaan,
            'result' => $permintaan
        );
        return $this->response->setJSON($resp);
    }

    public function sub_kategori($id_kategori){
        $model_sub_kategori = new ModelSubKategori();
        $permintaan = $model_sub_kategori->where('id_kategori', $id_kategori)->findAll();
        $resp = array(
            'result' => $permintaan
        );
        return $this->response->setJSON($resp);
    }

    public function agenda_filter(){
        $model = new ModelAgendaSuratKeluar();
        $data_agenda = $model->join('surat_keluar', 'surat_keluar.id_surat = agenda_srt_keluar.id_surat')->join('kategori_surat','surat_keluar.id_kategori = kategori_surat.id_kategori');

        if($this->request->getPost("kategori") != null && $this->request->getPost("kategori") != "") {
            $data_agenda = $data_agenda->where('surat_keluar.id_kategori', $this->request->getPost("kategori"));
        } 

        if($this->request->getPost("from_date") != null && $this->request->getPost("from_date") != "") {
            $data_agenda = $data_agenda->where('tgl_keluar_surat >=', $this->request->getPost("from_date"));
        } 

        if($this->request->getPost("to_date") != null && $this->request->getPost("to_date") != "") {
            $to_date = date('Y-m-d H:i:s', strtotime($this->request->getPost("to_date"). ' + 24 hours'));
            $data_agenda = $data_agenda->where('tgl_keluar_surat <=', $to_date);
        } 

        $resp = array(
            'result' => $data_agenda->findAll()
        );
        return $this->response->setJSON($resp);
    }

    public function agenda_download(){
        $model = new ModelAgendaSuratKeluar();
        $data_agenda = $model->join('surat_keluar', 'surat_keluar.id_surat = agenda_srt_keluar.id_surat')->join('kategori_surat','surat_keluar.id_kategori = kategori_surat.id_kategori');

        if($this->request->getGet("kategori") != null && $this->request->getGet("kategori") != "") {
            $data_agenda = $data_agenda->where('surat_keluar.id_kategori', $this->request->getGet("kategori"));
        } 

        if($this->request->getGet("from_date") != null && $this->request->getGet("from_date") != "") {
            $data_agenda = $data_agenda->where('tgl_keluar_surat >=', $this->request->getGet("from_date"));
        } 

        if($this->request->getGet("to_date") != null && $this->request->getGet("to_date") != "") {
            $to_date = date('Y-m-d H:i:s', strtotime($this->request->getGet("to_date"). ' + 24 hours'));
            $data_agenda = $data_agenda->where('tgl_keluar_surat <=', $to_date);
        } 

        $data = $data_agenda->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No Surat')
                ->setCellValue('B1', 'Tanggal Dibuat')
                ->setCellValue('C1', 'Tujuan')
                ->setCellValue('D1', 'Perihal')
                ->setCellValue('E1', 'keterangan');
        
        $row = 2;
        foreach($data as $d) {
            $sheet->setCellValue('A' . $row, $d['no_surat']);
            $sheet->setCellValue('B' . $row, date('Y F d', strtotime($d["tgl_keluar_surat"])));
            $sheet->setCellValue('C' . $row, $d['tujuan_surat']);
            $sheet->setCellValue('D' . $row, $d['perihal']);
            $sheet->setCellValue('E' . $row, $d['keterangan']);
            $row++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Agenda Surat Keluar';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function get($id)
    {
        $model = new ModelSuratKeluar();
        $data = $model->join('sub_kategori_surat', 'sub_kategori_surat.id_sub_kategori = surat_keluar.id_sub_kategori')->join('kategori_surat', 'kategori_surat.id_kategori = surat_keluar.id_kategori')->join('agenda_srt_keluar', 'agenda_srt_keluar.id_surat = surat_keluar.id_surat')->join('admin', 'admin.id_admin = surat_keluar.id_admin')->where("surat_keluar.id_surat", $id)->get()->getRow();

        $resp = array(
            'result' => $data
        );

        return $this->response->setJSON($resp);
    }

    public function delete($id)
    {
        $model = new ModelSuratKeluar();
        $data = $model->where("id_surat", $id)
            ->delete();

        $model_agenda = new ModelAgendaSuratKeluar();
        $data = $model->where("id_surat", $id)
            ->delete();

        return redirect()->to('/surat/keluar'); 
    }

    public function edit()
    {
        $model = new ModelSuratKeluar();
        $data = $model->where("id_surat", $this->request->getPost('id_surat'))->get()->getRow();

        $update = $model->where("id_surat", $this->request->getPost('id_surat'));
        $update->set("keterangan", $this->request->getPost('keterangan'))
            ->set("perihal", $this->request->getPost('perihal'))
            ->set("tujuan_surat", $this->request->getPost('tujuan'))
            ->update();

        if($this->request->getPost('kategori') != null && $this->request->getPost('kategori') != "") {
            if($this->request->getPost('kategori') != $data->id_kategori) {
                $model_kategori = new ModelKategori();
                $kategori = $model_kategori->where('id_kategori', $this->request->getPost('kategori'))->get()->getRow();
        
                $sk = new ModelSuratKeluar();
                $total_surat = $sk->where('id_kategori', $kategori->id_kategori)->countResult();
                $no_surat_temp = $kategori->format_no;
                $no_surat = str_replace("{no}",sprintf("%04d", $total_surat+1), $no_surat_temp);
                if(str_contains('{tahun}', $no_surat)){
                    $no_surat = str_replace("{tahun}",date("Y"),$no_surat);
                }

                $update->set("no_surat", $no_surat)
                    ->set("id_kategori", $this->request->getPost('kategori'))
                    ->update();
            }

            if($this->request->getPost('sub_kategori') != $data->id_sub_kategori){
                $update->set("id_sub_kategori", $this->request->getPost('sub_kategori'))->update();
                $model_sub_kategori = new ModelSubKategori();
                $sub = $model_sub_kategori->where('id_sub_kategori', $this->request->getPost('sub_kategori'))->get()->getRow();
                $file_format = FCPATH.'sub_kategori/format/'.$sub->format_file;
                $phpword = new \PhpOffice\PhpWord\TemplateProcessor($file_format);

                $phpword->setValue('{no}',$no_surat);
                $phpword->setValue('{tanggal}',date('d'));
                $phpword->setValue('{bulan}',date('F'));
                $phpword->setValue('{tahun}',date('Y'));

                $folderpath = FCPATH.'surat_keluar/temp/sk-';
                if (!is_dir($folderpath)) {
                    mkdir($folderpath, 0777, TRUE);
                }

                $filepath = $folderpath.sprintf("%04d", $total_surat+1).'.docx';
                $phpword->saveAs($filepath);
                return $this->response->download($filepath, null);
            }
        }

        return redirect()->to('/surat/keluar'); 
    }

    public function searchAgenda(){
        $model = new ModelSuratKeluar();
        $data = $model->join('agenda_srt_keluar', 'agenda_srt_keluar.id_surat = surat_keluar.id_surat')->like('perihal', '%'.$this->request->getGet("s").'%')->orLike('no_surat', '%'.$this->request->getGet("s").'%')->orLike('tujuan_surat', '%'.$this->request->getGet("s").'%')->findAll();
        $resp = array(
            'result' => $data
        );
        return $this->response->setJSON($resp);
    }

    public function search(){
        $model = new ModelSuratKeluar();
        $data = $model->join('kategori_surat', 'kategori_surat.id_kategori = surat_keluar.id_kategori')->like('perihal', '%'.$this->request->getGet("s").'%')->orLike('no_surat', '%'.$this->request->getGet("s").'%')->orLike('kategori', '%'.$this->request->getGet("s").'%')->findAll();
        $resp = array(
            'result' => $data
        );
        return $this->response->setJSON($resp);
    }

    public function download_file($id){
        $model = new ModelSuratMasuk();
        $data = $model->where('id_surat', $id)->get()->getRow();

        $folderpath = FCPATH.'surat_masuk/'.date('Y', strtotime($data->tgl_surat));
        $filepath = $folderpath.'/'.$data->file;
        return $this->response->download($filepath, null);
    }

    public function delete_permintaan($id){
        $model_permintaan = new ModelPermintaanSuratKeluar();
        $model_permintaan->where('id_permintaan', $id)->set('is_deleted', 1)->update();
        return redirect()->to('/surat/keluar/permintaan');  
    }
}