					<?php
						if($this->session->user){
							$user = ucfirst($this->session->user);
						}
						else{
							$user = "guest"." <a href='javascript:void(0)' data-toggle='off'>login/signup</a>";
						}
					?>
					<div class="callout success" style="padding:3px" >
						<span class="flex flex-column grey-text" style="font-size:12px"  >
							<span>Welcome, <?= $user ?>.</span>
							<?php if($this->session->user) : ?>
								<span>Notification(s): <a href="/user/notifications" style="display:inline-block; padding:4px"  class="bold"  > <?= $noty?> </a> </span>
							<?php endif; ?>					
							<span class=""  style="font-size:17px; font-family:cursive" >A forum for the oscolites...</span>
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
										<span style="font-size:10px;" class="grey-text"><i class="ion-md-person"></i> $post_by</span>							
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
					
					<div style="padding:3px"  class="primary callout" >
					<?= $links ?>
					</div>