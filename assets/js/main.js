document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.contact-form');
    
    form.addEventListener('submit', function(e) {
        const nombre = form.querySelector('input[name="nombre"]').value;
        const email = form.querySelector('input[name="email"]').value;
        const telefono = form.querySelector('input[name="telefono"]').value;
        const mensaje = form.querySelector('textarea[name="mensaje"]').value;
        
        let isValid = true;
        
        // Validación de email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Por favor, ingrese un email válido');
            isValid = false;
        }
        
        // Validación de teléfono
        const telefonoRegex = /^\d{8,}$/;
        if (!telefonoRegex.test(telefono)) {
            alert('Por favor, ingrese un número de teléfono válido');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
        }
    });
});