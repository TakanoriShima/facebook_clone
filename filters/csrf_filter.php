<?php
    // セッション開始
    session_start();
    $token = $_POST['_token'];
    if($token !== session_id()){
        header('Location: index.php');
        exit;
    }