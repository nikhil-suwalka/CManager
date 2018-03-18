<?php include('includes/database.php'); ?>
<?php

if ($_POST){ //to check if form is submitted
    $first_name = mysqli_real_escape_string($mysqli, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($mysqli, $_POST["last_name"]);
    $email = mysqli_real_escape_string($mysqli, $_POST["email"]);
    $password = md5(mysqli_real_escape_string($mysqli, $_POST["password"])); // md5  -to encrypt the password
    //echo $password;
    $address = mysqli_real_escape_string($mysqli, $_POST["address"]);
    $city = mysqli_real_escape_string($mysqli, $_POST["city"]);
    $state = mysqli_real_escape_string($mysqli, $_POST["state"]);
    $zipcode = mysqli_real_escape_string($mysqli, $_POST["zip"]);


    //$dd = date("Y-m-d"); //date column is set by default
    //create customer query
    $query = "INSERT INTO users (first_name, last_name, email, password)
              VALUES ('$first_name', '$last_name', '$email', '$password')";

    //Run query

    $mysqli ->query($query) or die($mysqli->error. " ".__LINE__);

    $query = "SELECT id FROM users WHERE first_name = '$first_name' LIMIT 1";
    $result = $mysqli->query($query) or die($mysqli->error." ".__LINE__); //__LINE__ shows the line no. we are getting the error at

    //Get the customer id
    $output = 100;
    while ($row = mysqli_fetch_array($result)){
        $output = $row["id"];

    }
    echo $output;


    //create address query
    $query = "INSERT INTO customer_adresses (customer, address, city, state, zip)
              VALUES ($output, '$address', '$city', '$state', '$zipcode')"; //$mysqli->insert_id can be used instear of $output

    //Run query

    $mysqli ->query($query) or die($mysqli->error." ".__LINE__);


    $msg = "Customer Added";
    header("Location: index.php?msg=".urlencode($msg).""); //?msg to show some message in index
    exit;

}



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>CManager | Add Customer</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">
    <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/67704677-3063-5142-AA2E-39311A24A375/main.js" charset="UTF-8"></script></head>

<body>

<div class="container">
    <header class="header clearfix">
        <nav>
            <ul class="nav nav-pills float-right">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="add_customer.php">Add Customer</a>
                </li>
            </ul>
        </nav>
        <h3 class="text-muted">Store CManager</h3>
    </header>

    <main role="main">


        <div class="row marketing">
            <div class="col-lg-12">
                <h2>Add Customers </h2>

                <form method="post" action="add_customer.php">
                    <div class="form-group">
                        <label>First Name</label>
                        <input name="first_name" type="text" class="form-control" placeholder="Enter First Name">
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input name="last_name" type="text" class="form-control" placeholder="Enter Last Name">
                    </div>

                    <div class="form-group">
                        <label>Email address</label>
                        <input name="email" type="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Enter Password">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input name="address" type="text" class="form-control" placeholder="Enter Address">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input name="city" type="text" class="form-control" placeholder="Enter City">
                    </div>

                    <div class="form-group">
                        <label>State</label>
                        <input name="state" type="text" class="form-control" placeholder="Enter State">
                    </div>

                    <div class="form-group">
                        <label>Zipcode</label>
                        <input name="zip" type="text" class="form-control" placeholder="Enter Zipcode">
                    </div>

                    <input type="submit" class="btn btn-default" value="Add Customer"/>
                </form>


            </div>

        </div>

    </main>

    <footer class="footer">
        <p>&copy; Company 2017</p>
    </footer>

</div> <!-- /container -->
</body>
</html>
