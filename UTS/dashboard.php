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
        background-color: #4723D9;
        width: 250px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
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
    }


</style>

<body>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav flex-column"> 
            <h3 class="text-center text-white mb-5 mt-3">Fontaine</h3>
            <a href="#" class="nav_link text-light d-flex align-items-center mb-3">
                <i class='bx bx-grid-alt nav_icon'></i>
                <span class="nav_name">Dashboard</span>
            </a>
            <a href="#" class="nav_link text-light d-flex align-items-center mb-3">
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
                    <img src="https://i.imgur.com/hczKIze.jpg" alt="Profile Image">
                    <div class="log-out-info">
                        <h6>Paul Melone</h6>
                        <p>Python Dev</p>
                    </div>
                    <div class="">
                        <i class="bx bx-chevron-right log-out-icon"></i>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main content -->
    <div class="main-content" id="main-content">
        <div class="container-fluid p-4 pb-2">
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div class="">
                    <h2>To Do List Dashboard</h2>
                    <p>Hello, Good Morning! Welcome<b> Jomok.</b></p>    
                </div>
                
                
                <div class="">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="dropdown-center px-3 mb-3">
            <button class="btn btn-primary dropdown-toggle px-4 rounded-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Filter by
            </button>
            <ul class="dropdown-menu shadow">
                <li class="d-flex justify-content-between">
                    <a class="dropdown-item text-success" href="#">Completed</a>
                    <div class="form-check form-check-reverse d-flex align-self-center">
                        <input class="form-check-input" type="checkbox" value="" id="reverseCheck1">
                    </div>
                </li>
                <li class="d-flex justify-content-between">
                    <a class="dropdown-item text-danger" href="#">Uncompleted</a>
                    <div class="form-check form-check-reverse d-flex align-self-center">
                        <input class="form-check-input" type="checkbox" value="" id="reverseCheck1">
                    </div>
                </li>
            </ul>
        </div>

        <div class="container text-center">
            <div class="row">
                <div class="col-4">
                    <div class="task-card card shadow" style="">
                        <div class="card-body">
                            <h5 class="text-start card-title">Progress</h5>
                            <div class="">
                                <table class="table text-start">
                                
                                <tbody>
                                    <tr>
                                        <td class="text-secondary fw-bold">Task</td>
                                        <td>
                                            <div class="form-check form-check-reverse d-flex justify-content-end">
                                                <input class="form-check-input" type="checkbox" value="" id="reverseCheck1">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-warning fw-bold">On progress</td>
                                        <td>
                                            <div class="form-check form-check-reverse d-flex justify-content-end">
                                                <input class="form-check-input" type="checkbox" value="" id="reverseCheck1">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-success fw-bold">Done</td>
                                        <td>
                                            <div class="form-check form-check-reverse d-flex justify-content-end">
                                                <input class="form-check-input" type="checkbox" value="" id="reverseCheck1">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>

                            <p class="card-text pt-3">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">See List</a>
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
                                        <td>Marks</td>
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

                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
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
