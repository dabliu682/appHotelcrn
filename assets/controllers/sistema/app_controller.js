
import { Controller } from "@hotwired/stimulus";
import { Modal } from 'bootstrap';
import FlashMessage from '../../utils/FlashMessage';

// Connects to data-controller="app"
export default class extends Controller {
    static values = {
        'rutaObtenerDatosClienteReserva': String,
        'rutaEliminarCompania': String,
        'rutaEliminarClientes': String,
        'rutaNuevaHabitacion': String,
        'rutaEliminarTipodoc': String,
        'rutaGuardarClientes': String,
        'rutaGuardarTipodoc': String,
        'rutaNuevaCompania': String,
        'rutaGuardarReserva': String,
        'rutaHabitaciones': String,
        'rutaEliminarPiso': String,
        'rutaAbrirTurno': String,
        'rutaEliminarHab': String,
        'rutaDashboard': String,
        'rutaNuevoPiso': String,
        'rutaCompanias': String,
        'rutaReservas': String,
        'rutaClientes': String,
        'rutaVistas': String,
        'rutaPisos': String,
        'rutaDocs': String,
        'rutaGuardarTiposServ': String,
        'rutaTiposServ': String,
        'rutaGuardarServicio': String,
        'rutaListaServ': String,
        'rutaCambiaEstadoServicio': String,
        'rutaEliminarTiposServ': String,
        'rutaEliminarServicio': String,
    };
    static targets = [
        'modalBuscarClienteCheckin',
        'numeroVehiculoClienteRev',
        'numeroVehiculoCliente',
        'selectCompaniaCliente',
        'modalNuevaHabitacion',
        'selectTipoDocCliente',
        'fechaLlegClienteRev',
        'botonesModalCheckin',
        'modalNuevaCompania',
        'modalCompaniaLabel',
        'btnGuardarCompania',
        'horaLlegClienteRev',
        'modalNuevoTipoServ',
        'companiaClienteRev',
        'modalNuevoServicio',
        'modalTipoServLabel',
        'aireAcondicionado',
        'frameHabitaciones',
        'modalNuevoTipoDoc',
        'modalTipoDocLabel',
        'btnGuardarTipoDoc',
        'formNuevaCompania',
        'modalNuevoCliente',
        'modalClienteLabel',
        'modalNuevaReserva',
        'btnGuardarCliente',
        'modalNuevaReserva',
        'modalReservaLabel',
        'cantHabClienteRev',
        'btnGuardarReserva',
        'formNuevoTipoDoc',
        'nombreHabitacion',
        'numeroDocCliente',
        'formNuevoCliente',
        'apellidosCliente',
        'formNuevaReserva',
        'modalBodyCheckin',
        'observacionesRev',
        'numeroCelCliente',
        'btnGuardarPiso',
        'modalNuevoPiso',
        'nombreCompania',
        'frameCompanias',
        'nombresCliente',
        'frameDashboard',
        'nombreTipoDoc',
        'labelModalHab',
        'btnGuardarHab',
        'formNuevoPiso',
        'frameClientes',
        'cellCienteRev',
        'selectAireRev',
        'frameReservas',
        'idHabitacion',
        'formNuevaHab',
        'frameTipoDoc',
        'placaCliente',
        'modalCheckin',
        'selectPisos',
        'nitCompania',
        'framePisos',
        'numeroCama',
        'idCompania',
        'ventilador',
        'nombrePiso',
        'clienteRev',
        'idTipoDoc',
        'idReserva',
        'idCliente',
        'idPiso',
        'btnGuardarTipoServ',
        'formNuevoTipoServ',
        'frameTiposServicios',
        'modalServicioLabel',
        'codigoServ',
        'selectTipoServ',
        'nombreServ',
        'valorServ',
        'btnServicio',
        'formNuevoServicio',
        'btnGuardarServicio',
        'frameListaServicioss',
        'nombreTipoServ',
        'idTipoServ',
        'idServicio',
        'selectTipoHabitacion'
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
        let selectTipoHabitacion = this.selectTipoHabitacionTarget.value;

        if (nombreHabitacion !== '' && numeroCama !== '' && aireAcondicionado !== '' && ventilador !== '' && selectPisos !== '' && selectTipoHabitacion !== '') {
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

    abrirModalNuevotipoDoc(event) {
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


    validaBtnGuardarTipoDoc(event) {
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

        if (result.response == 'Ok') {
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

    validaBtnGuardarCompania() {
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
        else {
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

    validaBtnGuardarCliente(event) {
        let nombres = this.nombresClienteTarget.value;
        let apellidos = this.apellidosClienteTarget.value;
        let numeroDoc = this.numeroDocClienteTarget.value;
        let numeroCel = this.numeroCelClienteTarget.value;
        let selectTipoDoc = this.selectTipoDocClienteTarget.value;

        if (nombres !== '' && apellidos !== '' && numeroDoc !== '' && numeroCel !== '' && selectTipoDoc !== '') {
            this.btnGuardarClienteTarget.disabled = false;
        }
        else {
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
        else {
            FlashMessage.show('No se pudo eliminar el cliente', 'danger');
            const respuesta = await fetch(ruta);
            this.frameClientesTarget.innerHTML = await respuesta.text();
        }
    }

    async abrirTurno(event) {

        let urlAbrirTurno = this.rutaAbrirTurnoValue;
        let ruta = this.rutaDashboardValue;

        var consulta = await fetch(urlAbrirTurno);
        var result = await consulta.json();

        if (result.response == 'Ok') {
            FlashMessage.show('Turno abierto correctamente', 'success');

            const respuesta = await fetch(ruta);
            this.frameDashboardTarget.innerHTML = await respuesta.text();
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

    validaBtnGuardarReserva(event) {
        let fechaLlegada = this.fechaLlegClienteRevTarget.value;
        let horaLlegada = this.horaLlegClienteRevTarget.value;
        let selectAire = this.selectAireRevTarget.value;
        let cantHab = this.cantHabClienteRevTarget.value;
        let cliente = this.clienteRevTarget.value;

        console.log('selectAire: ' + selectAire);

        if (fechaLlegada != '' && horaLlegada != '' && selectAire != '' && cantHab != '' && cliente != '') {
            this.btnGuardarReservaTarget.disabled = false;
        } else {
            this.btnGuardarReservaTarget.disabled = true;
        }
    }

    async guardarReserva(event) {

        this.btnGuardarReservaTarget.disabled = true;

        let urlGuardar = this.rutaGuardarReservaValue;
        let ruta = this.rutaDashboardValue;


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
            this.frameDashboardTarget.innerHTML = await respuesta.text();
        }
    }

    abrirModalCheckin(event) {

        let canthabitaciones = event.currentTarget.dataset.canthabitaciones;
        const clientes = JSON.parse(event.currentTarget.getAttribute('data-clientes'));
        const habitaciones = JSON.parse(event.currentTarget.getAttribute('data-habitaciones'));
        const servicios = JSON.parse(event.currentTarget.getAttribute('data-servicios'));

        // Obtener la fecha actual en formato yyyy-mm-dd
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        const fechaActual = `${yyyy}-${mm}-${dd}`;

        // Obtener la hora actual en formato 12 horas (hh:mm AM/PM)
        let hours = today.getHours();
        let minutes = today.getMinutes();
        let ampm = hours >= 12 ? 'PM' : 'AM';
        let hours12 = hours % 12;
        hours12 = hours12 ? hours12 : 12; // el 0 debe ser 12
        let horaActual12 = `${String(hours12).padStart(2, '0')}:${String(minutes).padStart(2, '0')} ${ampm}`;
        // Para el input type="time" solo se puede poner hh:mm (24h), pero si quieres mostrar el valor en 12h, hay que usar un input type="text" o mostrarlo aparte.
        // Aquí se usará el valor 24h para el input, pero se puede mostrar el valor 12h como placeholder o value en un input type="text" si lo deseas.
        // Si quieres que el input sea type="time" pero muestre la hora actual, usa:
        let horaActual24 = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;

        // Limpiar el contenido del modal y botones antes de renderizar
        this.modalBodyCheckinTarget.innerHTML = '';
        this.botonesModalCheckinTarget.innerHTML = '';

        let target = ``;
        let botones = ``;

        // Generar las opciones de clientes solo una vez
        let clienteOptions = '<option value="">Seleccione cliente</option>';

        clientes.forEach(cliente => {
            clienteOptions += `<option value="${cliente.id}">${cliente.documentNumber} - ${cliente.name} ${cliente.lastname}</option>`;
        });

        // Generar las opciones de habitaciones

        let habitacionOptions = '<option value="">Seleccione habitación</option>';

        habitaciones.forEach(habitacion => {
            habitacionOptions += `<option value="${habitacion.id}">${habitacion.name}</option>`;
        });

        // Generar las opciones de servicios
        let servicioOptions = '<option value="">Seleccione servicio</option>';

        servicios.forEach(servicio => {
            servicioOptions += `<option value="${servicio.id}">${servicio.name}</option>`;
        });


        for (let index = 1; index <= canthabitaciones; index++) {
            let style = (index == 1) ? `display: block;` : `display: none;`;
            const selectId = `clienteSelectCustom-${index}`;
            target += `<div id="checkin-${index}" style="${style}">
                            <form data-sistema--app-target="formCheckin-${index}">
                                <input type="hidden" name="idCheckin" id="numCheckin"  value="${index}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="${selectId}" class="form-label" style="font-weight: bold;">Cliente <i class="fas fa-exclamation-circle text-info" title="Crear cliente" style="" data-action="click->sistema--app#abrirModalNuevoCliente" data-accion="1"></i></label>
                                        <div class="input-group">
                                            <select id="${selectId}" class="form-control" name="clienteRev" data-sistema--app-target="clienteRev" data-action="change->sistema--app#obtenerDatosClienteCheckin" data-index="${index}">
                                                ${clienteOptions}
                                            </select>
                                            <button type="button" class="btn btn-outline-secondary" tabindex="-1" data-action="click->sistema--app#abrirBusquedaClienteModal" data-index = ${index} title="Buscar cliente" style="border: 1px solid #dee2e6;">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="clienteSelect" class="form-label" style="font-weight: bold;">N° reserva</label>
                                        <input type="text" name="fechaLlegClienteRev" class="form-control" id="cellClienteCheckin-${index}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="clienteSelect" class="form-label" style="font-weight: bold;">Celular</label>
                                        <input type="text" name="fechaLlegClienteRev" class="form-control" id="cellClienteCheckin-${index}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="clienteSelect" class="form-label" style="font-weight: bold;">N° Vehiculo</label>
                                        <input type="text" name="fechaLlegClienteRev" class="form-control" id="numeroVehiculoClienteCheckin-${index}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="clienteSelect" class="form-label" style="font-weight: bold;">Placa</label>
                                        <input type="text" name="fechaLlegClienteRev" class="form-control" id="numeroVehiculoClienteCheckin-${index}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label for="clienteSelect" class="form-label" style="font-weight: bold;">Empresa</label>
                                        <input type="text" name="fechaLlegClienteRev" class="form-control" id="companiaClienteCheckin-${index}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="fechaLlegada" class="form-label" style="font-weight: bold;">Fecha llegada</label>
                                        <input type="date" name="fechaLlegClienteRev" class="form-control" value="${fechaActual}" min="">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="horaLlegada" class="form-label" style="font-weight: bold;">Hora llegada</label>
                                        <input type="time" name="horaLlegClienteRev" class="form-control" value="${horaActual24}" min="">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="fechaSalida" class="form-label" style="font-weight: bold;">Fecha salida</label>
                                        <input type="date" name="fechaSalidaClienteRev" class="form-control" value="" min="">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="horaSalida" class="form-label" style="font-weight: bold;">Hora salida</label>
                                        <input type="time" name="horaSalidaClienteRev" class="form-control" value="" min="">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="servicioSelect" class="form-label" style="font-weight: bold;">Servicio
                                            <span class="ms-2">
                                                <input class="form-check-input" type="radio" name="tipoPersonaCheckin-${index}" id="radioMotorista-${index}" value="motorista" checked>
                                                <label class="form-check-label me-2" for="radioMotorista-${index}">Motorista</label>
                                                <input class="form-check-input" type="radio" name="tipoPersonaCheckin-${index}" id="radioTurista-${index}" value="turista">
                                                <label class="form-check-label" for="radioTurista-${index}">Turista</label>
                                            </span>
                                        </label>
                                        <select class="form-control" name="servicioRev" data-sistema--app-target="servicioRev">
                                            ${servicioOptions}
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="valorServicio" class="form-label" style="font-weight: bold;">Valor</label>
                                        <input type="text" name="valorServicio" id="valorServicio" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="habitacionSelect" class="form-label" style="font-weight: bold;">habitación</label>
                                        <select class="form-control" name="habitacionRev" data-sistema--app-target="habitacionRev">
                                             ${habitacionOptions}
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="valorCancelado" class="form-label" style="font-weight: bold;">Valor cancelado</label>
                                        <input type="text" name="valorCanceladoServicio" id="valorCanceladoServicio" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="saldoServicio" class="form-label" style="font-weight: bold;">Saldo</label>
                                        <input type="text" name="saldoServicio" id="saldoServicio" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="formaPago" class="form-label" style="font-weight: bold;">Forma de pago</label>
                                        <select class="form-control" name="formaPagoRev" data-sistema--app-target="formaPagoRev">
                                            <option value="">Seleccione</option>
                                            <option value="efectivo">Efectivo</option>
                                            <option value="bono">Bono</option>
                                            <option value="transaccion">Transaccion</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 d-flex align-items-center">
                                        <div class="w-100">
                                            <label class="form-label mb-1" style="font-weight: bold;">Elementos entregados</label><br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="checkTodos" value="">
                                                        <label class="form-check-label" for="checkToalla">Todos</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="checkToalla" name="Toalla">
                                                        <label class="form-check-label" for="checkToalla">Toalla</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="checkControl" name="control">
                                                        <label class="form-check-label" for="checkControl">Control</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="checkAire" name="aire" value="">
                                                        <label class="form-check-label" for="checkAire">Aire</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="checkCobija" name="cobija" value="">
                                                        <label class="form-check-label" for="checkCobija">Cobija</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="checkLlaves" name="llaves" value="">
                                                        <label class="form-check-label" for="checkLlaves">Llaves</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="observacionesCheckin" class="form-label" style="font-weight: bold;">Observaciones</label> 
                                        <textarea id="observacionesCheckin" name="observacionesCheckin" class="form-control" rows="2" data-sistema--app-target="observacionesCheckin" placeholder="Ingrese sus observaciones aquí"></textarea>
                                    </div>
                                </div>
                            </form>
                    </div>`;

            // Botones para el modal

            if (index == 1) {
                botones += `<button type="button" id="btn-${index}" class="btn btn-warning m-1 text-nowrap" style="width:110px; white-space:nowrap;" disabled data-action="sistema--app#cambiocheckin" data-index = ${index} >check-in ${index}</button>`;
            }
            else {
                botones += `<button type="button" id="btn-${index}" class="btn btn-primary m-1 text-nowrap" style="width:110px; white-space:nowrap;" data-action="sistema--app#cambiocheckin" data-index = ${index} >check-in ${index}</button>`;
            }

        }

        // Insertar el HTML generado
        this.modalBodyCheckinTarget.innerHTML = target;
        this.botonesModalCheckinTarget.innerHTML = botones;

        this.modal = new Modal(this.modalCheckinTarget);
        this.modal.show();
    }

    abrirBusquedaClienteModal(event) {
        const index = event.currentTarget.dataset.index;
        this._busquedaClienteIndex = index; // Guardar el índice actual
        const select = $("#clienteSelectCustom-" + index);
        const input = $("#inputBuscar");
        input.val('');
        input.off('input.sistemaBuscarCliente');
        input.on('input.sistemaBuscarCliente', (e) => this.buscarCliente(e));
        this.modal = new Modal(this.modalBuscarClienteCheckinTarget);
        this.modal.show();
    }

    async buscarCliente(event) {
        let valor = event.currentTarget.value.toLowerCase();
        let index = $("#numCheckin").val();
        let select = $("#clienteSelectCustom-" + index);

        if (!select.length) return;

        if (valor == "") {

            console.log('Valor buscado: ' + valor);
            select.find('option').show();
            select.val(""); // Quitar selección si el input está vacío

            $("#cellClienteCheckin-" + index).val('');
            $("#companiaClienteCheckin-" + index).val('');
            $("#numeroVehiculoClienteCheckin-" + index).val('');
        }
        else {
            let matches = [];

            select.find('option').each(function (i, option) {
                if (i === 0) {
                    $(option).show();
                    return;
                }
                const text = $(option).text().toLowerCase();
                if (text.includes(valor)) {
                    $(option).show();
                    matches.push(option.value);
                } else {
                    $(option).hide();
                }
            });

            select.val(matches[0]);

            console.log('matches: ' + matches);

            let clienteId = matches[0];

            if (clienteId != '') {
                let ruta = this.rutaObtenerDatosClienteReservaValue.replace('var1', clienteId);

                var consulta = await fetch(ruta);
                var result = await consulta.json();

                $("#cellClienteCheckin-" + index).val(result.phone);
                $("#companiaClienteCheckin-" + index).val(result.company);
                $("#numeroVehiculoClienteCheckin-" + index).val(result.numberBus);
            }
        }


    }

    async obtenerDatosClienteCheckin(event) {

        let index = event.currentTarget.dataset.index;

        if (event.currentTarget.value != '') {
            let clienteId = event.currentTarget.value;

            let ruta = this.rutaObtenerDatosClienteReservaValue.replace('var1', clienteId);

            var consulta = await fetch(ruta);
            var result = await consulta.json();

            $("#cellClienteCheckin-" + index).val(result.phone);
            $("#companiaClienteCheckin-" + index).val(result.company);
            $("#numeroVehiculoClienteCheckin-" + index).val(result.numberBus);
        }
        else {
            // Limpiar campos
            $("#cellClienteCheckin-" + index).val('');
            $("#companiaClienteCheckin-" + index).val('');
            $("#numeroVehiculoClienteCheckin-" + index).val('');
            // Mostrar todas las opciones del selector de clientes
            $("#clienteSelectCustom-" + index + " option").show();
        }
    }

    async guardarClienteCheckin() {
        this.btnGuardarClienteTarget.disabled = true;

        let urlGuardar = this.rutaGuardarClientesValue;

        let formulario = '';

        formulario = this.formNuevoClienteTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        if (result.response == 'Ok') {
            const modalInstance = Modal.getInstance(this.modalNuevoClienteTarget);
            if (modalInstance) { modalInstance.hide(); }
            FlashMessage.show('Cliente guardado correctamente', 'success');

            let index = $("#numCheckin").val();
            let select = $("#clienteSelectCustom-" + index);

            // Crear nueva opción y agregarla al selector
            let newOption = new Option(
                result.documentNumber + ' - ' + result.name + ' ' + result.lastname,
                result.id
            );
            select.append(newOption);
            select.val(result.id); // Seleccionar el nuevo cliente

            $("#cellClienteCheckin-" + index).val(result.cellphone);
            $("#companiaClienteCheckin-" + index).val(result.compania);
            $("#numeroVehiculoClienteCheckin-" + index).val(result.numberBus);
        }
    }

    abrirModalNuevTipoServicio(event) {

        if (event.currentTarget.dataset.accion == '2') {
            this.modalTipoServLabelTarget.innerHTML = 'Editar tipo de servicio';
            this.nombreTipoServTarget.value = event.currentTarget.dataset.name;
            this.idTipoServTarget.value = event.currentTarget.dataset.id;
        }
        else {
            this.modalTipoServLabelTarget.innerHTML = 'Nuevo tipo de servicio';
            this.idTipoServTarget.value = '0';
            this.nombreTipoServTarget.value = '';
        }

        this.modal = new Modal(this.modalNuevoTipoServTarget);
        this.modal.show();
    }

    abrirModalNuevoServicio(event) {

        if (event.currentTarget.dataset.accion == '2') {
            this.modalServicioLabelTarget.innerHTML = 'Editar servicio';
            this.codigoServTarget.value = event.currentTarget.dataset.codigo;
            this.selectTipoServTarget.value = event.currentTarget.dataset.tipo;
            this.nombreServTarget.value = event.currentTarget.dataset.name;
            this.valorServTarget.value = event.currentTarget.dataset.price;
            this.idServicioTarget.value = event.currentTarget.dataset.id;
        }
        else {
            this.modalServicioLabelTarget.innerHTML = 'Nuevo servicio';
            this.codigoServTarget.value = '';
            this.selectTipoServTarget.value = '';
            this.nombreServTarget.value = '';
            this.valorServTarget.value = '';
            this.idServicioTarget.value = '0';
        }


        this.modal = new Modal(this.modalNuevoServicioTarget);
        this.modal.show();
    }

    validaBtnGuardarTipoServ(event) {

        if (event.currentTarget.value != '') {
            this.btnGuardarTipoServTarget.disabled = false;
        }
        else {
            this.btnGuardarTipoServTarget.disabled = true;
        }
    }

    async guardarTipoServ(event) {

        this.btnGuardarTipoServTarget.disabled = true;

        let urlGuardar = this.rutaGuardarTiposServValue;
        let ruta = this.rutaTiposServValue;

        let ruta2 = this.rutaListaServValue;
        ruta2 = ruta2.replace('var1', '0');

        let formulario = '';

        formulario = this.formNuevoTipoServTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.modalNuevoTipoServTarget);

            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Tipo de servicio guardado correctamente', 'success');

            const respuesta = await fetch(ruta);
            this.frameTiposServiciosTarget.innerHTML = await respuesta.text();

            const respuesta2 = await fetch(ruta2);
            this.frameListaServiciossTarget.innerHTML = await respuesta2.text();
        }
    }

    async eliminarTipoServicio(event) {

        let boton = event.currentTarget;
        boton.disabled = true;

        let urlEliminar = this.rutaEliminarTiposServValue.replace('var1', event.currentTarget.dataset.id);
        let ruta = this.rutaTiposServValue;

        var consulta = await fetch(urlEliminar);
        var result = await consulta.json();

        if (result.response == 'Ok') {
            FlashMessage.show('Tipo de servicio eliminado correctamente', 'success');
            const respuesta = await fetch(ruta);
            this.frameTiposServiciosTarget.innerHTML = await respuesta.text();
        }
        else {
            FlashMessage.show('No se pude eliminar el tipo de servicio por que ya esta asociado a un servicio', 'danger');
            const respuesta = await fetch(ruta);
            this.frameTiposServiciosTarget.innerHTML = await respuesta.text();
        }
    }

    validaBtnGuardarServicio(event) {

        if (this.codigoServTarget.value != '' && this.selectTipoServTarget.value != '' && this.nombreServTarget.value != '' && this.valorServTarget.value != '') {
            this.btnGuardarServicioTarget.disabled = false;
        }
        else {
            this.btnGuardarServicioTarget.disabled = true;
        }
    }

    async guardarServicio() {
        this.btnGuardarServicioTarget.disabled = true;

        let urlGuardar = this.rutaGuardarServicioValue;
        let ruta = this.rutaListaServValue;
        ruta = ruta.replace('var1', '0');

        let formulario = '';

        formulario = this.formNuevoServicioTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.modalNuevoServicioTarget);

            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Servicio guardado correctamente', 'success');

            const respuesta = await fetch(ruta);
            this.frameListaServiciossTarget.innerHTML = await respuesta.text();
        }
    }

    async filtrarServicios(event) {

        let tipo = event.currentTarget.dataset.tipo;

        let ruta = this.rutaListaServValue;
        ruta = ruta.replace('var1', tipo);

        const respuesta = await fetch(ruta);
        this.frameListaServiciossTarget.innerHTML = await respuesta.text();
    }

    async cambiarEstadoServicio(event) {

        let urlCambiarEstado = this.rutaCambiaEstadoServicioValue.replace('var1', event.currentTarget.dataset.id);
        let estado = (event.currentTarget.checked) ? '1' : '0';
        urlCambiarEstado = urlCambiarEstado.replace('var2', estado);

        let ruta = this.rutaListaServValue;
        ruta = ruta.replace('var1', '0');

        var consulta = await fetch(urlCambiarEstado);
        var result = await consulta.json();

        if (result.response == 'Ok') {
            FlashMessage.show('Estado del servicio actualizado correctamente', 'success');
            const respuesta = await fetch(ruta);
            this.frameListaServiciossTarget.innerHTML = await respuesta.text();
        } else {
            FlashMessage.show('No se pudo actualizar el estado del servicio', 'danger');
            const respuesta = await fetch(ruta);
            this.frameListaServiciossTarget.innerHTML = await respuesta.text();
        }



    }

    async eliminarServicio(event) {
        let boton = event.currentTarget;
        boton.disabled = true;

        let urlEliminar = this.rutaEliminarServicioValue.replace('var1', event.currentTarget.dataset.id);
        let ruta = this.rutaListaServValue;
        ruta = ruta.replace('var1', '0');

        var consulta = await fetch(urlEliminar);
        var result = await consulta.json();

        if (result.response == 'Ok') {
            FlashMessage.show('Servicio eliminado correctamente', 'success');
            const respuesta = await fetch(ruta);
            this.frameListaServiciossTarget.innerHTML = await respuesta.text();
        }
        else {
            FlashMessage.show('No se pudo eliminar el servicio', 'danger');
            const respuesta = await fetch(ruta);
            this.frameListaServiciossTarget.innerHTML = await respuesta.text();
        }
    }

    cambiocheckin(event) {
        let index = event.currentTarget.dataset.index;

        // Ocultar todos los divs de checkin
        let allCheckins = this.modalBodyCheckinTarget.querySelectorAll('[id^="checkin-"]');
        allCheckins.forEach(div => {
            div.style.display = 'none';
        });

        // Mostrar solo el div correspondiente al índice
        let currentCheckin = this.modalBodyCheckinTarget.querySelector(`#checkin-${index}`);
        if (currentCheckin) {
            currentCheckin.style.display = 'block';
        }

        // Deshabilitar el botón actual y habilitar el siguiente
        let botones = this.botonesModalCheckinTarget.querySelectorAll('button');

        botones.forEach(btn => {
            btn.disabled = true;
        });


    }




}
