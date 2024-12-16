<?php
// Include the database connection
require_once '../config/db_config.php';

// Check if the request is a POST request and contains valid data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['productId']) && isset($data['quantity'])) {
        $productId = (int) $data['productId'];
        $quantity = (int) $data['quantity'];

        // Validate quantity (should be a positive integer)
        if ($quantity > 0) {
            // Prepare the SQL update query
            $query = "UPDATE sales SET quantity = ? WHERE product_id = ?";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the query
                $stmt->bind_param("ii", $quantity, $productId);
                if ($stmt->execute()) {
                    // Send a success response
                    echo json_encode(['success' => true]);
                } else {
                    // Send an error response
                    echo json_encode(['success' => false, 'message' => 'Failed to update quantity']);
                }
                $stmt->close();
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to prepare statement']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid quantity']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Missing data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

$conn->close();
?>
