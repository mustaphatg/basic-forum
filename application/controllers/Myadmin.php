<?php

class Myadmin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function user()
	{
		$q = $this->db->get("user");
		$s = $q->result_array();
		
		$hd["title"] = "Forum Users";
		$this->load->view("template/header", $hd);
		
		$d["users"] = $s;
		$this->load->view("forum-user", $d);
		
		$this->load->view("template/footer");
	}
	
	
	public function post(){
		$q = $this->db->get("posts");
		$this->db->order_by("id", "DESC");
		$a = $q->result_array();
		
		$hd["title"] = "Forum posts";
		$this->load->view("template/header", $hd);
		
		$bd["posts"] = $a;
		$this->load->view("forum-post", $bd);
		
		$this->load->view("template/footer");
	}
	


}
?>