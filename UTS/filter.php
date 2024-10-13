<?php
session_start();
require_once('db.php');

$filter = $_POST['filter'];

$_SESSION['filter'] = $filter;
header('location: showtask.php');
