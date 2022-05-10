<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	public function index()
	{
		$this->load->view('home');
	}
    public function home()
	{   $this->load->model('Crud_model');
        $fetch = $this->Crud_model->fetchUsers();
        // print_r($data);
        $data['data'] = $fetch;
        // exit;
		$this->load->view('home',$data);
	}
    public function add()
	{   
        
		$this->load->view('add');
	}
    public function fileUpload()
	{   
		$this->load->view('file_upload');
	}
    public function save()
	{   
        
        if($_GET['name'] != ""){
            $this->load->model('Crud_model');
            $this->Crud_model->add($_GET);
            return redirect(base_url('index.php/home'));exit;
        }
        else{
            return redirect(base_url('index.php/add'));exit;
        }

	}
    public function edit(){
        
        $id = $this->uri->segment(2);
        $this->load->model('Crud_model');
        $fetch = $this->Crud_model->editUser($id);
        
        $data['fetch']=$fetch;
        $this->load->view('edit',$data);
    }
    public function update(){
        
        $data=array(
            
            'c_name'                => $_POST['name'],
            'c_age'                 => $_POST['age'],
            'c_address'             => $_POST['address'],
            'c_mobile'              => $_POST['mobile'],
        );
        $this->load->model('Crud_model');
        $fetch = $this->Crud_model->updateUser($data,$_POST['userId']);
        return redirect(base_url('index.php/home'));exit;
        
    }
    public function delete(){
        $id = $this->uri->segment(2);
        $this->load->model('Crud_model');
        $this->Crud_model->deleteUser($id);
        return redirect(base_url('index.php/home'));exit;
    }
}
