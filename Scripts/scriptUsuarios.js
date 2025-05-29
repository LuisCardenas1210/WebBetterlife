function enviarFormulario(id_Usuario, id_Solicitud) {
    document.getElementById('inputIdUsuario').value = id_Usuario;
    document.getElementById('inputIdSolicitud').value = id_Solicitud;
    document.getElementById('formEnviar').submit();
}