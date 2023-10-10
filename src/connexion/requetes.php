<?php
require_once ('./bdd.php');
function se_connecter($email, $mdp){
    global $pdo;
    $req = 'SELECT * FROM login WHERE email_login = :email AND mdp_login = :mdp;';
    $rep = $pdo->prepare($req);
    $rep->bindParam(':email', $email, PDO::PARAM_STR);
    $rep->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $rep->execute();
    return  $rep->rowCount() === 1; 
}
function inscription($email, $mdp){
    global $pdo;
    $req = 'INSERT INTO users (email, password) VALUES (:email, :password)';
    $rep = $pdo->prepare($req);
    $rep->bindParam(':email', $email, PDO::PARAM_STR);
    $rep->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    $rep->execute();
    if ($rep->execute()) {
        return true;
    } else {
        return false;
    }

}

