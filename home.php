<?php include 'header_controller.php'; ?>


<html>
<head>
    <link rel="stylesheet" type="text/css" href="libs/bootstrap-3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>

    <script src="libs/bootstrap-3.2.0/js/bootstrap.js"></script>
    <script src="js/index.js"></script>

    <?php include('header.php'); ?>

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
				<div class="hangman_link game_link">
					<h1>Hangman</h1>
				</div>
				<div class="typing_link game_link">
					<h1>Typing</h1>
				</div>
				<div class="math_link game_link">
					<h1>Math</h1>
				</div>
			</div>
			<div id="about-tab-pane" class="tab-pane">
				<h2>This will be the about pane</h2>
			</div>
			<div id="matching-scores-tab-pane" class="tab-pane">
				<h2>This will be the matching scores pane</h2>
			</div>
			<div id="math-scores-tab-pane" class="tab-pane">
				<h2>This will be the math scores pane</h2>
			</div>
			<div id="typing-scores-tab-pane" class="tab-pane">
				<h2>This will be the typing scores pane</h2>
			</div>
		</div>
	</div>

</body>
</html>