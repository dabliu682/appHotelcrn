
import { Controller } from "@hotwired/stimulus";
import { Modal } from 'bootstrap';
import FlashMessage from '../../utils/FlashMessage';

// Connects to data-controller="app"
export default class extends Controller {
    static values = {
        'rutaObtenerDatosClienteReserva': String,
        'rutaCambiarEstadoHabitacion': String,
        'rutaAgregarProductoCheckin': String,
        'rutaAgregarServicioCheckin': String,
        'rutaCambiaEstadoServicio': String,
        'rutaCargarProductosPlano': String,
        'rutaUpdateCantProducto': String,
        'rutaDescargarInformes': String,
        'rutaRegistrarUsuarios': String,
        'rutaEliminarTiposServ': String,
        'rutaContabilizarGasto': String,
        'rutaEliminarCompania': String,
        'rutaEliminarClientes': String,
        'rutaEliminarServicio': String,
        'rutaGuardarTiposServ': String,
        'rutaGenerarInformes': String,
        'rutaEliminarCheckin': String,
        'rutaEliminarReserva': String,
        'rutaGuardarServicio': String,
        'rutaObtenerServicio': String,
        'rutaObtenerProducto': String,
        'rutaGuardarProducto': String,
        'rutaNuevaHabitacion': String,
        'rutaEliminarTipodoc': String,
        'rutaGuardarClientes': String,
        'rutaGuardarReserva': String,
        'rutaGuardarTipodoc': String,
        'rutaGuardarEntrada': String,
        'rutaRegistrarVenta': String,
        'rutaGenerarFactura': String,
        'rutacambiaTurnoUser': String,
        'rutaObtenerCheckin': String,
        'rutaNuevaCompania': String,
        'rutaEliminarGasto': String,
        'rutaGuardarBonos': String,
        'rutaHabitaciones': String,
        'rutaGuardarGasto': String,
        'rutaEliminarPiso': String,
        'rutaCrearCheckin': String,
        'rutaCerrarTurno': String,
        'rutaEliminarHab': String,
        'rutaMovimientos': String,
        'rutaAbrirTurno': String,
        'rutaCobrarBono': String,
        'rutaInventario': String,
        'rutaDashboard': String,
        'rutaNuevoPiso': String,
        'rutaTiposServ': String,
        'rutaProductos': String,
        'rutaListaServ': String,
        'rutaCompanias': String,
        'rutaUsuarios': String,
        'rutaReservas': String,
        'rutaClientes': String,
        'rutaEntradas': String,
        'rutaCheckout': String,
        'rutaCheckin': String,
        'rutaVistas': String,
        'rutaBonos': String,
        'rutaPisos': String,
        'rutaDocs': String,
    };
    static targets = [
        'selectFormaPagoProductoCheckin',
        'comprobanteProductoCheckin',
        'modalNuevoServicioCheckin',
        'btnGuardarServicioCheckin',
        'btnGuardarProductoCheckin',
        'modalBuscarClienteCheckin',
        'modalNuevoProductoCheckin',
        'valorPagoProductoCheckin',
        'numeroVehiculoClienteRev',
        'selectFormaPagoCheckin',
        'selectProductoCheckin',
        'valorProductorCheckin',
        'numeroVehiculoCliente',
        'selectCompaniaCliente',
        'modalContabilizaGasto',
        'selectTipoHabitacion',
        'nuevoServicioCheckin',
        'selectHabitacionServ',
        'modalNuevoMovimiento',
        'frameListaServicioss',
        'saldoProductoCheckin',
        'modalCargarProductos',
        'modalNuevaHabitacion',
        'selectTipoDocCliente',
        'nuevoProductoCheckin',
        'fechaLlegClienteRev',
        'frameTiposServicios',
        'valorPagServCheckin',
        'botonesModalCheckin',
        'formCargarProductos',
        'cantProductoCheckin',
        'formRegistroUsuario',
        'modalNuevaCompania',
        'modalCompaniaLabel',
        'btnGuardarCompania',
        'horaLlegClienteRev',
        'modalNuevoTipoServ',
        'companiaClienteRev',
        'modalServicioLabel',
        'comprobanteCheckin',
        'modalNuevoProducto',
        'modalProductoLabel',
        'btnGuardarTipoServ',
        'btnGuardarServicio',
        'btnGuardarProducto',
        'modalNuevoServicio',
        'modalTipoServLabel',
        'btnCargarProductos',
        'modalEliminarGasto',
        'btnGuardarEntrada',
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
        'formNuevoTipoServ',
        'formNuevoServicio',
        'formNuevoProducto',
        'modalNuevaEntrada',
        'modalEntradaLabel',
        'modalReservaLabel',
        'cantHabClienteRev',
        'modalNuevoUsuario',
        'btnGuardarReserva',
        'formNuevoTipoDoc',
        'nombreHabitacion',
        'numeroDocCliente',
        'formNuevoCliente',
        'apellidosCliente',
        'formNuevaReserva',
        'modalBodyCheckin',
        'observacionesRev',
        'cantidadProducto',
        'formNuevaEntrada',
        'valVentaProducto',
        'valorServCheckin',
        'saldoServCheckin',
        'numeroCelCliente',
        'tipoGastoInforme',
        'modalcobrarBono',
        'frameInventario',
        'modalNuevoGasto',
        'frameMovimentos',
        'servicioInforme',
        'btnGuardarGasto',
        'btnGuardarPiso',
        'modalNuevoPiso',
        'nombreCompania',
        'frameCompanias',
        'nombresCliente',
        'codigoProducto',
        'selectTipoServ',
        'nombreTipoServ',
        'nombreProducto',
        'valSalProducto',
        'valEntProducto',
        'planoProductos',
        'frameProductos',
        'codigoProducto',
        'empresaInforme',
        'frameDashboard',
        'modalNuevoBono',
        'formNuevoGasto',
        'nombreTipoDoc',
        'labelModalHab',
        'modalNuevoMov',
        'btnGuardarHab',
        'formNuevoPiso',
        'frameClientes',
        'modalCheckout',
        'cellCienteRev',
        'selectAireRev',
        'frameUsuarios',
        'frameEntradas',
        'valorProducto',
        'frameReservas',
        'idHabitacion',
        'formNuevaHab',
        'frameTipoDoc',
        'placaCliente',
        'modalCheckin',
        'modalFactura',
        'tipoProducto',
        'porcProducto',
        'formInformes',
        'desdeInforme',
        'hastaInforme',
        'selectPisos',
        'tipoInforme',
        'formCheckin',
        'nitCompania',
        'btnServicio',
        'formNewBono',
        'framePisos',
        'numeroCama',
        'idCompania',
        'ventilador',
        'nombrePiso',
        'clienteRev',
        'codigoServ',
        'idTipoServ',
        'idServicio',
        'selectServ',
        'nombreServ',
        'codigoProd',
        'frameBonos',
        'idReserva',
        'horasServ',
        'idTipoDoc',
        'valorServ',
        'idCliente',
        'utilidad',
        'idPiso',
    ];

