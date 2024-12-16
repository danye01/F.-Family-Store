<?php

ob_start();
include('includes/header.php');

// Function to calculate sales data
function calculateSalesData($sessionProducts)
{
    $totalSales = 0;
    $totalItems = 0;

    // Sort products by quantity in descending order for fast-moving items
    usort($sessionProducts, function ($a, $b) {
        return $b['quantity'] <=> $a['quantity'];
    });

    // Calculate total sales and total items
    foreach ($sessionProducts as $item) {
        $totalSales += $item['price'] * $item['quantity'];
        $totalItems += $item['quantity'];
    }

    // Get top 5 fast-moving items
    $topFastestMovingItems = array_slice($sessionProducts, 0, 5);

    // Sort products by quantity in ascending order for slow-moving items
    usort($sessionProducts, function ($a, $b) {
        return $a['quantity'] <=> $b['quantity'];
    });

    // Get bottom 3 slow-moving items
    $slowMovingItems = array_slice($sessionProducts, 0, 5);

    return [
        'totalSales' => $totalSales,
        'totalItems' => $totalItems,
        'topFastestMovingItems' => $topFastestMovingItems,
        'slowMovingItems' => $slowMovingItems
    ];
}

// Initialize session if not set
if (!isset($_SESSION['productItems'])) {
    $_SESSION['productItems'] = [];
}

// Remove specific product
if (isset($_GET['remove_id'])) {
    $removeId = intval($_GET['remove_id']);
    unset($_SESSION['productItems'][$removeId]);
    $_SESSION['productItems'] = array_values($_SESSION['productItems']); 
    header("Location: sales-view.php");
    exit();
}

// Clear all products
if (isset($_POST['clear_all'])) {
    $_SESSION['productItems'] = [];
    header("Location: sales-view.php");
    exit();
}

// Calculate sales data if items exist
if (!empty($_SESSION['productItems'])) {
    $sessionProducts = $_SESSION['productItems'];
    $salesData = calculateSalesData($sessionProducts);

    $_SESSION['totalSales'] = $salesData['totalSales'];
    $_SESSION['totalItems'] = $salesData['totalItems'];
    $_SESSION['topFastestMovingItems'] = $salesData['topFastestMovingItems'];
    $_SESSION['slowMovingItems'] = $salesData['slowMovingItems'];
} else {
    $_SESSION['totalSales'] = 0;
    $_SESSION['totalItems'] = 0;
    $_SESSION['topFastestMovingItems'] = [];
    $_SESSION['slowMovingItems'] = [];
}
?>

<div class="card mt-3">
    <div class="card-header">
        <h4>View Sales
            <form method="post" class="float-end">
                <button type="submit" name="clear_all" class="btn btn-danger mb-3">Clear All Sales</button>
            </form>
        </h4>
    </div>

    <!-- Summary Data -->
    <div class="card-footer">
        <h6>Total Sales: <?= number_format($_SESSION['totalSales'], 2); ?></h6>
        <h6>Total Items Sold: <?= $_SESSION['totalItems']; ?></h6>
    </div>

    <div class="card-body">
        <?php alertmessage(); ?>

        <?php if (!empty($_SESSION['productItems'])) { ?>
            <div class="table-responsive mb-3">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        foreach ($_SESSION['productItems'] as $key => $item): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= htmlspecialchars($item['name']); ?></td>
                                <td><?= number_format($item['price'], 2); ?></td>
                                <td><?= $item['quantity']; ?></td>
                                <td><?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                                <td>
                                    <a href="?remove_id=<?= $key; ?>" class="btn btn-sm btn-danger">Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                        </div>
        <?php } else { ?>
            <h5 class="text-center text-muted">No Items Added</h5>
        <?php } ?>
    </div>
</div>

<?php include('includes/footer.php'); ?>
