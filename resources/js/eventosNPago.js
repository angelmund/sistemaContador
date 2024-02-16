 // Función para mostrar u ocultar los divs con clase "cheque"
 function toggleChequeDivs() {
    var conceptoPago = document.getElementById('concepto_pago').value;
    var chequeDivs = document.querySelectorAll('.cheque');

    chequeDivs.forEach(function(chequeDiv) {
        if (conceptoPago === 'cheque') {
            chequeDiv.style.display = 'block';
        } else {
            chequeDiv.style.display = 'none';
        }
    });
}

// Ejecutar la función cuando se cargue la página
document.addEventListener('DOMContentLoaded', function() {
    toggleChequeDivs();

    // Ejecutar la función cuando cambie el valor del select
    document.getElementById('concepto_pago').addEventListener('change', function() {
        toggleChequeDivs();
    });
});