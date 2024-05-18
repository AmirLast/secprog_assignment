<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quantity Selector</title>
<style>
    /* Some basic styling for layout */
    .quantity-selector {
        display: flex;
        align-items: center;
    }
    .quantity-label {
        margin-right: 10px;
    }
</style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="order.php">go back</a></li>
        </ul>
    </nav>

<h2>Fish n Chip</h2>
<p>How many are you ordering?</p>
    <div class="container">
        <button onclick="decreaseQuantity()">-</button>
        <span id="quantity">0</span>
        <button onclick="increaseQuantity()">+</button>
    </div>
<form action="update_order2.php" method="post">
    <input type="hidden" name="quantity" id="quantity_input">
    <input type="submit" value="Submit">
</form>

<script>
    let quantity = 0;

    function updateQuantityDisplay() {
        document.getElementById('quantity').textContent = quantity;
        document.getElementById('quantity_input').value = quantity;
    }

    function increaseQuantity() {
        quantity++;
        updateQuantityDisplay();
    }

    function decreaseQuantity() {
        if (quantity > 0) {
            quantity--;
            updateQuantityDisplay();
        }
    }
</script>

</body>
</html>