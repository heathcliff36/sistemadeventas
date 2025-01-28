<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/ventas/listado_de_ventas.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Ventas Realizadas</h1>
                </div><!-- /.col -->
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
                            <h3 class="card-title">Ventas registrados</h3>
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
                                                <center>Nro de venta</center>
                                            </th>
                                            <th>
                                                <center>Productos</center>
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
                                                <center>Estado</center>
                                            </th>
                                            <th>
                                                <center>Acciones</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($ventas_datos) && is_array($ventas_datos)) {
                                            $contador = 0;
                                            foreach ($ventas_datos as $ventas_dato) {
                                                $id_venta = $ventas_dato['id_venta'];
                                                $id_cliente = $ventas_dato['id_cliente'];
                                                $estado = $ventas_dato['estado'];

                                                if ($estado == 1) {
                                                    $estado_option = '<button class="btn btn-success text-white">Pagado</button>';
                                                } else {
                                                    $estado_option = '<button class="btn btn-danger text-white">Anulada</button>';
                                                }

                                                $contador++;
                                        ?>
                                                <tr>
                                                    <td>
                                                        <center><?php echo $contador; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $ventas_dato['nro_venta']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <!-- Button trigger modal producto -->
                                                            <button type="button" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#Modal_productos<?php echo $id_venta; ?>">
                                                                <i class="fa fa-shopping-basket"></i> Productos
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="Modal_productos<?php echo $id_venta; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color: #08c2ec;">
                                                                            <h5 class="modal-title fs-5" id="exampleModalLabel"><b>Productos de la venta N° <?php echo $ventas_dato['nro_venta']; ?></b></h5>
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

                                                                                        $nro_venta = $ventas_dato['nro_venta'];

                                                                                        $sql_carrito = "SELECT *, p.nombre AS n_producto, p.descripcion AS descripcion, p.precio_venta AS p_unitario, p.stock AS stock
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
                                                            <!-- /.modal -->
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <!-- Button trigger modal cliente -->
                                                            <button type="button" class="btn btn-warning"
                                                                data-toggle="modal" data-target="#Modal_clientes<?php echo $id_venta; ?>">
                                                                <i class="fa fa-user"></i> <?php echo $ventas_dato['cliente']; ?>
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="Modal_clientes<?php echo $id_venta; ?>">
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
                                                            <button class="btn btn-primary">Gs. <?php echo number_format($ventas_dato['total_pagado'], 0, '', '.'); ?></button>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $ventas_dato['n_user']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $estado_option; ?></center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a href="show.php?id_venta=<?php echo $id_venta; ?>" class="btn btn-info"><i class="fa fa-eye"></i> Ver</a>
                                                            <a href="delete.php?id_venta=<?php echo $id_venta; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Borrar</a>
                                                        </center>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<p>No hay datos de ventas disponibles.</p>";
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