<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background-color: #f5f5f5;
        }

        .container-box{
            background: white;
            padding: 30px;
            margin-top: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }

        .footer-info{
            margin-top: 30px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="container-box">

        <h2 class="mb-4">Sample Registration</h2>

        <!-- Name -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Given Name</label>
                <input type="text" class="form-control" placeholder="e.g. Abraham">
            </div>

            <div class="col-md-4">
                <label class="form-label">Middle Name</label>
                <input type="text" class="form-control" placeholder="e.g. Tan">
            </div>

            <div class="col-md-4">
                <label class="form-label">Surname</label>
                <input type="text" class="form-control" placeholder="e.g. Magpantay">
            </div>
        </div>

        <!-- Email and Birthday -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" placeholder="Enter email">
            </div>

            <div class="col-md-6">
                <label class="form-label">Birthday</label>
                <input type="date" class="form-control">
            </div>
        </div>

<!-- Address -->
<div class="row mb-3">
    
    <!-- Address Line 1 -->
    <div class="col-md-6">
        <label class="form-label">Address</label>
        <input type="text" class="form-control"
               placeholder="Unit No / House / Bldg Name">
    </div>

    <!-- Address Line 2 -->
    <div class="col-md-6">
        <label class="form-label">&nbsp;</label>
        <input type="text" class="form-control"
               placeholder="Street / Village / Subdiv">
    </div>

</div>

<!-- City, Zip Code, Country -->
<div class="row mb-3">

    <div class="col-md-4">
        <label class="form-label">City</label>
        <input type="text" class="form-control"
               placeholder="e.g. Manila">
    </div>

    <div class="col-md-4">
        <label class="form-label">Zip Code</label>
        <input type="text" class="form-control"
               placeholder="e.g. 1111">
    </div>

    <div class="col-md-4">
        <label class="form-label">Country/Region</label>

        <select class="form-select">
            <option selected>-- Select --</option>
            <option>Philippines</option>
            <option>Japan</option>
            <option>USA</option>
        </select>
    </div>

</div>

<!-- Contact and Gender -->
<div class="row mb-3">

    <!-- Contact -->
    <div class="col-md-6">
        <label class="form-label">Contact</label>
        <input type="text" class="form-control"
               placeholder="e.g. 09123456789">
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
                           value="Male">
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
                           value="Female">
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
        <h4 class="mt-4">Dependents</h4>

        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label">Given Name</label>
                <input type="text" class="form-control"
                 placeholder="e.g. Abraham">
            </div>

            <div class="col-md-3">
                <label class="form-label">Middle Name</label>
                <input type="text" class="form-control"
                 placeholder="e.g. Tan">
            </div>

            <div class="col-md-3">
                <label class="form-label">Surname</label>
                <input type="text" class="form-control"
                placeholder="e.g. Magpantay">
            </div>

            <div class="col-md-3">
                <label class="form-label">Birthday</label>
                <input type="date" class="form-control">
            </div>
        </div>

<!-- Agreement -->
<div class="row mb-3">
    <div class="col-md-12">

        <div class="form-check">
            <input class="form-check-input"
                   type="checkbox"
                   id="agree">

            <label class="form-check-label" for="agree">
                I agree that all information is correct.
            </label>
        </div>

    </div>
</div>

        <!-- Submit -->
        <button class="btn btn-primary">Submit</button>

        <!-- Student Info -->
        <div class="footer-info">
            Student Name: NARVASA, AILISH SOPHIA D. <br>
            Student Number: 202411893
        </div>

    </div>
</div>

</body>
</html>
