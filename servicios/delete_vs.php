<?php
$id_ventser_get = $_GET['id_vs'];
$nro_servicio_get = $_GET['nro_servicio'];

include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/ventser/cargar_ventser.php');
include('../app/controllers/clientes/cargar_cliente.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0"><b>Detalle del Servicio N° <?= $nro_servicio; ?>, en fecha <?= $fecha; ?></b></h1>
                </div>
                <div class="col-sm-2">
                    <a href="listado_ventser.php" class="btn btn-secondary btn-block"><i class="fa fa-arrow-left"></i> Volver</a>
                </div>
                <div class="col-sm-2">
                    <button id="btn_anular_ventser" class="btn btn-danger btn-block"><i class="fa fa-ban"></i> Anular Venta</button>
                    <div id="btn_anular_ventser"></div>
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
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-shopping-bag"></i> Servicio Nro
                                <input type="text" style="text-align: center;" value="<?php echo $nro_servicio; ?>" disabled>
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
                                            <th style="background-color: #e7e7e7; text-align:center">Servicio</th>
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

                                        $sql_carrito = "SELECT *, s.nombre AS n_servicio, s.precio_venta AS p_unitario
                                        FROM tb_carrito_servicios AS c 
                                        INNER JOIN tb_almacen_servicios AS s ON c.id_servicio = s.id_servicio
                                        WHERE nro_servicio = '$nro_servicio' ORDER BY id_carrito ASC";
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
                                                    <input type="text" value="<?php echo $carrito_dato['id_servicio']; ?>" id="id_servicio<?php echo $contador_de_carrito; ?>" hidden>
                                                <td><?php echo $carrito_dato['n_servicio']; ?></td>
                                                <td>
                                                    <center><span id="cantidad_carrito<?php echo $contador_de_carrito; ?>"><?php echo $carrito_dato['cantidad']; ?></span></center>
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
                                            <th colspan="2" style="background-color: #e7e7e7; text-align:right">Total</th>
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
                    <div class="card card-outline card-danger">
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
                            $vehiculo = $clientes_dato['descripcion_vehiculo'];
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
                                            <label for="">Dirección</label>
                                            <textarea name="" id="direccion" cols="30" rows="3" class="form-control" disabled><?= $direccion; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Vehiculo </label>
                                            <textarea name="" id="vehiculo" cols="30" rows="3" class="form-control" disabled><?= $vehiculo; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-shopping-basket"></i> Servicio Realizado</h3>
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
                            <script>
                                $('#btn_anular_ventser').click(function() {

                                    var id_vs = '<?php echo $id_ventser_get; ?>';
                                    var nro_servicio = '<?php echo $nro_servicio_get; ?>';
                                    anular_venta();

                                    function anular_venta() {
                                        var url = "../app/controllers/ventser/anular_ventser.php";
                                        $.get(url, {
                                            id_vs: id_vs,
                                            nro_servicio: nro_servicio,
                                        }, function(datos) {
                                            $('#btn_anular_ventser').html(datos);
                                        });
                                    }
                                })
                            </script>
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