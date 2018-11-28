
<?php
class Admin_model extends CI_Model {	

	 //admin_login
	 function adminLogin($email, $password) {
        $this->db->select('admin.id,  admin.email, admin.password,admin.name,admin.role');
		$this->db->from('admin_users as admin');
		$this->db->where('admin.email', $email);
		$this->db->where('admin.password',($password));
		
		$query = $this->db->get();
		//echo $this->db->last_query(); //die;
		if($query->num_rows() == 1) {
			$Admin = $query->row();
			print_r($Admin);

			return 	$Admin;
		}
	}
	
	////get project  data
	function getprojectdata($tbl){	
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->where('status',2); 
		$query=$this->db->get();
		//echo $this->db->last_query(); die;
		$AllData = $query->result_array();
			return 	$AllData;
	}
	//////////get causeuser data	
	   function  getcauseuser_data(){	
	        $gry="SELECT * FROM `fed_causes` WHERE `status` = 2 OR `status` = 3 OR `status` = 1" ;
			$query	=$this->db->query($gry);
			//echo $this->db->last_query(); die;
			$AllData = $query->result_array();
			//$this->db->select('*');
			//$this->db->where('status',1); 
			//$this->db->from($tbl);
			//$query=$this->db->get();
			//echo $this->db->last_query(); die;
			//$AllData = $query->result_array();
				return 	$AllData;
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
		///////////get data by in query for causes data
	     function  get_selected_causes_data($selcause){	
		    $gry="SELECT * FROM fed_causes WHERE id IN($selcause)";
			$query	=$this->db->query($gry);
			//echo $this->db->last_query(); die;
			$AllData = $query->result_array();
			return 	$AllData;
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
    ///////////get data by in query for causes data image
	    function  get_selected_causes_image($selected_causes){	
		    $gry="SELECT * FROM fed_causes WHERE id IN($selected_causes)";
			$query	=$this->db->query($gry);
			//echo $this->db->last_query(); die;
			$AllData = $query->result_array();
			return 	$AllData;
		 }
		 
   //////////get corporate company user data	
	  function  getcorporatecompany_data(){	
			 $gry="SELECT usr.`user_id`, usr_m.meta_value FROM `fed_users` AS usr LEFT JOIN fed_usermeta AS usr_m ON usr.user_id =  usr_m.user_id WHERE usr.`role` = 1 AND usr_m.meta_key = 'corporate_name'";
			$query	=$this->db->query($gry);
			//echo $this->db->last_query(); die;
			$AllData = $query->result_array();
			return 	$AllData;
		}
		 
   //////////get corporate company user data by user_id	
	   function  getcorporatecompany_dataid($user_id){	
			 $gry="SELECT usr.*, usr_m.meta_value AS corpname, usr_m2.meta_value AS logo FROM `fed_users` AS usr LEFT JOIN fed_usermeta AS usr_m ON usr.user_id =  usr_m.user_id  LEFT JOIN fed_usermeta AS usr_m2 ON usr.user_id =  usr_m2.user_id WHERE usr.`role` = 1 AND usr_m.meta_key = 'corporate_name' AND usr_m2.meta_key='corporate_logo' && usr.user_id=$user_id";
			$query	=$this->db->query($gry);
			//echo $this->db->last_query(); die;
			$AllData = $query->result_array();
			return 	$AllData;
		}
		
		
		 //////////get cause institution user data	
	   function  getcauseinstitution_data(){	
			 $gry="SELECT usr.`user_id`, usr_m.meta_value FROM `fed_users` AS usr LEFT JOIN fed_usermeta AS usr_m ON usr.user_id =  usr_m.user_id WHERE usr.`role` = 2 AND usr_m.meta_key = 'cause_institution'";
			$query	=$this->db->query($gry);
			//echo $this->db->last_query(); die;
			$AllData = $query->result_array();
			return 	$AllData;
		}
		
		//////////get INSTITUION  JOIN data by user_id	
	  function  getinstitution_dataid($user_id){	
		$gry="SELECT usr.*, usr_m.meta_value AS institution,
		usr_m2.meta_value AS institutionlogo,
		usr_m3.meta_value AS legalname,
		usr_m4.meta_value AS business,
		usr_m5.meta_value AS repname,
		usr_m6.meta_value AS repnumber,
		usr_m7.meta_value AS repaddress,
		usr_m8.meta_value AS repphone,
		usr_m9.meta_value AS repemail,
		usr_m10.meta_value AS accountnumber,
		usr_m11.meta_value AS bank_name,
		usr_m12.meta_value AS bank_legal_name,
		usr_m13.meta_value AS bank_social_number,
		usr_m14.meta_value AS bank_email,
		usr_m15.meta_value AS ins_certificate

		FROM `fed_users` AS usr 
		LEFT JOIN fed_usermeta AS usr_m ON usr.user_id =  usr_m.user_id 
		LEFT JOIN fed_usermeta AS usr_m2 ON usr.user_id =  usr_m2.user_id 
		LEFT JOIN fed_usermeta AS usr_m3 ON usr.user_id =  usr_m3.user_id 
		LEFT JOIN fed_usermeta AS usr_m4 ON usr.user_id =  usr_m4.user_id 
		LEFT JOIN fed_usermeta AS usr_m5 ON usr.user_id =  usr_m5.user_id 
		LEFT JOIN fed_usermeta AS usr_m6 ON usr.user_id =  usr_m6.user_id 
		LEFT JOIN fed_usermeta AS usr_m7 ON usr.user_id =  usr_m7.user_id
		LEFT JOIN fed_usermeta AS usr_m8 ON usr.user_id =  usr_m8.user_id 
		LEFT JOIN fed_usermeta AS usr_m9 ON usr.user_id =  usr_m9.user_id 
		LEFT JOIN fed_usermeta AS usr_m10 ON usr.user_id =  usr_m10.user_id 
		LEFT JOIN fed_usermeta AS usr_m11 ON usr.user_id =  usr_m11.user_id 
		LEFT JOIN fed_usermeta AS usr_m12 ON usr.user_id =  usr_m12.user_id 
		LEFT JOIN fed_usermeta AS usr_m13 ON usr.user_id =  usr_m13.user_id 
		LEFT JOIN fed_usermeta AS usr_m14 ON usr.user_id =  usr_m14.user_id 
		LEFT JOIN fed_usermeta AS usr_m15 ON usr.user_id =  usr_m15.user_id 
		
		WHERE usr.`role` = 2 AND usr_m.meta_key = 'cause_institution' 
		AND usr_m2.meta_key='cause_logo' 
		AND usr_m3.meta_key='ins_legal_name'
		AND usr_m4.meta_key='ins_line_business'
		AND usr_m5.meta_key='rep_legal_name'
		AND usr_m6.meta_key='rep_social_number'
		AND usr_m7.meta_key='rep_address'
		AND usr_m8.meta_key='rep_phone'
		AND usr_m9.meta_key='rep_email'
		AND usr_m10.meta_key='account_number'
		AND usr_m11.meta_key='bank_name'
		AND usr_m12.meta_key='bank_legal_name'
		AND usr_m13.meta_key='bank_social_number'
		AND usr_m14.meta_key='bank_email'
		AND usr_m15.meta_key='ins_certificate' && usr.user_id=$user_id";
		$query	=$this->db->query($gry);
		//echo $this->db->last_query(); die;
		$AllData = $query->result_array();
		return 	$AllData;
		}
		
		
		
		//////////admin getcause user data	
	   function  getcause_data(){
		   $gry="SELECT * FROM `fed_causes` WHERE `status` = 2 OR `status` = 3";
			$query	=$this->db->query($gry);
			//echo $this->db->last_query(); die;
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
	
	///////// get reco by table
	function getReco($tbl){
	
	$this->db->select('*');
	$this->db->from($tbl);
	$this->db->order_by('id','desc');
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
	////
	function updateData($tbl, $Fields, $id) {
		$this->db->where('id', $id);
		$updData = $this->db->update($tbl, $Fields);
		//echo $this->db->last_query(); die;
		return $updData;
	}
	function deletecertificate($tbl, $Field, $Id) {
		$this->db->where($Field, $Id);
  		$delete = $this->db->delete($tbl);
		//echo $this->db->last_query(); die;
		return $delete;
	}
	
 }

?>