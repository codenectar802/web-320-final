<?php
include "../../header_controller.php";
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Typing Game</title>    
    <?php
    	// set the path to the root of the project
    	$root_path = "../../";
    	include($root_path.'header.php');
    ?>
    <link rel="stylesheet" type="text/css" href="../../css/typing.css">
<?php
    include 'typing_game.php';
?>

</head>

<body>
<div class="container">
	
	<div class="tabs-row">
		<div class="game_name pull-right"><div>Typing Master</div></div>
	    <ul class="nav nav-tabs tabs">
	        <li class="active"><a href="#game-pane" class="active">Game</a></li>
	        <li><a href="#settings-pane">Settings</a></li>
	        <li><a href="#scores-pane">Scores</a></li>
	    </ul>
	</div>


	<div class="tab-content">
		<div id="game-pane" class="tab-pane active">
			<div class="typing_game_container">
				<div class="stat_row">
					<div class="pull-right">Score: <b>99</b></div>
					<div class="pull-left">Round: <b>0</b></div>
					<div class="timer_container">
						<div id="timer">
							5
						</div>
					</div>
				</div>

				<div class="middle_row">
					<div class="typing_control_container">
						<form method="post" accept-charset="utf-8">
							<ul class="typing_controls list-unstyled pull-right">
								<li>
									<button type="submit" name="typing_control_input" value="start" class="start_button">Start</button>
								</li>
								<br>
								<li>
									<button type="submit" name="typing_control_input" value="stop" class="stop_button">Stop</button>
								</li>
							</ul>
						</form>
					</div>
					<div class="target_text_container">
						Target text will go here...
					</div>
				</div>
				<div class="bottom_row">
					<div class="user_typing_input_container">
						<form method="post" accept-charset="utf-8" id="user_typing_form">
							<input type="text" name="user_typing_input" placeholder="Start Typing..." id="user_typing_input">
						</form>
					</div>
				</div>
			</div>

		</div>
		<div id="settings-pane" class="tab-pane">
			<h2>Choose difficulty. Im using easy medium and hard</h2>
		</div>
		<div id="scores-pane" class="tab-pane">
			<div class="alltime_highscores">
				<h4>Hard Highscores</h4>
				<table class="table table-striped">
					<tr><th></th><th>User</th><th>Score</th><th>Number of Rounds</th><th>Date</th></tr>
					<tbody>
						<tr>
							<td>1</td><td>UsernameXXXX</td><td>678</td><td>23</td><td>11/20/2038</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="hard_highscores">
				<table class="table table-striped">
					<h4>Hard Highscores</h4>
					<tr><th></th><th>User</th><th>Score</th><th>Number of Rounds</th><th>Date</th></tr>
					<tbody>
						<tr>
							<td>1</td><td>UsernameXXXX</td><td>678</td><td>23</td><td>11/20/2038</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div>

			</div>
			<div>

			</div>
		</div>
	</div>
</div>
</body>



</html>