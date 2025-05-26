document.addEventListener("DOMContentLoaded",()=>{
    const tipoUsuario=document.getElementById("tipoUsuario");
    const camposCliente=document.getElementById("camposUsuario");
    const camposProfesional=document.getElementById("camposProfesional");

    function cambiarFormulario() {
        const tipo = tipoUsuario.value;

        if (tipo === "cliente") {
            camposCliente.style.display = "block";
            camposProfesional.style.display = "none";
        } else {
            camposCliente.style.display = "none";
            camposProfesional.style.display = "block";
        }
    }

    cambiarFormulario();

    tipoUsuario.addEventListener("change", cambiarFormulario);
});