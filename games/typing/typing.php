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
    function __autoload($class_name) {
    	switch ($class_name) {
    		case 'TypingGame':
    			include 'typing_game.php';		
    			break;
    		case 'Typing_Database_Handler':
    			include 'typing_database_handler.php';
    			break;
    		default:
    			# code...
    			break;
    	}
	}


	$typingDBHandler = new Typing_Database_Handler();


    if(!isset($_SESSION['typing_game'])) {
    	$typing_game = new TypingGame(null);
    	if(isset($_POST['typing_control_input'])) {
    		$typing_control_input = $_POST['typing_control_input'];
    	}
    } else {
    	$typing_game = $_SESSION['typing_game'];

    	if(isset($_POST['typing_control_input'])) {
    		$typing_control_input = $_POST['typing_control_input'];
    		switch ($typing_control_input) {
    			case 'start':
    				$typing_game->start_new_game($_POST['difficulty']);
    				break;
    			case 'stop':
    				$old_typing_game = $typing_game;	
    				break;
    			case 'reset':
    				$typing_game = new TypingGame(null);
    				break;
    			default:
    				echo "Should not have hit this...";
    				break;
    		}
    	} elseif (isset($_POST['user_typing_input'])) {
    		$success = $typing_game->play_turn($_POST['user_typing_input']);
    		if ($typing_game->hearts == 0) {
    			$old_typing_game = $typing_game;
    			$typing_game = new TypingGame(null);
    		}
    	}

    	if(isset($_POST['save_game_input'])) {
  			if ($_POST['save_game_input'] == 'Save') {
    			$typingDBHandler->store_score($_POST['userid'],$_POST['difficulty'],$_POST['score']);
    		}  		
    	}

  
    }


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
					<div class="pull-right">Score: <b><?php echo $typing_game->score ? $typing_game->score : "XXX"; ?></b></div>
					<div class="heart_container pull-right">
						<?php 
							if(isset($typing_game->hearts)) {
								for ($i=0; $i < $typing_game->hearts; $i++) { 
									echo "<span class='glyphicon glyphicon-heart' aria-hidden='true'></span>";
								}
						}?>
					</div>
					<div class="pull-left">Round: <b>
						<?php echo $typing_game->round_num ? $typing_game->round_num : "XXX"; ?> 
					</b></div>
					<div class="timer_container">
						<div class="timer">
							<?php echo $typing_game->target_time ? $typing_game->target_time : "000"; ?>
						</div>
					</div>
				</div>
				<br>
				<div class="middle_row">
					<div class="typing_control_container pull-right">
						<form method="post" accept-charset="utf-8">
							<ul class="typing_controls list-unstyled">
							<li>
								

							</li>

	<?php 
		if($typing_game->get_target_string()) {
			echo "<li>
					<button type='submit' name='typing_control_input' value='stop' class='stop_button'>Stop</button>
				</li>";
		} else {
			echo "<li>
					<input type='radio' name='difficulty' value='easy' checked> Easy
					<input type='radio' name='difficulty' value='medium'> Medium
					<input type='radio' name='difficulty' value='hard'> Hard<br>
					<button type='submit' name='typing_control_input' value='start' class='start_button'>Start</button>
				</li>";
		}

	?>
								<li>
									<button type="submit" name="typing_control_input" value="reset" class="reset_button">Reset</button>
								</li>
							</ul>
						</form>
					</div>
					<div class="target_text_container"><?php echo $typing_game->get_target_string(); ?></div>
				</div>
				<div class="bottom_row">
					<div class="user_typing_input_container">
						<form method="post" accept-charset="utf-8" id="user_typing_form">
							<input 	id="user_typing_input"
									type="text" 
									name="user_typing_input" 
									placeholder="Start Typing..." 
									>
						</form>
					</div>
				</div>
			</div>

		</div>
		<div id="settings-pane" class="tab-pane">
			<h2>Choose difficulty. Im using easy medium and hard</h2>
		</div>
		<div id="scores-pane" class="tab-pane">
			<?php include('partials/scores_pane.php'); ?>
		</div>
	</div>
</div>

<div class="modal fade" id="typingResultsModal" tabindex="-1" role="dialog" aria-labelledby="typingResultsModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="typingResultsLabel">Results</h4>
			</div>
			<div class="modal-body">
				<h3>Score: <?php if(isset($old_typing_game)){echo $old_typing_game->score; } ?></h3>
				<h3>Round Number: <?php if(isset($old_typing_game)){echo $old_typing_game->round_num; } ?></h3>
				<h3>Difficulty: <?php if(isset($old_typing_game)){echo $old_typing_game->difficulty; } ?></h3>

				<h3>Username: <?php if(isset($old_typing_game)){echo $user_login_manager->user->get_fullname(); } ?></h3>
				<form action="" method="POST" accept-charset="utf-8">
					<input type="hidden" name="score" value="<?php if(isset($old_typing_game)){echo $old_typing_game->score; } ?>">
					<input type="hidden" name="difficulty" value="<?php if(isset($old_typing_game)){echo $old_typing_game->difficulty; } ?>">
					<input type="hidden" name="userid" value="<?php if(isset($old_typing_game)){echo $user_login_manager->user->get_id(); } ?>">
					<input type="submit" name="save_game_input" value="Save"></input>
					<input type="submit" name="save_game_input" value="Discard"></input>
				</form>
			</div>
		</div>
	</div>
</div>


</body>

<?php $_SESSION['typing_game'] = $typing_game ?>

<?php 

	echo "<script type='text/javascript'>";
		    if(isset($old_typing_game)) {
		    	echo "$('#typingResultsModal').modal('show');";
		    } 
		        
	echo "</script>";

?>

<script src='typing.js'></script>
</html>