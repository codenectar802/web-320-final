

<html>
<head>
    <link rel="stylesheet" type="text/css" href="libs/bootstrap-3.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <script src="libs/bootstrap-3.2/js/bootstrap.js"/>
    <script src="js/index.js"/>
    <?php
    	echo "Something";

     ?>


</head>
<body>
	<h1>Our Home Page Changed</h1>
	<hr>
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
		<div id="about-tab-pane" class="tab-pane active">
			<h2>This will be the about pane</h2>
		</div>
		<div id="home-tab-pane" class="tab-pane">
			<h2>This will be the home pane</h2>
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


</body>
</html>