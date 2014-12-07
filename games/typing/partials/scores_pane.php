
<?php 
	$all_scores = $typingDBHandler->get_top_scores();
?>


	<div class="hard_highscores highscore_container">
		<h4>Hard Highscores</h4>
		<table class="table table-striped">
			<tr><th></th><th>User</th><th>Score</th><th>Date</th></tr>
			<tbody>
				<?php 
				$count = 1;
				foreach ($all_scores[2] as $score) {
					$user = $user_login_manager->user_dbhandler->get_user($score['userid']);
					$date = date_create($score['date']);
					$date = date_format($date, 'g:ia \o\n l jS F Y');
					echo "<tr>";
						echo "	<td>".$count."</td>
								<td>".$user->get_fullname()."</td>
								<td>".$score['score']."</td>
								<td>".$date."</td>";
					echo "</tr>";
					$count += 1;
				}

				?>
			</tbody>
		</table>
	</div>
	<hr>

	<div class="medium_highscores highscore_container">
		<h4>Medium Highscores</h4>
		<table class="table table-striped">
			<tr><th></th><th>User</th><th>Score</th><th>Date</th></tr>
			<tbody>
				<?php 
				$count = 1;
				foreach ($all_scores[1] as $score) {
					$user = $user_login_manager->user_dbhandler->get_user($score['userid']);
					$date = date_create($score['date']);
					$date = date_format($date, 'g:ia \o\n l jS F Y');
					echo "<tr>";
						echo "	<td>".$count."</td>
								<td>".$user->get_fullname()."</td>
								<td>".$score['score']."</td>
								<td>".$date."</td>";
					echo "</tr>";
					$count += 1;
				}?>
			</tbody>
		</table>
	</div>
	<hr>

	<div class="easy_highscores highscore_container">
		<h4>Easy Highscores</h4>
		<table class="table table-striped">
			<tr><th></th><th>User</th><th>Score</th><th>Date</th></tr>
			<tbody>
				<?php 
				$count = 1;
				foreach ($all_scores[0] as $score) {
					$user = $user_login_manager->user_dbhandler->get_user($score['userid']);
					$date = date_create($score['date']);
					$date = date_format($date, 'g:ia \o\n l jS F Y');
					echo "<tr>";
						echo "	<td>".$count."</td>
								<td>".$user->get_fullname()."</td>
								<td>".$score['score']."</td>
								<td>".$date."</td>";
					echo "</tr>";
					$count += 1;
				}

				?>
			</tbody>
		</table>
	</div>
