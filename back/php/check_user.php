<?php
    require_once 'db.php';
    require_once 'functions.php';
    $data = check_user($_POST["un"]);
    echo $data;
?>