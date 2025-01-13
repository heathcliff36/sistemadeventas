<?php
include ('../../config.php');

$nombre_cliente = $_GET['nombre_cliente'];
$celular = $_GET['celular'];
$cedula = $_GET['cedula'];
$ruc = $_GET['ruc'];
$descripcion_vehiculo = $_GET['descripcion_vehiculo'];
$direccion = $_GET['direccion'];

$sentencia = $pdo->prepare("INSERT INTO tb_clientes
       ( nombre_cliente, celular, cedula, ruc, descripcion_vehiculo, direccion, fyh_creacion) 
VALUES (:nombre_cliente,:celular,:cedula,:ruc,:descripcion_vehiculo,:direccion,:fyh_creacion)");

$sentencia->bindParam('nombre_cliente',$nombre_cliente);
$sentencia->bindParam('celular',$celular);
$sentencia->bindParam('cedula',$cedula);
$sentencia->bindParam('ruc',$ruc);
$sentencia->bindParam('descripcion_vehiculo',$descripcion_vehiculo);
$sentencia->bindParam('direccion',$direccion);
$sentencia->bindParam('fyh_creacion',$fechaHora);


if($sentencia->execute()){
    session_start();
    // echo "se registro correctamente";
    $_SESSION['mensaje'] = "Se registro al cliente de la manera correcta";
    $_SESSION['icono'] = "success";
    // header('Location: '.$URL.'/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/clientes";
    </script>
    <?php
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
    //  header('Location: '.$URL.'/categorias');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/clientes";
    </script>
    <?php
}
