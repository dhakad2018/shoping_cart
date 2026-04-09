<!DOCTYPE html>
<html>
<head>
<title>Success</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container text-center mt-5">

<div class="card p-5 shadow">
    <h2 class="text-success">🎉 Order Placed Successfully</h2>
    <h4>Your Order ID: <?=$order_id?></h4>

    <a href="<?=base_url()?>" class="btn btn-primary mt-3">
        Continue Shopping
    </a>
</div>
</body>
</html>