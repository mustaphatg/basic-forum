<?php

class Post extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("upload");
	}
	
	public function like($id = 0, $url_t)
	{
		if($id ==0){
			$d["error"] = "Page not available or link is broken.";
			$d["lk"] = "/boards";
			$s = $this->load->view("errors/osco_error", $d, TRUE );
			die($s);
		}
		
		$this->db->set("likes", "likes+1", FALSE);
		$this->db->where("id", $id);
		$this->db->update("posts");
		redirect("osco/".$id."/".$url_t);
	}
	
	
	public function create_post($board = "environmental"){
		
		if(! $this->session->user){
			redirect("/new-user");
		}
		
		$hd["title"] = "Create A new Post";
		$this->load->view("template/header", $hd);
		
		$dt["board"] = $board;
		$dt["post_by"] = $this->session->user;
		$this->load->view("new-post", $dt);
		
		$this->load->view("template/footer");
	}
	
	
	public function submit_post(){
	
		$i["title"] = $this->input->post("title");
		$i["url_title"] = url_title($this->input->post("title"));
		$i["body"] = $this->input->post("body");
		$i["post_by"] = $this->input->post("post_by");
		$i["board"] = $this->input->post("board");
		$i["time"] = date("d/m/y").", at ".date("h:i:s");
		
		if($this->db->insert("posts", $i))
		{
			$id = $this->db->insert_id();
			$link = "/osco/".$id."/".url_title($this->input->post("title"));
			
			//insert noty
			$this->db->reset_query();
			$in["user"] = $this->session->user;
			$in["post_id"] = $id;
			$in["seen"] = "yes";
			$this->db->insert("followed_topics", $in);
			$this->db->reset_query();
			
			
			
			if($this->input->post("image") == "yes")
			{
				$a = array("type" => "ok-image", "link" => $link, "id"=>$id);
				echo json_encode($a);
				return;
			}
			
			//no image just text
			$a = array("type" => "ok-no-image", "link"=>$link);
			echo json_encode($a);
			return;
			
		}
		else
		{
			//not inserted
			$a = array("type" => "error", "message"=>"Error in contacting database");
			echo json_encode($a);
			return;
		}
	}
	
	
	public function upload_image($id){
		$c["allowed_types"] = "png|jpg|jpeg";
		$c["file_name"] = "img-".strtotime("now").".jpg";
		$c["upload_path"] = "post-image";
		$this->upload->initialize($c);
		
		if($this->upload->do_upload("image"))
		{
			$name = $this->upload->data()["file_name"];
			
			//get previous
			$this->db->where("id", $id);
			$this->db->select("image");
			$q = $this->db->get("posts");
			$g = $q->row();
			$im_name = $g->image;
			
			if($im_name == ""){
				$updated_name = $name;
			}else{
				$updated_name = $im_name.",".$name;
			}
			
			$this->db->set("image", $updated_name);
			$this->db->where("id", $id);
			$this->db->update("posts");
		
		}else{
			$a = array("type" => "error", "message"=>$this->upload->display_erros());
			echo json_encode($a);
			return;
		}
		
	}
	
	
	
	
	public function osco_post($id, $link){
		
		$this->db->where("id", $id);
		$this->db->where("url_title",$link);
		$q = $this->db->get("posts"); //q
		
		if($q->num_rows() != 1){
			$d["error"] = "Page not found or the link you followed is broken.";
			$d["lk"] = "/boards";
			$this->load->view("errors/osco_error", $d);
			return;
		}
		
		//update views
		$this->db->reset_query();
		$this->db->where("id", $id);
		$this->db->set("views", "views+1",FALSE);
		$this->db->update("posts");
		
		if($this->session->user){
			$this->load->model("notificationmodel");
			$this->notificationmodel->update_to_yes($id);
		}
		
		//get comments
		$this->db->reset_query();
		$this->db->where("post_id", $id);
		$c = $this->db->get("comment");
		$co = $c->result_array();
		
		$g = $q->row();
		$t = $g->title;
		
		$hd["title"] = $t;
		$this->load->view("template/header", $hd);
		
		$bd["post"] = $g;
		$bd["comments"] = $co;
		$this->load->view("post", $bd);
		
		$this->load->view("template/footer");
		
	}
	
	
	//comment
	public function comment(){
	
		$this->load->model("notificationmodel");
		$lk = $this->input->post("url");

		if($this->input->post("is-image") == "yes"){
			$c["file_name"] = "img-".strtotime("now").".jpg";
			$c["upload_path"] = "comment-image";
			$c["allowed_types"] = "png|jpg|jpeg";
			$this->upload->initialize($c);
			
			if($this->upload->do_upload("image")){
				$image_name = $this->upload->data()["file_name"];			
			}else{
				$d = $this->upload->display_errors();
				die($d);
			}	
		}else{
			$image_name = null;
		}//end image code
		
		$i["comment_by"] = $this->session->user;
		$i["comment_body"] = $this->input->post("comment_body");
		$i["post_id"] = $this->input->post("post_id");
		$i["image"] = $image_name;
		$i["time"] = date("d/m/y").", at ".date("h:i:s");
		
		if($this->db->insert("comment", $i)){
			//noty
			$this->notificationmodel->register_noty($this->input->post("post_id"));
			redirect("osco/".$lk);
		}else{
			$r["error"] = "Something unusual has occurred, try again.";
			$r["lk"] = "";
			$this->load->view("errors/osco_error", $r);
		}
		
	}
	
	
	public function delete($id){
		//followed topics
		$this->db->where("post_id", $id);
		$this->db->delete("followed_topics");
		$this->db->reset_query();
		
		//comment
		$this->db->where("post_id", $id);
		$q = $this->db->get("comment");
		$qq = $q->row_array();
		
		if(count($qq) != 0){
			$c_im = $qq["image"];
		
			if($c_im != ""){
				unlink("comment-image/".$c_im);
			}
		}
		
		
		$this->db->where("post_id",$id);
		$this->db->delete("comment");
		//end comments 
		
		
		//post
		$this->db->reset_query();
		$this->db->where("id", $id);
		$this->db->select("image");
		$g = $this->db->get("posts");
		$gg = $g->row();
		$po_im = $gg->image;
		
		if($po_im != ""){
			$ar = explode(",",$po_im);
			$c = count($ar);
			$i = 0;
			
			for($i = 0; $i < $c; ++$i){
				$lk = "post-image/".$ar[$i];
				unlink($lk);
			}
			
		}
		
		$this->db->reset_query();
		$this->db->where("id", $id);
		$this->db->delete("posts");
		//end post
		
		redirect("admin-post");
	}
	
	
	public function mm(){
		$this->db->where("id", 1);
		$s = $this->db->get("posts");
		$g = $s->row();
		print_r($g);
	//	$s = $g->title;
		//if($s) echo $s;
	}

}
?>