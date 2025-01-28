<?php
/* Smarty version 5.4.0, created on 2025-01-27 13:13:28
  from 'file:listarVehiculos.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.0',
  'unifunc' => 'content_67977868a94e43_64650104',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8de471313d06b078fe88cadd219e29234c678474' => 
    array (
      0 => 'listarVehiculos.tpl',
      1 => 1737979995,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67977868a94e43_64650104 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AutomotionWeb\\templates';
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vehículos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Vehículos</h1>

        <!-- Tabla para listar vehículos -->
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Patente</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>DNI del Cliente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('vehiculos')) > 0) {?>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('vehiculos'), 'vehiculo');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('vehiculo')->value) {
$foreach0DoElse = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->getValue('vehiculo')['patente'];?>
</td>
                            <td><?php echo $_smarty_tpl->getValue('vehiculo')['marca'];?>
</td>
                            <td><?php echo $_smarty_tpl->getValue('vehiculo')['modelo'];?>
</td>
                            <td><?php echo $_smarty_tpl->getValue('vehiculo')['dni_cliente'];?>
</td>
                            <td>
                                <!-- Botón para eliminar vehículo -->
                                <form method="POST" action="eliminar_vehiculo.php" class="d-inline">
                                    <input type="hidden" name="patente" value="<?php echo $_smarty_tpl->getValue('vehiculo')['patente'];?>
">
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                <?php } else { ?>
                    <tr>
                        <td colspan="5" class="text-center">No hay vehículos registrados.</td>
                    </tr>
                <?php }?>
            </tbody>
        </table>

        <div class="text-center mt-3">
            <a href="/menu" class="btn btn-secondary btn-block">Volver al Menú</a>
        </div>
    </div>

    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
