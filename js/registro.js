function validarFormulario() {
    return validarEmail() && validarContraseña() && validarUsuario();
}

function validarEmail() {
    var email = document.getElementById("email").value;
    var patron = /^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com|abc\.com|yahoo\.com|outlook\.com|icloud\.com|live\.com|aol\.com|zoho\.com|protonmail\.com|yandex\.com|mail\.ru|fastmail\.com|inbox\.com|gmx\.com|mail\.com|msn\.com|rediffmail\.com|tutanota\.com)$/;


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

function validarUsuario() {
    var nombreUsuario = document.getElementById('usuario').value.trim();

    const palabrasProhibidas = [
        "negro", "trolo", "pene", "verga", "idiota", "estúpido", "imbécil", "pendejo", "tonto",
        "estupido", "burro", "inútil", "baboso", "bobo", "zángano", "cretino", "tarado",
        "desgraciado", "bruto", "animal", "loco", "pervertido", "prostituta", "prosti",
        "rata", "cucaracha", "ratero", "puto", "puta", "mierda", "caca", "imbecil",
        "gay", "maricón", "marica", "pito", "chingón", "chingada", "cabron", "cabrona",
        "zorra", "burra", "estupida", "mamón", "mamona", "huevón", "huevona", "gilipollas",
        "gil", "careverga", "careculo", "maldito", "concha", "polla", "pedazo", "cabrón",
        "putilla", "malparido", "gonorrea", "vergon", "basura", "mierdero", "perra",
        "puta madre", "coño", "marica", "mierdero", "trola", "putón", "cagón", "cerdo",
        "cochino", "imbécil", "sidoso", "perra", "asqueroso", "drogadicto", "puta madre",
        "puta", "chinga", "hijueputa", "sinvergüenza", "cagada", "putrefacto", "culero",
        "cabrona", "deforme", "mujerzuela", "golfa", "sucia", "despojo", "malparida",
        "fuera de lugar", "fresa", "mamona", "aguafiestas", "gordo", "gorda", "panzón",
        "mongol", "chavista", "demasiado sensible", "desagradable", "violador", "maltratador"
    ];
    

    for (const palabra of palabrasProhibidas) {
        if (nombreUsuario.toLowerCase().includes(palabra.toLowerCase())) {
            alert("No puedes usar palabras ofensivas en tu nombre de usuario.");
            return false; 
        }
    }

    return true;
}