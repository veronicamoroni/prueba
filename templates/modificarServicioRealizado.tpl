<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Servicio Realizado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
    <link rel="stylesheet" href="/templates/styles/Formulario.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    {assign var="titulo" value="Gestión de Servicios Realizados"}
    {include file="navbar.tpl"}

    <!-- Contenedor principal -->
    <div class="container flex-fill mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <span class="material-symbols-outlined" style="font-size: 50px; color: #007bff;">build</span>
                        <h3 class="mt-2">Actualizar Servicio Realizado</h3>
                    </div>
                    <div class="card-body">
                        <!-- Formulario de actualización de servicio realizado -->
                        <form id="formmodificarServicioRealizado" action="/index.php?action=modificarServicioRealizado" method="post">
                            <div class="form-group">
                                <label for="servicios_realizados_id">ID Servicio Realizado:</label>
                                <input type="text" class="form-control" id="servicios_realizados_id" name="servicios_realizados_id" required>
                            </div>

                            <div class="form-group">
                                <label for="turnos_id">ID Turno:</label>
                                <input type="text" class="form-control" id="turnos_id" name="turnos_id" required>
                            </div>

                            <div class="form-group">
                                <label for="servicios_id">ID Servicio:</label>
                                <input type="text" class="form-control" id="servicios_id" name="servicios_id" required>
                            </div>

                            <div class="form-group">
                                <label for="notas">Notas del servicio:</label>
                                <textarea class="form-control" id="notas" name="notas" rows="3"></textarea>
                            </div>

                            <!-- Botón con icono -->
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <span class="material-symbols-outlined" style="font-size: 20px;">build</span> Actualizar Servicio Realizado
                            </button>
                        </form>

                        <!-- Mensaje de respuesta -->
                        <div id="mensaje" class="message mt-3 alert alert-info text-center" style="display:none;">
                            <!-- El mensaje se actualizará aquí -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Volver al Menú -->
        <div class="text-center mt-3">
            <a href="/menu" class="btn btn-secondary btn-sm">Volver al Menú</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-white text-center py-3 mt-auto" style="background-color: #004085;">
        <p>© 2025 Automotion - Todos los derechos reservados</p>
    </footer>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script para enviar el formulario con fetch -->
    <script>
        document.getElementById('formmodificarServicioRealizado').onsubmit = function(event) {
            event.preventDefault(); // Evita el envío automático del formulario

            const form = document.getElementById('formmodificarServicioRealizado');
            const formData = new FormData(form);

            fetch('/index.php?action=modificarServicioRealizado', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Mostrar el mensaje en el div 'mensaje'
                const mensajeDiv = document.getElementById('mensaje');
                mensajeDiv.innerHTML = data;
                mensajeDiv.style.display = "block"; // Muestra el mensaje
                mensajeDiv.className = "alert alert-info"; // Aplica estilos al mensaje

                // Si el mensaje no contiene "Error", puedes reiniciar el formulario
                if (!data.includes("Error")) {
                    form.reset();
                }
            })
            .catch(error => {
                // En caso de error, mostrar el mensaje de error
                document.getElementById('mensaje').innerHTML = '<div class="alert alert-danger">Error al actualizar el servicio realizado.</div>';
                document.getElementById('mensaje').style.display = "block";
            });
        };
    </script>

</body>
</html>
