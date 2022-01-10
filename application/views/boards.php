							<div style="padding:3px"  class="callout  success" data-closable>
								<?php
									$seg = $this->uri->segment(2);			
									$num = "";
									$arr["environmental"] = "Environmental science";
									$arr["management"] = "Management science";
									$arr["applied_science"] = "Applied science";
									$arr["engineering"] = "Engineering";
									$arr["ict"] = "Ict";
									$segm = $arr[$seg];
									
									$this->db->where("board", $seg);
									$q = $this->db->get("posts");
									$num = "There are ".$q->num_rows(). " post(s) in this section";						
														
									if($this->session->user){
										$user = ucfirst($this->session->user). ". [<a href='/post/create_post/$seg'> create a new post in this section</a>]";
									}
									else{
										$user = "Guest"." <a href='javascript:void(0)' data-toggle='off'>login/signup</a>";
									}
										
								?>
								<span class="flex flex-column grey-text" style="font-size:12px"  >
									<span>Welcome, <?= $user ?>.</span>
									<?php if($this->session->user) : ?>
										<span>Notification(s): <a href="/user/notifications" style="display:inline-block; padding:4px"  class="bold"  > <?= $noty?> </a> </span>
									<?php endif; ?>
									<span>Board : <?= $segm  ?>	</span>			
									<span><?= $num ?>. </span>
								</span>	
							</div>
							
							
							<?php foreach($posts as $post)
							{
								$v = $post["views"];
								$post_by = ucfirst($post["post_by"]);
								$title = ucfirst($post["title"]);
								$link_title = $post["url_title"];
								$id = $post["id"];
								$likes = $post["likes"];
								$views = $post["views"];
								$cu = uri_string();
								
								echo <<< END
									<div id="$id" class="z-depth-2" style="padding:5px">
										<a href="/osco/$id/$link_title" class="">
											<div class="" style="padding:2px">
												<span style="font-size:10px" class="grey-text"><i class="ion-md-person"></i> $post_by</span>
												<span><br>$title</span>
											</div>
										</a>
										<div style="font-size:11px " class="grey-text flex flex-around" >
											<span class="">$likes like(s)</span>
											<span class="">$views view(s)</span>
										</div>	
									</div><br>
								END;
							}
							?>
							
							<div class="primary callout" style="padding:3px" >
								<?= $links ?>
							</div>