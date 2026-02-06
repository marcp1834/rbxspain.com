function OcultarMostrar() {
    let input = document.getElementById('contrasena') || document.getElementById('contrasenaRegistro');
    let botonOjo = document.querySelector('.toggle-password');
    
    if (input.type === 'password') {
        input.type = 'text';
        botonOjo.textContent = '👁️';
    } else {
        input.type = 'password';
        botonOjo.textContent = '🔒';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    let botonOjoCandado = document.querySelector('.toggle-password');
    if(botonOjoCandado) {
        botonOjoCandado.addEventListener('click', OcultarMostrar);
    }
}); 