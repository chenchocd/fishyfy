<?php
include ('includes/header.php');

if(!logged_in()){
    redirect("login.php");
}
?>


<div class="contact-container">
    <h2>Contacto</h2>
    <form action="functions/contact.php" method="post" onsubmit="return validarFormulario()">
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" minlength="2" maxlength="50" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" required>
    <small>Solo letras, sin caracteres especiales.</small>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <small>Debe ser un correo electrónico válido.</small>

    <label for="subject">Asunto:</label>
    <input type="text" id="subject" name="subject" minlength="3" maxlength="100" required>
    <small>Máximo 100 caracteres.</small>

    <label for="message">Mensaje:</label>
    <textarea id="message" name="message" rows="5" minlength="10" maxlength="500" required></textarea>
    <small>El mensaje debe tener entre 10 y 500 caracteres.</small>

    <button type="submit" name="submit">Enviar</button>
</form>
</div>

<script>
    function validarFormulario() {
        // Campos
        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const subject = document.getElementById("subject").value.trim();
        const message = document.getElementById("message").value.trim();

        // Verifica que los campos no estén vacíos o solo con espacios
        if (name === "" || email === "" || subject === "" || message === "") {
            alert("Todos los campos son obligatorios.");
            return false;
        }

        // Validación de formato de email
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
            alert("Por favor, introduce un correo electrónico válido.");
            return false;
        }

        // Validación de longitud del mensaje
        if (message.length < 10 || message.length > 500) {
            alert("El mensaje debe tener entre 10 y 500 caracteres.");
            return false;
        }

        // Si pasa todas las validaciones
        return true;
    }
</script>


<?php
include ('includes/footer.php');
?>