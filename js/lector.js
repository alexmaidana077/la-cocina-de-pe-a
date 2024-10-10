// Seleccionamos los elementos por sus ID
const elementos = document.querySelectorAll('#titulo, #ingredientes, #preparacion');
const botonLeer = document.getElementById('leer');
const botonDetener = document.getElementById('detener');
const botonReproducir = document.getElementById('reproducir');

// Variables para almacenar el estado de lectura
let mensajes = [];
let indiceMensaje = 0;
let lecturaEnCurso = false;

// Función que convierte el texto seleccionado en voz
function leerSeleccionado() {
    let texto = '';

    // Recorremos los elementos seleccionados y concatenamos su texto
    elementos.forEach(elemento => {
        texto += elemento.innerText + ' '; // Añadimos el texto de cada elemento
    });

    // Dividimos el texto en partes más pequeñas
    mensajes = dividirTexto(texto, 150); // 150 caracteres por parte
    indiceMensaje = 0; // Reiniciamos el índice al inicio

    // Iniciamos la lectura
    lecturaEnCurso = true; // Marcamos que la lectura ha comenzado
    leerSiguienteMensaje();
}

// Función que divide el texto en partes más pequeñas
function dividirTexto(texto, tamanoMaximo) {
    let partes = [];
    while (texto.length > 0) {
        partes.push(texto.substring(0, tamanoMaximo));
        texto = texto.substring(tamanoMaximo);
    }
    return partes;
}

// Función para reproducir el siguiente mensaje de la lista
function leerSiguienteMensaje() {
    if (indiceMensaje < mensajes.length) {
        let mensaje = new SpeechSynthesisUtterance(mensajes[indiceMensaje]);
        mensaje.lang = 'es-ES'; // Configuramos el idioma a español

        // Cuando termina de leer una parte, pasa a la siguiente
        mensaje.onend = function() {
            indiceMensaje++;
            leerSiguienteMensaje(); // Llama a la siguiente parte
        };

        // Manejo de errores
        mensaje.onerror = function(event) {
            console.error("Error en la lectura: ", event.error);
            detenerLectura(); // Detener en caso de error
        };

        window.speechSynthesis.speak(mensaje);
    } else {
        lecturaEnCurso = false; // Marcamos que la lectura ha terminado
    }
}

// Función que detiene la lectura y guarda la posición actual
function detenerLectura() {
    // Cancelamos cualquier lectura en curso
    window.speechSynthesis.cancel();
    lecturaEnCurso = false; // Marcamos que no hay lectura en curso
}

// Función para continuar desde la parte donde se detuvo
function reproducirDesdeDondeSeQuedo() {
    if (indiceMensaje < mensajes.length) {
        lecturaEnCurso = true; // Marcamos que la lectura ha comenzado
        leerSiguienteMensaje(); // Continúa desde la posición actual
    }
}

// Añadimos los eventos para los botones
botonLeer.addEventListener('click', leerSeleccionado);
botonDetener.addEventListener('click', detenerLectura);
botonReproducir.addEventListener('click', reproducirDesdeDondeSeQuedo);
