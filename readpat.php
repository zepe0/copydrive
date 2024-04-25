<?php
$path = "archivos/";
$pathInfo = pathinfo($path);

$dir = opendir($path);
while ($elemento = readdir($dir)) {    // Leo todos los ficheros de la carpeta   
    // Tratamos los elementos . y .. que tienen todas las carpetas       
    if ($elemento != "." && $elemento != "..") {
        $info = pathinfo($elemento);
        $name = $info['basename'];
        $fullName = $path . "/" . $elemento;
        $size = filesize($fullName);
        $lastDate = date("Y-m-d", filemtime($fullName));

        if (is_dir($path . $elemento)) {   // Si es una carpeta                 
            // Muestro la carpeta      

            echo "
            <div class='document'>
                <p class='izq'>
                    <i class='fa fa-folder' aria-hidden='true'></i> 
                    <a href='" . $path . "/" . $elemento . "'>" . $elemento . "</a>
                </p>             
                <div class='medio'> 
                    <p>" . $size . " bytes </p>
                    <p>" . $lastDate . "  </p>
                </div>  
                <div class='der'>  
                    <button onclick=openedit('" . $elemento . "')>
                        <i class='fa fa-pencil' aria-hidden='true' ></i>
                    </button> 
                </div>             
            </div>";

        } else {
            $ext = $info['extension'];
            if ($ext == 'txt') {
                //if (preg_match("/\.txt$/", $elemento)) {
                // Si es un fichero      

                echo "
                <div class='document'>
                    <p class='izq'>
                        <i class='fa fa-file' aria-hidden='true'></i>
                        <a href='" . $path . $elemento . "'>" . $elemento . "</a>
                    </p> 
                    <div class='medio'>
                        <p>"
                    . $size . " bytes
                        </p>
                        <p>"
                    . $lastDate . "
                        </p>
                    </div>
                    <div class='der'>
                    <a href='delArchivo.php?accion=del&archivo=" . $elemento . "'>
                        <button>
                            <i class='fa fa-trash' aria-hidden='true'></i>
                        </button>
                    </a>
                        <button onclick=\"openedit('" . $elemento . "')\">
                            <i class='fa fa-pencil' aria-hidden='true'></i>
                        </button>
                        <button onclick=\"openeditcontent('" . $elemento . "')\">
                            <i class='fa fa-file-text' aria-hidden='true'></i>
                        </button>
                    </div>
            </div>";   // Muestro el fichero       
            } else {
                echo "
                <div class='document'>
                    <p class='izq'>
                        <i class='fa fa-file' aria-hidden='true'></i>   
                        <a href='" . $path . $elemento . "'>" . $elemento . "
                        </a> 
                    </p>
                        <a href='delArchivo.php?accion=del&archivo=" . $elemento . "'>
                        </a>
                    <div class='medio'>
                        <p>"
                    . $size . " bytes
                        </p>
                        <p>
                            " . $lastDate . "
                        </p>
                    </div>
                    <div class='der'>
                        <a href='delArchivo.php?accion=del&archivo=' . $elemento . '>
                            <button>
                            <i class='fa fa-trash' aria-hidden='true'></i>
                            </button>
                        </a>
                        <button onclick=openedit('" . $elemento . "')>
                            <i class='fa fa-pencil' aria-hidden='true' ></i>
                        </button>
                    </div>
               
                 </div>";
            }
        }

    }
}