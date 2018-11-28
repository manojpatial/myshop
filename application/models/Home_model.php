<?php
class Home_model extends CI_Model {	

	function getReco($tbl){	
		$this->db->select('*');
		$this->db->from($tbl);
		//$this->db->order_by("sports", "asc");
		$query=$this->db->get();
		//echo $this->db->last_query(); die;
		$AllData = $query->result_array();
			return 	$AllData;
		
	}
	
	function AddData($tbl, $Data) {
		
		$insert = $this->db->insert($tbl, $Data);
		//echo $this->db->last_query(); exit;
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	 
	 function check_email($email) {

		$this->db->select('*')->from('build_register');

		$this->db->where('email',$email); 

		$query=$this->db->get();

		//echo $this->db->last_query(); die;

		return $query->num_rows();

	}
	
	//home_login
	function homeLogin($email, $password) {

        $this->db->select('REG.id,  REG.email, REG.name, REG.password');

		$this->db->from('build_register as REG');

		 $this->db->where('REG.email', $email);

		//$this->db->where('REG.password', $passWord);

		//$this->db->where('REG.status', 1);

		$this->db->where('REG.password', ($password));
		//$this->db->where('REG.ency_password', md5($passWord));

		$query = $this->db->get();
	
		// $this->db->last_query(); //die;

		if($query->num_rows() == 1) {



			$Admin = $query->result_array();
			//print_r($Admin);

			return 	$Admin;

		}	


	 }
	 
	 function getRecoId($tbl,$id){
	$this->db->select('*');
	$this->db->from($tbl);
	$this->db->where('id', $id);
	$query=$this->db->get();
	//echo $this->db->last_query(); die;
	$AllData = $query->result_array();
		return 	$AllData;
	
	}
	
	function deleteInCond($tbl, $Field, $Id) {

		$this->db->where($Field, $Id);
  		$delete = $this->db->delete($tbl);
		//echo $this->db->last_query(); die;
		return $delete;
	}
	
	function updateData($tbl, $Fields, $id) {

		$this->db->where('id', $id);
		$updData = $this->db->update($tbl, $Fields);
			//echo $this->db->last_query(); die;
		return $updData;
	}
	
	 function getRecosession_id($tbl,$id){
	$this->db->select('*');
	$this->db->from($tbl);
	$this->db->where('session_id', $id);
	$query=$this->db->get();
	//echo $this->db->last_query(); die;
	$AllData = $query->result_array();
		return 	$AllData;
	
	}
	
	 
	 
	
    
	
	 
	
	 
	
	 
	 
	
	  

	
 }

?>