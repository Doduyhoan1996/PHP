<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15/06/2019
 * Time: 11:49 SA
 */

session_start();
// remove all session variables
session_unset();
// destroy the session
session_destroy();
header("Location: login.php");
exit;
?>