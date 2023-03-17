<?php
    session_name("cinelist");
    session_start();
    session_destroy();
    header("Location: index.php");
