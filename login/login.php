<?php
require_once '../connec.php';
session_start();

if (isset($_POST['user_login'])){
    $userLogin = trim($_POST['user_login']);
    $userPassword = trim($_POST['user_password']);
    
    $query = "SELECT * FROM user WHERE user.Name = :login AND user.Password = :password";

    $statement = $pdo ->prepare($query);

    $statement->bindValue(':login', $userLogin, PDO::PARAM_STR);
    $statement->bindValue(':password', $userPassword, PDO::PARAM_STR);
    $statement->execute();

    $count = $statement->rowCount();
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if($count == 1 && !empty($row)){
        $_SESSION['user_login'] = $userLogin;
        header ('location: ../index.php');    
    } else {
        echo "Votre identifiant ou votre mot de passe est incorrect.";
    }
}
?>

<h1>DonkeyEvent</h1>
<form action="login.php" method="post">
    <div>
        <input type="text" id="login" name="user_login" placeholder="Identifiant">
    </div>

    <div>
        <input type="text" id="password" name="user_password" placeholder="Mot de passe">
    </div>
    <button type="submit">CONNEXION</button>
</form>