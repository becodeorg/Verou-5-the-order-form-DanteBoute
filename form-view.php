<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>BeCodeServices</title>
</head>
<body>
<div class="container">
    <h1>Place your order</h1>
    <?php // Navigation for when you need it ?>
    <nav>
        <ul class="nav">
            <li class="nav-item">
            <a class="nav-link active" href="?order=services">Order services</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="?order=products">Order products</a>
            </li>
        </ul>
    </nav>

    <form method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control"/>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" value="<?php echo $userStreet; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?php echo $userStreetNumber; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control">
                </div>
            </div>
        </fieldset>


    <?php if (isset($_GET['order']) && $_GET['order'] === 'products'): ?>
    <!-- Show product-related fields -->
    <fieldset>
        <legend>Products</legend>
        <?php foreach ($products as $i => $product): ?>
        <label>
            <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
            &euro; <?= number_format($product['price'], 2) ?></label><br />
    <?php endforeach; ?>
    </fieldset>
        

    <?php elseif (isset($_GET['order']) && $_GET['order'] === 'services'): ?>
    <!-- Show service-related fields -->
    <fieldset>
        <legend>Services</legend>
        <?php foreach ($services as $i => $service): ?>
            <label>
                <input type="checkbox" value="1" name="services[<?php echo $i ?>]"/> <?php echo $service['name'] ?> -
                &euro; <?= number_format($service['price'], 2) ?></label><br />
        <?php endforeach; ?>
    </fieldset>
    <?php endif; ?>

    <button type="submit" class="btn btn-primary">Order!</button>
</form>
    <?php
// Display order details only if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    handleForm();
}
?>
    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in BeCode Services.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>
