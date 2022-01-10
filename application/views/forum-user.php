					<?php	foreach($users as $u): ?>
						
						<div style="overflow:scroll" >
						<table>
							<thead>
								<th>name</th>
								<th>username</th>
								<th>password</th>
								<th>faculty</th>
							</thead>
							<tbody>
								<tr>
									<td><?= $u["name"] ?></td>
									<td><?= $u["username"] ?></td>
									<td><?= $u["password"] ?></td>
									<td><?= $u["faculty"] ?></td>
								</tr>
							</tbody>
						</table>
						</div>
					
					<?php endforeach; ?>
					
					<script type="text/javascript">
					document.body.setAttribute("class" , "blue lighten-5")
					</script>