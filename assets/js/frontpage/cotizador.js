document.addEventListener('DOMContentLoaded', function () {
    const title = document.querySelector('#cotizador .content .container .title-section');
    const form = document.getElementById('envio-form');
    const botonNueva = document.getElementById('nueva-cotizacion-wrap');

    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const origen = document.getElementById('cp-origen').value;
        const destino = document.getElementById('cp-destino').value;
        const tipo = document.getElementById('tipo-de-envio').value;
        const tipo2 = document.getElementById('tipo-de-producto').value;
        const peso = document.getElementById('peso').value;
        const alto = document.getElementById('alto').value;
        const largo = document.getElementById('largo').value;
        const ancho = document.getElementById('ancho').value;

        const mensaje = `💬 *Solicitud de cotización de envío*\n\n` +
            `*Origen:* ${origen}\n` +
            `*Destino:* ${destino}\n` +
            `*Tipo de envío:* ${tipo}\n` +
            `*Tipo de producto:* ${tipo2}\n` +
            `*Peso:* ${peso} Kg\n` +
            `*Tamaño de caja:* ${alto} x ${largo} x ${ancho} cm\n\n` +
            `Enviado desde el formulario del sitio web`;

        // ✅ tomado de wp_localize_script
        const numeroWhatsApp = cotizadorData.whatsapp;
        const url = `https://wa.me/${numeroWhatsApp}?text=${encodeURIComponent(mensaje)}`;
        window.open(url, '_blank');

        title.classList.add('hide');
        form.style.maxHeight = '0';
        if (botonNueva) {
            botonNueva.style.maxHeight = '1000px';
        }
    });

    const nuevaBtn = document.getElementById('nueva-cotizacion');
    if (nuevaBtn) {
        nuevaBtn.addEventListener('click', function() {
            form.reset();
            form.style.maxHeight = '1000px';
            title.classList.remove('hide');
            botonNueva.style.maxHeight = '0';
        });
    }
});
