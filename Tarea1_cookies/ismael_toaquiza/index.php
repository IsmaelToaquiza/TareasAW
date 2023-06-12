
<?php
if(isset($_COOKIE['c_nombre'])){
    $nombre = $_COOKIE['c_nombre'];
    $clave = $_COOKIE['c_clave'];
    $preferencia = $_COOKIE['c_preferencias'];
}else{
    $nombre="";
    $clave="";
    $preferencia="";
}
if (!isset($_COOKIE['preferencia_idioma'])) {
    $idioma="es";
}else{
    $idioma = $_COOKIE['preferencia_idioma'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>LOGIN</h1>
    <form action="mipanel.php?idioma=<?php echo $idioma;?>" method="POST">
        <fieldset>
            Usuario: <br>
            <input type="text" name="nombre" value="<?php echo $nombre;?>"/><br>
            Clave: <br>
            <input type="password" name="clave" value="<?php echo $clave;?>"/><br>
            <input type="checkbox" name="recordarme" <?php if($preferencia == 'on') echo "checked"?>/> Recordarme <br>
            <input type="submit" name="btnEnviar" />
        </fieldset>

    </form>

</body>

</html>