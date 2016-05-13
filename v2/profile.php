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
	</style>
	<body>
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
            <li><a href="about.php">About Us</a></li>
            <li><a href="help.php">Help</a></li>
            <li><a href="login.php">Login <span class="sr-only">(current)</span></a></li>
            <li><a href="register.php">Register</a></li>
          </ul>


          <form class="navbar-form navbar-right" action="logout.php" method="post">
            <button class="btn btn-warning">Sign out</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <?php
              require("common.php");
                $arr = array_values($_SESSION['user']);
          echo "<a href='cool.php'>Welcome, " . $arr[1] . "</a>";
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


    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
      <div class="grid">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header" id="usrnm">
              <?php
                require("common.php");
                $arr = array_values($_SESSION['user']);
                echo $arr[1];
              ?>
          </h1>

          </div>
        </div>
      </div>
    </form>
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
  		if (mysql_num_rows($result) > 0) {
      		// print them one after another
      		while($row = mysql_fetch_row($result)) {
  				$arr = array_values($_SESSION['user']);
  				if($arr[1]==$row[1]){
  					echo "<div class = 'panel panel-success'>";
  					echo "<div class='panel-heading'> On ".$row[3].", you said: </div>";
  					echo "<div class='panel-body'>";
  					echo "<p>".$row[2]."</p>";

  					//echo "<a href=".$_SERVER['PHP_SELF']."?id=".$row[0]." class='btn btn-danger'>Delete</a>";
  				} else {
  					
  					//echo "<a href=".$_SERVER['PHP_SELF']."?id=".$row[0]." class='btn btn-danger'>Delete</a>";
  				}
  				echo "</div>";
  				echo "</div>";
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
  		// check to see if user has entered anything
  		if ($content != "") {
  			$arr = array_values($_SESSION['user']);
  	 		// build SQL query
  	 		$date = date(l);
  			$query = "INSERT INTO ".posts." (user, content, date) VALUES ('$arr[1]', '$content', "."'"."$date"."'".")";
  			// run the query
       		$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
  			// refresh the page to show new update
  	 		echo "<meta http-equiv='refresh' content='0'>";
  		}
  		// if DELETE pressed, set an id, if id is set then delete it from DB
  		if (isset($_GET['id'])) {
  			// create query to delete record
  			echo $_SERVER['PHP_SELF'];
      		$query = "DELETE FROM ".posts." WHERE id = ".$_GET['id'];
  			// run the query
       		$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
  			// reset the url to remove id $_GET variable
  			$location = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  			echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
  			exit;
  		}
  		// close connection
  		mysql_close($connection);
  	?>

	</body>
</html>
