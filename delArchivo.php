<?php
$path = "archivos/";

if (isset($_GET["accion"]) && $_GET["accion"] === "new") {
    if (isset($_GET["archivo"])) {
        $nombre_archivo = $_GET["archivo"];

        // Intenta crear el archivo y escribir el contenido
        if ($archivo = fopen($nombre_archivo, 'w')) {
            fwrite($archivo, $contenido_inicial); // Escribe el contenido
            fclose($archivo); // Cierra el archivo
            echo "Se ha creado el archivo '$nombre_archivo' con el contenido: '$contenido_inicial'.";
        } else {
            echo "No se pudo crear el archivo.";
        }
    } else {
        echo "No se ha especificado el nombre del archivo.";
    }
    header("refresh:3;url=index.php");
}

if (isset($_GET["accion"]) && $_GET["accion"] === "del") {
    if (!isset($_GET["confirm"])) {
        var_dump($_GET["archivo"]);
        /*   header("refresh:3;url=read.php"); */
        echo "<a href='delArchivo.php?accion=del&confirm=1&archivo= " . $_GET["archivo"] . " '>SI</a><br>
        <a href='delArchivo.php?accion=del&confirm=0&archivo=' " . $_GET["archivo"] . " '>NO</a>";
        exit;
    }
    if ($_GET["confirm"] === 0)
        header("Location: readpat.php");
    if ($_GET["archivo"] === "prueva.es") {
        unlink($_GET["archivo"]);
        header("refresh:3;url=read.php");
    } else {
        header("refresh:3;url=index.php");
        echo "estos archivos no se pueden borrar";

    }
    ;
}

if (isset($_GET["accion"]) && $_GET["accion"] === "edit") {
    rename($path . $_GET["archivo"], $path . $_GET["archivoMod"]);
    echo "Archivo " . $_GET["archivo"] . $_GET["archivoMod"];
    /*   header("refresh:3;url=index.php"); */
}
;

if (isset($_GET["accion"]) && $_GET["accion"] === "update") {
    if (isset($_GET["archivo"])) {
        var_dump($_GET["archivo"]);
        file_put_contents("archivos/" . $_GET["archivo"], $_GET["texto"]);
        echo "Éxito, se escribió " . $_GET["texto"] . " en el archivo " . $_GET["archivo"];

    } else {

        echo "Error al modificar el archivo";
    }

}
;

if (isset($_POST["accion"]) && $_POST["accion"] === "file") {
    if (isset($_FILES))
        if ($_FILES["file"]["size"] < 4000000) {

            if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
                $id = "1";
                $Filename = $_FILES["file"]["name"];
                $dir = "archivos";

                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                    move_uploaded_file($_FILES["file"]["tmp_name"], $dir . "/" . $Filename);
                    echo "Archivo subido correctamente";
                    exit;

                }
                if (file_exists($dir)) {
                    move_uploaded_file($_FILES["file"]["tmp_name"], $dir . "/" . $Filename);
                    echo "Archivo subido correctamente";
                } else {
                    echo "No se ha podido subir el archivo";
                }
            }
        } else {
            //TODO Cambiar en el archivo php.ini el tamaño máximo de archivo en upload_max_filesize=40M
            echo "El archivo seleccionado es demasiado grande";
        }

}