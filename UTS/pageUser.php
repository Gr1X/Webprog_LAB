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
            background-color: #212B44;
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

        .modal-header{
            background-color: #212B44;
            color: #FFFFFF;
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
            <a href="dashboard.php" class="d-flex text-decoration-none align-item-center text-dark">
                <i class='bx bx-left-arrow-alt align-self-center fs-3 fw-semibold'></i>
                <p class="align-self-center m-0 fs-5 fw-semibold"> Back to dashboard</p>            
            </a>
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
                            <button type="button" class="text-decoration-none text-dark fw-medium bg-transparent border border-0" data-bs-toggle="modal" data-bs-target="#manageModal">Manage Account</button>

                            <div class="d-flex align-items-center fs-4">
                                <button type="button" class="btn btn-primary bg-transparent border border-0" data-bs-toggle="modal" data-bs-target="#manageModal">
                                    <i class='bx bx-chevron-right text-dark'></i>
                                </button>
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
                        <h3 class="fw-semibold">Change my Username</h3>
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

<!-- Modal Changeusername -->
<div class="modal fade" id="manageModal" tabindex="-1" aria-labelledby="manageUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 fw-bold" id="manageUserLabel">Change my Username</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <ul class="list-unstyled">
                <li>
                    <button type="button" class="btn btn-primary bg-transparent border border-0 text-dark" data-bs-toggle="modal" data-bs-target="#firstNameModal">
                        Change My Firstname<i class='bx bx-chevron-right text-dark'></i>
                    </button>

                    <button type="button" class="btn btn-primary bg-transparent border border-0 text-dark" data-bs-toggle="modal" data-bs-target="#lastNameModal">
                        Change My Lastname<i class='bx bx-chevron-right text-dark'></i>
                    </button>

                    <button type="button" class="btn btn-primary bg-transparent border border-0 text-dark" data-bs-toggle="modal" data-bs-target="#passwordModal">
                        Reset My Password<i class='bx bx-chevron-right text-dark'></i>
                    </button>

                    <button type="button" class="btn btn-primary bg-transparent border border-0 text-dark" data-bs-toggle="modal" data-bs-target="#emailModal">
                        Change My Email<i class='bx bx-chevron-right text-dark'></i>
                    </button>

                </li>
            </ul>
        </div>
        </div>
    </div>
</div>

<!-- Modal Change Nama Depan -->
<div class="modal fade" id="firstNameModal" tabindex="-1" aria-labelledby="firstNameLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 fw-bold" id="firstNameLabel">Change Firstname</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <label for="">First Name</label>
                <input type="text" aria-label="First name" class="form-control" placeholder="Input Firstname">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal Change Nama Belakang -->
<div class="modal fade" id="lastNameModal" tabindex="-1" aria-labelledby="lastNameLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 fw-bold" id="lastNameLabel">Change Lastname</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <label for="">New Last Name</label>
                <input type="text" aria-label="Last name" class="form-control" placeholder="Input Lastname">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal Reset Password -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 fw-bold" id="passwordLabel">Reset Password</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <label for="">Old Password</label>
                <input type="password" aria-label="oldpassword" class="form-control" placeholder="Input Old Password">
                <label for="">Re-input Old Password</label>
                <input type="password" aria-label="repassword" class="form-control" placeholder="Reinput Old Password">
                <label for="">New Password</label>
                <input type="password" aria-label="newpassword" class="form-control" placeholder="New Password">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal Change Email -->
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 fw-bold" id="emailLabel">Reset Password</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <label for="">Change Email</label>
                <input type="email" aria-label="newpassword" class="form-control" placeholder="Change Email">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
