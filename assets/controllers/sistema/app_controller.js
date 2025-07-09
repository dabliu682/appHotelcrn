
import { Controller } from "@hotwired/stimulus";
import { Modal } from 'bootstrap';
import FlashMessage from '../../utils/FlashMessage';

// Connects to data-controller="app"
export default class extends Controller {
    static values = {
        'rutaEliminarCompania': String,
        'rutaEliminarClientes': String,
        'rutaNuevaHabitacion': String,
        'rutaEliminarTipodoc': String,
        'rutaGuardarClientes': String,
        'rutaGuardarTipodoc': String,
        'rutaNuevaCompania' : String,
        'rutaHabitaciones': String,
        'rutaEliminarPiso': String,
        'rutaEliminarHab': String,
        'rutaNuevoPiso': String,
        'rutaCompanias': String,
        'rutaClientes': String,
        'rutaVistas': String,
        'rutaPisos': String,
        'rutaDocs' : String,
        'rutaAbrirTurno' : String,
        'rutaObtenerDatosClienteReserva' : String,
        'rutaGuardarReserva': String,
        'rutaReservas': String,
    };
    static targets = [
        'numeroVehiculoCliente',
        'selectCompaniaCliente',
        'modalNuevaHabitacion',
        'selectTipoDocCliente',
        'modalNuevaCompania',
        'modalCompaniaLabel',
        'btnGuardarCompania',
        'aireAcondicionado',
        'frameHabitaciones',
        'modalNuevoTipoDoc',
        'modalTipoDocLabel',
        'btnGuardarTipoDoc',
        'formNuevaCompania',    
        'modalNuevoCliente',
        'modalClienteLabel',
        'btnGuardarCliente',
        'formNuevoTipoDoc',
        'nombreHabitacion',
        'numeroDocCliente',
        'formNuevoCliente',
        'apellidosCliente',
        'numeroCelCliente',
        'btnGuardarPiso',
        'modalNuevoPiso',
        'nombreCompania',
        'frameCompanias',
        'nombresCliente',
        'nombreTipoDoc',
        'labelModalHab',
        'btnGuardarHab',
        'formNuevoPiso',
        'frameClientes',
        'idHabitacion',
        'formNuevaHab',
        'frameTipoDoc',
        'placaCliente',
        'selectPisos',
        'nitCompania',
        'framePisos',
        'numeroCama',
        'idCompania',
        'ventilador',
        'nombrePiso',
        'idTipoDoc',
        'idCliente',
        'idPiso',
        'modalNuevaReserva',
        'cellCienteRev',
        'numeroVehiculoClienteRev',
        'companiaClienteRev',
        'modalNuevaReserva',
        'modalReservaLabel',
        'idReserva',
        'clienteRev',
        'fechaLlegClienteRev',
        'horaLlegClienteRev',
        'selectAireRev',
        'cantHabClienteRev',
        'observacionesRev',
        'btnGuardarReserva',
        'formNuevaReserva',
        'frameReservas'
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
        let urlGuardar = this.rutaNuevaCompaniaValue;
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

    abrirModalNuevotipoDoc(event)
    {
        let accion = event.currentTarget.dataset.accion;

        if (accion == '2') {
            let id = event.currentTarget.dataset.id;
            let name = event.currentTarget.dataset.name;

            this.idTipoDocTarget.value = id;
            this.nombreTipoDocTarget.value = name;

            this.modalTipoDocLabelTarget.innerHTML = 'Editar Tipo de Documento';
        }
        else {

            this.modalTipoDocLabelTarget.innerHTML = 'Registrar Nuevo Tipo de Documento';
            this.idTipoDocTarget.value = '0';
            this.nombreTipoDocTarget.value = '';
        }

        this.modal = new Modal(this.modalNuevoTipoDocTarget);
        this.modal.show();
    }


    validaBtnGuardarTipoDoc(event)
    {
        let valor = event.currentTarget.value;

        if (valor !== '') {
            this.btnGuardarTipoDocTarget.disabled = false;
        }
        else {
            this.btnGuardarTipoDocTarget.disabled = true;
        }
    }

    async guardarTipoDoc(event) {

        let urlGuardar = this.rutaGuardarTipodocValue;
        let ruta = this.rutaDocsValue;

        let formulario = '';

        formulario = this.formNuevoTipoDocTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.modalNuevoTipoDocTarget);

            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Tipo de documento guardado correctamente', 'success');

            const respuesta = await fetch(ruta);
            this.frameTipoDocTarget.innerHTML = await respuesta.text();
        }
    }   

    async eliminarTipoDoc(event) {

        let urlEliminar = this.rutaEliminarTipodocValue.replace('var1', event.currentTarget.dataset.id);
        let ruta = this.rutaDocsValue;

        var consulta = await fetch(urlEliminar);
        var result = await consulta.json();

        if (result.response == 'Ok') 
        {
            FlashMessage.show('Tipo de documento eliminado correctamente', 'danger');
            const respuesta = await fetch(ruta);
            this.frameTipoDocTarget.innerHTML = await respuesta.text();
        }
    }

    abrirModalNuevaCompania(event) {

        let accion = event.currentTarget.dataset.accion;

        if (accion == '2') {

            this.modalCompaniaLabelTarget.innerHTML = 'Editar compañia';

            let id = event.currentTarget.dataset.id;
            let name = event.currentTarget.dataset.name;
            let nit = event.currentTarget.dataset.nit;

            this.idCompaniaTarget.value = id;
            this.nombreCompaniaTarget.value = name;
            this.nitCompaniaTarget.value = nit;

        }
        else {
            
            this.modalCompaniaLabelTarget.innerHTML = 'Nueva compañia';

            this.idCompaniaTarget.value = '0';
            this.nombreCompaniaTarget.value = '';
            this.nitCompaniaTarget.value = '';
        }

        this.modal = new Modal(this.modalNuevaCompaniaTarget);
        this.modal.show();
    }

    validaBtnGuardarCompania()
    {
        let nombreCompania = this.nombreCompaniaTarget.value;
        let nitCompania = this.nitCompaniaTarget.value;

        if (nombreCompania !== '' && nitCompania !== '') {
            this.btnGuardarCompaniaTarget.disabled = false;
        }
        else {
            this.btnGuardarCompaniaTarget.disabled = true;
        }
    }

    async guardarCompania(event) {

        this.btnGuardarCompaniaTarget.disabled = true;

        let urlGuardar = this.rutaNuevaCompaniaValue;
        let ruta = this.rutaCompaniasValue;

        let formulario = '';

        formulario = this.formNuevaCompaniaTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.modalNuevaCompaniaTarget);

            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Compañia guardada correctamente', 'success');

            const respuesta = await fetch(ruta);
            this.frameCompaniasTarget.innerHTML = await respuesta.text();
        }

        
    }

    async eliminarCompania(event) {

        let boton = event.currentTarget;
        boton.disabled = true;

        let urlEliminar = this.rutaEliminarCompaniaValue.replace('var1', event.currentTarget.dataset.id);
        let ruta = this.rutaCompaniasValue;

        var consulta = await fetch(urlEliminar);
        var result = await consulta.json();

        if (result.response == 'Ok') {
            FlashMessage.show('Compañia eliminada correctamente', 'success');
            const respuesta = await fetch(ruta);
            this.frameCompaniasTarget.innerHTML = await respuesta.text();
        }
        else
        {
            FlashMessage.show('No se pudo eliminar la compañia', 'danger');
            const respuesta = await fetch(ruta);
            this.frameCompaniasTarget.innerHTML = await respuesta.text();
        }
    }

    abrirModalNuevoCliente(event) {

        let accion = event.currentTarget.dataset.accion;

        if (accion == '2') {

            this.modalClienteLabelTarget.innerHTML = 'Editar Cliente';

            let id = event.currentTarget.dataset.id;
            let documento = event.currentTarget.dataset.documento;
            let numerodoc = event.currentTarget.dataset.numerodoc;
            let nombres = event.currentTarget.dataset.nombres;
            let apellidos = event.currentTarget.dataset.apellidos;
            let celular = event.currentTarget.dataset.celular;
            let placa = event.currentTarget.dataset.placa;
            let numberbus = event.currentTarget.dataset.numberbus;
            let compania = event.currentTarget.dataset.compania;
            
            this.idClienteTarget.value = id;
            this.nombresClienteTarget.value = nombres;
            this.apellidosClienteTarget.value = apellidos;
            this.selectTipoDocClienteTarget.value = documento;
            this.numeroDocClienteTarget.value = numerodoc;
            this.numeroCelClienteTarget.value = celular;
            this.numeroVehiculoClienteTarget.value = numberbus;
            this.placaClienteTarget.value = placa;
            this.selectCompaniaClienteTarget.value = compania;

        }
        else {

            this.modalClienteLabelTarget.innerHTML = 'Registrar Nuevo Cliente';
            
            this.idClienteTarget.value = '0';
            this.nombresClienteTarget.value = '';
            this.apellidosClienteTarget.value = '';
            this.selectTipoDocClienteTarget.value = '';
            this.numeroDocClienteTarget.value = '';
            this.numeroCelClienteTarget.value = '';
            this.numeroVehiculoClienteTarget.value = '';
            this.placaClienteTarget.value = '';
            this.selectCompaniaClienteTarget.value = '';

        }         

        this.modal = new Modal(this.modalNuevoClienteTarget);
        this.modal.show();
    }

    validaBtnGuardarCliente(event) 
    {
        let nombres = this.nombresClienteTarget.value;
        let apellidos = this.apellidosClienteTarget.value;
        let numeroDoc = this.numeroDocClienteTarget.value;
        let numeroCel = this.numeroCelClienteTarget.value;
        let selectTipoDoc = this.selectTipoDocClienteTarget.value;

        if (nombres !== '' && apellidos !== '' && numeroDoc !== '' && numeroCel !== '' && selectTipoDoc !== '') 
        {
            this.btnGuardarClienteTarget.disabled = false;
        }
        else 
        {
            this.btnGuardarClienteTarget.disabled = true;
        }
    }

    async guardarCliente(event) {

        this.btnGuardarClienteTarget.disabled = true;

        let urlGuardar = this.rutaGuardarClientesValue;
        let ruta = this.rutaClientesValue;

        let formulario = '';

        formulario = this.formNuevoClienteTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.modalNuevoClienteTarget);

            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Cliente guardado correctamente', 'success');

            const respuesta = await fetch(ruta);
            this.frameClientesTarget.innerHTML = await respuesta.text();
        }
    }

    async eliminarCliente(event) {

        let boton = event.currentTarget;
        boton.disabled = true;

        let urlEliminar = this.rutaEliminarClientesValue.replace('var1', event.currentTarget.dataset.id);
        let ruta = this.rutaClientesValue;

        var consulta = await fetch(urlEliminar);
        var result = await consulta.json();

        if (result.response == 'Ok') {
            FlashMessage.show('Cliente eliminado correctamente', 'success');
            const respuesta = await fetch(ruta);
            this.frameClientesTarget.innerHTML = await respuesta.text();
        }
        else
        {
            FlashMessage.show('No se pudo eliminar el cliente', 'danger');
            const respuesta = await fetch(ruta);
            this.frameClientesTarget.innerHTML = await respuesta.text();
        }
    }

    async abrirTurno(event) {

        let urlAbrirTurno = this.rutaAbrirTurnoValue;

        var consulta = await fetch(urlAbrirTurno);
        var result = await consulta.json();

        if (result.response == 'Ok') 
        {
            FlashMessage.show('Turno abierto correctamente', 'success');
        }
    }

    abrirModalNuevaReserva(event) {
        let accion = event.currentTarget.dataset.accion;
        //$('.selectpicker').selectpicker('refresh');

        if (accion == '2') {
            this.modalReservaLabelTarget.innerHTML = 'Editar Reserva';
            // Aquí puedes agregar la lógica para cargar los datos de la reserva si es necesario
        } else {
            this.modalReservaLabelTarget.innerHTML = 'Registrar Nueva Reserva';
            // Aquí puedes limpiar los campos del formulario si es necesario
        }

        this.modal = new Modal(this.modalNuevaReservaTarget);
        this.modal.show();
    }

    async obtenerDatosClienteReserva(event) {
        let clienteId = event.currentTarget.value;

        let ruta = this.rutaObtenerDatosClienteReservaValue.replace('var1', clienteId);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        this.cellCienteRevTarget.value = result.phone;
        this.numeroVehiculoClienteRevTarget.value = result.numberBus;
        this.companiaClienteRevTarget.value = result.company;       
    }

    validaBtnGuardarReserva(event) 
    {
        let fechaLlegada = this.fechaLlegClienteRevTarget.value;
        let horaLlegada = this.horaLlegClienteRevTarget.value;
        let selectAire = this.selectAireRevTarget.value;
        let cantHab = this.cantHabClienteRevTarget.value;
        let cliente = this.clienteRevTarget.value;

        console.log('selectAire: '+selectAire);

        if (fechaLlegada != '' && horaLlegada != '' && selectAire != '' && cantHab != '' && cliente != '') 
        {
            this.btnGuardarReservaTarget.disabled = false;
        } else 
        {
            this.btnGuardarReservaTarget.disabled = true;
        }
    }

    async guardarReserva(event) {

        this.btnGuardarReservaTarget.disabled = true;

        let urlGuardar = this.rutaGuardarReservaValue;
        let ruta = this.rutaReservasValue;

        let formulario = '';

        formulario = this.formNuevaReservaTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.modalNuevaReservaTarget);

            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Reserva guardada correctamente', 'success');

            const respuesta = await fetch(ruta);
            this.frameReservasTarget.innerHTML = await respuesta.text();
        }
    }



}
