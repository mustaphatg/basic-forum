<!DOCTYPE html>
<html class="no-js">
<head>
<title><?= $title ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" >
<link rel="stylesheet" href="/css/foundation.css" >
<link rel="stylesheet" href="/css/ionicons.css" >
<link rel="stylesheet" href="/css/color.css " >
<link rel="stylesheet" href="/css/osco.css" >
</head>
<body  >

	<!-- off-canvas wrapper-->
	<div class="grow-1 off-canvas-wrapper" >
	
		<!-- off-canvas-wrapper inner-->
		<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
			
			<!-- off-canvas -->
			<div class="green lighten-5 reveal-for-medium off-canvas position-left" id="off" data-off-canvas >
				<div class="show-for-medium" style="height:80px" ></div>
				<div class="hide-for-medium" style="height:50px" ></div>
				
				<?php if(! $this->session->user): ?>
				<form class="grid-x grid-padding-x" method="post" action="/login" >
					<div class="cell" >
						<h4 class="ra label warning" >Login</h4>
					</div>
					<div class="cell" >
						<input type="text" class="ra" required="required"  placeholder="Username" name="username" >
					</div>
					<div class="cell" >
						<input required="required"  type="password" name="password" placeholder="Password"  class="ra" >
					</div>
					<div class="" >
						<input type="hidden" name="current_link" value="<?php echo current_url(); ?>" >
					</div>
					<div class="cell" >
						<input type="submit" name="login"  value="Login" class="button ra expanded" >
					</div>
					<div class="cell text-center" >
						OR
					</div>
					<a href="/new-user" class="button warning expanded"  >Create A New Account</a>
				</form>
			    <?php endif; ?>
			    
			    <hr>
			    <ul class="menu vertical" >
			    	<li class="menu-text">Boards
			    		<ul class="menu vertical" >
			    			<li class=""><a href="/boards" class="">Home</a></li>
			    			<li class=""><a href="/boards/environmental" class="">Environmental Science</a></li>
			    			<li class=""><a href="/boards/management" class="">Management Science</a></li>
			    			<li class=""><a href="/boards/applied_science" class="">Pure & Applied Science</a></li>
			    			<li class=""><a href="/boards/engineering" class="">Engineering</a></li>
			    			<li class=""><a href="/boards/ict" class="">ICT</a></li>
			    		</ul>
			    	</li>
			    	<li class=""><hr></li>
			    	<li class="menu-text">Just For Fun
			    		<ul class="menu vertical" >
			    			<li class=""><a href="" class="">Face blast</a></li>
			    		</ul>
			    	</li>
					<li class=""><hr></li>
			    	<li class="menu-text">User
			    		<ul class="menu vertical" >
			    			<?php if($this->session->user) : ?>
			    				<li class=""><a href="/user/profile/<?=$this->session->user?>" class=""><i class="ion-md-person" ></i> My Profile</a></li>
			    				<li class=""><a href="/logout" class="">Log out</a></li>
			    			<?php else: ?>
			    				<li class="menu-text red-text">Login to view your profile</li>
			    			<?php endif; ?>
			    		</ul>
			    	</li>
			    </ul>
				
			</div>
			
			<!-- off-canvas-content -->
			<div class="off-canvas-content" data-off-canvas-content >
				<div class="white top z-depth-2"  >
					<a href="javascript:void(0)" data-toggle="off" class="icon hide-for-medium">
						<p class="blue" ></p>
						<p class="blue" ></p>
						<p class="blue" ></p>
					</a>
					<span style="font-size:20px; text-align:left; margin-left:15px;" class="blue-text big">
						Basic Forum
					</span>
				</div><br>
				
				<!-- page/grid container -->
				<div style="min-height:100vh" class="grid-container flex flex-column" >
					
					<!-- main content -->
					<div class="grow-1" main-content >
					
					