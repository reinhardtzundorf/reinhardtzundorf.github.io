<?php
/* ---------------------------------------------------------------- *
 *  Connection Variables                                            *
 * ---------------------------------------------------------------- */
$server     = "localhost";
$user_name  = "webfogpe";
$user_pass  = "";

/* ---------------------------------------------------------------- *
 *  Connect to MySQL                                                *
 * ---------------------------------------------------------------- */
$conn = mysqli_connect("localhost","root","");

/* ---------------------------------------------------------------- *
 *  Select the DB                                                   *
 * ---------------------------------------------------------------- */
mysqli_select_db($dbcon,"users");