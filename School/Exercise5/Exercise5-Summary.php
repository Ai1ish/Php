<?php
require_once 'Narvasa-ClassAct5-Data.php';

// Flatten the menu for easy O(1) details lookup
$flatMenu = [];
foreach ($menu as $category => $subcategories) {
    foreach ($subcategories as $subcategory => $items) {
        foreach ($items as $key => $item) {
            $flatMenu[$key] = [
                'name' => $item['name'],
                'price' => $item['price'],
                'category' => $category,
                'subcategory' => $subcategory
            ];
        }
    }
}

$orderedItems = [];
$grandTotal = 0;
$hasOrder = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['selected_items'])) {
    $selectedKeys = $_POST['selected_items'];
    $quantities = $_POST['quantities'] ?? [];
    
    foreach ($selectedKeys as $key) {
        if (isset($flatMenu[$key])) {
            $qty = isset($quantities[$key]) ? (int)$quantities[$key] : 1;
            if ($qty < 1) $qty = 1; // Ensure valid positive quantity
            
            $itemDetails = $flatMenu[$key];
            $price = (float)$itemDetails['price'];
            $subtotal = $price * $qty;
            $grandTotal += $subtotal;
            
            $orderedItems[] = [
                'name' => $itemDetails['name'],
                'category' => $itemDetails['category'],
                'subcategory' => $itemDetails['subcategory'],
                'price' => $price,
                'quantity' => $qty,
                'subtotal' => $subtotal
            ];
        }
    }
    
    if (count($orderedItems) > 0) {
        $hasOrder = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ailish's Artisan Cafe - Order Summary</title>
    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font: Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --accent-color: #764ba2;
            --bg-color: #f3f4f6;
            --text-dark: #2c3e50;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Outfit', sans-serif;
            color: var(--text-dark);
            min-height: 100vh;
            padding: 40px 0;
        }

        .summary-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            max-width: 700px;
            margin: 0 auto;
        }

        .receipt-header {
            background: var(--primary-gradient);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .receipt-header h2 {
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 1.8rem;
        }

        .receipt-header p {
            font-weight: 300;
            margin: 0;
            opacity: 0.9;
        }

        .receipt-body {
            padding: 40px;
        }

        .invoice-table {
            width: 100%;
            margin-bottom: 30px;
        }

        .invoice-table th {
            font-weight: 600;
            color: #718096;
            border-bottom: 2px solid #edf2f7;
            padding-bottom: 12px;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
        }

        .invoice-table td {
            padding: 16px 0;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .item-title {
            font-weight: 600;
            color: var(--text-dark);
            margin: 0;
            font-size: 1.05rem;
        }

        .item-category {
            font-size: 0.8rem;
            color: #888;
            margin-top: 2px;
        }

        .unit-price, .item-qty, .item-subtotal {
            font-size: 1rem;
        }

        .item-qty {
            font-weight: 500;
        }

        .item-subtotal {
            font-weight: 600;
            color: var(--text-dark);
        }

        /* Grand Total Panel */
        .total-panel {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #e2e8f0;
            margin-bottom: 35px;
        }

        .total-label {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--text-dark);
        }

        .total-amount {
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--accent-color);
        }

        /* Buttons */
        .btn-back {
            border: 2px solid #764ba2;
            color: #764ba2;
            background: transparent;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 10px;
            width: 100%;
            transition: all 0.25s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-back:hover {
            background: var(--primary-gradient);
            color: white;
            border-color: transparent;
            box-shadow: 0 8px 15px rgba(118, 75, 162, 0.2);
            transform: translateY(-1px);
        }

        /* Footer styling */
        .footer-info {
            margin-top: 40px;
            padding-top: 25px;
            font-weight: 600;
            text-align: center;
            color: #888;
            border-top: 1px solid #eee;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="summary-container animate-fade-in">
        
        <?php if ($hasOrder): ?>
            <!-- Receipt Header -->
            <div class="receipt-header">
                <h2>Order Receipt Summary</h2>
                <p>Thank you for dining with Ailish's Artisan Cafe!</p>
            </div>

            <!-- Receipt Body -->
            <div class="receipt-body">
                <div class="table-responsive">
                    <table class="invoice-table">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Item Selected</th>
                                <th style="width: 15%; text-align: right;">Price</th>
                                <th style="width: 15%; text-align: center;">Qty</th>
                                <th style="width: 20%; text-align: right;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orderedItems as $item): ?>
                                <tr>
                                    <td>
                                        <div class="item-title"><?= htmlspecialchars($item['name']) ?></div>
                                        <div class="item-category"><?= htmlspecialchars($item['category']) ?> &bull; <?= htmlspecialchars($item['subcategory']) ?></div>
                                    </td>
                                    <td style="text-align: right;" class="unit-price text-muted">PHP <?= number_format($item['price'], 2) ?></td>
                                    <td style="text-align: center;" class="item-qty"><?= htmlspecialchars($item['quantity']) ?></td>
                                    <td style="text-align: right;" class="item-subtotal">PHP <?= number_format($item['subtotal'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Grand Total Panel -->
                <div class="total-panel">
                    <span class="total-label"><i class="bi bi-wallet2 me-2"></i>Grand Total</span>
                    <span class="total-amount">PHP <?= number_format($grandTotal, 2) ?></span>
                </div>

                <!-- Return Button -->
                <div class="text-center">
                    <a href="Narvasa-ClassAct5.php" class="btn-back">
                        <i class="bi bi-arrow-left me-2"></i>Modify / Create New Order
                    </a>
                </div>

                <!-- Student Info Footer -->
                <div class="footer-info">
                    Student Name: NARVASA, AILISH SOPHIA D. <br>
                    Student Number: 202411893
                </div>
            </div>
            
        <?php else: ?>
            <!-- Error / No Order Display -->
            <div class="receipt-header bg-danger" style="background: linear-gradient(135deg, #e53e3e 0%, #b83280 100%);">
                <h2>No Order Detected</h2>
                <p>Something went wrong processing your request</p>
            </div>
            <div class="receipt-body text-center">
                <div class="py-5">
                    <i class="bi bi-cart-x text-danger display-1 mb-4"></i>
                    <h4 class="text-dark fw-bold">Your shopping cart is empty</h4>
                    <p class="text-muted mb-4">It looks like you attempted to view the summary without choosing any menu items.</p>
                    <a href="Narvasa-ClassAct5.php" class="btn btn-order py-3" style="max-width: 250px;">
                        <i class="bi bi-cup-hot me-2"></i>Browse Our Menu
                    </a>
                </div>

                <!-- Student Info Footer -->
                <div class="footer-info">
                    Student Name: NARVASA, AILISH SOPHIA D. <br>
                    Student Number: 202411893
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

</body>
</html>
