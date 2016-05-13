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
			background: url(bg.jpg);
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
                <li><a href="login.php">Login <span class="sr-only">(current)</span></a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="about.php">About</a></li>
              </ul>
              <!-- This is the Search Form -->



              <ul class="nav navbar-nav navbar-right">
                <li>
                    <?php
                    require("common.php");
                    $arr = array_values($_SESSION['user']);
                    if ($arr[1]!=''){
                        echo "<a href='#'>Welcome, " . $arr[1] . "</a></li><li>";
                        echo '
                              <form class="navbar-form anavbar-right" action="edit.php" method="post">
                                <button class="btn btn-warning">Proceed</button>
                              </form>
                              </li>
                              </ul>';
                    } else {
                        echo "<a href='login.php'>You are not signed in. </a></li><li>";
                        echo '
                              <form class="navbar-form anavbar-right" action="register.php" method="post">
                                <button class="btn btn-warning">Register</button>
                              </form>
                              </li>
                              </ul>';
                    }
                    ?>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>



		<div class="container">
            <div class="row">
                <div class="col-lg-12">
									<br></br>
                    <h1 class="page-header" id="usrnm">Navigating Our Website</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-at fa-fw"></i> Introduction
                        </div>
                        <!-- /.panel-heading -->
                        <div class="p1">
															On this page, you will find an in-depth guide to navigating the wonders that exist within the squidder website.
                    </div>
                </div>
              </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-power-off fa-fw"></i> Logging In/Registering
                        </div>
                        <!-- /.panel-heading -->
                        <div class="p1">
                          As you enter the marvels of our website, you will be hindered by our login page. But fear not, because in meer seconds, you too, can be a proud member of Squidder Ink. After clicking the "Register" button, you will be redirected to the register page, where you can create an account and the journey will begin.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa apsojdfjsdfa-power-off fa-fw"></i> Navigating your feed.
                        </div>
                        <!-- /.panel-heading -->
                        <div class="p1">
                          As you step into the marvels of Squidder, you might be overwhelmed by the presence of so many users at the same time. But not to fear, for you too, can share with the world all of your experiences. And for your convenience, we've added a search option to search for your favourite posts/users. Then, when you are all done, after a long day of squidding, you can logout and call it a day. However, if you, lets say, wanted to admire our about/help pages, in the top right corner, the logout button is replaced by "proceed", which takes you back you your main page.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa apsojdfjsdfa-power-off fa-fw"></i> Ending
                        </div>
                        <!-- /.panel-heading -->
                        <div class="p1">
                            As you have mastered the ways of the squid, it is now time for you to show the world how great of a squid you are! For more info and help, contact the team at squidder.ink@gmail.com.
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
