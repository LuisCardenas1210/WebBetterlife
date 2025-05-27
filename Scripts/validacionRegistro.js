document.addEventListener("DOMContentLoaded", () => {
    const tipoUsuario = document.getElementById("tipoUsuario");
    const camposCliente = document.getElementById("camposCliente");
    const camposProfesional = document.getElementById("camposProfesional");
    const form = document.querySelector("form");

    function cambiarFormulario() {
        const tipo = document.getElementById('tipoUsuario').value;
        document.getElementById('camposCliente').style.display = tipo === 'cliente' ? 'block' : 'none';
        document.getElementById('camposProfesional').style.display = tipo === 'profesional' ? 'block' : 'none';
    }
    window.onload = cambiarFormulario;


    tipoUsuario.addEventListener("change", cambiarFormulario);
    cambiarFormulario();

    function mostrarError(msg) {
        alert(msg);
    }

    function validarFormulario(e) {
        const nombre = document.getElementById("nombre").value.trim();
        const apellidos = document.getElementById("apellidos").value.trim();
        const correo = document.getElementById("correo").value.trim();
        const password = document.getElementById("password").value;
        const confirm = document.getElementById("confirm_password").value;

        const tipo = tipoUsuario.value;

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const medidaRegex = /^\d+(kg|cm)$/i;

        if (nombre.length < 2) return mostrarError("El nombre debe tener al menos 2 caracteres."), e.preventDefault();
        if (apellidos.length < 2) return mostrarError("Los apellidos deben tener al menos 2 caracteres."), e.preventDefault();
        if (!emailRegex.test(correo)) return mostrarError("Correo electrónico no válido."), e.preventDefault();
        if (password.length < 4) return mostrarError("La contraseña debe tener al menos 6 caracteres."), e.preventDefault();
        if (password !== confirm) return mostrarError("Las contraseñas no coinciden."), e.preventDefault();

        if (tipo === "cliente") {
            const edad = parseInt(document.querySelector("[name='txtEdad']").value);
            const peso = document.querySelector("[name='txtPeso']").value.trim();
            const estatura = document.querySelector("[name='txtEstatura']").value.trim();
            const brazoC = document.querySelector("[name='txtBrazoC']").value.trim();
            const brazoR = document.querySelector("[name='txtBrazoR']").value.trim();
            const cintura = document.querySelector("[name='txtCintura']").value.trim();
            const pierna = document.querySelector("[name='txtPierna']").value.trim();
            const sexo = document.querySelector("[name='sexo']").value;
            const preferencia = document.querySelector("[name='preferencia']").value;

            if (isNaN(edad) || edad <= 0) return mostrarError("Edad no válida."), e.preventDefault();
            if (![peso, estatura, brazoC, brazoR, cintura, pierna].every(v => medidaRegex.test(v)))
                return mostrarError("Todas las medidas deben tener formato válido (ej: 70kg, 170cm)."), e.preventDefault();
            if (!sexo) return mostrarError("Seleccione un sexo."), e.preventDefault();
            if (!preferencia) return mostrarError("Seleccione una preferencia."), e.preventDefault();
        }

        if (tipo === "profesional") {
            const especialidad = document.querySelector("[name='txtEspecialidad']").value.trim();
            const enfoque = document.querySelector("[name='txtEnfoque']").value.trim();

            if (especialidad.length < 3) return mostrarError("La especialidad debe tener al menos 3 caracteres."), e.preventDefault();
            if (enfoque.length < 5) return mostrarError("El enfoque debe tener al menos 5 caracteres."), e.preventDefault();
        }
    }

    form.addEventListener("submit", validarFormulario);
});
