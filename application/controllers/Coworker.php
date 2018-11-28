<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coworker extends CI_Controller {
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
		$this->load->model('Coworker_model');
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
		$this->load->view('Coworker/coworker_login');
		}
		else{
			redirect('Coworker/crcprojects');
		}
	}	
	
	/***--- Login  function for coworker user ***/
	public function  coworker_login(){	
	
		if ($this->input->server('REQUEST_METHOD') === 'POST') {			
			$email = $this->input->post('email');
			$passWord = MD5($this->input->post('password'));						
			$row = $this->Coworker_model->UserLogin($email, $passWord);
			if($row) {
				$userid = $row->user_id;
				$image = $this->Coworker_model->getUserData($userid, 'corporate_logo'); 
				$data = array(
				'id' => $row->user_id,
				'name' => $row->name,
				'email' => $row->email,
				'role' => 3,
				'image' => $image->meta_value
				);
				$this->session->set_userdata('logged_in', $data);
					
				$data['message_success'] = TRUE;
				$this->session->set_flashdata('message_success', 'You Have Successfully login'); 			
				redirect('Coworker/crcprojects');
				
			}
			else {
				$data['message_error'] = TRUE;
				$this->session->set_flashdata('message_error', 'Invalid username or password');
				redirect('Coworker/coworker_login');
			}
		}
	
	    $this->load->view('Coworker/coworker_login');
	}
	
	/***--- Logout function for Cause user ***/
	public function logout()
		{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect(site_url(), 'refresh');
	}
	
	
	public function crcprojects()
	{
		if(!empty($this->session->userdata('logged_in')))
		{
			$loginData = $this->session->userdata('logged_in');
			
			$loginUserId = $loginData['id'];
			$loginUsername = $loginData['name'];
			$loginlogoimage = $loginData['image'];
			$corporate_owner = $this->Coworker_model->getUserData($loginUserId, 'corporate_owner');
			$corporateOwnerId = $corporate_owner->meta_value;
			$corporaterProjects = $this->Coworker_model->getProjectsData($corporateOwnerId);
			//echo '<pre>'; print_r($corporaterProjects); echo '</pre>'; 
			$data = array();
			$header = array();
			$header['title']=$this->lang->line('welcome'). '  ' . $loginUsername ;
			$data['projects']=$corporaterProjects;
			$this->load->view('Coworker/coworker_header',$header);
			$this->load->view('Coworker/crc-projects', $data);
			$this->load->view('Coworker/coworker_footer');
				
		}
		else{
				redirect(site_url().'Coworker/coworker_login', 'refresh');
		}
		
	}
	//voting page
	public function voting()
	{
		
		if(!empty($this->session->userdata('logged_in')))
		{
			$projectId = $this->uri->segment(3);
			$loginData = $this->session->userdata('logged_in');
			$loginUsername = $loginData['name'];
			$loginlogoimage = $loginData['image'];
			$projectData = $this->Coworker_model->getRow('projects', 'id', $projectId);
			$causeIds = $projectData->selected_causes;
			$causesData = $this->Coworker_model->getProjectsCauseData($causeIds);
			//echo '<pre>'; print_r($corporaterProjects); echo '</pre>'; 
			
			$data = array();
			$header = array();
			$header['title']='voting';
			$data['causesData']=$causesData;
			$data['projectData']=$projectData;
			$this->load->view('Coworker/coworker_header',$header);
			$this->load->view('Coworker/voting', $data);
			$this->load->view('Coworker/coworker_footer');
		} 
		else{
			redirect(site_url().'Coworker/coworker_login', 'refresh');
		}
		
	}
	
	//Submit vote 
	public function submit_vote()
	{
		if(!empty($this->session->userdata('logged_in')))
		{
			$postData = $this->input->post();
			//echo '<pre>'; print_r($postData); die;
			$votingType = $postData['votingType'];
			$project_id = $postData['project_id'];
			$user_id = $postData['user_id'];
			$vote = $postData['vote'];
			$data = array();
			if($votingType == 1){
				$data = array(
					'cause_id' => $vote,
					'project_id' => $project_id,
					'user_id' => $user_id,
					'vote' => 1,
				);
				//$insert = $this->Coworker_model->AddData('voting',$data);
			}
			else if($votingType == 2){
				if(is_array($vote) && !empty($vote))
				{
					foreach($vote as $k=>$v){
						$data = array(	
							'cause_id' => $v,
							'project_id' => $project_id,
							'user_id' => $user_id,
							'vote' => $k,
						);
						//$insert = $this->Coworker_model->AddData('voting',$data);
					}
				}
			}
		} 
		else{
			redirect(site_url().'Coworker/coworker_login', 'refresh');
		}
		
	}
	//view voting result page
	
	public function view_result()
	{
		if(!empty($this->session->userdata('logged_in')))
		{
			$projectId = $this->uri->segment(3);
			$loginData = $this->session->userdata('logged_in');
			$loginUsername = $loginData['name'];
			$loginlogoimage = $loginData['image'];
			$projectData = $this->Coworker_model->getRow('projects', 'id', $projectId);
			$donation_type = $projectData->donation_type;
			$resultData = $this->Coworker_model->getProjectsResultData($projectId, $donation_type);
			//echo '<pre>'; print_r($corporaterProjects); echo '</pre>'; 
			
			$data = array();
			$header = array();
			$header['title']='Voting Result';
			$data['resultData']=$resultData;
			$data['donation_type']=$donation_type;

			$this->load->view('Coworker/coworker_header',$header);
			$this->load->view('Coworker/voting_result', $data);
			$this->load->view('Coworker/coworker_footer');
		} 
		else{
			redirect(site_url().'Coworker/coworker_login', 'refresh');
		}
		
	}
	
	 
	
	
	
}
