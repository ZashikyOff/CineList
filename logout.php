<?php
    session_name("mylist");
    session_start();
    session_destroy();
    header("Location: index.php");
