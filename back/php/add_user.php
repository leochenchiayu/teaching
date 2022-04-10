<?php
    require_once 'db.php';
    require_once 'functions.php';
    $data = add_user($_POST["un"],$_POST["pw"]);
    echo $data;
?>