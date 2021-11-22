<?php
require_once 'connec.php';
require_once 'index.html';
session_start();

if (isset($_POST['user_login'])){
    $userLogin = trim($_POST['user_login']);
    $userPassword = trim($_POST['user_password']);
    
    $query = "SELECT * FROM User WHERE User.Name = :login";

    $statement = $pdo ->prepare($query);

    $statement->bindValue(':login', $userLogin, PDO::PARAM_STR);
    $statement->execute();

    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if(password_verify($userPassword,$row["Password"])) {
        $_SESSION["user_login"] = $userLogin;
        header ("location: index.php");
    } else {
        echo "Votre identifiant ou votre mot de passe est incorrect.";
    }
}
?>

<h1>DonkeyEvent</h1>

<div class="container login_card ">
<div class="card" style="width: 20rem;">
  <img src="medias/login.jpg" class="card-img-top" alt="crowd in concert">
  <div class="card_body">
    <form action="login.php" method="post">
            <div class="col-sm-12">
                <input type="text" id="login" name="user_login" placeholder="Identifiant">
            </div>
            <div class="col-sm-12">
                <input type="text" id="password" name="user_password" placeholder="Mot de passe">
            </div>
            <div class="col-sm-12">
                <button class="btn btn-secondary" type="submit">CONNEXION</button>
            </div>
    </form>
  </div>
</div>
</div>

<?php
require_once 'footer.php';