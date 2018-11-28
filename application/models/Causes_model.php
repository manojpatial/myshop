<?php
class Causes_model extends CI_Model {	
 
	function getReco($tbl){	
		$this->db->select('*');
		$this->db->from($tbl);
		//$this->db->order_by("sports", "asc");
		$query=$this->db->get();
		//echo $this->db->last_query(); die;
		$AllData = $query->result_array();
		return 	$AllData;
		
	}
	/////get record by id
	function getRecoId($tbl,$id){
	$this->db->select('*');
	$this->db->from($tbl);
	$this->db->where('id', $id);
	$query=$this->db->get();
	//echo $this->db->last_query(); die;
	$AllData = $query->result_array();
		return 	$AllData;
	
	}
	//Get single row data
	function getRowData($row_id, $col_name, $tbl){
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->where($col_name,$row_id); 
		$query = $this->db->get(); 
		//echo $this->db->last_query(); die;
		if($query->num_rows() == 1) {
			$row = $query->row();
			return 	$row;

		}
		
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
	//Get Cause data by Id
	function getMyCauseData($userid){
		$this->db->select('*');
		$this->db->from('causes');
		$this->db->where('user_id',$userid); 
		$this->db->where('status !=',0); 
		$query = $this->db->get(); 
		//echo $this->db->last_query(); die;
		if($query->num_rows() > 0) {
			$AllData = $query->result_array();
			return 	$AllData;
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
	
	//Get Activity data for Cause by cause id
	function getCertificatesData($row_id){
		$this->db->select('*');
		$this->db->from('causes_certificates');
		$this->db->where('cause_id',$row_id); 
		$query = $this->db->get(); 
		//echo $this->db->last_query(); die;
		if($query->num_rows() > 0) {
			$AllData = $query->result_array();
			return 	$AllData;

		}
		
	}
	//Get Activity data for Cause by cause id
	function getServicesData($row_id){
		$this->db->select('*');
		$this->db->from('causes_services');
		$this->db->where('cause_id',$row_id); 
		$query = $this->db->get(); 
		//echo $this->db->last_query(); die;
		if($query->num_rows() > 0) {
			$AllData = $query->result_array();
			return 	$AllData;

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
		$this->db->where('role', '2');
		//$this->db->where('REG.ency_password', md5($passWord));
		$query = $this->db->get();
		//echo $this->db->last_query(); //die;
		if($query->num_rows() == 1) {
			$Admin = $query->row();
			print_r($Admin);

			return 	$Admin;

		}	


	}
	
	
 }

?>