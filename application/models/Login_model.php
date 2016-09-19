<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Login_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function validateCredentials() {
		$dcode = $this->security->xss_clean($this->input->post ( 'dcode' ));
		$username = $this->security->xss_clean($this->input->post ( 'username' ));
		$password = $this->security->xss_clean($this->input->post ( 'password' ));
		switch($dcode)
		{
			case 'admin' :
				$this->db->where ( 'username', $username  );
				$this->db->where ( 'employee_role', $dcode );
				$this->db->where ( 'password', md5 ( $password ) );
				$this->db->where ( 'is_active', '1' );
				$query = $this->db->get ( 'newsletter_employee' );//`id`, `name`
				$row = $query->row_array ();
				if ($query->num_rows() == 1) {
					$row = $query->row_array ();
					$login_id = $row ['employee_id'];
					$login_name = $row ['employee_name'];
				} else {
					return 0;
				}
				break;
				
				default: return 0; 
		}
	
		$data = array (
				'LOGIN_ID' => $login_id,
				'LOGIN_NAME' => $login_name,
				'LOGIN_MODE' => $dcode 
		);
		$this->session->set_userdata ( $data );
		return 1; 
	}
}