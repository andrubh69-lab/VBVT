function login() {
    const username = document.getElementById('user').value.trim();
    const password = document.getElementById('pass').value.trim();

    // Limpiar errores previos
    document.getElementById('userError').textContent = '';
    document.getElementById('passError').textContent = '';
    document.getElementById('generalError').textContent = '';

    let hasError = false;

    if (!username) {
        document.getElementById('userError').textContent = 'El usuario es obligatorio';
        hasError = true;
    }

    if (!password) {
        document.getElementById('passError').textContent = 'La contraseña es obligatoria';
        hasError = true;
    }

    if (hasError) return; // no continuar si hay errores

    fetch('http://localhost:3000/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username, password })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'index.html';
        } else {
            document.getElementById('generalError').textContent = 'Credenciales inválidas';
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        document.getElementById('generalError').textContent = 'Error al conectar con el servidor';
    });
}
function restaurarClave(){

let id = document.getElementById("idUsuario");
let fecha = document.getElementById("fechaNacimiento");
let correo = document.getElementById("correo");

let idRegex = /^\d{6,12}$/;
let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

id.classList.remove("error");
correo.classList.remove("error");

if(!idRegex.test(id.value)){
    alert("El ID debe tener entre 6 y 12 números");
    id.classList.add("error");
    return;
}

if(!emailRegex.test(correo.value)){
    alert("Ingrese un correo válido");
    correo.classList.add("error");
    return;
}

if(fecha.value === ""){
    alert("Debe ingresar la fecha de nacimiento");
    return;
}

alert("Solicitud de restauración enviada");
}