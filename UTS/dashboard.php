<?php 
require_once('db.php');
session_start();

if(!(isset($_SESSION['username']))){
    header('location:inputLogin.php');
}
$username = $_SESSION['username'];
$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['select'])) {
  $_SESSION['select'] = $_POST['select']; // Set the session variable from POST data
}

$query29 = "SELECT id_tabel, judul_tabel
            FROM tabellist 
            WHERE username = ?";
$stmt29 = $db->prepare($query29);
$stmt29->execute([$username]);
$lists = $stmt29->fetchAll(PDO::FETCH_ASSOC);

if (isset($_SESSION['select'])){
  $selectedListId = $_SESSION['select'];

  // Step 2: Fetch the selected list title and its items
  $query30 = "SELECT t.judul_tabel, i.id_todo, i.nama_item, i.progress
              FROM itemlist AS i
              RIGHT JOIN tabellist AS t ON t.id_tabel = i.id_tabel
              WHERE t.username = ? AND t.id_tabel = ?
              GROUP BY i.id_todo";

  $stmt30 = $db->prepare($query30);
  $stmt30->execute([$username, $selectedListId]);
  $listDetails = $stmt30->fetchAll(PDO::FETCH_ASSOC);

  // Check if list items were found
  if (!empty($listDetails)) {
      $listTitle = $listDetails[0]['judul_tabel'];  // List title

      $query31 = "SELECT 
                      t.judul_tabel,
                      COUNT(i.id_todo) AS total_tasks, 
                      SUM(CASE WHEN i.progress = 'Selesai' THEN 1 ELSE 0 END) AS selesai_tasks,
                      SUM(CASE WHEN i.progress = 'Belum' THEN 1 ELSE 0 END) AS belum_tasks
                  FROM itemlist AS i
                  JOIN tabellist AS t ON t.id_tabel = i.id_tabel
                  WHERE t.username = ? AND t.id_tabel = ?
                  GROUP BY t.judul_tabel WITH ROLLUP";
      
      $stmt31 = $db->prepare($query31);
      $stmt31->execute([$username, $selectedListId]);
      $listProgress = $stmt31->fetchAll(PDO::FETCH_ASSOC);

      if(!empty($listDetails[0]['id_todo'])){
          $totalTasks = $listProgress[0]['total_tasks'];
          $completedTasks = $listProgress[0]['selesai_tasks'];
          $uncompletedTasks = $listProgress[0]['belum_tasks'];

          // Calculate the progress percentage (avoid division by zero)
          $progressPercentage = ($totalTasks > 0) ? ($completedTasks / $totalTasks) * 100 : 0;
      }
  } else
  {
      $listTitle = $listDetails[0]['judul_tabel'];
  }
}
else{
  $listTitle = "Please select a list.";
}

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
                            <h6> 
                                <?php 
                                // Escape output $username untuk mencegah XSS
                                echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); 
                                ?> 
                            </h6>
                            <p>
                                <?php 
                                // Batasi panjang email maksimal 15 karakter
                                $max_length = 15;
                                // Escape output $email untuk mencegah XSS
                                $escaped_email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
                                
                                if (strlen($escaped_email) > $max_length) {
                                    echo substr($escaped_email, 0, $max_length) . '...';
                                } else {
                                    echo $escaped_email;
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
                    <h2 class="">To Do List Dashboard</h2>
                    <i>
                        <p class="fs-5">Hello, Good Morning! Welcome 
                            <b class="text-dark">
                                <?php 
                                // Escape output $username untuk mencegah XSS
                                echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); 
                                ?>
                            </b>
                        </p>    
                    </i>
                </div>
                
                <!-- Select List -->
                <form method="POST" action="dashboard.php">
                    <div class="dropdown-center px-2 ps-3 mb-3">
                        <button class="btn btn-primary dropdown-toggle px-4 tombol_filter text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select List
                        </button>
                        <ul class="dropdown-menu">
                        <?php if (!empty($lists)): ?>
                            <?php foreach ($lists as $list): ?>
                                <!-- The form will submit when the user clicks on a list item -->
                                <li>
                                    <button class="dropdown-item" type="submit" name="select" value="<?= htmlspecialchars($list['id_tabel'], ENT_QUOTES, 'UTF-8') ?>">
                                        <?= htmlspecialchars($list['judul_tabel'], ENT_QUOTES, 'UTF-8') ?>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><span class="dropdown-item">No lists available</span></li>
                        <?php endif; ?>
                        </ul>
                    </div>
                </form>
            </div>
        </div>

        <div class="container text-center">
            <div class="row">
                <div class="col-4">
                    <div class="progress-card card shadow" style="">
                        <div class="card-body">
                            <h5 class="text-start card-title text-white">Progress</h5>
                            
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" 
                                    style="width: <?php echo intval($progressPercentage); ?>%" 
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>

                            <div class="mt-4">
                            <table class="table text-start">
                                <tbody>
                                    <tr>
                                        <td class="text-light fw-bold">Total Task</td>
                                        <td>
                                            <div class="form-check form-check-reverse d-flex justify-content-end">
                                                <p class="fw-bold p-0 m-0 text-white">
                                                    <?php 
                                                    // Escape output untuk mencegah XSS
                                                    echo htmlspecialchars(isset($listProgress[0]['total_tasks']) ? $listProgress[0]['total_tasks'] : 0, ENT_QUOTES, 'UTF-8'); 
                                                    ?>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-warning fw-bold">Not Done</td>
                                        <td>
                                            <div class="form-check form-check-reverse d-flex justify-content-end">
                                                <p class="fw-bold p-0 m-0 text-warning">
                                                    <?php 
                                                    // Escape output untuk mencegah XSS
                                                    echo htmlspecialchars(isset($listProgress[0]['belum_tasks']) ? $listProgress[0]['belum_tasks'] : 0, ENT_QUOTES, 'UTF-8'); 
                                                    ?>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-success fw-bold">Completed</td>
                                        <td>
                                            <div class="form-check form-check-reverse d-flex justify-content-end">
                                                <p class="fw-bold p-0 m-0 text-success">
                                                    <?php 
                                                    // Escape output untuk mencegah XSS
                                                    echo htmlspecialchars(isset($listProgress[0]['selesai_tasks']) ? $listProgress[0]['selesai_tasks'] : 0, ENT_QUOTES, 'UTF-8'); 
                                                    ?>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>

                            <a href="showtask.php" class="btn btn-primary mt-5 d-block">See List</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="card task-card border-0 shadow-sm mb-4" style="background-color: #f8f9fa; border-radius: 8px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <!-- List Title -->
                                <h5 class="text-start card-title align-self-center me-2"><?= $listTitle ?></h5>

                                <!-- Add Task & Dropdown for Editing List -->
                                <?php if($listTitle != "Please select a list."):?>
                                <div class="btn-group dropdown-center">
                                    <button type="button" class="btn btn-primary align-self-center px-3" data-bs-toggle="modal" data-bs-target="#addItemModal<?= $selectedListId ?>">Add Task</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button class="dropdown-item fw-semibold" type="button" data-bs-toggle="modal" data-bs-target="#editTableModal<?= $selectedListId ?>">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit List Title
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item fw-semibold text-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteTableModal<?= $selectedListId ?>">
                                                <i class="fa-solid fa-trash"></i> Delete List
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <?php endif;?>
                            </div>

                            <!-- Display List Items -->
                            <ul class="list-group list-group-flush text-start">
                                <?php if (!empty($listDetails[0]['id_todo'])): ?>
                                    <?php foreach ($listDetails as $task): ?>
                                        <li class="list-group-item d-flex justify-content-between p-2 bg-light">
                                            <!-- Task Name and Progress Checkbox -->
                                            <form action="editProgress.php" method="POST" class="d-flex align-items-center">
                                                <input class="form-check-input m-1 p-2" type="checkbox" name="progress" value="<?= htmlspecialchars($task['progress']) ?>" <?= $task['progress'] === "Selesai" ? 'checked' : '' ?> onchange="this.form.submit()">
                                                <input type="hidden" name="opsi" value="dashboard">
                                                <input type="hidden" name="id_todo" value="<?= $task['id_todo'] ?>">
                                                <span><?= htmlspecialchars($task['nama_item']) ?></span>
                                            </form>

                                            <!-- Edit/Delete Dropdown for Task -->
                                            <div class="dropdown-center">
                                                <button class="btn btn-sm px-2 dropdown-toggle tombol_drop" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: none; border: none;">
                                                    <i class='bx bx-dots-horizontal-rounded fs-4 text-center'></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <button class="dropdown-item fw-semibold" type="button" data-bs-toggle="modal" data-bs-target="#editTaskModal<?= $task['id_todo'] ?>">
                                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item text-danger text-danger fw-semibold" type="button" data-bs-toggle="modal" data-bs-target="#deleteTaskModal<?= $task['id_todo'] ?>">
                                                            <i class="fa-solid fa-trash"></i> Delete Task
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
                                                            <input type="hidden" name="opsi" value="dashboard">
                                                            <input type="text" class="form-control" required name="nama_item" placeholder="Task Name" value="<?= htmlspecialchars($task['nama_item']) ?>">
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
                                                            <input type="hidden" name="opsi" value="dashboard">
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

                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li class="list-group-item text-center fw-semibold fst-italic text-muted bg-light mt-auto">No tasks available</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Modal for Adding New Task -->
                <div class="modal fade" id="addItemModal<?= $selectedListId ?>" tabindex="-1" aria-labelledby="addItemModalLabel<?= $selectedListId ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addItemModalLabel<?= $selectedListId ?>">Add Task to <?= $listTitle ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="buatItem.php" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" name="id_tabel" value="<?= $selectedListId ?>">
                                    <input type="hidden" name="opsi" value="dashboard">
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

                <!-- Modal for Editing List Title -->
                <div class="modal fade" id="editTableModal<?= $selectedListId ?>" tabindex="-1" aria-labelledby="editTableModalLabel<?= $selectedListId ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTableModalLabel<?= $selectedListId ?>">Edit List Title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="editTabel.php" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" name="id_tabel" value="<?= $selectedListId ?>">
                                    <input type="hidden" name="opsi" value="dashboard">
                                    <input type="text" class="form-control" required name="judul_tabel" placeholder="New List Title" value="<?= $listTitle ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal for Deleting List -->
                <div class="modal fade" id="deleteTableModal<?= $selectedListId ?>" tabindex="-1" aria-labelledby="deleteTableModalLabel<?= $selectedListId ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteTableModalLabel<?= $selectedListId ?>">Delete List</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="deleteTabel.php" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" name="id_tabel" value="<?= $selectedListId ?>">
                                    <input type="hidden" name="opsi" value="dashboard">
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
            </div>
            
            <div class="row">
                <div class="col-8"></div>
            </div>
        </div>
    </div>

</body>
</html>
