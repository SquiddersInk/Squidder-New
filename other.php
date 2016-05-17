<!-- in this page, it will display the profile of the person that you have selected from the main page-->
<html>
	<!-- Custom font from Google -->
	<link href='https://fonts.googleapis.com/css?family=Alegreya+Sans' rel='stylesheet' type='text/css'>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<style>
		body {
			background: url(bg.jpg);
			background-repeat: no-repeats;
			background-size: cover;
		}
		.table-hover tbody tr:hover td {
		    background: lightgray;
		}
		p {
			font-family: 'Alegreya SC', serif;
		}
		.p2 {
			margin-left: 15px;
			margin-top: 15px;
			margin-right: 15px;
			font-size: 200%;
			font-weight: bold;
		}
		.p3 {
			font-size: 125%;

			text-transform: capitalize;
		}
	</style>
	<body>
		<!--below is the code for the nav bar, which contains links to all of the website's features and a sign out, and a your profile section-->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><span class="glyphicon glyphicon glyphicon-tint" aria-hidden="true"></span>Squidder</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
					  <li><a href="edit.php">Home</a></li>
            <li><a href="login.php">Login <span class="sr-only">(current)</span></a></li>
            <li><a href="register.php">Register</a></li>
						<li><a href="about.php">About Us</a></li>
				  	<li><a href="help.php">Help</a></li>
          </ul>


          <form class="navbar-form navbar-right" action="logout.php" method="post">
            <button class="btn btn-warning">Sign out</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li>
            <?php
              require("common.php");
          		echo "<a href='profile.php' class='p3'>" ."Your Profile". "</a>";
          	?>
        		</li>
        	</ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>


<div class='container'>
<div class='row'>
  <div class="col-md-8" padding='150px'>
    <br><br><br>

    <!--==========================-->
    <!-- This is the input panel -->
    <!--==========================-->

		<!--below, I have code that displays the name of the user that you have just clicked on -->
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
      <div class="grid">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header" id="usrnm">
              <?php
                require("common.php");
                echo $_GET["name"];
              ?>
          </h1>
          </div>
        </div>
      </div>
    </form>
		<!--below is the php code that displays all the posts made by that user-->
    <?php
  	    // pass in some info;
  		require("common.php");
  		if(empty($_SESSION['user'])) {
  			// If they are not, we redirect them to the login page.
  			$location = "http://" . $_SERVER['HTTP_HOST'] . "/login.php";
  			echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
  			//exit;
        // Remember that this die statement is absolutely critical.  Without it,
      	// people can view your members-only content without logging in.
        die("Redirecting to login.php");
      	}
  		// To access $_SESSION['user'] values put in an array, show user his username
  		// $arr = array_values($_SESSION['user']);
  		// open connection
  		$connection = mysql_connect($host, $username, $password) or die ("Unable to connect!");
  		// select database
  		mysql_select_db($dbname) or die ("Unable to select database!");
  		// create query, in reverse order by id
  		$query = 'SELECT * FROM posts ORDER BY id DESC LIMIT 10';
  		// execute query
  		$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
  		// see if any rows were returned
			//here is where the panels of text that the user has inputed are displayed and executed
  		if (mysql_num_rows($result) > 0) {
      		// print them one after another
      		while($row = mysql_fetch_row($result)) {
  				$arr = array_values($_SESSION['user']);
  				if($_GET["name"]==$row[1]){
            echo "<div class = 'panel panel-info'>";
  					echo "<div class='panel-heading'> On ".$row[3].", <b>".$row[1]."</b> said: </div>";
  					echo "<div class='panel-body'>";
  					echo "<p>".$row[2]."</p>";
  					echo "</div>";
  					echo "</div>";
  				} else {

					}
  			}
  		} else {
      		// print status message
      		echo "No rows found!";
  		}
  		// free result set memory
  		mysql_free_result($result);
  		// set variable values to HTML form inputs
  		$content = test_input($_POST["content"]);
  		//$content = mysql_escape_string($_POST['content']);
  		$user = mysql_escape_string($_POST['user']);
  		// form validation function
  		function test_input($data) {
  			$data = trim($data);
  			$data = stripslashes($data);
  			$data = htmlspecialchars($data);
  			return $data;
  		}
  		
  		// close connection
  		mysql_close($connection);
  	?>

	</body>
</html>
