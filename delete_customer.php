
<?php include('includes/database.php'); ?>
<?php

$id = $_GET['id'];

$query = "SELECT first_name, last_name FROM users WHERE id = '$id'";

$result = $mysqli->query($query) or die ($mysqli->error." ".__LINE__);
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
    }
}

if (isset($_POST['Yes'])){

    $query = "DELETE FROM users WHERE id = $id";
    $mysqli ->query($query) or die($mysqli->error. " ".__LINE__);

    $query = "DELETE FROM customer_adresses WHERE customer = $id";


    $mysqli ->query($query) or die($mysqli->error. " ".__LINE__);


    $msg = "Customer Removed";
    header("Location:index.php?msg=".urlencode($msg)."");
    exit;

}


if (isset($_POST['No'])){

    $msg = "Customer Not Removed";
    header("Location:index.php?msg=".urlencode($msg)."");
    exit;

}

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>CManager | Remove Customer</title>

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
                    <a class="nav-link " href="add_customer.php">Add Customer</a>
                </li>
            </ul>
        </nav>
        <h3 class="text-muted">Store CManager</h3>
    </header>


    <main role="main">


        <div class="row marketing">
            <div class="col-lg-12">
                <h2>Remove Customer </h2>

                <form method="post" action="delete_customer.php?id=<?php echo $id; ?>">


        <br><br>

        <h3> Do you want to remove <?php echo $first_name ?>  </h3>
                    <form action="delete_customer.php" method="post">
                    <input type="submit" name="Yes" value="Yes" class="btn-success" >
                    <input type="submit" name="No" value="No" class="btn-link" >
                    </form>

            </div>
        </div>

    </main>
</div>
</body>

</html>
