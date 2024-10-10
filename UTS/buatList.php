<?php
session_start();
require_once('db.php');

$judul = $_POST['judul'];
$username = $_SESSION['username'];
$nama_item = $_POST['nama_item'];