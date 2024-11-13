<?php
// operacion.php

// Inicializar variables
$resultado = null;
$error = null;

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operacion = $_POST['operacion'];

    // Validación: Asegurarse de que los valores sean números
    if (!is_numeric($num1) || !is_numeric($num2)) {
        $error = "Por favor, ingrese solo números válidos.";
    } else {
        // Realizar la operación matemática basada en la elección del usuario
        switch ($operacion) {
            case 'suma':
                $resultado = $num1 + $num2;
                break;
            case 'resta':
                $resultado = $num1 - $num2;
                break;
            case 'multiplicacion':
                $resultado = $num1 * $num2;
                break;
            case 'division':
                if ($num2 == 0) {
                    $error = "No se puede dividir entre cero.";
                } else {
                    $resultado = $num1 / $num2;
                }
                break;
            default:
                $error = "Por favor, seleccione una operación válida.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operación Matemática</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Realizar una Operación Matemática</h1>
    
    <!-- Formulario para ingresar números y seleccionar operación -->
    <form method="POST">
        <label for="num1">Número 1:</label>
        <input type="number" name="num1" id="num1" required>
        
        <label for="num2">Número 2:</label>
        <input type="number" name="num2" id="num2" required>

        <label for="operacion">Seleccionar operación:</label>
        <select name="operacion" id="operacion" required>
            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicacion">Multiplicación</option>
            <option value="division">División</option>
        </select>
        
        <button type="submit">Calcular</button>
    </form>

    <!-- Mostrar errores, si los hay -->
    <?php if (isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <!-- Mostrar el resultado -->
    <?php if (isset($resultado)) { ?>
        <div class="success">
            <p>Resultado: <?php echo $resultado; ?></p>
        </div>
    <?php } ?>
</body>
</html>
