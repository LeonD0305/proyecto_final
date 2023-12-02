// ayuda.js

function enviar(event) {
    event.preventDefault(); // Evita el comportamiento predeterminado del  (enviar a otra página)

    // Verifica si el  se ha rellenado
    var nombre = document.getElementById("nombre").value;
    var telefono = document.getElementById("telefono").value;
    var correoo = document.getElementById("correo").value;
    var mensaje = document.getElementById("mensaje").value;

    if (nombre && telefono && correoo && mensaje) {
        // Muestra una ventana de alerta
        alert("¡ enviado! Gracias por ponerte en contacto con nosotros.");
        document.getElementById("myForm").reset(); // Limpia el 
    } else {
        alert("Por favor, completa todos los campos antes de enviar el formulario.");
    }
}
