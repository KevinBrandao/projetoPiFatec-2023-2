<?php

ob_start();

session_start(); // Inicia a sessão

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email_login'];
    $senha = $_POST['senha_login'];

    // Verifica se o email e senha são válidos
    $query = "SELECT id, nome FROM netcar_user WHERE email='$email' AND senha=md5('$senha')";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id'];
        $_SESSION['nome'] = $row['nome'];
        header("Location: https://oficinanetcar.000webhostapp.com/view/cadastroDeVeiculo.html"); // Redireciona para a página de dashboard
    } else {
        echo '<script>alert("Email ou senha incorretos!")</script>'; 
        header("Location: https://oficinanetcar.000webhostapp.com/view/login.html#paralogin");               
    }
}

ob_end_flush();

?>

