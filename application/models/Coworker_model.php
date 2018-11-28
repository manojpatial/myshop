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
	
	

	
	
	
	
	
 }

?>