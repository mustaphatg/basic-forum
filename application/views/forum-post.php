				<?php	foreach($posts as $po): ?>
				
					<div class="callout alert" >
						<a href="/osco/<?=$po["id"]?>/<?=$po["url_title"]?>"><?=$po["title"]?></a>
						<hr>
						<a href="/post/delete/<?=$po["id"]?>" class="button alert" >delete</a>
					</div>
					
				<?php endforeach; ?>