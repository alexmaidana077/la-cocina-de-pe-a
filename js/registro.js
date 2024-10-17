function validarFormulario() {
    return validarEmail() && validarContraseña();
}

function validarEmail() {
    var email = document.getElementById("email").value;
    var patron = /^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com)$/;

    if (!patron.test(email)) {
        alert("Por favor ingrese un correo válido que termine en @gmail.com o @hotmail.com");
        return false;
    }

    return true;
}

function validarContraseña() {
    var contraseña = document.getElementById('contraseña').value;
    var confirmarContraseña = document.getElementById('confirmarContraseña').value;

    if (contraseña !== confirmarContraseña) {
        alert('Las contraseñas no coinciden.');
        return false;
    }

    return true;
}
