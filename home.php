<!DOCTYPE html>
<html>
<head>
<title>Shopping Cart</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
.card:hover{
    transform: scale(1.05);
    transition: 0.3s;
}
</style>

</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <h4 class="text-white">My Shop</h4>
    <a href="<?=base_url('cart/cart')?>" class="btn btn-warning">
        Cart 🛒
    </a>
</nav>

<div class="container mt-4">
    <div class="row">

        <?php foreach($products as $p){ ?>
        <div class="col-md-3 mb-4">
            <div class="card shadow">

                <!-- <img src="<?=base_url('assets/images/'.$p->image)?>" 
                     class="card-img-top" 
                     style="height:200px; object-fit:cover;"> -->
                     <img src="<?=$p->image ?>" 
                     class="card-img-top" 
                     style="height:200px; object-fit:cover;">

                <div class="card-body text-center">
                    <h5><?=$p->name?></h5>
                    <p class="text-success fw-bold">₹<?=$p->price?></p>

                    <button class="btn btn-success w-100"
                        onclick="addToCart(<?=$p->id?>)">
                        Add to Cart
                    </button>
                </div>

            </div>
        </div>
        <?php } ?>

    </div>
</div>

<script>
function addToCart(id){
    $.post("<?=base_url('cart/add')?>",{id:id},function(){
        alert("Product Added ✅");
    });
}
</script>

</body>
</html>