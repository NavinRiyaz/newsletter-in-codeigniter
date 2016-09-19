<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/* set_time_limit(0); 
	ini_set('memory_limit', '30240M'); //MAX limit is 10GB 
	error_reporting(0); */
	class Employee extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->helper('url');
			$this->load->library('grocery_CRUD');
			$this->is_login();
		}
		
		function is_login(){
			$LOGIN_MODE = $this->session->userdata('LOGIN_MODE');
			if(!isset($LOGIN_MODE)){
				redirect('login'); 
			}
		}
		
		public function _example_output($output = null)
		{
			$this->load->view('example.php',$output);
		}
		
		function  profile(){
			$crud = new grocery_CRUD();
			$crud->set_table('newsletter_employee');
			$crud->set_subject('Profile');
			//$crud->unset_jquery();
			$crud->columns('employee_name', 'employee_role', 'username', 'password', 'gender', 'email', 'qualification',  'dob', 'is_active');				
			$crud->required_fields('employee_name', 'employee_role', 'username', 'is_active');
			$crud->fields('employee_name', 'employee_role', 'username', 'password', 'gender', 'email', 'qualification',   'dob', 'is_active' );
			$crud->unset_back_to_list();
			$crud->callback_before_insert(array($this,'encrypt_password_callback'));
			$crud->callback_before_update(array($this,'encrypt_password_callback'));
			$crud->callback_edit_field('password',array($this,'set_password_input_to_empty'));
			$crud->callback_add_field('password',array($this,'set_password_input_to_empty'));
			$output = $crud->render();
			$this->_example_output($output);
		}
		
		function encrypt_password_callback($post_array) {
			if(!empty($post_array['password'])){
				$post_array['password'] = md5($post_array['password']);
			}
			else{
				unset($post_array['password']);
			} 
			return $post_array;
		}   
 
		function set_password_input_to_empty() {
			return "<input type='password' name='password' value='' />";
		}
		
	}