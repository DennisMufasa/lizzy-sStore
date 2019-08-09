
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>sell</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<style>
    table{
        margin-top: 10%;
        width: 80%;
        margin-left: 10%;
    }
    button{
        background: rgb(121, 158, 228);
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
    <!-- <table border="3">
        <tr>
            <th>product name</th>
            <th>product category</th>
            <th>product cost</th>
            <th>quantity</th>
        </tr>
        <tr>
            <td>Chealsey boots</td>
            <td>Mens shoes</td>
            <td>4500</td>
            <td>
                <form action="" method="GET">
                    
                    <center>
                        <input type="number" name="qty" placeholder="enter quantity" required><br><br>
                        <button type="submit" name="submit">Buy</button></center>
                </form>
            </td>
        </tr>
    </table> -->


</body>
</html>

<?php

//database connection
$serverName = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'lizzy';

$con = mysqli_connect($serverName, $username, $password, $database) or die(mysqli_connect_error());


/*
searching for a product from the inventory(database)
capture user input when submit button is clicked and query the database
*/
if(isset($_REQUEST['search'])){
  //capture user input
  extract($_REQUEST);
  
  //query db
  $sql = "SELECT `productId`, `productName`, `category`, `unitCost`, `retail_cost`, `quantity` FROM `inventory` WHERE `productName`='$name'";

  //save result in a variable
  $result = mysqli_query($con, $sql);

  //check for empty result set
  if(mysqli_num_rows($result) > 0){
    //convert the mysqli result object to a php associative array
    
    $row = mysqli_fetch_assoc($result);
    $_SESSION['data'] = $row;
    
    ?>

    <table border='3'>
        <tr>
            <th>product name</th>
            <th>product category</th>
            <th>selling price</th>
            <th>purchase details</th>
        </tr>
        <tr><?php echo "
            <td>". $row['productName'] ."</td>
            <td>". $row['category'] ."</td>
            <td>". $row['retail_cost'] ."</td>
            <td>";?>
                <form action='sale.php' method='GET'>
                    
                    <center>
                        <input type='number' name='qty' placeholder='enter quantity' required><br><br>
                        <input type='number' name='income' placeholder='transaction income' required><br> <small style='font-size: 15px;  ' class='text-info'>* how much money did you make?</small> <br><br>
                        <button type='submit' name='submit'>Buy</button></center>
                </form>
            </td>
        </tr>
    </table>

    
    <?php

  }else{
    echo "<center class='text-danger' style='margin-top: 9%; margin-left: 25%; width: 50%; font-size: 3Vmax;'>That product does not exist in your inventory!</center>";
  }
}


//create sales
if(isset($_REQUEST['submit'])){
  //capture use input
  extract($_REQUEST);

  $product_dets = $_SESSION['data'];

  $sql_name = $product_dets['productName'];
  $sql_category = $product_dets['category'];
  $sql_cost = $product_dets['unitCost'];
  $expected_sale = $sql_cost * $qty;

  // calculate profit and loss
if($income > $expected_sale){
  $profit = $income - $expected_sale;
  $loss = 0;
}else{
  $profit = 0;
  $loss = $expected_sale - $income;
}

  
  $update_inventory_qty = ($product_dets['quantity'] - $qty);
  

  //query db
  $sql_sales = "INSERT INTO `sales`(`productName`, `category`, `unitCost`, `quantity`, `profit`, `loss`, `income`) VALUES ('$sql_name', '$sql_category', '$sql_cost', '$qty','$profit', '$loss', '$income')";
  $sql_update_inventory = "UPDATE `inventory` SET `quantity`='$update_inventory_qty' WHERE `productName`='$sql_name'";
  //execute query
if ($qty > $product_dets['quantity']){
  echo "<center class='text-info' style='margin-top: 9%; margin-left: 25%; width: 50%; font-size: 3Vmax;'>Purchase Cancelled. The inventory doesn't have that many $sql_name(s)!</center>";
  
}else{
  if(mysqli_query($con, $sql_sales)){
    mysqli_query($con, $sql_update_inventory);
    echo "<center class='text-info' style='margin-top: 9%; margin-left: 25%; width: 50%; font-size: 3Vmax;'>New sale of a $sql_name was successfully posted!</center>";
  }else{
    echo "oops...something went wrong!".mysqli_error($con);
  }
}
unset($_SESSION['data']);
session_destroy();
}




?>