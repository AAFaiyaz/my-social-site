<?php 

    ob_start(); //Turns on output beuffering
    session_start();

    $timezone = date_default_timezone_set("Europe/Berlin");

    $con = mysqli_connect("localhost", "root","", "social");

    if (mysqli_connect_errno()){
        echo "Failed to connect: ". mysqli_connect_errno();
    }