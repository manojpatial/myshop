<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		
		
		$this->load->helper('url');
		$this->load->model('Admin_model');
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->library('session');
		
	 }
	 
	public function index() { 
		if(!empty($this->session->userdata('logged_in') ) && $this->session->userdata('logged_in')['role'] == 'admin')
		{
			redirect('admin/dashboard');
		}
		else{
			$this->load->view('admin/admin_login');
		}
	}
	

	/***--- Login  function for admin user ***/
	public function admin_Login() { 	
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$email = $this->input->post('email');
			$passWord = MD5($this->input->post('password'));
			//echo '<pre>'; print_r($passWord); print_r($email );
			$result = $this->Admin_model->adminLogin($email, $passWord);
			if($result) {
				$data = array(
					'id' => $result->id,
					'name' => $result->name,
					'role' => $result->role,
					'email' => $result->email,
				);
				
				$this->session->set_userdata('logged_in',$data);
				//echo '<pre>'; print_r($data); exit();
				//$adminId = $this->session->userdata('id');
				//echo '<pre>'; print_r($adminId); 
				$data['message_success'] = TRUE;
				$this->session->set_flashdata('message_success', 'You Have Successfully login'); 			
				redirect('admin/dashboard');
				
			  }
			else {

				$data['message_error'] = TRUE;
				$this->session->set_flashdata('message_error', 'Invalid username or password');
				redirect('admin/index');
			}
		 }
	}
		
  /***--- Loading  dashboard for admin ***/
	public function dashboard(){ 
	//echo '<pre>'; print_r($this->session->userdata('logged_in')['role']);
	if(!empty($this->session->userdata('logged_in') ) && $this->session->userdata('logged_in')['role'] == 'admin')
		{
			$adminData = $this->session->userdata('logged_in');
			$adminid = $adminData['id'];
			$projectdata = $this->Admin_model->getprojectdata('projects');
			$data['project_data']=$projectdata;
			//echo '<pre>';  print_r($data); echo '</pre>';
			$corporate_data= $this->Admin_model->getcorporatecompany_data();
		    $data['corporate_companydata']=$corporate_data;
		    $institution_data= $this->Admin_model->getcauseinstitution_data();
		    $data['institution_data']=$institution_data;
			$causes_data= $this->Admin_model->getcause_data('causes');
			$data['causes_data']=$causes_data;
			//echo '<pre>';  print_r($causes_data); echo '</pre>';
		    $header['title']='';
			$this->load->view('admin/admin_header',$header);
		    $this->load->view('admin/dashboard',$data);
		    $this->load->view('admin/admin_footer');
		}
		else{
			redirect(site_url().'admin/index', 'refresh');
		}
	
    
	 }	
	 
	 
	/***--- Logout  admin user ***/
	public function logout()
		{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('admin/index');
	}
	
	
	/***--- ---------project page-------------- ***/
    public function project()
	{       
		if(!empty($this->session->userdata('logged_in') ) && $this->session->userdata('logged_in')['role'] == 'admin')
		{
		   $project_id = $this->uri->segment(3);
		   $project_data= $this->Admin_model->getprojectuserData($project_id); 
		   $data['project_data'] =$project_data;
		  // echo '<pre>'; print_r($project_data);    echo '</pre>';
		   $selected_causes= $project_data['0']['selected_causes'] ;
		   $seletedimageid = explode(',',$selected_causes );
		   $selcause = $this->session->set_userdata('select_causesid',$seletedimageid);
		   $project_image = $this->Admin_model->get_selected_causes_image(    
		   $selected_causes);
		   $data['project_images']=$project_image;
		   $popupdata=$this->Admin_model->getcauseuser_data('causes');     
	       $data['popup_data'] =$popupdata;
		   $header['title']='Project creation';
		   $this->load->view('admin/admin_header',$header);
		   $this->load->view('admin/project',$data);
		   $this->load->view('admin/admin_footer');
		   }
		   else{
		   redirect(site_url().'admin/index', 'refresh');
		  }
	}
	
	
	/**----------Select causeid-------------***/
	public function selectcauses()
	{   
		$cause_id = $_POST['cause_id'];
		if(!empty($this->session->userdata('select_causesid')))
		{
			//echo '1';
			$data =$this->session->userdata('select_causesid');
			$data[] = $cause_id;
			$this->session->set_userdata('select_causesid', $data);
		}
		else
		{
			//echo '2';
			$data = array($cause_id);
			$this->session->set_userdata('select_causesid', $data);
		}		
	    print_r($data);
	}
	
	
	/***-----------Select removeid---------------***/
	public function removecauses()
	{   
		$remove_id = $_POST['remove_id'];
		if(!empty($this->session->userdata('select_causesid')))
		{
			$data =$this->session->userdata('select_causesid');
			if (($key = array_search($remove_id, $data)) !== false) {
				unset($data[$key]);
			}
		
			$this->session->set_userdata('select_causesid', $data);
		}
		
      }

	 /*********------- update Project info --------------*/
	 public function project_submit_update_info(){
		//echo '<pre>'; print_r($_POST);  exit();
		$project_id = $_POST['project_id'];
		$user_id = $_POST['user_id'];
		$project_name = $_POST['project_name'];
		$project_description = $_POST['project_description'];
		$selectedcause = $_POST['causes_ids'];
		$selected_causes = implode(",",$selectedcause);
		$donation_amount = $_POST['donation_amount'];
		$voting_startdate = $_POST['voting_startdate'];
		$voting_starttime = $_POST['voting_starttime'];
		$voting_enddate = $_POST['voting_enddate'];
		$voting_endtime = $_POST['voting_endtime'];
		$show_amount = $_POST['show_amount'];
		$donation_frequency = $_POST['donation_frequency'];
		$donation_date = $_POST['donation_date'];
		$donation_time = $_POST['donation_time'];
		if($donation_frequency == 'Once')
		{
			$donation_frequency_val = 'Once';
		}
		elseif($donation_frequency == 'month')
		{
			$donation_frequency_val = 'month';
		}
		else{
			$donation_frequency_val = $donation_date.' '.$donation_time;
		}
		
		$donation_type = $_POST['donation_type'];
		$data = array(	
		        'id' => $project_id,
				'user_id' => $user_id,
				'name' =>$project_name,
				'description' => $project_description,
				'selected_causes' => $selected_causes,
				'donation_amount' => $donation_amount,
				'voting_start' => $voting_startdate.' '.$voting_starttime,
				'voting_end' => $voting_enddate.' '.$voting_endtime,
				'show_amount' => $show_amount,
				'donation_frequency' => $donation_frequency_val,
				'show_amount' => $show_amount,
				'donation_type' => $donation_type,
				'status' => 2, 
				);	

         //echo	 '<pre>'; print_r($data); 	 echo exit();	 '</pre>';	
		$this->db->where('id', $project_id);  				
		$project_id = $this->db->update('projects',$data);
		echo $project_id;
		
	 }
	 /**-------------popup data----------*/
	 public function popup_data(){
		$selectid = $this->session->userdata('select_causesid');
		//echo '<pre>'; print_r($selectid); exit();
		$selcause = implode(",",$selectid); 
		//echo '<pre>'; print_r($selcause); 
		$result = $this->Admin_model->get_selected_causes_data($selcause); 
		//$data['causes_data'] = $result; 
		echo json_encode($result);
		//echo '<pre>'; print_r($result); exit();	
		}
		
   /**---------donation voting type---------*/
	public function voting_type(){
	    $project_id = $_POST['project_id'];
		$donation_type =$_POST['donation_type'];
		$data = array(	
				'status' => 2 ,
				'donation_type'=>$donation_type,
		);					
		$this->db->where('id',$project_id);  				
		$project_update = $this->db->update('projects',$data);
		$visualization_data =$this->Admin_model->getvizulizationData($project_id);
		$data['visualization_data']=$visualization_data;
		//echo '<pre>'; print_r($visualization_data);echo '</pre>';
		$selected_causes= $visualization_data['0']['selected_causes'] ;
		//echo '<pre>'; print_r($selected_causes);echo '</pre>';
		$project_image = $this->Admin_model->get_selected_causes_image(    
		  $selected_causes);
		$data['project_images']=$project_image;
		$this->load->view('admin/project_visualization',$data);
		}
		
		
		
	/***--- ------change comapny logo ---------***/
	
	public function change_company_logo(){
		if($_FILES["file"]["name"] != '')
		{
		 $test = explode('.', $_FILES["file"]["name"]);
		 $ext = end($test);
		 $name = rand(100, 999) . '.' . $ext;
		 $location = './assets/uploads/corporate-logo/' . $name;  
		 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
		 //echo '<img src="'.base_url().$location.'" height="150" width="225" class="img-thumbnail" />';
		 echo $name;
		}
	 }	
		
		//Update services data into database
	public function change_companylogo(){
    //echo '<pre>'; print_r($_POST); exit();
	$comapny_user_id = $_POST['comapny_user_id'];
	$companylogo = $_POST['companylogo'];
	$data = array(	
					'meta_value' => $companylogo ,
				);
	//echo '<pre>'; print_r($data); exit();
	
	$this->db->where('user_id',$comapny_user_id); 
	$this->db->where('meta_key','corporate_logo'); 
   $this->db->update('usermeta', $data);	
	
		
	} 
		
 /***--- ---------company page-------------***/
    public function company()
	{       
		if(!empty($this->session->userdata('logged_in') ) && $this->session->userdata('logged_in')['role'] == 'admin')
		{
		   $user_id = $this->uri->segment(3);
		   //echo '<pre>' ; print_r($user_id); 	echo '</pre>';
		   $company_data= $this->Admin_model->getcorporatecompany_dataid($user_id); 
		   $data['company_data'] =$company_data;
		   $companyname= $company_data['0']['corpname'] ;
		   //echo '<pre>' ; print_r($companyname); 	echo '</pre>';
		   $header['title']=$companyname;
		   $this->load->view('admin/admin_header',$header);
		   $this->load->view('admin/company',$data);
		   $this->load->view('admin/admin_footer');
		}
		   else{
			redirect(site_url().'admin/index', 'refresh');
		   }
	}	
	
	/***------------institution page---------**/
	public function institution()
	{       
		if(!empty($this->session->userdata('logged_in') ) && $this->session->userdata('logged_in')['role'] == 'admin')
		{
		   $user_id = $this->uri->segment(3);
		   $institute_data= $this->Admin_model->getinstitution_dataid($user_id); 
		   $data['institute_data'] =$institute_data;
		   //echo '<pre>'; print_r($institute_data); echo '</pre>';
		   $instituename= $institute_data['0']['institution'];
		   $header['title']=$instituename;
		   $this->load->view('admin/admin_header',$header);
		   $this->load->view('admin/institution',$data);
		   $this->load->view('admin/admin_footer');
		  }
		   else{
		  redirect(site_url().'admin/index', 'refresh');
		  }
	}	
	
	/*********----------change_cause_status---------------***/
	public function change_cause_status(){
    //echo '<pre>'; print_r($_POST); exit();
	$cause_aprove_id = $_POST['cause_aprove_id'];
	$data = array(	
					'id' => $cause_aprove_id,
					'status' =>3,
				);
	$this->db->where('id',$cause_aprove_id); 
    $this->db->update('causes', $data);	
	} 
	
	
	/***-----------causes page-------------***/
	public function causes()
	{       
		if(!empty($this->session->userdata('logged_in') ) && $this->session->userdata('logged_in')['role'] == 'admin')
		{
		  $cause_id = $this->uri->segment(3);
		  $cause_data = $this->Admin_model->getCauseData($cause_id);
		  //echo '<pre>'; print_r($cause_data);   echo '</pre>';
		  $stage_data = $this->Admin_model->getStageData($cause_id);  
		  $activity_data = $this->Admin_model->getActivityData($cause_id);
		  $certificates_data = $this->Admin_model->getCertificatesData($cause_id);
		  $services_data = $this->Admin_model->getServicesData($cause_id);
		  $data = array();			
		  $data['cause_data'] = $cause_data;
		  $data['stage_data'] =$stage_data;
		  $data['activity_data'] = $activity_data;
		  $data['certificates_data'] = $certificates_data;
		  $data['services_data'] = $services_data;
		  $certificate_name = $this->Admin_model->getReco('manage_certificates');
		  $data['certificate_name']=$certificate_name;
		  $header['title']='';
		  $this->load->view('admin/admin_header',$header);
		  $this->load->view('admin/view_causes',$data);
		  $this->load->view('admin/admin_footer');
		   }
		  else{
				redirect(site_url().'admin/index', 'refresh');
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
		 $data = array(	
				'activity_photo' => $name, 
				);
							
		$this->db->where('act_id', $_POST['act_id']);  				
		$this->db->update('cause_stage_activity',$data);
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
				'status' => 2, 
				);
							
						
		$cause_id = $this->Admin_model->AddData('causes',$data);
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
			'status' => 2, 
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
							
						
		$act_id = $this->Admin_model->AddData('causes_certificates',$data);
		
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
		$serv_id = $this->Admin_model->AddData('causes_services',$data);
		
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
							
						
		$act_id = $this->Admin_model->AddData('cause_stage_activity',$data);
		
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
		$stg_id = $this->Admin_model->AddData('cause_stage',$data);
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
		$cause_data = $this->Admin_model->getCauseData($cause_id); 
		$cause_userdata = $this->Admin_model->getCauseUserData($cause_id); 
		$stage_data = $this->Admin_model->getStageData($cause_id); 
		$activity_data = $this->Admin_model->getActivityData($cause_id); 
		$cert_data = $this->Admin_model->getAllCertificateData($cause_id); 
		$serv_data = $this->Admin_model->getAllServiceData($cause_id); 
		$cause_donors = $this->Admin_model->getAllCauseDonors($cause_id); 
		$thanks_card = $this->Admin_model->getAllThanksCard($cause_id); 
		$data['cause_data'] = $cause_data;
		$data['cause_userdata'] = $cause_userdata;
		$data['stage_data'] =$stage_data;
		$data['activity_data'] = $activity_data;
		$data['cert_data'] = $cert_data;
		$data['serv_data'] = $serv_data;
		$data['cause_donors'] = $cause_donors;
		$data['thanks_card'] = $thanks_card;
	
		$response = $this->load->view('admin/causes-project',$data,TRUE);
		echo $response; 
	}
	
	//Set status to 2 after click on Finish Cause button on Project tab
	public function finish_cause()
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
	
	
		/***-----------manage certificate page-------------***/
	public function manage_certificate()
	{       
		if(!empty($this->session->userdata('logged_in') ) && $this->session->userdata('logged_in')['role'] == 'admin')
		{
		 $certificate_data = $this->Admin_model->getReco('manage_certificates'); 
		 $data['certificate_data'] = $certificate_data;
			//echo '<pre>'; print_r($certificate_data); echo '</pre>'; 
		 $header['title']='';
		 $this->load->view('admin/admin_header',$header);
		 $this->load->view('admin/manage_certificate',$data);
		 $this->load->view('admin/admin_footer');
		   }
		  else{
				redirect(site_url().'admin/index', 'refresh');
		   }
	}

	
	
	
	/*********------ add -certificate ---------**********/
	public function add_certificate(){  
		if(!empty($this->session->userdata('logged_in') ) && $this->session->userdata('logged_in')['role'] == 'admin')
		{
		   $user_id = $this->uri->segment(3);
		   if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$data = array(
							 
					'certificate_name'=>$this->input->post('certificate_name'),
					'benefits'=>$this->input->post('benefits'),
					'restrictions'=>$this->input->post('restrictions'),
							
						 );	 
	       $AddData = $this->Admin_model->AddData('manage_certificates',$data);
		   $data['message_success'] = TRUE;
		   $this->session->set_flashdata('message_success', 'Added data succesfully');
		   }
		   $header['title']='certificate';
		   $this->load->view('admin/admin_header',$header);
		   $this->load->view('admin/add_certificate');
		   $this->load->view('admin/admin_footer');
		  }
		   else{
		  redirect(site_url().'admin/index', 'refresh');
		  }
	}	
	
	/*********------ add -certificate ---------**********/
	public function edit_certificate(){  
		if(!empty($this->session->userdata('logged_in') ) && $this->session->userdata('logged_in')['role'] == 'admin')
		{
		  $id = $this->uri->segment(3);
		   if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$data = array(
							 
					'certificate_name'=>$this->input->post('certificate_name'),
					'benefits'=>$this->input->post('benefits'),
					'restrictions'=>$this->input->post('restrictions'),
							
						 );	 
	       $AddData = $this->Admin_model->updateData('manage_certificates',$data,$id);
		   
		   $data['message_success'] = TRUE;
		   $this->session->set_flashdata('edit_message_success', 'Update data succesfully');
		   }
		   $id = $this->uri->segment(3);
		   $data['certificate']=$this->Admin_model->getRecoId('manage_certificates',$id);
		  // echo '<pre>'; print_r($data); echo '</pre>';
		   $header['title']='certificate';
		   $this->load->view('admin/admin_header',$header);
		   $this->load->view('admin/edit_certificate',$data);
		   $this->load->view('admin/admin_footer');
		  }
		   else{
		  redirect(site_url().'admin/index', 'refresh');
		  }
	}	
	
	public function del_certificate($id,$tbl,$page){
		$i= $page;
		//exit();
		$Deldata = $this->Admin_model->deletecertificate($tbl,"id",$id);
		if($Deldata) {

			$data['message_success'] = TRUE;
			$this->session->set_flashdata('delete_message_success', 'Data deleted successfully..!!');
			redirect('admin/'.$i);
		}
	}
	
	
	//certificate name
	public function certificate_name()
	{
		//echo '<pre>'; print_r($_POST);  
		$id = $_POST['id']; 
		$certificate_alldata = $this->Admin_model->getRecoId('manage_certificates',$id);
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
