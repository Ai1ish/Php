<?php
require_once 'Narvasa-ClassAct5-Data.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ailish's Artisan Cafe - Menu</title>
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
            --text-muted: #6c757d;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Outfit', sans-serif;
            color: var(--text-dark);
            min-height: 100vh;
            padding: 40px 0;
        }

        .menu-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            max-width: 900px;
            margin: 0 auto;
        }

        /* Header Title */
        .menu-title {
            font-weight: 700;
            font-size: 2.5rem;
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            margin-bottom: 5px;
        }

        /* Category Card Styles */
        .category-card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            background: #fff;
            transition: transform 0.2s ease;
        }

        .category-card:hover {
            transform: translateY(-2px);
        }

        .category-header {
            background: var(--primary-gradient);
            color: white;
            border-radius: 16px 16px 0 0 !important;
            padding: 16px 24px;
        }

        .category-header h3 {
            font-weight: 600;
            margin: 0;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .subcategory-title {
            font-weight: 600;
            color: var(--accent-color);
            margin-bottom: 20px;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #eef2f3;
            padding-bottom: 8px;
        }

        /* Menu Item Layout with Dot Leaders */
        .menu-item-row {
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 10px;
            transition: all 0.25s ease;
        }

        .menu-item-row:hover {
            background-color: #f8f9fa;
        }

        .menu-item-row.active-row {
            background-color: rgba(102, 126, 234, 0.08);
        }

        .form-check-input {
            width: 22px;
            height: 22px;
            border: 2px solid #ced4da;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .form-check-input:checked {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .menu-details {
            display: flex;
            flex-grow: 1;
            align-items: baseline;
            cursor: pointer;
            user-select: none;
            margin-left: 10px;
        }

        .menu-name {
            font-weight: 500;
            color: var(--text-dark);
            font-size: 1.05rem;
            transition: color 0.2s;
        }

        .menu-item-row.active-row .menu-name {
            font-weight: 600;
            color: #5d2596;
        }

        .menu-dots {
            flex-grow: 1;
            border-bottom: 2px dotted #cbd5e1;
            margin: 0 10px;
            position: relative;
            top: -4px;
        }

        .menu-price {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 1.05rem;
        }

        .menu-item-row.active-row .menu-price {
            color: var(--accent-color);
        }

        .menu-qty-wrapper {
            width: 85px;
            margin-left: 15px;
        }

        .menu-qty {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 6px;
            font-weight: 600;
            color: var(--text-dark);
            transition: all 0.2s ease;
            background-color: #f8f9fa;
        }

        .menu-qty:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(118, 75, 162, 0.25);
            background-color: #fff;
        }

        .menu-qty:disabled {
            background-color: #e9ecef;
            color: #adb5bd;
            border-color: #dee2e6;
            cursor: not-allowed;
        }

        /* Order Button styling */
        .btn-order {
            background: var(--primary-gradient);
            border: none;
            color: white;
            padding: 14px 40px;
            font-weight: 600;
            font-size: 1.15rem;
            border-radius: 12px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(118, 75, 162, 0.2);
        }

        .btn-order:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(118, 75, 162, 0.35);
            color: white;
        }

        .btn-order:active {
            transform: translateY(1px);
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
    <div class="menu-container animate-fade-in">
        
        <!-- Header -->
        <div class="text-center pt-5 pb-4 px-4">
            <h1 class="menu-title">Ailish's Artisan Cafe</h1>
            <p class="text-muted mb-0">Indulge in our handpicked selections and signature drinks</p>
        </div>

        <div class="p-4 p-md-5">
            <!-- Alert banner for empty form submission -->
            <div class="alert alert-danger d-none d-flex align-items-center" id="validationAlert" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                <div>
                    <strong>Selection Required!</strong> Please select at least one item from the menu before placing your order.
                </div>
            </div>

            <form id="menuForm" action="Narvasa-ClassAct5-Summary.php" method="POST">
                
                <?php foreach ($menu as $category => $subcategories): ?>
                    <div class="category-card card">
                        <div class="category-header card-header">
                            <h3>
                                <?php if ($category == 'Main Dishes'): ?>
                                    <i class="bi bi-egg-fried"></i>
                                <?php elseif ($category == 'Drinks'): ?>
                                    <i class="bi bi-cup-hot-fill"></i>
                                <?php else: ?>
                                    <i class="bi bi-cake2-fill"></i>
                                <?php endif; ?>
                                <?= htmlspecialchars($category) ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <?php foreach ($subcategories as $subcategory => $items): ?>
                                    <div class="col-md-6 mb-4">
                                        <h4 class="subcategory-title"><?= htmlspecialchars($subcategory) ?></h4>
                                        <div class="menu-list">
                                            
                                                <?php foreach ($items as $key => $item): ?>
                                                    <div class="menu-item-row" id="row_<?= htmlspecialchars($key) ?>">
                                                        
                                                        <!-- Checkbox -->
                                                        <div class="form-check mb-0">
                                                            <input class="form-check-input menu-checkbox" 
                                                                   type="checkbox" 
                                                                   name="selected_items[]" 
                                                                   value="<?= htmlspecialchars($key) ?>" 
                                                                   id="chk_<?= htmlspecialchars($key) ?>" 
                                                                   onchange="toggleQuantity('<?= htmlspecialchars($key) ?>')">
                                                        </div>

                                                        <!-- Item Details (Clickable label) -->
                                                        <label class="menu-details mb-0" for="chk_<?= htmlspecialchars($key) ?>">
                                                            <span class="menu-name"><?= htmlspecialchars($item['name']) ?></span>
                                                            <span class="menu-dots"></span>
                                                            <span class="menu-price text-nowrap">PHP <?= number_format($item['price'], 2) ?></span>
                                                        </label>

                                                        <!-- Quantity Input -->
                                                        <div class="menu-qty-wrapper">
                                                            <input type="number" 
                                                                   class="form-control menu-qty text-center" 
                                                                   name="quantities[<?= htmlspecialchars($key) ?>]" 
                                                                   id="qty_<?= htmlspecialchars($key) ?>" 
                                                                   value="1" 
                                                                   min="1" 
                                                                   max="99" 
                                                                   disabled 
                                                                   required>
                                                        </div>

                                                    </div>
                                                <?php endforeach; ?>

                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Place Order Button -->
                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-order">
                        <i class="bi bi-receipt-cutoff me-2"></i>Place Order & View Summary
                    </button>
                </div>

            </form>

            <!-- Student Info Footer -->
            <div class="footer-info">
                Student Name: NARVASA, AILISH SOPHIA D. <br>
                Student Number: 202411893
            </div>

        </div>
    </div>
</div>

<!-- JavaScript Controls -->
<script>
    function toggleQuantity(key) {
        const checkbox = document.getElementById('chk_' + key);
        const qtyInput = document.getElementById('qty_' + key);
        const itemRow = document.getElementById('row_' + key);

        if (checkbox.checked) {
            qtyInput.disabled = false;
            qtyInput.focus();
            qtyInput.select();
            itemRow.classList.add('active-row');
        } else {
            qtyInput.disabled = true;
            qtyInput.value = 1;
            itemRow.classList.remove('active-row');
        }
        
        // Hide alert if they make a selection
        const alertBox = document.getElementById('validationAlert');
        if (!alertBox.classList.contains('d-none')) {
            const checkedBoxes = document.querySelectorAll('.menu-checkbox:checked');
            if (checkedBoxes.length > 0) {
                alertBox.classList.add('d-none');
            }
        }
    }

    // Client-side validation: prevent empty submissions
    document.getElementById('menuForm').addEventListener('submit', function(e) {
        const checkboxes = document.querySelectorAll('.menu-checkbox:checked');
        if (checkboxes.length === 0) {
            e.preventDefault(); // Stop form submission
            
            const alertBox = document.getElementById('validationAlert');
            alertBox.classList.remove('d-none');
            alertBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
</script>

</body>
</html>
