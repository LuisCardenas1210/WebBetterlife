document.addEventListener("DOMContentLoaded", () => {
    const formulario = document.querySelector("form");

    formulario.addEventListener("submit", (event) => {
        const botonPresionado = event.submitter; // Botón que disparó el submit
        const accion = botonPresionado?.value;

        if (accion === "guardar") {
            if (!validarFormulario()) {
                event.preventDefault(); // Detiene envío si hay errores
            }
        }
        // Si es "volver", no se valida
    });
});

function validarFormulario() {
    const errores = [];
    const camposDia = document.querySelectorAll(".dia");
    const camposDetalle = document.querySelectorAll(".detalle");
    const rutina = document.getElementById("txtRutina");

    if (rutina.value.trim() === "") {
        errores.push("Debe ingresar una Descripción de la rutina.");
        rutina.style.border = "2px solid red";
    } else {
        rutina.style.border = "";
    }

    if (rutina.value.trim().length > 1000) {
        errores.push("La Descrición de la rutina no puede tener más de 1000 caracteres");
        rutina.style.border = "2px solid red";
    } else {
        rutina.style.border = "";
    }

    camposDia.forEach(campo => {
        if (campo.value.trim() === "") {
            errores.push("Debe ingresar " + campo.name);
            campo.style.border = "2px solid red";
        } else {
            campo.style.border = "";
        }
    });

    camposDetalle.forEach(campo => {
        if (campo.value.trim() === "") {
            errores.push("Debe ingresar " + campo.name);
            campo.style.border = "2px solid red";
        } else {
            campo.style.border = "";
        }
    });

    if (errores.length > 0) {
        mostrarErrores(errores);
        return false;
    }
    return true;
}

function mostrarErrores(errores) {
    const divErrores = document.getElementById("erroresjs");
    divErrores.innerHTML = errores.map(error => `<p>${error}</p>`).join("");
    divErrores.style.display = "block";
}
