document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");

    form.addEventListener("submit", (event) => {
        let valid = true;
        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();

        if (email === "" || !email.includes("@")) {
            alert("Por favor, ingrese un correo válido.");
            valid = false;
        }

        if (password.length < 4) {
            alert("La contraseña debe tener al menos 4 caracteres.");
            valid = false;
        }

        if (!valid) {
            event.preventDefault();
        }
    });
});
