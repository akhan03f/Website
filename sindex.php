<?php
  session_start();

  $server = "itec315.frostburg.edu";
  $username = "akhan03";
  $pass = "3125589";
  $DBname = "akhan03";

  $DBConnection = mysqli_connect($server, $username, $pass, $DBname);
  if (!$DBConnection)
  {
    die("Connection Error: " . mysqli_connect_error());
  }

?>

<DOCTYPE! html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>The Reusable Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+HK:wght@500&display=swap" rel="stylesheet">
    <title>Shopping</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>

<body>
  <div class="header">
  <div class="container">
    <div class="nav">

        <navigation>
            <ul>
              <li><div class="hov"><a href="index.html">Home</a><div></li>
              <li><a href="shopping.html" style="text-decoration: underline;">Shopping</a></li>
              <li><div class="logo">
                <img src="logo.png" width="170px">
                </div></li>
              <li><a href="about.html">About Us</a></li>
              <li><a href="contact.html">Contact</a></li>
            </ul>
        </navigation>
<!--        <div class="cart">
          <img src="cart.png" width="24px" height="24px">
        </div>
    </div> -->
</div>
<div class="row">

  <div class="col">
      <h1>Shop All Products</h1>
    <div class="shopping-nav">
      <ul>
        <h2>
        <li><a>Containers</a></li>
        <li><a>Cleaning Supplies</a></li>
        <li><a>Bath & Body</a></li>
        <li><a>Home & Kitchen</a></li>
        </h2>
      </ul>
      <br><br><br><br><br><br>
    </div>
  </div>

  <div class="col">
    <br>
  <table cellspacing="0" cellpadding="20px" border="0">

      <tr>
          <td style="text-align: center;">

              <img src="https://cdn.pixabay.com/photo/2015/06/27/16/35/honey-823614_1280.jpg" alt="" style="width: 74%"/>

          </td>
          <td style="text-align: center;">

              <img src="https://live.staticflickr.com/65535/50742478477_d9645f59b6_b.jpg" alt="" style="width: 91%"/>

          </td>
      </tr>

      <tr>
          <td style="text-align: center;">

              <img src="https://cdn.pixabay.com/photo/2016/02/19/10/40/soaps-1209344_1280.jpg" alt="" width="74%"/>

          </td>
          <td style="text-align: center;">

              <img src="home.jpg" alt="Home" style="width: 92%" />

          </td>
      </tr>
  </table>

  <br><br><br>
  </div>

</div>
    <div class="smaller-container">
        <div class="row">
            <div class="col-7">
            <div class="row">

<?php

$SQL = "SELECT * FROM products";
$result = mysqli_query($DBConnection, $SQL);
while($row = mysqli_fetch_assoc($result)) {

?>


<div class="col-3 text-center mt-5">

    <img src="images/<?php echo $row['image']?>" alt="">
    <h5><?php echo $row['name']?></h5>
    <h7>$<?php echo $row['price']?></h7>

    <div class="Quant">
        <label>Quantity: </label>
        <select class="form" id="quantity<?php echo $row['id']?>">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>

        <input type="hidden" id="name<?php echo $row['id']?>" value='<?php echo $row['name']?>'>
        <input type="hidden" id="price<?php echo $row['id']?>" value='<?php echo $row['price']?>'>

        <div class="small-btn">
          <button class='btn btn-danger add' data-id="<?php echo $row['id']?>">Add to Cart</button>
        </div>

    </div>

</div>






<?php } ?>

</div>
            </div>
            <div class="col-1">

            </div>
            <div class="col-4">
            <h5 class='text-center'> Checkout</h5>
            <div id="displayCheckout">
            <?php
                if(!empty($_SESSION['cart'])){
                    $output = '';
                    $total = 0;
                    $output .= "<table class='table table-bordered'><thead><tr><td>Name &nbsp</td><td>Price &nbsp</td><td>Quantity &nbsp</td><td>Remove &nbsp</td> </tr></thead>";
                    foreach($_SESSION['cart'] as $key => $value){
                        $output .= "<tr><td>".$value['p_name']."</td><td>".($value['p_price'] * $value['p_quantity']) ."</td><td>".$value['p_quantity']."</td><td><button id=".$value['p_id']." class='btn btn-danger delete'>Delete</button></td></tr>";
                        $total = $total + ($value['p_price'] * $value['p_quantity']);
                    }
                    $output .= "</table>";
                    $output .= "<div class='text-center'><b>Total: $".$total."</b></div>";
                    echo $output;
                }

?>

            </div>
            </div>
        </div>



    </div>


    <script>
    $(document).ready(function() {
         alldeleteBtn = document.querySelectorAll('.delete')
         alldeleteBtn.forEach(onebyone => {
            onebyone.addEventListener('click',deleteINsession)
         })

function deleteINsession(){
    removable_id = this.id;
    $.ajax({
                url:'cart.php',
                method:'POST',
                dataType:'json',
                data:{
                      id_to_remove:removable_id,
                      action:'remove'
                },
                success:function(data){
                        $('#displayCheckout').html(data);
           alldeleteBtn = document.querySelectorAll('.delete')
         alldeleteBtn.forEach(onebyone => {
            onebyone.addEventListener('click',deleteINsession)
         })
                      }
              }).fail( function(xhr, textStatus, errorThrown) {
        alert(xhr.responseText);
    });

}


        $('.add').click(function() {
            id = $(this).data('id');
            name = $('#name' + id).val();
            price = $('#price' + id).val();
            quantity = $('#quantity' + id).val();
              $.ajax({
                url:'cart.php',
                method:'POST',
                dataType:'json',
                data:{
                      cart_id : id,
                      cart_name : name,
                      cart_price : price,
                      cart_quantity : quantity,
                      action:'add'
                },
                success:function(data){
                        $('#displayCheckout').html(data);
                        alldeleteBtn = document.querySelectorAll('.delete')
         alldeleteBtn.forEach(onebyone => {
            onebyone.addEventListener('click',deleteINsession)
         })
                      }
              }).fail( function(xhr, textStatus, errorThrown) {
        alert(xhr.responseText);
    });

        })
    })
    </script>

</body>

</html>


<?php


mysqli_close($DBConnection);


?>
