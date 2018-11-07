var chartBar;
var chartMarketPie;
var chartMarketSerial;

$(document).ready(function () {
	 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
     
 	$(".ts-sidebar-menu li a").each(function () {
 		if ($(this).next().length > 0) {
 			$(this).addClass("parent");
 		};
 	})
 	var menux = $('.ts-sidebar-menu li a.parent');
 	$('<div class="more"><i class="fa fa-angle-down"></i></div>').insertBefore(menux);
 	$('.more').click(function () {
 		$(this).parent('li').toggleClass('open');
 	});
	$('.parent').click(function (e) {
		e.preventDefault();
 		$(this).parent('li').toggleClass('open');
 	});
 	$('.menu-btn').click(function () {
 		$('nav.ts-sidebar').toggleClass('menu-open');
 	});
	 
	 
	var table = $('#zctb').DataTable( {
         "language": {
             "sProcessing":     "Procesando...",
             "sLengthMenu":     "Mostrar _MENU_ registros",
             "sZeroRecords":    "No se encontraron resultados",
             "sEmptyTable":     "Ningún dato disponible en esta tabla",
             "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
             "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
             "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
             "sInfoPostFix":    "",
             "sSearch":         "Filtro:",
             "sUrl":            "",
             "sInfoThousands":  ",",
             "sLoadingRecords": "Cargando...",
             "oPaginate": {
                 "sFirst":    "Primero",
                 "sLast":     "Último",
                 "sNext":     "Siguiente",
                 "sPrevious": "Anterior"
             },
             "oAria": {
                 "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                 "sSortDescending": ": Activar para ordenar la columna de manera descendente"
             },
             "columns":[
                {"name": "first", "order" : false}
            ],
         }
     } );

    var table_activity = $('.user_activity_table').DataTable( {
        "searching": false,
        "ordering": false,
        "responsive": true,
         "language": {
             "sProcessing":     "Procesando...",
             "sLengthMenu":     "Mostrar _MENU_ registros",
             "sZeroRecords":    "No se encontraron resultados",
             "sEmptyTable":     "Ningún dato disponible en esta tabla",
             "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
             "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
             "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
             "sInfoPostFix":    "",
             "sSearch":         "false",
             "sUrl":            "",
             "sInfoThousands":  ",",
             "sLoadingRecords": "Cargando...",
             "oPaginate": {
                 "sFirst":    "Primero",
                 "sLast":     "Último",
                 "sNext":     "Siguiente",
                 "sPrevious": "Anterior"
             },
             "oAria": {
                 "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                 "sSortDescending": ": Activar para ordenar la columna de manera descendente"
             },
         }
     } );

    var user_table_activity = $('.user_activity_info_table').DataTable( {
        "searching": false,
        "ordering": false,
        "responsive": true,
        "language": {
             "sProcessing":     "Procesando...",
             "sLengthMenu":     "Mostrar _MENU_ registros",
             "sZeroRecords":    "No se encontraron resultados",
             "sEmptyTable":     "Ningún dato disponible en esta tabla",
             "sInfo":           "",
             "sInfoEmpty":      "",
             "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
             "sInfoPostFix":    "",
             "sSearch":         "false",
             "sUrl":            "",
             "sInfoThousands":  ",",
             "sLoadingRecords": "Cargando...",
             "oPaginate": {
                 "sFirst":    "Primero",
                 "sLast":     "Último",
                 "sNext":     ">",
                 "sPrevious": "<"
             },
             "oAria": {
                 "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                 "sSortDescending": ": Activar para ordenar la columna de manera descendente"
             },
         }
     } );
	 
	 $("#input-1").fileinput({
        showPreview: false,
        allowedFileExtensions: ["csv", "xlsx"],
        elErrorContainer: "#errorBlock1",
        uploadAsync: false,
        msgInvalidFileExtension: "Archivo invalido, solo son validos archivos con extension CSV, XLSX",
        showUpload: false
        //uploadUrl: "http://local.riosfigueroa/products/process_import"
        // you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
    });

    $("#input-image").fileinput({
        showPreview: false,
        allowedFileExtensions: ["jpg", "png", "jpeg"],
        elErrorContainer: "#errorBlock2",
        uploadAsync: false,
        msgInvalidFileExtension: "Archivo invalido, solo son validos archivos con extension JPG, PNG, JPEG",
        showUpload: false
    });
    /*
    $(window).on('unload', function(){
        $.ajax({
            type: 'GET',
            url: '/updateTimer',
        });
    });*/
    setInterval(function(){
         $.ajax({
            type: 'GET',
            url: '/updateTimer',
        });
     }, 300000);

    $('body').on('click', '.resend-request', function(){
        let email = $(this).attr('email');
        $.ajax({
            type: 'POST',
            data: {
                'email': email,
                'panel': true
            },
            url: '/sendSubscriptionEmail',
            success: function(data){
                if(data['success'] != undefined){
                    $('.messages-resend').append(`
                        <div class="row">
                            <div class="alert alert-dismissible alert-success col-xs-10 col-xs-offset-1">
                                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                                <strong>Email enviado con exito a ${email}</strong>
                            </div>
                        </div>
                    `)
                }else{
                    $('.messages-resend').append(`
                        <div class="row">
                            <div class="alert alert-dismissible alert-warning col-xs-10 col-xs-offset-1">
                                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                                <strong>${data['error']}</strong>
                            </div>
                        </div>
                    `)
                }
            }
        });
    });

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////// Edicion de productos en la tabla //////////////////////////////////

    $('body').on('click', '.edit-products', function(e){
        $('.more-info-product').addClass('more-info-product-1').removeClass('more-info-product');
        $('.edit-cell').attr('contenteditable', 'true').css('color', 'red');
        $('.save-products, .cancel-products').removeClass('hidden');
        $(this).addClass('hidden');
        $('#zctb thead').css('pointer-events', 'none');
        $('.pagination').css('display', 'none');
        $('#zctb_length').find('select').attr('disabled', 'disabled');
        $('#zctb_filter').find('input').attr('disabled', 'disabled');
    })

    $('.save-products').click(function(){
        $('.more-info-product-1').addClass('more-info-product').removeClass('more-info-product-1');
        $('.edit-cell').attr('contenteditable', 'false').css('color', 'black');
        $('.cancel-products').addClass('hidden');
        $(this).addClass('hidden');
        $('.edit-products').removeClass('hidden');
        $('#zctb thead').css('pointer-events', '');
        $('.pagination').css('display', 'inline-block');
        $('#zctb_length').find('select').removeAttr('disabled');
        $('#zctb_filter').find('input').removeAttr('disabled', 'disabled');

        var info = {};
        $('.more-info-product').each(function(){
            var priceUni = $(this).find('.price-product-uni').text().includes('$') || $(this).find('.price-product-uni').text().length == 0 ? $(this).find('.price-product-uni').text() : '$' + $(this).find('.price-product-uni').text();
            var priceMed = $(this).find('.price-product-med').text().includes('$') || $(this).find('.price-product-med').text().length == 0 ? $(this).find('.price-product-med').text() : '$' + $(this).find('.price-product-med').text();
            info[$(this).attr('id')] = {'name': $(this).find('.name-product').text(), 'ingredents': $(this).find('.ing-product').text(), 'priceUni': priceUni, 'priceMed' : priceMed};
        })

        $.ajax({
            type: 'POST',
            url: '/updateProducts',
            dataType: 'json',
            success: function( data ) { 
                if(data['error']){
                    var nameError = data['response']['nameError'] ? 'All Products names are required \n' : '';
                    var ingError = data['response']['ingError'] ? 'All Ingredents names are required \n' : '';
                    var priceError = data['response']['priceError'] ? 'All Products prices are required' : '';
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-danger col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                  '<div><strong>'+ nameError +'</strong></div>'+
                                  '<div><strong>'+ ingError +'</strong></div>'+
                                  '<div><strong>'+ priceError +'</strong></div>'+
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                }else{
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-success col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>'+data['response']+'</strong>'+
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                }
            },
            data: {data: info},
        })

    })

    $('.cancel-products').click(function(){
        location.reload();
    });

    var allow_key_values = [8,37,39,48,49,50,51,52,53,54,55,56,57,188,190,96,97,98,99,100,101,102,103,104,105,110];
    $('.price-product-uni').keydown(function(e){
        if(allow_key_values.includes(e.keyCode)) return;
        else e.preventDefault();
    });

    ///////////////////////////////////////// Fin Edicion de productos en la tabla ///////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $('body').on('click', '.more-info-product', function(){
        var id = $(this).attr('id');
        $.ajax({
            type: "GET",
            url: '/productInfo/'+ id,
            success: function( data ) {         
                var modalInfo = '<div class="row">'+
                                    '<div class="col-sm-6">'+
                                        '<p><strong>Tipo de Producto:</strong> '+data['response'][0]['categorias']['nombre_categoria']+'</p>'+
                                        '<p><strong>Concentracion:</strong> '+data['response'][0]['concentracion']+'</p>'+
                                        '<p><strong>Empaque:</strong> '+data['response'][0]['empaque']+'</p>'+
                                    '</div>'+
                                    '<div class="col-sm-6">'+
                                        '<p><strong>Formulacion:</strong> '+data['response'][0]['formulacion']+'</p>'+
                                        '<p><strong>Unidad:</strong> '+data['response'][0]['unidad']+'</p>'+
                                    '</div>'+
                                    '<div class="col-sm-12"><p><strong>Nota:</strong> Precios expresados en pesos mexicanos*</p>'
                                '</div></div>';
                var modalTitle = data['response'][0]['nombre_producto'];
                $('.modal-title').html(modalTitle);
                $('#modal-extra-info .modal-body').html(modalInfo);
                $('#modal-extra-info').modal('show');
            }
        });
    })

     $('body').on('click', '.all-products-proveedor', function(){
        var id = $(this).attr('id');
        $.ajax({
            type: "GET",
            url: '/proveedorProducts/'+ id,
            success: function( data ) {
                var rows = '';
                var dataBody;
                data['response'].forEach(function(e, index){
                    dataBody = '<tr><td>'+(index+1)+'</td><td>'+e['nombre_producto']+'</td><td>'+e['ingrediente_activo']+'</td><td>'+e['categorias']['nombre_categoria']+'</td></tr>';
                    rows = rows + dataBody;
                })
                var modalInfo = '<div class="row">'+
                                    '<div class="col-sm-12">'+
                                        '<table class="table table-bordered table-striped">'+
                                            '<thead>'+
                                                '<tr>'+
                                                    '<th>#</th>'+
                                                    '<th>Nombre Producto</th>'+
                                                    '<th>Ingrediente Activo</th>'+
                                                    '<th>Tipo de producto</th>'+
                                                '</tr>'+
                                            '</thead>'+
                                            '<tbody>'+rows+'</tbody>'+
                                        '</table>'+
                                    '</div>'+
                                '</div>';
                var modalTitle = data['response'][0]['proveedores']['nombre_proveedor'];
                $('.modal-title').html(modalTitle);
                $('#modal-extra-info .modal-body').html(modalInfo);
                $('#modal-extra-info').modal('show');
            }
        });
    })

    $('.modal-analisis').click(function(){
       $('#modal-analisis').modal('show');
    })
    /*
    $('body').on('click', '.active-user', function(){
        var element = $(this);
        var id = $(this).attr('id');
        var user_email = $(this).closest('tr').find('#email').html();
        var row_state = $(this).closest('tr').find('#state');
        var state = $(this).attr('state');
        var message_state = state === '1' ? 'Activo' : 'Inactivo';
        $.ajax({
            type: "GET",
            url: '/activateUser/'+ id +'/'+ state,
            success: function( data ) {
                if(data['response'] === 1){
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-success col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Usuario '+ user_email + ' '+ message_state +' con exito</strong>'+
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                    row_state.text(message_state);
                    state === '0' ? element.html('&nbsp; Activar &nbsp;').removeClass('btn-danger').addClass('btn-success').attr('state', 1) : element.text('Desactivar').removeClass('btn-success').addClass('btn-danger').attr('state', 0);
                }else{
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-warning col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Ocurrio un error al intentar activar/desactivar al usuario '+ user_email +
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                }
            }
        });
    });*/

    $('body').on('click', '.active-user', function(){
        var element = $(this);
        var id = $(this).attr('id');
        var user_email = $(this).closest('tr').find('#email').html();
        var row_state_active = $(this).closest('tr').find('#state-active');
        var state = $(this).attr('state');
        var message_state = state === '1' ? 'Activo' : 'Inactivo';
        $.ajax({
            type: "GET",
            url: '/activateUser/'+ id +'/'+ state,
            success: function( data ) {
                if(data['response'] === 1){
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-success col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Usuario '+ user_email + ' '+ message_state +' con exito</strong>'+
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                    row_state_active.text(message_state);
                    state === '0' ? element.removeClass('action-desactive').addClass('action-active').attr('state', 1).attr('title', 'activar').find('i').removeClass('fa-times').addClass('fa-check') : element.removeClass('action-active').addClass('action-desactive').attr('state', 0).attr('title', 'desactivar').find('i').removeClass('fa-check').addClass('fa-times');
                }else{
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-warning col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Ocurrio un error al intentar activar/desactivar al usuario '+ user_email +
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                }
            }
        });
    });

    $('body').on('click', '.delete-user', function(){
        var id = $(this).attr('id');
        var row = $(this).closest('tr');
        var user_email = $(this).closest('tr').find('#email').html();
        $.ajax({
            type: "GET",
            url: '/deleteUser/'+ id,
            success: function( data ) {
                if(data['response'] === 1){
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-success col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Usuario '+ user_email +' Elmininado con exito</strong>'+
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                    table.row(row).remove().draw();
                 }else{
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-warning col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Ocurrio un error al intentar activar/desactivar al usuario '+ user_email +
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                }
            }
        });
    });

    $('body').on('click', '.delete-image', function(){
        var id = $(this).attr('id');
        var row = $(this).closest('tr');
        $.ajax({
            type: "GET",
            url: '/deleteImage/'+ id,
            success: function( data ) {
                if(data['response'] === 1){
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-success col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Imagen eliminada con exito</strong>'+
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                    table.row(row).remove().draw();
                 }else{
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-warning col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Ocurrio un error al intentar eliminar la imagen</div>'+
                        '</div>'
                    ).fadeIn(1000);
                }
            }
        });
    });

    $('body').on('click', '.more-info-analysis', function(){

        var img = '<img class=" img-responsive" src="'+$(this).attr('path')+'" width="820px" height="530px">';
        var modalTitle = 'Análisis de imagen:';
        $('.modal-title').html(modalTitle);
        $('#modal-analisis .modal-body').html(img);
        $('#modal-analisis').modal('show');
    })

    //###############################################################################################################
    //##################################### Incio Graficas Analisis Importacionjes ##################################
    //###############################################################################################################
    var Toneladas_trimestre = [];
    var Unit = '';
    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimunFractionDigits: 2,
    });
    if(document.getElementById('chartAnalisisHistorico') !== null){
        var ctx = document.getElementById('chartAnalisisHistorico').getContext('2d');
        var tons = {'T1': 1, 'T2': 2, 'T3': 3, 'T4': 4};
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'horizontalBar',

            // The data for our dataset
            data: {
                labels: ['T1', 'T2', 'T3', 'T4'],
                datasets: [{
                    label: 'Test',
                    backgroundColor: ['rgba(2, 136, 31, 1)', 'rgba(2, 136, 31, 1)', 'rgba(2, 136, 31, 1)', 'rgba(2, 136, 31, 1)'],
                    borderColor: ['rgba(2, 136, 31, 1)', 'rgba(2, 136, 31, 1)', 'rgba(2, 136, 31, 1)', 'rgba(2, 136, 31, 1)'],
                    data: [],
                    xAxisID: 0
                },
                {
                    label: 'Test',
                    backgroundColor: ['rgba(25, 31, 210, 1)', 'rgba(25, 31, 210, 1)', 'rgba(25, 31, 210, 1)', 'rgba(25, 31, 210, 1)'],
                    borderColor: ['rgba(25, 31, 210, 1)', 'rgba(25, 31, 210, 1)', 'rgba(25, 31, 210, 1)', 'rgba(25, 31, 210, 1)'],
                    data: [],
                    xAxisID: 0
                },
                {
                    label: 'Test',
                    backgroundColor: ['rgba(255, 110, 7, 1)', 'rgba(255, 110, 7, 1)', 'rgba(255, 110, 7, 1)', 'rgba(255, 110, 7, 1)'],
                    borderColor: ['rgba(255, 110, 7, 1)', 'rgba(255, 110, 7, 1)', 'rgba(255, 110, 7, 1)', 'rgba(255, 110, 7, 1)'],
                    data: [],
                    xAxisID: 0
                },
                {
                    label: 'Test',
                    backgroundColor: ['rgba(255, 37, 37, 1)', 'rgba(255, 37, 37, 1)', 'rgba(255, 37, 37, 1)', 'rgba(255, 37, 37, 1)'],
                    borderColor: ['rgba(255, 37, 37, 1)', 'rgba(255, 37, 37, 1)', 'rgba(255, 37, 37, 1)', 'rgba(255, 37, 37, 1)'],
                    data: [],
                    xAxisID: 0
                }]
            },
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 1.5,
                    },
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            offsetGridLines: true,
                        },
                        stacked: true,
                        display: false,
                    }],
                    yAxes: [{
                        stacked: true,
                        barThickness: 40,
                    }]
                },
                legend: {
                    display: false,
                },
                responsive: true,
                tooltips: {
                    enabled: false,
                },
            }

            // Configuration options go here
        });
        Chart.plugins.register({
            afterDraw: function(chart, easing) {
                // To only draw at the end of animation, check for easing === 1
                var ctx = chart.ctx;

                chart.data.datasets.forEach(function (dataset, i) {
                    var meta = chart.getDatasetMeta(i);

                    var control_flow = true;
                    if (!meta.hidden) {
                        meta.data.forEach(function(element, index) {
                            // Draw the text in black, with the specified font
                            if(dataset.data[index] != 0 && control_flow){
                                control_flow = false;
                                
                                var fontSize = 15;
                                var fontStyle = 'bold';
                                var fontFamily = 'Roboto';
                                ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);
                                ctx.textBaseline = 'middle';
                                var padding = 0;
                                var position = element.tooltipPosition();

                                if(dataset.data[index] != 'x'){
                                    // Just naively convert to string for now
                                    var precioPromedio = formatter.format( dataset.data[index]);
                                    var unidad = Unit == 'kilogramo' ? 'Tons' : 'Litros';
                                    var ton_tri = formatter.format(Toneladas_trimestre[i]).replace('$', '') + ' ' + unidad;

                                    // Make sure alignment settings are correct
                                    var positionX = (element._model.x-30)/8 <= precioPromedio.length + 1 ? position.x + 5 :  position.x - 5;
                                    ctx.textAlign = (element._model.x-30)/8 <= precioPromedio.length + 1 ? 'left' : 'right';
                                    ctx.fillStyle = (element._model.x-30)/8 <= precioPromedio.length + 1 ? 'rgb(0,0,0)' : 'rgb(255,255,255)';
                                    ctx.fillText(precioPromedio, positionX, position.y - (fontSize / 3) - padding + 5);

                                    ctx.fillStyle = 'rgb(0, 0, 0)';
                                    var positionX1 = (element._model.x-30)/8  <= ton_tri.length ? 35 : position.x;
                                    ctx.textAlign = (element._model.x-30)/8  <= ton_tri.length ? 'left' : 'right';
                                    ctx.fillText(ton_tri, positionX1, position.y + 33 - (fontSize / 2) - padding + 5);
                                    
                                }else{
                                    // Make sure alignment settings are correct
                                    var text = 'Sin Importaciones Registradas';
                                    ctx.textAlign = 'left';
                                    ctx.fillStyle = dataset.backgroundColor[0];/*'rgb(100, 211, 255)'  'rgb(189, 149, 243)'*/;
                                    ctx.fillText(text, 35, position.y);
                                }
                            }
                        });
                    }
                });
            }
        });

        function addData(chart, precio_prom_mes, volumen_mes, trimestres, unidad) {
            chart.data.datasets.forEach(function(datasets){
                datasets.data = [];
            })

           t1 = [0,0,0,0];
            t2 = [0,0,0,0];
            t3 = [0,0,0,0];
            t4 = [0,0,0,0];;

            precio_prom_mes.forEach(function(value, key){
                if(value != 0){
                    if(key == 0 ) t1[0] = value;
                    if(key == 1){
                        t1[1] = t1[0] == 'x' ? 0 : t1[0];
                        t2[1] = value;
                    }
                    if(key == 2){
                        t1[2] = t1[0] == 'x' ? 0 : t1[0];
                        t2[2] = t2[1] == 'x' ? 0 : t2[1];
                        t3[2] = value;
                    }
                    if(key == 3){
                        t1[3] = t1[0] == 'x' ? 0 : t1[0];
                        t2[3] = t2[1] == 'x' ? 0 : t2[1];
                        t3[3] = t3[2] == 'x' ? 0 : t3[2];
                        t4[3] = value;
                    }
                }else{
                    if(key == 0 ) t1[0] = 'x';
                    if(key == 1 ) t2[1] = 'x';
                    if(key == 2 ) t3[2] = 'x';
                    if(key == 3 ) t4[3] = 'x';
                }
            })
            chart.data.datasets[0].data = t1;
            chart.data.datasets[1].data = t2;
            chart.data.datasets[2].data = t3;
            chart.data.datasets[3].data = t4;
            Toneladas_trimestre = volumen_mes;
            Unit = unidad;
            chart.update();
        }


        $('#analisisCategoriasHistorico').change(function(e){
            var categoria_id = $(this).val();
            var ingrediente_select = $('#selectAnalisisIngredienteHistorico');
            ingrediente_select.empty();
            $('#selectAnalisisYearHistorico').empty();
            $.ajax({
                type: "GET",
                url: '/getIngredientes/'+ categoria_id,
                success: function( data ) {
                    if(data['years'] != []) ingrediente_select.append($('<option></option>').attr('value', 'empty').text(''));
                    Object.keys(data['ingredientes']).forEach(function(key){
                        ingrediente_select.append($('<option></option>').attr('value', key).text(data['ingredientes'][key]));
                    });
                }
            });
        })

        $('#selectAnalisisIngredienteHistorico').change(function(e){
            var year_select = $('#selectAnalisisYearHistorico');
            var ingrediente_select = $('#selectAnalisisIngredienteHistorico').val();
            year_select.empty();
            $.ajax({
                type: "GET",
                url: '/getYears/'+ ingrediente_select,
                success: function( data ) {
                    if(data['years'] != []) year_select.append($('<option></option>').attr('value', 'empty').text(''));
                    data['years'].forEach(function(e){
                        year_select.append($('<option></option>').attr('value', e).text(e));
                    });
                }
            });
        })

        $('#update-graphic-historic').click(function(e){
            e.preventDefault();
            var ingrediente = $('#selectAnalisisIngredienteHistorico');
            var year = $('#selectAnalisisYearHistorico');
            ingrediente.val() == 'empty' ? ingrediente.closest('.form-group').addClass('has-error').find('.help-block').fadeIn() : ingrediente.closest('.form-group').removeClass('has-error').find('.help-block').fadeOut();
            year.val() == 'empty' ? year.closest('.form-group').addClass('has-error').find('.help-block').fadeIn() : year.closest('.form-group').removeClass('has-error').find('.help-block').fadeOut();
            if(ingrediente.val() != 'empty' && year.val() != 'empty'){
                $.ajax({
                    type: "GET",
                    url: '/updateAnalysisHistoric/'+ ingrediente.val() + '/' + year.val(),
                    success: function( data ) {
                        var unidad = data['unit'] == 'kilogramo' ? ' Tons' : ' Litros';
                        addData(chart, data['precio_prom_mes'], data['volumen_mes'], data['trimestres'], data['unit']);
                        $('#importaciones_precio_total').text(formatter.format(data['precio_total_prom']).replace('$', ''));
                        $('#importaciones_volumen_total').text(formatter.format(data['volumen_total']).replace('$', '') + unidad);
                    }
                });
            }
        });
    }
    //##############################################################################################################
    //########################################### Fin Graficas #####################################################
    //############################################################################################################## 

    //##############################################################################################################
    //##################################### Incio Graficas Analisis Precios ########################################
    //##############################################################################################################

    //inicializacion de la grafica tipo bar para los cuartiles

    AmCharts.ready(function () {
        chartBar = new AmCharts.AmSerialChart();
        chartBar.balloon = {
            "fillAlpha": 1
        };
        chartBar.categoryField = "title",
        chartBar.chartCursor = {
            "oneBalloonOnly": true,
        };
        chartBar.chartScrollbar = {
            "updateOnReleaseOnly": true,
            "dragIconWidth": 25,
            "dragIconHeight": 25,
            "scrollbarHeight": 10,
        };
        
        chartBar.creditsPosition = "top-right";
        chartBar.dataProvider = [];
        chartBar.fontFamily = "Roboto, Helvetica Neue, Helvetica, Arial, sans-serif";

        chartBar.listeners = [{
            "event": "dataUpdated",
            "method": function(e){
                e.chart.zoomToIndexes(0, 25);
            }
        }];
        chartBar.mouseWheelScrollEnabled = true;

        chartBar.rotate =  true;
        chartBar.startAlpha = 0.8;
        chartBar.startDuration = 0.5;
        chartBar.startEffect = "easeOutSine";

        chartBar.titles = [{
            "text": "Analísis Cuartiles",
            "size": 13,
            "bold": false
        }];

        chartBar.type = "serial";
        chartBar.valueAxes = [{
            'includeAllValues': true,
        }];

        chartBar.zoomOutText = "";
        
        chartBar.write('bar-cuartil');
    });

    if(document.getElementById('chartAnalisisCategoria') !== null){
        var tooltip_option = 1;
        var ctx = document.getElementById('chartAnalisisCategoria').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: [],
                datasets: [{
                    label: 'Historico de Precios',
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(12, 82, 0, 0.5)',
                    lineTension: 0,
                    pointBackgroundColor: 'rgba(12, 82, 0, 1)',
                    pointRadius: 5,
                    data: [],
                }]
            },

            // Configuration options go here
            options: {
                spanGaps: true,
                scales: {
                    xAxes: [{
                        //offset: true,
                    }],
                    yAxes: [{
                        ticks: {
                            callback: function(value, index, values){
                                //var format_number = formatter.format(value);
                                //var i = format_number.indexOf('.');
                                //return format_number.substring(0, i);
                                return formatter.format(value);
                            }
                        }
                    }]
                },
                tooltips: {
                    enabled: false,
                    mode: 'index',
                    position: 'nearest',
                    yPadding: 10,
                    xPadding: 10,
                    intersect: false,
                    custom: function(tooltip) {
                        // Tooltip Element
                        var tooltipEl = document.getElementById('chartjs-tooltip');

                        // Create element on first render
                        if (!tooltipEl) {
                            tooltipEl = document.createElement('div');
                            tooltipEl.id = 'chartjs-tooltip';
                            tooltipEl.innerHTML = "<table></table>"
                            this._chart.canvas.parentNode.appendChild(tooltipEl);
                        }

                        // Hide if no tooltip
                        if (tooltip.opacity === 0) {
                            tooltipEl.style.opacity = 0;
                            return;
                        }

                        // Set caret Position
                        tooltipEl.classList.remove('above', 'below', 'no-transform');
                        if (tooltip.yAlign) {
                            tooltipEl.classList.add(tooltip.yAlign);
                        } else {
                            tooltipEl.classList.add('no-transform');
                        }

                        function getBody(bodyItem) {
                            return bodyItem.lines;
                        }

                        // Set Text
                        if (tooltip.body) {
                            var titleLines = tooltip.title || [];
                            var bodyLines = tooltip.body.map(getBody);

                            if(tooltip_option == 1){
                               var innerHtml = '<caption style="text-align: center">Precio K/L</caption><thead>';
                                innerHtml += '</thead><tbody>';

                                bodyLines.forEach(function(body, i) {
                                    var indexBody = body[0].indexOf(':');
                                    bodyX = formatter.format(body[0].substr(indexBody + 1));
                                    bodyTitle = body[0].substr(0, indexBody);
                                    var colors = tooltip.labelColors[i];
                                    var style = 'background:' + colors.backgroundColor;
                                    style += '; border-color:' + colors.borderColor;
                                    style += '; border-width: 2px';
                                    var span = '<span class="chartjs-tooltip-key" style="' + style + '"></span>';
                                    innerHtml += '<tr><td>' + span + '<strong>'+ bodyTitle +':</strong><span style="color: #57bd64;"> ' + bodyX + '</span></td></tr>';
                                });
                                innerHtml += '<tr><td style="text-align: center"><strong>Update:</strong> <span style="color: #57bd64;"> ' + titleLines[0] + '</span></td></tr>';
                                innerHtml += '</tbody>'; 
                            }else if(tooltip_option == 0){
                                var innerHtml = '<thead>';
                                innerHtml += '</thead><tbody>';

                                bodyLines.forEach(function(body, i) {
                                    var indexBody = body[0].indexOf(':');
                                    bodyX = formatter.format(body[0].substr(indexBody + 1));
                                    var colors = tooltip.labelColors[i];
                                    var style = 'background:' + colors.backgroundColor;
                                    style += '; border-color:' + colors.borderColor;
                                    style += '; border-width: 2px';
                                    var span = '<span class="chartjs-tooltip-key" style="' + style + '"></span>';
                                    innerHtml += '<tr><td>' + span + '<strong>Precio K/L:</strong><span style="color: #57bd64;"> ' + bodyX + '</span></td></tr>';
                                    innerHtml += '<tr><td>' + span + '<strong>Update:</strong> <span style="color: #57bd64;"> ' + titleLines[0] + '</span></td></tr>';
                                });
                                innerHtml += '</tbody>'; 
                            }

                            var tableRoot = tooltipEl.querySelector('table');
                            tableRoot.innerHTML = innerHtml;
                        }

                        // `this` will be the overall tooltip
                        var positionY = this._chart.canvas.offsetTop;
                        var positionX = this._chart.canvas.offsetLeft;

                        // Display, position, and set styles for font
                        tipo_analisis = $('#analisisEspecifico').val();
                        tooltipEl.style.opacity = 1;
                        tooltipEl.style.left = positionX + tooltip.caretX + 'px';
                        tooltipEl.style.top = positionY + tooltip.caretY + 'px';
                        tooltipEl.style.width = tipo_analisis == 5 || tipo_analisis == 6 ? '200px': '170px';
                        tooltipEl.style.fontFamily = tooltip._fontFamily;
                        tooltipEl.style.fontSize = tooltip.fontSize;
                        tooltipEl.style.fontStyle = tooltip._fontStyle;
                        tooltipEl.style.padding = tooltip.yPadding + 'px ' + tooltip.xPadding + 'px';
                    }
                }
            }
        });

        /*
        Chart.plugins.register({
            afterDraw: function(chart, easing) {
                // To only draw at the end of animation, check for easing === 1
                var ctx = chart.ctx;

                var invert = true;
                chart.data.datasets.forEach(function (dataset, i) {
                    var meta = chart.getDatasetMeta(i);
                    if (!meta.hidden) {
                        meta.data.forEach(function(element, index) {
                            // Draw the text in black, with the specified font
                            if(dataset.data[index] != 0){
                                var fontSize = 13;
                                var fontStyle = 'bold';
                                var fontFamily = 'Roboto';
                                ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                                // Just naively convert to string for now
                                var precioPromedio = formatter.format( dataset.data[index]) + ' K/L';

                                // Make sure alignment settings are correct
                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'middle';
                                var padding = 0;
                                var position = element.tooltipPosition();
                                var positionX = position.x + (precioPromedio.length/2);
                                var positionY = invert ? position.y + 20 : position.y - 20;
                                ctx.fillStyle = 'rgba(0,0,0,0.4)';
                                ctx.fillRect(position.x - precioPromedio.length * 4, positionY - 10, precioPromedio.length * 9, 20);
                                ctx.fillStyle = 'rgba(12, 82, 0, 1)';
                                ctx.fillText(precioPromedio, positionX, positionY - (fontSize / 3) - padding + 5);
                                invert = !invert;
                            }
                        });
                    }
                });
            }
        });
        */

        function addData(chart, label, data) {
            tipo_analisis = $('#analisisEspecifico').val();
            chart.data.labels = label;
            chart.data.datasets = [];

            var min = 0;
            var max = 0;
            /*
            data[0].forEach(function(value){
                min = value < min ? value : min;
                max = value > max ? value : max;
            })

            data[1].forEach(function(value){
                min = value < min ? value : min;
                max = value > max ? value : max;
            })*/

            title2 = $('#analisisEspecifico').val() == 5 ? $('#analisisProductoSelect2').val() : $('#analisisIngredienteSelect2').val();

            if(tipo_analisis < 5){
                var data1 = {
                    label: 'Historico de Precios',
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(255, 37, 37, 1)',
                    lineTension: 0,
                    pointBackgroundColor: 'rgba(255, 37, 37, 1)',
                    pointRadius: 5,
                    data: data[0],
                }
                chart.data.datasets.push(data1);
                tooltip_option = 0;
            }else if(tipo_analisis == 5 || tipo_analisis == 6){
                var data1 = {
                    label: $('#analisisProductoSelect').val(),
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(255, 37, 37, 1)',
                    lineTension: 0,
                    pointBackgroundColor: 'rgba(255, 37, 37, 1)',
                    pointRadius: 5,
                    data: data[0],
                }

                var data2 = {
                    label: title2,
                    backgroundColor: 'rgba(155, 155, 155, 0)',
                    borderColor: 'rgba(25, 31, 210, 1)',
                    lineTension: 0,
                    pointBackgroundColor: 'rgba(25, 31, 210, 1)',
                    pointRadius: 5,
                    data: data[1],
                }
                tooltip_option = 1;
                chart.data.datasets.push(data1);
                chart.data.datasets.push(data2);
                //chart.options.scales.yAxes[0].ticks.max = max + ((max - min) / 3);
                //chart.options.scales.yAxes[0].ticks.min = min - 100;
            }
            chart.update();
        }

        $('#analisisCategorias').change(function(){
            company =  $('#analisisCompany').val();
            if(company != 'empty'){
               $('#analisisCompany').trigger('change');
            }
        })

        $('#analisisCategorias2').change(function(){
            company =  $('#analisisCompany2').val();
            if(company != 'empty'){
               $('#analisisCompany2').trigger('change');
            }
        })

        $('#analisisTipo').change(function(){
            if($(this).val() == 'producto'){
                $('#analisisProducto').fadeIn(1000);
                $('#analisisIngrediente').fadeOut(1);
            }else{
                $('#analisisProducto').fadeOut(1);
                $('#analisisIngrediente').fadeIn(1000);
            }
        })

        $('#analisisCompany').change(function(){
            var company_id = $(this).val();
            var category_name = $('#analisisCategorias').val();
            var product_select = $('#analisisProductoSelect');
            var ingrediente_select = $('#analisisIngredienteSelect');
            var analisis_especifico = $('#analisisEspecifico').val();
            product_select.empty();
            ingrediente_select.empty();
            product_select.append($('<option></option>').attr('value', 'empty').text(''));
            ingrediente_select.append($('<option></option>').attr('value', 'empty').text(''));
            tmp_url = analisis_especifico != 7 ? '/getProducts/'+ category_name +'/'+ company_id : '/getIngredientsForCuartiles/'+ category_name +'/'+ company_id;
            $.ajax({
                type: "GET",
                url: tmp_url,
                success: function( data ) {
                    data['products'].forEach(function(e){
                        product_select.append($('<option></option>').attr('value', e).text(e));
                    });
                    data['ingredients'].forEach(function(e){
                        ingrediente_select.append($('<option></option>').attr('value', e).text(e));
                    });
                }
            });
        })

        $('#analisisCompany2').change(function(){
            var company_id = $(this).val();
            var category_name = $('#analisisCategorias2').val();
            var product_select = $('#analisisProductoSelect2');
            var ingrediente_select = $('#analisisIngredienteSelect2');
            ingrediente_select.empty();
            product_select.empty();
            product_select.append($('<option></option>').attr('value', 'empty').text(''));
            ingrediente_select.append($('<option></option>').attr('value', 'empty').text(''));
            $.ajax({
                type: "GET",
                url: '/getProducts/'+ category_name +'/'+ company_id,
                success: function( data ) {
                    data['products'].forEach(function(e){
                        product_select.append($('<option></option>').attr('value', e).text(e));
                    });
                    data['ingredients'].forEach(function(e){
                        ingrediente_select.append($('<option></option>').attr('value', e).text(e));
                    });
                }
            });
        })

        $('#analisisEspecifico').change(function(){
            var analisis = $(this).val();
            $('#bar-cuartil, #bar-more').addClass('hide');
            $('.chart-container, #analisisTiempoGroup').removeClass('hide');
            $('#analisisTipo, #analisisCompany').attr('disabled', false);
            if(analisis == 5){
                $('#analisisCompanyG2, #analisisProducto2, #analisisProducto, #categoria2').removeClass('hide').fadeIn();
                $('#analisisTipo').val('producto');
                $('#analisisTipoG, #analisisIngrediente, #analisisIngrediente2').fadeOut();
            }else if(analisis == 6){
                $('#analisisCompanyG2, #analisisProducto, #analisisIngrediente2, #categoria2').removeClass('hide').fadeIn();
                $('#analisisTipo').val('producto');
                $('#analisisTipoG, #analisisIngrediente, #analisisProducto2').fadeOut();
            }else if(analisis == 7){
                chartBar.dataProvider = [{'value': 0, 'title': 'product'}];
                chartBar.validateData();
                chartBar.animateAgain();
                $('#analisisCompanyG2, #analisisProducto2, #categoria2, #analisisIngrediente2, #analisisTiempoGroup, .chart-container').addClass('hide');
                $('#bar-cuartil, #bar-more, #analisisTipoG').removeClass('hide').fadeIn();
                $('#analisisTipo').val("ingrediente").attr('disabled', 'disabled').trigger('change');
                $('#analisisCompany').attr('disabled', 'disabled');
            }else{
                $('#analisisCompanyG2, #analisisProducto2, #categoria2, #analisisIngrediente2').fadeOut();
                $('#analisisTipoG').fadeIn();
            }
            $('#analisisCompany').val("todas").trigger('change');
        })

        $('#update-graphic-precio').click(function(e){
            e.preventDefault();
            var category_name = $('#analisisCategorias').val();
            var analisis_especifico = $('#analisisEspecifico').val();
            var tipo_analisis = $('#analisisTipo').val();
            var producto_ingrediente = tipo_analisis == "producto" ? $('#analisisProductoSelect') : $('#analisisIngredienteSelect');
            var producto_ingrediente2 = analisis_especifico == 5 ? $('#analisisProductoSelect2') : $('#analisisIngredienteSelect2'); 
            var compania = $('#analisisCompany');
            var compania2 = $('#analisisCompany2');

            var tiempo = $('#analisisTiempo').val();
            
            producto_ingrediente.val() == 'empty' ? producto_ingrediente.closest('.form-group').addClass('has-error').find('.help-block').fadeIn() : producto_ingrediente.closest('.form-group').removeClass('has-error').find('.help-block').fadeOut();
            compania.val() == 'empty' ? compania.closest('.form-group').addClass('has-error').find('.help-block').fadeIn() : compania.closest('.form-group').removeClass('has-error').find('.help-block').fadeOut();
            
            if(analisis_especifico == 5 || analisis_especifico == 6){
                producto_ingrediente2.val() == 'empty' ? producto_ingrediente2.closest('.form-group').addClass('has-error').find('.help-block').fadeIn() : producto_ingrediente2.closest('.form-group').removeClass('has-error').find('.help-block').fadeOut();
                compania2.val() == 'empty' ? compania2.closest('.form-group').addClass('has-error').find('.help-block').fadeIn() : compania2.closest('.form-group').removeClass('has-error').find('.help-block').fadeOut();
                if(producto_ingrediente2.val() == 'empty' || compania2.val() == 'empty') return;
            }

            if(producto_ingrediente.val() == 'empty' || compania.val() == 'empty') return;
            $.ajax({
                type: "GET",
                url: '/updateAnalysisPrice/'+ category_name +'/'+ analisis_especifico +'/'+ tipo_analisis +'/'+ encodeURIComponent(producto_ingrediente.val()) +'/'+ compania.val() +'/'+ tiempo +'/'+ encodeURIComponent(producto_ingrediente2.val()) +'/'+ compania2.val(),
                success: function( data ) {
                    data['values'] = data['values'].map(function(e){
                        return e == 'NaN' ? NaN : e;
                    })
                    data['values2'] = data['values2'].map(function(e){
                        return e == 'NaN' ? NaN : e;
                    })
                    if(data['dates'].length > 0){
                        addData(chart, data['dates'], [data['values'], data['values2']],);
                    }

                    if(data['cuartiles'] != undefined){
                        chartBar.addLegend({
                            "fontSize": 12,
                            "data": [
                                {
                                    "title": "Cuartil 1",
                                    "color": data['colors'][0],
                                },
                                {
                                    "title": "Cuartil 2",
                                    "color": data['colors'][1],
                                },
                                {
                                    "title": "Cuartil 3",
                                    "color": data['colors'][2],
                                },
                                {
                                    "title": "Cuartil 4",
                                    "color": data['colors'][3],
                                },
                            ],
                        });
                        chartBar.graphs = [{
                            "type": 'column',
                            "title": "cuartil",
                            "valueField": 'value',
                            "fillAlphas": 0.8,
                            "fillColorsField": "color",
                            "labelText": "$[[value]] - [[companie]]",
                            "labelOffset": 5,
                            "fontSize": 12,
                            "balloonText": "[[companie]]",
                            "showAllValueLabels": false,
                            "lineColor": data['colors'][3],
                            "labelFunction": function(item, label){
                                if(item.dataContext.title == ""){
                                    item.alpha = 0;
                                    item.serialDataItem.x = false;
                                    return '';
                                }
                                return label;
                                  
                            }
                        }];
                        chartBar.dataProvider = data['cuartiles'] != false ? data['cuartiles'] : [{'value': 0, 'title': 'product'}];
                        chartBar.validateData();
                        chartBar.animateAgain();
                        if(data['cuartiles'] == false) alert('No hay sufuciente data para realizar un Analísis Cuartil de este Ingrediente');
                    }
                }
            });
        });
    }
    //##############################################################################################################
    //##################################### Fin Graficas Analisis Precios ##########################################
    //############################################################################################################## 

    $('body').on('click', '.delete-list-category', function(){
        var id = $(this).attr('id');
        var row = $(this).closest('tr');
        $.ajax({
            type: "GET",
            url: '/deleteListCategory/'+ id,
            success: function( data ) {
                if(data['response'] === 1){
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-success col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Lista eliminada con Exito</strong>'+
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                    table.row(row).remove().draw();
                 }else{
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-warning col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Ocurrio un error al borrar la list' +
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                }
            }
        });
    });

    $('#historico_checkbox_ingrediente').change(function(){
        if($(this).is(':checked')){
            $('#historico_ingrediente_existente').attr('disabled', 'disabled');
            $('#historico_ingrediente_nuevo, #historico_categoria_select').removeAttr('disabled');
        }else{
            $('#historico_ingrediente_existente').removeAttr('disabled');
            $('#historico_ingrediente_nuevo, #historico_categoria_select').attr('disabled', 'disabled');
        }
    })

    $('body').on('click', '.delete-list-historic', function(){
        var ingrediente_id = $(this).attr('id');
        var row = $(this).closest('tr');
        var year = row.find('#historic-year').text();
        $.ajax({
            type: "GET",
            url: '/deleteListHistoric/'+ ingrediente_id + '/' + year,
            success: function( data ) {
                if(data['response'] === 1){
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-success col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Lista eliminada con Exito</strong>'+
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                    table.row(row).remove().draw();
                 }else{
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-warning col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Ocurrio un error al borrar la list' +
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                }
            }
        });
    });

    $('#see-errors-import').click(function(){
        $('#modal-extra-info').modal('show');
    })

    $('body').on('click', '.global-access', function(){
        var element = $(this);
        var id = $(this).attr('id');
        var user_email = $(this).closest('tr').find('#email').html();
        var row_state_access = $(this).closest('tr').find('#state-access');
        var state = $(this).attr('state');
        var message_state = state === '1' ? 'acceso global' : 'acceso solo en México';
        $.ajax({
            type: "GET",
            url: '/globalAccessUser/'+ id +'/'+ state,
            success: function( data ) {
                if(data['response'] === 1){
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-success col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Usuario '+ user_email + ' '+ message_state +' otorgado con éxito</strong>'+
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                    row_state_access.text(' - '+ message_state);
                    state === '1' ? element.removeClass('desactive-global-user').addClass('active-global-user').attr('state', 0).attr('title', 'desactivar') : element.removeClass('active-global-user').addClass('desactive-global-user').attr('state', 1).attr('title', 'activar');
                }else{
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-warning col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Ocurrio un error al intentar otorgar/remover acceso global al usuario '+ user_email +
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                }
            }
        });
    });

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////// Inicio Custom text are tinymce ////////////////////////////////////
    tinymce.init({
        selector: '#custom_notes',
        plugins : 'advlist autolink link lists charmap print preview code textcolor colorpicker emoticons fullscreen image',
        menubar: "insert",
        toolbar:[
            "undo, redo, bold, italic, underline, strikethrough, bullist, numlist, outdent, indent, alignleft, aligncenter, alignright, alignjustify, link, styleselect, fontselect, fontsizeselect",
            "blockquote, removeformat, subscript, superscript forecolor backcolor code emoticons fullscreen image",
        ],
        images_upload_url: '/uploadImageHome',
        images_upload_handler: function (blobInfo, success, failure) {
            console.log(blobInfo);
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = true;
            xhr.open('POST', '/uploadImageHome');
            xhr.onload = function() {
              var json;

              if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
              }
              json = JSON.parse(xhr.responseText);

              if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
              }
              success(json.location);
            };
            formData = new FormData();
           formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        }

      });
    ///////////////////////////////////////// Fin Custom text are tinymce ///////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////// Inicio User Activity //////////////////////////////////////////

    $('body').on('click', '.date-in-info', function(){
        let id = $(this).attr('id');
        let date = $(this).text();
        $('#current-date-info').empty();
        $.ajax({
            type: "GET",
            url: '/getDateInfo/'+ id,
            success: function( data ) {
                if(data['date_routes'].length == 0) $('#current-date-info').append('<p>No se usaron herramientas en esta sesión</p>');
                $('#date-login').text(date);
                data['date_routes'].forEach(function(e){
                    $('#current-date-info').append(`<li> ${e['route']['route']}</li>`);
                });
            }
        });
    });

    ////////////////////////////////////////////// Fin User Activity ////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Inicio Market Values /////////////////////////////////////////

    AmCharts.ready(function () {
        chartMarketPie = new AmCharts.AmPieChart();
        chartPieConfig(chartMarketPie);
        chartMarketPie.write('market-graph');

        chartMarketPie.addListener("drawn", function (event) {
            let status = $('#market-convert').attr('status');
            $('.amcharts-pie-label').each(function(key, e){
                if(key < 4){
                    let percent = event.chart.dataProvider[key].percent;
                    let sector = event.chart.dataProvider[key].title;
                    value = status == "pes" ? event.chart.dataProvider[key].legend_dolar : event.chart.dataProvider[key].value_label;
                    $(this).html('<tspan y="0" x="0">'+percent+'%</tspan><tspan y="17" x="0">'+sector+'</tspan><tspan y="33" x="0">$'+value+'</tspan>');
                }
            });
        });


        chartMarketPie2 = new AmCharts.AmPieChart();
        chartPieConfig(chartMarketPie2);
        chartMarketPie2.write('market-graph-3');

        chartMarketPie2.addListener("drawn", function (event) {
            let status = $('#market-convert').attr('status');
            let x = 0;
            $('.amcharts-pie-label').each(function(key, e){
                if(key > 3){
                    let percent = event.chart.dataProvider[x].percent;
                    let sector = event.chart.dataProvider[x].title;
                    value = status == "pes" ? event.chart.dataProvider[x].legend_dolar : event.chart.dataProvider[x].value_label;
                    $(this).html('<tspan y="0" x="0">'+percent+'%</tspan><tspan y="17" x="0">'+sector+'</tspan><tspan y="33" x="0">$'+value+'</tspan>');
                    x = x + 1;
                }
            });
        });

       function chartPieConfig(chartObject){
            chartObject.addClassNames = true;
            chartObject.allLabels = [
                {
                    'y': "50%",
                    'align': 'center',
                    'bold': true,
                    'size': 20,
                    'text': "",
                }
            ];
            chartObject.angle =15;
            chartObject.backgroundAlpha = 0;
            chartObject.backgroundColor = "#FFFFFF";
            chartObject.balloon = {
                "fillAlpha": 0.5
            }
            chartObject.balloonText = "[[title]]<br><span style='font-size:14px'><b>$[[value]]</b> ([[percents]]%)</span>";
            chartObject.colorField = 'color';
            chartObject.dataProvider = [];
            chartObject.depth3D = 15;
            chartObject.fontFamily = "roboto";
            chartObject.fontSize = 15;
            chartObject.gradientRatio = [0.3, 0, -0.3];
            chartObject.innerRadius = "50%";
            chartObject.labelFunction = function(slice){
                if(slice.dataContext.title == "Otros" || slice.dataContext.title == "Herbicida") slice.labelRadius = 50;
                slice.labelColor = slice.color;
                return "a";
            }
            chartObject.labelRadius = 25;
            chartObject.legend = {
                'align': 'left',
                'markerType': 'circle',
                'position': 'bottom',
                'equalWidths': false,
                'maxColumns': 1,
                'labelText': '[[title]]',
                'useMarkerColorForLabels': true,
                'useMarkerColorForValues': true,
                'valueText': '',
                'divId': "market-legend",

            };
            chartObject.maxLabelWidth = 95;
            chartObject.outlineAlpha = 0.5;
            chartObject.outlineColor = "#FFFFFF";
            chartObject.outlineThickness = 1;
            chartObject.radius = "35%";
            chartObject.responsive = { 
                "enabled": true
            };
            chartObject.startDuration = 0.5;
            chartObject.startEffect = "easeOutSine";
            chartObject.titles = [{
                'text': "",
                'size': 20,
                'bold': true
            }];
            chartObject.titleField = "title";
            chartObject.valueField = "value";
       }
    });

    $('.select-market select').change(function(){
        let year = $(this).val();
        let sector = "";
        let title = "";
        let pes_dol = "";
        let status = $('#market-convert').attr('status');

        pes_dol = status == 'dol' ? '' : '_dolar';

        $('#market-graph').removeClass('col-sm-12').addClass('col-sm-6');
        $('#market-graph-3, #market-current-2').removeClass('hidden');
        if(chartMarketPie.titles[0].text.includes('UMFFAAC')){
            sector = 'umf';
            title = 'UMFFAAC';
        }else{
            sector = 'pro';
            title = 'PROCCYT';
        } 
        $.ajax({
            type: "POST",
            url: '/market_year_update',
            data: {
                'year': year,
                'sector': sector
            },
            success: function( data ) {
                $('#market-current-2 span').text(data['exchange']);
                $('#market-year-2').text(year);

                chartMarketPie2.dataProvider = data['chartData'];
                chartMarketPie2.allLabels[0].text = formatter_1.format(data['chartData'][0]['total'+pes_dol]); 
                chartMarketPie2.titles[0].text = title + " " +year;
                chartMarketPie2.radius = "25%";
                chartMarketPie2.allLabels[0].size = 16;
                chartMarketPie2.validateData();
                chartMarketPie2.animateAgain();

                if(chartMarketPie.radius != "25%"){
                    chartMarketPie.radius = "25%";
                    chartMarketPie.allLabels[0].size = 16;
                    chartMarketPie.validateData();
                    chartMarketPie.animateAgain();
                }
            }
        })
    })

    AmCharts.ready(function () {
        chartMarketSerial = new AmCharts.AmSerialChart();

        chartMarketSerial.addClassNames = true;
        chartMarketSerial.backgroundAlpha = 0;
        chartMarketSerial.backgroundColor = "#FFFFFF";
        chartMarketSerial.balloon = {
            "fillAlpha": 0.8,
            "fillColor": "#FFFFFF",
            "borderAlpha": 0.1,
            "borderThickness": 5,
            'textAlign': 'left',
            "maxWidth": 500,
        }
        chartMarketSerial.categoryField = 'year';
        chartMarketSerial.columnSpacing = 35;
        chartMarketSerial.dataProvider = [];
        chartMarketSerial.fontFamily = "roboto";
        chartMarketSerial.fontSize = 14;
        chartMarketSerial.legend = {
            'align': 'left',
            'markerType': 'circle',
            'position': 'bottom',
            'equalWidths': false,
            'maxColumns': 1,
            'labelText': '[[title]]',
            'useMarkerColorForLabels': true,
            'useMarkerColorForValues': true,
            'valueText': '$[[value]]',
            'divId': "market-legend-2",
            'reversedOrder': true,

        };
        chartMarketSerial.responsive = { 
            "enabled": true
        };
        chartMarketSerial.startDuration = 1;
        chartMarketSerial.startEffect = "elastic";


        chartMarketSerial.valueAxes = [{
            "stackType": "regular",
            "totalText": "$[[round_suma]]",
        }];

        chartMarketSerial.write('market-graph-2');
        document.getElementById('market-1').click();
        chartMarketSerial.addListener("clickGraphItem", function (event) {
            let year = event.item.category;
            let status = $('#market-convert').attr('status');
            let sector = "";
            let pes_dol = "";

            pes_dol = status == 'dol' ? '' : '_dolar';

            if(event.graph.title == 'UMFFAAC') sector = 'umf';
            else if(event.graph.title == 'PROCCYT') sector = 'pro';

            if(sector == 'umf' || sector == 'pro'){
                $('#market-graph-2, #market-legend-2, .radio-market').addClass('hidden');
                $('#market-graph, #market-current, #back-market, #market-legend, .select-market').removeClass('hidden');
                $.ajax({
                    type: "POST",
                    url: '/market_year_update',
                    data: {
                        'year': year,
                        'sector': sector
                    },
                    success: function( data ) {
                        $('#market-current span').text(data['exchange']);
                        $('#market-year').text(year);
                        chartMarketPie.dataProvider = data['chartData'];
                        chartMarketPie.allLabels[0].text = formatter_1.format(data['chartData'][0]['total'+pes_dol]), 
                        chartMarketPie.titles[0].text = event.graph.title + " " + year;
                        chartMarketPie.valueField = "value"+pes_dol;
                        chartMarketPie.validateData();
                        chartMarketPie.animateAgain()
                    }
                })
            }
        });
    });

    $('.radio-market label').click(function(e){
        let sector = $(this).find('input').val();
        let status = $('#market-convert').attr('status');
        $.ajax({
            type: "POST",
            url: '/market_update',
            data: {
                'sector': sector
            },
            success: function( data ) {
                $('#market-graph, #market-current, #market-legend').addClass('hidden');
                $('#market-process-exchange, #market-graph-2').removeClass('hidden');
                chartMarketSerial.dataProvider = data['chartData'];
                chartMarketSerial.titles = [{'text': "Mercado "+data['title'] + " Mexicano", 'size': 20}];
                chartMarketSerial.startDuration = 1;
                chartMarketSerialGraphs(sector, data['title'], status);
                chartMarketSerial.validateData();
                chartMarketSerial.animateAgain();
            }
        });
    });

    $('#market-convert').click(function(e){
        let status = $(this).attr('status');
        let total = 0;
        let total1 = 0;
        if(status == 'dol'){
            //pie
            if( chartMarketPie.dataProvider.length > 0) chartMarketPie.valueField = "value_dolar";
            if( chartMarketPie.dataProvider.length > 0) total = chartMarketPie.dataProvider[0].total_dolar;
            if( chartMarketPie2.dataProvider.length > 0) total1 = chartMarketPie2.dataProvider[0].total_dolar;

            //serial
            chartMarketSerial.graphs[0].valueField = 'pro_total_dol';
            chartMarketSerial.graphs[0].balloonText = '<b>UMFFAAC:</b> $[[umf_total_ballon_dol]] <br> <b>PROCCYT:</b> $[[pro_total_ballon_dol]] <br> <b>Total:</b> $[[suma_dol]] <br> <b>Exchange:</b> $[[exchange]]';
            chartMarketSerial.graphs[1].valueField = 'umf_total_dol';
            chartMarketSerial.graphs[1].balloonText = '<b>UMFFAAC:</b> $[[umf_total_ballon_dol]] <br> <b>PROCCYT:</b> $[[pro_total_ballon_dol]] <br> <b>Total:</b> $[[suma_dol]] <br> <b>Exchange:</b> $[[exchange]]';
            chartMarketSerial.valueAxes[0].totalText = '$[[round_suma_dol]]';

            $(this).attr('status', 'pes');
            $(this).text('Convertir a Pesos');
            $('#market-dol').text('Precios Reflejados en Dolares USA');
        }else{
            //pie
            if( chartMarketPie.dataProvider.length > 0) chartMarketPie.valueField = "value";
            if( chartMarketPie.dataProvider.length > 0) total = chartMarketPie.dataProvider[0].total;
            if( chartMarketPie2.dataProvider.length > 0) total1 = chartMarketPie2.dataProvider[0].total;

            //serial
            chartMarketSerial.graphs[0].valueField = 'pro_total';
            chartMarketSerial.graphs[0].balloonText = '<b>UMFFAAC:</b> $[[umf_total_ballon]] <br> <b>PROCCYT:</b> $[[pro_total_ballon]] <br> <b>Total:</b> $[[suma]]';
            chartMarketSerial.graphs[1].valueField = 'umf_total';
            chartMarketSerial.graphs[1].balloonText = '<b>UMFFAAC:</b> $[[umf_total_ballon]] <br> <b>PROCCYT:</b> $[[pro_total_ballon]] <br> <b>Total:</b> $[[suma]]';
            chartMarketSerial.valueAxes[0].totalText = '$[[round_suma]]';

            $(this).attr('status', 'dol');
            $(this).text('Convertir a Dolares');
            $('#market-dol').text('Precios Reflejados en Pesos Mexicanos');
        }

        chartMarketPie2.allLabels[0].text = formatter_1.format(total1)
        chartMarketPie2.validateData();

        chartMarketPie.allLabels[0].text = formatter_1.format(total);
        chartMarketPie.validateData();

        chartMarketSerial.validateData();
    })

    function chartMarketSerialGraphs(sector, title, status){
        let color_1 = "#00bcd4";
        let color_2 = "#ff9800";
        let title_1 = "PROCCYT";
        let title_2 = "UMFFAAC";
        let pes_dol = "";

        if(sector != 'total'){
            title_1 = "PROCCYT "+title;
            title_2 = "UMFFAAC "+title;
        }

        if(sector == 'herbicida'){
            color_1 = '#04b10b';
            color_2 = '#006704';
        }else if(sector == 'fungicida'){
            color_1 = '#e44aff';
            color_2 = '#9e03b9';
        }else if(sector == 'otros'){
            color_1 = '#f7e22d';
            color_2 = '#ccb700';
        }else if(sector == 'insecticida'){
            color_1 = '#ff3c00';
            color_2 = '#a92800';
        }

        pes_dol = status == 'dol' ? "" : '_dol';

        chartMarketSerial.graphs = [
            {
                "type": "column",
                "title": title_1,
                "lineColor": color_1,
                "valueField": "pro_total"+pes_dol,
                "fillAlphas": 0.8,
                "labelText": "[[pro_percent]]%",
                "balloonText": "<b>"+title_2+":</b> $[[umf_total_ballon"+pes_dol+"]] <br> <b>"+title_1+":</b> $[[pro_total_ballon"+pes_dol+"]] <br> <b>Total:</b> $[[suma"+pes_dol+"]]",
            },
            {
                "type": "column",
                "title": title_2,
                "lineColor": color_2,
                "valueField": "umf_total"+pes_dol,
                "fillAlphas": 0.8,
                "labelText": "[[umf_percent]]%",
                "balloonText": "<b>"+title_2+":</b> $[[umf_total_ballon"+pes_dol+"]] <br> <b>"+title_1+":</b> $[[pro_total_ballon"+pes_dol+"]] <br> <b>Total:</b> $[[suma"+pes_dol+"]]",
            },
        ];
    }

    $('#back-market').click(function(e){
        chartMarketPie2.allLabels[0].text = " ";
        chartMarketPie2.validateData();

        chartMarketPie.allLabels[0].text = " ";
        chartMarketPie.allLabels[0].size = 20;
        chartMarketPie.validateData();

        $('.select-market select').val("");

        $('#market-graph').removeClass('col-sm-6').addClass('col-sm-12');
        $('#market-graph-2, .radio-market, #market-legend-2').removeClass('hidden');
        $('#market-graph, #market-current, #market-current-2, #back-market, #market-legend, #market-graph-3, .select-market').addClass('hidden');
        chartMarketPie.radius = "35%";
    })
    
    ////////////////////////////////////////////// Fin Market Values ////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////    

 });

var formatter_1 = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
    minimunFractionDigits: 2,
});
