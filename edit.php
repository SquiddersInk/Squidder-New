<!---in this file, we have the code for the main page of the our website, here, we will be having a page that displays all the posts and has a search function that you use to find posts and users. -->
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
			color:white;
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
			text-transform: capitalize;;
		}
		.panel{
	    background-color: rgba(245, 245, 245, 0.1);
		}
		.alert{
	    background-color: rgba(245, 245, 245, 0.1);
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
		      	<li><a href="about.php">About Us</a></li>
		      	<li><a href="help.php">Help</a></li>
		        <li><a href="login.php">Login <span class="sr-only">(current)</span></a></li>
		        <li><a href="register.php">Register</a></li>
		      </ul>

			<!--here is the button to logout -->
		      <form class="navbar-form navbar-right" action="logout.php" method="post">
		      	<button class="btn btn-warning">Sign out</button>
		      </form>
		      <ul class="nav navbar-nav navbar-right">
		        <li>
				<?php
				require("common.php");
				$arr = array_values($_SESSION['user']);
				echo "<a href='profile.php'>".$arr[1]."'s profile". "</a>";
				?>
			</li>
		      </ul>
		    </div>
		  </div>
		</nav>
		<!-- End Nav Bar -->
		

<!-- contain the panels -->
<div class='container'>
<!-- Row for the input panel -->
<div class='row'>
	<!-- column for input panel -->
	<div class="col-md-8" padding='150px'>
		<br><br><br>

		<!--==========================-->
		<!-- This is the input panel -->
		<!--==========================-->

		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
	   	<div class="grid">
		    <div class="row">
	  			<div class="col-lg-12">
	  				<h1 class="page-header" id="usrnm">Squidder</h1>
		    	<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1">Enter your message</span>
					  <input type="text" name="content" class="form-control" placeholder="Don't forget to use hashtags!  #forgetful" aria-describedby="basic-addon1">


						<div class="input-group-btn">
					  	<input type="submit" name="submit" class="btn btn-success center-block">
					  	</div>
					</div>
					</div>
				</div>
				<br>
			</div>
		</form>

	<!--In this code, it gets the data from the database and the table with all the user posts is created. -->
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
					// print the date
					echo "<div class='panel-heading'> On ".$row[3].", you said: </div>";
					echo "<div class='panel-body'>";
					// print the message
					echo "<p>".$row[2]."</p>";
					echo "</div>";
					echo "</div>";

					//echo "<a href=".$_SERVER['PHP_SELF']."?id=".$row[0]." class='btn btn-danger'>Delete</a>";
				} else {
					echo "<div class = 'panel panel-info'>";
					// print the date
					echo "<div class='panel-heading'> On ".$row[3].", <a href='other.php?name=$row[1]'>".$row[1]."</a> said: </div>";
					echo "<div class='panel-body'>";
					// print the message
					echo "<p>".$row[2]."</p>";
					echo "</div>";
					echo "</div>";

					//echo "<a href=".$_SERVER['PHP_SELF']."?id=".$row[0]." class='btn btn-danger'>Delete</a>";
				}
				// echo "</div>";
				// echo "</div>";
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
		// here, when the user inputs a post, it inputs into the database which user had posted it
		if ($content != "") {

	 		// build SQL query
	 		$date = date(l);
			$query = "INSERT INTO ".posts." (user, content, date) VALUES ('$arr[1]', '$content', "."'"."$date"."'".")";
			// run the query
			$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
			// refresh the page to show new update
			echo "<meta http-equiv='refresh' content='0'>";

		} else {
				echo "no";
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

	</div>
		<!-- beside input column, have search panel -->
		<div class="col-md-4">
			<br><br><br>

			<!--==================================-->
			<!-- This is the search panel -->
			<!--==================================-->
			<!--here is the search function, and this is where the search bar is displayed, but not where it runs-->
			<h1 class="page-header" id="usrnm">Search</h1>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Search Results</h3>
					</div>
					<div class="panel panel-body">
					<!-- This is the Search Form -->
					<form role="search" action="<?=$_SERVER['PHP_SELF']?>" method="post">
						<div class="input-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">Search posts</span>
							<input type="text" name="search" class="form-control" placeholder="Ex: Ink" aria-describedby="basic-addon1">
							<div class="input-group-btn">
							<input type="submit" name="submit" class="btn btn-success">
							</div>
						</div>
						</div>
					</form>


			<!-- This is the Search function -->
			<!--here is where the search executes and based on what the user searchs, the code searchs the database for a match and displays the matches in a table-->
			<?php
				require("common.php");
				$connection = mysql_connect($host, $username, $password) or die ("Unable to connect!");
				mysql_select_db($dbname) or die ("Unable to select database!");
				$search = mysql_escape_string($_POST['search']);
				if ($search != "") {
				$query = "SELECT * FROM ".posts." WHERE content LIKE '%$search%' or user LIKE '%$search%'";
				$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
				}
				if (mysql_num_rows($result) > 0) {
		    		// print them one after another
		    		echo "<table class='table table-hover'>";
		    		echo "<th>User</th><th>Text</th>";
		    		while($row = mysql_fetch_row($result)) {
		        		echo "<tr>";
								echo "<td>".$row[1]."</td>";
								echo "<td>".$row[2]."</td>";
		        		echo "</tr>";
		    		}
				    echo "</table>";
				} else if (mysql_num_rows($result) == 0 && $search != "") {
					echo "<table class='table table-hover'>";
					echo "<tr>";
					echo "<td>"."No results match your search!"."</td>";
					echo "</tr>";
					echo "</table>";
				}
				else {
		    		// print status message
		    		echo "<table class='table table-hover'>";
		    		echo "<tr>";
				echo "<td>".""."</td>";
		    		echo "</tr>";
		    		echo "</table>";
				}
			?>
					</div>
				</div>
			</div>
		</div>
	<!-- End of main top row -->

	<!-- ========= -->
	<!-- Fun panel -->
	<div class='row'>
		<div class="col-md-8" padding='150px'>
			<div class="alert" role="alert"><p>Only True Squids are capable of reading this holy scripture.</p></div>
		</div>
	</div>
	<!-- ========= -->

</div>
<!-- close container -->
</body>
</html>
