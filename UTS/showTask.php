<?php 
session_start();
require_once ('db.php');

$username = $_SESSION['username'];

$query5 = "SELECT id_tabel, judul_tabel
           FROM tabellist
           WHERE username = ?";
$stmt5 = $db->prepare($query5);
$stmt5->execute([$username]);
$tabellist = $stmt5->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View ToDoList</title>
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


</style>

<>
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
                    <p>See your task today</p>    
                </div>
                
                
                <div class="top_content">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <div class="dropdown-center px-3 mb-3">
                <button class="btn btn-primary dropdown-toggle px-4 rounded-3 fw-semibold" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter by
                </button>
    
                <ul class="dropdown-menu shadow">
                    <li class="d-flex justify-content-between">
                        <label class="dropdown-item text-success" href="#">Completed</label>
                        <div class="form-check form-check-reverse d-flex align-self-center">
                            <input class="form-check-input" type="checkbox" value="completed" id="reverseCheck1">
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
    
            <div class="">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class='bx bx-plus' ></i>
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Input Title Task</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <!-- input judul -->
                            <form action="buatList.php" method="post">
                                <div class="modal-body">
                                    <div class="input-group mb-3">
                                        <div class="d-flex justify-content-center p-2">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                        <input type="text" class="form-control border border-0 border-bottom border-2 bg-light" required name="judul_tabel" placeholder="Judul List" aria-label="Judul List" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-center overflow-auto" style="max-height: 400px;">
            <div class="row mb-3">
                <?php 
                $count = 0;
                // batasin muncul 2 per baris
                foreach ($tabellist as $tabel): 
                    if ($count % 2 == 0) {
                        if ($count > 0) {
                            echo '</div>';
                        }
                        echo '<div class="row mb-3">'; // buat baris baru
                    }
                ?>
                    <div class="col-md-6">
                        <div class="task-card card shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="text-start card-title"><?= htmlspecialchars($tabel['judul_tabel']) ?></h5>
                                    <!-- Add Item Button -->
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal<?= $tabel['id_tabel'] ?>">
                                        Add Item
                                    </button>
                                </div>
                                <div>
                                    <table class="table text-start">
                                        <tbody>
                                            <?php
                                            // fetch item untuk list
                                            $query7 = "SELECT nama_item, progress FROM itemlist WHERE id_tabel = ?";
                                            $stmt7 = $db->prepare($query7);
                                            $stmt7->execute([$tabel['id_tabel']]);
                                            $tasks = $stmt7->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($tasks as $task): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($task['nama_item']) ?></td>
                                                <td>
                                                    <div class="form-check form-check-reverse d-flex justify-content-end">
                                                        <input class="form-check-input" type="checkbox" value="" <?= $task['progress'] == 'Selesai' ? 'checked' : '' ?> disabled>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Adding Item -->
                    <div class="modal fade" id="addItemModal<?= $tabel['id_tabel'] ?>" tabindex="-1" aria-labelledby="addItemModalLabel<?= $tabel['id_tabel'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addItemModalLabel<?= $tabel['id_tabel'] ?>">Add Item to <?= htmlspecialchars($tabel['judul_tabel']) ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="buatItem.php" method="POST">
                                    <div class="modal-body">
                                        <div class="input-group mb-3">
                                            <input type="hidden" name="id_tabel" value="<?= $tabel['id_tabel'] ?>">
                                            <input type="text" class="form-control border border-0 border-bottom border-2 bg-light" required name="nama_item" placeholder="Nama Item" aria-label="Nama Item" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php 
                    $count++;
                    // Tutup baris kalau udah 2
                    if ($count % 2 == 0) {
                        echo '</div>';
                    }
                endforeach; 

                // di akhir, tutup juga klo cuma 1
                if ($count % 2 != 0) {
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
