import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    connect() {
        // Solo inicializa si no está ya inicializado
        if (!$(this.element).parent().hasClass('bootstrap-select')) {
            $(this.element).selectpicker({
                liveSearch: true
            });
        }
    }

    disconnect() {
        // Solo destruye si está inicializado
        if ($(this.element).data('selectpicker')) {
            $(this.element).selectpicker('destroy');
        }
    }
}