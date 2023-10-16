<?php
require_once ('./bdd.php');
function authentification($email, $password) {
    $dsn = "pgsql:host=localhost;dbname=fleurissimo;port=5432;";
    $db_username = "postgres";
    $db_password = "20221134";
    try {
        $pdo = new PDO($dsn, $db_username, $db_password);
        $query = "SELECT mdp_login FROM login WHERE email_login = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $hashed_password = $stmt->fetchColumn();

        if (password_verify($password, $hashed_password)) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Erreur de la base de données : " . $e->getMessage(); 
        return false;
    }
}