			<div class="blue lighten-4" >
				<h3 align="center" class="bold blue-text" >
					<?php if($this->session->user == $user->username): ?>
						My profile
					<?php else: ?>
						<?=ucfirst($user->username)?>'s profile
					<?php endif; ?>
				</h3>
				<table class="text-left blue-text" >
					<tr>
						<th>Name</th>
						<td><?=$user->name?></td>
					</tr>
					<tr>
						<th>Username</th>
						<td><?=$user->username?></td>
					</tr>
					<tr>
						<th>Faculty</th>
						<td><?=$user->faculty?></td>
					</tr>
					<tr>
						<th>Gender</th>
						<td><?=$user->gender?></td>
					</tr>
					<tr>
						<th>Member since</th>
						<td><?=$user->reg_date?></td>
					</tr>
				</table>
			</div>
				<br>
				
			<div class="callout blue lighten-4" >
				<h3 align="center" class="blue-text" ><?=ucfirst($user->username)?>'s topics (<?= count($topics) ?>)</h3>
				<?php  foreach($topics as $to): ?>
					<div class="callout primary" style="padding:3px" >
						<a style="display:block" href="/osco/<?=$to["id"]?>/<?=$to["url_title"]?>" class="" ><?=$to["title"]?></a>
					</div>
				<?php endforeach; ?>
			</div>
			
			<br>
			
			<p align="center" class="grey-text" >( edit profile ) coming soon...</p>