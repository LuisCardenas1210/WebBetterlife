document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("contrasena");
    const confirmInput = document.getElementById("confirmar_contrasena");

    form.addEventListener("submit", (e) => {
        const errores = [];
        const email = emailInput.value.trim();
        const password = passwordInput.value;
        const confirmPassword = confirmInput.value;

        // Validar correo electrónico
        if (!/^\S+@\S+\.\S+$/.test(email)) {
            errores.push("Correo inválido.");
            emailInput.focus();
            e.preventDefault();
        }

        // Validar longitud de contraseña
        if (password.length < 4) {
            errores.push("La contraseña debe tener al menos 4 caracteres.");
            passwordInput.focus();
            e.preventDefault();
        }

        // Validar coincidencia de contraseñas
        if (password !== confirmPassword) {
            errores.push("Las contraseñas no coinciden.");
            confirmInput.focus();
            e.preventDefault();
        }

        if (errores.length > 0) {
            mostrarErrores(errores);
            return false;
        }

        return true;
    });

    function mostrarErrores(errores) {
        const divErrores = document.getElementById("erroresjs");
        divErrores.innerHTML = errores.map(error => `<p>${error}</p>`).join("");
        divErrores.style.display = "block";
    }
});
