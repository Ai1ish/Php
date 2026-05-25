<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cybertron Transmission Scanner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 40px auto;
            max-width: 600px;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #2c3e50;
            margin-top: 0;
            border-bottom: 2px solid #3498db;
            padding-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }
        input[type="number"] {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }
        button {
            background-color: #3f34dbff;
            color: white;
            border: none;
            padding: 20px;
            border-radius: 8px;
            font-size: 20px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #7c53c9ff;
        }
        .output-box {
            background-color: #fcfcfc;
            border: 1px solid #ddd;
            border-left: 4px solid #582ecc91;
            padding: 25px;
            border-radius: 8px;
            margin-top: 25px;
            font-family: monospace;
            font-size: 15px;
            line-height: 1.6;
            white-space: pre-wrap;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #7f8c8d;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Cybertron Energy Signal Scanner</h2>
    
    <form method="POST" action="">
        <div class="form-group">
            <label for="range-input">Enter transmission range:</label>
            <input type="number" id="range-input" name="n" min="1" value="<?= isset($_POST['n']) ? htmlspecialchars($_POST['n']) : 20 ?>" required>
        </div>
        <button type="submit">Scan Transmission</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $n = (int)$_POST['n'];

        if ($n >= 1) {
            // Helper function to check if a number is prime
            function isPrime($num) {
                if ($num <= 1) {
                    return false;
                }
                for ($i = 2; $i <= sqrt($num); $i++) {
                    if ($num % $i == 0) {
                        return false;
                    }
                }
                return true;
            }

            // I used https://www.php.net/manual/en/function.range.php for this part
            $transmission_codes = range(1, $n);

            $prime_signals = [];
            foreach ($transmission_codes as $code) {
                if (isPrime($code)) {
                    $prime_signals[] = $code;
                }
            }

            // I used https://www.php.net/manual/en/function.implode.php for this part
            echo '<div class="output-box">';
            echo "Cybertron Transmission Codes:\n";
            echo implode(" ", $transmission_codes) . "\n\n";

            echo "Prime Energy Signals Detected:\n";
            echo implode(" ", $prime_signals) . "\n\n";

            echo "Total Prime Signals: " . count($prime_signals);
            echo '</div>';
        } else {
            echo '<div class="output-box" style="border-left-color: #e74c3c; color: #c0392b;">';
            echo "Please enter a range greater than or equal to 1.";
            echo '</div>';
        }
    }
    ?>

    <div class="footer">
        202411893 - Narvasa, Ailish Sophia D.
    </div>
</div>

</body>
</html>
