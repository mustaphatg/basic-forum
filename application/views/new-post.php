					
					<div class="grid-x" >
						
						<div class="cell green lighten-4" >
							<h5 class="bold red-text" >Rules</h5>
							<ul class="red-text" >
								<li class="">Ensure you are posting in the right section.</li>
								<li class="">Do not insult fellow members.</li>
								<li class="">Pornographic or adult contents are not allowed in the forum.</li>
								<li class="">Links or advertisements are also not allowed.</li>			
							</ul>
						</div>
						
						<div class="cell" >
							<label>Post Title</label>
							<input id="post-title" type="text" required="required" placeholder="Eg. My day in oscotech"  >
						</div>
						
						<div class="cell" >
							<label>Post Body</label>
							<textarea id="post-body" required="required" placeholder="Welcome to osco-stress..." rows="10" ></textarea>
						</div>
						
						<div class="" >
							<input type="hidden" id="by" value="<?= $post_by ?>"  >
							<input type="hidden" id="board" value="<?= $board ?>"  >
						</div>
						
						<div class="cell" id="box" >
						</div>
						
						<div class="cell" >
							<label class="white-text button expanded" >
								<input onchange="imageChoosed()" accept="image/*"  type="file" id="input" class="hide" >
								<i class="ion-md-image white-text" ></i> Add Photos
							</label>
						</div>
						
						<div class="cell" >
							<button id="showld" class="hide button expanded" ><img height="20" width="20" src="\image/load.gif"></button>
							<button  id="btt" onclick="createPost()" class="button expanded" >Create post</button>
						</div>
						
					</div>
					
					<script type="text/javascript" src="/js/axios.js"></script>
					<script type="text/javascript" src="/js/app.js"></script>
				