<?php
/* __________________________REGISTER PAGE, MAY 17TH 2016, SQUIDDER INK_______________________ */
    // First we execute our common code to connection to the database and start the session
    require("common.php");

    // This if statement checks to determine whether the registration form has been submitted
    // If it has, then the registration code is run, otherwise the form is displayed
    if(!empty($_POST))
    {
        // Ensure that the user has entered a non-empty username
        if(empty($_POST['username']))
        {
            // Note that die() is generally a terrible way of handling user errors
            // like this.  It is much better to display the error with the form
            // and allow the user to correct their mistake.  However, that is an
            // exercise for you to implement yourself.
            die("Please enter a username.");
        }

        // Ensure that the user has entered a non-empty password
        if(empty($_POST['password']))
        {
            die("Please enter a password.");
        }

        // Make sure the user entered a valid E-Mail address
        // filter_var is a useful PHP function for validating form input, see:
        // http://us.php.net/manual/en/function.filter-var.php
        // http://us.php.net/manual/en/filter.filters.php
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            die("Invalid E-Mail Address");
        }

        // We will use this SQL query to see whether the username entered by the
        // user is already in use.  A SELECT query is used to retrieve data from the database.
        // :username is a special token, we will substitute a real value in its place when
        // we execute the query.
        $query = "
            SELECT
                1
            FROM users
            WHERE
                username = :username
        ";

        // This contains the definitions for any special tokens that we place in
        // our SQL query.  In this case, we are defining a value for the token
        // :username.  It is possible to insert $_POST['username'] directly into
        // your $query string; however doing so is very insecure and opens your
        // code up to SQL injection exploits.  Using tokens prevents this.
        // For more information on SQL injections, see Wikipedia:
        // http://en.wikipedia.org/wiki/SQL_Injection
        $query_params = array(
            ':username' => $_POST['username']
        );

        try
        {
            // These two statements run the query against your database table.
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
            die("Failed to run query: " . $ex->getMessage());
        }

        // The fetch() method returns an array representing the "next" row from
        // the selected results, or false if there are no more rows to fetch.
        $row = $stmt->fetch();

        // If a row was returned, then we know a matching username was found in
        // the database already and we should not allow the user to continue.
        if($row)
        {
            die("This username is already in use");
        }

        // Now we perform the same type of check for the email address, in order
        // to ensure that it is unique.
        $query = "
            SELECT
                1
            FROM users
            WHERE
                email = :email
        ";

        $query_params = array(
            ':email' => $_POST['email']
        );

        try
        {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            die("Failed to run query: " . $ex->getMessage());
        }

        $row = $stmt->fetch();

        if($row)
        {
            die("This email address is already registered");
        }

        // An INSERT query is used to add new rows to a database table.
        // Again, we are using special tokens (technically called parameters) to
        // protect against SQL injection attacks.
        $query = "
            INSERT INTO users (
                username,
                password,
                salt,
                email
            ) VALUES (
                :username,
                :password,
                :salt,
                :email
            )
        ";

        // A salt is randomly generated here to protect again brute force attacks
        // and rainbow table attacks.  The following statement generates a hex
        // representation of an 8 byte salt.  Representing this in hex provides
        // no additional security, but makes it easier for humans to read.
        // For more information:
        // http://en.wikipedia.org/wiki/Salt_%28cryptography%29
        // http://en.wikipedia.org/wiki/Brute-force_attack
        // http://en.wikipedia.org/wiki/Rainbow_table
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));

        // This hashes the password with the salt so that it can be stored securely
        // in your database.  The output of this next statement is a 64 byte hex
        // string representing the 32 byte sha256 hash of the password.  The original
        // password cannot be recovered from the hash.  For more information:
        // http://en.wikipedia.org/wiki/Cryptographic_hash_function
        $password = hash('sha256', $_POST['password'] . $salt);

        // Next we hash the hash value 65536 more times.  The purpose of this is to
        // protect against brute force attacks.  Now an attacker must compute the hash 65537
        // times for each guess they make against a password, whereas if the password
        // were hashed only once the attacker would have been able to make 65537 different
        // guesses in the same amount of time instead of only one.
        for($round = 0; $round < 65536; $round++)
        {
            $password = hash('sha256', $password . $salt);
        }

        // Here we prepare our tokens for insertion into the SQL query.  We do not
        // store the original password; only the hashed version of it.  We do store
        // the salt (in its plaintext form; this is not a security risk).
        $query_params = array(
            ':username' => $_POST['username'],
            ':password' => $password,
            ':salt' => $salt,
            ':email' => $_POST['email']
        );

        try
        {
            // Execute the query to create the user
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
            die("Failed to run query: " . $ex->getMessage());
        }

        // This redirects the user back to the login page after they register
        header("Location: login.php");

        // Calling die or exit after performing a redirect using the header function
        // is critical.  The rest of your PHP script will continue to execute and
        // will be sent to the user if you do not die or exit.
        die("Redirecting to login.php");
    }

?>
</div> <!-- ends here -->

   
    
</form> <!-- -->


<style>
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
        .panel{
	    background-color: rgba(245, 245, 245, 0.1);
        }
	}
</style>
<!-- above is the how the background was added, the image -->
<!-- BOOTSTRAP -->
<!-- Custom font from Google -->
<link href='https://fonts.googleapis.com/css?family=Alegreya+Sans' rel='stylesheet' type='text/css'>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    

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
            </div>  <!-- the icon for squitter, the ink drop -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav"> <!-- what is in the navbar, the different buttons which redirect your to a specific page -->
                <li><a href="about.php">About Us</a></li>
                <li><a href="help.php">Help</a></li>
                <li><a href="login.php">Login <span class="sr-only">(current)</span></a></li>
                 <li class="active"><a href="register.php">Register</a></li> <!--the active is how it darkens so you know what page you are on -->
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
<br><br><br>




        <!-- End of the HTML form that appears in the browser -->

<div class="container">
        <div class="row">
        <div class="col-md-7” >
        <div class="panel panel-success">
        <div class="panel-heading">
            Please Register your username, email and password.
        </div>
        <div class="panel-body">
            Once you have registered, login for the fun!
        </div>
        </div>
        </div>
        </div>


    <div class="col-md-6" >
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Register</h3>
        </div>
    <div class="panel-body">       
    <form action="register.php" method="post">
        <div class="input-group">
        Username:<br />
        <input type="text" name="username" value="" />
        <br /><br />
        E-Mail:<br />
        <input type="text" name="email" value="" />
        <br /><br />
        Password:<br />
        <input type="password" name="password" value="" />
        <br /><br />
        <input type="submit" value="Register" class="btn btn-success center-block">
        </div>
    </form>
    </div>
    </div>
    </div>

</div>
<!-- End of the login form that appears in the browser -->







</body>

