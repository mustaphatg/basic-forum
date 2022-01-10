<?php

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
	}
	
	public function login()
	{
		if(! $this->input->post("login"))
		{
			redirect("/boards");
		}
		
		$uname = strtolower($this->input->post("username"));
		$passw = strtolower($this->input->post("password"));
		
		$this->db->where("username", $uname);
		$this->db->where("password", $passw);
		
		$g = $this->db->get("user");
		
		if($g->num_rows() != 1)
		{
			$er["error"] = "Wrong username or password";
			$er["lk"] = $this->input->post("current_link");
			$this->load->view("errors/osco_error", $er);
			return;
		}
		else
		{
			if($g->num_rows() == 1)
			{
				$this->session->user = $uname;
				redirect($this->input->post("current_link"));
			}
			
		}
		
	}
	
	
	public function signup(){
		if(! $this->input->post("signup")){
			redirect("/new-user");
		}
		
		$this->username_check($this->input->post("username"));
		$this->mail_check($this->input->post("mail"));
		
		$this->form_validation->set_rules("name", "Name", "trim|required|alpha_numeric_spaces");
		$this->form_validation->set_rules("username", "Username", "trim|required|alpha_dash");
		$this->form_validation->set_rules("password", "password", "trim|required");
		$this->form_validation->set_rules("faculty", "Faculty", "required");
		$this->form_validation->set_rules("gender", "Gender", "required");
		$this->form_validation->set_rules("mail", "Email Address", "trim|required|valid_email");
		
		if($this->form_validation->run() == FALSE)
		{
			$this->new_user();
		}
		else
		{
			$i["name"] = $this->input->post("name");
			$i["username"] = strtolower($this->input->post("username"));
			$i["password"] = strtolower($this->input->post("password"));
			$i["reg_date"] = date("d/m/Y");
			$i["email"] = strtolower($this->input->post("mail"));
			$i["faculty"] = $this->input->post("faculty");
			$i["gender"] = $this->input->post("gender");
			$i["profile_pic"] = "default.jpg";
			
			if($this->db->insert("user", $i))
			{
				$this->session->user = strtolower($this->input->post("username"));
				redirect("/boards");
			}
			else
			{
				die("<h5 align='center'>Unable to cantact the database</h5><p align='center'><a href='/new-user'>go back</a> and try again</p>");
			}
		}
		
	}
	
	
	public function username_check($user)
	{
		$this->db->where("username", strtolower($user));
		$q = $this->db->get("user");
		if($q->num_rows() != 0)
		{
			$er["error"] = "Username has been choosen by another user.";
			$er["lk"] = "/new-user";
			$s = $this->load->view("errors/osco_error", $er, TRUE);
			die($s);
		}
	}
	
	public function mail_check($mail)
	{
		$this->db->where("email", strtolower($mail));
		$q = $this->db->get("user");
		if($q->num_rows() != 0)
		{
			$er["error"] = "An account has been registered with that email address.";
			$er["lk"] = "/new-user";
			$s = $this->load->view("errors/osco_error", $er, TRUE);
			die($s);
		}
	}
	
	
	//form to create new account
	public function new_user(){
	
		if($this->session->user){
			redirect("/boards");
		}
	
		$hd["title"] = "Create A New Account";
		$this->load->view("template/header", $hd);
		$this->load->view("new-user");
		$this->load->view("template/footer");
	}
	
	
	public function logout(){
		session_destroy();
		redirect("/boards");
	}
	
	
	public function profile($user){
		$this->db->where("username", $user);
		$q = $this->db->get("user");
		
		if($q->num_rows() != 1){
			$d["error"] = "User not found or the link is broken.";
			$d["lk"] = "/boards";
			$this->load->view("errors/osco_error", $d);
			return;
		}
		
		$u = $q->row();
		
		$this->db->reset_query();
		//get topics
		$this->db->where("post_by", $user);
		$t = $this->db->get("posts");
		
		$hd["title"] = $u->name;
		$this->load->view("template/header", $hd);
		
		$bd["user"] = $u;
		$bd["topics"] = $t->result_array();
		$this->load->view("profile", $bd);
		
		$this->load->view("template/footer");
		
	}
	
	
	public function notifications(){
		$this->load->model("notificationmodel");
		$b["notys"] = $this->notificationmodel->get_noty();
		
		$hd["title"] = "Notifications";
		$this->load->view("template/header", $hd);
		
		$this->load->view("notification", $b);
		
		$this->load->view("template/footer");
	}
	
	
	
}
?>