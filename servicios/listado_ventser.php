<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/ventser/listado_de_ventser.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1 class="m-0">Listado de Servicios Realizadas</h1>
                </div><!-- /.col -->
                <div class="col-sm-2">
                    <a href="ventser.php" class="btn btn-primary btn-block"><i class="fa fa-cash-register"></i> Realizar Servicio</a>
                </div>
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
                            <h3 class="card-title">Servicios registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">
                            <div class="table table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>
                                                <center>Nro</center>
                                            </th>
                                            <th>
                                                <center>Nro de Servicio</center>
                                            </th>
                                            <th>
                                                <center>Servicios</center>
                                            </th>
                                            <th>
                                                <center>Cliente</center>
                                            </th>
                                            <th>
                                                <center>Monto Total</center>
                                            </th>
                                            <th>
                                                <center>Usuario</center>
                                            </th>
                                            <th>
                                                <center>Acciones</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($ventser_datos) && is_array($ventser_datos)) {
                                            $contador = 0;
                                            foreach ($ventser_datos as $ventser_dato) {
                                                $id_vs = $ventser_dato['id_vs'];
                                                $id_cliente = $ventser_dato['id_cliente'];

                                                $contador++;
                                        ?>
                                                <tr>
                                                    <td>
                                                        <center><?php echo $contador; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $ventser_dato['nro_servicio']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <!-- Button trigger modal servicvios -->
                                                            <button type="button" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#Modal_servicios<?php echo $id_vs; ?>">
                                                                <i class="fa fa-shopping-basket"></i> Servicios
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="Modal_servicios<?php echo $id_vs; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color: #08c2ec;">
                                                                            <h5 class="modal-title fs-5" id="exampleModalLabel"><b>Servicios del registro N° <?php echo $ventser_dato['nro_servicio']; ?></b></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
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

                                                                                        $nro_servicio = $ventser_dato['nro_servicio'];

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
                                                            <!-- /.modal -->
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <!-- Button trigger modal cliente -->
                                                            <button type="button" class="btn btn-warning"
                                                                data-toggle="modal" data-target="#Modal_clientes<?php echo $id_vs; ?>">
                                                                <i class="fa fa-user"></i> <?php echo $ventser_dato['cliente']; ?>
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="Modal_clientes<?php echo $id_vs; ?>">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color:rgb(218, 188, 18);color: white">
                                                                            <h4 class="modal-title">Datos del Cliente </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <?php
                                                                        $sql_clientes = "SELECT * FROM tb_clientes WHERE id_cliente = '$id_cliente'";
                                                                        $query_clientes = $pdo->prepare($sql_clientes);
                                                                        $query_clientes->execute();
                                                                        $clientes_datos = $query_clientes->fetchAll(PDO::FETCH_ASSOC);

                                                                        foreach ($clientes_datos as $clientes_dato) {
                                                                            $ruc = $clientes_dato['ruc'];
                                                                            $dv = $clientes_dato['dv'];
                                                                            $cliente = $clientes_dato['nombre_cliente'];
                                                                            $celular = $clientes_dato['celular'];
                                                                            $email = $clientes_dato['email'];
                                                                            $direccion = $clientes_dato['direccion'];
                                                                            $vehiculo = $clientes_dato['descripcion_vehiculo'];
                                                                        }
                                                                        ?>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="">RUC</label>
                                                                                        <input type="number" style="text-align: center;" value="<?php echo $ruc; ?>" class="form-control" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <?php if (empty($dv)) { ?>
                                                                                        <div class="form-group">
                                                                                            <label for="">DV</label>
                                                                                            <input type="text" style="text-align: center;" value="-" class="form-control" disabled>
                                                                                        </div>
                                                                                    <?php } else { ?>
                                                                                        <div class="form-group">
                                                                                            <label for="">DV </label>
                                                                                            <input type="number" style="text-align: center;" value="<?php echo $dv; ?>" class="form-control" disabled>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="">Nombre del Cliente</label>
                                                                                        <input type="text" style="text-align: center;" value="<?php echo $cliente; ?>" class="form-control" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="">Celular</label>
                                                                                        <br>
                                                                                        <a href="https://wa.me/+595<?php echo $celular; ?>" target="_blank" class="btn btn-success btn-block">
                                                                                            <i class="fa fa-phone"></i>
                                                                                            <?php echo $celular; ?>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <?php if (empty($email)) { ?>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="">Email</label>
                                                                                            <input type="email" style="text-align: center;" value="No posee email" class="form-control" disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } else { ?>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="">Email</label>
                                                                                            <input type="email" style="text-align: center;" value="<?php echo $email; ?>" class="form-control" disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="">Dirección</label>
                                                                                        <input type="text" style="text-align: center;" value="<?php echo $direccion; ?>" class="form-control" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <?php if (empty($vehiculo)) { ?>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label for="">Descripción de Vehículo</label>
                                                                                            <input type="text" style="text-align: center;" value="No hay datos del vehiculo" class="form-control" disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } else { ?>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label for="">Descripción de Vehículo</label>
                                                                                            <input type="text" style="text-align: center;" value="<?php echo $vehiculo; ?>" class="form-control" disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <button class="btn btn-primary">Gs. <?php echo number_format($ventser_dato['total_pagado'], 0, '', '.'); ?></button>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $ventser_dato['n_user']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a href="show_vs.php?id_vs=<?php echo $id_vs; ?>" class="btn btn-info"><i class="fa fa-eye"></i> Ver</a>
                                                            <a href="delete_vs.php?id_vs=<?php echo $id_vs; ?>&nro_servicio=<?php echo $nro_servicio; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Anular</a>
                                                        </center>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            //echo "<p>No hay datos de servicios disponibles.</p>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Compras",
                "infoEmpty": "Mostrando 0 a 0 de 0 Compras",
                "infoFiltered": "(Filtrado de _MAX_ total Compras)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Compras",
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
            buttons: [{
                    extend: 'collection',
                    text: 'Reportes',
                    orientation: 'landscape',
                    buttons: [{
                        text: 'Copiar',
                        extend: 'copy',
                    }, {
                        extend: 'pdf'
                    }, {
                        extend: 'csv'
                    }, {
                        extend: 'excel'
                    }, {
                        text: 'Imprimir',
                        extend: 'print'
                    }]
                },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas',
                    collectionLayout: 'fixed three-column'
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>