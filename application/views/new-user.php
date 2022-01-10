
					<div class="show-for-medium" style="height:100px" ></div>
					
					<form method="post" onsubmit="return check()" class="grid-x" action="/signup" >
						<div class="cell medium-8 medium-offset-2" >
							<div class="" >
								<h4 class="label warning" >Signup</h4>
							</div>
							
							<div class="red lighten-4 red-text" style="padding:0px" id="error" >
								<?php echo validation_errors(); ?>
							</div><br>
							
							<div class="" >
								<input required="required" type="text" name="name" value="<?php echo set_value('name'); ?>" placeholder="Name" >
							</div>
							
							<div class="" >
								<input required="required" type="text" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username" >
							</div>
												
							<div class="" >
								<input required="required" type="email" name="mail" value="<?php echo set_value('mail'); ?>" placeholder="Email Address" >
							</div>
							
							<div class="" >
								<input type="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="password"  >
							</div>
							
							<div class="" >
								<select id="gender" required="required" name="gender" >
									<option>Gender</option>
									<option value="male" >Male</option>
									<option value="female" >Female</option>
								</select>
							</div>
							
							<div class="" >
								<select id="faculty" required="required" name="faculty" >
									<option>Select Your Faculty</option>
									<option value="Environmental Science" >Environmental Science</option>
									<option value="Management Science" >Environmental Science</option>
									<option value="Pure and Applied Science" >Pure and Applied Science</option>
									<option value="Engineering" >Engineering</option>
									<option value="ICT" >ICT</option>
								</select>
							</div>
							
							<div class="" >
								<input type="submit" name="signup" class="expanded button" value="Signup" >
							</div>
							
						</div>	
					</form>
					
					<div class="hide-for-medium" style="height:50px" ></div>
					
					<script type="text/javascript">
						function check(){
							var g = document.querySelector("#gender").selectedIndex
							var f = document.querySelector("#faculty").selectedIndex
							
							if(g == 0){
								$("#error").text("Select a valid gender.")
								return false
							}
							
							if(f == 0){
								$("#error").text("Select a valid faculty.")
								return false
							}
							
							
						}
					</script>

