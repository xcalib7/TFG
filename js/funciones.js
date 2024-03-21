
/* Funcion listar carpetas y archivos*/

/* Funcion para crear una nueva carpeta*/
$(document).ready(function () {

  //Abrir el modal si hace click en crear carpeta
  $("#abrirModalBtn").click(function () {
    abrirModalNuevaCarpeta();
  });

  //Crear carpeta si se hace click en crear, habiendo introducido un nombre
  $("#crearCarpetaModalBtn").click(function () {
    var nombreCarpeta = $("#nombreCarpetaInput").val();

    if (nombreCarpeta) {
      $.ajax({
        type: "POST",
        url: "peticiones/crear_carpeta.php",
        data: { nombre: nombreCarpeta },
        success: function (response) {
          console.log(response);
          $("#nombreCarpetaModal").modal("hide");
          listar();
        },
        error: function () {
          alert('Error al crear la carpeta');
        }
      });
    }
  });

  //Si pulsas subir archivos se abre un input tipo file

  $('#cargarArchivosBtn').click(function () {

    $("#cargarArchivosInput").click();


  });

  $("#cargarArchivosInput").change(function () {
    var archivos = $("#cargarArchivosInput") [0].files ;

    console.log()
    // Aquí puedes realizar la lógica para subir los archivos y carpetas al servidor
    // Puedes utilizar AJAX o alguna otra técnica para cargarlos

      /* $.ajax({

        type: "POST",

        url: "peticiones/subir_archivos.php",

        data: archivos


      }) */


    if (archivos.length > 0) {
      console.log("Archivos seleccionados:");
      for (var i = 0; i < archivos.length; i++) {
        console.log(archivos[i].name);
      }
      // Lógica para cargar los archivos seleccionados
    }
  });

   //Si pulsas subir la carpeta se abre un input tipo file

  $('#cargarCarpetasBtn').click(function () {

    $("#cargarCarpetasInput").click();


  });

  $("#cargarCarpetasInput").change(function () {
    var archivos = $("#cargarCarpetasInput")[0].files;
    // Aquí puedes realizar la lógica para subir los archivos y carpetas al servidor
    // Puedes utilizar AJAX o alguna otra técnica para cargarlos
    if (archivos.length > 0) {
      console.log("Archivos seleccionados:");
      for (var i = 0; i < archivos.length; i++) {
        console.log(archivos[i]);
      }
      // Lógica para cargar los archivos seleccionados
    }
  });




});

function abrirModalNuevaCarpeta() {
  $("#nombreCarpetaModal").modal("show");
  $("#nombreCarpetaInput").val("");
}


function listar() {
  $.ajax({
    type: "POST",
    url: "peticiones/listarAyC.php",
    success: function (data) {


      data = JSON.parse(data);

      var carpetas = data.carpetas;
      var archivos = data.archivos;

      // generar dinámicamente el contenido para carpetas
      var htmlCarpetas = carpetas.map(function (carpeta) {
        return "<div class='carpeta'><img src='images/carpeta.png'><p>" + carpeta + "</p></div>";
      });

      // generar dinámicamente el contenido para archivos
      var htmlArchivos = archivos.map(function (archivo) {
        return "<div class='archivo'><img src='images/archivo.png'><p>" + archivo + "</p></div>";
      });



      // agregar el contenido generado a la página web
      $("#carpetas").html(htmlCarpetas.join(""));
      $("#archivos").html(htmlArchivos.join(""));

    }
  });
}