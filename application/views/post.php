				<div class="text-center callout success green-text bold" style="padding:3px" >
					<?= ucwords($post->title) ?>
				</div>
				
				<div class="callout black-text green lighten-4" style="padding:3px">
					<span class="green-text bold" style="border-bottom:1px solid green; display:block; font-size:14px" ><a onclick="this.innerHTML = 'loading... '" href="/user/profile/<?=$post->post_by ?>"> <?= ucfirst($post->post_by) ?> </a> posted this on <?= $post->time ?> </span><br>
					<?= nl2br(ucfirst($post->body)) ?>
					
					<?php
						$im = $post->image;
						if($im != ""){
							$ar = explode(",", $im);
							$n = count($ar);
							$i = 0;
							for($i = 0; $i < $n; ++$i){
								$s = "/post-image/".$ar[$i];
								echo "<img src='{$s}'><hr>";
							}
						}
					?>
					<br>
					<a onclick="this.innerHTML = 'sending...'" href="/post/like/<?= $post->id?>/<?= $post->url_title?> " ><i class="ion-ios-thumbs-up" ></i> like this post</a>(<?= $post->likes?>)
				</div><!-- end post body -->
				
				
				
				<!-- comments -->
				<?php foreach($comments as $com) : ?>
					<div class="callout black-text green lighten-4" style="padding:8px" >
						<span class="green-text bold" style="border-bottom:1px solid green; display:block; font-size:14px" ><a onclick="this.innerHTML = 'loading... '" href="/user/profile/<?= ucfirst($com["comment_by"]) ?>"> <?= ucfirst($com["comment_by"]) ?> </a> posted this on <?= $com["time"] ?> </span><br>
						<?= nl2br(ucfirst($com["comment_body"])) ?>
						<br>
						<?php if($com["image"] != ""): ?>
							<img src="/comment-image/<?=$com["image"]?>" >
						<?php endif; ?>
					</div>
				<?php endforeach ?>
				<!-- end postes comments -->
				
				
				
				<!-- write comments section -->
				<div class="callout success" id="comm" >
					<?php if($this->session->user): ?>
						<form method="post" class="grid-x" action="/post/comment" enctype="multipart/form-data" >
							<div class="cell" >
								<input type="hidden" id="is-image" name="is-image" value="no"  >
								<input type="hidden" name="url" value="<?=$post->id?>/<?=$post->url_title?>#com" >
								<input type="hidden" name="post_id"  value="<?= $post->id ?>" >
								<textarea rows="3" name="comment_body" required="required" placeholder="Type a comment"  ></textarea>
							</div>
							<div class="" >
								<img class="" id="imm"  >
							</div>
							<div class="cell flex flex-between" >
								<label class="button success " >
									<input name="image" onchange="inputChanged()" accept="image/*" type="file" id="input" class="hide"  >
									add image
								</label>
								<input type="submit" class="success button "  name="comment"  value="SEND" >
							</div>
						</form>
						<span align="center" class="grey-text">you will start receiving notifications pertaining to this topic after you comment on it.</span>
					<?php else: ?>
						<span class="red-text" >Dear guest, <a href="javascript:void(0)" data-toggle="off" >login/signup</a> to comment on this post.</span>
					<?php endif; ?>
					
				</div>
				
				
				<script type="text/javascript">
					document.body.setAttribute("class", "green lighten-5")
					
					function inputChanged(){
						document.querySelector("#is-image").value = "yes"
						
						var inp = document.querySelector("#input").files[0]
						var imm = document.querySelector("#imm")
						imm.style = "height:90px; width:90px; margin:2px;"
						imm.src = URL.createObjectURL(inp)
						
						imm.onload = function(){
							URL.revokeObjectURL(imm.src)
						}
					}
					
				</script>