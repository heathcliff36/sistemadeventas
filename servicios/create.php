<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');
include('../app/controllers/ventser/listado_de_ventser.php');
include('../app/controllers/servicios/listado_de_servicios.php');
include('../app/controllers/clientes/listado_de_clientes.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Servicios</h1>
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
                            <?php
                            $contador_de_ventser = 0;
                            foreach ($ventser_datos as $ventser_dato) {
                                $contador_de_ventser = $contador_de_ventser + 1;
                            }
                            ?>
                            <h3 class="card-title"><i class="fa fa-shopping-bag"></i> Servicio Nro
                                <input type="text" style="text-align: center;" value="<?php echo $contador_de_ventser + 1; ?>" disabled>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">
                            <b>Carrito </b>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal-buscar_producto">
                                <i class="fa fa-search"></i>
                                Buscar servicio
                            </button>
                            <!-- modal para visualizar datos de los productos -->
                            <div class="modal fade" id="modal-buscar_producto">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #1d36b6;color: white">
                                            <h4 class="modal-title">Busqueda del servicio</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table table-responsive">
                                                <table id="example1" class="table table-bordered table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <center>Nro</center>
                                                            </th>
                                                            <th>
                                                                <center>Acción</center>
                                                            </th>
                                                            <th>
                                                                <center>Código</center>
                                                            </th>
                                                            <th>
                                                                <center>Categoría</center>
                                                            </th>
                                                            <th>
                                                                <center>Nombre</center>
                                                            </th>
                                                            <th>
                                                                <center>Precio venta</center>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $contador = 0;
                                                        foreach ($servicios_datos as $servicio_dato) {
                                                            $id_servicio = $servicio_dato['id_servicio']; ?>
                                                            <tr>
                                                                <td><?php echo $contador = $contador + 1; ?></td>
                                                                <td>
                                                                    <button class="btn btn-info" id="btn_selecionar<?php echo $id_servicio; ?>">
                                                                        Selecionar
                                                                    </button>
                                                                    <script>
                                                                        $('#btn_selecionar<?php echo $id_servicio; ?>').click(function() {


                                                                            var id_servicio = "<?php echo $id_servicio; ?>";
                                                                            $('#id_servicio').val(id_servicio);

                                                                            var servicio = "<?php echo $servicio_dato['nombre']; ?>";
                                                                            $('#servicio').val(servicio);

                                                                            var precio_venta = "<?php echo $servicio_dato['precio_venta']; ?>";
                                                                            $('#precio_venta').val(precio_venta);

                                                                            $('#cantidad').focus;

                                                                            //$('#modal-buscar_producto').modal('toggle');

                                                                        });
                                                                    </script>
                                                                </td>
                                                                <td><?php echo $servicio_dato['codigo']; ?></td>
                                                                <td><?php echo $servicio_dato['categoria']; ?></td>
                                                                <td><?php echo $servicio_dato['nombre']; ?></td>
                                                                <td><?php echo $servicio_dato['precio_venta']; ?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" id="id_servicio" hidden>
                                                            <label for="">Servicio</label>
                                                            <input type="text" class="form-control" name="" id="servicio" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Cantidad</label>
                                                            <input type="text" class="form-control" name="" id="cantidad">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Precio Unitario</label>
                                                            <input type="text" class="form-control" name="" id="precio_venta" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.row -->
                                                <button style="float: right;" id="btn_agregar_carrito" class="btn btn-primary">Agregar</button>
                                                <div id="respuesta_carrito"></div>
                                                <script>
                                                    $('#btn_agregar_carrito').click(function() {
                                                        var nro_servicio = '<?php echo $contador_de_ventser + 1; ?>';
                                                        var id_servicio = $('#id_servicio').val();
                                                        var cantidad = $('#cantidad').val();

                                                        if (id_servicio == "" || cantidad == "") {
                                                            alert("Todos los campos son obligatorios");
                                                        } else {
                                                            var url = "../app/controllers/ventser/registrar_carrito.php";
                                                            $.get(url, {
                                                                nro_servicio: nro_servicio,
                                                                id_servicio: id_servicio,
                                                                cantidad: cantidad
                                                            }, function(datos) {
                                                                $('#respuesta_carrito').html(datos);
                                                            });
                                                        }

                                                    });
                                                </script>
                                                <br><br>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <br><br>

                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #e7e7e7; text-align:center">Nro</th>
                                            <th style="background-color: #e7e7e7; text-align:center">Servicio</th>
                                            <th style="background-color: #e7e7e7; text-align:center">Cantidad</th>
                                            <th style="background-color: #e7e7e7; text-align:center">Precio Unitario</th>
                                            <th style="background-color: #e7e7e7; text-align:center">Precio SubTotal</th>
                                            <th style="background-color: #e7e7e7; text-align:center">Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $contador_de_carrito = 0;
                                        $cantidad_total = 0;
                                        $p_uni_total = 0;
                                        $precio_total = 0;

                                        $nro_servicio = $contador_de_ventser + 1;

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
                                                <td>
                                                    <center>
                                                        <form action="../app/controllers/ventser/borrar_carrito.php" method="post">
                                                            <input type="text" name="id_carrito" value="<?php echo $id_carrito; ?>" hidden>
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                        </form>
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
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-user-check"></i> Datos del Cliente</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">
                            <b>Cliente </b>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal-buscar_cliente">
                                <i class="fa fa-search"></i>
                                Buscar cliente
                            </button>
                            <!-- modal para visualizar datos de los cliente -->
                            <div class="modal fade" id="modal-buscar_cliente">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #1d36b6;color: white">
                                            <h4 class="modal-title">Busqueda del cliente </h4>
                                            <button style="margin-left: 10px;" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-agregar_cliente">
                                                <i class="fa fa-user-plus"></i> Agregar Nuevo Cliente
                                            </button>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table table-responsive">
                                                <table id="example2" class="table table-bordered table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <center>Nro</center>
                                                            </th>
                                                            <th>
                                                                <center>Acción</center>
                                                            </th>
                                                            <th>
                                                                <center>Ruc</center>
                                                            </th>
                                                            <th>
                                                                <center>Dv</center>
                                                            </th>
                                                            <th>
                                                                <center>Nombre del Cliente</center>
                                                            </th>
                                                            <th>
                                                                <center>Direccion</center>
                                                            </th>
                                                            <th>
                                                                <center>Descripcion Vehiculo</center>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $contador_de_clientes = 0;
                                                        foreach ($clientes_datos as $clientes_dato) {
                                                            $id_cliente = $clientes_dato['id_cliente'];
                                                            $contador_de_clientes = $contador_de_clientes + 1;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $contador_de_clientes = $contador_de_clientes + 1; ?></td>
                                                                <td>
                                                                    <button class="btn btn-info" id="btn_pasar_cliente<?php echo $id_cliente; ?>">
                                                                        Selecionar
                                                                    </button>
                                                                    <script>
                                                                        $('#btn_pasar_cliente<?php echo $id_cliente; ?>').click(function() {

                                                                            var id_cliente = "<?php echo $clientes_dato['id_cliente']; ?>";
                                                                            $('#id_cliente').val(id_cliente);

                                                                            var ruc = "<?php echo $clientes_dato['ruc']; ?>";
                                                                            $('#ruc').val(ruc);

                                                                            var dv = "<?php echo $clientes_dato['dv']; ?>";
                                                                            $('#dv').val(dv);

                                                                            var cliente = "<?php echo $clientes_dato['nombre_cliente']; ?>";
                                                                            $('#cliente').val(cliente);

                                                                            var direccion = "<?php echo $clientes_dato['direccion']; ?>";
                                                                            $('#direccion').val(direccion);

                                                                            var vehiculo = "<?php echo $clientes_dato['descripcion_vehiculo']; ?>";
                                                                            $('#vehiculo').val(vehiculo);

                                                                            $('#modal-buscar_cliente').modal('toggle');

                                                                        });
                                                                    </script>
                                                                </td>
                                                                <td><?php echo $clientes_dato['ruc']; ?></td>
                                                                <?php if (empty($clientes_dato['dv'])) { ?>
                                                                    <td>
                                                                        <p>-</p>
                                                                    </td>
                                                                <?php } else { ?>
                                                                    <td><?php echo $clientes_dato['dv']; ?></td>
                                                                <?php } ?>
                                                                <td><?php echo $clientes_dato['nombre_cliente']; ?></td>
                                                                <td><?php echo $clientes_dato['direccion']; ?></td>
                                                                <?php if (empty($clientes_dato['descripcion_vehiculo'])) { ?>
                                                                    <td>
                                                                        <p>No hay datos del vehiculo</p>
                                                                    </td>
                                                                <?php } else { ?>
                                                                    <td><?php echo $clientes_dato['descripcion_vehiculo']; ?></td>
                                                                <?php } ?>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <hr>

                            <div class="container-fluid" style="font-size: 12px">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" id="id_cliente" hidden>
                                            <label for="">Ruc </label>
                                            <input type="number" id="ruc" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="">Dv</label>
                                            <input type="number" id="dv" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nombre del Cliente</label>
                                            <input type="text" id="cliente" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Dirección</label>
                                            <textarea name="" id="direccion" cols="30" rows="3" class="form-control" disabled></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Vehiculo </label>
                                            <textarea name="" id="vehiculo" cols="30" rows="3" class="form-control" disabled></textarea>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Paga con: </label>
                                        <input type="text" class="form-control" id="efectivo_recibido">
                                        <script>
                                            // Función para formatear números con separación de miles
                                            function formatearMiles(numero) {
                                                return numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                            }

                                            // Función para eliminar puntos de un número formateado
                                            function eliminarFormato(numeroFormateado) {
                                                return numeroFormateado.replace(/\./g, '');
                                            }

                                            $('#efectivo_recibido').on('input', function() {
                                                // Obtener el valor actual del campo y eliminar puntos
                                                var valor = eliminarFormato($(this).val());

                                                // Validar si el valor es un número
                                                if (!isNaN(valor) && valor !== '') {
                                                    // Volver a formatear el valor con separación de miles
                                                    var valorFormateado = formatearMiles(valor);
                                                    $(this).val(valorFormateado);
                                                } else {
                                                    $(this).val(''); // Limpia el campo si no es válido
                                                }

                                                // Calcular la diferencia con el monto a pagar
                                                var total_a_pagar = eliminarFormato($('#total_a_pagar').val());
                                                var efectivo_recibido = eliminarFormato($(this).val());

                                                // Realizar el cálculo
                                                var diferencia = parseFloat(efectivo_recibido) - parseFloat(total_a_pagar);

                                                // Validar el cálculo y formatear el vuelto
                                                if (!isNaN(diferencia)) {
                                                    var diferencia_formateada = formatearMiles(diferencia);
                                                    $('#vuelto').val(diferencia_formateada);
                                                } else {
                                                    $('#vuelto').val('');
                                                }
                                            });
                                        </script>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Vuelto: </label>
                                        <input type="text" class="form-control" id="vuelto" disabled>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <button id="btn_guardar_venta" class="btn btn-primary btn-block"> Registrar Venta</button>
                                <div id="respuesta_ventser"></div>
                                <script>
                                    // Función para eliminar puntos de un número formateado
                                    function eliminarFormato(numeroFormateado) {
                                        return numeroFormateado.replace(/\./g, '');
                                    }

                                    $('#btn_guardar_venta').click(function() {

                                        var nro_servicio = '<?php echo $contador_de_ventser + 1; ?>';
                                        var id_cliente = $('#id_cliente').val();
                                        var total_a_pagar = $('#total_a_pagar').val();

                                        // Eliminar el formato del valor de total_a_pagar
                                        total_a_pagar = eliminarFormato(total_a_pagar);

                                        if (id_cliente == "") {
                                            alert("Seleccione un cliente");
                                        } else {
                                            guardar_servicio();
                                        }

                                        function guardar_servicio() {
                                            var url = "../app/controllers/ventser/registrar_ventser.php";
                                            $.get(url, {
                                                nro_servicio: nro_servicio,
                                                id_cliente: id_cliente,
                                                total_a_pagar: total_a_pagar
                                            }, function(datos) {
                                                $('#respuesta_ventser').html(datos);
                                            });
                                        }

                                    });
                                </script>
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

<!-- modal para registrar nuevos clientes -->
<div class="modal fade" id="modal-agregar_cliente">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:rgb(218, 188, 18);color: white">
                <h4 class="modal-title">Nuevo Cliente </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../app/controllers/clientes/guardar_clientes.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">RUC <b>*</b></label>
                                <input type="number" name="ruc" id="ruc" class="form-control">
                                <small style="color: red;display: none" id="lbl_ruc">* Este campo es requerido</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">DV </label>
                                <input type="number" name="dv" id="dv" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre del Cliente <b>*</b></label>
                                <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control">
                                <small style="color: red;display: none" id="lbl_nombre">* Este campo es requerido</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">vehiculo <b>*</b></label>
                                <input type="number" name="vehiculo" id="vehiculo" class="form-control">
                                <small style="color: red;display: none" id="lbl_vehiculo">* Este campo es requerido</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Dirección <b>*</b></label>
                                <input type="text" name="direccion" id="direccion" class="form-control">
                                <small style="color: red;display: none" id="lbl_direccion">* Este campo es requerido</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Descripción de Vehículo</label>
                                <input type="text" name="descripcion_vehiculo" id="descripcion_vehiculo" class="form-control">
                            </div>
                        </div>
                    </div>
                    <input type="text" name="iduser" id="iduser" value="<?php echo $id_usuario_sesion; ?>" hidden>
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning btn-block">Guradar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->