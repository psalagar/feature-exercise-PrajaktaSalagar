<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>>Welcome to supermarket checkout</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#name" ).autocomplete({
      source: "<?php echo base_url('supermarket/get_autocomplete/?');?>",
      select: function (event, ui) {
    var label = ui.item.label;
    var value = ui.item.value;
    $.ajax({
        url: 'supermarket/get_product_details',
        data: {'title': label}, 
        type: "post",
        success: function(data){
            var parsed_data = JSON.parse(data);
            $("#item_id").val(parsed_data[0].id);
           $("#unit_price").val(parsed_data[0].unit_price);
        }
      });
  }
    });
    $("#quantity").keyup(function(){
     var item_id=$("#item_id").val();
     var item_quantity=$(this).val();
     $.ajax({
        url: 'supermarket/check_special_price',
        data: {'item_id': item_id,'item_quantity': item_quantity}, 
        type: "post",
        success: function(data){
            var parsed_data = JSON.parse(data);       
           
            $("#special_price").val(parsed_data.special_price);
            $("#price").val(parsed_data.price);
           $("#unit_price").val(parsed_data.unit_price);
        }
      });
  });
  } );
  
  </script>
</head>
<body>

<div id="shopping-cart">
<div class="txt-heading"><h2>Supermarket Checkout</h2></div>

<?php
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;" width="5%">Quantity</th>
<th style="text-align:left;" width="10%">Unit Price</th>
<th style="text-align:left;" width="10%">Special price</th>
<th style="text-align:left;" width="10%">Price</th>
</tr>	
				<tr>
                <input type="hidden" name="item_id" class="item_id" id="item_id">
				<td><input type="text" name="product_name" class="tags" id="name"></td>
				<td><input type="text" name="product_quantity" class="quantity" id="quantity"></td>
				<td style="text-align:right;"><input type="text" name="unit_price" class="unit_price" id="unit_price"></td>
				<td  style="text-align:right;"><input type="text" name="special_price" class="special_price" id="special_price"></td>
				<td  style="text-align:right;"><input type="text" name="price" class="price" id="price"></td>
				</tr>

<!--<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>-->
</tbody>
</table>
</div>
</body>
</html>