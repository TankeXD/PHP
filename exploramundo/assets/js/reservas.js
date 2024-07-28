

document.addEventListener("DOMContentLoaded", () => {
    document.querySelector('select[id="BuscarCliente"]').addEventListener('change', function (cliente) {
        const opcion =  cliente?.target?.value
        if(opcion){
            const opcionvalores = opcion.split("|")
            document.getElementById("buscar_nom_cli").value = opcionvalores[0]
            document.getElementById("buscar_nom_cli").disabled = true 
            document.getElementById("buscar_rut").value = opcionvalores[1]
            document.getElementById("buscar_rut").disabled = true 
            document.getElementById("buscar_fecha_nac").value = opcionvalores[2]
            document.getElementById("buscar_fecha_nac").disabled = true 
            document.getElementById("buscar_telefono").value = opcionvalores[3]
            document.getElementById("buscar_telefono").disabled = true 
            document.getElementById("buscar_correo").value = opcionvalores[4]
            document.getElementById("buscar_correo").disabled = true 
        }
        
       
    });
})
