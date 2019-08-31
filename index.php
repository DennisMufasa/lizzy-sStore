<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>home</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<style>
section{
  margin-top: 10px;
}
    table{
        margin-top: 10%;
        width: 80%;
        margin-left: 10%;
    }
    button{
        background: rgb(121, 158, 228);
    }

    iframe{
      margin-top: 65px;
    }

    #faba{
      position: absolute;
      top: 1px;
      left: 185px;
    }

    #faba:hover{
      text-decoration: none;
    }
    #twit{
      position: absolute;
      top: 1px;
      left: 100px;
    }

    #twit:hover{
      text-decoration: none;
    }

/* .carousel{

  width: 700px;
  height: 400px;
} */

.carousel .carousel-inner .item img{
  width: 600px;
  height: 300px;
}


    .marquee{
      width: 450px;
      margin: 0 auto;
      white-space: nowrap;
      overflow: hidden;
      box-sizing: border-box;
      
    }
    .marquee span{
      display: inline-block;
      padding-left: 100%;
      text-indent: 0;
      font-size: 2vmax;
      animation: marquee 10s infinite;
    }
    .marquee span:hover {
    animation-play-state: paused;
}
/* Make it move */
@keyframes marquee {
    0%   { transform: translate(0, 0); }
    100% { transform: translate(-100%, 0); }
}
</style>

</head>
<body style="background: rgb(235, 229, 211);">
  
  <!-- nav bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="" width="60%"></a>
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
                        <a class="dropdown-item" href="update_cost.php">update buying price</a>
                        <a class="dropdown-item" href="update_category.php">update product category</a>
                        <a class="dropdown-item" href="update_retail_cost.php">update selling price</a>

          </div>
        </li>
        
      </ul>
      <form class="form-inline my-2 my-lg-0" action="sale.php" method="GET">
        <input class="form-control mr-sm-2" name="name" type="search" placeholder="Search" aria-label="Search" required>
        <button class="btn btn-outline-success my-2 my-sm-0" name="search" type="submit">Search</button>
      </form>
    </div>
  </nav>

<!-- marquee -->
<section>
<h1 class="marquee text-primary"><span>Store Manager</span></h1>
</section>


<section class="row">

<div class="col-3">
<center>
<h3 class="text-info">current total profit:</h3>

<?php

//database connection
$serverName = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'lizzy';

$con = mysqli_connect($serverName, $username, $password, $database) or die(mysqli_connect_error());

$sql_total_profit = "SELECT SUM(`profit`) AS `sum` FROM `sales`";

$sql_low_quantity = "SELECT `productName`, `quantity` FROM `inventory` WHERE `quantity` <= 5";

// execute total profit query and save results in a variable
$result = mysqli_query($con, $sql_total_profit);

// check for empty result
if(mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_assoc($result);

  // echo "<p class='text-info' style='font-size: 1.5vmax;'><b><i>KSH ".$row['sum']."</i></b></p>";

  $_SESSION['profit'] = $row['sum'];

}else{
  echo "
  <script>
  alert('opps something went wrong!".mysqli_error($con)."');
  </script>
  ";
}

// query to get total loss
$sql_total_loss = "SELECT SUM(`loss`) AS `loss` FROM `sales`";

// execute query and save result in a variable
$result3 = mysqli_query($con, $sql_total_loss);

// chech empty result set
if(mysqli_num_rows($result3) > 0){
  $row3 = mysqli_fetch_assoc($result3);
  $total_profit = $_SESSION['profit'] - $row3['loss'];

  echo "<p class='text-info' style='font-size: 1.5vmax;'><b><i>KSH ".$total_profit."</i></b></p>";
  

}else{
  echo "
  <script>
  alert('opps something went wrong!".mysqli_error($con)."');
  </script>
  ";
}



echo "<h3 class='text-info'>products running low:</h3>";

// execute low product qauntity and save results in a variable
$result2 = mysqli_query($con, $sql_low_quantity);

// check for empty results
if(mysqli_num_rows($result2) > 0){

  echo "<table border=1>
          <tr class='bg-info'>
            <th>product name</th>
            <th>items in-stock</th>
          </tr>
  
  ";
  while($row2 = mysqli_fetch_assoc($result2)){
    echo "<tr><td>".$row2['productName']."</td>
          <td>".$row2['quantity']."</td></tr>";
  }
echo "</table>";
  

}else{
  // echo "
  // <script>
  // alert('');
  // </script>
  // ";
  echo "<p class='text-info'>Inventory is well stacked and ready for business. I will inform you of any products whose quantity is running low!</p>";
}


?>


</center>
</div>



<div class="col-6">
<div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <!-- <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="5"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="6"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="7"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="8"></li> -->

    </ol>
    <div class="carousel-inner">

      <div class="carousel-item active">
        <img src="images/open.jpg" class="d-block w-100" alt="official shirts">
        
      </div>

      <div class="carousel-item">
        <img src="images/store.jpg" class="d-block w-100" alt="casual shirts">
        
      </div>



    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
</div>



<div class="col-3">

<center>

<div style="display: flex;">
<a id="faba" href="https://www.facebook.com">
<img src="images/faba.png" alt="faba">
<br>
<small class="text-info">facebook</small></a>

<a id="twit" href="https://www.twitter.com">
<img src="images/twit.png" alt="faba">
<br>
<small class="text-info">twitter</small></a>

<iframe src="https://www.nation.co.ke/" frameborder="0" style="height: 700px;"></iframe>
</div>
</center>

</div>

</section>

</body>
</html>

