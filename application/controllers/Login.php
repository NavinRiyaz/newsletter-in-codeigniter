<?php
if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );
class Login extends CI_Controller {
	function __construct() {
		parent::__construct ();
		
	}
	
	function index() {
		$this->login();
	}
	
	function is_login(){
		$LOGIN_MODE=$this->session->userdata('LOGIN_MODE');
		if(isset($LOGIN_MODE)){
			redirect('site/home');
		}
	}
	
	function login(){
		$this->is_login();
		$this->load->view('login.php');
	}

	public function chk_login() {
		if ($_POST ['submit'] == 'Login') {		
			$this->load->model ( 'login_model' );
			$query = $this->login_model->validateCredentials();
			if ($query != '0') {
				$login_id=$this->session->userdata('LOGIN_ID');
				$LOGIN_MODE=$this->session->userdata('LOGIN_MODE');
				switch($LOGIN_MODE){
					case 'admin' : redirect('site/home'); break;
				}
			} else {
				$dcode = $this->input->post ( 'dcode' );
				$data ['username'] = $this->input->post ( 'username' );
				$data ['password'] = $this->input->post ( 'password' );
				$data ['error'] = "<span style='text-align:center; box-shadow: 1px 1px 7px -3px; color:red; padding: 3px; display: inherit; '>Incorrect Username/Password, Try again..!!</span></br>";
				switch($dcode){
					case 'admin' : $this->load->view ( 'login.php', $data ); break;
				}
			}
		} else {
			redirect('login/login');
		}
	}
	
	function logout() {
		$LOGIN_MODE=$this->session->userdata('LOGIN_MODE');
		$this->output->set_header ( "Last-Modified: " . gmdate ( "D, d M Y H:i:s" ) . " GMT" );
		$this->output->set_header ( "Cache-Control: no-store, no-cache, must-revalidate" );
		$this->output->set_header ( "Cache-Control: post-check=0, pre-check=0", false );
		$this->output->set_header ( "Pragma: no-cache" );
		$this->session->sess_destroy ();
		
		switch($LOGIN_MODE){
			case 'admin' : redirect('login/login'); break;
		}
	}
}