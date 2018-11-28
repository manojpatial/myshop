<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Corporate extends CI_Controller {
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
		$this->load->model('Corporate_model');
		$this->load->library('calendar');
		$this->load->helper(array('url','form','file','cookie','captcha'));
		$autoload['helpers'] = array('form');
		$this->load->library('encrypt');
		//$this->load->library('pagination');
		
	}
	public function index()
	{
	if(empty($this->session->userdata('logged_in')))
		{
			$this->load->view('Corporate/corporate_login');
		}
		else{
			redirect('Corporate/myprojects');
		}
		
	}
	
	
	 /*---register page ---*/
	public function corporate_register(){
	
		
		if ($this->input->server('REQUEST_METHOD') === 'POST') { 
			//echo '<pre>'; print_r($this->input->post()); 
			$this->load->library('email');
			$company = $this->input->post('company');
			$name = $this->input->post('name');
			$email = $this->input->post('email'); 
			$password = $this->input->post('password');
			$status = $this->input->post('status');
			$corporatelogo = $this->input->post('logoName');
			$role = $this->input->post('role');
			$filename = $this->input->post('corporate_file');
			$created = date( 'Y-m-d H:i:s' );
			if($this->Corporate_model->check_email($email) == 0)
			{
				//die('1');
				$data = array(	
				'name' => $name,
				'email' => $email,
				'password' => MD5($password),
				'status' => 1,
				'role' => 1,
				'created' => date( 'Y-m-d H:i:s' ), 
				);
							
					
				$user_id = $this->Corporate_model->AddData('users',$data);
				$this->Corporate_model->AddUserData($user_id, 'corporate_logo', $corporatelogo);
				$this->Corporate_model->AddUserData($user_id, 'corporate_name', $company);
				// send welcome email to corporate
				
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
				$template = FCPATH."application/views/Corporate/email-templates/new_user.txt";
				$tpl = file_get_contents($template);
			
				$tpl = str_replace('{Name}',$name,$tpl);
				$tpl = str_replace('{User_name}',$email,$tpl);
				$url = base_url().'/Corporate/';
				$tpl = str_replace('{URL}',$url,$tpl);
				$tpl = str_replace('{Password}',$password,$tpl);
				
				$this->email->message($tpl); 			
				$this->email->send();
				 
				$filename=$_FILES["corporate_file"]["tmp_name"];		
				if($_FILES["corporate_file"]["size"] > 0)
					{
					$file = fopen($filename, "r");
					while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
					{
						$fname = $getData[0];
						$lname = $getData[1];
						$cow_email = $getData[2];
						$cow_password = rand();
						$data2 = array(	
							'name' => $fname.' '.$lname,
							'email' => $cow_email,
							'password' => MD5($cow_password),
							'status' => 1,
							'role' => 3,
							'created' => date( 'Y-m-d H:i:s' ), 
						);
					  
						$cow_user_id = $this->Corporate_model->AddData('users',$data2);
						$this->Corporate_model->AddUserData($cow_user_id, 'corporate_owner', $user_id);
						// send welcome email to coworkers
				
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
						$this->email->to($cow_email);
						$this->email->subject('Welcome Email');
						$template = FCPATH."application/views/Corporate/email-templates/new_user.txt";
						$tpl = file_get_contents($template);
					
						$tpl = str_replace('{Name}',$fname.' '.$lname,$tpl);
						$tpl = str_replace('{User_name}',$cow_email,$tpl);
						$url = base_url().'/Coworker/'; //login url for co-worker login page
						$tpl = str_replace('{URL}',$url,$tpl);
						$tpl = str_replace('{Password}',$cow_password,$tpl);
						
						$this->email->message($tpl); 			
						$this->email->send();
				   }
				   
				  fclose($file);	
				}
			
				
				//echo'<pre>'; print_r($data); print_r($user_id); print_r($corporatelogo); print_r($company); print_r($filename); exit();
				 
				
				//Send email to new user with login detail
				

				
				//echo '<pre>'; print_r($tpl); die;
				///echo'<pre>'; print_r($to); print_r($message); print_r($subject); 
								
				$data['message_success'] = TRUE;
				$this->session->set_flashdata('message_success', 'You have successfully registered. Please check your email for login details.'); 			
				redirect('Corporate/corporate_login');
			 
			}
			else
			{
				
				$data['message_error'] = TRUE;
				$this->session->set_flashdata('message_error', 'Email already Exist. Please try with another email.'); 
				redirect('Corporate/corporate_login');
			}
		}
		 
		 
		$data['users']=$this->Corporate_model->getReco('users');
		//$header['title']='Create New Company Account';
		$header['title']= $this->lang->line('register_header_title');
		$this->load->view('Corporate/corporate_header',$header);
		$this->load->view('Corporate/corporate_register');
		$this->load->view('Corporate/corporate_footer');
	
	}
	
	/***--- Login  function for Corporater user ***/
	public function corporate_login(){	
	
		if ($this->input->server('REQUEST_METHOD') === 'POST') {			
			$email = $this->input->post('email');
			$passWord = MD5($this->input->post('password'));						
			$row = $this->Corporate_model->UserLogin($email, $passWord);
			if($row) {
				$userid = $row->user_id;
				$image = $this->Corporate_model->getUserData($userid, 'corporate_logo'); 
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
				redirect('Corporate/myprojects');
				
			}
			else {
				$data['message_error'] = TRUE;
				$this->session->set_flashdata('message_error', 'Invalid username or password');
				redirect('Corporate/corporate_login');
			}
		}
	
	    $this->load->view('Corporate/corporate_login');
	}
	
	/***--- Logout function for Corporater user ***/
	public function logout()
		{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect(site_url(), 'refresh');
	}
	
	/***--- Upload user logo image from registration page ***/
	
	public function upload_corporate_logo(){
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
	
	//////// myprojectes
	
	public function myprojects()
	
	{
		if(!empty($this->session->userdata('logged_in')))
		{
			
			$this->session->unset_userdata('select_causesid');
			$loginData = $this->session->userdata('logged_in');
			$userid = $loginData['id'];
			$loginUsername = $loginData['name'];
			$loginlogoimage = $loginData['image'];
			$data['project_data'] = $this->Corporate_model->getmyprojectData($userid);
            ///echo '<pre>'; print_r($data); exit();			
			$header['title']=$this->lang->line('welcome'). '  ' . $loginUsername ;
			$this->load->view('Corporate/corporate_header',$header);
			$this->load->view('Corporate/my-projects',$data);
			$this->load->view('Corporate/corporate_footer');
		}
		else{
				redirect(site_url().'Corporate/corporate_login', 'refresh');
		}
		
		 
	}
	//////// myprojects
	public function projects() 
	{   
        $data['causes_data']=$this->Corporate_model->getcauseuser_data('causes');
		if(!empty($this->session->userdata('logged_in')))
		{
			$loginData = $this->session->userdata('logged_in');
			$user_id = $loginData['id'];
			$selectid = $this->session->userdata('select_causesid');
			//echo '<pre>'; print_r($selectid); echo '</pre>';
			$header['title']=$this->lang->line('project_page_header_title');
			//$selectcasue =$this->session->userdata('select_causesid');
			$this->load->view('Corporate/corporate_header',$header);
			$this->load->view('Corporate/projects',$data);
			$this->load->view('Corporate/corporate_footer');
		
		}
		else{
		redirect(site_url().'Corporate/corporate_login', 'refresh');
		} 
	}
	///////Select causeid
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
	
	
	///////Select removeid
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

	 
	
	//////// corp-project-creation
	public function project_creation()
	{
		if(!empty($this->session->userdata('logged_in')))
		{
			$popupdata=$this->Corporate_model->getcauseuser_data('causes');     
	        $data['popup_data'] =$popupdata;
			$selectid = $this->session->userdata('select_causesid');
			//echo count ($this->session->userdata('select_causesid')); die('hhh');
			if(count($this->session->userdata('select_causesid')) < 3)
			{
				$data['message_error'] = TRUE;
				$this->session->set_flashdata('message_error',$this->lang->line('selected_causes_error_msg'));
				redirect('Corporate/projects');
			}
			else
			{
			
			//echo '<pre>'; print_r($selectid ); 	echo '</pre>';
			$selcause = implode(",",$selectid); 
			//echo '<pre>'; print_r($selcause); exit();
			$result = $this->Corporate_model->get_selected_causes_data($selcause); 
			$data['causes_data'] = $result;
			//echo'<pre>'; print_r($data);
			$loginData = $this->session->userdata('logged_in');
			$user_id = $loginData['id'];
			$header['title']=$this->lang->line('Project_page_header_title');
			$this->load->view('Corporate/corporate_header',$header);
			$this->load->view('Corporate/corp-project-creation',$data);
			$this->load->view('Corporate/corporate_footer');
			}
		}
		else{
		redirect(site_url().'Corporate/corporate_login', 'refresh');
		} 
	}
	
	
	//////////// Project submit info
	public function project_submit(){
	
		//echo '<pre>'; print_r($_POST); die;
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
		
		//$donation_type = $_POST['donation_type'];
		$data = array(	
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
				//'donation_type' => $donation_type,
				'status' => 0, 
				);	

        	
		$project_id = $this->Corporate_model->AddData('projects',$data);
		//$this->session->set_userdata('project_id', $project_id);
		echo $project_id; 
		
	}
	
	/////////////// update Project info 
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
		        //'id' => $project_id,
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
				'status' => 1, 
				);	

         //echo	 '<pre>'; print_r($data); 	 echo exit();	 '</pre>';	
		
		$this->db->where('id', $project_id);  				
		$project_id = $this->db->update('projects',$data);
		echo $project_id;
		
	 }
	
	 /////edit project
	public function edit_project_creation()
	{       
	
		if(!empty($this->session->userdata('logged_in')))
		{
			
			$project_id = $this->uri->segment(3);
			$project_data= $this->Corporate_model->getprojectuserData($project_id); 
			//echo '<pre>'; print_r($project_data); exit();		
			$data['project_data'] =$project_data;
		    $selected_causes= $project_data['0']['selected_causes'] ;
			$seletedimageid = explode(',',$selected_causes );
			//echo '<pre>'; print_r($seletedimageid); echo '</pre>';
		    $selcause = $this->session->set_userdata('select_causesid',$seletedimageid);
			
		    $project_image = $this->Corporate_model->get_selected_causes_image(    
		    $selected_causes);
		    $data['project_images']=$project_image;
			
			
		   $popupdata=$this->Corporate_model->getcauseuser_data('causes');     
	       $data['popup_data'] =$popupdata;
			
		   $header['title']=$this->lang->line('edit_project_header_title');
		   $this->load->view('Corporate/corporate_header',$header);
		   $this->load->view('Corporate/edit-project-creation',$data);
		   $this->load->view('Corporate/corporate_footer');
		}
		else{
				redirect(site_url().'Corporate/corporate_login', 'refresh');
		}
	}
	
	//////////popup data
		public function popup_data(){
			
			$selectid = $this->session->userdata('select_causesid');
			//echo '<pre>'; print_r($selectid); exit();
			$selcause = implode(",",$selectid); 
			//echo '<pre>'; print_r($selcause); 
			$result = $this->Corporate_model->get_selected_causes_data($selcause); 
			//$data['causes_data'] = $result; 
			echo json_encode($result);
			//echo '<pre>'; print_r($result); exit();	
		}
		
		//////////donation voting type
		public function voting_type(){
	      $project_id = $_POST['project_id'];
		  //print_r($project_id);
		  $donation_type =$_POST['donation_type'];
		  $data = array(	
					'status' => 0 ,
					'donation_type'=>$donation_type,
				);
							
		  $this->db->where('id',$project_id);  				
		  $project_update = $this->db->update('projects',$data);
		  $visualization_data =$this->Corporate_model->getvizulizationData($project_id);
		  $data['visualization_data']=$visualization_data;
		  //echo '<pre>'; print_r($visualization_data);echo '</pre>';
		  $selected_causes= $visualization_data['0']['selected_causes'] ;
		  //echo '<pre>'; print_r($selected_causes);echo '</pre>';
		  $project_image = $this->Corporate_model->get_selected_causes_image(    
		  $selected_causes);
		  $data['project_images']=$project_image;
		  $this->load->view('Corporate/corporate_visualization',$data);
		
		}
		
	//////////visulization_save jquery ajax
	public function visulization_save(){
		$project_id = $_POST['project_id'];
		$data = array(
				'status' =>1,
			);			
		$this->db->where('id',$project_id);  				
		$project_update = $this->db->update('projects',$data);
		//echo $this->db->last_query(); die;
	}
	//////////visulization_publish jquery ajax
	public function visulization_publish(){
		$project_id = $_POST['project_id'];
		$data = array(
			'status' =>2,
			);			
		$this->db->where('id',$project_id);  				
		$project_update = $this->db->update('projects',$data);
		//echo $this->db->last_query(); die;
	}
		 
	//////////
	public function delete_project()
    {   
        $id    =    $this->input->post('id');    
        $where = "id= ".$id;           
        $this->db->where($where);  
        $this->db->delete('projects');   
       // echo "success"; 
        
    }

	public function filter_form_send()
	{
	    //echo '<pre>'; print_r($_POST); echo '</pre>';
		$filter_data=$this->Corporate_model->get_filter_data($_POST);
		//$data['filter_data']=$filter_data;
		echo json_encode($filter_data); exit(); 
	}	
	
	 /////View project
	public function view()
	{       
		if(!empty($this->session->userdata('logged_in')))
		{
			$cause_id = $this->uri->segment(3);
			$header = array();
			$data = array();
			$cause_data = $this->Corporate_model->getCauseData($cause_id); 
			$cause_userdata = $this->Corporate_model->getCauseUserData($cause_id);
			$stage_data = $this->Corporate_model->getStageData($cause_id); 
			$activity_data = $this->Corporate_model->getActivityData($cause_id); 
			$cert_data = $this->Corporate_model->getAllCertificateData($cause_id); 
			$serv_data = $this->Corporate_model->getAllServiceData($cause_id);
			$data['cause_data'] = $cause_data;
			$data['cause_userdata'] = $cause_userdata;
			$data['stage_data'] =$stage_data;
			$data['activity_data'] = $activity_data;
			$data['cert_data'] = $cert_data;
			$data['serv_data'] = $serv_data;
			$header['title']='View Project';
		    $this->load->view('Corporate/corporate_header',$header);
		    $this->load->view('Corporate/view-project',$data);
		    $this->load->view('Corporate/corporate_footer');
		}
	}
	 
	//display dynamic project preview on click of Project tab on Cause ct=reation amd edit page
	public function get_view_ajax()
	{ 
		$data['causes_data']=$this->Corporate_model->getcauseuser_data('causes');
		$header = array();
		$header['title']='View Project';
		$this->load->view('Corporate/corporate_header',$header);
		$this->load->view('Corporate/projects',$data);
		$this->load->view('Corporate/corporate_footer');
	}
	
	
}
