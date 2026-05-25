<?php
/**
 * Narvasa-ClassAct2.php
 * Cybertron Transmission & Prime Energy Signal Scanner
 * Student Name: Narvasa, Ailish Sophia D.
 * Student Number: 202411893
 */

// Function to check if a number is prime
function isPrime($num) {
    if ($num <= 1) {
        return false;
    }
    if ($num == 2) {
        return true;
    }
    if ($num % 2 == 0) {
        return false;
    }
    $boundary = sqrt($num);
    for ($i = 3; $i <= $boundary; $i += 2) {
        if ($num % $i == 0) {
            return false;
        }
    }
    return true;
}

// Initialize variables
$n = 20; // Default range
$error_message = "";
$transmission_codes = [];
$prime_signals = [];
$total_primes = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_GET['n'])) {
    $input_val = isset($_POST['n']) ? $_POST['n'] : $_GET['n'];
    
    // Validate input
    if (filter_var($input_val, FILTER_VALIDATE_INT) !== false) {
        $entered_n = (int)$input_val;
        if ($entered_n >= 1) {
            $n = $entered_n;
        } else {
            $error_message = "Optimized Scanner Warning: Range must be greater than or equal to 1.";
        }
    } else {
        $error_message = "Optimized Scanner Warning: Please enter a valid integer.";
    }
}

// Generate the array of transmission codes from 1 up to n
$transmission_codes = range(1, $n);

// Detect Prime Energy Signals and count them
foreach ($transmission_codes as $code) {
    if (isPrime($code)) {
        $prime_signals[] = $code;
    }
}
$total_primes = count($prime_signals);

// Prepare the exact plain-text output matching the prompt's specifications
$terminal_transmission = implode(" ", $transmission_codes);
$terminal_primes = implode(" ", $prime_signals);

