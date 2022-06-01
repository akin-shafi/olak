<?php require_once('private/initialize.php'); 


if ($settings->login_type == 1) {
    include('signin1.php');
}else{
    include('signin2.php');
} ?>

