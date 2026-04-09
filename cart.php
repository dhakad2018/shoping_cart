<?php $cart = $this->session->userdata('cart'); ?>
<!DOCTYPE html>
<html>
<head>
<title>Cart</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body class="container mt-4">

<h2 class="mb-4">🛒 Your Cart</h2>

<table class="table table-bordered">
<tr>
<th>Name</th>
<th>Qty</th>
<th>Price</th>
<th>Total</th>
<th>Action</th>
</tr>

<?php $total=0; if($cart){ foreach($cart as $item){ 
$sub = $item['price']*$item['qty']; 
$total += $sub;
?>
<tr>
<td><?=$item['name']?></td>
<td><?=$item['qty']?></td>
<td>₹<?=$item['price']?></td>
<td>₹<?=$sub?></td>
<td>
<button class="btn btn-danger btn-sm"
onclick="removeItem(<?=$item['id']?>)">Remove</button>
</td>
</tr>
<?php }} ?>

</table>

<h4 class="text-end">Total: ₹<?=$total?></h4>

<hr>

<h4>Checkout</h4>

<div class="row">
<div class="col-md-4">
<input type="text" id="name" class="form-control mb-2" placeholder="Name">
<input type="text" id="mobile" class="form-control mb-2" placeholder="Mobile">
<input type="email" id="email" class="form-control mb-2" placeholder="Email">

<button class="btn btn-success w-100" onclick="checkout()">
Place Order
</button>
</div>
</div>

<script>
function removeItem(id){
    $.post("<?=base_url('cart/remove')?>",{id:id},function(){
        location.reload();
    });
}

function checkout(){
    $.post("<?=base_url('cart/checkout')?>",{
        name:$('#name').val(),
        mobile:$('#mobile').val(),
        email:$('#email').val()
    },function(res){
        window.location.href="<?=base_url('cart/success/')?>"+res.order_id;
    },'json');
}
</script>

</body>
</html>