<!DOCTYPE html>
<html>
<head>
<title>An Error Occurred</title>
<link rel="stylesheet" href="/css/color.css" >
<link rel="stylesheet" href="/css/foundation.css" >
<meta name="viewport" content="width=device-width" >
<style type="text/css">
	#f{
		border:2px solid grey;
		border-radius:5px;
		text-align:center;
		padding:10px;
	}
</style>
</head>
<body>
<div class=" " style="height:100px" ></div>

<div class="grid-container" >
	<div class="grid-x" >
		<div id="f"  class="cell medium-8 medium-offset-2" >
			
			<h3><?= $error ?></h3>
			<?php if($lk == "") : ?>
				<p><a href="javascript:void(0)" onclick="history.back()">Go back </a>and try again</p>
			<?php else: ?>
				<p><a href="<?= $lk; ?>" class="">Go back</a> and try again</p>
			<?php endif; ?>
			
		</div>
	</div>
</div>


</body>
</html>