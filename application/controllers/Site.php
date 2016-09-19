<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/* set_time_limit(0); 
	ini_set('memory_limit', '30240M'); //MAX limit is 10GB 
	error_reporting(0); */
	class Site extends CI_Controller {
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
		
		public function index()
		{
			$this->home();
			//$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		}
		
		public function _example_output($output = null)
		{
			$this->load->view('example.php',$output);
		}
		

		public function home($output = null)
		{
			$query = $this->db->query (" SELECT * FROM newsletter_master where id=1	" );
			foreach ( $query->result_array () as $row ) {
				$name 	= $row ['company_name'];
			}
			$content='
			<div class="row">
				<div class="col-sm-12" >
					<h1 style="
							font-stretch: ultra-condensed;
							font-family: cursive;
							font-size: 60px;
							overflow : auto;
							text-shadow: 5px 5px 14px aquamarine;
							vertical-align: middle;
							text-align: -webkit-center;
							color: darkgreen;
							/* box-shadow: 1px 3px 61px 2px #adad88; */
							padding: 20px;
							/* background-color: #EBEBFB; */
						">Welcome to <br/>'.$name.'
					</h1>
				</div>	
			</div>';
			$output = (object)array('output' => $content , 'js_files' => array() , 'css_files' => array());
			$this->load->view('example.php',$output);
		}
		
		function  students(){
			$crud = new grocery_CRUD();
			//SELECT 'student_id', 'general_register_no', 'stream_id', 'admission_academic_year_id', 'class_id', 'division', 'fname', 'mname', 'lname', 'date_of_birth', 'dob', 'gender', 'mothers_fname', 'mothers_mname', 'mothers_lname', 'udis_number', 'medium', 'semi_english', 'date_of_admission', 'doa', 'class_of_admission_id', 'admission_type_id', 'uid_number' FROM 'mck_students' WHERE 1
			$crud->set_table('mck_students');
			$crud->set_subject('Students');
			$crud->where('is_dropout','No');
			$crud->columns('general_register_no', 'stream_id', 'admission_academic_year_id', 'class_id', 'division', 'fname', 'mname', 'lname',  'dob', 'gender', 'mothers_fname', 'mothers_mname', 'mothers_lname', 'udis_number', 'medium_id', 'semi_english', 'doa', 'class_of_admission_id', 'admission_type_id', 'uid_number' );				
			$crud->required_fields('general_register_no', 'stream_id','class_id', 'fname', 'mname', 'lname', 'dob', 'gender', 'mothers_fname', 'mothers_mname', 'mothers_lname');
			$crud->fields('general_register_no', 'stream_id', 'admission_academic_year_id', 'class_id', 'division', 'fname', 'mname', 'lname',  'dob', 'gender', 'mothers_fname', 'mothers_mname', 'mothers_lname', 'udis_number', 'medium_id', 'semi_english', 'doa', 'class_of_admission_id', 'admission_type_id', 'uid_number' );
			//SELECT 'stream_id', 'stream_name' FROM 'mck_stream' WHERE 1
			$crud->set_relation('stream_id','mck_stream','stream_name');
			//SELECT 'class_id', 'class_name', 'ordering' FROM 'mck_classes' WHERE 1
			$crud->set_relation('class_id','mck_classes','class_name',null,'ordering asc');
			$crud->set_relation('class_of_admission_id','mck_classes','class_name',null,'ordering asc');
			///SELECT 'type_id', 'type_name' FROM 'mck_admission_type' WHERE 1
			$crud->set_relation('admission_type_id','mck_admission_type','type_name');
			//SELECT 'year_id', 'year_name' FROM 'mck_academic_year' WHERE 1
			$crud->set_relation('admission_academic_year_id','mck_academic_year','year_name',null,'year_name desc');
			$crud->set_relation('medium_id','mck_teach_medium','medium_name',null,'medium_name asc');
			$crud->order_by('student_id','desc');
			$crud->display_as('stream_id','Stream');
			$crud->display_as('medium_id','Medium');
			$crud->display_as('class_id','Present Class');
			$crud->display_as('class_of_admission_id','Class of Admission');
			$crud->display_as('dob','Date of Birth');
			$crud->display_as('doa','Date of Admission');
			$crud->display_as('type_id','Admission Type');
			$crud->display_as('admission_academic_year_id','Admission Academic Year');
			$crud->display_as('admission_type_id','Admission Type');
			$crud->callback_after_insert(array($this, 'insert_in_setup_tb'));
			//$crud->add_action('pdf', base_url().'/assets/img/pdf.png', 'printable/generate_report');
			//$crud->add_action('Edit Test Details', base_url().'/assets/grocery_crud/themes/flexigrid/css/images/edit.png', 'setup/test_diagonalitic_records_edit');
			$output = $crud->render();
			$this->_example_output($output);
		}
		function insert_in_setup_tb($post_array,$primary_key){
			$query = $this->db->query (" SELECT * FROM `mck_school` " );
			foreach ( $query->result_array () as $row ) {
				$current_academic_year_id	= $row['current_academic_year_id'];
			}
			$student_data = array(
				"student_id"=> $primary_key,
				"year_id" 	=> $current_academic_year_id,
				"class_id" 	=> $post_array['class_id']
			);
			$this->db->insert('mck_year_class_std_setup',$student_data);
			return true;
		}
		
		
		function drop_out(){
			$crud = new grocery_CRUD();
			//SELECT 'student_id', 'general_register_no', 'stream_id', 'admission_academic_year_id', 'class_id', 'division', 'fname', 'mname', 'lname', 'date_of_birth', 'dob', 'gender', 'mothers_fname', 'mothers_mname', 'mothers_lname', 'udis_number', 'medium', 'semi_english', 'date_of_admission', 'doa', 'class_of_admission_id', 'admission_type_id', 'uid_number' FROM 'mck_students' WHERE 1
			$crud->set_table('mck_students');
			$crud->set_subject('Drop Out Students');
			$crud->where('is_dropout','Yes');
			$crud->columns('general_register_no', 'date_dropout', 'admission_academic_year_id', 'class_id', 'division', 'fname', 'mname', 'lname',  'dob', 'gender', 'mothers_fname', 'mothers_mname', 'mothers_lname', 'udis_number', 'medium_id', 'semi_english', 'doa', 'class_of_admission_id', 'admission_type_id', 'uid_number','is_dropout');
			$crud->required_fields('general_register_no', 'date_dropout', 'fname', 'mname', 'lname', 'dob', 'gender', 'mothers_fname', 'mothers_mname', 'mothers_lname');
			$crud->fields('general_register_no', 'date_dropout', 'admission_academic_year_id', 'class_id', 'division', 'fname', 'mname', 'lname',  'dob', 'gender', 'mothers_fname', 'mothers_mname', 'mothers_lname', 'udis_number', 'medium_id', 'semi_english', 'doa', 'class_of_admission_id', 'admission_type_id', 'uid_number','is_dropout' );
			
			//SELECT 'stream_id', 'stream_name' FROM 'mck_stream' WHERE 1
			//$crud->set_relation('stream_id','mck_stream','stream_name');
			//SELECT 'class_id', 'class_name', 'ordering' FROM 'mck_classes' WHERE 1
			$crud->set_relation('class_id','mck_classes','class_name');
			$crud->set_relation('class_of_admission_id','mck_classes','class_name');
			///SELECT 'type_id', 'type_name' FROM 'mck_admission_type' WHERE 1
			$crud->set_relation('admission_type_id','mck_admission_type','type_name');
			//SELECT 'year_id', 'year_name' FROM 'mck_academic_year' WHERE 1
			$crud->set_relation('admission_academic_year_id','mck_academic_year','year_name');
			$crud->set_relation('medium_id','mck_teach_medium','medium_name',null,'medium_name asc');
			$crud->unset_add()->unset_delete();
			$crud->order_by('student_id','desc');
			$crud->display_as('stream_id','Stream');
			$crud->display_as('class_id','Present Class');
			$crud->display_as('class_of_admission_id','Class of Admission');
			$crud->display_as('dob','Date of Birth');
			$crud->display_as('doa','Date of Admission');
			$crud->display_as('type_id','Admission Type');
			$crud->display_as('admission_academic_year_id','Admission Academic Year');
			$crud->display_as('admission_type_id','Admission Type');
			//$crud->add_action('pdf', base_url().'/assets/img/pdf.png', 'printable/generate_report');
			//$crud->add_action('Edit Test Details', base_url().'/assets/grocery_crud/themes/flexigrid/css/images/edit.png', 'setup/test_diagonalitic_records_edit');
			$output = $crud->render();
			$this->_example_output($output);
		
		}
		
		function  year_wise_students($year_id=0){
			
			$year_id = intval($year_id);
			$query = $this->db->query("
				SELECT  `student_id`
				FROM `mck_year_class_std_setup` 
				WHERE  year_id='".$year_id."'
			");
			$i = 0;$student_ids=array();
			foreach ( $query->result_array () as $row ) {
				$student_ids[$i++] = $row['student_id'];
			}
			if($i == 0){
				//$msg="<strong>Sorry !! </strong> </br>Data Not Available. ";
				//$this->session->set_flashdata('msg',$msg);
				redirect('setup/error_page');
			}
			$query = $this->db->query("	SELECT  `year_name` FROM `mck_academic_year`  WHERE  year_id='".$year_id."'	");
			foreach ( $query->result_array () as $row ) {
				$year_name = $row['year_name'];
			}
			$student_ids_str=implode(",",$student_ids);
			$where="student_id in ( $student_ids_str )";
			$crud = new grocery_CRUD();
			$crud->set_table('mck_students');
			$crud->set_subject('Students [Year - '.$year_name.']');
			$crud->where($where);
			
			$crud->columns('general_register_no', 'stream_id', 'admission_academic_year_id', 'class_id', 'division', 'fname', 'mname', 'lname',  'dob', 'gender', 'mothers_fname', 'mothers_mname', 'mothers_lname', 'udis_number', 'medium_id', 'semi_english', 'doa', 'class_of_admission_id', 'admission_type_id', 'uid_number','is_dropout', 'date_dropout' );				
			$crud->required_fields('general_register_no', 'stream_id', 'fname', 'mname', 'lname', 'dob', 'gender', 'mothers_fname', 'mothers_mname', 'mothers_lname');
			$crud->fields('general_register_no', 'stream_id', 'admission_academic_year_id', 'class_id', 'division', 'fname', 'mname', 'lname',  'dob', 'gender', 'mothers_fname', 'mothers_mname', 'mothers_lname', 'udis_number', 'medium_id', 'semi_english', 'doa', 'class_of_admission_id', 'admission_type_id', 'uid_number','is_dropout', 'date_dropout' );
			$crud->set_relation('stream_id','mck_stream','stream_name');
			$crud->set_relation('class_id','mck_classes','class_name');
			$crud->set_relation('class_of_admission_id','mck_classes','class_name');
			$crud->set_relation('admission_type_id','mck_admission_type','type_name');
			$crud->set_relation('admission_academic_year_id','mck_academic_year','year_name');
			$crud->set_relation('medium_id','mck_teach_medium','medium_name',null,'medium_name asc');
			$crud->order_by('student_id','desc');
			$crud->unset_add()->unset_delete();
			$crud->display_as('stream_id','Stream');
			$crud->display_as('class_id','Present Class');
			$crud->display_as('class_of_admission_id','Class of Admission');
			$crud->display_as('dob','Date of Birth');
			$crud->display_as('doa','Date of Admission');
			$crud->display_as('type_id','Admission Type');
			$crud->display_as('admission_academic_year_id','Admission Academic Year');
			$crud->display_as('admission_type_id','Admission Type');
			$output = $crud->render();
			$this->_example_output($output);
		}
		

		function carry_forward(){
			$class_select="";
			$query =$this->db->query("
			SELECT `class_id`, `class_name`, `ordering` 
			FROM `mck_classes` 
			ORDER BY ordering 
			");
			foreach ($query->result_array() as $row){ 
				$class_select .= '<option  value="'. $row['class_id']. '" >'. $row['class_name'].'</option>';
			}
			$data['class_select'] = $class_select;
			$data['main_content'] = 'carry_forward.php';
			$this->load->view('site_template.php',$data);
		
		}
		
		function carry_forward_submit(){
			$class_id = $this->input->get_post('class_id');	
			$query = $this->db->query (" SELECT * FROM `mck_school` " );
			foreach ( $query->result_array () as $row ) {
				$current_academic_year_id	= $row['current_academic_year_id'];
				$previous_academic_year_id	= $row['previous_academic_year_id'];
				$max_class_id	= $row['max_class_id'];
			} 
			$query = $this->db->query ("
				SELECT `student_id`
				FROM mck_year_class_std_setup 
				WHERE year_id = '".$previous_academic_year_id."' AND class_id='".$class_id."' 
				" );
				//SELECT `id`, `year_id`, `class_id`, `student_id`, `date_of_admission` FROM `mck_year_class_std_setup` WHERE 1
			$student_ids=array();
			//echo $this->db->last_query();
			$i=0;
			foreach ( $query->result_array () as $row ) {
				if($this->input->get_post($row['student_id'])=='on'){
					$student_ids[$i++] = $row['student_id'];// all ticked
				}
			}
			//var_dump($student_ids);
			if($max_class_id == $class_id){ // drop out
				if(!empty($student_ids)){
					$query = $this->db->query ("update `mck_students` set `is_dropout`='Yes' where student_id in (".implode(",",$student_ids).") ");
				}
			} else {  // carry forward
				//fetch availabe student_ids
				//fetch next class id
					$query = $this->db->query ("
						SELECT `class_id` 
						FROM `mck_classes` 
						WHERE  `ordering` > (  select  `ordering` from mck_classes where `class_id`='".$class_id."')
						order by `ordering` asc
						limit 1 "
					);
					foreach ( $query->result_array () as $row ) {
						$next_cls_id = $row['class_id'];
					}
				$query = $this->db->query ("
					SELECT * 
					FROM  mck_year_class_std_setup 
					WHERE `year_id`='".$current_academic_year_id."' AND  `class_id` ='".$next_cls_id."'  ");
				$j=0;
				$student_ids_carried=array();
				foreach ( $query->result_array () as $row ) {
					$student_ids_carried[$j++] = $row['student_id'];
				}
				$already_carry = count($student_ids_carried);
				$result_arr = array_diff($student_ids, $student_ids_carried);
				//var_dump($student_ids_carried); die;
				$j=0;
				if(!empty($result_arr)){
					foreach($result_arr as $row_e){
						$query = $this->db->query ("INSERT INTO mck_year_class_std_setup (`year_id`, `class_id`, `student_id`) VALUES ('".$current_academic_year_id."','".$next_cls_id."','".$row_e."') ");
						$query = $this->db->query ("UPDATE mck_students SET `class_id` = '".$next_cls_id."' WHERE student_id='".$row_e."' ");
						$j++;
					}
				}
			}
			
			//var_dump($student_ids);
			if($max_class_id == $class_id){
				echo "<script>alert('".$i." Students Are Drop Out');window.location='".site_url('student/carry_forward')."'</script>";
			} else {
				echo "<script>alert('".$j." Students Are Carry Forward to Next Class and $already_carry are already Carried Forward');window.location='".site_url('student/carry_forward')."'</script>";
			}
		}
	}