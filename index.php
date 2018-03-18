<?php include('includes/database.php'); ?>
<?php

    //Create the select query
    $query = "SELECT 
              users.id,
              users.first_name,
              users.last_name,
              users.email,
              customer_adresses.address,
              customer_adresses.city,
              customer_adresses.state,
              customer_adresses.zip
              
              FROM users
              INNER JOIN customer_adresses 
              ON customer_adresses.customer = users.id
              ORDER BY join_date DESC ";

    //Get result
    $result = $mysqli->query($query) or die($mysqli->error." ".__LINE__); //__LINE__ shows the line no. we are getting the error at

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>CManager | Dashboard</title>
    <style type="text/css">


        .msg{padding: 3px;background:#f4f4f4;color:green;font-size: 16px; }

    </style>
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
              <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add_customer.php">Add Customer</a>
            </li>
          </ul>
        </nav>
        <h3 class="text-muted">Store CManager</h3>
      </header>

      <main role="main">


        <div class="row marketing">
          <div class="col-lg-12">
            <?php
            if (isset($_GET["msg"]))
              echo "<div class = msg>".$_GET["msg"]."</div>";
            ?>
            <h2> Customers </h2>
            <table class="table table-striped">
                <tr>
                  <th>Customer Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th></th>
                    <th></th>
                </tr>
                <?php

              //Check if at least 1 row is found
                $finalResult=array();
                    if ($result->num_rows > 0){
                    //Loop through results
                    //while ($row = $result->fetch_assoc()){
                        // OR
                    //while ($row = mysqli_fetch_assoc($result)){
                        // OR
                    while ($row = mysqli_fetch_array($result)){
                        //Display customer info
                        $output ="<tr>";
                        $output .= "<td>".$row["first_name"]." ".$row["last_name"]. " </td>";
                        $output .= "<td>".$row["email"]."</td>";
                        $output .= "<td>".$row["address"]. " ". $row["city"]. " ".$row["state"]."</td>";
                        $output .= "<td><a href='edit_customer.php?id=".$row['id']. "' class='btn btn-primary btn-sm'>Edit </a></td>";
                        $output .= "<td><a href='delete_customer.php?id=".$row['id']. "' class='btn btn-primary btn-sm'>Remove </a></td>";

                        $output .= "</tr>";



                        /*
                       echo '<tr>
                       <td>'.$row["first_name"].' '.$row["last_name"]. ' </td>
                       <td>'.$row["email"].'</td>
                       <td>'.$row["address"]. ' '. $row["city"]. ' '.$row["state"].'</td>
                       <td><a href=\"edit_customer.php?id="'.$row["id"].'class="btn btn - primary btn - sm\">Edit </a></td>
                       </tr>

                       ';

                        */


                        //Echo output
                        echo $output;

                    }

                    }

                    else
                        echo "Sorry, no customers were found";

                ?>

            </table>
          </div>

         
        </div>

      </main>

      <footer class="footer">
        <p>&copy; Company 2017</p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
