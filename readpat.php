<?php
$path = "archivos/";
$pathInfo = pathinfo($path);

$dir = opendir($path);     
        while ($elemento = readdir($dir)){    // Leo todos los ficheros de la carpeta   
        // Tratamos los elementos . y .. que tienen todas las carpetas       
            if( $elemento != "." && $elemento != ".."){  
                $info = pathinfo($elemento);
                $name = $info['basename'];              
                $fullName = $path."/".$elemento;
                $size = filesize($fullName);
                $lastDate = date("Y-m-d", filemtime($fullName));

            if( is_dir($path.$elemento) ){   // Si es una carpeta                 
            // Muestro la carpeta      
                
                echo "<div class='document'><p><i class='fa fa-folder' aria-hidden='true'></i> 
                <a href='".$path."/".$elemento."'>". $elemento."</p> </a>            
              
                <p>".$size." bytes </p>" .$lastDate."  
                <a href='delArchivo.php?accion=del&archivo=".$elemento."'>
                    <button>
                        <i class='fa fa-trash' aria-hidden='true'></i>  
                    </button>
                </a>
                <a href='delArchivo.php?accion=edit&archivo=".$elemento."'>
                    <i class='fa fa-pencil' aria-hidden='true'></i>
                </a>
                </div>";  
                 
            } else {   
                $ext = $info['extension'];
                    // Si es un fichero                   
                echo "<br /><div class='document'><p><i class='fa fa-file' aria-hidden='true'></i> <a href='".$path.$elemento."'>". $elemento."</p></a> 
                <a href='delArchivo.php?accion=del&archivo=".$elemento."'> </a><p>".$size." bytes</p>" .$lastDate." <button><i class='fa fa-trash' aria-hidden='true'></i></button>
                <button onclick=openedit('".$elemento."')><i class='fa fa-pencil' aria-hidden='true' ></i></button>
                <button onclick=openeditcontent('".$elemento."')><i class='fa fa-file-text' aria-hidden='true'></i></button>
                </div>";      // Muestro el fichero       
            }         
        }   
    }