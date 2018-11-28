<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Causes extends CI_Controller {
	/** 
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {  
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Home_model');
		$this->load->model('Causes_model');
		$this->load->library('calendar');
		$this->load->helper(array('url','form','file','cookie','captcha'));
		$autoload['helpers'] = array('form');
		$this->load->library('encrypt');
		//$this->lang->load('english','english');
		//$this->load->library('pagination');
	}
	public function index()
	{
		if(empty($this->session->userdata('logged_in')))
		{
			$this->load->view('Causes/login');
		}
		else{
			redirect('Causes/mycause');
		}
	}
	 /*---register page ---*/
	public function register(){
		if ($this->input->server('REQUEST_METHOD') === 'POST') {  
			//echo'<pre>';  print_r($this->input->post()); echo'</pre>'; die;
			$institution = $this->input->post('institution');
			$name = $this->input->post('name');
			$email = $this->input->post('email'); 
			$password = $this->input->post('password');
			$status = $this->input->post('status');
			$causelogo = $this->input->post('logoName');
			$ins_legal_name = $this->input->post('ins_legal_name');
			$ins_social_name = $this->input->post('ins_social_name');
			$ins_line_business = $this->input->post('ins_line_business');
			$rep_legal_name = $this->input->post('rep_legal_name');
			$rep_social_name = $this->input->post('rep_social_name');
			$rep_social_number = $this->input->post('rep_social_number');
			$rep_address = $this->input->post('rep_address');
			$rep_phone = $this->input->post('rep_phone');
			$rep_email = $this->input->post('rep_email');
			$account_number = $this->input->post('account_number');
			$bank_name = $this->input->post('bank_name');
			$bank_legal_name = $this->input->post('bank_legal_name');
			$bank_social_number = $this->input->post('bank_social_number');
			$bank_email = $this->input->post('bank_email');
			$ins_certificate = $this->input->post('ins_certificate');
			$role = $this->input->post('role');
			$created = date( 'Y-m-d H:i:s' );
			if($this->Causes_model->check_email($email) == 0)
			{
				$data = array(	
				'name' => $name,
				'email' => $email,
				'password' => MD5($password),
				'status' => 1,
				'role' => 2,
				'created' => date( 'Y-m-d H:i:s' ), 
				);
				$user_id = $this->Causes_model->AddData('users',$data);
			    $this->Causes_model->AddUserData($user_id, 'cause_logo', $causelogo);
				$this->Causes_model->AddUserData($user_id, 'cause_institution', $institution);
				$this->Causes_model->AddUserData($user_id, 'ins_legal_name', $ins_legal_name);
				$this->Causes_model->AddUserData($user_id, 'ins_line_business', $ins_line_business);
				$this->Causes_model->AddUserData($user_id, 'rep_legal_name', $rep_legal_name);
				//$this->Causes_model->AddUserData($user_id, 'rep_social_name', $rep_social_name);
				$this->Causes_model->AddUserData($user_id, 'rep_social_number', $rep_social_number);
				$this->Causes_model->AddUserData($user_id, 'rep_address', $rep_address);
				$this->Causes_model->AddUserData($user_id, 'rep_phone', $rep_phone);
				$this->Causes_model->AddUserData($user_id, 'rep_email', $rep_email);
				$this->Causes_model->AddUserData($user_id, 'account_number', $account_number);
				$this->Causes_model->AddUserData($user_id, 'bank_name', $bank_name);
				$this->Causes_model->AddUserData($user_id, 'bank_legal_name', $bank_legal_name);
				$this->Causes_model->AddUserData($user_id, 'bank_social_number', $bank_social_number);
				$this->Causes_model->AddUserData($user_id, 'bank_email', $bank_email);
				$this->Causes_model->AddUserData($user_id, 'ins_certificate', $ins_certificate);
				//Send email to new user with login detail
				$this->load->library('email');
				$config['protocol']    = 'smtp';
				$config['charset'] = 'utf-8';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				$config['smtp_host'] = 'mail.qualitywebbiz.com';
				$config['smtp_user'] = 'test2@qualitywebbiz.com';
				$config['smtp_pass'] = ']4k0W}{g4V#?';
				$config['smtp_port'] = '587';
				$this->email->initialize($config);
				$this->email->from('info@qualitywebbiz.com', 'CLYC');
				$this->email->to($email);
				$this->email->subject('Welcome Email');
				$template = FCPATH."application/views/Causes/email-templates/new_user.txt";
				$tpl = file_get_contents($template);
				$tpl = str_replace('{Name}',$name,$tpl);
				$tpl = str_replace('{User_name}',$email,$tpl);
				$url = base_url().'/Causes/';
				$tpl = str_replace('{URL}',$url,$tpl);
				$tpl = str_replace('{Password}',$password,$tpl);
				$this->email->message($tpl); 			
				$this->email->send();
				//echo '<pre>'; print_r($tpl); die;
				///echo'<pre>'; print_r($to); print_r($message); print_r($subject); 
				$data['message_success'] = TRUE;
				$this->session->set_flashdata('message_success', 'You have successfully registered. Please check your mail for login details'); 			
				redirect('Causes/login');			
			}
			else
			{
				$data['message_error'] = TRUE;
				$this->session->set_flashdata('message_error', 'Email already exist. Please try with different email id'); 
				redirect('Causes/register');
			}
		}
		$data['users']=$this->Causes_model->getReco('users');
		$header['title']='Create New Institution Account';
		$this->load->view('Causes/header',$header);
		$this->load->view('Causes/register');
		$this->load->view('Causes/footer');
	}
	/***--- Login  function for Cause user ***/
	public function login(){	
		if ($this->input->server('REQUEST_METHOD') === 'POST') {			
			$email = $this->input->post('email');
			$passWord = MD5($this->input->post('password'));						
			$row = $this->Causes_model->UserLogin($email, $passWord);
			if($row) {
				$userid = $row->user_id;
				$image = $this->Causes_model->getUserData($userid, 'cause_logo'); 
				$data = array(
				'id' => $row->user_id,
				'name' => $row->name,
				'email' => $row->email,
				'role' => 2,
				'image' => $image->meta_value
				);
				$this->session->set_userdata('logged_in', $data);
				$data['message_success'] = TRUE;
				$this->session->set_flashdata('message_success', 'You Have Successfully login'); 			
				redirect('Causes/mycause');
			}
			else {
				$data['message_error'] = TRUE;
				$this->session->set_flashdata('message_error', 'Invalid username or password');
				redirect('Causes/login');
			}
		}
		if(empty($this->session->userdata('logged_in')))
		{
			$this->load->view('Causes/login');
		}
		else{
			redirect('Causes/mycause');
		}
	}
	/***--- Logout function for Cause user ***/
	public function logout()  
		{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect(site_url(), 'refresh');
	}
	/***--- Upload user logo image from registration page ***/
	public function upload_institution_logo(){
		if($_FILES["file"]["name"] != '')
		{
		 $test = explode('.', $_FILES["file"]["name"]);
		 $ext = end($test);
		 $name = time() . '.' . $ext;
		 $location = './assets/uploads/institution-logo/' . $name;  
		 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
		 //echo '<img src="'.base_url().$location.'" height="150" width="225" class="img-thumbnail" />';
		 echo $name;
		}
	}
	//////// my-cause 
	public function mycause()
	{ 
		if(!empty($this->session->userdata('logged_in')))
		{
			$loginData = $this->session->userdata('logged_in');
			$loginUsername = $loginData['name'];
			$loginlogoimage = $loginData['image'];
			$userid = $loginData['id'];
			$data = array();
			$data['my_causes'] = $this->Causes_model->getMyCauseData($userid); 
			$header['title'] = $this->lang->line('welcome').' '.$loginUsername ;
			$this->load->view('Causes/header',$header);
			$this->load->view('Causes/my-causes',$data);
			$this->load->view('Causes/footer');
		} 
		else{
				redirect(site_url().'Causes/login', 'refresh');
		}
	}
	/* Load cause creation page */
	public function causescreation()
	{ 
		if(!empty($this->session->userdata('logged_in')))
		{
			$header['title'] = $this->lang->line('cause_creation');
			$certificate_name = $this->Causes_model->getReco('manage_certificates');
			$data['certificate_name']=$certificate_name;
			//echo '<pre>'; print_r($certificate_name); echo '</pre>';
			$this->load->view('Causes/header',$header);
			$this->load->view('Causes/causes-creations',$data);
			$this->load->view('Causes/footer');
		}
		else{
				redirect(site_url().'Causes/login', 'refresh');
		}
	}
	/***--- Upload cause logo image from cause creation page ***/
	public function upload_cause_picture(){
		if($_FILES["file"]["name"] != '')
		{
		 $test = explode('.', $_FILES["file"]["name"]);
		 $ext = end($test);
		 $name = time() . '.' . $ext;
		 $location = './assets/uploads/cause-picture/' . $name;  
		 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
		 //echo '<img src="'.base_url().$location.'" height="150" width="225" class="img-thumbnail" />';
		 echo $name;
		}
	}
	/***--- Upload activity photo image ***/
	public function upload_activity_photo(){
		//echo $_POST['act_id']; die('here');
		if($_FILES["file"]["name"] != '')
		{
		 $test = explode('.', $_FILES["file"]["name"]);
		 $ext = end($test);
		 $name = time() . '.' . $ext;
		 $location = './assets/uploads/activity-photo/' . $name;  
		 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
		 //echo '<img src="'.base_url().$location.'" height="150" width="225" class="img-thumbnail" />';
		/*  $data = array(	
				'activity_photo' => $name, 
				);
		$this->db->where('act_id', $_POST['act_id']);  				
		$this->db->update('cause_stage_activity',$data); */
		echo $name;
		}
	}
	//save cause data into database
	public function cause_creation_save_info(){
		//echo '<pre>'; print_r($_POST); 
		//die('ddd');
		//echo '<pre>'; print_r($_POST); die;
		$another_activity = $_POST['another_activity'];
		$cause_name = $_POST['cause_name'];
		$cause_desc = $_POST['cause_desc'];
		$pesimistic_scen = $_POST['pesimistic_scen'];
		$expected_scen = $_POST['expected_scen'];
		$best_scen = $_POST['best_scen'];
		$sen_unit = $_POST['sen_unit'];
		$image_name = $_POST['image_name'];
		$db_cert_ids = $_POST['db_cert_ids'];
		$db_serv_ids = $_POST['db_serv_ids'];
		$user_id = $_POST['user_id'];
		$data = array(	
				'user_id' => $user_id,
				'another_activity' => $another_activity,
				'name' => $cause_name,
				'description' => $cause_desc,
				'pesimistic_scenario' => $pesimistic_scen,
				'expected_scenario' => $expected_scen,
				'best_scenario' => $best_scen,
				'unit' => $sen_unit,
				'photo' => $image_name,
				'created' => date( 'Y-m-d H:i:s' ), 
				'status' => 0, 
				);
		$cause_id = $this->Causes_model->AddData('causes',$data);
		//$cause_id = 2;
		$this->session->set_userdata('cause_id', $cause_id);
		$db_cert_ids = array_filter($_POST['db_cert_ids']);
		$cert_count = count($db_cert_ids);
		//save certificates
		for($i = 0; $i < $cert_count; $i++) { 
			$certdata = array(	
				'cause_id' => $cause_id
				);
			$this->db->where('cert_id', $db_cert_ids[$i]);
			$this->db->update('causes_certificates',$certdata);
			//echo $this->db->last_query(); echo '<pre>';
		}
		$db_serv_ids = array_filter($_POST['db_serv_ids']);
		$serv_count = count($db_serv_ids);
		//save services
		for($i = 0; $i < $serv_count; $i++) { 
			$servdata = array(	
				'cause_id' => $cause_id
				);
			$this->db->where('serv_id', $db_serv_ids[$i]);
			$this->db->update('causes_services',$servdata);
			//echo $this->db->last_query(); echo '<pre>';
		}
		echo $cause_id;
	}
	//Update cause data into database
	public function cause_creation_update_info(){
		//echo '<pre>'; print_r($_POST);
		//cause data
		$another_activity = $_POST['another_activity'];
		$cause_name = $_POST['cause_name'];
		$cause_desc = $_POST['cause_desc'];
		$pesimistic_scen = $_POST['pesimistic_scen'];
		$expected_scen = $_POST['expected_scen'];
		$best_scen = $_POST['best_scen'];
		$sen_unit = $_POST['sen_unit'];
		$image_name = $_POST['image_name'];
		$user_id = $_POST['user_id'];
		//$causePic = $_POST['causePic'];
		$cause_id = $_POST['cause_id'];
		$data = array(	
			'another_activity' => $another_activity,
			'user_id' => $user_id,
			'name' => $cause_name,
			'description' => $cause_desc,
			'pesimistic_scenario' => $pesimistic_scen,
			'expected_scenario' => $expected_scen,
			'best_scenario' => $best_scen,
			'unit' => $sen_unit,
			'photo' => $image_name,
			'created' => date( 'Y-m-d H:i:s' ), 
			'status' => 0, 
		);
		$this->db->where('id', $cause_id);  				
		$this->db->update('causes',$data); //update cause info
		$db_cert_ids = array_filter($_POST['db_cert_ids']);
		$cert_count = count($db_cert_ids);
		//save certificates
		for($i = 0; $i < $cert_count; $i++) { 
			$certdata = array(	
				'cause_id' => $cause_id
				);
			$this->db->where('cert_id', $db_cert_ids[$i]);
			$this->db->update('causes_certificates',$certdata);
			//echo $this->db->last_query(); echo '<pre>';
		}
		$db_serv_ids = array_filter($_POST['db_serv_ids']);
		$serv_count = count($db_serv_ids);
		//save services
		for($i = 0; $i < $serv_count; $i++) { 
			$servdata = array(	
				'cause_id' => $cause_id
				);
			$this->db->where('serv_id', $db_serv_ids[$i]);
			$this->db->update('causes_services',$servdata);
			//echo $this->db->last_query(); echo '<pre>';
		}
		echo $cause_id;
	}
	//save certificates data into database
	public function cause_creation_save_certificates(){
		//echo '<pre>'; print_r($_POST); die;
		$certificates_name = $_POST['certificates_name'];
		$other_certificae = $_POST['other_certificae'];
		$corporate_benefits = $_POST['corporate_benefits'];
		$corporate_restrictions = $_POST['corporate_restrictions'];
		$imagename = $_POST['imagename'];
		$data = array(	
				'cert_name' => $certificates_name,
				'cert_other' => $other_certificae,
				'cert_corporate_benefits' => $corporate_benefits,
				'cert_restrictions' => $corporate_restrictions,
				'cert_image' => $imagename,
				'cause_id' => 0,
				);
		$act_id = $this->Causes_model->AddData('causes_certificates',$data);
		echo $act_id;
	}
	//Update certificates data into database
	public function cause_creation_update_certificates(){
		//echo '<pre>'; print_r($_POST); die;
		$certificates_name = $_POST['certificates_name'];
		$other_certificae = $_POST['other_certificae'];
		$corporate_benefits = $_POST['corporate_benefits'];
		$corporate_restrictions = $_POST['corporate_restrictions'];
		$imagename = $_POST['imagename'];
		$dbCertId = $_POST['dbCertId'];
		$data = array(	
				'cert_name' => $certificates_name,
				'cert_other' => $other_certificae,
				'cert_corporate_benefits' => $corporate_benefits,
				'cert_restrictions' => $corporate_restrictions,
				'cert_image' => $imagename,
				);
		$this->db->where('cert_id', $dbCertId);  
		$this->db->update('causes_certificates', $data); 
		echo $dbCertId;
	}
	//save services data into database
	public function cause_creation_save_services(){
		//echo '<pre>'; print_r($_POST); die;
		$service_name = $_POST['service_name'];
		$imagename = $_POST['imagename'];
		$data = array(	
					'service_name' => $service_name,
					'service_image' => $imagename,
					'cause_id' => 0,
				);		
		$serv_id = $this->Causes_model->AddData('causes_services',$data);
		echo $serv_id;
	}
	//Update services data into database
	public function cause_creation_update_services(){
		//echo '<pre>'; print_r($_POST); die;
		$service_name = $_POST['service_name'];
		$imagename = $_POST['imagename'];
		$dbServId = $_POST['dbServId'];
		$data = array(	
					'service_name' => $service_name,
					'service_image' => $imagename,
				);		
		$this->db->where('serv_id', $dbServId);  
		$this->db->update('causes_services', $data); 
		echo $dbServId;
	}
	//save Activity data into database
	public function cause_creation_save_activity(){
		//echo '<pre>'; print_r($_POST); die;
		$act_name = $_POST['act_name'];
		$act_number = $_POST['act_number'];
		$act_desc = $_POST['act_desc'];
		$act_pesimistic = $_POST['act_pesimistic'];
		$act_expected = $_POST['act_expected'];
		$act_best = $_POST['act_best'];
		$icon_name = $_POST['icon_name'];
		$cause_id = $_POST['cause_id'];
		$activity = $_POST['activity'];
		$data = array(	
				'act_name' => $act_name,
				'act_number' => $act_number,
				'act_description' => $act_desc,
				'act_pesimistic_scenario' => $act_pesimistic,
				'act_expected_scenario' => $act_expected,
				'act_best_scenario' => $act_best,
				'act_icon' => $icon_name,
				'stage_id' =>$activity,  //this is temprary id. Will Update after creation of stage
				'cause_id' => $cause_id, 
				);
		$act_id = $this->Causes_model->AddData('cause_stage_activity',$data);
		echo $act_id;
	}
	//Update Activity data into database
	public function cause_creation_update_activity(){
		//echo '<pre>'; print_r($_POST); die;
		$act_name = $_POST['act_name'];
		$act_number = $_POST['act_number'];
		$act_desc = $_POST['act_desc'];
		$act_pesimistic = $_POST['act_pesimistic'];
		$act_expected = $_POST['act_expected'];
		$act_best = $_POST['act_best'];
		$icon_name = $_POST['icon_name'];
		$cause_id = $_POST['cause_id'];
		$activity = $_POST['activity'];
		$db_act_id = $_POST['db_act_id'];
		$data = array(	
				'act_name' => $act_name,
				'act_number' => $act_number,
				'act_description' => $act_desc,
				'act_pesimistic_scenario' => $act_pesimistic,
				'act_expected_scenario' => $act_expected,
				'act_best_scenario' => $act_best,
				'act_icon' => $icon_name,
				'stage_id' =>$activity,  //this is temprary id. Will Update after creation of stage
				'cause_id' => $cause_id, 
				);
		$this->db->where('act_id', $db_act_id);  
		$this->db->update('cause_stage_activity', $data); 
		echo $db_act_id;
	}
	//save Stage data into database
	public function cause_creation_save_stage(){
		//echo '<pre>'; print_r($_POST); die;
		$stg_name = $_POST['stg_name'];
		$stg_number = $_POST['stg_number'];
		$stg_desc = $_POST['stg_desc'];
		$icon_name = $_POST['icon_name'];
		$cause_id = $_POST['cause_id'];
		$db_act_ids = $_POST['db_act_ids'];
		$data = array(	
				'stage_name' => $stg_name,
				'stage_number' => $stg_number,
				'stage_description' => $stg_desc,
				'stage_icon' => $icon_name,
				'cause_id' => $cause_id, 
				);			
		$stg_id = $this->Causes_model->AddData('cause_stage',$data);
		foreach($db_act_ids as $ids){
			$data = array(	
					'stage_id' => $stg_id
					);
			$this->db->where('act_id', $ids);  
			$this->db->update('cause_stage_activity', $data); 
		}
		echo $stg_id;
	}
	//save Stage data into database
	public function cause_creation_update_stage(){
		//echo '<pre>'; print_r($_POST); die;
		$stg_name = $_POST['stg_name'];
		$stg_number = $_POST['stg_number'];
		$stg_desc = $_POST['stg_desc'];
		$icon_name = $_POST['icon_name'];
		$cause_id = $_POST['cause_id'];
		$db_act_ids = $_POST['db_act_ids'];
		$db_stg_id = $_POST['db_stg_id'];
		$data = array(	
				'stage_name' => $stg_name,
				'stage_number' => $stg_number,
				'stage_description' => $stg_desc,
				'stage_icon' => $icon_name,
				'cause_id' => $cause_id, 
				);			
		$this->db->where('stage_id', $db_stg_id);  
		$this->db->update('cause_stage',$data);
		foreach($db_act_ids as $ids){
			$data = array(	
					'stage_id' => $db_stg_id
					);
			$this->db->where('act_id', $ids);  
			$this->db->update('cause_stage_activity', $data); 
		}
		echo $db_stg_id;
	}
	//display dynamic project preview on click of Project tab on Cause ct=reation amd edit page
	public function get_view_ajax()
	{
		$cause_id = $_POST['cause_id'];
		$cause_data = $this->Causes_model->getCauseData($cause_id); 
		$cause_userdata = $this->Causes_model->getCauseUserData($cause_id); 
		$stage_data = $this->Causes_model->getStageData($cause_id); 
		$activity_data = $this->Causes_model->getActivityData($cause_id); 
		$cert_data = $this->Causes_model->getAllCertificateData($cause_id); 
		$serv_data = $this->Causes_model->getAllServiceData($cause_id); 
		$cause_donors = $this->Causes_model->getAllCauseDonors($cause_id); 
		$thanks_card = $this->Causes_model->getAllThanksCard($cause_id); 
		$data['cause_data'] = $cause_data;
		$data['cause_userdata'] = $cause_userdata;
		$data['stage_data'] =$stage_data;
		$data['activity_data'] = $activity_data;
		$data['cert_data'] = $cert_data;
		$data['serv_data'] = $serv_data;
		$data['cause_donors'] = $cause_donors;
		$data['thanks_card'] = $thanks_card;
		$response = $this->load->view('Causes/causes-project',$data,TRUE);
		echo $response; 
	}
	
	
	
	//display dynamic project preview on click of Project tab on Cause ct=reation amd edit page
	public function update_performance()
	{
		$cause_id = $this->uri->segment(3);
		$cause_data = $this->Causes_model->getCauseData($cause_id); 
		$cause_userdata = $this->Causes_model->getCauseUserData($cause_id); 
		$stage_data = $this->Causes_model->getStageData($cause_id); 
		$activity_data = $this->Causes_model->getActivityData($cause_id); 
		$cert_data = $this->Causes_model->getAllCertificateData($cause_id); 
		$serv_data = $this->Causes_model->getAllServiceData($cause_id); 
		$cause_donors = $this->Causes_model->getAllCauseDonors($cause_id); 
		$thanks_card = $this->Causes_model->getAllThanksCard($cause_id); 
		$data['cause_data'] = $cause_data;
		$data['cause_userdata'] = $cause_userdata;
		$data['stage_data'] =$stage_data;
		$data['activity_data'] = $activity_data;
		$data['cert_data'] = $cert_data;
		$data['serv_data'] = $serv_data;
		$data['cause_donors'] = $cause_donors;
		$data['thanks_card'] = $thanks_card;
		$header['title'] = 'Update Performance';
		$this->load->view('Causes/header',$header);
			$this->load->view('Causes/causes-project',$data);
			$this->load->view('Causes/footer');
	}
	
	
	
	//Set status to 1 after click on Finish Cause button on Project tab
	public function finish_cause()
	{
		$cause_id = $_POST['cause_id'];
		$data = array(	
					'status' => 1 
				);			
		$this->db->where('id', $cause_id);  				
		$cause_id = $this->db->update('causes',$data);
		//echo $this->db->last_query(); die;
		echo '1';
		exit;
	}
	
	
	//Set status of pop_approve to 1 after click on Got it button on popup
	public function approve_cuase_status()
	{
		$cause_id = $_POST['cause_id'];
		$data = array(	
					'pop_approve' => 1 
				);			
		$this->db->where('id', $cause_id);  				
		$cause_id = $this->db->update('causes',$data);
		//echo $this->db->last_query(); die;
		echo '1';
		exit;
	}
	//Set status to 2 after click on Finish Cause button on Project tab
	public function publish_cause()
	{
		$cause_id = $_POST['cause_id'];
		$data = array(	
					'status' => 2 
				);
		$this->db->where('id', $cause_id);  				
		$cause_id = $this->db->update('causes',$data);
		//$this->session->set_userdata('cause_id', $cause_id);
		if ($this->db->affected_rows() > 0)
		{
			echo  '1';
		}
		else
		{
			echo  '0';
		}
	}
	/* Load cause creation page */
	public function edit_cause()
	{ 
		if(!empty($this->session->userdata('logged_in')))
		{
			$cause_id = $this->uri->segment(3);
			
			$cause_data = $this->Causes_model->getCauseData($cause_id); 
			$stage_data = $this->Causes_model->getStageData($cause_id); 
			$activity_data = $this->Causes_model->getActivityData($cause_id);
			$certificates_data = $this->Causes_model->getCertificatesData($cause_id);
			$services_data = $this->Causes_model->getServicesData($cause_id);
			$data = array();			
			$data['cause_data'] = $cause_data;
			$data['stage_data'] =$stage_data;
			$data['activity_data'] = $activity_data;
			$data['certificates_data'] = $certificates_data;
			$data['services_data'] = $services_data;
			$certificate_name = $this->Causes_model->getReco('manage_certificates');
			$data['certificate_name']=$certificate_name;
			//echo '<pre>'; print_r($certificate_name);echo '</pre>';
			$header['title']=$this->lang->line('edit_cause');
			$this->load->view('Causes/header',$header);
			$this->load->view('Causes/causes-edit',$data);
			$this->load->view('Causes/footer');
		}
		else{
				redirect(site_url().'Causes/login', 'refresh');
		}
	}
	//Delete crtificate from edit cause page
	public function delete_certificate()
	{
		$certid = $_POST['certid'];
		$this -> db -> where('cert_id', $certid);
		$this -> db -> delete('causes_certificates');
		//$this->session->set_userdata('cause_id', $cause_id);
		if ($this->db->affected_rows() > 0)
		{
			echo  '1';
		}
		else
		{
			echo  '0';
		}
	}
	//Delete service from edit cause page
	public function delete_service()
	{
		$servid = $_POST['servid'];
		$this -> db -> where('serv_id', $servid);
		$this -> db -> delete('causes_services');
		//$this->session->set_userdata('cause_id', $cause_id);
		if ($this->db->affected_rows() > 0)
		{
			echo  '1';
		}
		else
		{
			echo  '0';
		}
	}
	//Add thanks card
	public function add_thanks_card()
	{
		$message = $_POST['message'];
		$donor_user_id = $_POST['donor_user_id'];
		$cause_id = $_POST['cause_id'];
		$data = array(	
				'message' => $message,
				'donor_user_id' => $donor_user_id,
				'cause_id' => $cause_id 
				);
		$row_id = $this->Causes_model->AddData('thanks_card',$data);
		if ($row_id > 0)
		{
			echo  $row_id;
		}
		else
		{
			echo  '0';
		}
	}
	//Update thanks card
	public function update_thanks_card()
	{
		$message = $_POST['message'];
		$donor_user_id = $_POST['donor_user_id'];
		$cause_id = $_POST['cause_id'];
		$db_card_id = $_POST['db_card_id'];
		$data = array(	
				'message' => $message,
				'donor_user_id' => $donor_user_id,
				'cause_id' => $cause_id 
				);
		$this->db->where('id', $db_card_id);  
		$this->db->update('thanks_card', $data); 
		echo $db_card_id;
	}
	//Add Activity log
	public function add_activity_log()
	{
		$description = $_POST['description'];
		$act_image_name = $_POST['act_image_name'];
		$act_id = $_POST['act_id'];
		$cause_id = $_POST['cause_id'];
		$data = array(	
				'act_id' => $act_id,
				'cause_id' => $cause_id,
				'description' => $description, 
				'image' => $act_image_name
				);
		$row_id = $this->Causes_model->AddData('activity_log',$data);
		if ($row_id > 0)
		{
			echo  $row_id;
		}
		else
		{
			echo  '0';
		}
	}
	//Update Activity log
	public function update_activity_log()
	{
		$description = $_POST['description'];
		$act_image_name = $_POST['act_image_name'];
		$act_id = $_POST['act_id'];
		$cause_id = $_POST['cause_id'];
		$db_actlog_id = $_POST['db_actlog_id'];
		$data = array(
				'description' => $description, 
				'image' => $act_image_name
				);
		$this->db->where('id', $db_actlog_id);  
		$this->db->update('activity_log', $data); 
		echo $db_actlog_id;
	}
	
	/////	//certificate name
	public function certificate_name()
	{
		//echo '<pre>'; print_r($_POST);  
		$id = $_POST['id']; 
		$certificate_alldata = $this->Causes_model->getRecoId('manage_certificates',$id);
		//echo '<pre>'; print_r($certificate_alldata);  die;
		echo json_encode($certificate_alldata); 
		
	}
	
	
	//Save activity amount from Update performance page
	public function save_activity_amount()
	{
		$actid = $_POST['actid'];
		$amount = $_POST['amount'];
		$data = array(	
					'act_added_amount' => $amount 
				);			
		$this->db->where('act_id', $actid);  				
		$cause_id = $this->db->update('cause_stage_activity',$data);
		//echo $this->db->last_query(); die;
		echo '1';
		exit;
	}
	 
}