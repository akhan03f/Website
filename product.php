<?php
include_once 'Cart.class.php';
$cart = new Cart;

require_once 'dbConfig.php';
?>


<DOCTYPE! html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Containers</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+HK:wght@500&display=swap" rel="stylesheet">
  </head>

<body>
  <div class="header">
  <div class="container">
    <div class="nav">

        <navigation>
            <ul>
              <li><a href="index.html">Home</a></li>
              <li><a href="shopping.html" style="text-decoration: underline;">Shopping</a></li>
              <li><div class="logo">
                <img src="logo.png" width="170px"/>
                </div></li>
              <li><a href="about.html">About Us</a></li>
              <li><a href="contact.html">Contact</a></li>
            </ul>
        </navigation>
        <div class="cart">
          <img src="cart.png" width="24px" height="24px">
        </div>
    </div>
</div>

</div>

<div class="shop-nav-bar">
<navigation>
    <ul>
      <li><a href="containers.html" style="color: black; font-size: 14px;">Containers</a></li>
      <li><a href="cleaning.html" style="color: black; font-size: 14px;">Cleaning</a></li>
      <li><a href="bath.html" style="color: black; font-size: 14px;">Bath & Body</a></li>
      <li><a href="home.html" style="color: black; font-size: 14px;">Home & Kitchen</a></li>
    </ul>
</navigation>
</div>


<div class="cart-view">
    <a href="viewCart.php" title="View Cart"><i class="icart"></i> (<?php echo ($cart->total_items() > 0)?$cart->total_items().' Items':'Empty'; ?>)</a>
</div>

<!-- Featured Products -->
  <div class="products">
    <div class="smaller-container">
      <div class="row">
        <?php
        // Get products from database
        $result = $db->query("SELECT * FROM products");
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
        ?>
        <div class="col-3">
          <a href="product.php">
          <img src="source.php?id=1" alt="Featured Product Image">
          </a>
          <h5><b><br><a href="product.php">Glass Bottle</b></a></h5>
          <p>$11.99</p>
        </div>
        <a href="cartAction.php?action=addToCart&id=<?php echo $row["id"]; ?>" class="btn btn-primary">Add to Cart</a>

      <?php }} ?>
      </div>
    </div>
  </div>
  </div>

<!-- footer -->

  <div class="footer">
      <div class="row">
            <div class="footer-col-1">
                <h3>Download Our App</h3>
                <p>Download for Android mobile</p>
            </div>
            <div class="footer-col-2">
              <img src="logo.png" width="170px">
            </div>
            <div class="footer-col-3">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href="https://www.twitter.com" style="font-size: 12px">Twitter</a></li>
                    <li><a href="https://www.instagram.com" style="font-size: 12px">Instagram</a></li>
                    <li><a href="https://www.pinterest.com" style="font-size: 12px">Pinterest</a></li>
                    <li><a href="https://www.youtube.com" style="font-size: 12px">YouTube</a></li>
                </ul>
            </div>
            <div class="footer-col-4">
                <h3>Useful Links</h3>
                <ul>
                    <li><a href="aboutus.html" style="font-size: 12px">About US</a></li>
                    <li><a href="faq.html" style="font-size: 12px">FAQ</li>
                    <li><a href="return.html" style="font-size: 12px">Return Policy</li>
                    <li><a href="contact.html" style="font-size: 12px">Contact Us</li>
                </ul>
            </div>
          </div>
        </div>

</body>
</html>
