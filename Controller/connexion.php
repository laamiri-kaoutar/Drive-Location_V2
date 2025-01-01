<?php

session_start();

require_once "../Model/user.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $errors = [];

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User(null, null,$email, $password, null);

    if (empty($user->getElementByEmail())) {
        $errors["notFound"]= "user not found";
        $_SESSION["errors"] = $errors;
        header("Location:../View/authen.php");

    }else {
         $data =$user->getElementByEmail();
         $data = $data[0];
        //  var_dump($data);

         $passwordCheck = password_verify($password, $data['password']);
         var_dump($passwordCheck);

         if (!$passwordCheck) {
             $errors["invalidpwd"] = "Invalid password.";
             $_SESSION["errors"] = $errors;
             header("Location:../View/authen.php");
            }else {
            $userS = [
                "id" =>$data['user_id'],
                "username" => $data['username'],
                "email" => $data['email'],
                "role" => $data['role']
            ];
            $_SESSION["user"] = $userS;
            var_dump($userS);
            var_dump($data);



            if ($data['role'] === 'admin') {
                header("Location:../View/index.html");

            }elseif ($data['role'] === 'client') {
                header("Location:../View/index.html");
            }
         }

    }
     
} 