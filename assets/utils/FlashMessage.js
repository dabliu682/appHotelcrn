export default class FlashMessage {
    static show(message, type = 'success', duration = 3000) {
        // type: 'success', 'danger', 'warning', 'info'
        let alert = document.createElement('div');
        alert.className = `alert alert-${type} flash-message slide-in position-fixed top-0 end-0 mt-3 me-3 shadow`;
        alert.style.zIndex = 2000;
        alert.role = 'alert';
        alert.innerText = message;

        document.body.appendChild(alert);

        // Forzar reflow para que la animación funcione al agregar la clase
        void alert.offsetWidth;

        // Mostrar el mensaje deslizándose hacia adentro
        alert.classList.add('show-slide');

        setTimeout(() => {
            // Ocultar el mensaje deslizándose hacia afuera
            alert.classList.remove('show-slide');
            alert.classList.add('hide-slide');
            setTimeout(() => alert.remove(), 500);
        }, duration);
    }
}