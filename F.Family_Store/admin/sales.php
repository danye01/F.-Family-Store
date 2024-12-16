<?php include('includes/header.php'); ?>

<?php


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable
$message = "";
$error = false;

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs
    $product_name = htmlspecialchars($_POST['product_name']);
    $quantity = filter_var($_POST['quantity'], FILTER_VALIDATE_INT);
    $price_per_unit = filter_var($_POST['price_per_unit'], FILTER_VALIDATE_FLOAT);
    $total_sales = filter_var($_POST['total_sales'], FILTER_VALIDATE_FLOAT);

    // Check for empty or invalid fields
    if (!$product_name || $quantity === false || $price_per_unit === false || $total_sales === false) {
        $message = "All fields are required, and inputs must be valid.";
        $error = true;
    } else {
        // Prepare SQL query
        $query = "INSERT INTO sales (product_name, quantity, price_per_unit, total_sales) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("sidd", $product_name, $quantity, $price_per_unit, $total_sales);

            if ($stmt->execute()) {
                $message = "Sales data recorded successfully!";
                $error = false;
            } else {
                $message = "Error: " . $stmt->error;
                $error = true;
            }

            $stmt->close();
        } else {
            $message = "Error preparing statement: " . $conn->error;
            $error = true;
        }
    }
}

// Close the connection after usage
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Entry Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            max-width: 100%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .form-container input,
        .form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
        .message {
            margin: 15px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Enter Sales Data</h2>
        <?php if (!empty($message)): ?>
            <div class="message <?php echo $error ? 'error' : 'success'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">

        
          <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>

            <label for="price_per_unit">Price per Unit:</label>
            <input type="number" id="price_per_unit" name="price_per_unit" step="0.01" required>

            <label for="total_sales">Total Sales Amount:</label>
            <input type="number" id="total_sales" name="total_sales" step="0.01" required>

            <button type="submit">Submit Sales</button>
        </form>
    </div>
</body>

<?php include('includes/footer.php'); ?>
</html>
