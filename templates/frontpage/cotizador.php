<section id="cotizador" class="block">
    <div class="content large-width">
        <div class="container">
            <h2 class="title-section">Cotiza gratis tu envío nacional o internacional</h2>
        </div>
        <form class="container" action="#" method="post" id="envio-form">
            <div class="custom-form cp">
                <label for="cp-origen">Origen</label>
                <input id="cp-origen" name="cp-origen" type="number" placeholder="Código Postal" required>
            </div>

            <div class="custom-form cp">
                <label for="cp-destino">Destino</label>
                <input id="cp-destino" name="cp-destino" type="number" placeholder="Código Postal" required>
            </div>

            <div class="custom-form">
                <label for="tipo-de-envio">Tipo de envío</label>
                <select id="tipo-de-envio" name="tipo-de-envio" required>
                    <option value="">Selecciona una opción</option>
                    <option value="terrestre">Nacional Terrestre</option>
                    <option value="aereo">Nacional Aereo</option>
                    <option value="express">Internacional Aereo Express</option>
                    <option value="priority">Internacional Priority</option>
                </select>
            </div>

            <div class="custom-form">
                <label for="tipo-de-producto">Tipo de Producto</label>
                <select id="tipo-de-producto" name="tipo-de-producto" required>
                    <option value="">Selecciona una opción</option>
                    <option value="Medicamento">Medicamento</option>
                    <option value="Alimentos">Alimentos</option>
                    <option value="Líquidos">Líquidos</option>
                    <option value="Químicos">Químicos</option>
                    <option value="Servicio mixto">Servicio mixto</option>
                    <option value="Documentos">Documentos</option>
                </select>
            </div>

            <div class="custom-form weight">
                <label for="peso">Peso (Kg)</label>
                <input id="peso" name="peso" type="number" placeholder="Kg" step="0.01" min="0" required>
            </div>

            <div class="custom-form size">
                <label>Tamaño de caja (cm)</label>
                <input id="alto" name="alto" type="number" placeholder="Alto" min="0" required>
                <input id="largo" name="largo" type="number" placeholder="Largo" min="0" required>
                <input id="ancho" name="ancho" type="number" placeholder="Ancho" min="0" required>
            </div>

            <div class="custom-form">
                <button class="btn btn-yellow" type="submit">Calcular envío</button>
            </div>
        </form>
        <div class="custom-form" id="nueva-cotizacion-wrap" style="max-height: 0;">
            <p>Tu cotización ha sido enviada.</p>
            <button type="button" class="btn btn-yellow" id="nueva-cotizacion">Nueva cotización</button>
        </div>
    </div>
</section>