<?php
require_once '../includes/db.php';

$mensaje = '';
$tipo_mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    
    // Sanitización de datos
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
    $mensaje_texto = filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_STRING);
    
    // Validación
    if (empty($nombre) || empty($email) || empty($telefono) || empty($mensaje_texto)) {
        $mensaje = "Por favor, complete todos los campos";
        $tipo_mensaje = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "Por favor, ingrese un email válido";
        $tipo_mensaje = "error";
    } else {
        if ($db->insertContact($nombre, $email, $telefono, $mensaje_texto)) {
            $mensaje = "¡Mensaje enviado con éxito!";
            $tipo_mensaje = "success";
        } else {
            $mensaje = "Hubo un error al enviar el mensaje";
            $tipo_mensaje = "error";
        }
    }
}
?>
<!DOCTYPE html>
<meta name="description" content="JK Logistic - Soluciones logísticas innovadoras para tu negocio">
<meta name="keywords" content="logística, transporte, envíos, almacenamiento, supply chain">
<meta name="author" content="JK Logistic">
<meta property="og:title" content="JK Logistic - Soluciones Logísticas">
<meta property="og:description" content="Transforma tu negocio con nuestras soluciones innovadoras">
<meta property="og:image" content="URL_DE_TU_IMAGEN">
<meta property="og:url" content="URL_DE_TU_SITIO">
<!-- El resto del HTML actual, pero con los siguientes cambios en el formulario -->
<form class="contact-form" method="POST" action="">
    <?php if ($mensaje): ?>
        <div class="alert alert-<?php echo $tipo_mensaje; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <input type="text" name="nombre" placeholder="Nombre" required>
    </div>
    <div class="form-group">
        <input type="email" name="email" placeholder="Email" required>
    </div>
    <div class="form-group">
        <input type="tel" name="telefono" placeholder="Teléfono" required>
    </div>
    <div class="form-group">
        <textarea name="mensaje" placeholder="Tu Mensaje" rows="5" required></textarea>
    </div>
    <button type="submit" class="submit-button">Enviar Mensaje</button>
</form>