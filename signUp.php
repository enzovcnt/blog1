<?php
require_once "logique/response.php";
require_once "logique/display.php";

$username = null;
$password=null;

if(!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

}


if($username && $password){

    require_once("logique/requetes.php");


    $user = getUserByUsername($username);

    if($user){
        render("user/signup", ["message"=> "Username already taken"]);
    }

     $newUser = ["username" => $username, "password" => $password];
     addUser($newUser);


     redirect("signIn", ["message"=> "Successfully registered"]);
}
render("user/signup")
?>
