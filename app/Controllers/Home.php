<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
class Home extends BaseController
{
	public function index()
	{
        helper(['form']);
        echo view('welcome_message');
	}
    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();
        d($data);
        if($data){
            $pass = $data['password'];
            $verify_pass = !strcmp($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'username'     => $data['username'],
                    'role'         => $data['role'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/home/main');
            }else{
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/');
            }
        }else{
            $session->setFlashdata('msg', 'username not Found');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
	public function main(){

        $session = session();
        d($session->username);
	    if (!is_null($session->username)){
            return view('home');
        }
        return redirect()->to('/');

    }
}
