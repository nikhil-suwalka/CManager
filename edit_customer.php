<?php include('includes/database.php'); ?>
<?php
    //Assign get variable
    $id = $_GET['id']; //get user id form url

    //Create customer select query

    $query = "SELECT * FROM users
              INNER JOIN customer_adresses
              ON customer_adresses.customer = users.id
              WHERE users.id = $id";

    $result = $mysqli->query($query) or die ($mysqli->error." ".__LINE__);

    if ($result = $mysqli->query($query)){
        //Fetch object array
        while ($row = $result->fetch_assoc()){
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $email = $row['email'];
            $password = $row['password'];
            $address = $row['address'];
            $city = $row['city'];
            $state = $row['state'];
            $zipcode = $row['zip'];

        }
        //Free Result set
        $result->close();


    }



?>


<?php


if ($_POST) { //to check if form is submitted
//Assign get variable
    $id = $_GET['id']; //get user id form url

    $first_name = mysqli_real_escape_string($mysqli, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($mysqli, $_POST["last_name"]);
    $email = mysqli_real_escape_string($mysqli, $_POST["email"]);
    $password = md5(mysqli_real_escape_string($mysqli, $_POST["password"])); // md5  -to encrypt the password
    $address = mysqli_real_escape_string($mysqli, $_POST["address"]);
    $city = mysqli_real_escape_string($mysqli, $_POST["city"]);
    $state = mysqli_real_escape_string($mysqli, $_POST["state"]);
    $zipcode = mysqli_real_escape_string($mysqli, $_POST["zip"]);


    //Create customer update
    $query = "UPDATE users
              SET
              first_name = '$first_name',
              last_name = '$last_name',
              email = '$email',
              password = '$password'
              WHERE id=$id   
              ";
    $mysqli->query($query) or die($mysqli->error. " ".__LINE__);

    //Create address update
    $query = "UPDATE customer_adresses
              SET
              address = '$address',
              city = '$city',
              state = '$state',
              zip = '$zipcode'
              WHERE customer = $id
              ";


    $mysqli->query($query) or die($mysqli->error. " ".__LINE__);

    $msg = "Customer Updated";
    header("Location:index.php?msg=".urlencode($msg)."");
    exit;


}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>CManager | Edit Customer</title>

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
                <h2>Edit Customers </h2>

                <form method="post" action="edit_customer.php?id=<?php echo $id; ?>">
                    <div class="form-group">
                        <label>First Name</label>
                        <input name="first_name" type="text" class="form-control"
                               value="<?php echo $first_name ?>" placeholder="Enter First Name">
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input name="last_name" type="text" class="form-control"
                               value="<?php echo $last_name ?>"placeholder="Enter Last Name">
                    </div>

                    <div class="form-group">
                        <label>Email address</label>
                        <input name="email" type="email" class="form-control"
                               value="<?php echo $email ?>" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control"
                               value="<?php echo $password ?>"placeholder="Enter Password">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input name="address" type="text" class="form-control"
                               value="<?php echo $address ?>"placeholder="Enter Address">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input name="city" type="text" class="form-control"
                               value="<?php echo $city ?>"placeholder="Enter City">
                    </div>

                    <div class="form-group">
                        <label>State</label>
                        <input name="state" type="text" class="form-control"
                               value="<?php echo $state ?>" placeholder="Enter State">
                    </div>

                    <div class="form-group">
                        <label>Zipcode</label>
                        <input name="zip" type="text" class="form-control"
                               value="<?php echo $zipcode ?>" placeholder="Enter Zipcode">
                    </div>

                    <input type="submit" class="btn btn-default" value="Update Customer"/>
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
