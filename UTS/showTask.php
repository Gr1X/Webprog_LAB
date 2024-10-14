<?php 
session_start();
require_once ('db.php');

if(!(isset($_SESSION['username']))){
  header('location:inputLogin.php');
}
$filter = isset($_POST['filter']) ? trim($_POST['filter']) : 'all';
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';


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

    .modal-header{
        background-color: #05112E;
        color:#FFFFFF;
    }

    /* Hide the default dropdown caret (arrow) */
    .tombol_drop::after {
        display: none;
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
            
            <div class="log-out-container">
                <div class="log-out-card">
                    <a href="pageUser.php" class="d-flex text-decoration-none">
                        <img src="https://i.imgur.com/hczKIze.jpg" alt="Profile Image">

                        <div class="log-out-info align-self-center text-dark">
                            <h6> <?php echo $username; ?> </h6>
                            <p> 
                                <?php 
                                // Batasi panjang email maksimal 15 karakter
                                $max_length = 15;
                                if (strlen($email) > $max_length) {
                                    echo substr($email, 0, $max_length) . '...';
                                } else {
                                    echo $email;
                                }
                                ?>
                            </p>
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
                    <h2>Show task</h2>
                    <p class="text-muted fw-semibold">Display all your activities</p>    
                </div>
                
                <div class="top_content">
                    <form action="showTask.php" method="POST" >
                        <input type="text" name="keyword" placeholder="Search Item">
                        <button type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="d-flex">
            <div class="dropdown-center px-2 ps-3 mb-3">
                <button class="btn btn-primary dropdown-toggle px-4 tombol_filter text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter by
                </button>
    
                <form action="showTask.php" method="POST">
                    <ul class="dropdown-menu shadow">
                        <li class="d-flex justify-content-between">
                            <label class="dropdown-item" style="pointer-events: none;">All</label>
                            <div class="form-check align-self-center m-0 p-0">
                                <input class="form-check-input mx-3 p-2" type="radio" name="filter" value="all" onchange="this.form.submit()" <?= $filter == 'all' ? 'checked' : '' ?>>
                            </div>
                        </li>
                        <li class="d-flex justify-content-between m-0 p-0">
                            <label class="dropdown-item" style="pointer-events: none;">Completed</label>
                            <div class="form-check d-flex align-self-center">
                                <input class="form-check-input mx-3 p-2" type="radio" name="filter" value="selesai" onchange="this.form.submit()" <?= $filter == 'selesai' ? 'checked' : '' ?>>
                            </div>
                        </li>
                        <li class="d-flex justify-content-between">
                            <label class="dropdown-item" style="pointer-events: none;">Uncompleted</label>
                            <div class="form-check d-flex align-self-center">
                                <input class="form-check-input mx-3 p-2" type="radio" name="filter" value="belum" onchange="this.form.submit()" <?= $filter == 'belum' ? 'checked' : '' ?>>
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
    
            <div class="mb-3">
                <button type="button" class="btn btn-success px-3 shadow" data-bs-toggle="modal" data-bs-target="#titleModal">
                    Add Tittle <i class='bx bx-plus fw-bold'></i>
                </button>

                <div class="modal fade border border-0" id="titleModal" tabindex="-1" aria-labelledby="titleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="titleModalLabel">Input Title</h1>
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
            <div class="row">
            <?php 
            $count = 0;
            foreach ($tabellist as $tabel): 
                if ($count % 2 == 0) {
                    echo '<div class="row mb-4">'; // Start new row
                }

                $query6 = "SELECT i.id_tabel, t.judul_tabel, i.id_todo, i.nama_item, i.progress 
                           FROM itemlist AS i
                           JOIN tabellist AS t ON t.id_tabel = i.id_tabel 
                           WHERE i.id_tabel = ?";

                // Add filter condition based on progress
                if ($filter == 'selesai') {
                    $query6 .= " AND i.progress = 'Selesai'";
                } elseif ($filter == 'belum') {
                    $query6 .= " AND i.progress = 'Belum'";
                }

                // Add keyword condition if it's not empty
                if (!empty($keyword)) {
                    $query6 .= " AND (t.judul_tabel LIKE ? OR i.nama_item LIKE ?)";
                }

                // Prepare the statement
                $stmt2 = $db->prepare($query6);

                // Bind parameters
                $params = [$tabel['id_tabel']];

                if (!empty($keyword)) {
                    // Add keyword parameters to the array
                    $params[] = "%$keyword%"; // For judul_tabel
                    $params[] = "%$keyword%"; // For nama_item
                }

                // Execute the statement with the parameters
                $stmt2->execute($params);
      
                $tasks = $stmt2->fetchAll(PDO::FETCH_ASSOC);
      
                // Only display tables with tasks matching the search keyword or if no keyword is provided
                if (!empty($tasks) || empty($keyword)) {
                ?>
                <div class="col-md-6 mb-2">
                    <div class="card task-card border-0 shadow-sm mb-4" style="background-color: #f8f9fa; border-radius: 8px;"> <!-- Soft background and rounded corners -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <!-- Table Title -->
                                <div class="d-flex">
                                    <h5 class="text-start card-title align-self-center me-2"><?= htmlspecialchars($tabel['judul_tabel']) ?></h5>
                                </div>

                                <!-- Table Dropdown -->
                                <div class="btn-group dropdown-center">
                                    <button type="button" class="btn btn-primary align-self-center px-3" data-bs-toggle="modal" data-bs-target="#addItemModal<?= $tabel['id_tabel'] ?>">Add Task</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button class="dropdown-item fw-semibold" type="button" data-bs-toggle="modal" data-bs-target="#editTableModal<?= $tabel['id_tabel'] ?>">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item fw-semibold text-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteTableModal<?= $tabel['id_tabel'] ?>">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Display Table Items -->
                            <ul class="list-group list-group-flush text-start">
                                <?php
                                // Fetch tasks for the current list
                                if (!empty($tasks)){
                                    foreach ($tasks as $task): ?>
                                        <li class="list-group-item d-flex justify-content-between p-2 bg-light">
                                          <form action="editProgress.php" method="POST" class="d-flex align-items-center">
                                              <!-- Task Name and Progress -->
                                              <input class="form-check-input m-1 p-2" type="checkbox" name="progress" value="<?=$task['progress']?>" <?= $task['progress'] === "Selesai" ? 'checked' : '' ?> onchange="this.form.submit()">
                                              <input type="hidden" name="id_todo" value="<?= $task['id_todo'] ?>">
                                              <span><?= htmlspecialchars($task['nama_item']) ?></span>
                                          </form>
                                            <!-- Edit/Delete Dropdown for Task -->
                                            <div class="dropdown-center">
                                                <button class="btn btn-sm px-2 dropdown-toggle tombol_drop" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: none; border: none;">
                                                    <i class='bx bx-dots-horizontal-rounded fs-4 text-center'></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <!-- Edit Task Option -->
                                                    <li>
                                                        <button class="dropdown-item fw-semibold" type="button" data-bs-toggle="modal" data-bs-target="#editTaskModal<?= $task['id_todo'] ?>">
                                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                                        </button>
                                                    </li>
                                                    <!-- Delete Task Option -->
                                                    <li>
                                                        <button class="dropdown-item text-danger text-danger fw-semibold" type="button" data-bs-toggle="modal" data-bs-target="#deleteTaskModal<?= $task['id_todo'] ?>">
                                                            <i class="fa-solid fa-trash"></i> Delete
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <!-- Modal for Editing Task -->
                                        <div class="modal fade" id="editTaskModal<?= $task['id_todo'] ?>" tabindex="-1" aria-labelledby="editTaskModalLabel<?= $task['id_todo'] ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editTaskModalLabel<?= $task['id_todo'] ?>">Edit Task</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="editItem.php" method="POST">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_todo" value="<?= $task['id_todo'] ?>">
                                                            <input type="text" class="form-control" required name="nama_item" placeholder="Task Name" value="<?= $task['nama_item'] ?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal for Deleting Task -->
                                        <div class="modal fade" id="deleteTaskModal<?= $task['id_todo'] ?>" tabindex="-1" aria-labelledby="deleteTaskModalLabel<?= $task['id_todo'] ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteTaskModalLabel<?= $task['id_todo'] ?>">Delete Task</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="deleteItem.php" method="POST">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_todo" value="<?= $task['id_todo'] ?>">
                                                            <input type="hidden" name="nama_item" value="<?= $task['nama_item'] ?>">
                                                            <p class="m-0">Are you sure you want to delete this task?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                }
                                else{ ?>
                                    <li class="list-group-item text-center fw-semibold fst-italic text-muted bg-light text-center mt-auto">No tasks available</li>
                                <?php }?>
                            </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Adding Item -->
                    <div class="modal fade" id="addItemModal<?= $tabel['id_tabel'] ?>" tabindex="-1" aria-labelledby="addItemModalLabel<?= $tabel['id_tabel'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addItemModalLabel<?= $tabel['id_tabel'] ?>">Add Task to <?= htmlspecialchars($tabel['judul_tabel']) ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="buatItem.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_tabel" value="<?= $tabel['id_tabel'] ?>">
                                        <input type="text" class="form-control mb-3" required name="nama_item" placeholder="Task Name">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Editing Table Title -->
                    <div class="modal fade" id="editTableModal<?= $tabel['id_tabel'] ?>" tabindex="-1" aria-labelledby="editTableModalLabel<?= $tabel['id_tabel'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editTableModalLabel<?= $tabel['id_tabel'] ?>">Edit List Title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="editTabel.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_tabel" value="<?= $tabel['id_tabel'] ?>">
                                        <input type="text" class="form-control" required name="judul_tabel" placeholder="New List Title" value="<?= htmlspecialchars($tabel['judul_tabel']) ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Deleting Table -->
                    <div class="modal fade" id="deleteTableModal<?= $tabel['id_tabel'] ?>" tabindex="-1" aria-labelledby="deleteTableModalLabel<?= $tabel['id_tabel'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteTableModalLabel<?= $tabel['id_tabel'] ?>">Delete List</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="deleteTabel.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_tabel" value="<?= $tabel['id_tabel'] ?>">
                                        <p class="m-0">Are you sure you want to delete this list and all its items?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php  
                }
                    $count++;
                    if ($count % 2 == 0) {
                        echo '</div>'; // Close row after two cards
                    }
                endforeach; 
                if ($count % 2 != 0) {
                    echo '</div>'; // Close the last row if there's only one card
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
