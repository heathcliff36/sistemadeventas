<?php

$id_venta_get = $_GET['id_venta'];

include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/ventas/cargar_venta.php');
include('../app/controllers/clientes/cargar_cliente.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <?php if ($estado == 1) { ?>
                        <h1 class="m-0"><b>Detalle de la Venta N° <?= $nro_venta; ?>, en fecha <?= $fecha; ?></b></h1>
                    <?php } else { ?>
                        <h1 class="m-0"><b>Detalle de la Venta N° <?= $nro_venta; ?>, en fecha <?= $fecha; ?> - <span style="color: red;">ANULADO</span></b></h1>
                    <?php } ?>
                </div>
                <div class="col-sm-2">
                    <a href="index.php" class="btn btn-secondary btn-block"><i class="fa fa-arrow-left"></i> Volver</a>
                </div>
                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-shopping-bag"></i> Venta Nro
                                <input type="text" style="text-align: center;" value="<?php echo $nro_venta; ?>" disabled>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #e7e7e7; text-align:center">Nro</th>
                                            <th style="background-color: #e7e7e7; text-align:center">Producto</th>
                                            <th style="background-color: #e7e7e7; text-align:center">Descripción</th>
                                            <th style="background-color: #e7e7e7; text-align:center">Cantidad</th>
                                            <th style="background-color: #e7e7e7; text-align:center">Precio Unitario</th>
                                            <th style="background-color: #e7e7e7; text-align:center">Precio SubTotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $contador_de_carrito = 0;
                                        $cantidad_total = 0;
                                        $p_uni_total = 0;
                                        $precio_total = 0;

                                        $sql_carrito = "SELECT *, p.nombre AS n_producto, p.descripcion AS descripcion, 
                                                        p.precio_venta AS p_unitario, p.stock AS stock
                                                        FROM tb_carrito AS c 
                                                        INNER JOIN tb_almacen AS p ON c.id_producto = p.id_producto
                                                        WHERE nro_venta = '$nro_venta' ORDER BY id_carrito ASC";
                                        $query_carrito = $pdo->prepare($sql_carrito);
                                        $query_carrito->execute();
                                        $carrito_datos = $query_carrito->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($carrito_datos as $carrito_dato) {

                                            $id_carrito = $carrito_dato['id_carrito'];
                                            $contador_de_carrito = $contador_de_carrito + 1;
                                            $cantidad_total = $cantidad_total + $carrito_dato['cantidad'];
                                            $p_uni_total = $p_uni_total + floatval($carrito_dato['precio_venta']);

                                        ?>
                                            <tr>
                                                <td>
                                                    <center><?php echo $contador_de_carrito; ?></center>
                                                    <input type="text" value="<?php echo $carrito_dato['id_producto']; ?>" id="id_producto<?php echo $contador_de_carrito; ?>" hidden>
                                                <td><?php echo $carrito_dato['n_producto']; ?></td>
                                                <td><?php echo $carrito_dato['descripcion']; ?></td>
                                                <td>
                                                    <center><span id="cantidad_carrito<?php echo $contador_de_carrito; ?>"><?php echo $carrito_dato['cantidad']; ?></span></center>
                                                    <input type="text" value="<?php echo $carrito_dato['stock']; ?>" id="stock_actual<?php echo $contador_de_carrito; ?>" hidden>
                                                </td>
                                                <td>
                                                    <center><?php echo $carrito_dato['p_unitario']; ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php
                                                        $cantidad = floatval($carrito_dato['cantidad']);
                                                        $precio_unitario = floatval($carrito_dato['p_unitario']);

                                                        echo $subtotal = $cantidad * $precio_unitario;

                                                        $precio_total = $precio_total + $subtotal;
                                                        ?>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <th colspan="3" style="background-color: #e7e7e7; text-align:right">Total</th>
                                            <th>
                                                <center><?php echo $cantidad_total; ?></center>
                                            </th>
                                            <th>
                                                <center><?php echo number_format($p_uni_total, 0, ',', '.'); ?></center>
                                            </th>
                                            <th style="background-color: yellow;">
                                                <center><?php echo number_format($precio_total, 0, ',', '.'); ?></center>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-user-check"></i> Datos del Cliente</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <?php
                        foreach ($clientes_datos as $clientes_dato) {
                            $ruc = $clientes_dato['ruc'];
                            $dv = $clientes_dato['dv'];
                            $cliente = $clientes_dato['nombre_cliente'];
                            $celular = $clientes_dato['celular'];
                            $direccion = $clientes_dato['direccion'];
                        }
                        ?>

                        <div class="card-body">
                            <div class="container-fluid" style="font-size: 12px">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" id="id_cliente" hidden>
                                            <label for="">Ruc </label>
                                            <input type="number" value="<?= $ruc; ?>" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="">Dv</label>
                                            <input type="number" value="<?= $dv; ?>" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nombre del Cliente</label>
                                            <input type="text" value="<?= $cliente; ?>" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Teléfono </label>
                                            <input type="text" value="<?= $celular; ?>" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Dirección</label>
                                            <input type="text" value="<?= $direccion; ?>" class="form-control" disabled>
                                            <!-- <textarea name="" cols="30" rows="3" class="form-control" disabled><?php //$direccion; 
                                                                                                                    ?></textarea> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-shopping-basket"></i> Registrar Venta</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Monto a Pagar: </label>
                                <input type="text" class="form-control" id="total_a_pagar" style="text-align: center; background-color: yellow; font-weight: bold;" value="<?php echo number_format($precio_total, 0, ',', '.'); ?>" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>



<script>
    $(function() {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Productos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });


    $(function() {
        $("#example2").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                "infoEmpty": "Mostrando 0 a 0 de 0 Clientes",
                "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Clientes",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>