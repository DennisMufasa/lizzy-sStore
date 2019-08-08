<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>inventory</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<style>
    table{
        
        width: 80%;
        margin: auto;
        font-size: 25px;
    }
    button{
        background: rgb(121, 158, 228);
    }
    small{
      font-size: 15px;
      margin: 0, auto;
    }
</style>

</head>
<body style="background: rgb(235, 229, 211);">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="index.php"><span style="color: orange;">Lizzy's Store</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="inventory.php">Inventory</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="sales.php" >Sales</a>
                          </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        more
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="add_product.php">add product</a>
                        <a class="dropdown-item" href="delete.php">delete product</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="update_quantity.php">update product quantity</a>
                        <a class="dropdown-item" href="update_cost.php">update product cost</a>
                        <a class="dropdown-item" href="update_category.php">update product category</a>
                        <a class="dropdown-item" href="update_retail_cost.php">update retail cost</a>

                      </div>
                    </li>
                    
                  </ul>
                  <form class="form-inline my-2 my-lg-0" action="sale.php" method="GET">
                    <input class="form-control mr-sm-2" name="name" type="search" placeholder="Search" aria-label="Search" required>
                    <button class="btn btn-outline-success my-2 my-sm-0" name="search" type="submit">Search</button>
                  </form>
                </div>
              </nav>              

<?php

//database connection
$serverName = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'lizzy';

$con = mysqli_connect($serverName, $username, $password, $database) or die(mysqli_connect_error());

//fetch products from inventory
$sql = "SELECT * FROM `inventory`";

//save results in a php object
$result = mysqli_query($con, $sql);

//check for empty results
if(mysqli_num_rows($result) > 0){
echo "<center>
<p class='text-info' style='margin-top: 10px; font-size: 3Vmax;'>Inventory</p>
    <table border='3'>
      <tr class='bg-info'>
        <th>product id</th>
        <th>product name</th>
        <th>category</th>
        <th>details</th>
        <th>unit cost <br> <small>buying price</small></th>
        <th>retail price <br> <small>selling price</small></th>
        <th>quantity</th>
      </tr>";
  while($row = mysqli_fetch_assoc($result)){
        echo "<tr>
              <td>". $row['productId'] ."</td>
              <td>". $row['productName'] ."</td>
              <td>". $row['category'] ."</td>
              <td>". $row['details'] ."</td>
              <td>". $row['unitCost'] ."</td>
              <td>". $row['retail_cost'] ."</td>
              <td>". $row['quantity'] ."</td></tr>";
  }
  echo "</table></center>";
}else{
  echo "<center class='text-info' style='margin-top: 9%; margin-left: 25%; width: 50%; font-size: 3Vmax;'>Inventory is empty!</center>";
}

?>

</body>
</html>