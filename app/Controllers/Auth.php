<?php

namespace App\Controllers;
use App\Models\ModelAdmin;

class Auth extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $session = \Config\Services::session();

        $validation =  \Config\Services::validation();
        $validation->setRules([
                'email' => 'required|valid_email',
                'password' => 'required',
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if($isDataValid){
            $model_admin = new ModelAdmin();
            $data_admin = $model_admin->where('email', $this->request->getPost("email"))->get()->getRow();
            if($data_admin){
                if($data_admin->id_admin != "") {
                    if(password_verify($this->request->getPost('password'), $data_admin->password)){
                        $admin_data = [
                            'id_admin'  => $data_admin->id_admin,
                            'email'     => $data_admin->email,
                            'nama'      => $data_admin->nama,
                        ];
                        
                        $session->set($admin_data);
                        return redirect()->to('/dashboard');  
                    } else {
                        $_SESSION['error'] = 'email atau password salah';
                        $session->markAsFlashdata('error');
                        return view('login');
                    }
                } else {
                    $_SESSION['error'] = 'email atau password salah';
                    $session->markAsFlashdata('error');
                    return view('login');
                }
            } else {
                $_SESSION['error'] = 'email atau password salah';
                $session->markAsFlashdata('error');
                return view('login');
            }
        } else {
            $_SESSION['error'] = 'email atau password salah';
            $session->markAsFlashdata('error');
            return view('login');
        }
    }
}