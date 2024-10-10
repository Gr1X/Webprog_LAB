<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

        body {
            font-family: 'Rubik', sans-serif;
            transition: all 0.5s;
        }

        .top-bar {
            background-color: white;
            height: 50px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .account-header {
            margin-top: 50px;
            margin-bottom: 30px;
        }
        .card-custom {
            padding: 30px;
            padding-bottom: 20px;
            border-radius: 10px;
        }
        .account-details,.manage-account {
            margin-bottom: 30px;
        }
    </style>
</head>

<body class="bg-light">

<!-- White Bar at the Top -->
<div class="top-bar shadow"></div>

<div class="container mt-5">
    <!-- Account Header -->
    <div class="row account-header">
        <div class="my-4">
            <a href="#" class="text-decoration-none"><i class='bx bx-left-arrow-alt'></i>Back to dashboard</a>
        </div>
    </div>

    <!-- Account Details Section -->
    <div class="d-flex justify-content-center">
        <div class="col-7">
            <div class="col-12">
                <h2 class="display-4 fw-bold mb-3">Account</h2>
            </div>

            <div class="row account-details">
                <p class="fw-medium text-secondary mb-2">Account Details</p>
                <div class="col-md-12">
                    <div class="card card-custom border border-0 shadow-sm">
                        <h3 class="fw-semibold">KayooH264</h3>
                        <h5 class="text-secondary pb-4">Calvin Yoananda</h5>
                        <p class="fw-semibold">calvinsang.jawa@student.umm.ac.id</p>
                        <p class="fw-semibold">*************</p>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="text-decoration-none text-dark fw-medium">Manage Account</a>
                            <div class="d-flex align-items-center fs-4">
                                <a href="#"><i class='bx bx-chevron-right'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
                <!-- Manage Your Account Section -->
                <div class="row manage-account">
                <p class="fw-medium text-secondary mb-2">Manage Your Account</p>
                    <div class="col-md-12">
                        <div class="card card-custom border border-0 shadow-sm">
                            <h3 class="fw-semibold">Change my User Name</h3>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-decoration-none text-secondary fw-medium">Change my first name</a></li>
                                <li><a href="#" class="text-decoration-none text-secondary fw-medium">Change my last name</a></li>
                            </ul>
                            <ul class="list-unstyled mt-3">
                                <li><a href="#" class="text-decoration-none text-dark fw-semibold fs-6">Change my email</a></li>
                                <li><a href="#" class="text-decoration-none text-dark fw-semibold fs-6">Reset Password</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
