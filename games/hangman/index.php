

<?php

include '../../header_controller.php';

require_once 'hangman.php';
require_once 'userlife.php';

$dbconnection=mysqli_connect("localhost", "root", "rastacrise92","web320final") or die ('cannot connect to DB');
$connection= mysqli_select_db($dbconnection, "words");

?>


<html>
	<head>
		<title>Hangman</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="../../libs/bootstrap-3.2.0/css/bootstrap.min.css">
        
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="../../libs/bootstrap-3.2.0/js/bootstrap.js"></script>
        <script src="../../js/index.js"></script>

        <?php 
            $root_path = "../../";
            include('../../header.php');
        ?>


<?php 

    // if userlife is stored in the session
    if (isset($_SESSION['hangman_game'])) {
        $game = $_SESSION['hangman_game'];
    } else { // if the user life is not stored in the session
        $game = new hangman(null);
        $game->newGame();
    }





?>




    </head>
	
    <body>


    <?php echo var_dump($game) ?>
    <div class="container">
    <div class="tabs-row">
        <ul class="nav nav-tabs tabs">
            <li class="active"><a href="#game-pane" class="active">Game</a></li>
            <li><a href="#settings-pane">Settings</a></li>
            <li><a href="#scores-pane">Scores</a></li>
        </ul>
    </div>
    
    <div class="tab-content">
        <div id="game-pane" class="tab-pane active">
            <div class="typing_game_container">
               <div id="content">
		<form action="" method="POST"> 
		<h2>Hangman</h2>
		<?php
            $game->playGame();
        ?>
		</form>
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
        </div>
		
	</body>
</html>



