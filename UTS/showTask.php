<?php 
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View ToDoList</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
        overflow: hidden;
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

    .bungkus_card{
        background-color: #d9d9d9;
    }

    /* Menghilangkan panah pada button dropdown */
    .tombol_drop[data-bs-toggle="dropdown"]::after {
        display: none; /* Menghilangkan simbol panah bawaan */
    }

    .modal-header{
        background-color: #05112E;
        color:#FFFFFF;
    }
</style>

<body>
    <div class="top-bar"></div>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav flex-column"> 
            <h3 class="text-center text-white mb-5 mt-3">Fontaine</h3>
            <a href="dashboard.php" class="nav_link text-light d-flex align-items-center mb-3">
                <i class='bx bx-grid-alt nav_icon'></i>
                <span class="nav_name">Dashboard</span>
            </a>
            <a href="showTask.php" class="nav_link text-light d-flex align-items-center mb-3">
                <i class='bx bx-user nav_icon'></i>
                <span class="nav_name">Show task</span>
            </a>
            <a href="#" class="nav_link text-light d-flex align-items-center mb-3">
                <i class="fa-solid fa-eye nav_icon"></i>
                <span class="nav_name">View</span>
            </a>
            <a href="#" class="nav_link text-light d-flex align-items-center mb-3">
                <i class="fa-solid fa-pen nav_icon"></i>
                <span class="nav_name">Edit</span>
            </a>
            <a href="#" class="nav_link text-light d-flex align-items-center mb-3">
                <i class="fa-solid fa-trash nav_icon"></i>
                <span class="nav_name">Delete</span>
            </a>
            
            <div class="log-out-container">
                <div class="log-out-card">
                    <a href="pageUser.php" class="d-flex text-decoration-none">
                        <img src="https://i.imgur.com/hczKIze.jpg" alt="Profile Image">

                        <div class="log-out-info align-self-center text-dark">
                            <h6>Paul Melone</h6>
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
                    <h2>View task</h2>
                    <p class="text-muted fw-semibold">Display all your activities</p>    
                </div>
                
                
                <div class="top_content">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="d-flex">
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
    
            <div class="mb-3">
                <button type="button" class="btn btn-success px-3 shadow" data-bs-toggle="modal" data-bs-target="#titleModal">
                    <i class='bx bx-plus fw-bold'></i>
                </button>

                <div class="modal fade border border-0" id="titleModal" tabindex="-1" aria-labelledby="titleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="titleModalLabel">Input Title Task</h1>
                            </div>
                            
                            <!-- input judul -->
                            <form action="buatList.php" method="post">
                                <div class="modal-body">
                                    <div class="input-group d-block">
                                        <div class="d-flex justify-content-center p-2">
                                            
                                        </div>
                                        <div class="">
                                            <label class="form-label fw-semibold">Task title</label>
                                            <input type="text" class="form-control border border-0 border-bottom border-2 bg-light" required name="judul_tabel" id="exampleDropdownFormEmail1" placeholder="Title">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger fw-semibold shadow-sm" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x fw-bold fs-4'></i></button>
                                    <button type="submit" class="btn btn-success fw-semibold shadow-sm"><i class='bx bx-check fw-bold fs-4'></i></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="container text-center overflow-auto py-1" style="max-height: 480px;">
            <div class="row mb-3">
                <div class="col">
                    <div class="task-card card border border-0" style="">
                        <div class="card-body shadow-sm">
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="text-start card-title align-self-center p-0 m-0">Monday</h5>

                                <!-- Trigger Button for Modal -->
                                <button type="button" class="btn btn-primary align-self-center px-2" data-bs-toggle="modal" data-bs-target="#addActivityModal">
                                    Add activity
                                </button>

                                <!-- Modal -->
                                <div class="modal fade border border-0" id="addActivityModal" tabindex="-1" aria-labelledby="activityModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header shadow-sm">
                                                <h1 class="modal-title fs-5" id="activityModalLabel">Activity</h1>
                                            </div>

                                            <!-- Inputs form -->
                                            <form action="#" method="post">
                                                <div class="modal-body">
                                                    <div class="input-group d-block">
                                                        <div class="d-flex justify-content-center p-2"></div>
                                                        <div class="text-start">
                                                            <label for="activityDropdown" class="form-label fw-semibold">Add Activity</label>
                                                            <input type="text" class="form-control border border-0 border-bottom border-2 bg-light" required name="judul_tabel" id="activityDropdown" placeholder="Add Activity">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger fw-semibold shadow-sm" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class='bx bx-x fw-bold fs-4'></i>
                                                    </button>
                                                    <button type="submit" class="btn btn-success fw-semibold shadow-sm">
                                                        <i class='bx bx-check fw-bold fs-4'></i>
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Isi tabel -->
                            <div class="">
                                <table class="table text-start">
                                    <tbody>
                                        <tr>
                                            <td class="p-0">
                                                <div class="d-flex gap-2">
                                                    <div class="form-check form-check-reverse d-flex justify-content-end align-self-center">
                                                        <input class="form-check-input" type="checkbox" value="" id="reverseCheck1">
                                                    </div>
                                                    <p class="m-0 p-0 align-self-center">Lorem Ipsum</p>
                                                </div>
                                            </td>

                                            <td class="d-flex justify-content-end p-0">
                                                <div class="align-self-center">
                                                    <div class="dropdown-center">
                                                        <form action="" method="post">
                                                            <button class="btn btn-sm dropdown-toggle tombol_drop" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class='bx bx-dots-horizontal-rounded align-self-center fs-4'></i>
                                                            </button>
        
                                                            <ul class="dropdown-menu p-1 px-1">
                                                                <div class="d-flex justify-content-between gap-2">
                                                                    <li>
                                                                        <div class="dropdown-item m-0 p-0" href="#">
                                                                            <button type="button" class="btn btn-primary align-self-center px-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                                <i class="fa-solid fa-pen-to-square mx-2"></i>
                                                                            </button>
    
                                                                            <div class="modal fade border border-0" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Input Title Task</h1>
                                                                                        </div>
    
                                                                                        <!-- Input Edit Task-->
                                                                                        <form action="#" method="post">
                                                                                            <div class="modal-body">
                                                                                                <div class="input-group mb-3">
                                                                                                    <div class="d-flex justify-content-center p-2"></div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="exampleDropdownFormEmail1" class="form-label">Task title</label>
                                                                                                        <input type="text" class="form-control border border-0 border-bottom border-2 bg-light" required name="judul_tabel" id="exampleDropdownFormEmail1" placeholder="email@example.com">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
    
                                                                                            <div class="modal-footer">
                                                                                                <button type="button" class="btn btn-danger fw-semibold shadow-sm" data-bs-dismiss="modal" aria-label="Close">
                                                                                                    <i class='bx bx-x fw-bold fs-4'></i>
                                                                                                </button>
                                                                                                <button type="submit" class="btn btn-success fw-semibold shadow-sm">
                                                                                                    <i class='bx bx-check fw-bold fs-4'></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>


                                                                    <li>
                                                                        <div class="dropdown-item p-0" href="#">
                                                                            <button type="button" class="btn btn-primary align-self-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                                <i class="fa-solid fa-trash mx-1"></i>
                                                                            </button>
    
                                                                            <div class="modal fade border border-0" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Input Title Task</h1>
                                                                                        </div>
    
                                                                                        <!-- Tombol Delete -->
                                                                                        <form action="#" method="post">
                                                                                            <div class="modal-body">
                                                                                                <div class="input-group mb-3">
                                                                                                    <div class="d-flex justify-content-center p-2"></div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="exampleDropdownFormEmail1" class="form-label">Task title</label>
                                                                                                        <input type="text" class="form-control border border-0 border-bottom border-2 bg-light" required name="judul_tabel" id="exampleDropdownFormEmail1" placeholder="email@example.com">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
    
                                                                                            <div class="modal-footer">
                                                                                                <button type="button" class="btn btn-danger fw-semibold shadow-sm" data-bs-dismiss="modal" aria-label="Close">
                                                                                                    <i class='bx bx-x fw-bold fs-4'></i>
                                                                                                </button>
                                                                                                <button type="submit" class="btn btn-success fw-semibold shadow-sm">
                                                                                                    <i class='bx bx-check fw-bold fs-4'></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                </div>
                                                            </ul>
                                                        </form>
                                                    </div>
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
    </div>
</body>
</html>
