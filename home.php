<?php include 'header_controller.php'; ?>


<html>
<head>
    <?php
    	// set the path to the root of the project
    	$root_path = "";
    	include('header.php');
    ?>
</head>
<body>
	<div class="container">
		<div class="tabs-row">
		    <ul class="nav nav-tabs tabs">
		        <li class="active"><a href="#home-tab-pane" class="active">Home</a></li>                        
		        <li><a href="#about-tab-pane">About</a></li>
		        <li><a href="#matching-scores-tab-pane">Matching Scores</a></li>
		        <li><a href="#math-scores-tab-pane">Math Scores</a></li>
		        <li><a href="#typing-scores-tab-pane">Typing Scores</a></li>
		    </ul>
		</div>


		<div class="tab-content">
			<div id="home-tab-pane" class="tab-pane active">
				<div class="game_link_container">
					<div class="hangman_link game_link">
						<a href="games/hangman/hangman.php">
							<img src="games/hangman/images/8.jpg" alt="hangman_link"/>
							<h1>Hangman</h1>
						</a>
					</div>				
					<div class="typing_link game_link">
						<a href="games/typing/typing.php">
							<img src="games/typing/images/title_image.jpg" alt="hangman_link"/>
							<h1>Typing</h1>
						</a>
					</div>
					<div class="math_link game_link">
						<a href="games/math/math.php">
							<img src="games/math/math.jpg" alt="hangman_link"/>
							<h1>Math</h1>
						</a>
					</div>
				</div>
			</div>
			<div id="about-tab-pane" class="tab-pane">
				<h2>This will be the about pane</h2>
			</div>
			<div id="hangman-scores-tab-pane" class="tab-pane">
				
			</div>
			<div id="math-scores-tab-pane" class="tab-pane">
				<h2>This will be the math scores pane</h2>
			</div>
			<div id="typing-scores-tab-pane" class="tab-pane">
				<?php 
				    function __autoload($class_name) {
						switch ($class_name) {
							case 'Typing_Database_Handler':
								include 'games/typing/typing_database_handler.php';
								break;
							default:
								# code...
								break;
						}
					}
					$typingDBHandler = new Typing_Database_Handler();

					include'games/typing/partials/scores_pane.php' 
				?>
			</div>
		</div>
	</div>

</body>
</html>