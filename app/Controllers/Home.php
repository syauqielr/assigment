<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\BarangModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
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
        $this->BarangModel = new BarangModel();
        $data = [
            'role' => $session->role,
            'barang' => $this->BarangModel->get_all_barang(),
            ];
	    if (!is_null($session->username)){

            return view('home',$data);
        }
        return redirect()->to('/');

    }
    public function addBarang(){
        helper(['form', 'url']);
        $this->BarangModel = new BarangModel();
        $data = array(
            'nama' => $this->request->getPost('namaBarang'),
            'kategori' => $this->request->getPost('kategoriBarang'),
            'harga' => $this->request->getPost('hargaBarang'),
            'image_name' => 'coffee.jpg'
        //$this->request->getPost('fotoBarang')
        );
        $insert = $this->BarangModel->barang_add($data);
        echo json_encode(array("status" => TRUE));
    }
    public function ajax_edit($id) {

        $this->BarangModel = new BarangModel();

        $data = $this->BarangModel->get_by_id($id);

        echo json_encode($data);
    }

    public function updateBarang() {

        helper(['form', 'url']);
        $this->BarangModel = new BarangModel();

        $data = array(
            'nama' => $this->request->getPost('namaBarang'),
            'kategori' => $this->request->getPost('kategoriBarang'),
            'harga' => $this->request->getPost('hargaBarang'),
            //'image_name' => $this->request->getPost('fotoBarang')
        );

        $this->BarangModel->barang_update(array('id' => $this->request->getPost('idBarang')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function deleteBarang($id) {

        helper(['form', 'url']);
        $this->BarangModel = new BarangModel();
        $this->BarangModel->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
}