    connect() {

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
            let aircond = (event.currentTarget.dataset.aircon == 0) ? 'si' : 'no';
            let fan = (event.currentTarget.dataset.fan == 0) ? 'si' : 'no';
            let tipo = event.currentTarget.dataset.tipo;

            console.log('aircond ' + aircond);
            console.log('fan ' + fan);
            console.log('tipo ' + tipo);

            this.idHabitacionTarget.value = id;

            this.labelModalHabTarget.innerHTML = 'Editar Habitación';
            this.selectPisosTarget.value = piso;
            this.nombreHabitacionTarget.value = name;
            this.numeroCamaTarget.value = bedmunber;
            this.aireAcondicionadoTarget.value = aircond;
            this.ventiladorTarget.value = fan;
            this.selectTipoHabitacionTarget.value = tipo;
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

            let url = this.rutaVistasValue.replace('var1', 0);
            window.location.href = url;
        }
    }

    abrirModalNuevaReserva(event) {
        let accion = event.currentTarget.dataset.accion;


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

        $("#fechaLlegada").val(fechaActual);
        $("#horallegada").val(horaActual24);
        $("#idCheckin").val(event.currentTarget.dataset.id);
        console.log(event.currentTarget.dataset.cliente);
        $("#clienteSelectCustom-1").val(event.currentTarget.dataset.cliente);

        $("#clienteSelectCustom-1").selectpicker('render')

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

        let select = $("#clienteSelectCustom-1");

        if (select.length && typeof select.selectpicker === 'function') {
            try { select.selectpicker('destroy'); } catch (e) { /* ignore */ }
        }

        select.empty().selectpicker('destroy');

        if (result.response == 'Ok') {
            const modalInstance = Modal.getInstance(this.modalNuevoClienteTarget);
            if (modalInstance) { modalInstance.hide(); }
            FlashMessage.show('Cliente guardado correctamente', 'success');

            select.append('<option value="">Seleccione cliente</option>');

            let clientesArray = result.clientes;

            clientesArray.forEach(c => {
                // asegurar que los valores estén escapados correctamente
                const id = c.id;
                const nombre = c.nombre;
                select.append(`<option value="${id}">${nombre}</option>`);
            });

            select.val(result.id); // Seleccionar el nuevo cliente

            select.selectpicker();

            $("#cellClienteCheckin-1").val(result.cellphone);
            $("#companiaClienteCheckin-1").val(result.compania);
            $("#numeroVehiculoClienteCheckin-1").val(result.numberBus);
        }
    }

    async guardarClienteReseva() {
        this.btnGuardarClienteTarget.disabled = true;

        let urlGuardar = this.rutaGuardarClientesValue;

        let formulario = '';

        formulario = this.formNuevoClienteTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        let select = $("#clienteSelectCustom");

        if (select.length && typeof select.selectpicker === 'function') {
            try { select.selectpicker('destroy'); } catch (e) { /* ignore */ }
        }

        select.empty().selectpicker('destroy');

        if (result.response == 'Ok') {
            const modalInstance = Modal.getInstance(this.modalNuevoClienteTarget);
            if (modalInstance) { modalInstance.hide(); }
            FlashMessage.show('Cliente guardado correctamente', 'success');

            select.append('<option value="">Seleccione cliente</option>');

            let clientesArray = result.clientes;

            clientesArray.forEach(c => {
                // asegurar que los valores estén escapados correctamente
                const id = c.id;
                const nombre = c.nombre;
                select.append(`<option value="${id}">${nombre}</option>`);
            });

            select.val(result.id); // Seleccionar el nuevo cliente

            select.selectpicker();

            this.cellCienteRevTarget.value = result.cellphone;
            this.numeroVehiculoClienteRevTarget.value = result.numberBus;
            this.companiaClienteRevTarget.value = result.compania;

        }
    }

    abrirModalServicioCheckin() {
        this.modal = new Modal(this.modalNuevoServicioCheckinTarget);
        this.modal.show();
    }

    async cargarServicioCheckin(event) {

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

        let fecha = $("#fechaLlegada").val();
        let hora = $("#horallegada").val();
        let cant = $("#inputCantidadServicio").val();
        let diferencia = result.horas * cant;

        $("#valHorasServ").val(result.horas);

        if (diferencia != null) {
            //this.calcularFechaSalida(fecha, hora, diferencia);
        }


    }

    recalcularFechaSalida() {
        let fecha = $("#fechaLlegada").val();
        let hora = $("#horallegada").val();
        let cant = $("#inputCantidadServicio").val();
        let horas = $("#valHorasServ").val();
        let diferencia = horas * cant;

        if (diferencia != null || diferencia > 0) {
            this.calcularFechaSalida(fecha, hora, diferencia);
        }
    }

    calcularFechaSalida(fecha, hora, diferencia) {

        let fechaHora = new Date(`${fecha}T${hora}:00`);

        console.log(diferencia)

        fechaHora.setHours(fechaHora.getHours() + diferencia);

        let fechasalida = fechaHora.toLocaleDateString('es-CO'); // YYYY-MM-DD
        let arrayFecha = fechasalida.split('/');
        let horasalida = fechaHora.toTimeString().slice(0, 5);             // HH:mm

        console.log(arrayFecha);

        $("#fechaSalida").val(arrayFecha[2] + '-' + arrayFecha[1] + '-' + arrayFecha[0]);
        $("#horaSalida").val(horasalida);
    }

    cargarHab(event) {
        $("#idHab").val(event.currentTarget.value);
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

        let valorServicio = Number(this.valorProductorCheckinTarget.value.replace(/[.,]/g, '')) * cantProducto;
        let valorProductor = this.valorProductorCheckinTarget.value
        let valorPagoProducto = this.valorPagoProductoCheckinTarget.value
        let saldoProducto = this.saldoProductoCheckinTarget.value
        let selectFormaPagoProducto = this.selectFormaPagoProductoCheckinTarget.value
        let comprobanteProducto = this.comprobanteProductoCheckinTarget.value
        let productoText = this.selectProductoCheckinTarget.options[this.selectProductoCheckinTarget.selectedIndex].text;
        let formaPagoText = this.selectFormaPagoProductoCheckinTarget.options[this.selectFormaPagoProductoCheckinTarget.selectedIndex].text;

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
        this.recalcularFechaSalida();


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
            this.selectTipoHabitacionTarget.value = event.currentTarget.dataset.typeroom;
            this.horasServTarget.value = event.currentTarget.dataset.hours;
        }
        else {
            this.modalServicioLabelTarget.innerHTML = 'Nuevo servicio';
            this.codigoServTarget.value = '';
            this.selectTipoServTarget.value = '';
            this.nombreServTarget.value = '';
            this.valorServTarget.value = '';
            this.idServicioTarget.value = '0';
            this.selectTipoHabitacionTarget.value = '';
            this.horasServTarget.value = '';

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

        let cantidadProducto = (this.cantidadProductoTarget.value != '') ? Number(this.cantidadProductoTarget.value.replace(/\.|,/g, '').replace(/\./g, '').replace(',', '.')) : '';
        let valorProducto = (this.valorProductoTarget.value != '') ? parseFloat(this.valorProductoTarget.value.replace(/\./g, '').replace(',', '.')) : '';
        let porcProducto = (this.porcProductoTarget.value != '') ? parseFloat(this.porcProductoTarget.value.replace(/\./g, '').replace(',', '.')) : '';


        if (cantidadProducto != '' && valorProducto != '' && porcProducto == '') {
            let total = valorProducto / cantidadProducto;
            this.valEntProductoTarget.value = total.toLocaleString('es-CO');
            this.valSalProductoTarget.value = 0;
        }
        else {
            if (cantidadProducto != '' && valorProducto != '' && porcProducto != '' && this.valEntProductoTarget.value != '') {
                let porcentaje = Number(porcProducto / 100);
                let valEntProducto = parseFloat(this.valEntProductoTarget.value.replace(/\./g, '').replace(',', '.'));

                console.log(porcentaje)
                console.log(valEntProducto)

                let utilidad = (valEntProducto * porcentaje) * cantidadProducto;
                let val = (valEntProducto * porcentaje) + valEntProducto;

                console.log(utilidad)
                console.log(val)

                this.valSalProductoTarget.value = (val - valEntProducto).toLocaleString('es-CO');
                this.valVentaProductoTarget.value = val.toLocaleString('es-CO');
                this.utilidadTarget.innerHTML = '$ ' + utilidad.toLocaleString('es-CO');

            }
        }
    }

    calcularUtilidad() {
        let cantidadProducto = this.cantidadProductoTarget.value.replace(/\.|,/g, '');
        let valEntProducto = (this.valEntProductoTarget.value != '') ? parseFloat(this.valEntProductoTarget.value.replace(/\./g, '').replace(',', '.')) : '';
        let valVentaProducto = (this.valVentaProductoTarget.value != '') ? parseFloat(this.valVentaProductoTarget.value.replace(/\./g, '').replace(',', '.')) : '';

        if (valEntProducto != '') {
            let valor = valVentaProducto - valEntProducto;

            let porcentaje = ((valVentaProducto - valEntProducto) / valEntProducto) * 100;

            this.porcProductoTarget.value = Number(porcentaje.toFixed(2));
            this.valSalProductoTarget.value = valor.toLocaleString('es-CO');
            let util = cantidadProducto * valor;
            this.utilidadTarget.innerHTML = '$ ' + util.toLocaleString('es-CO');
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

    async hacerCheckin() {

        let ruta = this.rutaReservasValue;

        if ($("#fechaSalida").val() != '') {
            let serviciosGuardados = localStorage.getItem('servicioCheckin1');
            let productosGuardados = localStorage.getItem('productoCheckin');

            $("#productos").val(productosGuardados);
            $("#servicios").val(serviciosGuardados);

            let urlGuardar = this.rutaCheckinValue;

            let formulario = '';

            formulario = this.formCheckinTarget;

            var parametros = new FormData(formulario);

            var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
            var result = await consulta.json();

            if (result.response == "Ok") {
                const modalInstance = Modal.getInstance(this.modalCheckinTarget);

                if (modalInstance) { modalInstance.hide(); }

                FlashMessage.show('Check-in realizado correctamente', 'success');

                const respuesta = await fetch(ruta);
                this.frameReservasTarget.innerHTML = await respuesta.text();
            }
        }
        else {
            alert('No se ha registrado un servicio de hospedaje');
        }

    }

    registrarMov() {
        this.modal = new Modal(this.modalNuevoMovTarget);
        this.modal.show();
    }

    async cargarSelectProductosMov(event) {
        let accion = event.currentTarget.value;

        if (accion == 1) {
            $("#divProductos").css('display', 'inline');
            $("#divServicios").css('display', 'none');
        }
        else {
            $("#divProductos").css('display', 'none');
            $("#divServicios").css('display', 'inline');
        }


    }

    async cargarproductoMov(event) {
        let ruta = this.rutaObtenerProductoValue.replace('var1', event.currentTarget.value);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        $("#cantProdMov").val('');
        $("#cantProdMov").attr('placeholder', result.existencias);
        $("#valorUndProdMov").val(result.valor.toLocaleString('es-CO'));
    }

    calculoValProdMov() {
        let valorUndProdMov = $("#valorUndProdMov").val();
        valorUndProdMov = Number(valorUndProdMov.replace(/\.|,/g, ''));
        let cantProdMov = $("#cantProdMov").val();
        cantProdMov = Number(cantProdMov.replace(/\.|,/g, ''));

        if (valorUndProdMov != '' && cantProdMov != '') {
            let total = valorUndProdMov * cantProdMov;

            $("#valorProdMov").val(total.toLocaleString('es-CO'));
        }
        else {
            $("#valorProdMov").val(0);
        }
    }

    async registrarVenta() {

        $("#btnRegistroVenta").prop('disabled', true)

        let ruta = this.rutaRegistrarVentaValue;

        let detalleMov = $("#detalleVenta").val();

        let productoMov = 0;

        if (detalleMov == 1) {
            productoMov = $("#productoVenta").val();
        }
        else {
            productoMov = $("#servicioVenta").val();
        }

        let valorProdMov = Number($("#valorVenta").val().replace(/\.|,/g, ''));
        let cantProdMov = $("#cantVenta").val();

        ruta = ruta.replace('var1', detalleMov);
        ruta = ruta.replace('var2', productoMov);
        ruta = ruta.replace('var3', cantProdMov);
        ruta = ruta.replace('var4', valorProdMov);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        var ventas = result.tablaVentas;
        var tablaVentas = document.getElementById("tablaVentas");

        tablaVentas.innerHTML = "";

        ventas.forEach(function (item) {
            var tr = document.createElement("tr");

            var tdProducto = document.createElement("td");
            tdProducto.textContent = item.producto;
            tr.appendChild(tdProducto);

            var tdCantidad = document.createElement("td");
            tdCantidad.textContent = item.cantidad;
            tr.appendChild(tdCantidad);

            var tdValor = document.createElement("td");
            tdValor.textContent = '$ ' + item.valor.toLocaleString('es-CO');
            tdValor.style.cssText = "text-align: right";
            tr.appendChild(tdValor);

            tablaVentas.appendChild(tr);
        });

        var movimientos = result.tablaMov;
        var tablaMov = document.getElementById("tablaMov");

        tablaMov.innerHTML = "";
        let totalValor = 0;
        let totalPendiente = 0;
        let bono = 0;

        movimientos.forEach(function (mov) {
            var tr = document.createElement("tr");

            var tdConcepto = document.createElement("td");
            tdConcepto.textContent = mov.concepto;
            tr.appendChild(tdConcepto);

            var tdValor = document.createElement("td");
            tdValor.textContent = '$ ' + mov.valor.toLocaleString('es-CO');
            tdValor.style.cssText = "text-align: right";
            tr.appendChild(tdValor);

            var tdpendiente = document.createElement("td");
            tdpendiente.textContent = '$ ' + mov.pendiente.toLocaleString('es-CO');
            tdpendiente.style.cssText = "text-align: right";
            tr.appendChild(tdpendiente);

            var tdBono = document.createElement("td");
            tdBono.textContent = '$ ' + mov.bono.toLocaleString('es-CO');
            tdBono.style.cssText = "text-align: right";
            tr.appendChild(tdBono);

            tablaMov.appendChild(tr);

            totalValor += mov.valor;
            totalPendiente += mov.pendiente;
            bono += mov.bono;
        });

        var tr = document.createElement("tr");
        tr.classList.add("table-light");

        var tdConcepto = document.createElement("td");
        tdConcepto.textContent = 'Total';
        tdConcepto.style.cssText = "text-align: right; font-weight:bold";
        tr.appendChild(tdConcepto);

        var tdTotalValor = document.createElement("td");
        tdTotalValor.textContent = '$ ' + totalValor.toLocaleString('es-CO');
        tdTotalValor.style.cssText = "text-align: right; font-weight:bold";
        tr.appendChild(tdTotalValor);

        var tdTotalPendiente = document.createElement("td");
        tdTotalPendiente.textContent = '$ ' + totalPendiente.toLocaleString('es-CO');
        tdTotalPendiente.style.cssText = "text-align: right; font-weight:bold";
        tr.appendChild(tdTotalPendiente);

        var tdBono = document.createElement("td");
        tdBono.textContent = '$ ' + bono.toLocaleString('es-CO');
        tdBono.style.cssText = "text-align: right; font-weight:bold";
        tr.appendChild(tdBono);

        tablaMov.appendChild(tr);

        $("#productoVenta").val('');
        $("#servicioVenta").val('');
        $("#valorUndVenta").val('0');
        $("#cantVenta").val('');
        $("#cantVenta").attr('placeholder', '');
        $("#valorVenta").val('0');

    }

    async cerrarPeriodo(event) {
        let ruta = this.rutaCerrarTurnoValue;

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        ruta = this.rutaDashboardValue;

        FlashMessage.show('Turno cerrado correctamente', 'success');

        const modalInstance = Modal.getInstance(this.modalNuevoMovTarget);

        if (modalInstance) { modalInstance.hide(); }

        let url = this.rutaVistasValue.replace('var1', 0);
        window.location.href = url;
    }

    async abrirModalCheckOut(event) {

        let id = event.currentTarget.dataset.id;

        let ruta = this.rutaObtenerCheckinValue;

        ruta = ruta.replace('var1', id);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        let datos = result.datos;

        $("#idCheckout").val(id);
        $("#clienteCheckout").val(datos.cliente);
        $("#fechaLlegadaOut").val(datos.fechaLlegada);
        $("#horaLlegadaOut").val(datos.horaLlegada);
        $("#fechaSalidaOut").val(datos.fechaSalida);
        $("#horaSalidaOut").val(datos.horaSalida);
        $("#observacionesCheckOut").val(datos.observaciones);
        $("#saldoPagar").text('$ ' + result.saldo.toLocaleString('es-CO'));
        (datos.tipoCliente == 1) ? $("#tipoClienteOut").text('Motorista') : $("#tipoClienteOut").text('Turista');


        let servicios = result.servicios;

        let tbody = this.modalCheckoutTarget.querySelector(`#serviciosCheckout`);
        tbody.innerHTML = ''; // Limpiar el contenido actual

        servicios.forEach((servicio) => {
            let tr = document.createElement('tr');
            const valorServicio = servicio.valor.toLocaleString('es-CO');
            const valorPagado = servicio.valorPag.toLocaleString('es-CO');
            const saldo = servicio.saldo.toLocaleString('es-CO');

            tr.innerHTML = `
                <td class="text-nowrap">${servicio.servicio}</td>
                <td class="text-nowrap">${servicio.habitacion}</td>
                <td class="text-nowrap">${servicio.formaPago}</td>
                <td class="text-nowrap">comprobante</td>
                <td class="text-nowrap" style="text-align:right;">$ ${valorServicio}</td>
                <td class="text-nowrap" style="text-align:right;">$ ${valorPagado}</td>
                <td class="text-nowrap" style="text-align:right;">$ ${saldo}</td>
            `;

            tbody.appendChild(tr);
        });

        let productos = result.productos;

        let tbodyProductos = this.modalCheckoutTarget.querySelector(`#productosCheckout`);
        tbodyProductos.innerHTML = ''; // Limpiar el contenido actual

        if (productos.length > 0) {
            productos.forEach((producto) => {
                let tr = document.createElement('tr');
                const valorServicio = producto.valor.toLocaleString('es-CO');
                const valorPagado = producto.valorPag.toLocaleString('es-CO');
                const saldo = producto.saldo.toLocaleString('es-CO');
                const valUnd = producto.valUnd.toLocaleString('es-CO');

                tr.innerHTML = `
                    <td class="text-nowrap">${producto.producto}</td>                   
                    <td class="text-nowrap">${producto.formaPago}</td>                   
                    <td class="text-nowrap" style="text-align:right;">${producto.cantidad}</td>                   
                    <td class="text-nowrap" style="text-align:right;">$ ${valUnd}</td>                   
                    <td class="text-nowrap" style="text-align:right;">$ ${valorServicio}</td>
                    <td class="text-nowrap" style="text-align:right;">$ ${valorPagado}</td>
                    <td class="text-nowrap" style="text-align:right;">$ ${saldo}</td>
                `;

                tbodyProductos.appendChild(tr);
            });
        }
        else {
            let tr = document.createElement('tr');

            tr.innerHTML = `<td colspan=7 style="color:red; text-align:center" >No se cargaron productos</td>`;

            tbodyProductos.appendChild(tr);
        }

        (datos.toalla) ? $("#checkToallaOut").prop("checked", true) : $("#checkToallaOut").prop("checked", false);
        (datos.aire) ? $("#checkAireOut").prop("checked", true) : $("#checkAireOut").prop("checked", false);
        (datos.cobija) ? $("#checkCobijaOut").prop("checked", true) : $("#checkCobijaOut").prop("checked", false);
        (datos.control) ? $("#checkControlOut").prop("checked", true) : $("#checkControlOut").prop("checked", false);
        (datos.llaves) ? $("#checkLlavesOut").prop("checked", true) : $("#checkLlavesOut").prop("checked", false);

        if ($("#checkToallaOut").is(":checked") && $("#checkAireOut").is(":checked") && $("#checkCobijaOut").is(":checked") && $("#checkControlOut").is(":checked") && $("#checkLlavesOut").is(":checked")) {
            $("#checkTodosOut").prop("checked", true);
        }
        else {
            $("#checkTodosOut").prop("checked", false);
        }



        this.modal = new Modal(this.modalCheckoutTarget);
        this.modal.show();
    }

    async checkout() {

        let rutaCheckin = this.rutaReservasValue;

        let id = $("#idCheckout").val();

        let ruta = this.rutaCheckoutValue;

        ruta = ruta.replace('var1', id);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        if (result.response == "Ok") {
            const modalInstance = Modal.getInstance(this.modalCheckoutTarget);

            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Check-out realizado correctamente', 'success');

            const respuesta = await fetch(rutaCheckin);
            this.frameReservasTarget.innerHTML = await respuesta.text();
        }
    }

    async verFactura(event) {
        let id = event.currentTarget.dataset.id;
        let ruta = this.rutaGenerarFacturaValue;
        ruta = ruta.replace('var1', id);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        if (result.response == 'Ok') {

            var base64Data = result.pdf;
            var byteCharacters = atob(base64Data);

            var byteNumbers = new Array(byteCharacters.length);
            for (var i = 0; i < byteCharacters.length; i++) {
                byteNumbers[i] = byteCharacters.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);

            var blob = new Blob([byteArray], { type: 'application/pdf' });

            $("#frame-pdfLiq").attr("src", URL.createObjectURL(blob));

            this.modal = new Modal(this.modalFacturaTarget);
            this.modal.show();

        }
    }

    abrirModalServicio(event) {

        localStorage.clear();

        let id = event.currentTarget.dataset.id;
        let habitacion = event.currentTarget.dataset.habitacion;

        $("#NumHabitacion").val(habitacion);
        $("#idCheckinNewService").val(id);

        this.modal = new Modal(this.nuevoServicioCheckinTarget);
        this.modal.show();
    }

    async cargarnewServicioCheckin(event) {
        let ruta = this.rutaObtenerServicioValue.replace('var1', event.currentTarget.value);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        $("#valorNewService").val(Number(result.price).toLocaleString('es-CO'));

        if ($("#valorPagNewService") != '') {
            let valor = $("#valorNewService").val().replace(/[.,]/g, '');
            let pago = $("#valorPagNewService").val().replace(/[.,]/g, '');
            let saldo = (Number(valor) - Number(pago)).toLocaleString('es-CO');
            $("#saldoNewService").val(saldo);
        }
    }

    actualizaSaldoNewService() {
        let valor = $("#valorNewService").val().replace(/[.,]/g, '');
        let pago = $("#valorPagNewService").val().replace(/[.,]/g, '');
        let saldo = (Number(valor) - Number(pago)).toLocaleString('es-CO');
        $("#saldoNewService").val(saldo);
    }

    actualizarComprobanteNewService(event) {
        if (event.currentTarget.value == 2) {
            $("#comprobanteNewService").prop("disabled", false)
        }
        else {
            $("#comprobanteNewService").prop("disabled", true)
        }
    }

    validaBtnCargarNewServicio() {
        let selectServ = $("#selectNewServ").val();
        let valorPagNewService = $("#valorPagNewService").val();
        let selectFormaPagoNewService = $("#selectFormaPagoNewService").val();
        let comprobanteNewService = $("#comprobanteNewService").val();
        let btnCaragarNewService1 = $("#btnCaragarNewService1");
        let btnCaragarNewService2 = $("#btnCaragarNewService2");

        if (selectServ != '' && valorPagNewService != '' && selectFormaPagoNewService != '') {
            if (selectFormaPagoNewService == '2') {
                if (comprobanteNewService != '') {
                    btnCaragarNewService1.css("display", "none");
                    btnCaragarNewService2.css("display", "inline");
                }
                else {
                    btnCaragarNewService1.css("display", "inline");
                    btnCaragarNewService2.css("display", "none");
                }
            }
            else {
                btnCaragarNewService1.css("display", "none");
                btnCaragarNewService2.css("display", "inline");
            }
        }
        else {
            btnCaragarNewService1.css("display", "inline");
            btnCaragarNewService2.css("display", "none");
        }
    }

    cargarNewServicio() {
        let selectServ = $("#selectNewServ").val();
        let selectServText = $("#selectNewServ option:selected").text();
        let selectFormaPagoNewService = $("#selectFormaPagoNewService").val();
        let selectFomaPagoText = $("#selectFormaPagoNewService option:selected").text();

        let valorServCheckin = $("#valorNewService").val();
        let valorPagServCheckin = $("#valorPagNewService").val();
        let saldoServCheckin = $("#saldoNewService").val();
        let selectFormaPagoCheckin = selectFormaPagoNewService;
        let comprobanteCheckin = $("#comprobanteNewService").val();

        // Crear un array con los datos del servicio actual
        let nuevoServicio = [
            selectServText,
            selectFomaPagoText,
            comprobanteCheckin,
            valorServCheckin,
            valorPagServCheckin,
            saldoServCheckin,
            selectServ,
            selectFormaPagoCheckin,
        ];

        // Acumular servicios en el array, agregando el nuevo al inicio
        let key = 'newServicioCheckin';
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
        $("#selectNewServ").val('');
        $("#valorPagNewService").val('');
        $("#selectFormaPagoNewService").val('');
        $("#comprobanteNewService").val('');
        $("#valorPagNewService").val('');
        $("#saldoNewService").val('');
        $("#comprobanteNewService").val('')
        $("#btnCaragarNewService1").css("display", "inline");
        $("#btnCaragarNewService2").css("display", "none");

        FlashMessage.show('Servicio agregado correctamente', 'success');

        // Actualizar la tabla de servicios en el modal
        this.actualizarTablaNewServicios();

        $("#btnGuardarNweServicio").prop('disabled', false);
    }

    actualizarTablaNewServicios() {
        let key = 'newServicioCheckin';
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
        let tbody = this.nuevoServicioCheckinTarget.querySelector(`#tablaNewsServices`);
        tbody.innerHTML = ''; // Limpiar el contenido actual

        console.table(serviciosArray);
        if (serviciosArray.length > 0) {
            serviciosArray.forEach((servicio, i) => {
                let tr = document.createElement('tr');
                const valorServicio = Number(servicio[3].replace(/[.,]/g, '')).toLocaleString('es-CO');
                const valorPagado = Number(servicio[4].replace(/[.,]/g, '')).toLocaleString('es-CO');
                const saldo = Number(servicio[5].replace(/[.,]/g, '')).toLocaleString('es-CO');
                tr.innerHTML = `
                     <td>
                         <i class="fas fa-trash-alt text-danger" title="Eliminar" data-servicio-index="${i}" data-action="click->sistema--app#eliminarNewServicio"></i>
                     </td>
                     <td class="text-nowrap">
                         ${servicio[0]}
                     </td>
                     <td class="text-nowrap">${servicio[1]}</td>
                     <td class="text-nowrap">${servicio[2]}</td>
                     <td class="text-nowrap" style="text-align:right;">$ ${valorServicio}</td>
                     <td class="text-nowrap" style="text-align:right;">$ ${valorPagado}</td>
                     <td class="text-nowrap" style="text-align:right;">$ ${saldo}</td>
                 `;
                tbody.appendChild(tr);
            });

        } else {
            tbody.innerHTML = '<tr><td colspan="7" style="text-align:center">No se han registrado servicios</td></tr>';
        }
    }

    eliminarNewServicio(event) {

        const servicioIndex = event.currentTarget.dataset.servicioIndex;

        let key = 'newServicioCheckin';
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
        this.actualizarTablaNewServicios();

        if (serviciosArray.length > 0) {
            $("#btnGuardarNweServicio").prop('disabled', false);
        }
        else {
            $("#btnGuardarNweServicio").prop('disabled', true);
        }
    }

    async guardarnewServicio() {
        let ruta = this.rutaAgregarServicioCheckinValue;

        let serviciosGuardados = localStorage.getItem('newServicioCheckin');
        let id = $("#idCheckinNewService").val();

        let formData = new FormData();
        formData.append("servicio", serviciosGuardados);
        formData.append("id", id);

        var consulta = await fetch(ruta, { method: 'POST', body: formData });
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.nuevoServicioCheckinTarget);

            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Servicio agregado correctamente', 'success');

            let ruta = this.rutaReservasValue;
            const respuesta = await fetch(ruta);
            this.frameReservasTarget.innerHTML = await respuesta.text();
        }
    }

    async abrirModalProductos(event) {

        localStorage.clear();

        let id = event.currentTarget.dataset.id;
        let habitacion = event.currentTarget.dataset.habitacion;

        $("#habitacionNewProducto").val(habitacion);
        $("#idCheckProducto").val(id);

        this.modal = new Modal(this.nuevoProductoCheckinTarget);
        this.modal.show();
    }

    async cargarNewProductoCheckin(event) {
        let ruta = this.rutaObtenerProductoValue.replace('var1', event.currentTarget.value);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        $("#valorNewProductorCheckin").val(result.valor.toLocaleString('es-CO'));
        $("#cantProd").val(result.existencias);
        $("#valPro").val(result.valor);

        if ($("#cantProductoNewCheckin").val() != '' && $("#valorNewProductorCheckin").val()) {
            let cantidad = $("#cantProductoNewCheckin").val().replace(/[.,]/g, '');
            let valorUnd = $("#valorNewProductorCheckin").val().replace(/[.,]/g, '');
            let valorPag = Number(cantidad) * Number(valorUnd);

            if ($("#valorPagoNewProducto").val() != '') {
                let saldo = valorPag - Number($("#valorPagoNewProducto").val().replace(/[.,]/g, ''));
                $("#saldoProductoNewCheckin").val(saldo.toLocaleString('es-CO'));
            }
            else {
                $("#valorPagoNewProducto").val(valorPag.toLocaleString('es-CO'));
                $("#saldoProductoNewCheckin").val('0');
            }
        }
        else {
            $("#valorPagoNewProducto").val('');
            $("#saldoProductoNewCheckin").val('');
            $("#cantProductoNewCheckin").val('');
        }



    }

    calculaValorNewProductos(event) {

        let cantidad = Number(event.currentTarget.value);
        let cantProd = $("#cantProd").val();

        if (cantidad <= cantProd) {
            let valor = Number($("#valPro").val());
            let total = cantidad * valor;

            $("#valorPagoNewProducto").val(total.toLocaleString('es-CO'));
            $("#saldoProductoNewCheckin").val(0);
        }
        else {
            FlashMessage.show('Existencias: ' + cantProd, 'danger');
            $("#valorPagoNewProducto").val('');
            $("#saldoProductoNewCheckin").val('');
            $("#cantProductoNewCheckin").val('');
        }
    }

    actualizaSaldoProdNewCheckin(event) {
        if ($("#valorPagoNewProducto").val() != '' && $("#cantProductoNewCheckin").val() != '' && $("#valorNewProductorCheckin").val() != '') {
            let valor = Number(event.currentTarget.value.replace(/[.,]/g, ''));
            let cant = $("#cantProductoNewCheckin").val();
            let valorUnd = Number($("#valorNewProductorCheckin").val().replace(/[.,]/g, ''));

            let valorT = cant * valorUnd;

            let total = valorT - valor;

            $("#saldoProductoNewCheckin").val(total.toLocaleString('es-CO'));

        }
    }

    validaBtnCargarnewProductoCheckin() {
        if ($("#valorPagoNewProducto").val() != '' && $("#cantProductoNewCheckin").val() != "" && $("#selectProductoNewCheckin").val() != '' && $("#selectFormaPagoNewProductoCheckin").val() != '') {
            if ($("#selectFormaPagoNewProductoCheckin").val() == 2) {
                if ($("#comprobanteNewProductoCheckin").val() != '') {
                    $("#btnCaragarNewProducto1").css("display", "none");
                    $("#btnCaragarNewProducto2").css("display", "inline");
                }
                else {
                    $("#btnCaragarNewProducto1").css("display", "inline");
                    $("#btnCaragarNewProducto2").css("display", "none");
                }
            }
            else {
                $("#btnCaragarNewProducto1").css("display", "none");
                $("#btnCaragarNewProducto2").css("display", "inline");
            }
        }
        else {
            $("#btnCaragarNewProducto1").css("display", "inline");
            $("#btnCaragarNewProducto2").css("display", "none");
        }
    }

    actualizarComprobanteNewProducto() {
        if ($("#selectFormaPagoNewProductoCheckin").val() == 2) {
            $("#comprobanteNewProductoCheckin").prop('disabled', false);
        }
        else {
            $("#comprobanteNewProductoCheckin").val('');
            $("#comprobanteNewProductoCheckin").prop('disabled', true);
        }
    }

    cargarNewProducto() {
        let selectProducto = $("#selectProductoNewCheckin").val();
        let selectProdText = $("#selectProductoNewCheckin option:selected").text();
        let selectFormaPagoNewProducto = $("#selectFormaPagoNewProductoCheckin").val();
        let selectFomaPagoText = $("#selectFormaPagoNewProductoCheckin option:selected").text();

        let valorProCheckin = $("#valorNewProductorCheckin").val();
        let valorPagProdCheckin = $("#valorPagoNewProducto").val();
        let saldoProCheckin = $("#saldoProductoNewCheckin").val();
        let selectFormaPagoCheckin = selectFormaPagoNewProducto;
        let comprobanteCheckin = $("#comprobanteNewProductoCheckin").val();
        let cantidad = $("#cantProductoNewCheckin").val();

        // Crear un array con los datos del servicio actual
        let nuevoServicio = [
            selectProdText,
            selectFomaPagoText,
            comprobanteCheckin,
            valorProCheckin,
            valorPagProdCheckin,
            saldoProCheckin,
            selectProducto,
            selectFormaPagoCheckin,
            cantidad,
        ];

        // Acumular servicios en el array, agregando el nuevo al inicio
        let key = 'newProductoCheckin';
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
        productosArray.unshift(nuevoServicio);
        localStorage.setItem(key, JSON.stringify(productosArray));

        // Limpiar los campos del formulario
        $("#selectProductoNewCheckin").val('');
        $("#valorPagoNewProducto").val('');
        $("#selectFormaPagoNewProductoCheckin").val('');
        $("#comprobanteNewProductoCheckin").val('');
        $("#saldoProductoNewCheckin").val('');
        $("#cantProductoNewCheckin").val('');
        $("#btnCaragarNewProducto1").css("display", "inline");
        $("#btnCaragarNewProducto2").css("display", "none");
        $("#comprobanteNewProductoCheckin").prop('disabled', true);
        $("#valorNewProductorCheckin").val('');

        FlashMessage.show('Servicio agregado correctamente', 'success');

        // Actualizar la tabla de servicios en el modal
        this.actualizarTablaNewProductos();

        $("#btnGuardarProductoNewCheckin").prop('disabled', false);
    }

    actualizarTablaNewProductos() {
        let key = 'newProductoCheckin';
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
        let tbody = this.nuevoProductoCheckinTarget.querySelector(`#productosNewCheckin`);
        tbody.innerHTML = ''; // Limpiar el contenido actual

        if (productosArray.length > 0) {
            productosArray.forEach((producto, i) => {
                let tr = document.createElement('tr');
                const valorPagado = Number(producto[4].replace(/[.,]/g, '')).toLocaleString('es-CO');
                const saldo = Number(producto[5].replace(/[.,]/g, '')).toLocaleString('es-CO');
                const valorServicio = Number(producto[4].replace(/[.,]/g, '')) + Number(producto[5].replace(/[.,]/g, ''));
                tr.innerHTML = `
                     <td>
                         <i class="fas fa-trash-alt text-danger" title="Eliminar" data-servicio-index="${i}" data-action="click->sistema--app#eliminarNewProducto"></i>
                     </td>
                     <td class="text-nowrap">
                         ${producto[0]}
                     </td>
                     <td class="text-nowrap">${producto[1]}</td>
                     <td class="text-nowrap">${producto[8]}</td>
                     <td class="text-nowrap">${producto[3]}</td>
                     <td class="text-nowrap" style="text-align:right;">$ ${valorServicio}</td>
                     <td class="text-nowrap" style="text-align:right;">$ ${valorPagado}</td>
                     <td class="text-nowrap" style="text-align:right;">$ ${saldo}</td>
                 `;
                tbody.appendChild(tr);
            });

        } else {
            tbody.innerHTML = '<tr><td colspan="7" style="text-align:center">No se han registrado servicios</td></tr>';
        }
    }

    eliminarNewProducto() {
        const servicioIndex = event.currentTarget.dataset.servicioIndex;

        let key = 'newProductoCheckin';
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
        productosArray.splice(servicioIndex, 1);

        localStorage.setItem(key, JSON.stringify(productosArray));
        // Actualizar la tabla
        this.actualizarTablaNewProductos();

        if (productosArray.length > 0) {
            $("#btnGuardarProductoNewCheckin").prop('disabled', false);
        }
        else {
            $("#btnGuardarProductoNewCheckin").prop('disabled', true);
        }
    }

    async guardarProductosNewCheckin() {
        let ruta = this.rutaAgregarProductoCheckinValue;

        let productosGuardados = localStorage.getItem('newProductoCheckin');
        let id = $("#idCheckProducto").val();

        let formData = new FormData();
        formData.append("producto", productosGuardados);
        formData.append("id", id);

        var consulta = await fetch(ruta, { method: 'POST', body: formData });
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.nuevoProductoCheckinTarget);

            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Producto agregado correctamente', 'success');

            let ruta = this.rutaReservasValue;
            const respuesta = await fetch(ruta);
            this.frameReservasTarget.innerHTML = await respuesta.text();
        }
    }

    async eliminarCheckin(event) {
        let id = event.currentTarget.dataset.id;
        let ruta = this.rutaEliminarCheckinValue;
        let rutaP = this.rutaReservasValue;

        ruta = ruta.replace('var1', id);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        if (result.response == 'Ok') {
            FlashMessage.show('Check-in eliminado correctamente', 'success');
            const respuesta = await fetch(rutaP);
            this.frameReservasTarget.innerHTML = await respuesta.text();
        }
    }

    async abrirModalNuevoMov() {
        this.modal = new Modal(this.modalNuevoMovimientoTarget);
        this.modal.show();
    }

    abrirModalBono() {

        $("#beneficiarioBono").val('');
        $("#valorBono").val('');
        $("#detalleBono").val('');
        $("#btnGuardarBono").prop('disabled', true);

        this.modal = new Modal(this.modalNuevoBonoTarget);
        this.modal.show();
    }

    validaBtnGuardarBono() {
        if ($("#beneficiarioBono").val() != '' && $("#valorBono").val() != '' && $("#detalleBono").val() != '') {
            $("#btnGuardarBono").prop("disabled", false);
        }
        else {
            $("#btnGuardarBono").prop("disabled", true);
        }
    }

    async registrarBono() {
        $("#btnGuardarBono").prop("disabled", true);

        let urlGuardar = this.rutaGuardarBonosValue;

        let formulario = '';

        formulario = this.formNewBonoTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        const modalInstance = Modal.getInstance(this.modalNuevoBonoTarget);

        if (modalInstance) { modalInstance.hide(); }

        $("#btnGuardarBono").prop("disabled", false);

        var ventas = result.tablaVentas;
        var tablaVentas = document.getElementById("tablaVentas");

        tablaVentas.innerHTML = "";

        ventas.forEach(function (item) {
            var tr = document.createElement("tr");

            var tdProducto = document.createElement("td");
            tdProducto.textContent = item.producto;
            tr.appendChild(tdProducto);

            var tdCantidad = document.createElement("td");
            tdCantidad.textContent = item.cantidad;
            tr.appendChild(tdCantidad);

            var tdValor = document.createElement("td");
            tdValor.textContent = '$ ' + item.valor.toLocaleString('es-CO');
            tdValor.style.cssText = "text-align: right";
            tr.appendChild(tdValor);

            tablaVentas.appendChild(tr);
        });

        var movimientos = result.tablaMov;
        var tablaMov = document.getElementById("tablaMov");

        tablaMov.innerHTML = "";
        let totalValor = 0;
        let totalPendiente = 0;
        let bonos = 0;

        movimientos.forEach(function (mov) {
            var tr = document.createElement("tr");

            var tdConcepto = document.createElement("td");
            tdConcepto.textContent = mov.concepto;
            tr.appendChild(tdConcepto);

            var tdValor = document.createElement("td");
            tdValor.textContent = '$ ' + mov.valor.toLocaleString('es-CO');
            tdValor.style.cssText = "text-align: right";
            tr.appendChild(tdValor);

            var tdpendiente = document.createElement("td");
            tdpendiente.textContent = '$ ' + mov.pendiente.toLocaleString('es-CO');
            tdpendiente.style.cssText = "text-align: right";
            tr.appendChild(tdpendiente);

            var tdBonos = document.createElement("td");
            tdBonos.textContent = '$ ' + mov.bono.toLocaleString('es-CO');
            tdBonos.style.cssText = "text-align: right";
            tr.appendChild(tdBonos);

            tablaMov.appendChild(tr);

            totalValor += mov.valor;
            totalPendiente += mov.pendiente;
            bonos += mov.bono;
        });

        var tr = document.createElement("tr");
        tr.classList.add("table-light");

        var tdConcepto = document.createElement("td");
        tdConcepto.textContent = 'Total';
        tdConcepto.style.cssText = "text-align: right; font-weight:bold";
        tr.appendChild(tdConcepto);

        var tdTotalValor = document.createElement("td");
        tdTotalValor.textContent = '$ ' + totalValor.toLocaleString('es-CO');
        tdTotalValor.style.cssText = "text-align: right; font-weight:bold";
        tr.appendChild(tdTotalValor);

        var tdTotalPendiente = document.createElement("td");
        tdTotalPendiente.textContent = '$ ' + totalPendiente.toLocaleString('es-CO');
        tdTotalPendiente.style.cssText = "text-align: right; font-weight:bold";
        tr.appendChild(tdTotalPendiente);

        var tdTotalBonos = document.createElement("td");
        tdTotalBonos.textContent = '$ ' + bonos.toLocaleString('es-CO');
        tdTotalBonos.style.cssText = "text-align: right; font-weight:bold";
        tr.appendChild(tdTotalBonos);

        tablaMov.appendChild(tr);
    }

    async cargarproductoVenta(event) {
        if ($("#detalleVenta").val() == 1) {
            let ruta = this.rutaObtenerProductoValue.replace('var1', event.currentTarget.value);

            var consulta = await fetch(ruta);
            var result = await consulta.json();

            $("#cantVenta").val('');
            $("#cantVenta").attr('placeholder', result.existencias);
            $("#valorUndVenta").val(result.valor.toLocaleString('es-CO'));

        }
        else {
            let ruta = this.rutaObtenerServicioValue.replace('var1', event.currentTarget.value);

            var consulta = await fetch(ruta);
            var result = await consulta.json();

            $("#cantVenta").val('');
            $("#cantVenta").attr('placeholder', '');
            $("#valorUndVenta").val(result.price.toLocaleString('es-CO'));
        }


    }

    async validaBtnRegistroVenta() {
        if ($("#detalleVenta").val() == 1) {
            if ($("#productoVenta").val() != '' && $("#cantVenta").val() != '' && $("#cantVenta").val() > 0) {
                $("#btnRegistroVenta").prop('disabled', false);
            }
            else {
                $("#btnRegistroVenta").prop('disabled', true);
            }
        }
        else {
            if ($("#servicioVenta").val() != '' && $("#cantVenta").val() != '' && $("#cantVenta").val() > 0) {
                $("#btnRegistroVenta").prop('disabled', false);
            }
            else {
                $("#btnRegistroVenta").prop('disabled', true);
            }
        }
    }

    calculoValProdVenta() {
        let valorUnd = $("#valorUndVenta").val();
        valorUnd = Number(valorUnd.replace(/\.|,/g, ''));

        let cant = $("#cantVenta").val();
        cant = Number(cant.replace(/\.|,/g, ''));

        let valor = valorUnd * cant;

        $("#valorVenta").val(valor.toLocaleString('es-CO'));
    }

    abrirModalCobrarBono(event) {
        let id = event.currentTarget.dataset.id;
        $("#idBonoCobro").val(id);
        this.modal = new Modal(this.modalcobrarBonoTarget);
        this.modal.show();
    }

    async cobrarBono() {
        let id = $("#idBonoCobro").val();
        let rutaTabla = this.rutaBonosValue;
        let ruta = this.rutaCobrarBonoValue;
        ruta = ruta.replace('var1', id);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.modalcobrarBonoTarget);
            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Bono cobrado correctamente', 'success');

            const respuesta = await fetch(rutaTabla);
            this.frameBonosTarget.innerHTML = await respuesta.text();
        }
    }

    abrirModalNuevoGasto() {
        this.modal = new Modal(this.modalNuevoGastoTarget);
        this.modal.show();
    }

    validaBtnGuardarGasto() {
        if ($("#valorGasto").val() != '' && $("#tipoGasto").val() != '') {
            this.btnGuardarGastoTarget.disabled = false;
        }
        else {
            this.btnGuardarGastoTarget.disabled = true;
        }
    }

    async guardarGasto() {
        let rutaTabla = this.rutaMovimientosValue;
        let urlGuardar = this.rutaGuardarGastoValue;

        let formulario = '';

        formulario = this.formNuevoGastoTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        const modalInstance = Modal.getInstance(this.modalNuevoGastoTarget);

        if (modalInstance) { modalInstance.hide(); }

        const respuesta = await fetch(rutaTabla);
        this.frameMovimentosTarget.innerHTML = await respuesta.text();


    }

    abrirModalContabilizarGasto(event) {
        let id = event.currentTarget.dataset.id;
        let tipo = event.currentTarget.dataset.tipo;
        let valor = event.currentTarget.dataset.valor;

        $("#idGasto").val(id);
        $("#nomGasto").text(tipo + ' ' + valor);

        this.modal = new Modal(this.modalContabilizaGastoTarget);
        this.modal.show();
    }

    async contabilizarGasto() {
        let rutaTabla = this.rutaMovimientosValue;
        let id = $("#idGasto").val();

        let ruta = this.rutaContabilizarGastoValue;
        ruta = ruta.replace('var1', id);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.modalContabilizaGastoTarget);
            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Gasto contabilizado correctamente', 'success');

            const respuesta = await fetch(rutaTabla);
            this.frameMovimentosTarget.innerHTML = await respuesta.text();
        }
    }

    abrirModalEliminarGasto(event) {

        let id = event.currentTarget.dataset.id;
        let tipo = event.currentTarget.dataset.tipo;
        let valor = event.currentTarget.dataset.valor;

        $("#idGastoEli").val(id);
        $("#nomGastoEli").text(tipo + ' ' + valor);

        this.modal = new Modal(this.modalEliminarGastoTarget);
        this.modal.show();
    }

    async eliminarGasto() {
        let rutaTabla = this.rutaMovimientosValue;
        let id = $("#idGastoEli").val();

        let ruta = this.rutaEliminarGastoValue;
        ruta = ruta.replace('var1', id);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.modalEliminarGastoTarget);
            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Gasto eliminado correctamente', 'success');

            const respuesta = await fetch(rutaTabla);
            this.frameMovimentosTarget.innerHTML = await respuesta.text();
        }
    }

    async cambiarEstadoHab(event) {
        let rutaTabla = this.rutaHabitacionesValue;
        let ruta = this.rutaCambiarEstadoHabitacionValue;
        let id = event.currentTarget.dataset.id;
        let accion = event.currentTarget.dataset.accion;
        ruta = ruta.replace('var1', id);
        ruta = ruta.replace('var2', accion);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const respuesta = await fetch(rutaTabla);
            this.frameHabitacionesTarget.innerHTML = await respuesta.text();
        }
    }

    async mostrarInforme() {

        let desde = this.desdeInformeTarget.value;
        let hasta = this.hastaInformeTarget.value;

        let rutaGenerar = this.rutaGenerarInformesValue;

        let formulario = '';

        formulario = this.formInformesTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(rutaGenerar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        $("#tablaInforme").empty();

        if (result.tipoInforme == 1) {

            let datos = result.data;

            datos = Object.values(datos);

            let servicio = '';

            if (this.servicioInformeTarget.value == '1') {
                servicio = ' - Hospedaje';
            }
            else if (this.servicioInformeTarget.value == '3') {
                servicio = ' - Tienda';
            }
            else if (this.servicioInformeTarget.value == '4') {
                servicio = ' - Lavandería';
            }

            let body = ``;
            let valorTotal = 0;

            datos.forEach(d => {
                body += `
                            <tr>
                                <td>${d.fecha}</td>
                                <td style="text-align:right">$ ${Number(d.valor).toLocaleString('es-CO')}</td>
                            </tr>
                        `
                valorTotal += Number(d.valor);
            });

            let tabla = `<div class="text-center mb-3">
                            <h6 class="fw-bold text-uppercase text-secondary mb-1">Informe de entradas consolidado ${servicio}</h6>
                            <p class="text-muted mb-0">Desde: <strong>01-10-2025</strong> &nbsp; | &nbsp; Hasta: <strong>31-10-2025</strong></p>
                        </div>
                        <div class="row justify-content-center">
                            <table class="table table-striped table-hover align-middle mb-0 table-sm mt-3" style="width: 500px;">
                                <thead class="table-dark" style="position: sticky; top: 0; z-index: 2;">
                                    <tr>
                                        <th style="background: #212529;">Fecha</th>
                                        <th style="background: #212529;">Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${body}
                                    <tr>
                                        <td style="font-weight:bold">TOTAL</td>
                                        <td style="text-align:right; font-weight:bold">$ ${valorTotal.toLocaleString('es-CO')}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>`;


            $("#tablaInforme").html(tabla);

        }
        else if (result.tipoInforme == 2) {

            let datos = result.data;

            datos = Object.values(datos);

            let body = ``;
            let valorTotal = 0;

            datos.forEach(d => {
                body += `
                            <tr>
                                <td>${d.tipo}</td>
                                <td style="text-align:right">$ ${Number(d.valor).toLocaleString('es-CO')}</td>
                            </tr>
                        `
                valorTotal += Number(d.valor);
            });

            let tabla = `<div class="text-center mb-3">
                            <h6 class="fw-bold text-uppercase text-secondary mb-1">Informe de entradas consolidado por servicio</h6>
                            <p class="text-muted mb-0">Desde: <strong>01-10-2025</strong> &nbsp; | &nbsp; Hasta: <strong>31-10-2025</strong></p>
                        </div>
                        <div class="row justify-content-center">
                            <table class="table table-striped table-hover align-middle mb-0 table-sm mt-3" style="width: 500px;">
                                <thead class="table-dark" style="position: sticky; top: 0; z-index: 2;">
                                    <tr>
                                        <th style="background: #212529;">tipo</th>
                                        <th style="background: #212529;">Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${body}
                                    <tr>
                                        <td style="font-weight:bold">TOTAL</td>
                                        <td style="text-align:right; font-weight:bold">$ ${valorTotal.toLocaleString('es-CO')}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>`;


            $("#tablaInforme").html(tabla);

        }
        else if (result.tipoInforme == 3) {

            let datos = result.data;

            datos = Object.values(datos);

            let body = ``;
            let valorTotal = 0;

            datos.forEach(d => {
                body += `
                            <tr>
                                <td>${d.tipo}</td>
                                <td style="text-align:right">$ ${Number(d.valor).toLocaleString('es-CO')}</td>
                            </tr>
                        `
                valorTotal += Number(d.valor);
            });

            let tabla = `<div class="text-center mb-3">
                            <h6 class="fw-bold text-uppercase text-secondary mb-1">Informe de gastos consolidado</h6>
                            <p class="text-muted mb-0">Desde: <strong>01-10-2025</strong> &nbsp; | &nbsp; Hasta: <strong>31-10-2025</strong></p>
                        </div>
                        <div class="row justify-content-center">
                            <table class="table table-striped table-hover align-middle mb-0 table-sm mt-3" style="width: 500px;">
                                <thead class="table-dark" style="position: sticky; top: 0; z-index: 2;">
                                    <tr>
                                        <th style="background: #212529;">Tipo</th>
                                        <th style="background: #212529;">Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${body}
                                    <tr>
                                        <td style="font-weight:bold">TOTAL</td>
                                        <td style="text-align:right; font-weight:bold">$ ${valorTotal.toLocaleString('es-CO')}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>`;


            $("#tablaInforme").html(tabla);

        }
        else if (result.tipoInforme == 4) {

            let datos = result.data;

            datos = Object.values(datos);

            let body = ``;
            let valorTotal = 0;

            datos.forEach(d => {
                const fecha = new Date(d.fechacrea);
                const fechaFormateada = fecha.toLocaleDateString('es-CO', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit'
                });
                body += `
                            <tr>
                                <td style="text-align:left">${fechaFormateada}</td>
                                <td style="text-align:left">${d.tipo}</td>
                                <td style="text-align:left">${d.detalles}</td>
                                <td style="text-align:right">$ ${Number(d.valor).toLocaleString('es-CO')}</td>
                            </tr>
                        `
                valorTotal += Number(d.valor);
            });

            let tabla = `<div class="text-center mb-3">
                            <h6 class="fw-bold text-uppercase text-secondary mb-1">Informe de gastos detallado</h6>
                            <p class="text-muted mb-0">Desde: <strong>${desde}</strong> &nbsp; | &nbsp; Hasta: <strong>${hasta}</strong></p>
                        </div>
                        <div class="row justify-content-center">
                            <table class="table table-striped table-hover align-middle mb-0 table-sm mt-3">
                                <thead class="table-dark" style="position: sticky; top: 0; z-index: 2;">
                                    <tr>
                                        <th style="background: #212529;">Fecha</th>
                                        <th style="background: #212529;">Tipo</th>
                                        <th style="background: #212529;">Detalle</th>
                                        <th style="background: #212529;">Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${body}
                                    <tr>
                                        <td colspan="3" style="font-weight:bold; text-align:right">TOTAL</td>
                                        <td style="text-align:right; font-weight:bold">$ ${valorTotal.toLocaleString('es-CO')}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>`;


            $("#tablaInforme").html(tabla);

        }
    }

    async descargarInforme() {
        let tipoInfo = this.tipoInformeTarget.value;
        let rutaGenerar = this.rutaDescargarInformesValue;

        let formulario = '';

        formulario = this.formInformesTarget;

        var parametros = new FormData(formulario);

        var respuesta = await fetch(rutaGenerar, { 'method': 'POST', 'body': parametros });

        // Recibir el archivo como BLOB
        const blob = await respuesta.blob();

        // Crear URL temporal
        const url = window.URL.createObjectURL(blob);

        // Crear link de descarga
        const a = document.createElement('a');
        a.href = url;

        if (tipoInfo == 3) {
            a.download = 'InfGastosCons.xlsx';
        }
        else if (tipoInfo == 4) {
            a.download = 'InfGastosDet.xlsx';
        }
        else if (tipoInfo == 1) {
            a.download = 'InfEntradasCons.xlsx';
        }
        else if (tipoInfo == 2) {
            a.download = 'InfEntradasConsxserv.xlsx';
        }
        else {
            a.download = 'Inf.xlsx';
        }

        document.body.appendChild(a);

        // Simular click
        a.click();

        // Limpiar
        a.remove();
        window.URL.revokeObjectURL(url);



    }

    abrirModalNuevoUsuario() {
        this.modal = new Modal(this.modalNuevoUsuarioTarget);
        this.modal.show();
    }

    async registrarUsuario() {
        let rutaTabla = this.rutaUsuariosValue;
        let urlGuardar = this.rutaRegistrarUsuariosValue;

        let formulario = '';

        formulario = this.formRegistroUsuarioTarget;

        var parametros = new FormData(formulario);

        var consulta = await fetch(urlGuardar, { 'method': 'POST', 'body': parametros });
        var result = await consulta.json();

        if (result.response == 'Ok') {

            const modalInstance = Modal.getInstance(this.modalNuevoUsuarioTarget);
            if (modalInstance) { modalInstance.hide(); }

            FlashMessage.show('Usuario creado correctamente', 'success');

            const respuesta = await fetch(rutaTabla);
            this.frameUsuariosTarget.innerHTML = await respuesta.text();
        }

    }

    limpiarInforme() {
        this.tipoInformeTarget.value = '';
        this.servicioInformeTarget.value = '';
        this.tipoGastoInformeTarget.value = '';
        this.empresaInformeTarget.value = '';

        const hoy = new Date();

        const formato = (f) => f.toISOString().split('T')[0];

        // Primer día del mes actual
        const primerDia = new Date(hoy.getFullYear(), hoy.getMonth(), 1);
        this.desdeInformeTarget.value = formato(primerDia);

        // Último día del mes actual
        const ultimoDia = new Date(hoy.getFullYear(), hoy.getMonth() + 1, 0);
        this.hastaInformeTarget.value = formato(ultimoDia);

        $("#tablaInforme").empty();
        let tabla = `<p style="font-weight: bold; color: grey;">Generar informe</p>`;
        $("#tablaInforme").html(tabla);
    }

    async cambiarTurnoUser(event) {
        let rutaTabla = this.rutaUsuariosValue;
        let id = event.currentTarget.dataset.id;
        let ruta = this.rutacambiaTurnoUserValue;

        let accion = 0;

        if (event.currentTarget.checked) {
            accion = 1;
        }

        ruta = ruta.replace('var1', id);
        ruta = ruta.replace('var2', accion);

        var consulta = await fetch(ruta);
        var result = await consulta.json();

        if (result.response == 'Ok') {

            FlashMessage.show('Usuario editado correctamente', 'success');

            const respuesta = await fetch(rutaTabla);
            this.frameUsuariosTarget.innerHTML = await respuesta.text();
        }



    }












}

