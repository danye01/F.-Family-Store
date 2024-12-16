<?php
session_start();

// Check if 'productItems' session exists and clear it
if (isset($_SESSION['productItems'])) {
    unset($_SESSION['productItems']); // Clear all product items
}

// Reset other related session variables
$_SESSION['totalSales'] = 0;
$_SESSION['topFastestMovingItems'] = [];

// Redirect back to the main sales view page
header("Location: sales-view.php");
exit();
?>
