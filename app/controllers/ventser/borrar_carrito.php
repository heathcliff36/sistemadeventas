<?php

include('../../config.php');

$id_carrito = $_POST['id_carrito'];


$sentencia = $pdo->prepare("DELETE FROM tb_carrito_servicios WHERE id_carrito=:id_carrito");

$sentencia->bindParam('id_carrito', $id_carrito);

if ($sentencia->execute()) {

?>
    <script>
        location.href = "<?php echo $URL; ?>/servicios/create.php";
    </script>
<?php
} else {
?>
    <script>
        location.href = "<?php echo $URL; ?>/servicios/create.php";
    </script>
<?php
}
