
import { Controller } from "@hotwired/stimulus";
import { Modal } from 'bootstrap';
import FlashMessage from '../../utils/FlashMessage';

// Connects to data-controller="app"
export default class extends Controller {
    static values = {
        'rutaNuevaHabitacion': String,
        'rutaHabitaciones': String,
        'rutaEliminarPiso': String,
        'rutaNuevoPiso': String,
        'rutaVistas': String,
        'rutaPisos': String,
        'rutaEliminarHab': String,
    };
    static targets = [
        'modalNuevaHabitacion',
        'aireAcondicionado',
        'frameHabitaciones',
        'nombreHabitacion',
        'btnGuardarPiso',
        'modalNuevoPiso',
        'labelModalHab',
        'btnGuardarHab',
        'formNuevoPiso',
        'idHabitacion',
        'formNuevaHab',
        'selectPisos',
        'framePisos',
        'numeroCama',
        'ventilador',
        'nombrePiso',
        'idPiso',
    ];

    connect() {
        // Código que se ejecuta al conectar el controlador
        console.log("AppController conectado");
    }

    cambiarVista(event) {
        event.preventDefault();
        let vista = event.currentTarget.dataset.vista;
        let url = this.rutaVistasValue.replace('var1', vista);
        window.location.href = url;
    }

    abrirModalNuevoPiso(event) {

        let accion = event.currentTarget.dataset.accion;

        if (accion == '2') {

            let idPiso = event.currentTarget.dataset.id;
            let nombrePiso = event.currentTarget.dataset.name;

            this.idPisoTarget.value = idPiso;
            this.nombrePisoTarget.value = nombrePiso;
        }
        else {
            this.idPisoTarget.value = '0';
            this.nombrePisoTarget.value = '';
        }

        this.modal = new Modal(this.modalNuevoPisoTarget);
        this.modal.show();
    }

    validaBtnGuardarPiso(event) {

        let valor = event.currentTarget.value;

        if (valor !== '') {
            this.btnGuardarPisoTarget.disabled = false;
        }
        else {
            this.btnGuardarPisoTarget.disabled = true;
        }
    }

    async guardarPiso(event) {

        let urlGuardar = this.rutaNuevoPisoValue;
        let ruta = this.rutaPisosValue;

        let formulario = '';

        formulario = this.formNuevoPisoTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.modalNuevoPisoTarget);

            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Piso guardado correctamente', 'success');

            const respuesta = await fetch(ruta);
            this.framePisosTarget.innerHTML = await respuesta.text();
        }
    }

    async eliminarPiso(event) {

        let urLEliminar = this.rutaEliminarPisoValue.replace('var1', event.currentTarget.dataset.id);
        let ruta = this.rutaPisosValue;

        var consulta = await fetch(urLEliminar);
        var result = await consulta.json();

        if (result.response == 'Ok') {
            FlashMessage.show('Piso eliminado correctamente', 'danger');
            const respuesta = await fetch(ruta);
            this.framePisosTarget.innerHTML = await respuesta.text();
        }

    }

    abrirModalNuevaHab(event) {

        let accion = event.currentTarget.dataset.accion;

        if (accion == '2') {

            let id = event.currentTarget.dataset.id;
            let name = event.currentTarget.dataset.name;
            let piso = event.currentTarget.dataset.piso;
            let bedmunber = event.currentTarget.dataset.bedmunber;
            let aircond = event.currentTarget.dataset.aircond;
            let fan = event.currentTarget.dataset.fan;

            this.idHabitacionTarget.value = id;

            this.labelModalHabTarget.innerHTML = 'Editar Habitación';
            this.selectPisosTarget.value = piso;
            this.nombreHabitacionTarget.value = name;
            this.numeroCamaTarget.value = bedmunber;
            this.aireAcondicionadoTarget.value = aircond;
            this.ventiladorTarget.value = fan;


        }
        else {

            this.labelModalHabTarget.innerHTML = 'Registrar Nueva Habitación';
            this.selectPisosTarget.value = '';
            this.nombreHabitacionTarget.value = '';
            this.numeroCamaTarget.value = '';
            this.aireAcondicionadoTarget.value = '';
            this.ventiladorTarget.value = '';
        }

        this.modal = new Modal(this.modalNuevaHabitacionTarget);
        this.modal.show();
    }

    validaBtnGuardarHab() {
        let nombreHabitacion = this.nombreHabitacionTarget.value;
        let numeroCama = this.numeroCamaTarget.value;
        let aireAcondicionado = this.aireAcondicionadoTarget.value;
        let ventilador = this.ventiladorTarget.value;
        let selectPisos = this.selectPisosTarget.value;

        if (nombreHabitacion !== '' && numeroCama !== '' && aireAcondicionado !== '' && ventilador !== '' && selectPisos !== '') {
            this.btnGuardarHabTarget.disabled = false;
        }
        else {
            this.btnGuardarHabTarget.disabled = true;
        }
    }

    async guardarHabitacion(event) {
        let urlGuardar = this.rutaNuevaHabitacionValue;
        let ruta = this.rutaHabitacionesValue;

        let formulario = '';

        formulario = this.formNuevaHabTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.modalNuevaHabitacionTarget);

            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Habitación guardada correctamente', 'success');

            const respuesta = await fetch(ruta);
            this.frameHabitacionesTarget.innerHTML = await respuesta.text();
        }

    }

    async eliminarHabitacion(event) {

        let urlEliminar = this.rutaEliminarHabValue.replace('var1', event.currentTarget.dataset.id);
        let ruta = this.rutaHabitacionesValue;

        var consulta = await fetch(urlEliminar);
        var result = await consulta.json();

        if (result.response == 'Ok') {
            FlashMessage.show('Habitación eliminada correctamente', 'danger');
            const respuesta = await fetch(ruta);
            this.frameHabitacionesTarget.innerHTML = await respuesta.text();
        }
    }



}
