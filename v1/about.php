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
		body {
			background: url(COOL.jpeg);
			background-repeat: no-repeats;
			background-size: cover;
		}
		.p1 {
			font-family: 'Alegreya SC', serif;
			margin-left: 15px;
			margin-top: 15px;
			margin-right: 15px;
			margin-bottom: 15px;
			font-size: 125%;
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
		        <li class="active"><a href="login.php">Login Page<span class="sr-only">(current)</span></a></li>
		        <li><a href="edit.php">Home</a></li>

		      </ul>
		      <!-- This is the Search Form -->



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



		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
									<br></br>
                    <h1 class="page-header" id="usrnm">Squidder InKoporated</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-at fa-fw"></i> Our Mission
                        </div>
                        <!-- /.panel-heading -->
                        <div class="p1">
															Here at Squidder Inkoporated, we strive to provide only the best service to our clients. Our design provides a warm and welcoming interface that facilitates many hours of endless fun. You asked for a great looking website? You got one. You wanted to save all of your data and be able to search for it at a moments notice? We've got you covered. Anything other suggestions, you can contact us at squidder.ink@gmail.com.
                        </div>
                    </div>
                </div>
            </div>
						<h1 class="page-header" id="usrnm">Our Developers:</h1>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-power-off fa-fw"></i> Surin Rao
                        </div>
                        <!-- /.panel-heading -->
                        <div class="p1">
													Surin "Rao"ster Rao, our main github manager, always brings his enthusiastic attitude to our group. Apart from working on the github, he is also in charge of our login and register pages to ensure that our users experience a fluid sign-up process.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa apsojdfjsdfa-power-off fa-fw"></i> Zhuoen Dai
                        </div>
                        <!-- /.panel-heading -->
                        <div class="p1">
													Zhuoen "Squidster" Dai, our supreme overlord coder and also a github manager. He is the lead design behind our main user page after they log in.
                        </div>
                    </div>
                </div>
            </div>
						<div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-power-off fa-fw"></i> Geoffrey Jiang
                        </div>
                        <!-- /.panel-heading -->
                        <div class="p1">
													Geoffrey "Jianger" Jiang, has the roles of assistant coder, github manager, and morale-booster supremeo. He created the about page and the help page and he helps around with the other coding responsities.
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->




	<div class="col-md-9" padding='150px'>
		<br><br><br><br>
	</div>




	</body>
</html>
