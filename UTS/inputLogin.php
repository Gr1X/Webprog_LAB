<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/af48b2d60e.js" crossorigin="anonymous"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');
        
        .body {
            font-family: 'Rubik', sans-serif;
            background-image: url('../element/bg.jpg');
            background-size: cover; 
            background-position: center;
            background-repeat: no-repeat;
        }

        .pass:focus, .email:focus {
            outline: none;
            box-shadow: none;
        }
    </style>
</head>

<body class="body d-flex justify-content-center align-items-center min-vh-100">
    <div class="container">
        <div class="bg-light col-lg-6 col-md-8 col-sm-10 col-12 mx-auto rounded-3 shadow p-4">
            <div class="title text-center mb-4">
                <h1>Log-in</h1>
                <p class="">Hello, enter your details to sign in to your account.</p>
            </div>
            
            <div class="d-flex justify-content-center">
                <div class="col-8">
                    <form action="verifyPassword.php" method="post">

                        <div class="input-group mb-3">
                            <div class="d-flex justify-content-center p-2">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <input type="email" class="email form-control border border-0 border-bottom border-2 bg-light" name="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                        </div>
    
                        <div class="input-group mb-3">
                            <div class="d-flex justify-content-center p-2">
                                <i class="fa-solid fa-user text-center"></i>
                            </div>
                            <input type="text" class="pass form-control border border-0 border-bottom border-2 bg-light" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
        
                        <div class="input-group mb-3">
                            <div class="d-flex justify-content-center p-2">
                                <i class="fa-solid fa-lock text-center"></i>
                            </div>
                            <input type="password" class="pass form-control border border-0 border-bottom border-2 bg-light" name="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                        </div>
                        
                        <div class="d-block my-3">
                            <button type="submit" class="btn btn-primary w-100 py-2 shadow-sm fw-semibold">Login</button>
                        </div>
                        
                        <div class="text-center">
                            <p>Don't have an account? <a href="inputRegister.php" class="fw-semiboldtext-dark link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Sign Up now.</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
