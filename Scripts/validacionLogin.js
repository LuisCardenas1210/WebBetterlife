document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");

    function mostrarErrores(listaErrores) {
        const errorDiv = document.getElementById("errores");
        errorDiv.innerHTML = "";
        errorDiv.style.display = "block";

        listaErrores.forEach(msg => {
            const div = document.createElement("div"); 
            div.textContent = msg;
            errorDiv.appendChild(div);
        });
    }

    form.addEventListener("submit", (event) => {
        const errores = [];
        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();

        if (email === "" || !email.includes("@")) {
            errores.push("Por favor, ingrese un correo válido.");
        }

        if (password.length < 4) {
            errores.push("La contraseña debe tener al menos 4 caracteres.");
        }

        if (errores.length > 0) {
            event.preventDefault(); 
            mostrarErrores(errores);
        }
    });
});
