<?php

include ('../config/function.php');

if(!isset($_SESSION['productItems']))
{
    $_SESSION['productItems'] = [];
}

if(!isset($_SESSION['productItemIds']))
{
    $_SESSION['productItemIds'] = [];
}



if (isset($_POST['addItem'])) {

    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']);

    $checkProduct = mysqli_query($conn,"SELECT * FROM products WHERE id='$productId' LIMIT 1");

    if($checkProduct)
    {
        if(mysqli_num_rows($checkProduct) > 0)
        {
            $row = mysqli_fetch_assoc($checkProduct);
            if($row['quantity'] < $quantity)
            {
                redirect('order-create.php', 'Only "' .$row['quantity']. '" Available in the Product "'.$row['name'].'"');
            }

            $productData = [
                'product_id' => $row['id'],
                'name' => $row['name'],
                'image' => $row['image'],
                'price' => $row['price'],
                'quantity' => $quantity,
            ];

            if(!in_array($row['id'], $_SESSION['productItemIds']))
            {
                array_push($_SESSION['productItemIds'], $row['id']);
                array_push($_SESSION['productItems'], $productData);
            }
            else
            {
                foreach($_SESSION['productItems'] as $key => $prodSessionItem)
                {
                    if($prodSessionItem['product_id'] == $row['id'])
                    {
                        $newQuantity = $prodSessionItem['quantity'] + $quantity;

                        $productData = [
                            'product_id'=> $row['id'],
                            'name'=> $row['name'],
                            'image'=> $row['image'],
                            'price'=> $row['price'],
                            'quantity'=> $newQuantity,
                        ];

                        $_SESSION['productItems'][ $key ] = $productData;
                    }
                }
            }
            redirect('sales-view.php', 'Item "'.$row['name'].'" is Added');
        }
        else
        {
            redirect('order-create.php', 'No Product Found !');
        }
    }
    else
    {
        redirect('order-create.php', 'Somthing Went Wrong !');
    }


}

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    } else {
    echo json_encode(["status" => 400, "status_type" => "error", "message" => "Product ID is missing."]);
    exit;
    }   


if (isset($_POST['productIncDec'])) {
    // Validate inputs
    $productId = validate($_POST['product_id']);
    $quantityToAdd = validate($_POST['quantity']);

    // Check if session variable for product items is set
    if (isset($_SESSION['productItems']) && is_array($_SESSION['productItems'])) {
        $flag = false;

        // Iterate through product items to find and update the quantity
        foreach ($_SESSION['productItems'] as $key => $item) {
            if ($item['product_id'] == $productId) {
                $flag = true;
                // Increment the quantity instead of replacing it
                $_SESSION['productItems'][$key]['quantity'] += $quantityToAdd;
                break; // Stop loop once product is updated
            }
        }

        // If product not found, add it as a new item
        if (!$flag) {
            $_SESSION['productItems'][] = [
                'product_id' => $productId,
                'quantity' => $quantityToAdd,
            ];
            jsonResponse(200, 'success', 'Product Added');
        } else {
            jsonResponse(200, 'success', 'Product Quantity Updated');
        }
    } else {
        // Initialize the cart if it doesn't exist
        $_SESSION['productItems'] = [
            [
                'product_id' => $productId,
                'quantity' => $quantityToAdd,
            ]
        ];
        jsonResponse(200, 'success', 'Product Added to New Cart');
    }
} else {
    jsonResponse(400, 'error', 'Invalid Request');
}



if(isset($_POST['proceedToPlaceBtn']))
{
    $phone = validate($_POST['cphone']);
    $payment_mode = validate($_POST['payment_mode']);

    //checking for customer

    $checkCustomer = mysqli_query($conn, "SELECT * FROM customers WHERE phone='$phone' LIMIT 1");
    if ($checkCustomer) {
        if (mysqli_num_rows($checkCustomer) > 0) {
            $_SESSION['invoice_no'] = "INV-" . rand(11111, 999999);
            $_SESSION['cphone'] = $phone;
            $_SESSION['payment_mode'] = $payment_mode;
            jsonResponse(200, 'success', 'Customer Found');
        } else {
            $_SESSION['cphone'] = null; // Clear session variable if customer is not found
            jsonResponse(404, 'warning', 'Customer Not Found');
        }
    } else {
        jsonResponse(500, 'error', 'Something Went Wrong');
    }
    
}

?>