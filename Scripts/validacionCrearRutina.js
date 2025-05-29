document.addEventListener("DOMContentLoaded", () => {
    const btnGuardar = document.getElementById("btnGuardar");
    const formulario = document.querySelector("form");

    btnGuardar.addEventListener("click", () => {
        if (validarFormulario()) {
            formulario.submit();
        }
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
    const divErrores = document.getElementById("errores");
    divErrores.innerHTML = errores.map(error => `<p>${error}</p>`).join("");
    divErrores.style.display = "block";
}