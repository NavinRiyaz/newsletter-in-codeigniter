<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/* set_time_limit(0); 
	ini_set('memory_limit', '30240M'); //MAX limit is 10GB 
	error_reporting(0); */
	class Mailer extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->helper('url');
			$this->load->library('grocery_CRUD');
		}
		
		public function index()
		{
			$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		}
		
		public function _example_output($output = null)
		{
			$this->load->view('example.php',$output);
		}
		
		/*
		public function insert_mails()
		{
			$query = $this->db->query ( "
			SELECT 'id', 'Email' FROM 'table 10'  " );
			foreach ( $query->result_array () as $row ) {
				$Email[$i++] = $row ['Email'];
			}
			//var_dump($Email); die;
			foreach($Email AS $mail){
				try{
					$query = $this->db->query ( " INSERT INTO 'member'( 'member_email') VALUES ('".$mail."') " );
				} catch(Exception $e ){continue; }
				
			}
			
		}
		
		function validate_email(){
			// include SMTP Email Validation Class
			$this->load->library('smtp_validateemail');
			//require_once('smtp_validateEmail.class.php');
			// the email to validate
			$query = $this->db->query ( "
			SELECT  'member_email' FROM 'member' where is_valid1 ='' order by member_id " );
			foreach ( $query->result_array () as $row ) {
				$EmailArr[$i++] = $row ['member_email'];
			}
			$i=0;
			foreach ( $EmailArr as $email ) {
				$i++;
				//$email = 'hemant.hingave@gmail.com';
				// an optional sender
				//$sender = 'user@mydomain.com';
				// instantiate the class
				$results = array();
				$SMTP_Validator = new SMTP_validateemail();
				// turn on debugging if you want to view the SMTP transaction
				$SMTP_Validator->debug = false;
				// do the validation
				$results = $SMTP_Validator->validate(array($email), $sender);
				// view results
				//echo $email.' is '.($results[$email] ? 'valid' : 'invalid')."\n";
				
				// send email? 
				if ($results[$email]) {
					//mail($email, 'Confirm Email', 'Please reply to this email to confirm', 'From:'.$sender."\r\n"); // send email
					$this->db->query ( "UPDATE 'member' 
					SET 'is_valid1'='YES'
					where 'member_email'='".$email."' ");
					} else {
					//echo 'The email addresses you entered is not valid';
					$this->db->query ( "UPDATE 'member' 
					SET 'is_valid1'='NO'
					where 'member_email'='".$email."' ");
				}
				if(($i%100)==0){
					//echo $i." Records Processed<br>";
					sleep(60);//sleep for 1min sec
				}
			}
		}
		
		function validate_email_single($email){
			// include SMTP Email Validation Class
			$this->load->library('smtp_validateemail');
			//require_once('smtp_validateEmail.class.php');
			// the email to validate
			$query = $this->db->query ( "
			SELECT  'member_email' FROM 'member' where is_valid1 ='' order by member_id " );
			foreach ( $query->result_array () as $row ) {
				$EmailArr[$i++] = $row ['member_email'];
			}
			$i=0;
			foreach ( $EmailArr as $email ) {
				$i++;
				//$email = 'hemant.hingave@gmail.com';
				// an optional sender
				//$sender = 'user@mydomain.com';
				// instantiate the class
				$results = array();
				$SMTP_Validator = new SMTP_validateemail();
				// turn on debugging if you want to view the SMTP transaction
				$SMTP_Validator->debug = false;
				// do the validation
				$results = $SMTP_Validator->validate(array($email), $sender);
				// view results
				//echo $email.' is '.($results[$email] ? 'valid' : 'invalid')."\n";
				
				// send email? 
				if ($results[$email]) {
					//mail($email, 'Confirm Email', 'Please reply to this email to confirm', 'From:'.$sender."\r\n"); // send email
					$this->db->query ( "UPDATE 'member' 
					SET 'is_valid1'='YES'
					where 'member_email'='".$email."' ");
					} else {
					//echo 'The email addresses you entered is not valid';
					$this->db->query ( "UPDATE 'member' 
					SET 'is_valid1'='NO'
					where 'member_email'='".$email."' ");
				}
				if(($i%100)==0){
					//echo $i." Records Processed<br>";
					sleep(60);//sleep for 1min sec
				}
			}
		}
		
		public function mailto()
		{
			$data['main_link']	= 'Home';
			$data['header']		= 'Mail';
			$data['header_link']= 'mailer/mailto';
			$data['main_content']='mailto';
			$this->load->view('includes/site_template',$data);
			//var_dump($this->session);
		}
		*/
	
		function groups() 
		{
			$crud = new grocery_CRUD();
			$crud->set_table('newsletter_group');
			$crud->set_subject('Groups');
			$crud->order_by("group_id", "desc");
			$crud->columns('group_name');				
			$crud->fields('group_name');
			$output = $crud->render();
			$this->_example_output($output);
		}
		
		function members() 
		{
			$crud = new grocery_CRUD();
			$crud->set_table('newsletter_member');
			$crud->set_subject('Member');
			$crud->order_by("member_id", "desc");
			$crud->columns('groups','member_id', 'name', 'member_email', 'contact1', 'contact2');				
			$crud->fields( 'groups','name', 'member_email', 'contact1', 'contact2', 'is_available', 'is_valid');
			$crud->set_relation_n_n( 'groups', 'newsletter_group_member_rel', 'newsletter_group', 'member_id', 'group_id' , 'group_name');
			$output = $crud->render();//SELECT * FROM `newsletter_group_member_rel` WHERE 1
			$this->_example_output($output);
			//SELECT `group_id`, `group_name` FROM `newsletter_group` WHERE 1
		}
		
		function draft_mail() 
		{
			$crud = new grocery_CRUD();
			$crud->set_table('newsletter_mail_draft');
			//SELECT `id`, `to_group`, `to_individual`, `subject`, `from_email`, `title`, `description`, `alink`, `attachment_link`, `attachment_link2`, `attachment_link3`, `attachment_link4`, `attachment_link5`, `message`, `AdvimageLink`, `created_on`, `sent_on` FROM `newsletter_mail_draft` WHERE 1
			$crud->set_subject('Draft Mail');
			$crud->order_by("id", "desc");
			$crud->columns('to_group', 'to_individual', 'subject','message','created_on');				
			$crud->fields('to_group', 'to_individual', 'subject','title','description','alink','attachment_link','attachment_link2','attachment_link3','attachment_link4','attachment_link5','AdvimageLink','created_on' );
			$crud->set_relation('to_group','newsletter_group','group_name');
			$crud->field_type('created_on','invisible');
			$crud->set_field_upload('attachment_link','assets/uploads/files');
			$crud->set_field_upload('attachment_link2','assets/uploads/files');
			$crud->set_field_upload('attachment_link3','assets/uploads/files');
			$crud->set_field_upload('attachment_link4','assets/uploads/files');
			$crud->set_field_upload('attachment_link5','assets/uploads/files');
			$crud->add_action('Sent Mail', 'http://icons.iconarchive.com/icons/dryicons/aesthetica-2/16/mail-next-icon.png', 'mailer/sent_mail','ui-icon-image');
			$crud->required_fields('subject','message','title', 'alink','description');
			$crud->unset_texteditor('to_individual','subject');
			$crud->display_as('to_group','To Group');
			$crud->display_as('to_individual','To Individual');
			$crud->display_as('attachment_link','Attachment 1');
			$crud->display_as('attachment_link2','Attachment 2');
			$crud->display_as('attachment_link3','Attachment 3');
			$crud->display_as('attachment_link4','Attachment 4');
			$crud->display_as('attachment_link5','Attachment 5');
			$crud->display_as('AdvimageLink','Advertisement Image');
			
			$crud->display_as('title','Title 1');
			$crud->display_as('description','Description 1');
			$crud->display_as('alink','Link for Title 1');
			$crud->display_as('attachment_link','Attachment 1');
			
			$output = $crud->render();
			$this->_example_output($output);
		}
		
		function sent_mail_pre()
		{
			$data['main_link']	= 'Home';
			$data['header']		= 'Sent Mails ';
			$data['header_link']= 'mailer/sent_mail_pre_inner';
			$data['height']= '600';
			$data['main_content'] = 'includes/module_template';
			$this->load->view('includes/site_template',$data);
		}
		
		function sent_mails() 
		{
			$crud = new Grocery_CRUD();
			$crud->set_table('newsletter_sent_mail');
			$crud->set_subject('Sent Mail');
			//$crud->set_theme('flexigrid');
			//SELECT `id`, `to_group`, `to_individual`, `subject`, `from_email`, `title`, `description`, `alink`, `attachment_link`, `attachment_link2`, `attachment_link3`, `attachment_link4`, `attachment_link5`, `message`, `AdvimageLink`, `created_on`, `sent_on` FROM `newsletter_sent_mail` WHERE 1
			$crud->order_by("id", "desc");
			$crud->columns('sent_on','created_on','to_group', 'subject','title', 'description');				
			$crud->fields('sent_on','created_on','to_group', 'to_individual', 'subject','title','description','alink','attachment_link','AdvimageLink' );
			//$crud->unset_read_fields('sent_on','created_on');
			$crud->set_relation('to_group','newsletter_group','group_name');
			$crud->set_field_upload('attachment_link','assets/uploads/files');
			$crud->set_field_upload('attachment_link2','assets/uploads/files');
			$crud->set_field_upload('attachment_link3','assets/uploads/files');
			$crud->set_field_upload('attachment_link4','assets/uploads/files');
			$crud->set_field_upload('attachment_link5','assets/uploads/files');
			//$crud->set_relation('from_email','newsletter_from_emails','email');
			$crud->unset_texteditor('to_individual','subject','description','description2','description3','description4','description5');
			$crud->unset_add();
            $crud->unset_edit();
            $crud->unset_delete();
			$crud->display_as('to_group','To Group');
			$crud->display_as('to_individual','To Individual');
			
			$crud->display_as('title','Title 1');
			$crud->display_as('description','Description 1');
			$crud->display_as('alink','Link for Title 1');
			$crud->display_as('attachment_link','Attachment 1');
			
			$crud->display_as('title2','Title 2');
			$crud->display_as('description2','Description 2');
			$crud->display_as('alink2','Link for Title 2');
			$crud->display_as('attachment_link2','Attachment 2');
			
			$crud->display_as('title3','Title 3');
			$crud->display_as('description3','Description 3');
			$crud->display_as('alink3','Link for Title 3');
			$crud->display_as('attachment_link3','Attachment 3');
			
			$crud->display_as('title4','Title 4');
			$crud->display_as('description4','Description 4');
			$crud->display_as('alink4','Link for Title 4');
			$crud->display_as('attachment_link4','Attachment 4');
			
			$crud->display_as('title5','Title 5');
			$crud->display_as('description5','Description 5');
			$crud->display_as('alink5','Link for Title 5');
			$crud->display_as('attachment_link5','Attachment 5');
			
			$crud->display_as('AdvimageLink','Advertisement Image');
			$output = $crud->render();
			$this->_example_output($output);
		}
		
		function sent_mail($primary_key='')
		{
			$result = $this->db->query(" select * from  `newsletter_master`  " );
			foreach($result->result_array() as $row){
				$checkpoint_sentmail		= $row['checkpoint_sentmail'];			
			}
			//if already sent a mail
			if($checkpoint_sentmail){
				echo "<script>window.parent.location.href='".site_url('mailer/mail_progress')."';</script>";
				//redirect('mailer/mail_progress','refresh');
			} else {
				$this->db->query("INSERT INTO newsletter_sent_mail(  `to_group`, `to_individual`, `subject`, `from_email`, `title`, `description`, `alink`, `attachment_link`, `attachment_link2`, `attachment_link3`, `attachment_link4`, `attachment_link5`, `message`, `AdvimageLink`, `created_on`, `sent_on`) 
				SELECT `to_group`, `to_individual`, `subject`, `from_email`, `title`, `description`, `alink`, `attachment_link`, `attachment_link2`, `attachment_link3`, `attachment_link4`, `attachment_link5`, `message`, `AdvimageLink`, `created_on`, now() FROM `newsletter_mail_draft` WHERE id='".$primary_key."'  " );
				$insert_id = $this->db->insert_id();
				$result = $this->db->query("SELECT * FROM `newsletter_mail_draft` WHERE id='".$primary_key."'  " );
				foreach($result->result_array() as $row){
					$id				= $row['id'];
					$to_group		= $row['to_group'];
					$to_individual	= $row['to_individual'];
					$subject		= $row['subject'];
					$from_email		= $row['from_email'];
					$message		= $row['message'];
					
					$title[1]			= $row['title'];
					$description[1]		= $row['description'];
					if(!empty($row['attachment_link'])){
						$attachment_link[1]	= base_url()."assets/uploads/files/".$row['attachment_link'];
					} 
					$alink[1]			= $row['alink'];

					$AdvimageLink	= $row['AdvimageLink'];
				}
				
				$member_emails=$member_emails_ind=array();
				$group_where=" ";
				if($to_group==2){ // 2 for all member
					$sql=" SELECT * FROM `newsletter_member` WHERE `is_valid`='YES' ";
				}
				if(!empty($to_group)){
					// Fetch all emails from group
					$sql="SELECT m.* 
					FROM `newsletter_member` m, newsletter_group_member_rel r
					WHERE m.`member_id`=r.`member_id` AND m.`is_valid`='YES' AND r.group_id='".$to_group."' ";
				}
				$result = $this->db->query($sql );
				$i=0;
				foreach($result->result_array() as $row){
					$member_emails[$i++]		= $row['member_email'];
				}
					
				if(!empty($to_individual)){
					$member_emails_ind=explode(",",$to_individual);
				} 
				$result = array_merge($member_emails, $member_emails_ind);
				//var_dump($result); die;
				$result = array_unique($result);
				
				/* add any email id at end  to check whether email sent to all member or not 
				// for testing purpose only
				array_push($result,"hemant.hingave@gmail.com"); */
				
				$noOfemailsInArray=count($result);
				$this->db->query(" UPDATE `newsletter_master` 
				SET `checkpoint_sentmail`='1' ,TotalnoOfemails='".($noOfemailsInArray-1)."'
				WHERE id='1' " );
				$adv_cnt =$body_content="";
				if($AdvimageLink){
					//extract src from img tag 
					$doc = new DOMDocument();
					$doc->loadHTML($AdvimageLink);
					$xpath = new DOMXPath($doc);
					$src = $xpath->evaluate("string(//img/@src)");
					$AdvimageLink = base_url().$src;
					$adv_cnt = '<br><br>
					<a href="'.base_url().'" target="_blank"> 
					<img src="'.$AdvimageLink.'" "> </a>';
				}
				//end 
				for($t=1;$t<=5;$t++){
					if(!(empty($alink[$t]) || empty($title[$t]) || empty($description[$t]))){
					$body_content.='
						<p style=" padding: 0 0 0 10px;  margin: 10px 10px 0px;    border-left: 5px solid #eeeeee;">
							<a href="'.$alink[$t].'" style=" font-family: inherit;    font-weight: bold;     line-height: 30px;    text-rendering: optimizelegibility; font-size:14px; color:#2196F3;"  target="_blank">'.$title[$t].'</a>
						</p>
						<div style=" padding:1px 10px;   border-bottom: 1px solid #e2e2e2;">
							<div style="padding: 1px 15px;    border-left: 4px solid #09F !important;    margin: 0px 0px;    border-bottom: #09F 1px solid !important;    border-top: #09F 1px solid !important;    border-right: #09F 1px solid !important;    background: #e7f2f8;    color: #06C;">
								<font face="Georgia, Helvetica, Arial, sans-serif" color="#bf9000"><span style="    -webkit-margin-before: 0em;-webkit-margin-after: -1em;" >'.$description[$t].'</span></font>
							</div>
							<div>
								<a href="'.$alink[$t].'" style="font-size:13px;font-family:Georgia,Helvetica,Arial,sans-serif;line-height:25px;padding-top:10px;color:#0000ff" target="_blank"> Click Here for Detail.</a>
							</div>
							</br>
						</div>
						';
					}
				}
				
				$script4share="";
				$body =
					'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http:www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset='.strtolower(config_item('charset')).'" />
					<title>'.html_escape($subject).'</title>
					<style type="text/css">
					body {
					font-family: Arial, Verdana, Helvetica, sans-serif;
					font-size: 16px;
					}
					'.$script4share.'
					</style>
					</head>
					<body>
					<center>
						<div  style="width:90%;border-left: 1px solid #2185C5; border-right: 1px solid #2185C5; border-bottom: 1px solid #2185C5;" >
							 
							 <div style="padding-top:10px;padding-left:20px; text-align:left;font-family: cursive;">Dear Subcriber,	New post available at <a target="blank" href="http://demo.com">demo.com</a> are ....
							 </div>
							 <div style="padding:10px; text-align:left;">
							'.$body_content.$adv_cnt.'
							</div>
							<br />
							<br />
							<br />
							<div style="font-size:11px;color:#a3a3a3" align="center" height="46">You are receiving this mail as a registered member of demo.com. In case you do not wish to receive mails from demo.com in the future, you can <a style="text-decoration:underline;color:#0f529d" href="'.base_url().'/unsubscribe/" target="_blank" >unsubscribe.</a></div>
							<br>
						</div>
					</center>
					</body>
					</html>'; 
				$j=1;$counter=1;
				//var_dump($result);
				//echo $body; die;
				
				foreach($result as $single_email){
					$temp_arr[$j++]=$single_email;
					$counter++;
					//Sent 100 mail at a time
					if( $counter > $noOfemailsInArray  || $counter%100==0){
						$to=implode(',',$temp_arr);
						$this->load->library('email');
						// Also, for getting full html you may use the following internal method:
						$body = $this->email->full_html($subject, $body);
						$this->email->from('newsletter@domain.com','Display Name'); // from email
						$this->email->reply_to('newsletter@domain.com');// Optional, an account where a human being reads.
						//$headers .= "BCC: hiddenemail@gmail.com\r\n";
						$this->email->bcc($to); //hide email receipt
						//$this->email->to('actual-mail@gmail.com')
						$this->email->subject($subject);
						$this->email->message($body);
						for($t=1;$t<=5;$t++){
							if(!empty($attachment_link[$t])){
								$this->email->attach($attachment_link[$t]);     // attachment
								//echo "I am here..";
							}
						}
						$result = $this->email->send();
						/**********************Manually Halt script*****************/
							$result1 = $this->db->query(" select * from  `newsletter_master`  " );
							foreach($result1->result_array() as $row1){
								$manual_checkpoint_sentmail		= $row1['checkpoint_sentmail'];			
							}
							if($manual_checkpoint_sentmail=='0'){
								die;
							}
						/**********************Manually Halt script end*****************/
						$this->db->query(" UPDATE `newsletter_master` 
						SET `noOfMailSent`='".$counter."'
						WHERE id='1' " );
						$temp_arr = array(); //reset array
						sleep(30);//sleep for 30sec
						//$j=1;
					} else {
						continue;
					}
				}
				
				/* if($result){
					$data['success']=$success;
					$this->load->view('site/mail_sucess_progress',$data);
				}; */
				$data['success']=1;
				/* $this->load->view('site/mail_sucess_progress',$data);
				echo $this->email->print_debugger();
				exit; */
				echo "<script>window.parent.location.href='".site_url('mailer/mail_sent_success')."';</script>";
			}
			
		}
		
		function mail_progress(){
			$data['display_msg']= '<div class="alert alert-warning" role="alert" >Mail Script is Running.</div>';
			$data['main_content'] = 'msg';
			$this->load->view('includes/site_template.php',$data);	
		}
		
		function mail_sent_success(){
			$result = $this->db->query("UPDATE `newsletter_master` SET `checkpoint_sentmail`='0', TotalnoOfemails='0' ,noOfMailSent='0'  " );
			$data['display_msg']= '<div class="alert alert-success" role="alert" >Mail has been reset successfully. </div>';
			$data['main_content'] = 'msg.php';
			$this->load->view('includes/site_template',$data);	
		}
		
		function share_fb($id,$item) {
		//echo $id . $item;
			if(is_numeric($id) && ($item==1 || $item==2 || $item==3 || $item==4 || $item==5)){
				$result = $this->db->query("SET character_set_results=utf8" );
				$result = $this->db->query("SELECT *
				FROM `sent_mail`
				WHERE id='".$id."'  " );
				foreach($result->result_array() as $row){
					$id				= $row['id'];
					$title[1]			= $row['title'];
					$description[1]		= $row['description'];
					$alink[1]			= $row['alink'];
					
					$title[2]			= $row['title2'];
					$description[2]		= $row['description2'];
					$alink[2]			= $row['alink2'];
					
					$title[3]			= $row['title3'];
					$description[3]		= $row['description3'];
					$alink[3]			= $row['alink3'];
					
					$title[4]			= $row['title4'];
					$description[4]		= $row['description4'];
					$alink[4]			= $row['alink4'];
					
					$title[5]			= $row['title5'];
					$description[5]		= $row['description5'];
					$alink[5]			= $row['alink5'];
				}
				$data ['id'] = $id;
				$data ['alink'] = $alink[$item];
				$data ['title'] = $title[$item];
				$data ['description'] = $description[$item];
				$this->load->view ( 'site/share_fb', $data );
			} else {
			 echo "<center><h1 style='color:red'>Something went wrong, Please try again later</h1></center>";
			}
		}
		
		function share_google($id) {
			$this->input->get('some_data', TRUE);
		}
		
		function db_reflect() {
			//Execute from command prompt to show process
			$output = shell_exec('kill -9 280035');  //kill -9 PID 
			$output .= shell_exec('ps aux | more');  //!ps aux | less  !ps aux | more 
			echo "<pre>$output</pre>";
			/* $result = $this->db->query("UPDATE `static` 
			SET `checkpoint_sentmail`='No'   " );
			foreach($result->result_array() as $row){
				echo $checkpoint_sentmail		= $row['checkpoint_sentmail'];			
			} */
		}
		
		function reset_mailer() {
			$result = $this->db->query("UPDATE `newsletter_master` SET `checkpoint_sentmail`='0', TotalnoOfemails='0' ,noOfMailSent='0' WHERE id=1 " );
			$data['display_msg']= '
			<div class="alert alert-success" role="alert" >Mailer has been reset successfully. Click <a href="'.site_url("mailer/draft_mail").'" >here</a> to compose/sent mail.</div>';
			$data['main_content'] = 'msg.php';
			$this->load->view('includes/site_template.php',$data);
		}
	}