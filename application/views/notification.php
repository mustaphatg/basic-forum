				<div class="blue lighten-4" style="padding:5px" >
					<h3 align="center" class="blue-text" >Topics That Am Following</h3>
					<?php
						foreach($notys as $noty){
							$id = $noty["post_id"];
							$seen = $noty["seen"];
							if($seen == "no") $mes = "<i class='label alert ra '  >new comment</i>";
							else $mes = "";
							
							//get post info 
							$this->db->where("id", $id);
							$q = $this->db->get("posts");
							$qq = $q->row();
							$url = $qq->url_title;
							
							echo <<< END
								<div class="callout primary" style="padding:3px" >
									<a style="display:block;" href="/osco/$id/$url"> $qq->title</a>
									$mes
								</div>
							END;
							
						}
					
					?>
				</div>