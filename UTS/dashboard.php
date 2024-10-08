<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard ToDoList</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

    body {
        font-family: 'Rubik', sans-serif;
        transition: all 0.5s;
    }

    .l-navbar {
        background-color: #4723D9;
        width: 250px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: -250px;
        transition: all 0.5s;
    }

    .show-nav {
        left: 0;
    }

    .main-content {
        margin-top: 5rem;
        padding: 2rem;
        transition: all 0.5s;
    }

    .body-pd {
        padding-left: 250px;
    }

    @media screen and (max-width: 768px) {
        .body-pd {
            padding-left: 0;
        }
    }
</style>

<body id="body-pd">
    <!-- Header -->
    <header class="header bg-light d-flex align-items-center px-3 py-3 shadow" id="header">
        <div class="header_toggle"> 
            <i class='bx bx-menu fs-3' id="header-toggle"></i> 
        </div>
        <div class="ms-auto">
            <img src="https://i.imgur.com/hczKIze.jpg" alt="Profile Image" class="rounded-circle" width="50" height="50"> 
        </div>
    </header>

    <!-- Sidebar -->
    <div class="l-navbar" id="nav-bar">
        <nav class="nav flex-column pt-5 gap-2">
            <a href="#" class="nav_link nav_logo text-light d-flex align-items-center mb-3">
                <i class='bx bx-layer nav_icon me-2'></i>
                <span class="nav_name">BBBootstrap</span>
            </a>
            <a href="#" class="nav_link active text-light d-flex align-items-center mb-3">
                <i class='bx bx-grid-alt nav_icon me-2'></i>
                <span class="nav_name">Dashboard</span>
            </a>
            <a href="#" class="nav_link text-light d-flex align-items-center mb-3">
                <i class='bx bx-user nav_icon me-2'></i>
                <span class="nav_name">Users</span>
            </a>
            <a href="#" class="nav_link text-light d-flex align-items-center mb-3">
                <i class='bx bx-message-square-detail nav_icon me-2'></i>
                <span class="nav_name">Messages</span>
            </a>
            <a href="#" class="nav_link text-light d-flex align-items-center mb-3">
                <i class='bx bx-bookmark nav_icon me-2'></i>
                <span class="nav_name">Bookmark</span>
            </a>
            <a href="#" class="nav_link text-light d-flex align-items-center mb-3">
                <i class='bx bx-folder nav_icon me-2'></i>
                <span class="nav_name">Files</span>
            </a>
            <a href="#" class="nav_link text-light d-flex align-items-center mb-3">
                <i class='bx bx-bar-chart-alt-2 nav_icon me-2'></i>
                <span class="nav_name">Stats</span>
            </a>
            <a href="#" class="nav_link text-light d-flex align-items-center align-self-end mt-auto">
                <i class='bx bx-log-out nav_icon me-2'></i>
                <span class="nav_name">SignOut</span>
            </a>
        </nav>
    </div>

    <!-- Main content -->
    <div class="main-content mt-3" id="main-content">
        <h4>Main Components</h4>
        <p>This is your main content area.</p>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const toggle = document.getElementById('header-toggle');
            const nav = document.getElementById('nav-bar');
            const body = document.getElementById('body-pd');

            toggle.addEventListener('click', function() {
                nav.classList.toggle('show-nav');
                body.classList.toggle('body-pd');
            });

            const linkColor = document.querySelectorAll('.nav_link');

            function colorLink() {
                linkColor.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            }

            linkColor.forEach(l => l.addEventListener('click', colorLink));
        });
    </script>
</body>
</html>