$raw_output_text = "Cybertron Transmission Codes:\n" . 
                   $terminal_transmission . "\n\n" . 
                   "Prime Energy Signals Detected:\n" . 
                   ($total_primes > 0 ? $terminal_primes : "None") . "\n\n" . 
                   "Total Prime Signals: " . $total_primes;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cybertron Transmission Scanner - Optimus Prime Tactical Hub</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;800;900&family=Share+Tech+Mono&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-color: #060913;
            --card-bg: rgba(10, 17, 34, 0.75);
            --energon-blue: #00f0ff;
            --energon-glow: rgba(0, 240, 255, 0.4);
            --autobot-red: #ff3b30;
            --autobot-red-glow: rgba(255, 59, 48, 0.4);
            --accent-gold: #ffcc00;
            --text-main: #e2e8f0;
            --text-muted: #94a3b8;
            --grid-border: rgba(0, 240, 255, 0.15);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(0, 240, 255, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(255, 59, 48, 0.04) 0%, transparent 40%),
                linear-gradient(rgba(0, 240, 255, 0.01) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 240, 255, 0.01) 1px, transparent 1px);
            background-size: 100% 100%, 100% 100%, 40px 40px, 40px 40px;
            font-family: 'Outfit', sans-serif;
            color: var(--text-main);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-x: hidden;
        }

        /* Scanline Overlay Effect for CRT look */
        body::before {
            content: " ";
            display: block;
            position: fixed;
            top: 0; left: 0; bottom: 0; right: 0;
            background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.25) 50%), linear-gradient(90deg, rgba(255, 0, 0, 0.06), rgba(0, 255, 0, 0.02), rgba(0, 0, 255, 0.06));
            z-index: 9999;
            background-size: 100% 4px, 6px 100%;
            pointer-events: none;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            width: 100%;
            z-index: 2;
        }

        header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .autobot-symbol {
            font-size: 3rem;
            color: var(--autobot-red);
            text-shadow: 0 0 15px var(--autobot-red-glow);
            margin-bottom: 10px;
            display: inline-block;
            animation: pulse-red 2s infinite alternate;
        }

        h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.2rem;
            font-weight: 900;
            letter-spacing: 2px;
            text-transform: uppercase;
            background: linear-gradient(135deg, var(--energon-blue) 30%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 20px rgba(0, 240, 255, 0.2);
            margin-bottom: 5px;
        }

        .subtitle {
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.95rem;
            color: var(--energon-blue);
            letter-spacing: 3px;
            text-transform: uppercase;
            opacity: 0.85;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background-color: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 8px #10b981;
            display: inline-block;
            animation: blink 1.5s infinite;
        }

        /* Grid Layout */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        @media (min-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr 1fr;
            }
            .full-width {
                grid-column: span 2;
            }
        }

        /* Glass Cards */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--grid-border);
            border-radius: 12px;
            padding: 25px;
            backdrop-filter: blur(12px);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--energon-blue);
            box-shadow: 0 0 10px var(--energon-blue);
        }

        .card.red-theme::before {
            background: var(--autobot-red);
            box-shadow: 0 0 10px var(--autobot-red);
        }

        .card:hover {
            border-color: rgba(0, 240, 255, 0.4);
            box-shadow: 0 12px 40px 0 rgba(0, 240, 255, 0.15);
            transform: translateY(-2px);
        }

        .card-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding-bottom: 10px;
        }

        .card-title i {
            color: var(--energon-blue);
        }

        /* Form Styling */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }

        label {
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.9rem;
            color: var(--text-muted);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .input-wrapper {
            position: relative;
            display: flex;
        }

        input[type="number"] {
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid var(--grid-border);
            border-radius: 6px;
            padding: 14px 18px;
            font-family: 'Share Tech Mono', monospace;
            font-size: 1.2rem;
            color: var(--energon-blue);
            outline: none;
            transition: all 0.3s;
        }

        input[type="number"]:focus {
            border-color: var(--energon-blue);
            box-shadow: 0 0 12px var(--energon-glow);
            background: rgba(0, 240, 255, 0.05);
        }

        .btn-scan {
            background: linear-gradient(135deg, var(--energon-blue), #00aaff);
            color: #060913;
            border: none;
            border-radius: 6px;
            padding: 0 25px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            font-size: 0.95rem;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 0 15px rgba(0, 240, 255, 0.3);
            white-space: nowrap;
        }

        .btn-scan:hover {
            background: linear-gradient(135deg, #00f0ff, #38bdf8);
            transform: scale(1.02);
            box-shadow: 0 0 25px rgba(0, 240, 255, 0.5);
        }

        .btn-scan:active {
            transform: scale(0.98);
        }

        .quick-ranges {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .quick-btn {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 4px;
            padding: 6px 12px;
            font-family: 'Share Tech Mono', monospace;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            font-size: 0.85rem;
        }

        .quick-btn:hover {
            background: rgba(0, 240, 255, 0.08);
            color: var(--energon-blue);
            border-color: var(--energon-blue);
        }

        .error-container {
            background: rgba(255, 59, 48, 0.1);
            border: 1px solid var(--autobot-red);
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 20px;
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.9rem;
            color: #ff8080;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }

        .stat-val {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--energon-blue);
            text-shadow: 0 0 10px var(--energon-glow);
            margin-bottom: 5px;
        }

        .stat-card.red-highlight .stat-val {
            color: var(--autobot-red);
            text-shadow: 0 0 10px var(--autobot-red-glow);
        }

        .stat-lbl {
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* CRT Terminal Section */
        .terminal-block {
            background-color: #02040a;
            border: 1px solid #1e293b;
            border-radius: 8px;
            padding: 18px;
            position: relative;
            margin-top: 10px;
        }

        .terminal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .terminal-lbl {
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.8rem;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .terminal-lbl::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            background: #475569;
            border-radius: 1px;
        }

        .btn-copy {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-muted);
            border-radius: 4px;
            padding: 4px 8px;
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-copy:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--energon-blue);
        }

        .terminal-pre {
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.95rem;
            line-height: 1.5;
            color: #38bdf8;
            white-space: pre-wrap;
            word-break: break-all;
            max-height: 250px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 240, 255, 0.2) transparent;
        }

        .terminal-pre::-webkit-scrollbar {
            width: 6px;
        }

        .terminal-pre::-webkit-scrollbar-thumb {
            background-color: rgba(0, 240, 255, 0.2);
            border-radius: 3px;
        }

        /* Visual Signal Grid */
        .visual-display {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .grid-legend {
            display: flex;
            gap: 15px;
            font-size: 0.8rem;
            font-family: 'Share Tech Mono', monospace;
            justify-content: flex-end;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 3px;
        }

        .legend-prime {
            background: rgba(255, 59, 48, 0.2);
            border: 1px solid var(--autobot-red);
            box-shadow: 0 0 6px rgba(255, 59, 48, 0.3);
        }

        .legend-normal {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .signal-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(48px, 1fr));
            gap: 8px;
            max-height: 380px;
            overflow-y: auto;
            padding: 5px;
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 240, 255, 0.2) transparent;
        }

        .signal-grid::-webkit-scrollbar {
            width: 6px;
        }

        .signal-grid::-webkit-scrollbar-thumb {
            background-color: rgba(0, 240, 255, 0.2);
            border-radius: 3px;
        }

        .signal-cell {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 6px;
            position: relative;
            transition: all 0.2s ease;
        }

        .signal-cell:hover {
            transform: scale(1.08);
            z-index: 10;
        }

        .signal-cell.prime {
            background: radial-gradient(circle, rgba(255, 59, 48, 0.25) 0%, rgba(255, 59, 48, 0.05) 100%);
            border-color: var(--autobot-red);
            color: #fff;
            box-shadow: 0 0 10px rgba(255, 59, 48, 0.25);
            animation: pulse-border 2.5s infinite;
        }

        .signal-cell.prime::after {
            content: '▲';
            position: absolute;
            top: 2px;
            right: 2px;
            font-size: 0.5rem;
            color: var(--autobot-red);
        }

        .signal-cell.normal {
            color: var(--text-muted);
        }

        /* Decorative Optimus Quote */
        .optimus-quote {
            text-align: center;
            margin: 30px auto 10px;
            max-width: 650px;
            font-style: italic;
            font-family: 'Outfit', sans-serif;
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.5;
            position: relative;
            padding: 0 20px;
        }

        .optimus-quote::before, .optimus-quote::after {
            content: '"';
            font-size: 2rem;
            color: var(--autobot-red);
            position: absolute;
            top: -10px;
            opacity: 0.4;
        }

        .optimus-quote::before { left: 0; }
        .optimus-quote::after { right: 0; }

        /* Footer info matching layout rules */
        footer {
            margin-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 20px;
            text-align: center;
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.9rem;
            color: var(--text-muted);
            letter-spacing: 1px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-sig {
            color: var(--energon-blue);
            font-weight: 600;
        }

        /* Animations */
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        @keyframes pulse-red {
            0% { transform: scale(1); filter: drop-shadow(0 0 5px rgba(255, 59, 48, 0.3)); }
            100% { transform: scale(1.05); filter: drop-shadow(0 0 15px rgba(255, 59, 48, 0.7)); }
        }

        @keyframes pulse-border {
            0%, 100% { border-color: rgba(255, 59, 48, 0.5); box-shadow: 0 0 8px rgba(255, 59, 48, 0.2); }
            50% { border-color: rgba(255, 59, 48, 1); box-shadow: 0 0 14px rgba(255, 59, 48, 0.55); }
        }

        /* Styling for the toast notification */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #02040a;
            border: 1px solid var(--energon-blue);
            padding: 12px 24px;
            border-radius: 6px;
            font-family: 'Share Tech Mono', monospace;
            color: var(--energon-blue);
            box-shadow: 0 5px 15px rgba(0, 240, 255, 0.25);
            z-index: 10000;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <div class="container">
        
        <!-- Header -->
        <header>
            <div class="autobot-symbol">
                <!-- SVG Autobot Emblem for highly responsive vector display -->
                <svg width="48" height="48" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M32 0L2 14L8 42L32 64L56 42L62 14L32 0Z" fill="rgba(255,59,48,0.1)"/>
                    <path d="M32 3L6 16L11 41L32 61L53 41L58 16L32 3ZM32 7L51 20L49 37L32 53L15 37L13 20L32 7Z" fill="var(--autobot-red)"/>
                    <path d="M22 17H26V32H22V17ZM38 17H42V32H38V17Z" fill="var(--autobot-red)"/>
                    <path d="M30 14H34V29H30V14Z" fill="var(--autobot-red)"/>
                    <path d="M28 35H36V39H28V35Z" fill="var(--autobot-red)"/>
                    <path d="M19 39L32 49L45 39V43L32 54L19 43V39Z" fill="var(--autobot-red)"/>
                </svg>
            </div>
            <h1>Prime Energy Signals</h1>
            <div class="subtitle">
                <span class="status-dot"></span> Tactical Transmission Decrypter
            </div>
        </header>

        <!-- Main Dashboard Layout -->
        <div class="dashboard-grid">
            
            <!-- Left Card: Input Panel -->
            <div class="card">
                <div class="card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                        <line x1="9" y1="3" x2="9" y2="21" />
                    </svg>
                    Scanner Configuration
                </div>
                
                <?php if ($error_message !== ""): ?>
                    <div class="error-container">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        <span><?= htmlspecialchars($error_message) ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="range-input">Enter Transmission Range (n):</label>
                        <div class="input-wrapper">
                            <input 
                                type="number" 
                                id="range-input" 
                                name="n" 
                                value="<?= htmlspecialchars($n) ?>" 
                                min="1" 
                                required 
                                placeholder="Enter range..."
                            >
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-scan" style="width: 100%; height: 50px; margin-bottom: 20px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        Initiate Scanner
                    </button>
                </form>

                <div class="form-group">
                    <label>Presets Scan Ranges:</label>
                    <div class="quick-ranges">
                        <a href="?n=20" class="quick-btn">N = 20 (Sample)</a>
                        <a href="?n=50" class="quick-btn">N = 50</a>
                        <a href="?n=100" class="quick-btn">N = 100</a>
                        <a href="?n=250" class="quick-btn">N = 250</a>
                    </div>
                </div>
            </div>

            <!-- Right Card: Stats & Summary -->
            <div class="card red-theme">
                <div class="card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83" />
                        <path d="M22 12A10 10 0 0 0 12 2v10z" />
                    </svg>
                    Telemetry Overview
                </div>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-val"><?= number_format($n) ?></div>
                        <div class="stat-lbl">Range N</div>
                    </div>
                    <div class="stat-card red-highlight">
                        <div class="stat-val" id="prime-count-val"><?= number_format($total_primes) ?></div>
                        <div class="stat-lbl">Primes Detected</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-val">
                            <?= $n > 0 ? round(($total_primes / $n) * 100, 1) : 0 ?>%
                        </div>
                        <div class="stat-lbl">Density</div>
                    </div>
                </div>

                <div class="terminal-block">
                    <div class="terminal-header">
                        <span class="terminal-lbl">Standard Raw Output</span>
                        <button class="btn-copy" onclick="copyTerminalOutput()">Copy Format</button>
                    </div>
                    <pre class="terminal-pre" id="raw-output"><?= htmlspecialchars($raw_output_text) ?></pre>
                </div>
            </div>

            <!-- Full Width: Interactive Visualization Map -->
            <div class="card full-width">
                <div class="card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z" />
                        <path d="M12 6v6l4 2" />
                    </svg>
                    Energon Signature Map (1 - <?= htmlspecialchars($n) ?>)
                </div>
                
                <div class="visual-display">
                    <div class="grid-legend">
                        <div class="legend-item">
                            <span class="legend-color legend-prime"></span>
                            <span>Prime Energy Signal (Active)</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color legend-normal"></span>
                            <span>Standard Transmission Code</span>
                        </div>
                    </div>

                    <div class="signal-grid">
                        <?php foreach ($transmission_codes as $code): 
                            $is_prime = isPrime($code);
                            $class = $is_prime ? "prime" : "normal";
                            $title = $is_prime ? "Prime Energy Signal Detected: $code" : "Standard Transmission: $code";
                        ?>
                            <div class="signal-cell <?= $class ?>" title="<?= $title ?>">
                                <?= $code ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>

        <!-- Quote -->
        <div class="optimus-quote">
            Fate has yielded its reward: a new world to call home. But we must never forget the energy patterns that define our existence. Scan the cosmos, find the Primes.
        </div>

        <!-- Toast notification -->
        <div id="copy-toast" class="toast">Copied scanner telemetry to clipboard!</div>

        <!-- Footer -->
        <footer>
            <div style="margin-bottom: 5px;">Cybertron Decryption Command Center • Active Node</div>
            <div>Student Ref: <span class="footer-sig">202411893 - Narvasa, Ailish Sophia D.</span> / TN23</div>
        </footer>

    </div>

    <script>
        function copyTerminalOutput() {
            const preElement = document.getElementById('raw-output');
            const textToCopy = preElement.innerText;
            
            navigator.clipboard.writeText(textToCopy).then(() => {
                showToast();
            }).catch(err => {
                console.error('Failed to copy: ', err);
                
                // Fallback copy method
                const textArea = document.createElement("textarea");
                textArea.value = textToCopy;
                document.body.appendChild(textArea);
                textArea.select();
                try {
                    document.execCommand('copy');
                    showToast();
                } catch (e) {
                    console.error('Fallback copy failed', e);
                }
                document.body.removeChild(textArea);
            });
        }

        function showToast() {
            const toast = document.getElementById('copy-toast');
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 2500);
        }
    </script>
</body>
</html>
