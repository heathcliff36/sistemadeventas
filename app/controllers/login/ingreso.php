<?php

include('../../config.php');

$user = $_POST['user'];
$password_user = $_POST['password_user'];




$contador = 0;
$sql = "SELECT * FROM tb_usuarios WHERE user = '$user' ";
$query = $pdo->prepare($sql);
$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($usuarios as $usuario){
    $contador = $contador + 1;
    $user_tabla = $usuario['user'];
    $nombres = $usuario['nombres'];
    $password_user_tabla = $usuario['password_user'];
}



if( ($contador > 0) && (password_verify($password_user, $password_user_tabla))  ){
    echo "Datos correctos";
    session_start();
    $_SESSION['sesion_user'] = $user;
    header('Location: '.$URL.'/index.php');
}else{
    echo "Datos incorrectos, vuelva a intentarlo";
    session_start();
    $_SESSION['mensaje'] = "Error datos incorrectos";
    header('Location: '.$URL.'/login');
}

