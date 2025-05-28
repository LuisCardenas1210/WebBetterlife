document.addEventListener("DOMContentLoaded", () => {
    const tipoUsuario = document.getElementById("tipoUsuario");
    const camposCliente = document.getElementById("camposCliente");
    const camposProfesional = document.getElementById("camposProfesional");
    const form = document.querySelector("form");

    function cambiarFormulario() {
        const tipo = document.getElementById('tipoUsuario').value;
        camposCliente.style.display = tipo === 'cliente' ? 'block' : 'none';
        camposProfesional.style.display = tipo === 'profesional' ? 'block' : 'none';
    }

    tipoUsuario.addEventListener("change", cambiarFormulario);
    cambiarFormulario();

    function mostrarErrores(listaErrores) {
        const errorDiv = document.getElementById("errores");
        errorDiv.innerHTML = "";
        errorDiv.style.display = "block"; // Mostrarlo si había estado oculto

        listaErrores.forEach(msg => {
            const p = document.createElement("p");
            p.textContent = msg;
            errorDiv.appendChild(p);
        });
    }

    function validarFormulario(e) {
        const errores = [];
        const nombre = document.getElementById("nombre").value.trim();
        const apellidos = document.getElementById("apellidos").value.trim();
        const correo = document.getElementById("correo").value.trim();
        const password = document.getElementById("password").value;
        const confirm = document.getElementById("confirm_password").value;

        const tipo = tipoUsuario.value;

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const medidaRegex = /^\d+(kg|cm)$/i;

        if (nombre.length < 2) errores.push("El nombre debe tener al menos 2 caracteres.");
        if (apellidos.length < 2) errores.push("Los apellidos deben tener al menos 2 caracteres.");
        if (!emailRegex.test(correo)) errores.push("Correo electrónico no válido.");
        if (password.length < 4) errores.push("La contraseña debe tener al menos 4 caracteres.");
        if (password !== confirm) errores.push("Las contraseñas no coinciden.");

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

            if (isNaN(edad) || edad <= 0) errores.push("Edad no válida.");
            if (![peso, estatura, brazoC, brazoR, cintura, pierna].every(v => medidaRegex.test(v))) {
                errores.push("Todas las medidas deben tener formato válido (ej: 70kg, 170cm).");
            }
            if (!sexo) errores.push("Seleccione un sexo.");
            if (!preferencia) errores.push("Seleccione una preferencia.");
        }

        if (tipo === "profesional") {
            const especialidad = document.querySelector("[name='txtEspecialidad']").value.trim();
            const enfoque = document.querySelector("[name='txtEnfoque']").value.trim();

            if (especialidad.length < 3) errores.push("La especialidad debe tener al menos 3 caracteres.");
            if (enfoque.length < 5) errores.push("El enfoque debe tener al menos 5 caracteres.");
        }

        if (errores.length > 0) {
            e.preventDefault();
            mostrarErrores(errores);
        }
    }

    form.addEventListener("submit", validarFormulario);
});
