<?php 

    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     
    // This variable will be used to re-display the user's username to them in the 
    // login form if they fail to enter the correct password.  It is initialized here 
    // to an empty value, which will be shown if the user has not submitted the form. 
    $submitted_username = ''; 
     
    // This if statement checks to determine whether the login form has been submitted 
    // If it has, then the login code is run, otherwise the form is displayed 
    if(!empty($_POST)) 
    { 
        // This query retreives the user's information from the database using 
        // their username. 
        $query = " 
            SELECT 
                id, 
                username, 
                password, 
                salt, 
                email 
            FROM users 
            WHERE 
                username = :username 
        "; 
         
        // The parameter values 
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
         
        try 
        { 
            // Execute the query against the database 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        // This variable tells us whether the user has successfully logged in or not. 
        // We initialize it to false, assuming they have not. 
        // If we determine that they have entered the right details, then we switch it to true. 
        $login_ok = false; 
         
        // Retrieve the user data from the database.  If $row is false, then the username 
        // they entered is not registered. 
        $row = $stmt->fetch(); 
        if($row) 
        { 
            // Using the password submitted by the user and the salt stored in the database, 
            // we now check to see whether the passwords match by hashing the submitted password 
            // and comparing it to the hashed version already stored in the database. 
            $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $check_password = hash('sha256', $check_password . $row['salt']); 
            } 
             
            if($check_password === $row['password']) 
            { 
                // If they do, then we flip this to true 
                $login_ok = true; 
            } 
        } 
         
        // If the user logged in successfully, then we send them to the private members-only page 
        // Otherwise, we display a login failed message and show the login form again 
        if($login_ok) 
        { 
            // Here I am preparing to store the $row array into the $_SESSION by 
            // removing the salt and password values from it.  Although $_SESSION is 
            // stored on the server-side, there is no reason to store sensitive values 
            // in it unless you have to.  Thus, it is best practice to remove these 
            // sensitive values first. 
            unset($row['salt']); 
            unset($row['password']); 
             
            // This stores the user's data into the session at the index 'user'. 
            // We will check this index on the private members-only page to determine whether 
            // or not the user is logged in.  We can also use it to retrieve 
            // the user's details. 
            $_SESSION['user'] = $row; 
             
            // Redirect the user to the private members-only page. 
            header("Location: edit.php"); 
            //echo '<meta http-equiv="refresh" content="0;url=http://edit.php">';
            die("Redirecting to: edit.php"); 

        } 
        else 
        { 
            // Tell the user they failed 
            echo    '<br><br><br><br>
                    <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                        <div class="alert alert-warning" role="alert">Only True Squids are capable of successfully logging in.</div>
                        </div>
                    </div>
                    </div>';
             
            // Show them their username again so all they have to do is enter a new 
            // password.  The use of htmlentities prevents XSS attacks.  You should 
            // always use htmlentities on user submitted values before displaying them 
            // to any users (including the user that submitted them).  For more information: 
            // http://en.wikipedia.org/wiki/XSS_attack 
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
     
?> 

<body></body>
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
    .h4 {
        font-family: 'Alegreya SC', serif;
        font-size: 300%;
    }
    .h1 {
        font-family: 'Alegreya SC', serif;
        font-size: 1000%;    }
</style>
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
                 <li class="active"><a href="login.php">Login <span class="sr-only">(current)</span></a></li>
                <li><a href="register.php">Register</a></li>
              </ul>
              <!-- This is the Search Form -->
              <form class="navbar-form navbar-left" role="search" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <div class="input-group">
                    <div class="input-group">
                      
                      
                      <div class="input-group-btn">
                     
                      </div>
                    </div>
                </div>
              </form>



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


<div class='container'>
<div class='row'>
<div class="col-md-4">
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <h4 class='h4'>Hey, welcome to  </h4>
    <h1 class='h1'>Squidder!</h1>
</div>
<div class="col-md-8" padding='150px'>
    <br><br><br><br>
<div class = 'panel panel-success'>
    <div class='panel-heading'>
        <h4>Login</h4> 
    </div>
    <div class='panel panel-body'>
        <form action="login.php" method="post"> 
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Username</span>
                    <input class="span6 form-control" type="text" name="username" value="<?php echo $submitted_username; ?>" /> 
                <span class="input-group-addon" id="basic-addon1">Password</span>
                    <input class="span6 form-control" type="password" name="password" value="" /> 
                <div class="input-group-btn">
                <input type="submit" value="Login" class="btn btn-success center-block">
                </div>
            </div>
        </form> 
        <a href="about.php">Forever dissappointed that a group of squids is not called a 'squad'.</a>
    </div>
</div>
</div>
</div>
</div>