 $(document).ready(function () {
	 
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
             }
         }
     } );
	 
	 
	 $("#input-1").fileinput({
		showPreview: false,
		allowedFileExtensions: ["csv"],
		elErrorContainer: "#errorBlock1",
	    uploadAsync: false,
	    msgInvalidFileExtension: "Archivo invalido, solo son validos archivos con extension CSV",
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
                    state === '0' ? element.removeClass('action-desactive').addClass('action-active').attr('state', 1).find('i').removeClass('fa-times').addClass('fa-check') : element.removeClass('action-active').addClass('action-desactive').attr('state', 0).find('i').removeClass('fa-check').addClass('fa-times');
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

    //##############################################################################################################
    //########################################### Incio Graficas ###################################################
    //##############################################################################################################
    var ctx = document.getElementById('myChart').getContext('2d');

    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: [],
            datasets: [{
                label: 'Test',
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
            tooltips: {
                enabled: false,
                mode: 'index',
                position: 'nearest',
                yPadding: 10,
                xPadding: 10,
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

                        var innerHtml = '<thead>';
                        innerHtml += '</thead><tbody>';

                        bodyLines.forEach(function(body, i) {
                            var indexBody = body[0].indexOf(':');
                            bodyX = body[0].substr(indexBody + 1);
                            var colors = tooltip.labelColors[i];
                            var style = 'background:' + colors.backgroundColor;
                            style += '; border-color:' + colors.borderColor;
                            style += '; border-width: 2px';
                            var span = '<span class="chartjs-tooltip-key" style="' + style + '"></span>';
                            innerHtml += '<tr><td>' + span + '<strong>Precio K/L:</strong><span style="color: #57bd64;"> ' + bodyX + '</span></td></tr>';
                            innerHtml += '<tr><td>' + span + '<strong>Update:</strong> <span style="color: #57bd64;"> ' + titleLines[0] + '</span></td></tr>';
                        });
                        innerHtml += '</tbody>';

                        var tableRoot = tooltipEl.querySelector('table');
                        tableRoot.innerHTML = innerHtml;
                    }

                    // `this` will be the overall tooltip
                    var positionY = this._chart.canvas.offsetTop;
                    var positionX = this._chart.canvas.offsetLeft;

                    // Display, position, and set styles for font
                    tooltipEl.style.opacity = 1;
                    tooltipEl.style.left = positionX + tooltip.caretX + 'px';
                    tooltipEl.style.top = positionY + tooltip.caretY + 'px';
                    tooltipEl.style.fontFamily = tooltip._fontFamily;
                    tooltipEl.style.fontSize = tooltip.fontSize;
                    tooltipEl.style.fontStyle = tooltip._fontStyle;
                    tooltipEl.style.padding = tooltip.yPadding + 'px ' + tooltip.xPadding + 'px';
                }
            }
        }
    });

    $('#update').click(function(){
        var a = Math.random() * 100;
        var b = Math.random() * 100;
        var c = Math.random() * 100; 
        var d = Math.random() * 100;
        var e = Math.random() * 100; 
        var f = Math.random() * 100; 
        addData(chart, ["January", "February", "March", "April", "May", "June", ''], [a, b, c, d, e, f]);
    })

    function addData(chart, label, data) {
        chart.data.labels = label;
        chart.data.datasets.forEach((dataset) => {
            dataset.data = data;
        });
        chart.update();
    }

    $('#analisisCategorias').change(function(){
        console.log('change products e ingredientes');
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

    $('#analisisTiempo').change(function(){
         if($(this).val() == 0){
            $('.analisisRango').fadeOut(1);
        }else{
            $('.analisisRango').fadeIn(1000);
        }
    })

    $('#analisisInicio').change(function(){
        var dateIn = $(this).val();
        var dateOut = $('#analisisFin').val();
        if(dateIn != null && dateOut != null)  Date.parse(dateIn) >= Date.parse(dateOut) ? $(this).closest('.form-group').addClass('has-error').find('.help-block').fadeIn() : $(this).closest('.form-group').removeClass('has-error').find('.help-block').fadeOut();
    })

    $('#analisisFin').change(function(){
      var dateIn = $('#analisisInicio').val()
      var dateOut = $(this).val() 
      if(dateIn != null && dateOut != null)  Date.parse(dateIn) >= Date.parse(dateOut) ? $(this).closest('.form-group').addClass('has-error').find('.help-block').fadeIn() : $(this).closest('.form-group').removeClass('has-error').find('.help-block').fadeOut();
    });

    $('#form-graph-analisis').submit(function(e){
        e.preventDefault();
        if($(this).find('.has-error').length > 0) e.preventDefault();
    })
    //##############################################################################################################
    //########################################### Fin Graficas #####################################################
    //############################################################################################################## 

 });