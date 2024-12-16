<?php
session_start();

// Check if 'item_index' is provided and session has product items
if (isset($_POST['item_index']) && isset($_SESSION['productItems'])) {
    $index = (int)$_POST['item_index']; // Ensure index is an integer

    // Check if the index exists in the session array
    if (isset($_SESSION['productItems'][$index])) {
        unset($_SESSION['productItems'][$index]); // Delete the specific item

        // Re-index the array to prevent gaps
        $_SESSION['productItems'] = array_values($_SESSION['productItems']);

        // Recalculate total sales
        $_SESSION['totalSales'] = array_reduce($_SESSION['productItems'], function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Recalculate top fastest-moving items
        $_SESSION['topFastestMovingItems'] = array_slice(
            array_reverse(array_sort($_SESSION['productItems'], function ($a, $b) {
                return $a['quantity'] <=> $b['quantity'];
            })),
            0,
            3
        );
    }
}

// Redirect back to the sales view page
header("Location: sales-view.php");
exit();
?>
