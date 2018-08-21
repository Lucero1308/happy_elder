<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		$data = array();
		$data['bodyClass'] = 'login';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/login');
		$this->load->view('admin/footer');
	}    
	public function isLoggedin() {
		if(!empty($this->session->userdata['id'])) {
			return true;
		}
		else {
			return false;
		}
	}
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url().'Login');
	}    
	public function dashboard() {
		if($this->isLoggedin()) {
			$data['title']='Welcome! You are logged in';
			$this->load->view('success',$data);
		}
		else {
			redirect(base_url().'Login');
		}
	}
	public function checkPassword($str) {
		$check=$this->Login_model->checkPassword($str);
		if($check) {
			return true;
		}
		else {
			$this->form_validation->set_message('checkPassword', 'The Current Password you have provided is incorrect');
			return false;
		}
	}
	public function activate() {
		$id=$this->uri->segment(3);
		$hash=$this->uri->segment(4);
		$check=$this->Login_model->activateAccount($id,$hash);
		if($check) {
			$this->session->set_flashdata('log_success','Account Activated Successfully');
			redirect(base_url().'login');
		}
		else {
			$this->session->set_flashdata('log_error','Incorrect Hash, Please try again');
			redirect(base_url().'login');
		}
	}
	public function register() {
		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		if(!$this->isLoggedin()){
			$data['title']='Register';
			if($_POST) {
				$config=array(
					array(
						'field' => 'username',
						'label' => 'Username',
						'rules' => 'trim|required'
					),
					array(
						'field' => 'fullname',
						'label' => 'Full Name',
						'rules' => 'trim|required'
					),
					array(
						'field' => 'email',
						'label' => 'Email',
						'rules' => 'trim|required|is_unique[users.email]'
					),
					array(
						'field' => 'password',
						'label' => 'Password',
						'rules' => 'trim|required'
					)
				);
				$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == false) {
					// if validation has errors, save those errors in variable and send it to view
					$data['errors'] = validation_errors();
					$this->load->view('register',$data);
				}
				else {
					// if validation passes, check for user credentials from database
					$id=$this->Login_model->register($_POST);
					// You can send Email here for account activation
					$this->session->set_flashdata('log_success','Congratulations! You are registered. Please Click on <a href='.base_url().'login/activate/'.$id.'/'.sha1(md5($this->session->userdata['session_id'])).'>this Link</a> to activate your account.
					 ');
					redirect(base_url() . 'Login');
				}
			}
			else {
				$this->load->view('register',$data);
			}
		}
		else {
			redirect(base_url().'Login');
		}
	}
	public function change_password() {
		if($this->isLoggedin()){
			$data['title']='Change Password';
			if($_POST) {
				$config=array(
					array(
						'field' => 'old_password',
						'label' => 'Old Password',
						'rules' => 'trim|required|callback_checkPassword'
					),
					array(
						'field' => 'password',
						'label' => 'Password',
						'rules' => 'trim|required'
					),
					array(
						'field' => 'conf_password',
						'label' => 'Confirm Password',
						'rules' => 'trim|required|matches[password]'
					)
				);
				$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == false) {
					// if validation has errors, save those errors in variable and send it to view
					$data['errors'] = validation_errors();
					$this->load->view('change_password',$data);
				}
				else {
					// if validation passes, check for user credentials from database
					$this->Login_model->updatePassword($_POST['password'],$this->session->userdata['id']);
					$this->session->set_flashdata('log_success','Congratulations! Password Changed');
					redirect(base_url() . 'Login/dashboard');
				}
			}
			else {
				$this->load->view('change_password',$data);
			}
		}
		else {
			redirect(base_url().'Login');
		}
	}
}
