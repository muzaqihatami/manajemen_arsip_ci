<?php
namespace App\Controllers;

use CodeIgniter\I18n\Time;
use App\Models\ModelAgendaSuratMasuk;
use App\Models\ModelAgendaSuratKeluar;
use App\Models\ModelKategori;
use App\Models\ModelPermintaanSuratKeluar;
use App\Models\ModelSubKategori;
use App\Models\ModelSuratMasuk;
use App\Models\ModelSuratKeluar;

class Admin extends BaseController
{
    public function __construct()
    { 
        helper(['form', 'url', 'array']);
    }

    public function index()
    {
        $data = [
            'title' => 'Sistem Manajemen Arsip - Dashboard',
            'page_title' => 'SISTEM MANAJEMEN ARSIP SMKN 48',
            'admin_name' => 'Admin'
        ];

        $timenow = new Time('now');

        $model_agenda_sm = new ModelAgendaSuratMasuk();
        $data_agenda_sm = $model_agenda_sm->join('surat_masuk', 'surat_masuk.id_surat = agenda_srt_msk.id_surat')->where("agenda_srt_msk.is_deleted", 0)->limit(4)->get()->getResultArray();

        $model_agenda_sk = new ModelAgendaSuratKeluar();
        $data_agenda_sk = $model_agenda_sk->join('surat_keluar', 'surat_keluar.id_surat = agenda_srt_keluar.id_surat')->join('kategori_surat','surat_keluar.id_kategori = kategori_surat.id_kategori')->limit(4)->get()->getResultArray();

        $month = date("F",strtotime($timenow));

        $model_sm = new ModelSuratMasuk();
        $model_sk = new ModelSuratKeluar();
        $model_permintaan = new ModelPermintaanSuratKeluar();

        $data_dashboard = [
            'jumlah_sk' => $model_sk->where('MONTH(tgl_surat)', date("m"))->countAllResults(),
            'bulan_sk' => $month,
            'jumlah_sm' => $model_sm->where('MONTH(tgl_surat)', date("m"))->where("is_deleted", 0)->countAllResults(),
            'bulan_sm' => $month,
            'jumlah_perm_sk' => $model_permintaan->where('is_created', 0)->countAllResults(),
            'agenda_sk' => $data_agenda_sk,
            'agenda_sm' => $data_agenda_sm,
        ];

        return view('admin/layout/sidebar', $data)
            .view('admin/page/dashboard', $data_dashboard)
            .view('admin/layout/script');
    }

    public function surat_masuk(){
        $data = [
            'title' => 'Sistem Manajemen Arsip - Surat Masuk',
            'page_title' => 'Surat Masuk',
            'admin_name' => 'Admin',
        ];

        $model = new ModelSuratMasuk();
        $data_sm = $model->join('agenda_srt_msk', 'agenda_srt_msk.id_surat = surat_masuk.id_surat')->where('surat_masuk.is_deleted', 0)->findAll();

        $data_list = [
            'data' => $data_sm
        ];

        return view('admin/layout/sidebar', $data)
            .view('admin/page/suratmasuk', $data_list)
            .view('admin/layout/script');
    }

    public function surat_keluar(){
        $data = [
            'title' => 'Sistem Manajemen Arsip - Surat Keluar',
            'page_title' => 'Surat Keluar',
            'admin_name' => 'Admin',
        ];

        $model = new ModelSuratKeluar();
        $data_sk = $model->join('kategori_surat', 'kategori_surat.id_kategori = surat_keluar.id_kategori')->findAll();

        $model_kategori = new ModelKategori();
        $kategori = $model_kategori->select('id_kategori, kategori')->findAll();

        $data_list = [
            'data' => $data_sk,
            'kategori' => $kategori
        ];
        return view('admin/layout/sidebar', $data)
            .view('admin/page/suratkeluar', $data_list)
            .view('admin/layout/script');
    }

    public function agenda_surat_masuk(){
        $data = [
            'title' => 'Sistem Manajemen Arsip - Agenda Surat Masuk',
            'page_title' => 'Agenda Surat Masuk',
            'admin_name' => 'Admin',
        ];

        $model = new ModelAgendaSuratMasuk();
        $data_agenda = $model->join('surat_masuk', 'surat_masuk.id_surat = agenda_srt_msk.id_surat')->findAll();

        $data_list = [
            'data' => $data_agenda
        ];
        return view('admin/layout/sidebar', $data)
            .view('admin/page/agendasuratmasuk', $data_list)
            .view('admin/layout/script');
    }

    public function agenda_surat_keluar(){
        $data = [
            'title' => 'Sistem Manajemen Arsip - Agenda Surat Keluar',
            'page_title' => 'Agenda Surat Keluar',
            'admin_name' => 'Admin',
        ];

        $model = new ModelAgendaSuratKeluar();
        $data_agenda = $model->join('surat_keluar', 'surat_keluar.id_surat = agenda_srt_keluar.id_surat')->findAll();

        $model = new ModelKategori();
        $data_kat = $model->findAll();

        $data_list = [
            'data' => $data_agenda,
            'kategori' => $data_kat
        ];
        return view('admin/layout/sidebar', $data)
            .view('admin/page/agendasuratkeluar', $data_list)
            .view('admin/layout/script');
    }

    public function kategori(){
        $data = [
            'title' => 'Sistem Manajemen Arsip - Kategori',
            'page_title' => 'Kategori',
            'admin_name' => 'Admin',
        ];

        $model = new ModelKategori();
        $data_kat = $model->findAll();

        $data_list = [
            'data' => $data_kat
        ];
        return view('admin/layout/sidebar', $data)
            .view('admin/page/kategori', $data_list)
            .view('admin/layout/script');
    }

    public function sub_kategori(){
        $data = [
            'title' => 'Sistem Manajemen Arsip - Sub Kategori',
            'page_title' => 'Sub Kategori',
            'admin_name' => 'Admin',
        ];

        $model_kategori = new ModelKategori();
        $kategori = $model_kategori->select('id_kategori')->where('kategori', $this->request->uri->getSegment(2))->get()->getRow();

        $model = new ModelSubKategori();
        $data_sub_kat = $model->where('id_kategori',$kategori->id_kategori)->findAll();

        $data_list = [
            'data' => $data_sub_kat
        ];
        return view('admin/layout/sidebar', $data)
            .view('admin/page/subkategori', $data_list)
            .view('admin/layout/script');
    }

    public function permintaan(){
        $data = [
            'title' => 'Sistem Manajemen Arsip - Permintaan Surat Keluar',
            'page_title' => 'Permintaan Surat Keluar',
            'admin_name' => 'Admin',
        ];

        $model = new ModelPermintaanSuratKeluar();
        $data_permintaan = $model->where('is_created', 0)->where('is_deleted', 0)->findAll();

        $model_kategori = new ModelKategori();
        $kategori = $model_kategori->select('id_kategori, kategori')->findAll();

        $data_list = [
            'data' => $data_permintaan,
            'kategori' => $kategori
        ];
        return view('admin/layout/sidebar', $data)
            .view('admin/page/permintaan', $data_list)
            .view('admin/layout/script');
    }
}