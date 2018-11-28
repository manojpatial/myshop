<?php
class Corporate_model extends CI_Model {	
 
	function getReco($tbl){	
		$this->db->select('*');
		$this->db->from($tbl);
		$query=$this->db->get();
		//echo $this->db->last_query(); die;
		$AllData = $query->result_array();
			return 	$AllData;
		
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
		$this->db->where('role', '1');
		$query = $this->db->get();
		//echo $this->db->last_query(); //die;
		if($query->num_rows() == 1) {
			$Admin = $query->row();
			print_r($Admin);
            return 	$Admin;
			}
	}
		//////////get causeuser data	
	   function  getcauseuser_data($tbl){	
			$this->db->select('*');
			$this->db->where('status',3); 
			$this->db->from($tbl);
			$query=$this->db->get();
			//echo $this->db->last_query(); die;
			$AllData = $query->result_array();
				return 	$AllData;
		}
		///////////get data by in query for causes data
	     function  get_selected_causes_data($selcause){	
		    $gry="SELECT * FROM fed_causes WHERE id IN($selcause)";
			$query	=$this->db->query($gry);
			//echo $this->db->last_query(); die;
			$AllData = $query->result_array();
			return 	$AllData;
		 }
		 
		 
		//Get project data by Id
	 function getmyprojectData($userid){
		$status = array('1','2');
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->where('user_id',$userid); 
		// $this->db->where('status',1); 
		$this->db->where_in('status',$status); 
		$query = $this->db->get(); 
		//echo $this->db->last_query(); die;
		if($query->num_rows() > 0) {
			$AllData = $query->result_array();
			return 	$AllData;
		}
	    }
		
		
		//Get getvizulizationData by Id
	 function getvizulizationData($project_id){
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->where('id',$project_id); 
		$query = $this->db->get(); 
		//echo $this->db->last_query(); die;
		if($query->num_rows() > 0) {
			$AllData = $query->result_array();
			return 	$AllData;
		}
	      }
	
	 //Get project user data by Id
	 function getprojectuserData($project_id){
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->where('id',$project_id); 
		$query = $this->db->get(); 
		//echo $this->db->last_query(); die;
		if($query->num_rows() > 0) {
			$AllData = $query->result_array();
			return 	$AllData;
		   }
	       }
	 ///////////get data by in query for causes data
	     function  get_selected_causes_image($selected_causes){	
		    $gry="SELECT * FROM fed_causes WHERE id IN($selected_causes)";
			$query	=$this->db->query($gry);
			//echo $this->db->last_query(); die;
			$AllData = $query->result_array();
			return 	$AllData;
		 }
		 
	////////////////////like query	cause_name
	    function  get_filter_data($data){
			$ngo_name = $data['ngo_name'];
			$cause_name = $data['cause_name'];
			$certificate_type = $data['certificate_type'];
			$services_type = $data['services_type'];
			$where = "WHERE cause.status = 3";
			$join = '';
			if($cause_name != ''){
				$where .= " AND cause.name LIKE '%".$cause_name."%'";
			}
			if($ngo_name != ''){
				$join .= " LEFT JOIN fed_usermeta AS usermeta ON cause.user_id = usermeta.user_id";
				$where .= " AND (usermeta.meta_value LIKE '%".$ngo_name."%' AND usermeta.meta_key LIKE 'cause_institution')";
			}
			if($certificate_type != ''){
				$join .= " LEFT JOIN fed_causes_certificates AS certi on certi.cause_id = cause.id";
				$where .= " AND (certi.cert_name LIKE '".$certificate_type."' OR certi.cert_other LIKE '".$certificate_type."')";
			}
			if($services_type != ''){
				$join .= " LEFT JOIN fed_causes_services AS servi ON servi.cause_id = cause.id";
				$where .= " AND (servi.service_name LIKE '%".$services_type."%')";
			}
		    $gry = "SELECT cause.* FROM fed_causes AS cause".$join." ".$where;
			$query	=$this->db->query($gry);
			//echo $this->db->last_query(); exit();
			$AllData = $query->result_array();
			return 	$AllData;
		 }
		 
		  
	//Get Cause data by Id
	function getCauseData($row_id){
		$this->db->select('*');
		$this->db->from('causes');
		$this->db->where('id',$row_id); 
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
	function getActivityData($row_id){
		$this->db->select('*');
		$this->db->from('cause_stage_activity');
		$this->db->where('cause_id',$row_id); 
		$query = $this->db->get(); 
		//echo $this->db->last_query(); die;
		if($query->num_rows() > 0) {
			$AllData = $query->result_array();
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
	  
	  
}

?>