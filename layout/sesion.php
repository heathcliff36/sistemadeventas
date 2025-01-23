<?php

session_start();
if (isset($_SESSION['sesion_user'])) {
    // echo "si existe sesion de ".$_SESSION['sesion_user'];
    $user_sesion = $_SESSION['sesion_user'];
    $sql = "SELECT us.id_usuario as id_usuario, us.nombres as nombres, us.user as user, us.email as email, rol.id_rol as id_rol, rol.rol as rol 
                  FROM tb_usuarios as us 
                  INNER JOIN tb_roles as rol ON us.id_rol = rol.id_rol 
                  WHERE user='$user_sesion'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($usuarios as $usuario) {
        $id_usuario_sesion = $usuario['id_usuario'];
        $nombre_sesion = $usuario['nombres'];
        $id_rol_sesion = $usuario['id_rol'];
        $rol_sesion = $usuario['rol'];
    }
} else {
    echo "no existe sesion";
    header('Location: ' . $URL . '/login');
}
