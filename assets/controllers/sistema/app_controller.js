
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
        'rutaObtenerServicio': String,
        'rutaGuardarProducto': String,
        'rutaProductos': String,
        'rutaEntradas': String,
        'rutaGuardarEntrada': String,
        'rutaCargarProductosPlano': String,
        'rutaInventario': String,
        'rutaCrearCheckin': String,
        'rutaEliminarReserva': String,
        'rutaObtenerProducto': String,
        'rutaUpdateCantProducto': String,
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
        'selectTipoHabitacion',
        'modalNuevoServicioCheckin',
        'selectServ',
        'selectHabitacionServ',
        'valorServCheckin',
        'valorPagServCheckin',
        'saldoServCheckin',
        'selectFormaPagoCheckin',
        'comprobanteCheckin',
        'btnGuardarServicioCheckin',
        'modalNuevoProducto',
        'modalProductoLabel',
        'formNuevoProducto',
        'codigoProducto',
        'tipoProducto',
        'nombreProducto',
        'btnGuardarProducto',
        'frameProductos',
        'modalNuevaEntrada',
        'modalEntradaLabel',
        'codigoProducto',
        'cantidadProducto',
        'valorProducto',
        'porcProducto',
        'valEntProducto',
        'valSalProducto',
        'valVentaProducto',
        'utilidad',
        'btnGuardarEntrada',
        'frameEntradas',
        'formNuevaEntrada',
        'modalCargarProductos',
        'btnCargarProductos',
        'formCargarProductos',
        'planoProductos',
        'codigoProd',
        'frameInventario',
        'modalNuevoProductoCheckin',
        'selectProductoCheckin',
        'valorProductorCheckin',
        'cantProductoCheckin',
        'valorPagoProductoCheckin',
        'saldoProductoCheckin',
        'selectFormaPagoProductoCheckin',
        'comprobanteProductoCheckin',
        'btnGuardarProductoCheckin'
    ];

    connect() {
        // Código que se ejecuta al conectar el controlador
        console.log("AppController conectado");
    }

    formatearCampo(event) {
        new Cleave(event.currentTarget, { numeral: true, numeralPositiveOnly: true, numeralDecimalScale: 3, numeralDecimalMark: ',', delimiter: '.' });
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

    async crearCheckin(event) {

        let ruta = this.rutaDashboardValue;

        let urlGuardar = this.rutaCrearCheckinValue;

        let idReserva = event.currentTarget.dataset.id;

        urlGuardar = urlGuardar.replace('var1', idReserva);

        var consulta = await fetch(urlGuardar);
        var result = await consulta.json();

        if (result.response == 'Ok') {

            FlashMessage.show('Reserva editada correctamente', 'success');

            const respuesta = await fetch(ruta);
            this.frameDashboardTarget.innerHTML = await respuesta.text();
        }
    }

    async eliminarReserva(event) {
        let ruta = this.rutaDashboardValue;

        let urlEliminar = this.rutaEliminarReservaValue;

        let idReserva = event.currentTarget.dataset.id;

        urlEliminar = urlEliminar.replace('var1', idReserva);

        var consulta = await fetch(urlEliminar);
        var result = await consulta.json();

        if (result.response == 'Ok') {

            FlashMessage.show('Reserva cancelada correctamente', 'success');

            const respuesta = await fetch(ruta);
            this.frameDashboardTarget.innerHTML = await respuesta.text();
        }
    }

    abrirModalCheckin(event) {

        localStorage.clear();

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

        $("#fechaLlegada-1").val(fechaActual);
        $("#horallegada-1").val(horaActual24);

        // Limpiar el contenido del modal y botones antes de renderizar
        //this.modalBodyCheckinTarget.innerHTML = '';
        //this.botonesModalCheckinTarget.innerHTML = '';

        /*let target = ``;
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
            target += ``;

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
        this.botonesModalCheckinTarget.innerHTML = botones;*/

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
        let select = $("#clienteSelectCustom-1");

        if (!select.length) return;

        if (valor == "") {
            select.find('option').show();
            select.val(""); // Quitar selección si el input está vacío

            $("#cellClienteCheckin-1").val('');
            $("#companiaClienteCheckin-1").val('');
            $("#numeroVehiculoClienteCheckin-1").val('');
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

            if (clienteId != '' && clienteId != undefined) {

                let ruta = this.rutaObtenerDatosClienteReservaValue.replace('var1', clienteId);

                var consulta = await fetch(ruta);
                var result = await consulta.json();

                $("#cellClienteCheckin-1").val(result.phone);
                $("#companiaClienteCheckin-1").val(result.company);
                $("#numeroVehiculoClienteCheckin-1").val(result.numberBus);
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

    abrirModalServicioCheckin() {
        this.modal = new Modal(this.modalNuevoServicioCheckinTarget);
        this.modal.show();
    }

    async cargarServicioCheckin(event) {

        let index = $("#numCheckin").val();

        let ruta = this.rutaObtenerServicioValue.replace('var1', event.currentTarget.value);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        let habitaciones = result.habitacionesSelector;

        let selectHabitacion = this.selectHabitacionServTarget;

        selectHabitacion.innerHTML = ''; // Limpiar opciones existentes
        this.valorServCheckinTarget.value = '';
        this.valorPagServCheckinTarget.value = '';
        this.saldoServCheckinTarget.value = '';

        selectHabitacion.innerHTML = '<option value="">Seleccione habitación</option>'; // Agregar opción por defecto

        habitaciones.forEach(habitacion => {
            let option = document.createElement('option');
            option.value = habitacion.id;
            option.textContent = habitacion.name;
            selectHabitacion.appendChild(option);
        });

        this.valorServCheckinTarget.value = Number(result.price).toLocaleString('es-CO');
        this.valorPagServCheckinTarget.value = Number(result.price).toLocaleString('es-CO');
        this.saldoServCheckinTarget.value = 0;

        let fecha = $("#fechaLlegada-" + index).val();
        let hora = $("#horallegada-" + index).val();
        let diferencia = result.horas;

        this.calcularFechaSalida(fecha, hora, diferencia, index);

    }

    calcularFechaSalida(fecha, hora, diferencia, index) {
        // Crear objeto Date con fecha y hora combinadas
        let fechaHora = new Date(`${fecha}T${hora}:00`);

        // Sumar 18 horas (en milisegundos)
        fechaHora.setHours(fechaHora.getHours() + diferencia);

        // Obtener fecha y hora formateadas
        let fechasalida = fechaHora.toISOString().slice(0, 10);            // YYYY-MM-DD
        let horasalida = fechaHora.toTimeString().slice(0, 5);             // HH:mm

        $("#fechaSalida-" + index).val(fechasalida);
        $("#horaSalida-" + index).val(horasalida);

    }

    marcarElementos(event) {
        let index = event.currentTarget.dataset.index;

        let padre = event.currentTarget;

        let elementos = document.querySelectorAll('.check-' + index);

        elementos.forEach(function (elemento) {
            if (padre.checked) {
                elemento.checked = true;
            }
            else {
                elemento.checked = false;
            }

        });
    }

    abrirModalProductosCheckin() {
        this.modal = new Modal(this.modalNuevoProductoCheckinTarget);
        this.modal.show();
    }

    async cargarProductoCheckin(event) {

        let ruta = this.rutaObtenerProductoValue.replace('var1', event.currentTarget.value);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        this.valorProductorCheckinTarget.value = result.valor.toLocaleString('es-CO');
        $("#cantProd").val(result.existencias);
        $("#valPro").val(result.valor);
    }

    calculaValorProductos(event) {
        let cantidad = Number(event.currentTarget.value);
        let cantProd = $("#cantProd").val();

        if (cantidad <= cantProd) {
            let valor = Number($("#valPro").val());
            let total = cantidad * valor;

            this.valorPagoProductoCheckinTarget.value = total.toLocaleString('es-CO');
            this.saldoProductoCheckinTarget.value = 0;
        }
        else {
            FlashMessage.show('Existencias: ' + cantProd, 'danger');
            this.valorPagoProductoCheckinTarget.value = '';
            this.saldoProductoCheckinTarget.value = '';
            this.cantProductoCheckinTarget.value = '';
        }

    }

    actualizaSaldoProdCheckin(event) {
        if (this.valorPagoProductoCheckinTarget.value != '' && this.cantProductoCheckinTarget.value != '' && this.valorProductorCheckinTarget.value != '') {
            let valor = Number(event.currentTarget.value.replace(/[.,]/g, ''));
            let cant = this.cantProductoCheckinTarget.value;
            let valorUnd = Number($("#valPro").val());

            let valorT = cant * valorUnd;

            let total = valorT - valor;

            this.saldoProductoCheckinTarget.value = total.toLocaleString('es-CO');

        }
    }

    validaBtnGuardarProdeuctoCheckin() {
        if (this.selectProductoCheckinTarget.value != '' && this.valorProductorCheckinTarget.value != '' && this.cantProductoCheckinTarget.value != '' && this.valorPagoProductoCheckinTarget.value != '' && this.saldoProductoCheckinTarget.value != '' && this.selectFormaPagoProductoCheckinTarget.value) {
            if (this.selectFormaPagoProductoCheckinTarget.value == 2) {
                if (this.comprobanteProductoCheckinTarget.value != '') {
                    this.btnGuardarProductoCheckinTarget.disabled = false;
                }
                else {
                    this.btnGuardarProductoCheckinTarget.disabled = true;
                }
            }
            else {
                this.btnGuardarProductoCheckinTarget.disabled = false;
            }
        }
        else {
            this.btnGuardarProductoCheckinTarget.disabled = true;
        }
    }

    actualizarComprobanteProducto(event) {
        let valor = this.selectFormaPagoProductoCheckinTarget.value;

        if (valor == '2') {
            this.comprobanteProductoCheckinTarget.disabled = false;
            this.comprobanteProductoCheckinTarget.value = '';
        }
        else {
            this.comprobanteProductoCheckinTarget.disabled = true;
            this.comprobanteProductoCheckinTarget.value = '';
        }
    }

    async guardarProductosCheckin() {
        let selectProducto = this.selectProductoCheckinTarget.value
        let cantProducto = this.cantProductoCheckinTarget.value

        /*
        ** Actualizar las cantidades del producto
        */

        let rutaUpdateProd = this.rutaUpdateCantProductoValue;
        rutaUpdateProd = rutaUpdateProd.replace('var1', selectProducto);
        rutaUpdateProd = rutaUpdateProd.replace('var2', 1);
        rutaUpdateProd = rutaUpdateProd.replace('var3', cantProducto);

        await fetch(rutaUpdateProd);

        let valorServicio = Number(this.valorProductorCheckinTarget.value.replace(/[.,]/g, '')) * cantProducto;
        let valorProductor = this.valorProductorCheckinTarget.value
        let valorPagoProducto = this.valorPagoProductoCheckinTarget.value
        let saldoProducto = this.saldoProductoCheckinTarget.value
        let selectFormaPagoProducto = this.selectFormaPagoProductoCheckinTarget.value
        let comprobanteProducto = this.comprobanteProductoCheckinTarget.value
        let productoText = this.selectProductoCheckinTarget.options[this.selectProductoCheckinTarget.selectedIndex].text;
        let formaPagoText = this.selectFormaPagoProductoCheckinTarget.options[this.selectFormaPagoProductoCheckinTarget.selectedIndex].text;

        // Crear un array con los datos del producto actual
        let nuevoProducto = [
            productoText,
            formaPagoText,
            selectProducto,
            valorProductor,
            cantProducto,
            valorPagoProducto,
            saldoProducto,
            selectFormaPagoProducto,
            comprobanteProducto,
            valorServicio
        ];

        // Acumular servicios en el array, agregando el nuevo al inicio
        let key = 'productoCheckin';
        let productosArray = [];
        let productosGuardados = localStorage.getItem(key);
        if (productosGuardados) {
            try {
                productosArray = JSON.parse(productosGuardados);
                if (!Array.isArray(productosArray)) {
                    productosArray = [];
                }
            } catch (e) {
                productosArray = [];
            }
        }

        productosArray.push(nuevoProducto);
        localStorage.setItem(key, JSON.stringify(productosArray));

        // Limpiar los campos del formulario
        this.selectProductoCheckinTarget.value = '';
        this.valorProductorCheckinTarget.value = '';
        this.cantProductoCheckinTarget.value = '';
        this.valorPagoProductoCheckinTarget.value = '';
        this.saldoProductoCheckinTarget.value = '';
        this.selectFormaPagoProductoCheckinTarget.value = '';
        this.comprobanteProductoCheckinTarget.value = '';
        this.btnGuardarProductoCheckinTarget.disabled = true;

        FlashMessage.show('Servicio agregado correctamente', 'success');

        // Actualizar la tabla de servicios en el modal
        this.actualizarTablaProductodCheckin();
    }

    async eliminarProductoCheckin(event) {

        const idProducto = event.currentTarget.dataset.id;
        const cantidad = event.currentTarget.dataset.cantidad;
        const productoIndex = event.currentTarget.dataset.index;
        const valorpag = event.currentTarget.dataset.valorpag;

        /*
        ** Actualizar las cantidades del producto
        */

        let rutaUpdateProd = this.rutaUpdateCantProductoValue;
        rutaUpdateProd = rutaUpdateProd.replace('var1', idProducto);
        rutaUpdateProd = rutaUpdateProd.replace('var2', 2);
        rutaUpdateProd = rutaUpdateProd.replace('var3', cantidad);

        await fetch(rutaUpdateProd);


        let key = 'productoCheckin';
        let productosArray = [];
        let productosGuardados = localStorage.getItem(key);
        if (productosGuardados) {
            try {
                productosArray = JSON.parse(productosGuardados);
                if (!Array.isArray(productosArray)) {
                    productosArray = [];
                }
            } catch (e) {
                productosArray = [];
            }
        }
        // Eliminar el servicio por índice
        productosArray.splice(productoIndex, 1);

        localStorage.setItem(key, JSON.stringify(productosArray));
        // Actualizar la tabla
        this.actualizarTablaProductodCheckin();
    }

    actualizarTablaProductodCheckin() {
        let key = 'productoCheckin';
        let productosArray = [];
        let productosGuardados = localStorage.getItem(key);
        if (productosGuardados) {
            try {
                productosArray = JSON.parse(productosGuardados);
                if (!Array.isArray(productosArray)) {
                    productosArray = [];
                }
            } catch (e) {
                productosArray = [];
            }
        }
        let tbody = this.modalBodyCheckinTarget.querySelector(`#productosCheckin-1`);
        tbody.innerHTML = ''; // Limpiar el contenido actual
        let totalPagado = 0;
        let totalSaldo = 0;
        if (productosArray.length > 0) {
            productosArray.forEach((producto, i) => {
                totalPagado += Number(producto[5].replace(/[.,]/g, ''));
                totalSaldo += Number(producto[6].replace(/[.,]/g, ''));
                let tr = document.createElement('tr');
                const valorServicio = Number(producto[9]).toLocaleString('es-CO');
                const valorPagado = Number(producto[5].replace(/[.,]/g, '')).toLocaleString('es-CO');
                tr.innerHTML = `
                    <td>
                        <i class="fas fa-trash-alt text-danger" title="Eliminar" data-index="${i}" data-id = "${producto[2]}" data-cantidad = "${producto[4]}" data-valorpag = "${producto[5].replace(/[.,]/g, '')}" data-action="click->sistema--app#eliminarProductoCheckin"></i>
                    </td>
                    <td class="text-nowrap">
                        ${producto[0]}
                    </td>
                    <td class="text-nowrap">${producto[1]}</td>
                    <td class="text-nowrap"  style="text-align:right;">${producto[4]}</td>
                    <td class="text-nowrap"  style="text-align:right;">$ ${producto[3]}</td>
                    <td class="text-nowrap" style="text-align:right;">$ ${valorServicio}</td>
                    <td class="text-nowrap" style="text-align:right;">$ ${valorPagado}</td>
                `;
                tbody.appendChild(tr);
            });

        } else {
            tbody.innerHTML = '<tr><td colspan="7" style="text-align:center">No se han registrado servicios</td></tr>';
        }

        this.actualizarTotalPago();
    }

    actualizarTotalPago() {
        let totalPagado = 0;

        let serviciosGuardados = localStorage.getItem('servicioCheckin1');

        let serviciosArray = [];

        if (serviciosGuardados) {
            try {
                serviciosArray = JSON.parse(serviciosGuardados);
                if (!Array.isArray(serviciosArray)) {
                    serviciosArray = [];
                }
            } catch (e) {
                serviciosArray = [];
            }
        }

        if (serviciosArray.length > 0) {
            serviciosArray.forEach((producto, i) => {
                totalPagado += Number(producto[5].replace(/[.,]/g, ''));
            });
        }

        // Productos
        let productosGuardados = localStorage.getItem('productoCheckin');

        let productosArray = [];

        if (productosGuardados) {
            try {
                productosArray = JSON.parse(productosGuardados);
                if (!Array.isArray(productosArray)) {
                    productosArray = [];
                }
            } catch (e) {
                productosArray = [];
            }
        }

        if (productosArray.length > 0) {
            productosArray.forEach((producto, i) => {
                totalPagado += Number(producto[5].replace(/[.,]/g, ''));
            });
        }

        // Actualizar el span con el total pagado
        const totalSpan = document.getElementById("totalPagar-1");
        if (totalSpan) {
            totalSpan.textContent = "$ " + totalPagado.toLocaleString('es-CO');
        }
    }

    marcarElemento(event) {
        let index = event.currentTarget.dataset.index;

        let elementos = document.querySelectorAll('.check-' + index);

        let marcados = 0;
        let desmarcados = 0;

        elementos.forEach(function (elemento) {
            if (elemento.checked) {
                marcados++;
            }
            else {
                desmarcados++;
            }
        });

        if (desmarcados > 0) {
            $("#checkTodos-" + index).prop('checked', false);
        }
        else {
            $("#checkTodos-" + index).prop('checked', true);
        }
    }

    actualizaSaldoCheckin(event) {
        let valor = this.valorServCheckinTarget.value;
        let valorPagado = this.valorPagServCheckinTarget.value;

        let saldo = Number(valor.replace(/[.,]/g, '')) - Number(valorPagado.replace(/[.,]/g, ''));
        this.saldoServCheckinTarget.value = saldo.toLocaleString('es-CO');
    }

    actualizarComprobante(event) {

        let valor = this.selectFormaPagoCheckinTarget.value;

        if (valor == '2') {
            this.comprobanteCheckinTarget.disabled = false;
            this.comprobanteCheckinTarget.value = '';
        }
        else {
            this.comprobanteCheckinTarget.disabled = true;
            this.comprobanteCheckinTarget.value = '';
        }
    }

    validaBtnGuardarServicioCheckin() {

        let valida = true

        let selectHabitacionServ = this.selectHabitacionServTarget;

        // Validar si el selector tiene más de 2 opciones (incluyendo la opción por defecto)
        if (selectHabitacionServ.options.length > 2) {
            if (selectHabitacionServ.value == '') {
                valida = false;
            }
        }

        if (this.selectFormaPagoCheckinTarget.value == '' || (this.selectFormaPagoCheckinTarget.value == '2' && this.comprobanteCheckinTarget.value == '')) {
            valida = false;
        }

        if (this.selectServTarget.value == '' || this.valorServCheckinTarget.value == '' || this.valorPagServCheckinTarget.value == '' || this.saldoServCheckinTarget.value == '') {
            valida = false;
        }

        if (valida) {
            this.btnGuardarServicioCheckinTarget.disabled = false;
        }
        else {
            this.btnGuardarServicioCheckinTarget.disabled = true;
        }


    }

    guardarServicioCheckin() {

        let index = $("#numCheckin").val();
        let selectServ = this.selectServTarget.value;
        let selectServText = '';

        if (this.selectServTarget.selectedIndex > -1) {
            selectServText = this.selectServTarget.options[this.selectServTarget.selectedIndex].text;
            //selectServText = selectServText.split(' - ')[0]; // Extraer solo el codigo del servicio
        }

        let selectHabText = '';

        if (this.selectHabitacionServTarget.value != '') {
            selectHabText = this.selectHabitacionServTarget.options[this.selectHabitacionServTarget.selectedIndex].text;
            selectHabText = selectHabText.split(' - ')[0]; // Extraer solo el codigo de la habitacion
        }

        let selectFomaPagoText = '';

        if (this.selectFormaPagoCheckinTarget.selectedIndex > -1) {
            selectFomaPagoText = this.selectFormaPagoCheckinTarget.options[this.selectFormaPagoCheckinTarget.selectedIndex].text;
        }

        let selectHabitacionServ = this.selectHabitacionServTarget.value;
        let valorServCheckin = this.valorServCheckinTarget.value;
        let valorPagServCheckin = this.valorPagServCheckinTarget.value;
        let saldoServCheckin = this.saldoServCheckinTarget.value;
        let selectFormaPagoCheckin = this.selectFormaPagoCheckinTarget.value;
        let comprobanteCheckin = this.comprobanteCheckinTarget.value;

        // Crear un array con los datos del servicio actual
        let nuevoServicio = [
            selectServText,
            selectHabText,
            selectFomaPagoText,
            comprobanteCheckin,
            valorServCheckin,
            valorPagServCheckin,
            saldoServCheckin,
            selectServ,
            selectHabitacionServ,
            selectFormaPagoCheckin,
        ];

        // Acumular servicios en el array, agregando el nuevo al inicio
        let key = 'servicioCheckin' + index;
        let serviciosArray = [];
        let serviciosGuardados = localStorage.getItem(key);
        if (serviciosGuardados) {
            try {
                serviciosArray = JSON.parse(serviciosGuardados);
                if (!Array.isArray(serviciosArray)) {
                    serviciosArray = [];
                }
            } catch (e) {
                serviciosArray = [];
            }
        }
        serviciosArray.unshift(nuevoServicio);
        localStorage.setItem(key, JSON.stringify(serviciosArray));

        // Limpiar los campos del formulario
        this.selectServTarget.value = '';
        this.selectHabitacionServTarget.value = '';
        this.valorServCheckinTarget.value = '';
        this.valorPagServCheckinTarget.value = '';
        this.saldoServCheckinTarget.value = '';
        this.selectFormaPagoCheckinTarget.value = '';
        this.comprobanteCheckinTarget.value = '';
        this.comprobanteCheckinTarget.disabled = true;
        this.btnGuardarServicioCheckinTarget.disabled = true;

        FlashMessage.show('Servicio agregado correctamente', 'success');

        // Actualizar la tabla de servicios en el modal
        this.actualizarTablaServiciosCheckin();


    }

    actualizarTablaServiciosCheckin() {
        let key = 'servicioCheckin1';
        let serviciosArray = [];
        let serviciosGuardados = localStorage.getItem(key);
        if (serviciosGuardados) {
            try {
                serviciosArray = JSON.parse(serviciosGuardados);
                if (!Array.isArray(serviciosArray)) {
                    serviciosArray = [];
                }
            } catch (e) {
                serviciosArray = [];
            }
        }
        let tbody = this.modalBodyCheckinTarget.querySelector(`#serviciosCheckin-1`);
        tbody.innerHTML = ''; // Limpiar el contenido actual
        let totalPagado = 0;
        let totalSaldo = 0;
        if (serviciosArray.length > 0) {
            serviciosArray.forEach((servicio, i) => {
                totalPagado += Number(servicio[5].replace(/[.,]/g, ''));
                totalSaldo += Number(servicio[6].replace(/[.,]/g, ''));
                let tr = document.createElement('tr');
                const valorServicio = Number(servicio[4].replace(/[.,]/g, '')).toLocaleString('es-CO');
                const valorPagado = Number(servicio[5].replace(/[.,]/g, '')).toLocaleString('es-CO');
                tr.innerHTML = `
                    <td>
                        <i class="fas fa-trash-alt text-danger" title="Eliminar" data-servicio-index="${i}" data-habitacion = "${servicio[1]}" data-action="click->sistema--app#eliminarServicioCheckin"></i>
                    </td>
                    <td class="text-nowrap">
                        ${servicio[0]}
                    </td>
                    <td class="text-nowrap">${servicio[1]}</td>
                    <td class="text-nowrap">${servicio[2]}</td>
                    <td class="text-nowrap">${servicio[3]}</td>
                    <td class="text-nowrap" style="text-align:right;">$ ${valorServicio}</td>
                    <td class="text-nowrap" style="text-align:right;">
                        $ ${valorPagado}
                    </td>
                `;
                tbody.appendChild(tr);
            });

        } else {
            tbody.innerHTML = '<tr><td colspan="7" style="text-align:center">No se han registrado servicios</td></tr>';
        }

        this.actualizarTotalPago();
    }

    eliminarServicioCheckin(event) {
        let index = $("#numCheckin").val();
        // Obtener el índice del servicio a eliminar
        const servicioIndex = event.currentTarget.dataset.servicioIndex;
        const habitacion = event.currentTarget.dataset.habitacion;

        if (habitacion != '') {
            $("#fechaSalida-1").val('');
            $("#horaSalida-1").val('');
        }

        let key = 'servicioCheckin' + index;
        let serviciosArray = [];
        let serviciosGuardados = localStorage.getItem(key);
        if (serviciosGuardados) {
            try {
                serviciosArray = JSON.parse(serviciosGuardados);
                if (!Array.isArray(serviciosArray)) {
                    serviciosArray = [];
                }
            } catch (e) {
                serviciosArray = [];
            }
        }
        // Eliminar el servicio por índice
        serviciosArray.splice(servicioIndex, 1);

        localStorage.setItem(key, JSON.stringify(serviciosArray));
        // Actualizar la tabla
        this.actualizarTablaServiciosCheckin(index);
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

    abrirModalNuevoProducto(event) {

        if (event.currentTarget.dataset.accion == '2') {
            this.modalTipoServLabelTarget.innerHTML = 'Editar producto';
            this.nombreTipoServTarget.value = event.currentTarget.dataset.name;
            this.idTipoServTarget.value = event.currentTarget.dataset.id;
        }
        else {
            this.modalProductoLabelTarget.innerHTML = 'Nuevo producto';
            this.nombreProductoTarget.value = '';
            this.tipoProductoTarget.value = '';
            this.codigoProductoTarget.value = '';
        }

        this.modal = new Modal(this.modalNuevoProductoTarget);
        this.modal.show();
    }

    validaBtnGuardarProducto() {
        if (this.nombreProductoTarget.value != '' && this.tipoProductoTarget.value != '' && this.codigoProdTarget.value) {
            this.btnGuardarProductoTarget.disabled = false;
        }
        else {
            this.btnGuardarProductoTarget.disabled = true;
        }
    }

    async guardarProducto(event) {
        this.btnGuardarProductoTarget.disabled = true;

        let urlGuardar = this.rutaGuardarProductoValue;
        let ruta = this.rutaProductosValue;
        ruta = ruta.replace('var1', '0');

        let formulario = '';

        formulario = this.formNuevoProductoTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.modalNuevoProductoTarget);

            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Producto guardado correctamente', 'success');

            const respuesta = await fetch(ruta);
            this.frameProductosTarget.innerHTML = await respuesta.text();
        }
    }

    abrirModalNuevaEntrada(event) {

        if (event.currentTarget.dataset.accion == '2') {
            this.modalEntradaLabelTarget.innerHTML = 'Editar entrada';
        }
        else {
            this.modalEntradaLabelTarget.innerHTML = 'Nueva entrada';
        }

        this.modal = new Modal(this.modalNuevaEntradaTarget);
        this.modal.show();
    }

    calcularValEnt(event) {

        let cantidadProducto = this.cantidadProductoTarget.value.replace(/\.|,/g, '');
        let valorProducto = this.valorProductoTarget.value.replace(/\.|,/g, '');
        let porcProducto = this.porcProductoTarget.value.replace(/\.|,/g, '');

        if (cantidadProducto != '' && valorProducto != '') {
            let total = parseFloat(valorProducto) / parseFloat(cantidadProducto);
            this.valEntProductoTarget.value = total.toLocaleString('es-CO');
        }

        if (cantidadProducto != '' && valorProducto != '' && porcProducto != '' && this.valEntProductoTarget.value != '') {
            let porcentaje = Number(porcProducto / 100);
            let valEntProducto = Number(this.valEntProductoTarget.value.replace(/\.|,/g, ''));

            let utilidad = (valEntProducto * porcentaje) * cantidadProducto;
            let val = (valEntProducto * porcentaje) + valEntProducto;

            this.valSalProductoTarget.value = val.toLocaleString('es-CO');
            this.valVentaProductoTarget.value = val.toLocaleString('es-CO');
            this.utilidadTarget.innerHTML = '$ ' + utilidad.toLocaleString('es-CO');

        }
    }

    calcularUtilidad() {
        let valEntProducto = Number(this.valEntProductoTarget.value.replace(/\.|,/g, ''));
        let valVentaProducto = Number(this.valVentaProductoTarget.value.replace(/\.|,/g, ''));
        let cantidadProducto = this.cantidadProductoTarget.value.replace(/\.|,/g, '');

        if (valEntProducto != '') {
            let valor = valVentaProducto - valEntProducto;

            valor = valor * cantidadProducto;

            this.utilidadTarget.innerHTML = '$ ' + valor.toLocaleString('es-CO');
        }
    }

    validaBtnGuardarEntrada() {
        let codigoProducto = this.codigoProductoTarget.value;
        let cantidadProducto = this.cantidadProductoTarget.value;
        let valorProducto = this.valorProductoTarget.value;
        let porcProducto = this.porcProductoTarget.value;
        let valEntProducto = this.valEntProductoTarget.value;
        let valSalProducto = this.valSalProductoTarget.value;
        let valVentaProducto = this.valVentaProductoTarget.value;

        console.log(codigoProducto + ' != && ' + cantidadProducto + ' != && ' + valorProducto + ' != && ' + porcProducto + ' != && ' + valEntProducto + ' != && ' + valSalProducto + ' != && ' + valVentaProducto + ' != ');

        if (codigoProducto != '' && cantidadProducto != '' && valorProducto != '' && porcProducto != '' && valEntProducto != '' && valSalProducto != '' && valVentaProducto != '') {
            this.btnGuardarEntradaTarget.disabled = false;
        }
        else {
            this.btnGuardarEntradaTarget.disabled = true;
        }
    }

    async guardarEntrada(event) {
        this.btnGuardarEntradaTarget.disabled = true;

        let pantalla = event.currentTarget.dataset.pantalla;
        let urlGuardar = this.rutaGuardarEntradaValue;
        let ruta = this.rutaEntradasValue;
        let rutaProductos = this.rutaProductosValue;
        let rutaInventario = this.rutaInventarioValue;

        let formulario = '';

        formulario = this.formNuevaEntradaTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.modalNuevaEntradaTarget);

            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Entrada guardada correctamente', 'success');

            if (pantalla == '1') {
                const respuesta = await fetch(ruta);
                this.frameEntradasTarget.innerHTML = await respuesta.text();
            }
            else {
                const respuesta1 = await fetch(rutaProductos);
                this.frameProductosTarget.innerHTML = await respuesta1.text();

                const respuesta2 = await fetch(rutaInventario);
                this.frameInventarioTarget.innerHTML = await respuesta2.text();
            }
        }
    }

    abrirModalCargarProductos() {
        this.modal = new Modal(this.modalCargarProductosTarget);
        this.modal.show();
    }

    async cargarProductos(event) {

        if (this.planoProductosTarget.value != '') {
            this.btnCargarProductosTarget.disabled = true;

            let urlGuardar = this.rutaCargarProductosPlanoValue;
            let ruta = this.rutaProductosValue;

            let formulario = '';

            formulario = this.formCargarProductosTarget;

            var parametros = new FormData(formulario);

            var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
            var result = await consulta.json();

            if (result.response == 'Ok') {

                const modalInstance = Modal.getInstance(this.modalCargarProductosTarget);

                if (modalInstance) { modalInstance.hide(); }

                FlashMessage.show('Productos cargados correctamente', 'success');

                const respuesta = await fetch(ruta);
                this.frameProductosTarget.innerHTML = await respuesta.text();
            }
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
