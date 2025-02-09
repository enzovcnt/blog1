<?php

require_once "logique/response.php";
unset($_SESSION['id']);
unset($_SESSION['username']);

// header("location: index.php?message=logged out");
//exit();

redirect("index", ["message"=>"logged out"]);
