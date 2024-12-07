<?php
include ('includes/header.php');

if(!logged_in()){
    redirect("login.php");
}


$total_price = $_GET['total'];
/*
$sql = "SELECT * FROM productos WHERE id = '$product_id'";
$result = mysqli_query($conexion, $sql);
$product = mysqli_fetch_assoc($result);
*/
?>

<div class="order_page">
    <?php
        display_message();
    ?>
    <form action="functions/finish_order.php" method="POST">
        <label for="total_price">Precio: </label>
        <input type="text" name="total_price" value="<?= $total_price ?>" readonly>
        <br><br>
        <label for="fecha_recogida">Fecha de Recogida: </label>
        <?php
            $date_min = date("Y-m-d");
            $date_max = date("Y-m-d", strtotime("+1 day"));
        ?>
        <input type="date" id="fecha_recogida" name="fecha_recogida" min="<?= $date_min ?>" max="<?= $date_max ?>" required>

        <br><br>
        <label for="hora_recogida">Hora de recogida:</label>
        <input type="time" id="hora_recogida" name="hora_recogida" min="10:00" max="21:00" required>

        <small style="color: grey;">La hora de recogida debe estar entre las 10:00 AM y las 9:00 PM.</small>
        <br><br>
        <button type="submit">Completar recogida</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fechaRecogida = document.getElementById('fecha_recogida');
        const horaRecogida = document.getElementById('hora_recogida');

        // Función para ajustar el valor mínimo de la hora dependiendo de la fecha seleccionada
        function ajustarHoraMinima() {
            const fechaSeleccionada = new Date(fechaRecogida.value);
            const fechaHoy = new Date();
            
            // Compara si la fecha seleccionada es hoy
            if (fechaSeleccionada.toDateString() === fechaHoy.toDateString()) {
                // Establece el mínimo de la hora al valor actual
                const horaActual = fechaHoy.getHours();
                const minutosActuales = fechaHoy.getMinutes();
                
                // Si es después de la hora, ajusta los minutos y la hora mínima
                const horaMinima = horaActual < 10 ? "10:00" : (horaActual < 21 ? `${horaActual}:${String(minutosActuales).padStart(2, '0')}` : "21:00");
                
                horaRecogida.min = horaMinima;
            } else {
                // Si no es hoy, establece el mínimo de la hora a las 10:00
                horaRecogida.min = "10:00";
            }
        }

        // Ejecutar cuando cambie la fecha
        fechaRecogida.addEventListener('change', ajustarHoraMinima);

        // Ajustar al cargar la página, en caso de que ya haya una fecha seleccionada
        ajustarHoraMinima();
    });
</script>