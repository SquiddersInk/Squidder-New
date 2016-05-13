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
		        <li><a href="login.php">Login <span class="sr-only">(current)</span></a></li>
		        <li><a href="register.php">Register</a></li>
		      </ul>
		      <!-- This is the Search Form -->
		      <form class="navbar-form navbar-left" role="search" action="<?=$_SERVER['PHP_SELF']?>" method="post">
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


<div class='container'>
<div class='row'>
	<div class="col-md-8" padding='150px'>
		<br><br><br><br>

		<!--==========================-->
		<!-- This is the input panel -->
		<!--==========================-->


		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
	   	<div class="grid">
		    <div class="row">
	  			<div class="col-lg-12">
		    	<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1">Enter your message</span>
					  <input type="text" name="content" class="form-control" placeholder="Don't forget to use hashtags!  #forgetful" aria-describedby="basic-addon1">


						<div class="input-group-btn">
					  	<input type="submit" name="submit" class="btn btn-success center-block">
					  	</div>
					</div>
					<br>
					<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">What's Up?</span>
							<textarea type="text" name="timestamp" class="span6 form-control" rows="3" placeholder="Ex: I won silver at the national championships!" aria-describedby="basic-addon1"></textarea>
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
						<textarea type="text" name="timestamp" class="span6 form-control" rows="2" placeholder="Ex: I won silver at the national championships!" aria-describedby="basic-addon1"></textarea>
					  <div class="input-group-btn">
					  <input type="submit" name="submit" class="btn btn-lg btn-success center-block">
					  </div>
					</div>
					</div>
				</div>
			</div>
		    </form>


	<?php
		// determine current table
		// if (isset($_POST['room'])) {
		// 	$current = 'posts';
		// } else if (isset($_POST['room2'])){ 
		// 	$current = 'posts2';
		// } else if (isset($_POST['room3'])){ 
		// 	$current = 'posts3';
		// } else if (isset($_POST['room4'])){ 
		// 	$current = 'posts4';
		// } else if(isset($_POST['room'])){
		// 	$current = 'posts';
		// }
		
		// if (isset($_POST['switchroom'])) { // startIF
		// 	$selectedRoom = $_POST['room'];
		// 	$current = $selectedRoom;
		// }


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
					echo "<p>".$row[0]."</p>";
					echo "<p>".$row[1]."</p>";
					echo "<p>".$row[2]."</p>";
					echo "<p>".$row[3]."</p>";
					echo "<a href=".$_SERVER['PHP_SELF']."?id=".$row[0]." class='btn btn-danger'>Delete</a>";
				} else {
					echo "<div class = 'panel panel-info'>";
					echo "<div class='panel-heading'> On ".$row[3].", ".$row[1]." said: </div>";
					echo "<div class='panel-body'>";
					echo "<p>".$row[0]."</p>";
					echo "<p>".$row[1]."</p>";
					echo "<p>".$row[2]."</p>";
					echo "<p>".$row[3]."</p>";

					echo "<a href=".$_SERVER['PHP_SELF']."?id=".$row[0]." class='btn btn-danger'>Delete</a>";
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

	</div>
		<!--==================================-->
		<!-- This is the room switch panel    -->
		<!--==================================-->
		<div class="col-md-4">
			<br><br><br><br>
			<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Select Chatroom</h3>
					</div>
				<div class="panel panel-body">
					<div class="input-group">
						<form role="search" action="<?=$_SERVER['PHP_SELF']?>" method="post">
							
							<input type="checkbox" class="btn btn-sm btn-info navbar-btn" name='room' value='posts'>Room I<br>
							
							<input type="checkbox" class="btn btn-sm btn-info navbar-btn" name='room' value='posts2'>Room II<br>
					
							<input type="checkbox" class="btn btn-sm btn-info navbar-btn" name='room' value='posts3'>Room III<br>
						
							<input type="checkbox" class="btn btn-sm btn-info navbar-btn" name='room' value='posts4'> Room IV<br>

							<button type="submit" class="btn btn-info" name='switchroom'>SWITCH</button>
							
						</form>
					</div>
				</div>
			</div>
			<!--==================================-->
			<!-- This is the search panel -->
			<!--==================================-->
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
			<?php
				require("common.php");
				$connection = mysql_connect($host, $username, $password) or die ("Unable to connect!");
				mysql_select_db($dbname) or die ("Unable to select database!");
				$search = mysql_escape_string($_POST['search']);
				if ($search != "") {
				$query = "SELECT * FROM ".posts." WHERE content LIKE '%$search%'";
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
	<!-- End of row -->


	<!-- End of the first panel -->
	<div class='row'>
		<div class="col-md-9" padding='150px'>
			<div class="alert alert-warning" role="alert">Only True Squids are capable of reading this holy scripture.</div>
		</div>
	</div>

		<!--==================================-->
		<!-- This is the search results panel -->
		<!--==================================-->
<div class='row'>
	<div class="col-md-9">
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
			$query = "SELECT * FROM ".posts." WHERE content LIKE '%$search%'";
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
				echo "<table class='table table-hover'>2";
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




	</body>
</html>