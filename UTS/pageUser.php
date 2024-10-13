<?php 
    session_start();
    require_once ('db.php');

    $id = $_SESSION['id_account'];

    $query17 = "SELECT * FROM Account WHERE id_account = ?";
    $stmt17 = $db->prepare($query17);
    $stmt17->execute([$id]);
    $akun = $stmt17->fetch(PDO::FETCH_ASSOC);
?>


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
        
        /* width */
        ::-webkit-scrollbar {
        width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        background: #d9d9d9d9; 
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #888; 
        border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #555; 
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
                        <h3 class="fw-semibold"><?= $akun['username']?></h3>
                        <h5 class="text-secondary pb-4 m-0"><?= $akun['namaDepan'] . " " . $akun['namaBelakang']?></h5>
                        <p class="fw-semibold"><?= $akun['email'] ?></p>
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
                <li class="">
                    <button type="button" class="btn btn-primary bg-transparent border border-0 text-dark fw-semibold text-muted" data-bs-toggle="modal" data-bs-target="#userNameModal">
                        Change My Username
                    </button>
                </li>

                <li class="">
                    <button type="button" class="btn btn-primary bg-transparent border border-0 text-dark fw-semibold text-muted" data-bs-toggle="modal" data-bs-target="#firstNameModal">
                        Change My Firstname
                    </button>
                </li>

                <li>
                    <button type="button" class="btn btn-primary bg-transparent border border-0 text-dark fw-semibold text-muted" data-bs-toggle="modal" data-bs-target="#lastNameModal">
                        Change My Lastname
                    </button>
                </li>

                <li>
                    <button type="button" class="btn btn-primary bg-transparent border border-0 text-dark fw-semibold" data-bs-toggle="modal" data-bs-target="#passwordModal">
                        Reset My Password
                    </button>
                </li>
    
                <li>
                    <button type="button" class="btn btn-primary bg-transparent border border-0 text-dark fw-semibold" data-bs-toggle="modal" data-bs-target="#emailModal">
                        Change My Email
                    </button>
                </li>
            </ul>
        </div>
        </div>
    </div>
</div>

<!-- Modal Change Username -->
<div class="modal fade" id="userNameModal" tabindex="-1" aria-labelledby="userNameLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="userNameLabel">Change Lastname</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="updateUsername.php" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="userNameInput" name="newUsername" placeholder="New Lastname" required>
                        <label for="lastnameInput">New Username</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
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
            <form action="updateFirstName.php" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="firstnameInput" placeholder="New Firstname" name="fname">
                    <label for="firstnameInput">New Firstname</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
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
            <form action="updateLastName.php" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="lastnameInput" placeholder="New Lastname" name="lname">
                    <label for="lastnameInput">New Lastname</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
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
            <form action="updatePassword.php" method="post">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="oldpasswordInput" name="oldPassword" placeholder="input Old Password">
                    <label for="oldpasswordInput">Old Password</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="newpasswordInput" name="newPassword" placeholder="New Password">
                    <label for="newpasswordInput">New Password</label>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<!-- Modal Change Email -->
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 fw-bold" id="emailLabel">Change Email</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="updateEmail.php" method="post">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="emailInput" placeholder="New Email" name="newEmail">
                    <label for="emailInput">New Email</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
