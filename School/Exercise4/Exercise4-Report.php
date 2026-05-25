<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Report</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            font-family: 'Outfit', sans-serif;
            color: #333;
            min-height: 100vh;
            padding: 40px;
        }
        
        .report-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            max-width: 750px;
            margin: 0 auto;
        }

        h2 {
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px !important;
            background: -webkit-linear-gradient(#764ba2, #667eea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        th, td {
            border: 1px solid #edf2f7;
            padding: 18px;
            vertical-align: middle;
        }

        th {
            width: 28%;
            background-color: #f8fafc;
            text-align: left;
            font-weight: 600;
            color: #4a5568;
        }

        td {
            color: #2d3748;
            font-weight: 400;
        }

        .nested-table {
            width: 100%;
            border: none;
            box-shadow: none;
            border-radius: 0;
            margin-bottom: 0;
        }

        .nested-table th, .nested-table td {
            border: none;
            border-bottom: 1px solid #edf2f7;
            padding: 10px 5px;
            background-color: transparent;
        }

        .nested-table th {
            font-weight: 600;
            width: 50%;
            color: #718096;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
        }

        .nested-table tr:last-child td, .nested-table tr:last-child th {
            border-bottom: none;
        }

        .footer-info {
            margin-top: 40px;
            padding-top: 20px;
            font-weight: 600;
            text-align: center;
            color: #888;
            border-top: 1px solid #eee;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Helper function for Zodiac Sign (Array mapping)
    function getZodiacSign($date) {
        if (empty($date)) return "";
        $z = ["Capricorn", "Aquarius", "Pisces", "Aries", "Taurus", "Gemini", "Cancer", "Leo", "Virgo", "Libra", "Scorpio", "Sagittarius", "Capricorn"];
        $d = [19, 18, 20, 19, 20, 20, 22, 22, 22, 22, 21, 21];
        $m = (int)date('m', strtotime($date)) - 1;
        return ((int)date('d', strtotime($date)) > $d[$m]) ? $z[$m + 1] : $z[$m];
    }

    // Helper function for Mobile Network (Regex)
    function getMobileNetwork($num) {
        $num = preg_replace('/\D/', '', $num);
        if (preg_match('/^09(0[56]|1[5-7]|2[67]|3[5-7]|45|56|66|7[57]|9[57])/', $num)) return "Globe/TM";
        if (preg_match('/^09(0[7-9]|1[0289]|2[0189]|3[089]|4[6-9]|50|89|9[89])/', $num)) return "Smart/TNT";
        if (preg_match('/^09(2[2-5]|3[1-4]|4[1-3])/', $num)) return "Sun Cellular";
        if (preg_match('/^099[1-4]/', $num)) return "DITO";
        return "Unknown Network";
    }

    // Retrieve data
    $gname = trim($_POST['gname'] ?? '');
    $mname = trim($_POST['mname'] ?? '');
    $sname = trim($_POST['sname'] ?? '');
    $bday = $_POST['bday'] ?? '';
    $contact = trim($_POST['contact'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $address1 = trim($_POST['address1'] ?? '');
    $address2 = trim($_POST['address2'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $zip = trim($_POST['zip'] ?? '');
    $country = $_POST['country'] ?? '';

    // Dependents data arrays
    $dep_gnames = $_POST['dep_gname'] ?? [];
    $dep_mnames = $_POST['dep_mname'] ?? [];
    $dep_snames = $_POST['dep_sname'] ?? [];
    $dep_bdays  = $_POST['dep_bday'] ?? [];

    // Formatted Data
    $mi = !empty($mname) ? strtoupper(substr($mname, 0, 1)) . '.' : '';
    $fullName = trim("$sname, $gname $mi");

    $formattedBday = !empty($bday) ? date("F j, Y", strtotime($bday)) . " (" . getZodiacSign($bday) . ")" : "";

    // Contact formatting (Regex)
    $formattedContact = preg_replace('/^(\d{4})(\d{3})(\d{4})$/', '$1-$2-$3', preg_replace('/\D/', '', $contact));
    $contactDisplay = "$formattedContact (" . getMobileNetwork($contact) . ")";

    // Email Domain (Regex)
    preg_match('/@([^.]+)/', $email, $matches);
    $emailDisplay = "$email (" . (!empty($matches[1]) ? ucfirst($matches[1]) : "Unknown Domain") . ")";

    // Address Formatting
    $addressParts = array_filter([$address1, $address2, $city, $zip, $country]);
    $fullAddress = implode(", ", $addressParts);

    // Dependent Formatting (Up to 3)
    $dependentsList = [];
    for ($i = 0; $i < 3; $i++) {
        $g = trim($dep_gnames[$i] ?? '');
        $m = trim($dep_mnames[$i] ?? '');
        $s = trim($dep_snames[$i] ?? '');
        $b = $dep_bdays[$i] ?? '';
        
        if (!empty($g) || !empty($s)) {
            $mi = !empty($m) ? strtoupper(substr($m, 0, 1)) . '.' : '';
            $dependentsList[] = [
                'name' => trim("$s, $g $mi"),
                'birthday' => !empty($b) ? date("F j, Y", strtotime($b)) : ""
            ];
        }
    }
}
?>

<div class="report-container">
    <h2 class="mb-4">Sample Report</h2>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <table>
            <tr>
                <th>Name:</th>
                <td><?= htmlspecialchars($fullName) ?></td>
            </tr>
            <tr>
                <th>Birthday:</th>
                <td><?= htmlspecialchars($formattedBday) ?></td>
            </tr>
            <tr>
                <th>Contact Number:</th>
                <td><?= htmlspecialchars($contactDisplay) ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?= htmlspecialchars($emailDisplay) ?></td>
            </tr>
            <tr>
                <th>Gender:</th>
                <td><?= htmlspecialchars($gender) ?></td>
            </tr>
            <tr>
                <th>Address:</th>
                <td><?= htmlspecialchars($fullAddress) ?></td>
            </tr>
            <tr>
                <th>Dependents:</th>
                <td style="padding: 0;">
                    <?php if (!empty($dependentsList)): ?>
                    <table class="nested-table">
                        <tr>
                            <th>Name</th>
                            <th>Birthday</th>
                        </tr>
                        <?php foreach ($dependentsList as $dep): ?>
                        <tr>
                            <td><?= htmlspecialchars($dep['name']) ?></td>
                            <td><?= htmlspecialchars($dep['birthday']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <?php else: ?>
                        <div style="padding: 15px;">No dependents listed.</div>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">No data submitted. Please submit from the registration page.</div>
    <?php endif; ?>

    <!-- Student Info -->
    <div class="footer-info">
        Student Name: NARVASA, AILISH SOPHIA D. <br>
        Student Number: 202411893
    </div>
</div>

</body>
</html>
