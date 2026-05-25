<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            font-family: 'Outfit', sans-serif;
            color: #333;
            min-height: 100vh;
            padding: 40px 0;
        }

        .container-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            max-width: 750px;
            margin: 0 auto;
        }

        h2, h4, h6 {
            font-weight: 700;
            color: #2c3e50;
        }
        
        h2 {
            text-align: center;
            margin-bottom: 30px !important;
            background: -webkit-linear-gradient(#764ba2, #667eea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 5px;
        }

        .form-control, .form-select, .input-group-text {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            transition: all 0.3s ease;
            background-color: #fcfcfc;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background-color: #fff;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(118, 75, 162, 0.3);
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

<div class="container">
    <div class="container-box">

        <h2 class="mb-4">Sample Registration</h2>
        <form action="Narvasa-Exer4-Report.php" method="POST">

        <!-- Name -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Given Name</label>
                <input type="text" class="form-control" name="gname" placeholder="e.g. Abraham" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Middle Name</label>
                <input type="text" class="form-control" name="mname" placeholder="e.g. Tan">
            </div>

            <div class="col-md-4">
                <label class="form-label">Surname</label>
                <input type="text" class="form-control" name="sname" placeholder="e.g. Magpantay" required>
            </div>
        </div>

        <!-- Email and Birthday -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Birthday</label>
                <input type="date" class="form-control" name="bday" required>
            </div>
        </div>

<!-- Address -->
<div class="row mb-3">
    
    <!-- Address Line 1 -->
    <div class="col-md-6">
        <label class="form-label">Address</label>
        <input type="text" class="form-control" name="address1"
               placeholder="Unit No / House / Bldg Name" required>
    </div>

    <!-- Address Line 2 -->
    <div class="col-md-6">
        <label class="form-label">&nbsp;</label>
        <input type="text" class="form-control" name="address2"
               placeholder="Street / Village / Subdiv">
    </div>

</div>

<!-- City, Zip Code, Country -->
<div class="row mb-3">

    <div class="col-md-4">
        <label class="form-label">City</label>
        <input type="text" class="form-control" name="city"
               placeholder="e.g. Manila" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Zip Code</label>
        <input type="text" class="form-control" name="zip"
               placeholder="e.g. 1111" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Country/Region</label>

        <select class="form-select" name="country" required>
            <option value="" selected>-- Select --</option>
            <option value="Philippines">Philippines</option>
            <option value="Japan">Japan</option>
            <option value="USA">USA</option>
        </select>
    </div>

</div>

<!-- Contact and Gender -->
<div class="row mb-3">

    <!-- Contact -->
    <div class="col-md-6">
        <label class="form-label">Contact</label>
        <input type="text" class="form-control" name="contact"
               placeholder="e.g. 09123456789" required>
    </div>

<!-- Gender -->
<div class="col-md-6">
    <label class="form-label">Gender</label>

    <div class="row">
        
        <!-- Male -->
        <div class="col-md-6">
            <div class="input-group">

                <div class="input-group-text">
                    <input class="form-check-input mt-0"
                           type="radio"
                           name="gender"
                           value="Male" required>
                </div>

                <input type="text"
                       class="form-control"
                       value="Male"
                       readonly>

            </div>
        </div>

        <!-- Female -->
        <div class="col-md-6">
            <div class="input-group">

                <div class="input-group-text">
                    <input class="form-check-input mt-0"
                           type="radio"
                           name="gender"
                           value="Female" required>
                </div>

                <input type="text"
                       class="form-control"
                       value="Female"
                       readonly>

            </div>
        </div>

    </div>
</div>

        <!-- Dependents -->
        <h4 class="mt-4">Dependents (Up to 3)</h4>

        <?php for($i=1; $i<=3; $i++): ?>
        <h6 class="mt-3">Dependent <?= $i ?></h6>
        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label">Given Name</label>
                <input type="text" class="form-control" name="dep_gname[]" placeholder="e.g. Abraham">
            </div>

            <div class="col-md-3">
                <label class="form-label">Middle Name</label>
                <input type="text" class="form-control" name="dep_mname[]" placeholder="e.g. Tan">
            </div>

            <div class="col-md-3">
                <label class="form-label">Surname</label>
                <input type="text" class="form-control" name="dep_sname[]" placeholder="e.g. Magpantay">
            </div>

            <div class="col-md-3">
                <label class="form-label">Birthday</label>
                <input type="date" class="form-control" name="dep_bday[]">
            </div>
        </div>
        <?php endfor; ?>

<!-- Agreement -->
<div class="row mb-3">
    <div class="col-md-12">

        <div class="form-check">
            <input class="form-check-input"
                   type="checkbox"
                   name="agree"
                   id="agree" required>

            <label class="form-check-label" for="agree">
                I agree that all information is correct.
            </label>
        </div>

    </div>
</div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Submit</button>

        </form>

        <!-- Student Info -->
        <div class="footer-info">
            Student Name: NARVASA, AILISH SOPHIA D. <br>
            Student Number: 202411893
        </div>

    </div>
</div>

</body>
</html>
