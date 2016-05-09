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
		.table-hover tbody tr:hover td {
		    background: lightgray;
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
		        <li class="active"><a href="login.php">Login <span class="sr-only">(current)</span></a></li>
		        <li><a href="register.php">Register</a></li>
		      </ul>
		      <!-- This is the Search Form -->
		      <form class="navbar-form navbar-left" role="search" action="<?=$_SERVER['PHP_SELF']?>" method="post">
		        <div class="input-group">
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1">Search</span>
					  <input type="text" name="search" class="form-control" placeholder="Ex: Ink" aria-describedby="basic-addon1">
					  <div class="input-group-btn">
					  <input type="submit" name="submit" class="btn btn-success">
					  </div>
					</div>
		    	</div>
		      </form>



		      <form class="navbar-form navbar-right" action="logout.php" method="post">
		      	<button class="btn btn-warning">Sign out</button>
		      </form>
		      <ul class="nav navbar-nav navbar-right">
		        <li>
		        	<?php
		        	require("common.php");
		            $arr = array_values($_SESSION['user']);
					echo "<a href='#'>Welcome, " . $arr[1] . "</a>";
					?>
				</li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>




	<div class="col-md-9" padding='150px'>
		<br><br><br><br>


	<!--==================================-->
	<!-- This is the search results panel -->
	<!--==================================-->
	<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Search Results</h3>
			</div>

		<!-- This is the Search function -->
	<?php
		require("common.php");
		$connection = mysql_connect($host, $username, $password) or die ("Unable to connect!");
		mysql_select_db($dbname) or die ("Unable to select database!");
		$search = mysql_escape_string($_POST['search']);
		$query = "SELECT id,country FROM symbols WHERE animal LIKE '%$search%'";
		$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
		if (mysql_num_rows($result) > 0) {
    		// print them one after another
    		echo "<table class='table table-hover'>";
    		echo "<th>Index</th><th>Country</th>";
    		while($row = mysql_fetch_row($result)) {
        		echo "<tr>";
				echo "<td>".$row[0]."</td>";
				echo "<td>" . $row[1]."</td>";
        		echo "</tr>";
    		}
		    echo "</table>";
		} else {
			
    		// print status message
    		echo "<table class='table table-hover'>";
    		echo "<tr>";
			echo "<td>"."No results match your search!"."</td>";
    		echo "</tr>";
    		echo "</table>";
		}
	?>

	</div>

		<!--==========================-->
		<!-- This is the input panel -->
		<!--==========================-->
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Database Entries And Submission</h3>
			</div>
		<div class="panel-body">

<<<<<<< HEAD
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
	   	<div class="grid">
		    <div class="row">
	  			<div class="col-lg-12">
		    	<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Title</span>
				  <input type="text" name="country" class="form-control" placeholder="Ex: #swimming" aria-describedby="basic-addon1">
					<div class="input-group-btn">
				  <input type="submit" name="submit" class="btn btn-success center-block">
				  </div>
				</div>
				</div>
			</div>
		</div>
		</form>
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		   	<div class="grid">
			    <div class="row">
		  			<div class="col-lg-12">
			    	<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">What's Up?</span>
						<textarea type="text" name="animal" class="span6 form-control" rows="3" placeholder="Ex: I won silver at the national championships!" aria-describedby="basic-addon1"></textarea>
					  <div class="input-group-btn">
					  <input type="submit" name="submit" class="btn btn-success center-block">
					  </div>
					</div>
					</div>
				</div>
			</div>
		    </form>
=======

>>>>>>> origin/master
		</div>

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
		// create query
		$query = "SELECT * FROM symbols";
		$query2 = "SELECT * FROM users";
		// execute query
		$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
		$result2 = mysql_query($query2) or die ("Error in query: $query2. ".mysql_error());
		// see if any rows were returned
		if (mysql_num_rows($result) > 0) {
    		// print them one after another
    		echo "<table class='table table-hover'>";
    		echo "<th>User</th><th>Title</th><th>Text</th><th></th>";
    		while($row = mysql_fetch_row($result)) {
						echo "<tr>";
						//$row[0] = array_values($_SESSION['user']);
						echo "<td>".$row[3]."</td>";
        		echo "<td>" .$row[1]."</td>";
        		echo "<td>".$row[2]."</td>";
						echo "<td><a href=".$_SERVER['PHP_SELF']."?id=".$row[0]." class='btn btn-danger'>Delete</a></td>";
        		echo "</tr>";
    		}
		    echo "</table>";
		} else {

    		// print status message
    		echo "No rows found!";
		}
		// free result set memory
		mysql_free_result($result);
		// set variable values to HTML form inputs
		$country = mysql_escape_string($_POST['country']);
    	$animal = mysql_escape_string($_POST['animal']);
			$id = mysql_escape_string($_POST['id']);

		// check to see if user has entered anything
		if ($animal != "") {
			$arr = array_values($_SESSION['user']);
	 		// build SQL query
			$query = "INSERT INTO symbols (user, country, animal) VALUES ('$arr[1]', '$country', '$animal')";
			// run the query
     		$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
			// refresh the page to show new update
	 		echo "<meta http-equiv='refresh' content='0'>";
		}

		// if DELETE pressed, set an id, if id is set then delete it from DB
		if (isset($_GET['id'])) {
			// create query to delete record
			echo $_SERVER['PHP_SELF'];
    		$query = "DELETE FROM symbols WHERE id = ".$_GET['id'];
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
	<!-- End of the first panel -->

	<div class="alert alert-success" role="alert">Yay!</div>


		<!--==================================-->
		<!-- This is the search results panel -->
		<!--==================================-->
	<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Search Results</h3>
			</div>

		<!-- This is the Search function -->
	<?php
		require("common.php");
		$connection = mysql_connect($host, $username, $password) or die ("Unable to connect!");
		mysql_select_db($dbname) or die ("Unable to select database!");
		$search = mysql_escape_string($_POST['search']);
		if ($search != "") {
		$query = "SELECT * FROM symbols WHERE animal LIKE '%$search%'";
		$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
		}
		if (mysql_num_rows($result) > 0) {
    		// print them one after another
    		echo "<table class='table table-hover'>";
    		echo "<th>User</th><th>Text</th>";
    		while($row = mysql_fetch_row($result)) {
        		echo "<tr>";
						echo "<td>".$row[3]."</td>";
						echo "<td>" . $row[1]."</td>";
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




	</body>
</html>
