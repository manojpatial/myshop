<?php
class Coworker_model extends CI_Model {	
 
	function getReco($tbl){	
		$this->db->select('*');
		$this->db->from($tbl);
		//$this->db->order_by("sports", "asc");
		$query=$this->db->get();
		//echo $this->db->last_query(); die;
		$AllData = $query->result_array();
			return 	$AllData;
		
	}
	function getRow($tbl, $column, $value){	
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->where($column,$value); 
		$query = $this->db->get();
		$AllData = $query->row();
		//echo $this->db->last_query(); die;
		
		if(!empty($AllData))
		{
			return 	$AllData;
		}
		else{
			return 0;
		}
		
	}
	//// insert data
	function AddData($tbl, $Data) {
		$insert = $this->db->insert($tbl, $Data);
		//echo $this->db->last_query(); exit;
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	//// insert data
	function AddUserData($user_id, $meta_key, $meta_value) {
		$data = array(			
			'user_id' => $user_id,
			'meta_key' => $meta_key,
			'meta_value' => $meta_value
		);
		$insert = $this->db->insert('usermeta', $data);
		//echo $this->db->last_query(); exit;
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	function getUserData($user_id, $meta_key) {
		
		$this->db->select('meta_value')->from('usermeta');
		$this->db->where('meta_key',$meta_key); 
		$this->db->where('user_id',$user_id); 
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if($query->num_rows() == 1) {
			$row = $query->row();
			return 	$row;

		}
	}
	/// mail check
	 function check_email($email) {
		$this->db->select('*')->from('users');
		$this->db->where('email',$email); 
		$query=$this->db->get();
		//echo $this->db->last_query(); die;
		return $query->num_rows();

	}
	//home_login
	function UserLogin($email, $password) {
        $this->db->select('USER.user_id,  USER.email, USER.password,USER.name');
		$this->db->from('users as USER');
		$this->db->where('USER.email', $email);
		$this->db->where('USER.password', ($password));
		$this->db->where('role', '3');
		//$this->db->where('REG.ency_password', md5($passWord));
		$query = $this->db->get();
		//echo $this->db->last_query(); //die;
		if($query->num_rows() == 1) {
			$Admin = $query->row();
			print_r($Admin);

			return 	$Admin;

		}
	}
	//Get project data
	function getProjectsData($ownerId){	
		$loginData = $this->session->userdata('logged_in');
		$loginUserId = $loginData['id'];
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->where('user_id',$ownerId); 
		$this->db->where('status',2); 
		$this->db->order_by('id', 'DESC');
		$query=$this->db->get();
		//echo $this->db->last_query(); die;
		$AllData = $query->result_array();
		if(!empty($AllData))
		{
			//$AllData = $query->result_array();
			$data = array();
			$i = 0;
			foreach($AllData as $row){
				$id = $row['id'];
				$qry="SELECT * FROM `fed_voting` WHERE `project_id`= $id AND user_id = $loginUserId";
				$querys	=$this->db->query($qry);
				$AllData[$i]['vote_data'] = $querys->result_array();
				$i++;
			}
			return 	$AllData;
		}
		else{
			return 0;
		}
		
	}
	// Get Cause data
	function getProjectsCauseData($causesIds){
		$expolde = explode(',', $causesIds);
		$this->db->select('*');
		$this->db->from('causes');
		$this->db->where_in('id',$expolde); 
		$query=$this->db->get();
		//echo $this->db->last_query(); die;
		$AllData = $query->result_array();
		//echo '<pre>'; print_r($AllData); echo '</pre>'; 
		if(!empty($AllData))
		{
			return 	$AllData;
		}
		else{
			return 0;
		}
		
	}
	
	// Get Cause data
	function getProjectsResultData($projectId, $donation_type){
		if($donation_type == 1)
		{
			$qry1="SELECT count(*) AS total_votes, vote.cause_id AS winner_cause_id, cause.* FROM `fed_voting` AS vote LEFT JOIN fed_causes AS cause on cause.id = vote.cause_id WHERE vote.`project_id` = $projectId GROUP BY vote.cause_id ORDER BY total_votes DESC LIMIT 0,1";
			$querys1	=$this->db->query($qry1);
			$data1 = $querys1->row();
			$result = array();
			$result['1'] = $data1;
		}
		else if($donation_type == 2)
		{
			$qry1="SELECT count(*) AS total_votes, vote.cause_id AS winner_cause_id, cause.* FROM `fed_voting` AS vote LEFT JOIN fed_causes AS cause on cause.id = vote.cause_id WHERE `project_id` = $projectId AND vote.`vote` = 1 GROUP BY vote.cause_id ORDER BY total_votes DESC LIMIT 0,1";
			$querys1	=$this->db->query($qry1);
			$data1 = $querys1->row();
			
			$qry2="SELECT count(*) AS total_votes, vote.cause_id AS winner_cause_id, cause.* FROM `fed_voting` AS vote LEFT JOIN fed_causes AS cause on cause.id = vote.cause_id WHERE `project_id` = $projectId AND vote.`vote` = 2 GROUP BY vote.cause_id ORDER BY total_votes DESC LIMIT 0,1";
			$querys2	=$this->db->query($qry2);
			$data2 = $querys2->row();
			
			$qry3="SELECT count(*) AS total_votes, vote.cause_id AS winner_cause_id, cause.* FROM `fed_voting` AS vote LEFT JOIN fed_causes AS cause on cause.id = vote.cause_id WHERE `project_id` = $projectId AND vote.`vote` = 3 GROUP BY vote.cause_id ORDER BY total_votes DESC LIMIT 0,1";
			$querys3	=$this->db->query($qry3);
			$data3 = $querys3->row();
			
			$result = array();
			
			$result['1'] = $data1;
			$result['2'] = $data2;
			$result['3'] = $data3;
		}
		//
		return $result;
		
	}
	
	//Get Cause data by Id
	function getCauseData($cause_id){
		$this->db->select('*');
		$this->db->from('causes');
		$this->db->where('id',$cause_id); 
		$query = $this->db->get(); 
		//echo $this->db->last_query(); die;
		if($query->num_rows() == 1) {
			$row = $query->row();
			return 	$row;

		}
		
	}

	//Get Cause user data by caue Id
	function getCauseUserData($cause_id){
		$this->db->select('usermeta.meta_key, usermeta.meta_value');
		$this->db->from('usermeta');
		$this->db->join('causes', 'usermeta.user_id = causes.user_id');
		$this->db->where('causes.id',$cause_id); 
		$query = $this->db->get(); 
		//echo $this->db->last_query(); die;
		if($query->num_rows() > 0) {
			$row = $query->result_array();
			$data = array();
			//Set meta_key's value as key of new result array and meta_value's as Value of new result array.
			foreach($row as $value)
			{
				foreach($value as $v)
				{
					$data[] = $v;
				}
			}
			$result = array();
			while (count($data)) {
				list($key,$value) = array_splice($data, 0, 2);
				$result[$key] = $value;
			}
			return 	$result;

		}
	}
	
	//Get Stage data for Cause by cause id
	function getStageData($row_id){
		$this->db->select('*');
		$this->db->from('cause_stage');
		$this->db->where('cause_id',$row_id); 
		$query = $this->db->get(); 
		//echo $this->db->last_query(); die;
		if($query->num_rows() > 0) {
			$AllData = $query->result_array();
			return 	$AllData;

		}
		
	}
	//Get Activity data for Cause by cause id
	function getActivityData($cause_id){
		$gry="SELECT * FROM `fed_cause_stage_activity` WHERE `cause_id` = $cause_id";
		$query	=$this->db->query($gry);
		//echo $this->db->last_query(); die;
		if($query->num_rows() > 0) {
			$AllData = $query->result_array();
			$data = array();
			$i = 0;
			foreach($AllData as $row){
				$actId = $row['act_id'];
				$qry="SELECT * FROM `fed_activity_log` WHERE `act_id`= $actId";
				$querys	=$this->db->query($qry);
				$AllData[$i]['log_data'] = $querys->result_array();
				$i++;
			}
			return 	$AllData;

		}
		
	}
	
	//Get all certification data for Cause by cause id
	function getAllCertificateData($cause_id){
		$this->db->select('*');
		$this->db->from('causes_certificates');
		$this->db->where('cause_id',$cause_id); 
		$query = $this->db->get(); 
		//echo $this->db->last_query(); die;
		if($query->num_rows() > 0) {
			$AllData = $query->result_array();
			return 	$AllData;

		}
		
	}
	//Get all services data for Cause by cause id
	function getAllServiceData($cause_id){
		$this->db->select('*');
		$this->db->from('causes_services');
		$this->db->where('cause_id',$cause_id); 
		$query = $this->db->get(); 
		//echo $this->db->last_query(); die;
		if($query->num_rows() > 0) {
			$AllData = $query->result_array();
			return 	$AllData;

		}
		
	}
	
	//Get all donors data for Cause by cause id
	function getAllCauseDonors($cause_id){
		$gry="SELECT user.name, user.user_id FROM `fed_users` AS user LEFT JOIN fed_cause_donors donor ON donor.user_id = user.user_id WHERE donor.cause_id = $cause_id";
		$query	=$this->db->query($gry);
		//echo $this->db->last_query(); die;
		if($query->num_rows() > 0) {
			$AllData = $query->result_array();
			return 	$AllData;

		}
		
	}
	
	//Get all donors data for Cause by cause id
	function getAllThanksCard($cause_id){
		$gry="SELECT user.name, user.user_id, thanks.* FROM `fed_users` AS user LEFT JOIN fed_thanks_card thanks ON thanks.donor_user_id = user.user_id WHERE thanks.cause_id = $cause_id";
		$query	=$this->db->query($gry);
		//echo $this->db->last_query(); die;
		if($query->num_rows() > 0) {
			$AllData = $query->result_array();
			return 	$AllData;

		}
		
	}
	
 }

?>