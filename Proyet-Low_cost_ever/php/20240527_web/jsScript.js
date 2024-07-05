function seleccionStock(){
    //Obtener los td (celdas) de las filas
    const celdasFila = document.querySelectorAll('td');
    console.log(celdasFila);
    //Iterar sobre las celdas y comprobar que la clase "uds" existe
    celdasFila.forEach(celda=>{
        if(celda.classList.contains('uds')){
            const valorUnidades = parseInt(celda.textContent);
           // console.log(valorUnidades);
            if (valorUnidades < 10) {
                console.log(valorUnidades);
                const hermanosTd = celda.parentElement.getElementsByTagName('td');
                for (const td of hermanosTd){
                    td.classList.add('sombrarojo');
                }
            }
        }
    });
}
document.addEventListener('DOMContentLoaded', seleccionStock);


//FUNCIONES DE LLAMADAS A LOS MODAL DE PRODUCTOS
function addProducto(){
    var modal = new bootstrap.Modal(document.getElementById('addProdModal'));
    modal.show();
}