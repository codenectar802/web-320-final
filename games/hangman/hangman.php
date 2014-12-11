
<?php
include '../../header_controller.php';
require_once 'hangmanGame.php';
?>


<html>
    <head>
        <title>Hangman</title>
        
        

        <?php 
            $root_path = "../../";
            include('../../header.php');
            $dbconnection=mysqli_connect("localhost", "root", "root","web320final") or die ('cannot connect to DB');
            $connection= mysqli_select_db($dbconnection, "words");
        ?>

        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="../../libs/bootstrap-3.2.0/css/bootstrap.min.css">
        

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
        
        
        <div id="scores-pane" class="tab-pane">
            <div class="alltime_highscores">
                <h4> Highscores</h4>
                <table class="table table-striped">
                    <tr><th></th><th>User</th><th>Score</th></tr>
                    <tbody>
                    <tr>
                        <td><?php if(isset($scored)){echo $scored->score; } ?></td><td></td><td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            
                  
                </table>
            </div>
            <div>
            </div>
        </div>
        
    </body>
</html>
