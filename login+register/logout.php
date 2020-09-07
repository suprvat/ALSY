<?php
    session_start();
    session_destroy();
    header("Location: app.php"); //home page of the website
