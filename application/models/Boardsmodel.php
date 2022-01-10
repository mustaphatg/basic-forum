<?php

class Boardsmodel extends CI_Model
{

	public function get_numbers($cat = "home"){
		
		if($cat != "home"){
			$this->db->where("board", $cat);
		}
		
		$q = $this->db->get("posts");
		return $q->num_rows();
		
	}
	
	
	public function get_posts($cat = "home", $limit, $start){
		
		//check if call is from boards index function
		//if yes, then skip
		if($cat != "home"){
			$this->db->where("board", $cat);
		}
		
		$this->db->limit($limit, $start);
		$q = $this->db->get("posts");
		return $q->result_array();
			
	}
	

}
?>