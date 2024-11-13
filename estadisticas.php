<?php
// Inicializar las variables
$error = "";
$resultado = null;
$valores = [];

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores del formulario y validarlos
    for ($i = 1; $i <= 5; $i++) {
        if (isset($_POST["valor$i"])) {
            $valores[$i - 1] = $_POST["valor$i"];
        }
    }

    // Validar que todos los valores sean números
    if (count($valores) == 5 && !array_filter($valores, fn($v) => !is_numeric($v))) {
        // Calcular la media
        $media = array_sum($valores) / count($valores);

        // Calcular la moda
        $moda = calcularModa($valores);

        // Calcular la mediana
        $mediana = calcularMediana($valores);

        // Guardar los resultados
        $resultado = [
            'media' => $media,
            'moda' => $moda,
            'mediana' => $mediana,
        ];
    } else {
        $error = "Por favor, ingrese 5 números válidos.";
    }
}

// Función para calcular la moda
function calcularModa($valores) {
    $frecuencias = array_count_values($valores);
    $maxFrecuencia = max($frecuencias);
    $moda = array_keys($frecuencias, $maxFrecuencia);
    return $moda;
}

// Función para calcular la mediana
function calcularMediana($valores) {
    sort($valores);
    $count = count($valores);
    $mitad = floor($count / 2);

    // Si el número de elementos es impar, devolver el valor del medio
    if ($count % 2) {
        return $valores[$mitad];
    } else {
        // Si es par, devolver el promedio de los dos elementos centrales
        return ($valores[$mitad - 1] + $valores[$mitad]) / 2;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Calcular Estadísticas</h1>

    <!-- Mostrar errores si existen -->
    <?php if (!empty($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <!-- Formulario para ingresar los 5 valores -->
    <form method="POST">
        <label for="valor1">Valor 1:</label>
        <input type="text" name="valor1" value="<?php echo htmlspecialchars($valores[0] ?? ''); ?>" required>

        <label for="valor2">Valor 2:</label>
        <input type="text" name="valor2" value="<?php echo htmlspecialchars($valores[1] ?? ''); ?>" required>

        <label for="valor3">Valor 3:</label>
        <input type="text" name="valor3" value="<?php echo htmlspecialchars($valores[2] ?? ''); ?>" required>

        <label for="valor4">Valor 4:</label>
        <input type="text" name="valor4" value="<?php echo htmlspecialchars($valores[3] ?? ''); ?>" required>

        <label for="valor5">Valor 5:</label>
        <input type="text" name="valor5" value="<?php echo htmlspecialchars($valores[4] ?? ''); ?>" required>

        <button type="submit">Calcular Estadísticas</button>
    </form>

    <!-- Mostrar resultados -->
    <?php if ($resultado !== null) { ?>
        <h2>Resultados:</h2>
        <p><strong>Media:</strong> <?php echo $resultado['media']; ?></p>
        <p><strong>Moda:</strong> <?php echo implode(', ', $resultado['moda']); ?></p>
        <p><strong>Mediana:</strong> <?php echo $resultado['mediana']; ?></p>
    <?php } ?>
</body>
</html>
