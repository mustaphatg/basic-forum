<?php

class Boards extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("upload");
		$this->load->model("boardsmodel");
		$this->load->library("pagination");
		$this->load->model("notificationmodel");;
	}
	
	public function getnumofnoty(){
		$c = $this->notificationmodel->get_num_noty();
		return $c;
	}
	
	
	public function setup($cat_link, $cat){
		$c["base_url"] = base_url().$cat_link;
		$c["per_page"] = 2;
		$c["next_link"] = FALSE;
		$c["prev_link"] = FALSE;
		//$c["display_pages"] = FALSE;
		$c["attributes"] = array("class"=>"blue z-depth-2 white-text", "style"=>"border-radius:3px; padding:4px; display:inline-block; margin:3px");
		$c["total_rows"] = $this->boardsmodel->get_numbers($cat);
		return $c;
	}
	
	//function accept 1 param. to be used in pagination, for starting
	public function index($st = 0)
	{
		$hd["title"] = "Home page";
		$this->load->view("template/header", $hd);
		
		//get setup above
		$setup = $this->setup("boards/index", "home");
		//initialize
		$this->pagination->initialize($setup);
		//call get_post from boardsmodel 3 params (category, limit, start)
		$bd["posts"] = $this->boardsmodel->get_posts("home", $setup["per_page"], $st);
		//create links 
		$bd["links"] = $this->pagination->create_links();
		$bd["noty"] = $this->getnumofnoty();
		$this->load->view("home", $bd);
		
		$this->load->view("template/footer");
	}
	
	
	//function accept 1 param. to be used in pagination, for starting
	public function environmental($st = 0)
	{
		$hd["title"] = "Enviroment Science";
		$this->load->view("template/header", $hd);
		
		//get setup above
		$setup = $this->setup("boards/environmental", "environmental");
		//initialize
		$this->pagination->initialize($setup);
		//call get_post from boardsmodel 3 params (category, limit, start)
		$bd["posts"] = $this->boardsmodel->get_posts("environmental", $setup["per_page"], $st);
		//create links 
		$bd["links"] = $this->pagination->create_links();
		$bd["noty"] = $this->getnumofnoty();
		$this->load->view("boards", $bd);
		
		$this->load->view("template/footer");
	}
	
	
	//function accept 1 param. to be used in pagination, for starting
	public function management($st = 0)
	{
		$hd["title"] = "Management Science";
		$this->load->view("template/header", $hd);
		
		//get setup above
		$setup = $this->setup("boards/management", "management");
		//initialize
		$this->pagination->initialize($setup);
		//call get_post from boardsmodel 3 params (category, limit, start)
		$bd["posts"] = $this->boardsmodel->get_posts("management", $setup["per_page"], $st);
		//create links 
		$bd["links"] = $this->pagination->create_links();
		$bd["noty"] = $this->getnumofnoty();
		$this->load->view("boards", $bd);
		
		$this->load->view("template/footer");
	}
	
	
	//function accept 1 param. to be used in pagination, for starting
	public function applied_science($st = 0)
	{
		$hd["title"] = "Pure & Applied Science";
		$this->load->view("template/header", $hd);
		
		//get setup above
		$setup = $this->setup("boards/applied_science", "applied_science");
		//initialize
		$this->pagination->initialize($setup);
		//call get_post from boardsmodel 3 params (category, limit, start)
		$bd["posts"] = $this->boardsmodel->get_posts("applied_science", $setup["per_page"], $st);
		//create links 
		$bd["links"] = $this->pagination->create_links();
		$bd["noty"] = $this->getnumofnoty();
		$this->load->view("boards", $bd);
		
		$this->load->view("template/footer");
	}
	
	
	//function accept 1 param. to be used in pagination, for starting
	public function engineering($st = 0)
	{
		$hd["title"] = "Engineering";
		$this->load->view("template/header", $hd);
		
		//get setup above
		$setup = $this->setup("boards/engineering", "engineering");
		//initialize
		$this->pagination->initialize($setup);
		//call get_post from boardsmodel 3 params (category, limit, start)
		$bd["posts"] = $this->boardsmodel->get_posts("engineering", $setup["per_page"], $st);
		//create links 
		$bd["links"] = $this->pagination->create_links();
		$bd["noty"] = $this->getnumofnoty();
		$this->load->view("boards", $bd);
		
		$this->load->view("template/footer");
	}
	
	//function accept 1 param. to be used in pagination, for starting
	public function ict($st = 0)
	{
		$hd["title"] = "Information com. & tech.";
		$this->load->view("template/header", $hd);
		
		//get setup above
		$setup = $this->setup("boards/ict", "ict");
		//initialize
		$this->pagination->initialize($setup);
		//call get_post from boardsmodel 3 params (category, limit, start)
		$bd["posts"] = $this->boardsmodel->get_posts("ict", $setup["per_page"], $st);
		//create links 
		$bd["links"] = $this->pagination->create_links();
		$bd["noty"] = $this->getnumofnoty();
		$this->load->view("boards", $bd);
		
		$this->load->view("template/footer");
	}
	
	
	
	
	public function new_user(){
		$hd["title"] = "Create A New Account";
		$this->load->view("template/header", $hd);
		$this->load->view("new-user");
		$this->load->view("template/footer");
	}


}
?>