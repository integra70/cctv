<?php
session_start(); // Iniciar sesión para almacenar los valores de los productos

// Inicializar productos si no existen en la sesión
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [
        "prod1" => 1,
        "prod2" => 1,
        "prod3" => 1,
        "prod4" => 1,
        "prod5" => 1,
        "prod6" => 1,
    ];
}

// Asegurar que el formulario envió datos válidos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['producto']) && isset($_POST['accion'])) {
    $producto = $_POST['producto'];  // Obtener el producto
    $accion = $_POST['accion'];      // Obtener la acción (incrementar/decrementar)

    // Asegurar que el producto existe en la sesión antes de modificarlo
    if (array_key_exists($producto, $_SESSION['productos'])) {
        if ($accion == "incrementar") {
            $_SESSION['productos'][$producto]++;
        } elseif ($accion == "decrementar" && $_SESSION['productos'][$producto] > 0) {
            $_SESSION['productos'][$producto]--;
        }
    }
}

// Redirigir siempre a `index.php` para mantener la posición en los productos
header("Location: index.php#productos");
exit();
?>