<?php
session_start();


$fpes = fopen("categorias_es.txt", "r");
$fpen = fopen("categorias_en.txt", "r");

$idiomaSeleccionado = isset($_GET['idioma']) ? $_GET['idioma'] : 'es';
setcookie("preferencia_idioma", $idiomaSeleccionado, time() + (24 * 60 * 60));


if (!isset($_SESSION['nombre'])) {
    if ($_POST['nombre'] != '' && $_POST['clave'] != '') {
        $_SESSION['nombre'] = $_POST['nombre'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $guardarPreferencias = isset($_POST['recordarme']) ? $_POST['recordarme'] : '';
        if ($guardarPreferencias != "") {
            setcookie("c_nombre", $nombre, time() + (24 * 60 * 60));
            setcookie("c_clave", $clave,  time() + (24 * 60 * 60));
            setcookie("c_preferencias", $guardarPreferencias,  time() + (24 * 60 * 60));
        } else {
            if (isset($_COOKIE)) {

                foreach ($_COOKIE as $name => $value) {
                    if ($name != 'preferencia_idioma') {
                        setcookie($name, '', 1);
                    }                    
                }
            }
        }


    } else {
        header('Location: index.php');
        exit;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <style>
        .idioma {
            display: none;
        }

        .idioma.activa {
            display: block;
        }
    </style>
</head>

<body>
    <h1>PANEL PRINCIPAL</h1>
    <h3>Bienvenido usuario: <?php echo $_SESSION['nombre'] ?> </h3>
    <p>
        <a href="mipanel.php?idioma=es" <?php if ($idiomaSeleccionado === 'es') echo 'class="activa"'; ?>>ES (Español)</a> /
        <a href="mipanel.php?idioma=en" <?php if ($idiomaSeleccionado === 'en') echo 'class="activa"'; ?>>EN (English)</a>
    </p>
    <p><a href="cerrarsesion.php">Cerrar Sesion</a></p>
    <h2>Product List</h2>

    <ul id="idioma_es" class="idioma <?php if ($idiomaSeleccionado === 'es') echo 'activa'; ?>">
        <?php
        while (!feof($fpes)) {
            $linea = fgets($fpes);
            echo "<li><p>" . $linea . "</p></li>";
        }
        ?>
    </ul>
    <ul id="idioma_en" class="idioma <?php if ($idiomaSeleccionado === 'en') echo 'activa'; ?>">
        <?php
        while (!feof($fpen)) {
            $linea = fgets($fpen);
            echo "<li><p>" . $linea . "</p></li>";
        }
        ?>
    </ul>
</body>

</html>
