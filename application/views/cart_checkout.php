<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>>Welcome to supermarket checkout</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/script.js"></script>

</head>
<body>
<h1>Shopping Cart</h1>

<div class="shopping-cart">

  <div class="column-labels">
    <label class="product-details">Product</label>
    <label class="product-price">Price</label>
    <label class="product-quantity">Quantity</label>
    <label class="product-removal">Remove</label>
    <label class="product-line-price">Total</label>
  </div>

  <?php if (isset($products)) { 
    foreach ($products as $product) { ?>
      <div class="product">
        <div class="product-details">
          <div class="product-title"><?php echo $product->item_name; ?></div>
        </div>
        <div class="product-price"><?php echo $product->unit_price; ?></div>
        <div class="product-quantity">
          <input type="number" value="1" min="1" name = <?php echo $product->item_name; ?>>
        </div>
        <div class="product-removal">
          <button class="remove-product">
            Remove
          </button>
        </div>
        <div class="product-line-price"><?php echo $product->unit_price; ?></div>
      </div>
    <?php }
  }?>
  </div>
  <div class="totals">
    <div class="totals-item">
      <label>Subtotal</label>
      <div class="totals-value" id="cart-subtotal">71.97</div>
    </div>
    
  </div>
      
</body>
</html>