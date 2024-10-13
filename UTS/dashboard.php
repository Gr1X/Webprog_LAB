<?php 
    session_start();
    if(!(isset($_SESSION['username']))){
        header('location:inputLogin.php');
    }
    $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard ToDoList</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/af48b2d60e.js" crossorigin="anonymous"></script>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

    body {
        font-family: 'Rubik', sans-serif;
        transition: all 0.5s;
        background-color: #d9d9d9;
    }

    .l-navbar {
        background-color: #05112E;
        width: 250px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        z-index: 1000;
    }

    .main-content {
        margin-left: 250px;
        padding: 2rem;
    }

    .nav_link {
        display: flex;
        align-items: center;
        padding: 0.5rem 1.5rem;
        color: #AFA5D9;
        text-decoration: none;
    }

    .nav_icon {
        margin-right: 1rem;
    }

    .log-out-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #fff;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 15px;
    }

    .log-out-card img {
        border-radius: 50%;
        width: 45px;
        height: 45px;
    }

    .log-out-info {
        margin-left: 10px;
        flex-grow: 1;
    }

    .log-out-info h6 {
        margin: 0;
        font-size: 14px;
    }

    .log-out-info p {
        margin: 0;
        font-size: 12px;
        color: gray;
    }

    .log-out-icon {
        color: #AFA5D9;
        font-size: 18px;
    }

    .log-out-container {
        margin-top: auto;
        width: 100%;
        padding: 15px 0;
        position: absolute;
        bottom: 0;
    }

    form input {
        border-radius: 20px;
        padding: 10px 20px;
    }

    form button {
        border-radius: 20px;
        padding: 10px 20px;
    }

    .task-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        background-color: #FFFFFF;
    }

    .progress-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        background-color: #212B44;
    }

    .top-bar {
            background-color: #FFFFFF;
            height: 50px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .top_content{
        z-index: 1000;
    }

    .tombol_drop[data-bs-toggle="dropdown"]::after {
        display: none; /* Menghilangkan simbol panah bawaan */
    }

</style>

<body>
    <div class="top-bar"></div>

    </div>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav flex-column"> 
            <h3 class="text-center text-white mb-5 mt-3">Fontaine</h3>
            <a href="#" class="nav_link text-light d-flex align-items-center mb-3">
                <i class='bx bx-grid-alt nav_icon'></i>
                <span class="nav_name">Dashboard</span>
            </a>
            <a href="showTask.php" class="nav_link text-light d-flex align-items-center mb-3">
                <i class='bx bx-user nav_icon'></i>
                <span class="nav_name">Show task</span>
            </a>
            
            <div class="log-out-container">
                <div class="log-out-card">
                    <a href="pageUser.php" class="d-flex text-decoration-none">
                        <img src="https://i.imgur.com/hczKIze.jpg" alt="Profile Image">

                        <div class="log-out-info align-self-center text-dark">
                            <h6> <?php echo $username; ?> </h6>
                            <p>Python Dev</p>
                        </div>
                    </a>
                    <div>
                        <a href="logout.php" class="d-flex align-items-center text-decoration-none">
                            <i class='bx bxs-log-out fs-4 text-dark text-center'></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main content -->
    <div class="main-content" id="main-content">
        <div class="container-fluid p-4 pb-2">
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div class="top_content mt-3">
                    <h2 class="">To Do List Dashboard</h2>
                    <i>
                        <p class="fs-5">Hello, Good Morning! Welcome <b class="text-dark"><?php echo $username;?></b></p>    
                    </i>
                </div>
                
                
                <div class="top_content ">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="dropdown-center px-2 ps-3 mb-3">
            <button class="btn btn-primary dropdown-toggle px-4 tombol_filter text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Filter by
            </button>
    
            <ul class="dropdown-menu shadow">
                <li class="d-flex justify-content-between">
                    <label class="dropdown-item" style="pointer-events: none;">Completed</label>
                    <div class="form-check form-check-reverse d-flex align-self-center">
                        <input class="form-check-input" type="checkbox" value="completed" id="reverseCheck1">
                    </div>
                </li>
                <li class="d-flex justify-content-between">
                    <label class="dropdown-item" style="pointer-events: none;">Uncompleted</label>
                    <div class="form-check form-check-reverse d-flex align-self-center">
                        <input class="form-check-input" type="checkbox" value="" id="reverseCheck1">
                    </div>
                </li>
            </ul>
        </div>

        <div class="container text-center">
            <div class="row">
                <div class="col-4">
                    <div class="progress-card card shadow" style="">
                        <div class="card-body">
                            <h5 class="text-start card-title text-white">Progress</h5>
                            
                            <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 55%"></div>
                            </div>

                            <div class="mt-4">
                                <table class="table text-start">
                                <tbody>
                                    <tr>
                                        <td class="text-light fw-bold">Task</td>
                                        <td>
                                            <div class="form-check form-check-reverse d-flex justify-content-end">
                                                <p class="fw-bold p-0 m-0 text-white">10</p>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-warning fw-bold">On progress</td>
                                        <td>
                                            <div class="form-check form-check-reverse d-flex justify-content-end">
                                                <p class="fw-bold p-0 m-0 text-warning">20</p>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-success fw-bold">Done</td>
                                        <td>
                                            <div class="form-check form-check-reverse d-flex justify-content-end">
                                                <p class="fw-bold p-0 m-0 text-success">30</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>

                            <a href="#" class="btn btn-primary mt-5 d-block">See List</a>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="task-card card shadow" style="">
                        <div class="card-body">
                            <h5 class="text-start card-title">Today</h5>
                            <div class="">
                                <table class="table text-start">
                                
                                <tbody>
                                    <tr>
                                        <td class="p-0 pt-1">
                                            <div class="d-flex gap-2">
                                                <div class="form-check form-check-reverse d-flex justify-content-end align-self-center">
                                                    <input class="form-check-input" type="checkbox" value="" id="reverseCheck1">
                                                </div>
                                                <p class="m-0 p-0 align-self-center">Marks</p>
                                            </div>
                                        </td>
                                        <td class="d-flex justify-content-end p-0">
                                            <div class="align-self-center">
                                                <div class="dropdown-center">
                                                    <form action="" method="post">
                                                        <button class="btn btn-sm dropdown-toggle tombol_drop" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class='bx bx-dots-horizontal-rounded align-self-center fs-4'></i>
                                                        </button>
    
                                                        <ul class="dropdown-menu">
                                                            <div class="d-flex justify-content-center">
                                                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-pen-to-square"></i></a></li>
                                                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-trash"></i></a></li>    
                                                            </div>
                                                        </ul>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td class="">Marks</td>
                                        <td>
                                            <div class="form-check form-check-reverse d-flex justify-content-end">
                                                <input class="form-check-input" type="checkbox" value="" id="reverseCheck1">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="">Marks</td>
                                        <td>
                                            <div class="form-check form-check-reverse d-flex justify-content-end">
                                                <input class="form-check-input" type="checkbox" value="" id="reverseCheck1">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="">Marks</td>
                                        <td>
                                            <div class="form-check form-check-reverse d-flex justify-content-end">
                                                <input class="form-check-input" type="checkbox" value="" id="reverseCheck1">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-8"></div>
            </div>
        </div>
    </div>

</body>
</html>
