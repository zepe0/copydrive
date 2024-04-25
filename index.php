<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/style.css">
    <title>Copydrive</title>
    <script>
        function files() {
            try {
                const inputFile = document.getElementById('file'); // Supongamos que tienes un input con id "archivo"
                const formData = new FormData();
                formData.append('file', inputFile.files[0]);
                formData.append('accion', 'file');

                fetch('./delArchivo.php', {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => {
                        if (response.ok) {
                            return response.text(); // Obtén la cadena de texto de la respuesta
                        } else {
                            throw new Error('Error en la llamada Ajax: ' + response.statusText);
                        }
                    })
                    .then(data => {
                        console.log('Respuesta del servidor:', data);
                    })
                    .catch(error => {
                        console.error('Error al enviar el archivo:', error);
                    });
            } catch (error) {
                console.log(error);
            }


        }
        function openedit(nombre) {

            document.getElementById("edit").showModal();
            let input = document.getElementById("inewName");
            let original = document.getElementById("idArchivo")
            input.value = nombre;
            original.value = nombre;

        }
        function close() {
            document.getElementById("edit").close();
        }
        function opennewdoc() {
            document.getElementById("new").showModal();
        }
        function openeditcontent(elemet) {
            document.getElementById("editcontent").showModal();
            let input = document.getElementById("fileName");
            input.value = elemet;



            fetch(`archivos/${elemet}`)

                .then((response) => response.text())
                .then((textString) => {
                    document.getElementById("contenidoArchivo").value = textString;

                })
                .catch((error) => {
                    console.error("Error al obtener el archivo:", error);
                });
        }
        function Updatecontent() {
            try {
                let archivo = document.getElementById("fileName").value;
                let text = document.getElementById("contenidoArchivo").value;
                const url = `http://localhost/copydrive/delArchivo.php?texto=${text}&accion=update&archivo=${archivo}`;

                fetch(url)
                    .then((response) => {
                        if (response.ok) {
                            return response.text(); 
                        }
                    })
                    .then((data) => {
                        console.log(data); 
                        debugger;
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        debugger;
                    });
            } catch (error) {
                console.log(error);
            }
        }
        function UpdateNAme() {
            try {
                let newname = document.getElementById("inewName").value;
                let original = document.getElementById("idArchivo").value;

                fetch(`http://localhost/copydrive/delArchivo.php?accion=edit&archivo=${original}&archivoMod=${newname}`).then((response) => {
                    if (response.ok) {
                        return response.text(); // Obtén la cadena de texto de la respuesta
                    } else {
                        throw "Error en la llamada Ajax";
                    }
                })
                    .then((data) => {
                        console.log(data); // Aquí obtendrás la respuesta del servidor
                        debugger;
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        debugger;
                    });

            }
            catch (error) {
                console.log(error)

            }
        }

    </script>
</head>

<body>
    <div class="SectionButton"><button onclick=opennewdoc()><i class="fa fa-file-text" aria-hidden="true"></i></button>
    </div>
    <div class="listado"><?php include "readpat.php" ?></div>
    <dialog id="edit">
        <form action=""><label>Nombre Archivo: </label><input type="text" value="" placeholder="" id="inewName">
            <input type="hidden" value="" id="idArchivo">
            <button><i class="fa fa-window-close" aria-hidden="true" onclick=close()></i></button>
            <button onclick=UpdateNAme()><i class="material-symbols-outlined">
                    save_as
                </i></button>
        </form>
    </dialog>
    <dialog id=new>
        <form action=""><label>Nombre Archivo: </label><input type="file" id="file">


            <button><i class="fa fa-window-close" aria-hidden="true" onclick=close()></i></button>
            <button onclick=files()><i class="material-symbols-outlined">
                    save_as
                </i></button>
        </form>
    </dialog>
    <dialog id="editcontent">
        <form action=""><input type="text" id="fileName"><textarea type="text" id="contenidoArchivo"></textarea><button
                onclick="Updatecontent()">Enviar</button>
            <button><i class="fa fa-window-close" aria-hidden="true" onclick=close()></i></button>
        </form>

    </dialog>

</body>

</html>