<?php
include 'typing_game.php';

$typing_game = new TypingGame();

?>



<html>
<head>
	<meta charset="utf-8">
	<title>Typing Game</title>

	<link rel="stylesheet" type="text/css" href="../../libs/bootstrap-3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/index.css">
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>

    <script src="../../libs/bootstrap-3.2.0/js/bootstrap.js"></script>
    <script src="../../js/index.js"></script>
</head>

<body>
<div class="container">
	<h1>Typing Game!</h1>
	<hr>
	<div class="tabs-row">
		    <ul class="nav nav-tabs tabs">
		        <li class="active"><a href="#game-pane" class="active">Game</a></li>
		        <li><a href="#settings-pane">Settings</a></li>
		        <li><a href="#scores-pane">Scores</a></li>
		    </ul>
		</div>


		<div class="tab-content">
			<div id="game-pane" class="tab-pane active">
				<h2>This will be the game pane</h2>
			</div>
			<div id="settings-pane" class="tab-pane">
				<h2>This will be the about pane</h2>
			</div>
			<div id="scores-pane" class="tab-pane">
				<h2>This will be the matching scores pane</h2>
			</div>
		</div>
</div>
</body>



</html>