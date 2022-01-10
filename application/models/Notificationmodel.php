<?php

class Notificationmodel extends CI_Model
{

	//after each successful comment
	public function register_noty($id)
	{
		$this->db->where("post_id", $id);
		$this->db->where("user", $this->session->user);
		
		$q = $this->db->get("followed_topics");
		$this->db->reset_query();
		
		if($q->num_rows() == 0){
			//has not posted before
			$i["user"] = $this->session->user;
			$i["post_id"] = $id;
			$i["seen"] = "yes";
			
			if($this->db->insert("followed_topics", $i)){
				
			}else{
				$e["error"] = "Something went wrong.";
				$e["lk"] = "/board";
				$this->load->view("errors/osco_error", $e);
				return;
			}
			
		}
		
		//update other 'seen'to no
		$this->db->set("seen", "no");
		$this->db->where("post_id", $id);
		$this->db->where("user !=", $this->session->user);
		$this->db->update("followed_topics");
	}
	
	//when viewing topic
	public function update_to_yes($id){
		//update topic seen to yes 
		$this->db->where("post_id", $id);
		$this->db->where("user", $this->session->user);
		$this->db->set("seen", "yes");
		$this->db->update("followed_topics");
		
	}
	
	
	public function get_num_noty(){
		$this->db->where("user", $this->session->user);
		$this->db->where("seen", "no");
		$q = $this->db->get("followed_topics");
		return $q->num_rows();
	}
	
	
	
	public function get_noty(){
		$this->db->where("user", $this->session->user);
		$q = $this->db->get("followed_topics");
		return $q->result_array();
	}


}
?>