var chartBar;
var chartImport;
var chartMarketPie;
var chartMarketSerial;
var trigger_key = false;

const farm_products = {
    "AGAVE": {'img': 'Agave N.svg', 'imgB': 'Agave color.svg', 'color': "#550000ff", "active": false, 'adapterBase': 'Agave'},
    "AGUACATE": {'img': 'Aguacate N.svg', 'imgB': 'Aguacate color.svg', 'color': "#00ff00ff", "active": false, 'adapterBase': 'Aguacate'},
    "AJO": {'img': 'Ajo N.svg', 'imgB': 'Ajo color.svg', 'color': "#e3dbdbff", "active": false, 'adapterBase': 'Ajo'},
    "ALFALFA VERDE": {'img': 'Alfalfa N.svg', 'imgB': 'Alfalfa color.svg', 'color': "#ff2a2aff", "active": false, 'adapterBase': 'Alfalfa (T)'},
    "ALGODN HUESO": {'img': 'Algodón N.svg', 'imgB': 'Algodón color.svg', 'color': "#ff8080ff", "active": false, 'adapterBase': 'Algodón'},
    "ARROZ PALAY": {'img': 'Arroz N.svg', 'imgB': 'Arroz color.svg', 'color': "#D7DBDD", "active": false, 'adapterBase': 'Arroz'},
    
    "AVENA GRANO": {'img': 'Avena Grano N.svg', 'imgB': 'Avena Grano color.svg', 'color': "#ffe680ff", "active": false, 'adapterBase': 'Avena Grano'},
    "BERENJENA": {'img': 'Berenjena N.svg', 'imgB': 'Berenjena color.svg', 'color': "#bc5fd3ff" , "active": false, 'adapterBase': 'Berenjena'},
    "BROCOLI": {'img': 'Brócoli N.svg', 'imgB': 'Brócoli color.svg', 'color': "#008080ff" , "active": false, 'adapterBase': 'Brócoli'},
    "CACAO": {'img': 'Cacao N.svg', 'imgB': 'Cacao color.svg', 'color': "#502d16ff" , "active": false, 'adapterBase': 'Cacao'},
    "CAF CEREZA": {'img': 'Café N.svg', 'imgB': 'Café color.svg', 'color': "#ac939dff" , "active": false, 'adapterBase': 'Café'},
    "CALABACITA": {'img': 'Calabacita N.svg', 'imgB': 'Calabacita color.svg', 'color': "#ffb380ff" , "active": false, 'adapterBase': 'Calabacita'},
    "CAA DE AZUCAR": {'img': 'Caña de Azúcar N.svg', 'imgB': 'Caña de Azúcar color.svg', 'color': "#026f02ff" , "active": false, 'adapterBase': 'Cana de Azúcar'},
    
    "CEBOLLA": {'img': 'Cebolla N.svg', 'imgB': 'Cebolla color.svg', 'color': "#b3b3b3ff" , "active": false, 'adapterBase': 'Cebolla'},
    "CHILE VERDE": {'img': 'Chile Verde N.svg', 'imgB': 'Chile Verde color.svg', 'color': "#88aa00ff" , "active": false, 'adapterBase': 'Chile verde'},
    "COLIFLOR": {'img': 'Col (Repollo) N.svg', 'imgB': 'Col (Repollo) color.svg', 'color': "#aa0088ff" , "active": false, 'adapterBase': 'Col (repollo)'},
    "CRISANTEMO (Gruesa)": {'img': 'Crisantemo N.svg', 'imgB': 'Crisantemo color.svg', 'color': "#37c8abff" , "active": false, 'adapterBase': 'Crisantemo'},
    "DURAZNO": {'img': 'Durazno N.svg', 'imgB': 'Durazno color.svg', 'color': "#ffccaaff" , "active": false, 'adapterBase': 'Durazno'},
    "ESPARRAGO": {'img': 'Esparrago N.svg', 'imgB': 'Esparrago color.svg', 'color': "#806600ff" , "active": false, 'adapterBase': 'Espárrago'},
    "FRAMBUESA": {'img': 'Frambuesa N.svg', 'imgB': 'Frambuesa color.svg', 'color': "#750275ff" , "active": false, 'adapterBase': 'Frambuesa'},
    
    "FRESA": {'img': 'Fresa N.svg', 'imgB': 'Fresa color.svg', 'color': "#ffaaccff" , "active": false, 'adapterBase': 'Fresa'},
    "FRIJOL": {'img': 'Frijol N.svg', 'imgB': 'Frijol color.svg', 'color': "#d38d5fff" , "active": false, 'adapterBase': 'Frijol'},
    "GLADIOLA (Gruesa)": {'img': 'Gladiola N.svg', 'imgB': 'Gladiola color.svg', 'color': "#44aa00ff" , "active": false, 'adapterBase': 'Gladiola'},
    "LECHUGA": {'img': 'Lechuga N.svg', 'imgB': 'Lechuga color.svg', 'color': "#2aff80ff" , "active": false, 'adapterBase': 'Lechuga'},
    "LIMON": {'img': 'Limon N.svg', 'imgB': 'Limon color.svg', 'color': "#e9ddafff" , "active": false, 'adapterBase': 'Limón'},
    "MAIZ GRANO": {'img': 'Maíz (Grano) N.svg', 'imgB': 'Maíz (Grano) color.svg', 'color': "#F9E79F" , "active": false, 'adapterBase': 'Maíz grano'},
    
    "MANGO": {'img': 'Mango N.svg', 'imgB': 'Mango color.svg', 'color': "#55ddffff" , "active": false, 'adapterBase': 'Mango'},
    "MANZANA": {'img': 'Manzana N.svg', 'imgB': 'Manzana color.svg', 'color': "#782121ff" , "active": false, 'adapterBase': 'Manzana'},
    "MELON": {'img': 'Melón N.svg', 'imgB': 'Melón color.svg', 'color': "#ff7f2aff" , "active": false, 'adapterBase': 'Melón'},
    "NARANJA": {'img': 'Naranja N.svg', 'imgB': 'Naranja color.svg', 'color': "#aa4400ff" , "active": false, 'adapterBase': 'Naranja'},
    "NUEZ": {'img': 'Nogal (Nuez) N.svg', 'imgB': 'Nogal (Nuez) color.svg', 'color': "#d38d5fff" , "active": false, 'adapterBase': 'Nogal (Nuez)'},
    "PAPA": {'img': 'Papa N.svg', 'imgB': 'Papa color.svg', 'color': "#803300ff" , "active": false, 'adapterBase': 'Papa'},
    
    "PAPAYA": {'img': 'Papaya N.svg', 'imgB': 'Papaya color.svg', 'color': "#80b3ffff" , "active": false, 'adapterBase': 'Papaya'},
    "PEPINO": {'img': 'Pepino N.svg', 'imgB': 'Pepino color.svg', 'color': "#9dac93ff" , "active": false, 'adapterBase': 'Pepino'},
    "PIA": {'img': 'Piña N.svg', 'imgB': 'Piña color.svg', 'color': "#ffdd55ff" , "active": false, 'adapterBase': 'Piña'},
    "PLATANO": {'img': 'Plátano N.svg', 'imgB': 'Plátano color.svg', 'color': "#d3bc5fff" , "active": false, 'adapterBase': 'Plátano'},
    "ROSA (Gruesa)": {'img': 'Rosas (Gruesa) N.svg', 'imgB': 'Rosas (Gruesa) color.svg', 'color': "#bcd35fff" , "active": false, 'adapterBase': 'Rosas (Gruesa)'},
    "SANDIA": {'img': 'Sandía N.svg', 'imgB': 'Sandía color.svg', 'color': "#c83737ff" , "active": false, 'adapterBase': 'Sandía'},
    
    "SORGO GRANO": {'img': 'Sorgo N.svg', 'imgB': 'Sorgo color.svg', 'color': "#5a2ca0ff" , "active": false, 'adapterBase': 'Sorgo Grano'},
    "SOYA": {'img': 'Soya N.svg', 'imgB': 'Soya color.svg', 'color': "#6c535dff" , "active": false, 'adapterBase': 'Soya'},
    "TABACO": {'img': 'Tabaco N.svg', 'imgB': 'Tabaco color.svg', 'color': "#ac9d93ff" , "active": false, 'adapterBase': 'Tabaco'},
    "TOMATE ROJO (JITOMATE)": {'img': 'Jitomate (Tomate) N.svg', 'imgB': 'Jitomate (Tomate) color.svg', 'color': "#ff5555ff" , "active": false, 'adapterBase': 'Tomate (Jitomate)'},
    "TOMATE VERDE": {'img':'Tomate Verde N.svg', 'imgB': 'Tomate Verde color.svg', 'color': "#ccff00ff" , "active": false, 'adapterBase': 'Tomate Verde'},
    "TORONJA (POMELO)": {'img': 'Toronja (Pomelo) N.svg', 'imgB': 'Toronja (Pomelo) color.svg', 'color': "#ff2a7fff", "active": false, 'adapterBase': 'Toronja (pomelo)'},
    
    "TRIGO GRANO": {'img': 'Trigo Grano N.svg', 'imgB': 'Trigo Grano color.svg', 'color': "#d4aa00ff", "active": false, 'adapterBase': 'Trigo Grano'},
    "UVA": {'img': 'Uva N.svg', 'imgB': 'Uva color.svg', 'color': "#7f2affff", "active": false, 'adapterBase': 'Uva'},
    "ZANAHORIA": {'img': 'Zanahoria N.svg', 'imgB': 'Zanahoria color.svg', 'color': "#d45500ff", "active": false, 'adapterBase': 'Zanahoria'},
    "ZARZAMORA": {'img': 'Zarzamora N.svg', 'imgB': 'Zarzamora color.svg', 'color': "#0055d4ff", "active": false, 'adapterBase': 'Zarzamora'},
    
    
}

const typeProductColors = {
    'Insecticida' : "#c10000",
    'Herbicida' : "#026f02",
    'Fungicida' : "#750275",
    'Otro' : "#ffa500"
}

const states = {
    "MX-AGU": {'name': "Aguascalientes", 'active': false},
    "MX-BCN": {'name': "Baja California", 'active': false},
    "MX-BCS": {'name': "Baja California Sur", 'active': false},
    "MX-CAM": {'name': "Campeche", 'active': false},
    "MX-CHP": {'name': "Chiapas", 'active': false},
    "MX-CHH": {'name': "Chihuahua", 'active': false},
    "MX-CMX": {'name': "Ciudad de México", 'active': false},
    "MX-COA": {'name': "Coahuila", 'active': false},
    "MX-COL": {'name': "Colima", 'active': false},
    "MX-DUR": {'name': "Durango", 'active': false},
    "MX-GUA": {'name': "Guanajuato", 'active': false},
    "MX-GRO": {'name': "Guerrero", 'active': false},
    "MX-HID": {'name': "Hidalgo", 'active': false},
    "MX-JAL": {'name': "Jalisco", 'active': false},
    "MX-MIC": {'name': "Michoacán", 'active': false},
    "MX-MOR": {'name': "Morelos", 'active': false},
    "MX-MEX": {'name': "México", 'active': false},
    "MX-NAY": {'name': "Nayarit", 'active': false},
    "MX-NLE": {'name': "Nuevo León", 'active': false},
    "MX-OAX": {'name': "Oaxaca", 'active': false},
    "MX-PUE": {'name': "Puebla", 'active': false},
    "MX-QUE": {'name': "Querétaro", 'active': false},
    "MX-ROO": {'name': "Quintana Roo", 'active': false},
    "MX-SLP": {'name': "San Luis Potosí", 'active': false},
    "MX-SIN": {'name': "Sinaloa", 'active': false},
    "MX-SON": {'name': "Sonora", 'active': false},
    "MX-TAB": {'name': "Tabasco", 'active': false},
    "MX-TAM": {'name': "Tamaulipas", 'active': false},
    "MX-TLA": {'name': "Tlaxcala", 'active': false},
    "MX-VER": {'name': "Veracruz", 'active': false},
    "MX-YUC": {'name': "Yucatán", 'active': false},
    "MX-ZAC": {'name': "Zacatecas", 'active': false},
}

let statesBaseMarket = []
let marketInsecticidaValue = 0
let marketHerbicidaValue = 0
let marketFungicidadaValue = 0
let marketOtroValue = 0
let markettotalValue = 0

const mexicoIds = ["MX-ZAC", "MX-YUC", "MX-VER", "MX-TLA", "MX-TAM", "MX-TAB", "MX-SON", "MX-SIN", "MX-SLP", "MX-ROO", "MX-QUE", "MX-PUE", "MX-OAX", "MX-NLE", "MX-NAY", "MX-MOR", "MX-MIC", "MX-MEX", "MX-JAL", "MX-HID", "MX-GRO", "MX-GUA", "MX-DUR", "MX-CMX", "MX-COL", "MX-COA", "MX-CHH", "MX-CHP", "MX-CAM", "MX-BCS", "MX-BCN", "MX-AGU"]

Array.prototype.clone = function(){
    return this.slice(0)
}

$(document).ready(function () {

    am4core.addLicense("CH235272211");
	 
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

    $('body').on('click', '.action-price', function(){
        var element = $(this);
        var id = $(this).attr('id');
        var user_email = $(this).closest('tr').find('#email').html();
        var state = $(this).attr('state');
        var message_state = state === '0' ? 'activo para utilizar sistema de precios' : 'inactivo para utilizar sistema de precio';
        $.ajax({
            type: "GET",
            url: '/pricePermission/'+ id +'/'+ state,
            success: function( data ) {
                if(data['response'] === 1){
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-success col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Usuario '+ user_email + ' '+ message_state +' </strong>'+
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                    state === '0' ? element.removeClass('desactive-price').addClass('active-price').attr('state', 1).attr('title', 'Remover acceso al sistema de precios') : element.removeClass('active-price').addClass('desactive-price').attr('state', 0).attr('title', 'Dar acceso al sistema de precios');
                }else{
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-warning col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Ocurrio un error al intentar activar/desactivar análisis de precios al usuario '+ user_email +
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                }
            }
        });
    });

    $('body').on('click', '.action-import', function(){
        var element = $(this);
        var id = $(this).attr('id');
        var user_email = $(this).closest('tr').find('#email').html();
        var state = $(this).attr('state');
        var message_state = state === '0' ? 'activo para utilizar sistema de importaciones' : 'inactivo para utilizar sistema de importaciones';
        $.ajax({
            type: "GET",
            url: '/importPermission/'+ id +'/'+ state,
            success: function( data ) {
                if(data['response'] === 1){
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-success col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Usuario '+ user_email + ' '+ message_state +' </strong>'+
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                    state === '0' ? element.removeClass('desactive-import').addClass('active-import').attr('state', 1).attr('title', 'Remover acceso al sistema de importaciones') : element.removeClass('active-import').addClass('desactive-import').attr('state', 0).attr('title', 'Dar acceso al sistema de importaciones');
                }else{
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-warning col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Ocurrio un error al intentar activar/desactivar análisis de precios al usuario '+ user_email +
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                }
            }
        });
    });

    $('body').on('click', '.action-market', function(){
        var element = $(this);
        var id = $(this).attr('id');
        var user_email = $(this).closest('tr').find('#email').html();
        var state = $(this).attr('state');
        var message_state = state === '0' ? 'activo para utilizar sistema del mercado' : 'inactivo para utilizar sistema del mercado';
        $.ajax({
            type: "GET",
            url: '/marketPermission/'+ id +'/'+ state,
            success: function( data ) {
                if(data['response'] === 1){
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-success col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Usuario '+ user_email + ' '+ message_state +' </strong>'+
                            '</div>'+
                        '</div>'
                    ).fadeIn(1000);
                    state === '0' ? element.removeClass('desactive-market').addClass('active-market').attr('state', 1).attr('title', 'Remover acceso al sistema de mercado') : element.removeClass('active-market').addClass('desactive-market').attr('state', 0).attr('title', 'Dar acceso al sistema de mercado');
                }else{
                    $('#messages').html(
                        '<div class="row">'+
                            '<div class="alert alert-dismissible alert-warning col-xs-10 col-xs-offset-1">'+
                                '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>'+
                                '<strong>Ocurrio un error al intentar activar/desactivar análisis de precios al usuario '+ user_email +
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
    //##################################### Incio Graficas Analisis Importaciones ##################################
    //###############################################################################################################
    
    var Toneladas_trimestre = [];
    var Unit = '';
    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimunFractionDigits: 2,
    });
    
    
    AmCharts.ready(function () {
        chartImport = new AmCharts.AmSerialChart();
        chartImport.balloon = {
            "fillAlpha": 0.8,
            "fillColor": "#FFFFFF",
            "borderAlpha": 0.0001,
            "borderThickness": 5,
            'textAlign': 'center',
            "maxWidth": 500,
            'fontSize': 16,

        }
        chartImport.backgroundColor = "#000000";
        chartImport.backgroundAlpha = 0.1;
        chartImport.categoryAxis = {
            "labelFunction": function(valueText, serialDataItem, categoryAxis){
                return serialDataItem.dataContext.tri;
            },
            'fontSize': 14,
            'boldLabels': true,
        }
        //chartImport.categoryField = "title",
        
        chartImport.creditsPosition = "top-right";
        chartImport.columnWidth = 0.6;
        chartImport.dataProvider = [
            {
            'value': 0,
            'tri': 'T1'
            },
            {
            'value': 0,
            'tri': 'T2'
            },
            {
            'value': 0,
            'tri': 'T3'
            },
            {
            'value': 0,
            'tri': 'T4'
            },
        ];
        chartImport.fontFamily = "Roboto, Helvetica Neue, Helvetica, Arial, sans-serif";
        //chartImport.fontSize = 20;
        chartImport.graphs = [];

        chartImport.rotate =  true;
        chartImport.responsive = {
            "enabled": true,
        };
        chartImport.startAlpha = 0.8;
        chartImport.startDuration = 0.5;
        chartImport.startEffect = "easeOutSine";

        chartImport.titles = [{
            "text": "Analísis Trimestral de Importaciones",
            'size': 20,
            'bold': true
        }];

        chartImport.type = "serial";
        chartImport.valueAxes = [{
            "stackType": "regular",
        }];
        
        chartImport.write('bar-import');
    });

    $('#analisisCategoriasHistorico').change(function(e){
        var categoria_id = $(this).val();
        var ingrediente_select = $('#selectAnalisisIngredienteHistorico');
        ingrediente_select.empty();
        $('#selectAnalisisYearHistorico, #selectAnalisisYearHistorico2').empty();
        $('#import-extras, #import-extras-vs').addClass('hidden');
        chartImportClear();
        $.ajax({
            type: "GET",
            url: '/getIngredientes/'+ categoria_id,
            success: function( data ) {
                if(data['years'] != []) ingrediente_select.append($('<option></option>').attr('value', 'empty').text('Lista de Ingrediente'));
                Object.keys(data['ingredientes']).forEach(function(key){
                    ingrediente_select.append($('<option></option>').attr('value', key).text(data['ingredientes'][key]));
                });
            }
        });
    })

    $('#selectAnalisisIngredienteHistorico').change(function(e){
        var year_select = $('#selectAnalisisYearHistorico, #selectAnalisisYearHistorico2');
        var ingrediente_select = $('#selectAnalisisIngredienteHistorico').val();
        year_select.empty();
        $.ajax({
            type: "GET",
            url: '/getYears/'+ ingrediente_select,
            success: function( data ) {
                if(data['years'] != []) year_select.append($('<option>Ingredientes</option>').attr('value', 'empty').text('Año'));
                data['years'].forEach(function(e){
                    year_select.append($('<option></option>').attr('value', e).text(e));
                });
            }
        });
    });

    $('#import-checkbox').change(function(){
        let one_c = $('#form-graph-analisis-historic .form-group:nth-child(2)');
        let sec_c = $('#form-graph-analisis-historic .form-group:nth-child(3)');
        let thi_c = $('#form-graph-analisis-historic .form-group:nth-child(4)');
        let fou_c = $('#vs-text-import');
        let fiv_c = $('#form-graph-analisis-historic .form-group:last-child');
        chartImport.titles[0].text = "Analísis Trimestral de Importaciones";
        chartImportClear();
        if($(this).prop('checked')){
            one_c.addClass('col-md-offset-1 col-md-3').removeClass('col-md-4');
            sec_c.addClass('col-md-3').removeClass('col-md-4');
            thi_c.addClass('col-md-2').removeClass('col-md-4');
            fou_c.removeClass('hidden');
            fiv_c.removeClass('hidden');
            $('#import-extras').addClass('hidden');
        }else{
            one_c.removeClass('col-md-offset-1 col-md-3').addClass('col-md-4');
            sec_c.removeClass('col-md-3').addClass('col-md-4');
            thi_c.removeClass('col-md-2').addClass('col-md-4');
            fou_c.addClass('hidden');
            fiv_c.addClass('hidden');
            $('#import-extras-vs').addClass('hidden');
        }        
        $('#selectAnalisisYearHistorico2').val('empty');
        if($('#selectAnalisisIngredienteHistorico').val() != 'empty') $('#selectAnalisisYearHistorico').trigger('change');
    })

    $('#selectAnalisisYearHistorico, #selectAnalisisYearHistorico2').change(function(e){
        e.preventDefault();
        var ingrediente = $('#selectAnalisisIngredienteHistorico');
        var vs = $('#import-checkbox').prop('checked');
        var year = $('#selectAnalisisYearHistorico');
        var year2 = $('#selectAnalisisYearHistorico2');
        if(year.val() == 'empty') return;
        chartImport.removeListener(chartImport, "drawn", downLabel);
        chartImport.removeListener(chartImport, "drawn", downLabelVs);
        
        if(!vs){
            $.ajax({
                type: "GET",
                url: '/updateAnalysisHistoric/'+ ingrediente.val() + '/' + year.val(),
                success: function( data ) {
                    chartImport.balloon.enabled = false;
                    chartImport.dataProvider = data['provider'];
                    let unidad = data['unit'] == 'Tons' ? 'Kg' : 'Litros';
                    $('#importaciones_precio_total').text(data['precio_total_prom']);
                    $('#imp_kg_lt').text(unidad);
                    $('#import-extras').removeClass('hidden');
                    $('#importaciones_volumen_total').text(data['volumen_total']);
                    chartImport.graphs = [
                        {
                            "type": 'column',
                            "valueField": 'value_0',
                            'fillAlphas': 1,
                            'lineColor': '#02881f',
                            'fontSize': 18,
                            'labelColorField': 'color',
                            'labelText': '[[label_t1]]',
                            'labelPosition': data['provider'][0]['value_0']  == 0 ? 'right' : 'left',
                        },
                        {
                            "type": 'column',
                            "valueField": 'value_1',
                            'fillAlphas': 1,
                            'lineColor': '#1c24d8',
                            'fontSize': 18,
                            'labelColorField': 'color',
                            'labelText': '[[label_t2]]',
                            'labelPosition': data['provider'][1]['value_1'] == 0 ? 'right' : 'left',
                        },
                        {
                            "type": 'column',
                            "valueField": 'value_2',
                            'fillAlphas': 1,
                            'lineColor': '#ff9800',
                            'fontSize': 18,
                            'labelColorField': 'color',
                            'labelText': '[[label_t3]]',
                            'labelPosition': data['provider'][2]['value_2'] == 0 ? 'right' : 'left',
                        },
                        {
                            "type": 'column',
                            "valueField": 'value_3',
                            'fillAlphas': 1,
                            'lineColor': '#fb1818',
                            'fontSize': 18,
                            'labelColorField': 'color',
                            'labelText': '[[label_t4]]',
                            'labelPosition': data['provider'][3]['value_3'] == 0 ? 'right' : 'left'
                        },
                    ];
                    chartImport.listeners = [
                        {
                            "event": "drawn",
                            "method": downLabel,
                        }
                    ];
                    chartImport.titles[0].text = "Analisis Trimestral de Importaciones";
                    chartImport.validateData();
                    chartImport.animateAgain();
                }
            });
        }else{
            if(year2.val() == 'empty') return;
            $.ajax({
                type: "GET",
                url: '/updateAnalysisHistoricVs/'+ ingrediente.val() + '/' + year.val() + '/' + year2.val(),
                success: function( data ) {
                    chartImport.balloon.enabled = true;
                    $('#import-extras-vs').removeClass('hidden');
                    let unidad = data['unit'] == 'Tons' ? 'Kg' : 'Litros';
                    $('#impor-an-1').text(data['volumen_total']);
                    $('#impor-an-2').text(data['volumen_total_2']);
                    $('#precio-an-1').text(data['precio_total_prom'] + ' USD/' + unidad);
                    $('#precio-an-2').text(data['precio_total_prom_2'] + ' USD/' + unidad);
                    $('#title-an-1 span').text(year.val());
                    $('#title-an-2 span').text(year2.val());
                    chartImport.dataProvider = data['provider'];
                    chartImport.graphs = [
                        {
                            "type": 'column',
                            "valueField": 'value_0',
                            'fillAlphas': 1,
                            'lineColor': '#02881f',
                            'fontSize': 18,
                            'labelColorField': 'color',
                            //'labelText': '[[label_t1]]',
                            'labelPosition': data['provider'][0]['value_0'] == 0 ? 'right' : 'right',
                            'balloonText': 'Importacion </br> [[volumen]]',
                        },
                        {
                            "type": 'column',
                            "valueField": 'value_1',
                            'fillAlphas': 1,
                            'lineColor': '#1c24d8',
                            'fontSize': 18,
                            'labelColorField': 'color',
                            //'labelText': '[[label_t2]]',
                            'labelPosition': data['provider'][1]['value_1'] == 0 ? 'right' : 'right',
                            'balloonText': 'Importacion </br> [[volumen]]',
                        },
                        {
                            "type": 'column',
                            "valueField": 'value_2',
                            'fillAlphas': 1,
                            'lineColor': '#ff9800',
                            'fontSize': 18,
                            'labelColorField': 'color',
                            //'labelText': '[[label_t3]]',
                            'labelPosition': data['provider'][2]['value_2'] == 0 ? 'right' : 'right',
                            'balloonText': 'Importacion </br> [[volumen]]',
                        },
                        {
                            "type": 'column',
                            "valueField": 'value_3',
                            'fillAlphas': 1,
                            'lineColor': '#fb1818',
                            'fontSize': 18,
                            'labelColorField': 'color',
                            //'labelText': '[[label_t4]]',
                            'labelPosition': data['provider'][3]['value_3'] == 0 ? 'right' : 'right',
                            'balloonText': 'Importacion </br> [[volumen]]',
                        },
                        {
                            "type": 'column',
                            "valueField": 'svalue_0',
                            'fillAlphas': 1,
                            'lineColor': '#02881f7a',
                            'fontSize': 18,
                            'labelColorField': 'scolor',
                            //'labelText': '[[slabel_t1]]',
                            'labelPosition': data['provider'][0]['svalue_0'] == 0 ? 'right' : 'right',
                            'balloonText': 'Importacion </br> [[volumen2]]',
                            'newStack': true
                        },
                        {
                            "type": 'column',
                            "valueField": 'svalue_1',
                            'fillAlphas': 1,
                            'lineColor': '#1c24d87a',
                            'fontSize': 18,
                            'labelColorField': 'scolor',
                            //'labelText': '[[slabel_t2]]',
                            'labelPosition': data['provider'][1]['svalue_1'] == 0 ? 'right' : 'right',
                            'balloonText': 'Importacion </br> [[volumen2]]',
                        },
                        {
                            "type": 'column',
                            "valueField": 'svalue_2',
                            'fillAlphas': 1,
                            'lineColor': '#ff98007a',
                            'fontSize': 18,
                            'labelColorField': 'scolor',
                            //'labelText': '[[slabel_t3]]',
                            'labelPosition': data['provider'][2]['svalue_2'] == 0 ? 'right' : 'right',
                            'balloonText': 'Importacion </br> [[volumen2]]',
                        },
                        {
                            "type": 'column',
                            "valueField": 'svalue_3',
                            'fillAlphas': 1,
                            'lineColor': '#fb18187a',
                            'fontSize': 18,
                            'labelColorField': 'scolor',
                            //'labelText': '[[slabel_t4]]',
                            'labelPosition': 'left',
                            'labelPosition': data['provider'][3]['svalue_3'] == 0 ? 'right' : 'right',
                            'balloonText': 'Importacion </br> [[volumen2]]',
                        },
                        {
                            "type": 'line',
                            "valueField": 'extra',
                            'fillAlphas': 0,
                            'lineColor': '#fb1818',
                            'fontSize': 18,
                            'labelColorField': 'scolor',
                            'labelText': ' ',
                            'labelPosition': 'left'
                        },
                    ];
                    chartImport.titles[0].text = "Analisis Trimestral de Importaciones "+year.val()+ ' vs ' +year2.val();
                    chartImport.listeners = [{
                        "event": "drawn",
                        "method": downLabelVs,
                    }];
                    chartImport.validateData();
                    chartImport.animateAgain();
                }
            });
        }
    })

    function downLabel(e){
        let bars = e.chart.categoryAxis.chart.graphs;
        chartImport.clearLabels();
        let t1_w = bars[0].lastDataItem.columnWidth;
        let t2_w = bars[1].lastDataItem.columnWidth;
        let t3_w = bars[2].lastDataItem.columnWidth;
        let t4_w = bars[3].lastDataItem.columnWidth;
        let vol_1 = bars[0].data[0].dataContext.volumen;
        let vol_2 = bars[1].data[1].dataContext.volumen;
        let vol_3 = bars[2].data[2].dataContext.volumen;
        let vol_4 = bars[3].data[3].dataContext.volumen;
        chartImport.addLabel(t1_w + 43, 161, vol_1, 'right', 16, '#000000', 0, 1, true);
        chartImport.addLabel(t1_w + t2_w + 43, 287, vol_2, 'right', 16, '#000000', 0, 1, true);
        chartImport.addLabel(t1_w + t2_w + t3_w + 43, 413, vol_3, 'right', 16, '#000000', 0, 1, true);
        chartImport.addLabel(t1_w + t2_w + t3_w + t4_w + 43, 539, vol_4, 'right', 16, '#000000', 0, 1, true);

        chartImport.removeListener(chartImport, "drawn", downLabel);
        chartImport.dataProvider.pop();
        chartImport.validateData();
    }

    function downLabelVs(e){
        let bars = e.chart.categoryAxis.chart.graphs;
        chartImport.clearLabels();
        let x = 170;
        let y = 105;
        let y_vol = [92, 217, 344, 470, 132, 257, 384, 510];
        let acum1 = 0;
        let acum2 = 0;
        let acumWidth1 = 0;
        let acumWidth2 = 0;
        let colors_vol = ['#02881f', '#1c24d8', '#ff9800', '#fb1818', '#02881fb0', '#1c24d8b0', '#ff9800b0', '#fb1818b0'];

        for(let i=0; i<4; i++){
            acum1 = acum1 + bars[i].data[i].dataContext['value_'+i];
            acum2 = acum2 + bars[i].data[i].dataContext['svalue_'+i];
            acumWidth1 = acumWidth1 + bars[i].lastDataItem.columnWidth;
            acumWidth2 = acumWidth2 + bars[i+4].lastDataItem.columnWidth;


            let percent = bars[i].data[i].dataContext.percent === "" ? "" : bars[i].data[i].dataContext.percent == 0 ? "0%" : bars[i].data[i].dataContext.percent > 0 ? '\u21d1 ' + bars[i].data[i].dataContext.percent + "%" : '\u21d3 ' + bars[i].data[i].dataContext.percent + "%";


            if(acum1 > acum2){
                chartImport.addLabel(acumWidth1 + x, y, percent, 'left', 25, bars[i].data[i].dataContext.percent_color, 0, 1, true);
            }else{
                chartImport.addLabel(acumWidth2 + x, y, percent, 'left', 25, bars[i].data[i].dataContext.percent_color, 0, 1, true);
            }
            y = y + 126;

            bars[0].data[i].dataContext['value_'+i] != 0 ? chartImport.addLabel(acumWidth1 + 50, y_vol[i], bars[0].data[i].dataContext['volumen'], 'left', 15, '#000000', 0, 1, true) : chartImport.addLabel(46, y_vol[i], 'Sin Importaciones Registradas', 'left', 15, colors_vol[i], 0, 1, false);
            bars[0].data[i].dataContext['svalue_'+i] != 0 ? chartImport.addLabel(acumWidth2 + 50, y_vol[i+4], bars[0].data[i].dataContext['volumen2'], 'left', 15, '#000000', 0, 1, true) : chartImport.addLabel(46, y_vol[i+4], 'Sin Importaciones Registradas', 'left', 15, colors_vol[i+4], 0, 1, false);;
        }

        chartImport.removeListener(chartImport, "drawn", downLabelVs);
        chartImport.dataProvider.pop()
        chartImport.validateData();

    }

    function chartImportClear(){
        chartImport.dataProvider = [{
            'value': 0,
            'tri': 'T1'
            },
            {
            'value': 0,
            'tri': 'T2'
            },
            {
            'value': 0,
            'tri': 'T3'
            },
            {
            'value': 0,
            'tri': 'T4'
            },
        ];
        chartImport.validateData();
        chartImport.clearLabels();
        chartImport.removeListener(chartImport, "drawn", downLabel);
        chartImport.removeListener(chartImport, "drawn", downLabelVs);
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
                if(key < chartMarketPie.dataProvider.length){
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
                if(key > chartMarketPie.dataProvider.length - 1){
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
                "fillAlpha": 0.5,
                'enabled': false
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
                slice.labelRadius = 25;
                slice.labelColor = slice.color;
                if(slice.dataContext.title.includes('Otros Usuario')){
                    slice.labelColor = '#524802'; 
                    slice.labelRadius = -50;
                } 
                if(slice.dataContext.title.includes('none')) slice.alpha = 0;
                if(slice.dataContext.title.includes('Total Usuario')) {
                    slice.labelColor = '#412aff';
                    slice.labelRadius = -60;
                }
                if(slice.dataContext.title == "Otros" || slice.dataContext.title == "Herbicida") slice.labelRadius = 50;
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

    $('#market-second-select').change(function(){
        let year = $(this).val();
        let sector = "";
        let title = "";
        let pes_dol = "";
        let status = $('#market-convert').attr('status');
        let association = $('#market-association').val();

        pes_dol = status == 'dol' ? '' : '_dolar';

        $('#market-graph').removeClass('col-sm-12').addClass('col-sm-6');
        $('#market-graph-3, #market-current-2').removeClass('hidden');
        if(association == 'UMFFAAC'){
            sector = 'umf';
            title = 'UMFFAAC';
        }else if(association == 'PROCCYT'){
            sector = 'pro';
            title = 'PROCCYT';
        }else{
            sector = 'total';
            title = 'Mercado Total';
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

    $('#market-first-select').change(function(){
        let year = $(this).val();
        let sector = "";
        let title = "";
        let pes_dol = "";
        let status = $('#market-convert').attr('status');
        let association = $('#market-association').val();

        pes_dol = status == 'dol' ? '' : '_dolar';

        if(association == 'UMFFAAC'){
            sector = 'umf';
            title = 'UMFFAAC';
        }else if(association == 'PROCCYT'){
            sector = 'pro';
            title = 'PROCCYT';
        }else{
            sector = 'total';
            title = 'Mercado Total';
        }  
        $.ajax({
            type: "POST",
            url: '/market_year_update',
            data: {
                'year': year,
                'sector': sector
            },
            success: function( data ) {
                current_provider = data['chartData'];
                $('#market-current span').text(data['exchange']);
                $('#market-year').text(year);

                chartMarketPie.dataProvider = data['chartData'];
                chartMarketPie.allLabels[0].text = formatter_1.format(data['chartData'][0]['total'+pes_dol]); 
                chartMarketPie.titles[0].text = title + " " +year;

                if(chartMarketPie.radius != "25%"){
                    //chartMarketPie.radius = "25%";
                    //chartMarketPie.allLabels[0].size = 16;
                }

                chartMarketPie.validateData();
                chartMarketPie.animateAgain();

                if(trigger_key){
                    $('#vs-insecticida input').trigger(
                        $.Event('keyup', {keyCode: 48, which: 48})
                    );
                    $('#vs-insecticida input').trigger(
                        $.Event('keyup', {keyCode: 48, which: 48})
                    );
                    $('#vs-total input').trigger(
                        $.Event('keyup', {keyCode: 48, which: 48})
                    );
                    $('#vs-total input').trigger(
                        $.Event('keyup', {keyCode: 48, which: 48})
                    );
                }

                trigger_key = false;
            }
        })
    })

    $('#market-association').change(function(){
        if($('#market-checkbox-2').prop('checked')) $('#market-second-select').trigger('change');
        $('#market-first-select').trigger('change');
        $('#market-association-2').val($(this).val());
    })

    $('#market-association-2').change(function(){
        $('#market-association').val($(this).val());
        $('#market-first-select').trigger('change');
        trigger_key = true;
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
            "totalText": "[[round_suma]]",
        }];

        chartMarketSerial.write('market-graph-2');
        if(document.getElementById('market-1') !== null) document.getElementById('market-1').click();
        chartMarketSerial.addListener("clickGraphItem", function (event) {
            let year = event.item.category;
            let status = $('#market-convert').attr('status');
            let sector = "";
            let pes_dol = "";

            pes_dol = status == 'dol' ? '' : '_dolar';

            if(event.graph.title == 'UMFFAAC') sector = 'umf';
            else if(event.graph.title == 'PROCCYT') sector = 'pro';

            $('#market-association').val(event.graph.title);
            $('#market-first-select').val(year);

            if(sector == 'umf' || sector == 'pro'){
                $('#market-graph-2, #market-legend-2, .radio-market').addClass('hidden');
                $('#market-graph, #market-current, #market-legend, #market-nav').removeClass('hidden');
                $.ajax({
                    type: "POST",
                    url: '/market_year_update',
                    data: {
                        'year': year,
                        'sector': sector
                    },
                    success: function( data ) {
                        current_provider = data['chartData'];
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
        let exchange = parseFloat($('#market-current span:nth-child(2)').text());
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
            chartMarketSerial.valueAxes[0].totalText = '[[round_suma_dol]]';

            //vs personalizados
            if($('#market-checkbox').prop('checked')){
                $('#vs-all input').each(function(){
                    let val = $(this).val().replace(/,/gi, '');
                    if(val != '') $(this).val((val/exchange).toFixed(2));
                    format_number_input($(this));
                })
            }

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
            chartMarketSerial.valueAxes[0].totalText = '[[round_suma]]';

            //vs personalizados
            if($('#market-checkbox').prop('checked')){
                $('#vs-all input').each(function(){
                    let val = $(this).val().replace(/,/gi, '');
                    if(val != '') $(this).val((val*exchange).toFixed(2));
                    format_number_input($(this));
                })
            }

            $(this).attr('status', 'dol');
            $(this).text('Convertir a Dolares');
            $('#market-dol').text('Precios Reflejados en Pesos Mexicanos');
        }

        $('#vs-insecticida, #vs-herbicida, #vs-fungicida, #vs-otros, #vs-total').tooltip('destroy');

        chartMarketPie2.allLabels[0].text = $('#market-checkbox').prop('checked') ? "" : formatter_1.format(total1);
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
                "fillAlphas": 0.65,
                "labelText": "[[pro_percent]]%",
                "balloonText": "<b>"+title_2+":</b> $[[umf_total_ballon"+pes_dol+"]] <br> <b>"+title_1+":</b> $[[pro_total_ballon"+pes_dol+"]] <br> <b>Total:</b> $[[suma"+pes_dol+"]]",
            },
            {
                "type": "column",
                "title": title_2,
                "lineColor": color_2,
                "valueField": "umf_total"+pes_dol,
                "fillAlphas": 0.65,
                "labelText": "[[umf_percent]]%",
                "balloonText": "<b>"+title_2+":</b> $[[umf_total_ballon"+pes_dol+"]] <br> <b>"+title_1+":</b> $[[pro_total_ballon"+pes_dol+"]] <br> <b>Total:</b> $[[suma"+pes_dol+"]]",
            },
        ];
    }

    $('#back-market').click(function(e){
        chartMarketPie2.allLabels[0].text = " ";
        chartMarketPie2.dataProvider = [];
        chartMarketPie2.validateData();

        chartMarketPie.allLabels[0].text = " ";
        chartMarketPie.dataProvider = [];
        chartMarketPie.allLabels[0].size = 20;
        chartMarketPie2.titles[0].text = "";
        chartMarketPie2.innerRadius = "50%";
        chartMarketPie2.radius = 25;
        chartMarketPie2.outlineAlpha = 0.5;
        chartMarketPie2.depth3D = 15;
        chartMarketPie.validateData();

        $('.select-market select').val("");

        $('#market-checkbox, #market-checkbox-2').prop('checked', false);

        $('#vs-all input').val('');

        $('#market-graph').removeClass('col-sm-6').addClass('col-sm-12');
        $('#market-graph-2, .radio-market, #market-legend-2, .select-market').removeClass('hidden');
        $('#market-graph, #market-current, #market-current-2, #market-nav, #market-legend, #market-graph-3, #vs-all, #vs-text-market, #market-second-select').addClass('hidden');
        $('#market-graph-3').addClass('col-sm-6').removeClass('col-sm-12 abosulte-market-3');
        $('#market-offset').addClass('col-md-offset-5');
        chartMarketPie.radius = "35%";
    })

    $('#market-checkbox').change(function(){
        chartMarketPie2.allLabels[0].text = " ";
        chartMarketPie2.dataProvider = [];
        chartMarketPie2.titles[0].text = "";
        chartMarketPie2.innerRadius = "50%";
        chartMarketPie2.radius = 25;
        chartMarketPie2.outlineAlpha = 0.5;
        chartMarketPie2.depth3D = 15;
        chartMarketPie2.validateData();

        chartMarketPie.dataProvider = current_provider;
        chartMarketPie.allLabels[0].size = 20;
        chartMarketPie.radius = "35%";
        chartMarketPie.validateData();

        $('#market-legend').css('top', 480)

        $('#market-graph').removeClass('col-sm-6').addClass('col-sm-12');
        $('#market-second-select').val("");
        $('#market-current-2').addClass('hidden');

        $('#vs-all input').each(function(){
            $(this).val('')
        })

        if($(this).prop('checked')){
            chartMarketPie2.innerRadius = "95%";
            chartMarketPie2.radius = "27%";
            chartMarketPie2.outlineAlpha = 0;
            chartMarketPie2.depth3D = 0;
            $('#vs-all').removeClass('hidden');
            $('.select-market, #vs-text-market').addClass('hidden');
            $('#market-checkbox-2').prop('checked', false).trigger('change');
            $('#market-graph-3').removeClass('hidden col-sm-6').addClass('col-sm-12 abosulte-market-3');
        }else{
            $('#vs-insecticida, #vs-herbicida, #vs-fungicida, #vs-otros, #vs-total').tooltip('destroy');
            $('#market-graph-3').addClass('hidden col-sm-6').removeClass('col-sm-12 abosulte-market-3');
            $('.select-market').removeClass('hidden');
            $('#vs-all, #market-second-select').addClass('hidden');
        }
    })

    $('#market-checkbox-2').change(function(){
        if($(this).prop('checked')){
            $('#market-checkbox').prop('checked', false).trigger('change');
            $('#vs-text-market, #market-second-select').removeClass('hidden');
            $('#market-offset').removeClass('col-md-offset-5');
        }else{
            chartMarketPie.dataProvider = current_provider;
            chartMarketPie.allLabels[0].size = 20;
            chartMarketPie.radius = "35%";
            chartMarketPie.validateData();

            $('#market-offset').addClass('col-md-offset-5');
            $('#market-current-2').addClass('hidden');
            $('#vs-text-market, #market-second-select').addClass('hidden');
            $('#market-graph').removeClass('col-sm-6').addClass('col-sm-12');
            $('#market-graph-3').addClass('hidden col-sm-6').removeClass('col-sm-12 abosulte-market-3');
        }
    })

    
    $('#vs-insecticida input, #vs-herbicida input, #vs-fungicida input, #vs-otros input').keyup(function(e){
        let allow_key_values = [8,37,39,48,49,50,51,52,53,54,55,56,57,188,190,96,97,98,99,100,101,102,103,104,105,110, 116];
        if(!allow_key_values.includes(e.keyCode)){
            $(this).val($(this).val().slice(0, -1));
            return;
        }

        let val_ins = parseFloat($('#vs-insecticida input').val().replace(/,/gi, ''));
        let val_her = parseFloat($('#vs-herbicida input').val().replace(/,/gi, ''));
        let val_fun = parseFloat($('#vs-fungicida input').val().replace(/,/gi, ''));
        let val_otr = parseFloat($('#vs-otros input').val().replace(/,/gi, ''));
        let new_provider = JSON.parse(JSON.stringify(current_provider));
        let pos_gra = 1;
        let legend_pos = 480;
        let status = $('#market-convert').attr('status');
        $('#vs-total').tooltip('destroy');

        if(market_custom_validity($('#vs-insecticida input'), $('#vs-insecticida'), new_provider[0], val_ins, status)) return;
        if(market_custom_validity($('#vs-herbicida input'), $('#vs-herbicida'), new_provider[1], val_her, status)) return;
        if(market_custom_validity($('#vs-fungicida input'), $('#vs-fungicida'), new_provider[2], val_fun, status)) return;
        if(market_custom_validity($('#vs-otros input'),  $('#vs-otros'), new_provider[3], val_otr, status)) return;
          

        if(!isNaN(val_ins)){
            new_provider = user_values_market(new_provider, 0, pos_gra, val_ins, '#ff7042', 'Insecticida');
            pos_gra = pos_gra + 1;
            legend_pos = legend_pos - 35;
        }
        pos_gra = pos_gra + 1;

        if(!isNaN(val_her)){
            new_provider = user_values_market(new_provider, 1, pos_gra, val_her, '#64e669', 'Herbicida');
            pos_gra = pos_gra + 1;
            legend_pos = legend_pos - 35;
        }
        pos_gra = pos_gra + 1;

        if(!isNaN(val_fun)){
            new_provider = user_values_market(new_provider, 2, pos_gra, val_fun, '#bd5ada', 'Fungicida');
            pos_gra = pos_gra + 1;
            legend_pos = legend_pos - 35;
        }
        pos_gra = pos_gra + 1;

        if(!isNaN(val_otr)){
            new_provider = user_values_market(new_provider, 3, pos_gra, val_otr, '#e4d653', 'Otros');
            legend_pos = legend_pos - 35;
        }

        $('#market-legend').css('top', legend_pos)
        chartMarketPie.dataProvider = new_provider;
        chartMarketPie.validateData();

        format_number_input($(this));
    });

    $('#vs-total input').keyup(function(e){
        let val_total = parseFloat($(this).val().replace(/,/gi, ''));
        let exchange = parseFloat($('#market-current span:nth-child(2)').text());
        let val_dol = parseFloat((val_total/exchange).toFixed(2));
        let total = current_provider[0].total;
        let total_dol = current_provider[0].total_dolar;
        let status = $('#market-convert').attr('status');  
        $('#vs-insecticida, #vs-herbicida, #vs-fungicida, #vs-otros').tooltip('destroy');

        let provider_val = status == 'dol' ? total : total_dol;
        let label = status == 'dol' ? current_provider[0]['total_label'] : current_provider[0]['total_dolar_label'];

        if(val_total > provider_val){
            let index_dot = $(this).val().indexOf('.');
            let current_dec = index_dot == -1 ? "" : $(this).val().slice(index_dot);
            let back_ins = index_dot == -1 ? $(this).val().slice(0, -1) : $(this).val().slice(0, index_dot).slice(0, -1) + current_dec;

            $(this).val(back_ins);
            $('#vs-total').tooltip({'title': 'Valor Máximo: ' + label}).tooltip('show');
            return true;
        }else{
            $('#vs-total').tooltip('destroy');
        } 

        if(status == 'pes'){
            val_dol = val_total;
            val_total = parseFloat((val_total*exchange).toFixed(2));
        }

        let percent = Math.round((val_total*100)/total);

        let provider = [
            {
                'color': '#412aff',
                'percent': percent,
                'title': 'Total' + ' Usuario',
                'value': val_total,
                'value_dolar': val_dol,
                'value_label': formatter_1.format(val_total).replace('$', ''),
                'legend_dolar': formatter_1.format(val_dol).replace('$', '')
            },
            {
                'color': 'rgba(255,255,255,0)',
                'percent': 30,
                'title': 'none',
                'value': total - val_total,
                'value_dolar': total_dol - val_dol,
                'value_label': "",
                'legend_dolar': ""
            },

        ];

        chartMarketPie2.dataProvider = provider;
        chartMarketPie2.validateData();
        chartMarketPie.validateData();

        format_number_input($(this));
    });

    function user_values_market(new_provider, pos, pos_gra, val, color, name){
        let exchange = parseFloat($('#market-current span:nth-child(2)').text());
        let status = $('#market-convert').attr('status');
        let val_dol = parseFloat((val/exchange).toFixed(2));
        let percent = Math.round((val*100)/current_provider[pos].value);
        let sector_percent = Math.round((val*100)/new_provider[0]['total']);

        if(status == 'pes'){
            val_dol = val;
            val = parseFloat((val*exchange).toFixed(2));
            percent = Math.round((val_dol*100)/current_provider[pos].value_dolar);
        }
        let new_data = {
            'color': color,
            'percent': percent,
            'title': name + ' Usuario',
            'value': val,
            'value_dolar': val_dol,
            'value_label': formatter_1.format(val).replace('$', ''),
            'legend_dolar': formatter_1.format(val_dol).replace('$', '')
        };
        new_provider[pos_gra-1].value = current_provider[pos].value - val;
        new_provider[pos_gra-1].value_dolar = current_provider[pos].value_dolar - val_dol;
        new_provider[pos_gra-1].percent = current_provider[pos].percent - sector_percent;
        new_provider[pos_gra-1].value_label = formatter_1.format(current_provider[pos].value - val).replace('$', '');
        new_provider.splice(pos_gra, 0, new_data);
        return new_provider;
    }

    function market_custom_validity(input, tol_div, provider, val, status){
        let label = status == 'dol' ? provider['value_label'] : provider['legend_dolar'];
        let provider_val = status == 'dol' ? provider['value'] : provider['value_dolar'];
        if(val > provider_val){
            let index_dot = input.val().indexOf('.');
            let current_dec = index_dot == -1 ? "" : input.val().slice(index_dot);
            let back_ins = index_dot == -1 ? input.val().slice(0, -1) : input.val().slice(0, index_dot).slice(0, -1) + current_dec;

            input.val(back_ins);
            tol_div.tooltip({'title': 'Valor Máximo: ' + label}).tooltip('show');
            return true;
        }else{
            tol_div.tooltip('destroy');
            return false;
        } 
    }

    function format_number_input(input){
        let current_val = input.val().replace(/,/gi, '');
        if(current_val <= 0) return;
        let index_dot = current_val.indexOf('.');
        let current_dec = index_dot == -1 ? "" : current_val.slice(index_dot);


        let val_format = formatter_1.format(current_val).replace('$', '');
        index_dot = val_format.indexOf('.');
        let val_wo_dec = val_format.slice(0, index_dot);
        input.val(val_wo_dec + current_dec);
    }

    ////////////////////////////////////////////// Fin Market Values ////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////   




    ////////////////////////////////////////////// Inicio gestion Admins ////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////// 

    $('body').on('click', '.active-admin', function(){
        var element = $(this);
        var id = $(this).attr('id');
        var user_email = $(this).closest('tr').find('#email').html();
        var row_state_active = $(this).closest('tr').find('#state');
        var state = $(this).attr('state');
        var message_state = state === '1' ? 'Activo' : 'Inactivo';
        $.ajax({
            type: "GET",
            url: '/admin/activateAdmin/'+ id +'/'+ state,
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

    $('body').on('click', '.delete-admin', function(){
        var id = $(this).attr('id');
        var row = $(this).closest('tr');
        var user_email = $(this).closest('tr').find('#email').html();
        $.ajax({
            type: "GET",
            url: '/admin/deleteAdmin/'+ id,
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
    
    ////////////////////////////////////////////// Fin gestion Admins ////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////// 

    
    
    ////////////////////////////////////////////// Analisis de cultivos ////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////// 

    //----------------------------------------------------general
    AmCharts.ready(function () {
       
        let labelForModalPie = ""
        let dataForModalPie = []
        let dataForModalTree = []
        let dataForModalPyramid = []
        let dataForModalForcedTree = []
        let dataForModalBaseMarket = []
        let piramidMaxValue = 0
        let dataForModalConfig = []

        const searchMarketFarmValues = () => {
            let activesStates = []
            mexicoIds.forEach(id => {
                var mex = polygonSeries.getPolygonById(id);
                if(mex.isActive){
                    activesStates.push(states[id].name) 
                }
            })

            let activeFarms = []

            $('table > tbody  > tr > th').each(function(i, th) { 
                const element = $(th)
                if(element.attr('active') === "true" && !element.hasClass('ignore')){
                    activeFarms.push(element.attr('value'))
                }
            });

            if(activesStates.length <= 0 || activeFarms.length <= 0) {
                chartPieMarket.data = []
                marketFarmTree.data = []
                totalFarmChart.data = []
                marketPiramidState.data = []
                chartForcedTree.data = []
                dataForModalPie = []
                label.text = "";
                labelForModalPie = "";
                return 
            }
            
            $.ajax({
                type: "GET",
                url: '/market/farming/values/'+ JSON.stringify(activesStates) + "/" + JSON.stringify(activeFarms),
                success: function( data ) {
                    const farmKeys = Object.keys(data["farm_data"])
                    const stateKeys = Object.keys(data["states_data"])
                    let farmsPie = []
                    let farmTree = []
                    let farmPiramid = []
                    let farmForceTree = [] 
                    let total = 0
                    

                    dataForModalConfig = data["states_data"]
            
                    farmKeys.forEach(product => total = total + data["farm_data"][product])

                    stateKeys.forEach(state => {
                        
                        const stateFarmKeys = Object.keys(data["states_data"][state])

                        let totalState = stateFarmKeys.reduce((carry, farm )=> {
                            carry = carry + data["states_data"][state][farm]
                            return carry
                        }, 0)


                        return farmForceTree.push({
                            name: state,
                            nameValue: `${state} \n ${totalState.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`,
                            children: stateFarmKeys.map(farm => {
                                return {
                                    name: data["states_data"][state][farm], 
                                    value: data["states_data"][state][farm],
                                    valueState: `${farm}: ${data["states_data"][state][farm].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} HA`,
                                    fill: farm_products[farm].color,
                                    counterString: (`${data["states_data"][state][farm].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} HA`).length
                                }
                            }),
                            collapsed: true
                        })
                    })

                    farmKeys.forEach(product => {
                        let productAdapt = product.toLowerCase().charAt(0).toUpperCase() + product.toLowerCase().slice(1)
                        let percent = ((data["farm_data"][product] * 100) / total).toFixed(1)
                        let index = 0

                        if(data["farm_data"][product] > 0){
                            farmsPie.push({
                                "index": index,
                                "active": true,
                                "value": data["farm_data"][product],
                                "product": productAdapt,
                                "img": `/project_images/${farm_products[product].imgB}`,
                                "config": {
                                    "fill": farm_products[product].color
                                },

                            })
        
                            farmTree.push({
                                name: "",
                                color: farm_products[product].color,
                                img: `/project_images/${farm_products[product].imgB}`,
                                active: true,
                                children: [
                                    {
                                        name: productAdapt,
                                        value: data["farm_data"][product],
                                        color: farm_products[product].color,
                                        img: `/project_images/${farm_products[product].imgB}`,
                                    }
                                ]
                            })
        
                            farmPiramid.push({
                                "product": productAdapt,
                                "active": true,
                                "farmValue": data["farm_data"][product],
                                "totalValue": data["total_state"][product],
                                "farmValueHA": data["farm_data"][product] + " HA",
                                "totalValueHA": data["total_state"][product] +" HA",
                                "config": {
                                    "fill": farm_products[product].color,
                                    "stroke": farm_products[product].color,
                                }
                            })
                        }else{
                            console.log(product)
                        }

                        index = index + 1
                    })

                    farmsPie = farmsPie.sort(function(a, b) {return b.value - a.value;})
                    farmTree = farmTree.sort(function(a, b) {return b.children.value - a.children.value;})
                    farmPiramid = farmPiramid.sort(function(a, b) {return b.totalValue - a.totalValue;})

                    chartPieMarket.data = farmsPie.slice(0, 3)
                    dataForModalPie = farmsPie

                    marketFarmTree.data = farmTree.slice(0, 3)
                    dataForModalTree = farmTree
                    dataForModalPyramid = farmPiramid

                    totalFarmValueAxis.max = farmPiramid[0].totalValue
                    stateFarmValueAxis.max = farmPiramid[0].totalValue
                    totalFarmChart.data = JSON.parse(JSON.stringify(farmPiramid.slice(0, 3).reverse()));
                    marketPiramidState.data = JSON.parse(JSON.stringify(farmPiramid.slice(0, 3).reverse()));

                    chartForcedTree.data = [{
                        name: `Total \n ${data["total_superficie"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} HA`,
                        children: farmForceTree,
                        collapsed: true,
                    }]

                    dataForModalForcedTree= [{
                        name: `Total \n ${data["total_superficie"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} HA`,
                        children: farmForceTree,
                        collapsed: false,
                    }]

                    label.text = "Total " + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " HA";

                    labelForModalPie = "Total \n" + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " HA";

                },
                error: (e) => {
                    console.log(e)
                }
            });
        }


        const searchMarketBaseValues = () => {
            let activesStates = []
            mexicoIds.forEach(id => {
                var mex = polygonSeries.getPolygonById(id);
                if(mex.isActive){
                    activesStates.push(states[id].name) 
                }
            })
        
            let activeFarms = []
        
            $('table > tbody  > tr > th').each(function(i, th) { 
                const element = $(th)
                if(element.attr('active') === "true" && !element.hasClass('ignore')){
                    activeFarms.push(farm_products[element.attr('value')].adapterBase)
                }
            });

            if(activesStates.length <= 0 || activeFarms.length <= 0){
                pieChartBaseMarket.data = []
                $('#insecticidaValue').text('$0')
                $('#herbicidaValue').text('$0')
                $('#fungicidaValue').text('$0')
                $('#otrosValue').text('$0')
                $('#totalValue').text('$0')
                return
            }  
        
            $.ajax({
                type: "GET",
                url: '/market/getBaseByStatesFarms/'+ JSON.stringify(activesStates) + "/" + JSON.stringify(activeFarms),
                success: function( data ) {
                    const herbicida = data['herbicida']
                    const insecticida = data['insecticida']
                    const fungicida = data['fungicida']
                    const otro = data['otro']
                    const total = data['total']
                    const statesValues = data['statesValues']
                    const stateFarmsValues = data['stateFarmsValues']

                    marketInsecticidaValue = insecticida 
                    marketHerbicidaValue = herbicida 
                    marketFungicidadaValue = fungicida
                    marketOtroValue = otro 
                    markettotalValue = total 

                    $("#insecticida-product-market").attr('active') === "false" ? $('#insecticidaValue').text('$0') : $('#insecticidaValue').text('$' + formatPrice(insecticida.toString()))
                    $("#herbicida-product-market").attr('active') === "false" ? $('#herbicidaValue').text('$0') : $('#herbicidaValue').text('$' + formatPrice(herbicida.toString()))
                    $("#fungicida-product-market").attr('active') === "false" ? $('#fungicidaValue').text('$0') : $('#fungicidaValue').text('$' + formatPrice(fungicida.toString()))
                    $("#otros-product-market").attr('active') === "false" ? $('#otrosValue').text('$0') : $('#otrosValue').text('$' + formatPrice(otro.toString()))
                    $("#total-product-market").attr('active') === "false" ? $('#totalValue').text('$0') : $('#totalValue').text('$' + formatPrice(total.toString()))

                    setTotalProductMarket()

                    dataForModalBaseMarket = activesStates.reduce((carry, state) => {
                        
                        const breakdown = activeFarms.reduce((carry, farm) => {
                            carry.push({
                                'cultivo': farm,
                                "insecticida": stateFarmsValues[state][farm]['insecticida'], 
                                "herbicida": stateFarmsValues[state][farm]['herbicida'],
                                "fungicida": stateFarmsValues[state][farm]['fungicida'],
                                "otro": stateFarmsValues[state][farm]['otro'],
                                "max": stateFarmsValues[state][farm]['max']
                            })
                            return carry
                        }, [])


                        carry.push({
                            "category": state,
                            "value": statesValues[state]['value'],
                            'max': statesValues[state]['max'],
                            "breakdown": breakdown
                        })

                        return carry
                    }, [])

                    pieChartBaseMarket.data = dataForModalBaseMarket
                      
                },
                error: (e) => {
                    console.log(e)
                }
            });
        }



        //-----------------------------------------------------mapa

        var mapMarket = am4core.create("mapMarket", am4maps.MapChart);
        mapMarket.geodata = am4geodata_mexicoHigh;
        mapMarket.projection = new am4maps.projections.Miller();

        var polygonSeries = mapMarket.series.push(new am4maps.MapPolygonSeries());
        polygonSeries.useGeodata = true;

        var polygonTemplate = polygonSeries.mapPolygons.template;
        polygonTemplate.tooltipText = "{name}";
        polygonTemplate.fill = am4core.color("#d2d2d2");

        var hs = polygonTemplate.states.create("hover");
        hs.properties.fill = am4core.color("#6c70ec");

        var ac = polygonTemplate.states.create("active");
        ac.properties.fill = am4core.color("#3034a5");
        
        polygonTemplate.events.on("hit", function(ev) {       
            ev.target.isActive = !ev.target.isActive  

            let state = states[ev.target.dataItem.dataContext.id].name
            if(ev.target.isActive ){
                statesBaseMarket.push(state)
            }else{
                statesBaseMarket = statesBaseMarket.filter(x => x != state)
            }

            mexicoIds.forEach(id => {
                let mex = polygonSeries.getPolygonById(id);
                states[id].active = mex.isActive
            })

            searchMarketFarmValues()
            searchMarketBaseValues()
        });  

        polygonTemplate.propertyFields.fill = "fill";

        $('#selectFarmingAll').click(function(){

            let isActive = $(this).attr('active') === "true"
            $(this).attr('active', !isActive)

            isActive ? $(this).html('Seleccionar Todos') : $(this).html('Remover Todos')

            mexicoIds.forEach(id => {
                var us = polygonSeries.getPolygonById(id);
                us.isActive = !isActive;
            })

            statesBaseMarket = isActive ? [] : Object.values(states).map(s => s.name)

            searchMarketFarmValues()
            searchMarketBaseValues()
        })


        //----------------------------------------------seleccion de cultivos

        $('.market-all').click(function(e){
            let isActive = $(this).attr('active') === "true"
            $(this).attr('active', !isActive)

            !isActive ? $(this).children("img").attr('src', `/project_images/all.png`) : $(this).children("img").attr('src', `/project_images/none.png`)

            $('#market-products-table th').each(function(){
                let farm = $(this).attr('value')
                let ignore = $(this).hasClass('ignore') === true

                if(!ignore){
                    $(this).attr('active', !isActive)
                    farm_products[farm].active = !isActive

                    if(isActive){
                        $(this).children("img").attr('src', `/project_images/${farm_products[farm].img}`)
                        $(this).removeClass('market-product-active').addClass('market-product-desactive')
                    }else{
                        $(this).children("img").attr('src',`/project_images/${farm_products[farm].imgB}`)
                        $(this).removeClass('market-product-desactive').addClass('market-product-active')
                    }
                } 
            })

            searchMarketFarmValues()
            searchMarketBaseValues()
        })

        $('#market-products-table th').click((event) => {
            let isActive = $(event.currentTarget).attr('active') === "true"
            let farm = $(event.currentTarget).attr('value')
            let all = $(event.currentTarget).hasClass('ignore') === true

            if(all) return

            $(event.currentTarget).attr('active', !isActive)
            farm_products[farm].active = !isActive

            if(isActive){
                $(event.currentTarget).children("img").attr('src', `/project_images/${farm_products[farm].img}`)
                $(event.currentTarget).removeClass('market-product-active').addClass('market-product-desactive')
            }else{
                $(event.currentTarget).children("img").attr('src',`/project_images/${farm_products[farm].imgB}`)
                $(event.currentTarget).removeClass('market-product-desactive').addClass('market-product-active')
            }

            searchMarketFarmValues()
            searchMarketBaseValues()
        })

        $('#insecticida-product-market').click((event) => {
            let isActive = $(event.currentTarget).attr('active') === "true"

            if(isActive){
                $(event.currentTarget).attr('active', 'false')
                $(event.currentTarget).removeClass('insecticida-product-market').addClass('default-color-product')
                $('#insecticidaValue').text('$0')
            }else{
                $(event.currentTarget).attr('active', 'true')
                $(event.currentTarget).removeClass('default-color-product').addClass('insecticida-product-market')
                $('#insecticidaValue').text('$' + formatPrice(marketInsecticidaValue.toString()))
            }

            setTotalProductMarket()
        })

        $('#herbicida-product-market').click((event) => {
            let isActive = $(event.currentTarget).attr('active') === "true"

            if(isActive){
                $(event.currentTarget).attr('active', 'false')
                $(event.currentTarget).removeClass('herbicida-product-market').addClass('default-color-product')
                $('#herbicidaValue').text('$0')
            }else{
                $(event.currentTarget).attr('active', 'true')
                $(event.currentTarget).removeClass('default-color-product').addClass('herbicida-product-market')
                $('#herbicidaValue').text('$' + formatPrice(marketHerbicidaValue.toString()))
            }

            setTotalProductMarket()
        })

        $('#fungicida-product-market').click((event) => {
            let isActive = $(event.currentTarget).attr('active') === "true"

            if(isActive){
                $(event.currentTarget).attr('active', 'false')
                $(event.currentTarget).removeClass('fungicida-product-market').addClass('default-color-product')
                $('#fungicidaValue').text('$0')
            }else{
                $(event.currentTarget).attr('active', 'true')
                $(event.currentTarget).removeClass('default-color-product').addClass('fungicida-product-market')
                $('#fungicidaValue').text('$' + formatPrice(marketFungicidadaValue.toString()))
            }

            setTotalProductMarket()
        })

        $('#otros-product-market').click((event) => {
            let isActive = $(event.currentTarget).attr('active') === "true"

            if(isActive){
                $(event.currentTarget).attr('active', 'false')
                $(event.currentTarget).removeClass('otros-product-market').addClass('default-color-product')
                $('#otrosValue').text('$0')
            }else{
                $(event.currentTarget).attr('active', 'true')
                $(event.currentTarget).removeClass('default-color-product').addClass('otros-product-market')
                $('#otrosValue').text('$' + formatPrice(marketOtroValue.toString()))
            }

            setTotalProductMarket()
        })

        $('#total-product-market').click((event) => {
            let isActive = $(event.currentTarget).attr('active') === "true"

            if(isActive){
                $(event.currentTarget).attr('active', 'false')
                $(event.currentTarget).removeClass('total-product-market').addClass('default-color-product')
                $('#totalValue').text('$0')
            }else{
                $(event.currentTarget).attr('active', 'true')
                $(event.currentTarget).removeClass('default-color-product').addClass('total-product-market')
                $('#totalValue').text('$' + formatPrice(markettotalValue.toString()))
            }

            setTotalProductMarket()
        })

        const setTotalProductMarket = () => {
            let insecticida = $('#insecticida-product-market').attr('active') === "true" ? marketInsecticidaValue : 0
            let herbicida = $('#herbicida-product-market').attr('active') === "true" ? marketHerbicidaValue : 0
            let fungicida = $('#fungicida-product-market').attr('active') === "true" ? marketFungicidadaValue : 0
            let otros = $('#otros-product-market').attr('active') === "true" ? marketOtroValue : 0
            let total = $('#total-product-market').attr('active') === "true"

            if(total) return
            let totalValue = insecticida + herbicida + fungicida + otros
            $('#totalValue').text('$' + formatPrice(totalValue.toString()))
        }

        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                placement: "top",
                container: 'body'
            })
        })


        //---------------------------------------------------------grafica de baseMarketSmall
          
        // Create chart instance
        var chartBaseMarketSmall = am4core.create("baseMarketSmall", am4core.Container);
        chartBaseMarketSmall.width = am4core.percent(100);
        chartBaseMarketSmall.height = am4core.percent(100);
        chartBaseMarketSmall.layout = "horizontal";
          

        var columnChartBaseMarket = chartBaseMarketSmall.createChild(am4charts.XYChart);
       
        columnChartBaseMarket.data = []

        // columnChartBaseMarket.legend = new am4charts.Legend();
        // columnChartBaseMarket.legend.position = "bottom";

        // Create axes
        var categoryAxisBaseMarket = columnChartBaseMarket.yAxes.push(new am4charts.CategoryAxis());
        categoryAxisBaseMarket.dataFields.category = "cultivo";
        categoryAxisBaseMarket.renderer.grid.template.opacity = 0;

        var valueAxisBaseMarket = columnChartBaseMarket.xAxes.push(new am4charts.ValueAxis());
        valueAxisBaseMarket.min = 0;
        valueAxisBaseMarket.renderer.grid.template.opacity = 0;
        valueAxisBaseMarket.renderer.ticks.template.strokeOpacity = 0.5;
        valueAxisBaseMarket.renderer.ticks.template.stroke = am4core.color("#495C43");
        valueAxisBaseMarket.renderer.ticks.template.length = 10;
        valueAxisBaseMarket.renderer.line.strokeOpacity = 0.5;
        valueAxisBaseMarket.renderer.baseGrid.disabled = true;

        // Create series
        function createSeriesxxxx(field, name, color) {
            let series = columnChartBaseMarket.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueX = field;
            series.dataFields.categoryY = "cultivo";
            series.stacked = true;
            series.name = name;
            series.fill = color
            series.stroke = color
            series.columns.template.tooltipText = field + " ${valueX}";
        }

        ['insecticida', 'herbicida', 'fungicida', 'otro'].forEach((element, index) => {
            let color = ["#c10000", "#026f02", "#750275", "#ffa500"]
            createSeriesxxxx(element, element, color[index]);
        });
        

          /**
           * Pie chart
           */
          
          // Create chart instance
          var pieChartBaseMarket = chartBaseMarketSmall.createChild(am4charts.PieChart);
          pieChartBaseMarket.data = [];
          pieChartBaseMarket.innerRadius = am4core.percent(50);
          
          
          // Add and configure Series
          var pieSeriesBaseMarket = pieChartBaseMarket.series.push(new am4charts.PieSeries());
          pieSeriesBaseMarket.dataFields.value = "value";
          pieSeriesBaseMarket.dataFields.category = "category";
          pieSeriesBaseMarket.slices.template.propertyFields.fill = "color";
          pieSeriesBaseMarket.labels.template.disabled = true;
          
        //   let asBaseChart = pieSeriesBaseMarket.slices.template.states.getKey("active");
        //   asBaseChart.properties.shiftRadius = 0;
          
          let hsMrket = pieSeriesBaseMarket.slices.template.states.getKey("hover");
          hsMrket.properties.scale = 1;
          
          // Set up labels
          var label1BaseMarket = pieChartBaseMarket.seriesContainer.createChild(am4core.Label);
          label1BaseMarket.text = "";
          label1BaseMarket.horizontalCenter = "middle";
          label1BaseMarket.fontSize = 35;
          label1BaseMarket.fontWeight = 600;
          label1BaseMarket.dy = -30;
          
          var label2BaseMarket = pieChartBaseMarket.seriesContainer.createChild(am4core.Label);
          label2BaseMarket.text = "";
          label2BaseMarket.horizontalCenter = "middle";
          label2BaseMarket.fontSize = 20;
          label2BaseMarket.dy = 20;
          
          // Auto-select first slice on load
          pieChartBaseMarket.events.on("datavalidated", function(ev) {

            if(pieSeriesBaseMarket.slices.length <= 0){
                // Update column chart
              columnChartBaseMarket.data = []

              //Update labels
              label1BaseMarket.text = "";
              label2BaseMarket.text = "";
            }

            pieSeriesBaseMarket.slices.each(function(slice) {
                if (slice.dataItem.dataContext.category === statesBaseMarket[statesBaseMarket.length - 1]){
                    pieSeriesBaseMarket.slices.getIndex(slice.dataItem.index).isActive = true;
                }   
            });
          });
          
          // Set up toggling events
          pieSeriesBaseMarket.slices.template.events.on("toggled", function(ev) {
            if (ev.target.isActive) {
              // Untoggle other slices
              pieSeriesBaseMarket.slices.each(function(slice) {
                if (slice != ev.target) {
                  slice.isActive = false;
                }
              });
              
              // Update column chart
              valueAxisBaseMarket.max = ev.target.dataItem.dataContext.max;
              columnChartBaseMarket.data = ev.target.dataItem.dataContext.breakdown;
              valueAxisBaseMarket.strictMinMax = true;

              //Update labels
              label1BaseMarket.text = pieChartBaseMarket.numberFormatter.format(ev.target.dataItem.values.value.percent, "#.'%'");
              label1BaseMarket.fill = ev.target.fill;
              label2BaseMarket.text = ev.target.dataItem.category;

              
            }else{
                columnChartBaseMarket.data = [];
                label1BaseMarket.text = ""
                label2BaseMarket.text = ""
            }
          });


        $("#toggleModalBaseMarket").click(function(){
            if(!stateAndFarmActives()) return
            $('#modalBaseMarket').modal('show')
        })

        $('#modalBaseMarket').on('shown.bs.modal', function () {
            $('#spinnerModalBase').addClass('hidden')
            $('#bodyBaseMarket').append(`
                <div id="temporalBaseModal" class="col-md-12" style="padding: 0px">
                    <div id="baseModalChart" style="height: 80vh"></div>
                </div>
            `)

            // Create chart instance
            let chartBaseMarketSmall = am4core.create("baseModalChart", am4core.Container);
            chartBaseMarketSmall.width = am4core.percent(100);
            chartBaseMarketSmall.height = am4core.percent(100);
            chartBaseMarketSmall.layout = "horizontal";
            

            var columnChartBaseMarket = chartBaseMarketSmall.createChild(am4charts.XYChart);
        
            columnChartBaseMarket.data = []

            columnChartBaseMarket.legend = new am4charts.Legend();
            columnChartBaseMarket.legend.position = "bottom";

            // Create axes
            var categoryAxisBaseMarket = columnChartBaseMarket.yAxes.push(new am4charts.CategoryAxis());
            categoryAxisBaseMarket.dataFields.category = "cultivo";
            categoryAxisBaseMarket.renderer.grid.template.opacity = 0;

            var valueAxisBaseMarket = columnChartBaseMarket.xAxes.push(new am4charts.ValueAxis());
            valueAxisBaseMarket.min = 0;
            valueAxisBaseMarket.renderer.grid.template.opacity = 0;
            valueAxisBaseMarket.renderer.ticks.template.strokeOpacity = 0.5;
            valueAxisBaseMarket.renderer.ticks.template.stroke = am4core.color("#495C43");
            valueAxisBaseMarket.renderer.ticks.template.length = 10;
            valueAxisBaseMarket.renderer.line.strokeOpacity = 0.5;
            valueAxisBaseMarket.renderer.baseGrid.disabled = true;

            // Create series
            function createSeriesxxxx(field, name, color) {
                let series = columnChartBaseMarket.series.push(new am4charts.ColumnSeries());
                series.dataFields.valueX = field;
                series.dataFields.categoryY = "cultivo";
                series.stacked = true;
                series.name = name;
                series.fill = color
                series.stroke = color
                series.columns.template.tooltipText = field + " ${valueX}";
            }

            ['insecticida', 'herbicida', 'fungicida', 'otro'].forEach((element, index) => {
                let color = ["#c10000", "#026f02", "#750275", "#ffa500"]
                createSeriesxxxx(element, element, color[index]);
            });
            

            /**
             * Pie chart
             */
            
            // Create chart instance
            let pieChartBaseMarket = chartBaseMarketSmall.createChild(am4charts.PieChart);
            pieChartBaseMarket.data = dataForModalBaseMarket;
            pieChartBaseMarket.innerRadius = am4core.percent(50);
            
            pieChartBaseMarket.legend = new am4charts.Legend();
            
            // Add and configure Series
            let pieSeriesBaseMarket = pieChartBaseMarket.series.push(new am4charts.PieSeries());
            pieSeriesBaseMarket.dataFields.value = "value";
            pieSeriesBaseMarket.dataFields.category = "category";
            pieSeriesBaseMarket.slices.template.propertyFields.fill = "color";
            pieSeriesBaseMarket.labels.template.disabled = true;
            
            // let asBaseChart = pieSeriesBaseMarket.slices.template.states.getKey("active");
            // asBaseChart.properties.shiftRadius = 0;

            let hsMrket = pieSeriesBaseMarket.slices.template.states.getKey("hover");
            hsMrket.properties.scale = 1;
            
            // Set up labels
            let label1BaseMarket = pieChartBaseMarket.seriesContainer.createChild(am4core.Label);
            label1BaseMarket.text = "";
            label1BaseMarket.horizontalCenter = "middle";
            label1BaseMarket.fontSize = 35;
            label1BaseMarket.fontWeight = 600;
            label1BaseMarket.dy = -30;
            
            let label2BaseMarket = pieChartBaseMarket.seriesContainer.createChild(am4core.Label);
            label2BaseMarket.text = "";
            label2BaseMarket.horizontalCenter = "middle";
            label2BaseMarket.fontSize = 20;
            label2BaseMarket.dy = 20;
            
            // Auto-select first slice on load
            pieChartBaseMarket.events.on("ready", function(ev) {
                pieSeriesBaseMarket.slices.getIndex(0).isActive = true;
            });
            
            // Set up toggling events
            pieSeriesBaseMarket.slices.template.events.on("toggled", function(ev) {
                if (ev.target.isActive) {
                // Untoggle other slices
                    pieSeriesBaseMarket.slices.each(function(slice) {
                        if (slice != ev.target) {
                        slice.isActive = false;
                        }
                    });
                    
                    // Update column chart
                    valueAxisBaseMarket.max = ev.target.dataItem.dataContext.max;
                    columnChartBaseMarket.data = ev.target.dataItem.dataContext.breakdown;
                    valueAxisBaseMarket.strictMinMax = true;

                    //Update labels
                    label1BaseMarket.text = pieChartBaseMarket.numberFormatter.format(ev.target.dataItem.values.value.percent, "#.'%'");
                    label1BaseMarket.fill = ev.target.fill;
                    label2BaseMarket.text = ev.target.dataItem.category;
                }
            });
        })

        $('#modalBaseMarket').on('hide.bs.modal', function () {
            $('#temporalBaseModal').remove()
            $('#spinnerModalBase').removeClass('hidden')
        })


        $("#toggleModalBaseMarketConfig").click(function(){
            if(!stateAndFarmActives()) return
            $('#modalBaseMarketConfig').modal('show')
        })

        
        let firstLoadModalMarket = true
        $('#modalBaseMarketConfig').on('shown.bs.modal', function () {
            $('#spinnerModalBaseConfig').addClass('hidden')
            $('#marketAdvanced').removeClass('hidden')

            $('#bodyBaseMarketInnerConfig').html(`
                <div id="temporalBaseModal" class="col-md-10" style="padding: 0px">
                    <div id="baseModalChart" style="height: 80vh"></div>
                </div>
            `)

            $('body').on("keyup", "#marketF5SuperficiePercent", function(e, obj){
                let superficieTotal = parseInt($('#marketF5SuperficieSembrada').val().toString().replace(/,/g, ""))
                let value = e.target.value.length <= 0 ? "" : formatEntryWithDot(e.target.value)
    
                if(value != ""){
                    let valueMax = parseInt(value.replace(/,/g, "")) >= 100 ? 100 : value
                    $(this).val(valueMax)
    
                    let valueForHa = (superficieTotal * parseFloat(valueMax))/100
    
                    $('#marketF5SuperficieVal').val(formatPrice(valueForHa.toString()))
                }else{
                    $('#marketF5SuperficieVal').val("")
                    $(this).val("")
                }

                if(obj == undefined){
                    $("#m5IncPercent").keyup()
                    $("#m5HerPercent").keyup()
                    $("#m5FunPercent").keyup()
                    $("#m5OtrPercent").keyup()
                }
            })
    
            $('body').on("keyup", "#marketF5SuperficieVal", function(e){
                let superficieTotal = parseInt($('#marketF5SuperficieSembrada').val().toString().replace(/,/g, ""))
                let value = e.target.value.length <= 0 ? "" : formatEntryWithDot(e.target.value)
    
    
                if(value != "" && superficieTotal > 0){
                    let valueMax = parseInt(value.replace(/,/g, "")) >= superficieTotal ? superficieTotal : value
                    $(this).val(valueMax)
    
                    let valueForPer = ((100 * parseFloat(valueMax.replace(/,/g, "")))/superficieTotal).toFixed(2)
                    $('#marketF5SuperficiePercent').val(valueForPer)
                }else{
                    $('#marketF5SuperficiePercent').val("")
                    $(this).val("")
                }
    
                $("#m5IncPercent").keyup()
                $("#m5HerPercent").keyup()
                $("#m5FunPercent").keyup()
                $("#m5OtrPercent").keyup()
            })
    
            $('body').on("keyup", "#marketF5GastoTotal", function(e){
                let value = e.target.value.length <= 0 ? "" : formatEntryWithDot(e.target.value)
                $(this).val(value)
    
                $("#m5IncPercent").keyup()
                $("#m5HerPercent").keyup()
                $("#m5FunPercent").keyup()
                $("#m5OtrPercent").keyup()
            })

            const setNewValuesForPie = (total) => {
                let superficiePer = $('#marketF5SuperficiePercent').val() ? parseFloat($('#marketF5SuperficiePercent').val()) : 0
                let gastoTotal = parseFloat($('#marketF5GastoTotal').val().replace(/,/g, "")) ? parseFloat($('#marketF5GastoTotal').val().replace(/,/g, "")) : 0
                let v1 = parseFloat($('#m5IncPercent').val() ? $('#m5IncPercent').val() : 0)
                let v2 = parseFloat($('#m5HerPercent').val() ? $('#m5HerPercent').val() : 0)
                let v3 = parseFloat($('#m5FunPercent').val() ? $('#m5FunPercent').val() : 0)
                let v4 = parseFloat($('#m5OtrPercent').val() ? $('#m5OtrPercent').val() : 0)

                let newValues = JSON.parse(JSON.stringify(dataModalCopy)).map(val => {
                    let totalState = 0

                    if(activestates.includes(val.category)){
                        activeFarms.forEach(x => {
                            totalState = dataForModalConfig[val.category][x] + totalState
                        })
                    }

                    val.value = ((((superficiePer * totalState) / 100) * gastoTotal) * (v1 + v2 + v3 + v4)) / 100

                    return val
                })

                pieChartBaseMarket1.data = newValues
            }

            const getFarmsHaValues = () => {
                let dataCopy = JSON.parse(JSON.stringify(dataForModalConfig))
                let dataStates = Object.keys(dataCopy)

                let farmsHa = dataStates.reduce((carry, state) => {
                    if(activestates.includes(state)){
                        if(Object.keys(carry).length > 0){
                            Object.keys(carry).forEach(x => carry[x] = carry[x] + dataCopy[state][x])
                        }else{
                            carry = dataCopy[state]
                        }
                    }

                    return carry
                }, {})

                let farmsHaAdapt = Object.keys(farmsHa).reduce((carry, val) => {
                    let adapt = farm_products[val].adapterBase
                    carry[adapt] = farmsHa[val]
                    return carry
                }, {})

                return farmsHaAdapt
            }
    
            $('body').on("keyup", "#m5IncPercent", function(e){
                let superficieHa = $('#marketF5SuperficieVal').val() ? parseFloat($('#marketF5SuperficieVal').val().replace(/,/g, "")) : 0
                let superficiePer = $('#marketF5SuperficiePercent').val() ? parseFloat($('#marketF5SuperficiePercent').val()) : 0
                let gastoTotal = parseFloat($('#marketF5GastoTotal').val().replace(/,/g, "")) ? parseFloat($('#marketF5GastoTotal').val().replace(/,/g, "")) : 0
                let value = e.target.value.length <= 0 ? "" : formatEntryWithDot(e.target.value).replace(/,/g, "")
                let incVal = 0
    
                let v2 = parseFloat($('#m5HerPercent').val() ? $('#m5HerPercent').val() : 0)
                let v3 = parseFloat($('#m5FunPercent').val() ? $('#m5FunPercent').val() : 0)
                let v4 = parseFloat($('#m5OtrPercent').val() ? $('#m5OtrPercent').val() : 0)
    
                let maxValue = 100
                let restValue = maxValue - (v2 + v3 + v4)
                let total = 0
    
                if(value == "" || parseFloat(value) <= restValue){
                    $(this).val(value)
                    if(value == "") value = 0
                    incVal = (parseFloat(value) * (superficieHa * gastoTotal))/100
                    total = v2 + v3 + v4 + parseFloat(value)
                }else{
                    $(this).val("")
                    total = v2 + v3 + v4
                    incVal = 0
                    alert("La suma de los porcentajes no puede execeder el 100%")
                }

                label2BaseMarket1.text = '$' + formatPrice(((total * (superficieHa * gastoTotal))/100).toString())

                columnData = columnData.map(val => {
                    let farmsHaAdapt = getFarmsHaValues()
                    let haPer = (farmsHaAdapt[val.cultivo] * superficiePer) / 100
                    let valT = haPer * gastoTotal
                    val.insecticida = (valT * parseFloat(value)) / 100
                    return val
                })

                columnChartBaseMarket1.data = columnData
                updateTableMarket(columnData)
                setNewValuesForPie(total)
            })
    
            $('body').on("keyup", "#m5HerPercent", function(e){
                let superficieHa = $('#marketF5SuperficieVal').val() ? parseFloat($('#marketF5SuperficieVal').val().replace(/,/g, "")) : 0
                let superficiePer = $('#marketF5SuperficiePercent').val() ? parseFloat($('#marketF5SuperficiePercent').val()) : 0
                let gastoTotal = parseFloat($('#marketF5GastoTotal').val().replace(/,/g, "")) ? parseFloat($('#marketF5GastoTotal').val().replace(/,/g, "")) : 0
                let value = e.target.value.length <= 0 ? "" : formatEntryWithDot(e.target.value).replace(/,/g, "")
    
                let v1 = parseFloat($('#m5IncPercent').val() ? $('#m5IncPercent').val() : 0)
                let v3 = parseFloat($('#m5FunPercent').val() ? $('#m5FunPercent').val() : 0)
                let v4 = parseFloat($('#m5OtrPercent').val() ? $('#m5OtrPercent').val() : 0)
    
                let maxValue = 100
                let restValue = maxValue - (v1 + v3 + v4)
                let total = 0
    
                if(value == "" || parseFloat(value) <= restValue){
                    $(this).val(value)
                    if(value == "") value = 0
                    total = v1 + v3 + v4 + parseFloat(value)
                }else{
                    $(this).val(0)
                    total = v1 + v3 + v4
                    alert("La suma de los porcentajes no puede execeder el 100%")
                }

                label2BaseMarket1.text = '$' + formatPrice(((total * (superficieHa * gastoTotal))/100).toString())
    
                columnData = columnData.map(val => {
                    let farmsHaAdapt = getFarmsHaValues()
                    let haPer = (farmsHaAdapt[val.cultivo] * superficiePer) / 100
                    let valT = haPer * gastoTotal
                    val.herbicida = (valT * parseFloat(value)) / 100
                    return val
                })

                columnChartBaseMarket1.data = columnData
                updateTableMarket(columnData)
                setNewValuesForPie(total)
            })
    
            $('body').on("keyup", "#m5FunPercent", function(e){
                let superficieHa = $('#marketF5SuperficieVal').val() ? parseFloat($('#marketF5SuperficieVal').val().replace(/,/g, "")) : 0
                let superficiePer = $('#marketF5SuperficiePercent').val() ? parseFloat($('#marketF5SuperficiePercent').val()) : 0
                let gastoTotal = parseFloat($('#marketF5GastoTotal').val().replace(/,/g, "")) ? parseFloat($('#marketF5GastoTotal').val().replace(/,/g, "")) : 0
                let value = e.target.value.length <= 0 ? "" : formatEntryWithDot(e.target.value).replace(/,/g, "")
    
                let v1 = parseFloat($('#m5IncPercent').val() ? $('#m5IncPercent').val() : 0)
                let v2 = parseFloat($('#m5HerPercent').val() ? $('#m5HerPercent').val() : 0)
                let v3 = parseFloat($('#m5OtrPercent').val() ? $('#m5OtrPercent').val() : 0)
    
                let maxValue = 100
                let restValue = maxValue - (v1 + v2 + v3)
                let total = 0
    
                if(value == "" || parseFloat(value) <= restValue){
                    $(this).val(value)
                    if(value == "") value = 0
                    total = v1 + v2 + v3 + parseFloat(value)
                }else{
                    $(this).val(0)
                    total = v2 + v2 + v3
                    alert("La suma de los porcentajes no puede execeder el 100%")
                }

                label2BaseMarket1.text = '$' + formatPrice(((total * (superficieHa * gastoTotal))/100).toString())
    
                columnData = columnData.map(val => {
                    let farmsHaAdapt = getFarmsHaValues()
                    let haPer = (farmsHaAdapt[val.cultivo] * superficiePer) / 100
                    let valT = haPer * gastoTotal
                    val.fungicida = (valT * parseFloat(value)) / 100
                    return val
                })

                columnChartBaseMarket1.data = columnData
                updateTableMarket(columnData)
                setNewValuesForPie(total)
            })
    
            $('body').on("keyup", "#m5OtrPercent", function(e){
                let superficieHa = $('#marketF5SuperficieVal').val() ? parseFloat($('#marketF5SuperficieVal').val().replace(/,/g, "")) : 0
                let superficiePer = $('#marketF5SuperficiePercent').val() ? parseFloat($('#marketF5SuperficiePercent').val()) : 0
                let gastoTotal = parseFloat($('#marketF5GastoTotal').val().replace(/,/g, "")) ? parseFloat($('#marketF5GastoTotal').val().replace(/,/g, "")) : 0
                let value = e.target.value.length <= 0 ? "" : formatEntryWithDot(e.target.value).replace(/,/g, "")
    
                let v1 = parseFloat($('#m5IncPercent').val() ? $('#m5IncPercent').val() : 0)
                let v2 = parseFloat($('#m5HerPercent').val() ? $('#m5HerPercent').val() : 0)
                let v4 = parseFloat($('#m5FunPercent').val() ? $('#m5FunPercent').val() : 0)
    
                let maxValue = 100
                let restValue = maxValue - (v1 + v2 + v4)
                let total = 0
    
                if(value == "" || parseFloat(value) <= restValue){
                    $(this).val(value)
                    if(value == "") value = 0
                    total = v1 + v2 + v4 + parseFloat(value)
                }else{
                    $(this).val(0)
                    total = v2 + v2 + v4
                    alert("La suma de los porcentajes no puede execeder el 100%")
                }

                label2BaseMarket1.text = '$' + formatPrice(((total * (superficieHa * gastoTotal))/100).toString())
    
                columnData = columnData.map(val => {
                    let farmsHaAdapt = getFarmsHaValues()
                    let haPer = (farmsHaAdapt[val.cultivo] * superficiePer) / 100
                    let valT = haPer * gastoTotal
                    val.otro = (valT * parseFloat(value)) / 100
                    return val
                })

                columnChartBaseMarket1.data = columnData
                updateTableMarket(columnData)
                setNewValuesForPie(total)
            })

            $('body').on('click', '#modalBaseFarms span', function(){
                let isActive = $(this).attr('active') === 'true'
                let val = $(this).attr('value')
                isActive ? $(this).find('img').attr('src', '/project_images/' + farm_products[val].img) : $(this).find('img').attr('src', '/project_images/' + farm_products[val].imgB)
                $(this).attr('active', !isActive)
    
                activeFarms = []
    
                $('#modalBaseFarms span').each(function(){
                    let isActive = $(this).attr('active') === 'true'
                    isActive ? activeFarms.push($(this).attr('value')) : null
                })
                getHaBystatesAndfarms(activestates, activeFarms, $('#marketF5SuperficieSembrada')) 
                getTotalValue()

                // let adaptActiveFarms = activeFarms.map(x => farm_products[x].adapterBase)

                // let removedStates = dataModalCopy.filter(val => {
                //     return activestates.includes(val.category) ? true : false
                // })

                // let newDataPie = removedStates.map(val => {
                //     val.value = val.breakdown.reduce((carry, x)=> {
                //         if(adaptActiveFarms.includes(x.cultivo)){
                //             carry = carry + parseFloat(x.insecticida) + parseFloat(x.herbicida) + parseFloat(x.fungicida) + parseFloat(x.otro)
                //         }
                //         return carry
                //     }, 0)
                //     return val
                // })


                // pieChartBaseMarket1.data = newDataPie

            })

            const getTotalValue = () => {
                let removedStates = dataModalCopy.filter(val => {
                    return activestates.includes(val.category) ? true : false
                })

                let adaptActiveFarms = activeFarms.map(x => farm_products[x].adapterBase)

                let total = removedStates.reduce((carry, val) => {
                    val.breakdown.forEach(value => {
                        if(adaptActiveFarms.includes(value.cultivo)){
                            carry = carry + parseFloat(value.insecticida) + parseFloat(value.fungicida) + parseFloat(value.herbicida) + parseFloat(value.otro)
                        }
                    })
                    return carry
                }, 0)

                label2BaseMarket1.text = '$' + formatPrice(total.toString())
                

                let initFarms = JSON.parse(JSON.stringify(dataModalCopy[0])).breakdown.filter(x => adaptActiveFarms.includes(x.cultivo)).map(val => {
                    val.insecticida = 0
                    val.herbicida = 0
                    val.fungicida = 0
                    val.otro = 0
                    return val
                })

                columnData = removedStates.reduce((carry, val) => {
                    val.breakdown.forEach(valBreak => {
                        initFarms.forEach((carryVal, index) => {
                            if(carryVal.cultivo === valBreak.cultivo){
                                carry[index].insecticida = parseFloat(carry[index].insecticida) + parseFloat(valBreak.insecticida)
                                carry[index].herbicida = parseFloat(carry[index].herbicida) + parseFloat(valBreak.herbicida)
                                carry[index].fungicida = parseFloat(carry[index].fungicida) + parseFloat(valBreak.fungicida)
                                carry[index].otro = parseFloat(carry[index].otro) + parseFloat(valBreak.otro)
                            }
                        })
                    })
                    return carry
                }, initFarms)

                updateTableMarket(columnData)

                columnChartBaseMarket1.data = columnData
                //pieChartBaseMarket.data = dataModalCopy;

                cleanForm()

            }

            const updateTableMarket = (columns) => {
                
                let rows = columns.map(val => {
                    return `<tr>
                        <td class="cursor">
                            <div style="font-weight: bold">${val.cultivo}</div>
                        </td>
                        <td class="cursor">
                            <div>$${formatPrice(val.insecticida.toString())}</div>
                        </td>
                        <td class="cursor">
                            <div>$${formatPrice(val.herbicida.toString())}</div>
                        </td>
                        <td class="cursor">
                            <div>$${formatPrice(val.fungicida.toString())}</div>
                        </td>
                        <td class="cursor">
                            <div>$${formatPrice(val.otro.toString())}</div>
                        </td>
                    </tr>`
                })
                $('#tableMarketFarms').html(rows.join())
            }

            
            let dataModalCopy = dataForModalBaseMarket

            let totalBase = dataModalCopy.reduce((carry, val) => {
                carry = carry + parseFloat(val.value)
                return carry
            }, 0)

            let initFarms = JSON.parse(JSON.stringify(dataModalCopy[0])).breakdown.map(val => {
                val.insecticida = 0
                val.herbicida = 0
                val.fungicida = 0
                val.otro = 0
                return val
            })

            let columnData = dataModalCopy.reduce((carry, val) => {
                val.breakdown.forEach(valBreak => {
                    initFarms.forEach((carryVal, index) => {
                        if(carryVal.cultivo === valBreak.cultivo){
                            carry[index].insecticida = parseFloat(carry[index].insecticida) + parseFloat(valBreak.insecticida)
                            carry[index].herbicida = parseFloat(carry[index].herbicida) + parseFloat(valBreak.herbicida)
                            carry[index].fungicida = parseFloat(carry[index].fungicida) + parseFloat(valBreak.fungicida)
                            carry[index].otro = parseFloat(carry[index].otro) + parseFloat(valBreak.otro)
                        }
                    })
                })
                return carry
            }, initFarms)

            
            let activestates = Object.values(states).filter(val => val.active === true ).map(val => val.name)
            let activeFarms = []
        
            $('table > tbody  > tr > th').each(function(i, th) { 
                const element = $(th)
                if(element.attr('active') === "true" && !element.hasClass('ignore')){
                    activeFarms.push(element.attr('value'))
                }
            });
            
            activeFarms.map(val => {
                $('#modalBaseFarms').append(`<span data-toggle="tooltip" active="true" value="${val}" title="${farm_products[val].adapterBase}"><img src="${'/project_images/' + farm_products[val].imgB}" width="35px" height="35px"></span>`)
            })
                

            updateTableMarket(columnData)

            /****** SETEO INICIAL DE VALORES CONFIG BASE */
            getHaBystatesAndfarms(activestates, activeFarms, $('#marketF5SuperficieSembrada')) 
            

            // Create chart instance
            let chartBaseMarketSmall1 = am4core.create("baseModalChart", am4core.Container);
            chartBaseMarketSmall1.width = am4core.percent(100);
            chartBaseMarketSmall1.height = am4core.percent(100);
            chartBaseMarketSmall1.layout = "horizontal";
            

            let columnChartBaseMarket1 = chartBaseMarketSmall1.createChild(am4charts.XYChart);
        
            columnChartBaseMarket1.data = columnData

            // columnChartBaseMarket1.legend = new am4charts.Legend();
            // columnChartBaseMarket1.legend.position = "bottom";

            // Create axes
            let categoryAxisBaseMarket1 = columnChartBaseMarket1.yAxes.push(new am4charts.CategoryAxis());
            categoryAxisBaseMarket1.dataFields.category = "cultivo";
            categoryAxisBaseMarket1.renderer.grid.template.opacity = 0;

            let valueAxisBaseMarket1 = columnChartBaseMarket1.xAxes.push(new am4charts.ValueAxis());
            valueAxisBaseMarket1.min = 0;
            valueAxisBaseMarket1.renderer.grid.template.opacity = 0;
            valueAxisBaseMarket1.renderer.ticks.template.strokeOpacity = 0.5;
            valueAxisBaseMarket1.renderer.ticks.template.stroke = am4core.color("#495C43");
            valueAxisBaseMarket1.renderer.ticks.template.length = 10;
            valueAxisBaseMarket1.renderer.line.strokeOpacity = 0.5;
            valueAxisBaseMarket1.renderer.baseGrid.disabled = true;


    
            ['insecticida', 'herbicida', 'fungicida', 'otro'].forEach((element, index) => {
                let color1 = ["#c10000", "#026f02", "#750275", "#ffa500"]
                let series1 = columnChartBaseMarket1.series.push(new am4charts.ColumnSeries());
                series1.dataFields.valueX = element;
                series1.dataFields.categoryY = "cultivo";
                series1.stacked = true;
                series1.name = element;
                series1.fill = color1[index]
                series1.stroke = color1[index]
                series1.columns.template.tooltipText = element + " ${valueX}";
            });
            

            /**
             * Pie chart
             */
            
            // Create chart instance
            let pieChartBaseMarket1 = chartBaseMarketSmall1.createChild(am4charts.PieChart);
            pieChartBaseMarket1.data = dataForModalBaseMarket;
            pieChartBaseMarket1.innerRadius = am4core.percent(50);
            
            pieChartBaseMarket1.legend = new am4charts.Legend();
            
            // Add and configure Series
            let pieSeriesBaseMarket1 = pieChartBaseMarket1.series.push(new am4charts.PieSeries());
            pieSeriesBaseMarket1.dataFields.value = "value";
            pieSeriesBaseMarket1.dataFields.category = "category";
            pieSeriesBaseMarket1.slices.template.propertyFields.fill = "color";
            pieSeriesBaseMarket1.labels.template.disabled = true;
            
            let asBaseChart1 = pieSeriesBaseMarket1.slices.template.states.getKey("active");
            asBaseChart1.properties.shiftRadius = 0;

            let hsMrket1 = pieSeriesBaseMarket1.slices.template.states.getKey("hover");
            hsMrket1.properties.scale = 1;
            
            // Set up labels
            let label1BaseMarket1 = pieChartBaseMarket1.seriesContainer.createChild(am4core.Label);
            label1BaseMarket1.text = "Total";
            label1BaseMarket1.horizontalCenter = "middle";
            label1BaseMarket1.fontSize = 35;
            label1BaseMarket1.fontWeight = 600;
            label1BaseMarket1.dy = -30;
            
            
            let label2BaseMarket1 = pieChartBaseMarket1.seriesContainer.createChild(am4core.Label);
            label2BaseMarket1.horizontalCenter = "middle";
            label2BaseMarket1.fontSize = 20;
            label2BaseMarket1.dy = 20;
            label2BaseMarket1.text = '$' + formatPrice(totalBase.toString())
            
            // // Auto-select first slice on load
            // pieChartBaseMarket1.events.on("ready", function(ev) {
            //    firstLoadModalMarket = false
            // });


            // Auto-select first slice on load
            pieChartBaseMarket1.legend.events.on("hit", function(ev) {
                activestates = []
                pieChartBaseMarket1.legend.children.each(function(s){
                    if(!s.isActive){
                        activestates.push(s.dataItem.dataContext.category)
                    }
                })
                getHaBystatesAndfarms(activestates, activeFarms, $('#marketF5SuperficieSembrada')) 
                getTotalValue() 
            });
            
        })

        const cleanForm = () => {
            $('#m5IncPercent').val("")
            $('#m5HerPercent').val("")
            $('#m5FunPercent').val("")
            $('#m5OtrPercent').val("")
            $('#marketF5SuperficiePercent').val('')
            $('#marketF5SuperficieVal').val('')
            $('#marketF5GastoTotal').val('')
        }

        $('#modalBaseMarketConfig').on('hide.bs.modal', function () {
            $('#temporalBaseModal').remove()
            $('#spinnerModalBase').removeClass('hidden')
            $('#marketAdvanced').addClass('hidden')
            $('#modalBaseFarms').html('')
            $('body').off('click', '#modalBaseFarms span')
            $('body').off("keyup", "#m5IncPercent")
            $('body').off("keyup", "#m5HerPercent")
            $('body').off("keyup", "#m5FunPercent")
            $('body').off("keyup", "#m5OtrPercent")
            $('body').off("keyup", "#marketF5SuperficiePercent")
            $('body').off("keyup", "#marketF5SuperficieVal")
            $('body').off("keyup", "#marketF5GastoTotal")
            firstLoadModalMarket = true
            cleanForm()
        })
            
            
        // $('.modalDownload').click(function(){
        //     console.log('hey')
        //     // html2canvas(document.querySelector("#modalBaseMarketConfig")).then(canvas => {
        //     //     document.body.appendChild(canvas)
        //     // });

        //     html2canvas($("#modalBaseMarketConfig"), {
        //         onrendered: function(canvas) {
        //             theCanvas = canvas;
    
    
        //             canvas.toBlob(function(blob) {
        //                 saveAs(blob, "Dashboard.png"); 
        //             });
        //         }
        //     });
        // })

        
        //-------------------------------------------------gradica de pie
        var chartPieMarket = am4core.create("marketFarmPie", am4charts.PieChart3D);
        chartPieMarket.innerRadius = am4core.percent(50);

        // Add and configure Series
        let marketPieSeries = chartPieMarket.series.push(new am4charts.PieSeries3D());
        marketPieSeries.dataFields.value = "value";
        marketPieSeries.dataFields.category = "product";
        marketPieSeries.angle= 5;
        marketPieSeries.depth= 7;

        marketPieSeries.slices.template.configField = "config"

        marketPieSeries.ticks.template.disabled = true;
        marketPieSeries.labels.template.text = "";


        marketPieSeries.slices.template.tooltipText = "{category}: {value.value} HA"

        marketPieSeries.slices.template.states.getKey("hover").properties.scale = 1;
        marketPieSeries.slices.template.states.getKey("active").properties.shiftRadius = 0;


        var label = chartPieMarket.chartContainer.createChild(am4core.Label);
        label.align = "center";
        label.valign = "bottom"
        label.fontSize = 15;
        label.verticalCenter = "bottom"


        $('#modalMarketPie').on('shown.bs.modal', function () {
            const newMapDiv = document.createElement("div")
            newMapDiv.setAttribute("class", "modalBodyMap")
            newMapDiv.setAttribute("id", "mapMarket2")
            document.getElementById("firstMarket").appendChild(newMapDiv);

            var mapMarket2 = am4core.create("mapMarket2", am4maps.MapChart);
            mapMarket2.geodata = am4geodata_mexicoHigh;
            mapMarket2.projection = new am4maps.projections.Miller();
        
            var polygonSeries2 = mapMarket2.series.push(new am4maps.MapPolygonSeries());
            polygonSeries2.useGeodata = true;
        
            var polygonTemplate2 = polygonSeries2.mapPolygons.template;
            polygonTemplate2.tooltipText = "{name}";
            polygonTemplate2.fill = am4core.color("#d2d2d2");
        
            var hs2 = polygonTemplate2.states.create("hover");
            hs2.properties.fill = am4core.color("#6c70ec");
        
            var ac2 = polygonTemplate2.states.create("active");
            ac2.properties.fill = am4core.color("#3034a5");
            
            polygonTemplate2.events.on("hit", function(ev) {       
                return;
            }); 
            
            
            mapMarket2.events.on("ready", function(ev) {      
                mexicoIds.forEach(id => {
                    var mex = polygonSeries.getPolygonById(id);
                    if(mex.isActive){
                        var us2 = polygonSeries2.getPolygonById(id);
                        us2.isActive = true;
                    }
                })

                $("#spinnerModal").addClass('hidden')
            }); 

        
            polygonTemplate2.propertyFields.fill = "fill";




            const newChartDiv = document.createElement("div")
            newChartDiv.setAttribute("class", "modalBodyMarket")
            newChartDiv.setAttribute("id", "marketFarmPie2")
            document.getElementById("modalBodyMarket").appendChild(newChartDiv);

            var chartPieMarket2 = am4core.create("marketFarmPie2", am4charts.PieChart3D);
            chartPieMarket2.innerRadius = am4core.percent(50);
            chartPieMarket2.data = dataForModalPie

            // Add and configure Series
            let marketPieSeries2 = chartPieMarket2.series.push(new am4charts.PieSeries3D());
            marketPieSeries2.dataFields.value = "value";
            marketPieSeries2.dataFields.category = "product";
            marketPieSeries2.angle= 5;
            marketPieSeries2.depth= 7;
            marketPieSeries2.dx = 20

            marketPieSeries2.slices.template.configField = "config"

            marketPieSeries2.ticks.template.disabled = true;
            marketPieSeries2.labels.template.text = ""
        // marketPieSeries2.alignLabels = false;
        // marketPieSeries2.labels.template.text = "{value.percent.formatNumber('#.0000')}% {category.toLowerCase()}";
        // marketPieSeries2.labels.template.html = "{img}" 
        // marketPieSeries2.labels.template.radius = am4core.percent(-20);
            //marketPieSeries2.labels.template.exportable = true;
            //marketPieSeries2.exporting.menu = new am4core.ExportMenu();

            marketPieSeries2.slices.template.tooltipText = "{category}: {value.value} HA";

            marketPieSeries2.slices.template.states.getKey("hover").properties.scale = 1;
            marketPieSeries2.slices.template.states.getKey("active").properties.shiftRadius = 0;

            chartPieMarket2.legend = new am4charts.Legend();
            chartPieMarket2.legend.position = "left";
            chartPieMarket2.legend.valueLabels.template.text = "[bold]{value.percent.formatNumber('#.00')} %[/]  \n [font-size: 12px]{value} HA[/]";
            chartPieMarket2.legend.valueLabels.template.dy = 8
            chartPieMarket2.legend.valueLabels.template.marginTop = 6

            chartPieMarket2.legend.contentValign = "top"
            chartPieMarket2.legend.height = "50%"
            chartPieMarket2.legend.scrollable =true
            chartPieMarket2.legend.name = "[bold]{product}[/]"
            chartPieMarket2.legend.fontSize = 20
            chartPieMarket2.legend.width = 300


            chartPieMarket2.legend.itemContainers.template.events.on("toggled", function(event){
    
                dataForModalPie = dataForModalPie.map(x => {
                    if(event.target.dataItem.dataContext.category === x.product) {
                        x.active = !x.active
                    }
                    return x
                })

                dataForModalPie = dataForModalPie.map(x => {
                    if(event.target.dataItem.dataContext.category === x.product) {
                        let productUpper = x.product.toUpperCase()
                        x.img = x.active ? `/project_images/${farm_products[productUpper].imgB}` : `/project_images/${farm_products[productUpper].img}`
                    }
                    return x
                })


                let total = dataForModalPie.reduce((carry, x) => {
                    if(x.active) carry = carry + x.value
                    return carry
                }, 0)

                label2.text = "Total \n" + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " HA";
                chartPieMarket2.legend.reinit()
            })

            let label2= marketPieSeries2.createChild(am4core.Label);
            label2.horizontalCenter = "middle";
            label2.verticalCenter = "middle";
            label2.textAlign = "middle"
            label2.fontSize = 40;
            label2.maxWidth = 500
            label2.text = labelForModalPie

            // var pieLabelTitle = marketPieSeries2.createChild(am4core.Label);
            // pieLabelTitle.verticalCenter = "bottom";
            // // pieLabelTitle.y = 0
            // // pieLabelTitle.x = 0
            // pieLabelTitle.fontSize = 40;
            // pieLabelTitle.text = "la que te dijo"

            // marketPieSeries2.labels.template.adapter.add("radius", function(radius, target) {
            //     if (target.dataItem && (target.dataItem.values.value.percent < 5)) {
            //         return 30;
            //     }
            //         return radius;
            // });

            marketPieSeries2.ticks.template.adapter.add("disabled", function(tick, target) {
                if (target.dataItem && (target.dataItem.values.value.percent < 5)) {
                    return false;
                }
                    return true;
            });

            // var titlePirChart = chartPieMarket2.titles.create();
            // titlePirChart.text = "[bold]Porcentaje de Hectáreas (Ha)[/]";
            // titlePirChart.fontSize = 40;
            // titlePirChart.marginTop = 30;
            // titlePirChart.dx = 140;


            // Remove square from marker template
            var markerLegendPie = chartPieMarket2.legend.markers.template;
            markerLegendPie.disposeChildren();

            // Add custom image instead
            let pieMarketLegendImage = markerLegendPie.createChild(am4core.Image);
            pieMarketLegendImage.width = 20;
            pieMarketLegendImage.height = 20;
            pieMarketLegendImage.verticalCenter = "top";
            pieMarketLegendImage.horizontalCenter = "left";
            pieMarketLegendImage.togglable = true;


            // We're going to use an adapter to set href
            pieMarketLegendImage.adapter.add("href", function(href, target) {
                return target.dataItem.dataContext.dataContext.img; 
            });












            const newChartTreeDiv = document.createElement("div")
            newChartTreeDiv.setAttribute("class", "modalBodyTree")
            newChartTreeDiv.setAttribute("id", "marketFarmTree2")
            document.getElementById("modalBodyTree").appendChild(newChartTreeDiv);


            var marketFarmTree2 = am4core.create("marketFarmTree2", am4charts.TreeMap);
            marketFarmTree2.hiddenState.properties.opacity = 0; // this makes initial fade in effect
        
            marketFarmTree2.data = dataForModalTree;
        
        // marketFarmTree2.colors.step = 2;
        
            // define data fields
            marketFarmTree2.dataFields.value = "value";
            marketFarmTree2.dataFields.name = "name";
            marketFarmTree2.dataFields.children = "children";
            marketFarmTree2.dataFields.color = 'color'
        
            marketFarmTree2.zoomable = false;
            var bgColor2 = new am4core.InterfaceColorSet().getFor("background");
        
            // level 0 series template
            var level0SeriesTemplate2 = marketFarmTree2.seriesTemplates.create("0");
            var level0ColumnTemplate2 = level0SeriesTemplate2.columns.template;

            marketFarmTree2.seriesTemplates.configField = "config"
        
            level0ColumnTemplate2.column.cornerRadius(0, 0, 0, 0);
            level0ColumnTemplate2.fillOpacity = 0;
            level0ColumnTemplate2.strokeWidth = 4;
            level0ColumnTemplate2.strokeOpacity = 0;
        
            // level 1 series template
            var level1SeriesTemplate2 = marketFarmTree2.seriesTemplates.create("1");
            var level1ColumnTemplate2= level1SeriesTemplate2.columns.template;

        
            level1SeriesTemplate2.tooltip.animationDuration = 0;
            level1SeriesTemplate2.strokeOpacity = 1;
        
            level1ColumnTemplate2.column.cornerRadius(10, 10, 10, 10)
            level1ColumnTemplate2.fillOpacity = 1;
            level1ColumnTemplate2.strokeWidth = 4;
            level1ColumnTemplate2.stroke = bgColor2;
            level1ColumnTemplate2.tooltipText = "{name}: {value} HA";
        
            // var bullet1 = level1ColumnTemplate2.bullets.push(new am4charts.LabelBullet());
            // bullet1.locationY = 0.5;
            // bullet1.locationX = 0.5;
            // bullet1.label.text = "{name}";
            // bullet1.label.fill = am4core.color("#ffffff");
        
            marketFarmTree2.maxLevels = 2;
        
            marketFarmTree2.legend = new am4charts.Legend();
            marketFarmTree2.legend.valueLabels.template.text = "[bold]{value} HA[/]";
            marketFarmTree2.legend.position = "left";
            marketFarmTree2.legend.fontSize = 20
            marketFarmTree2.legend.width = 300

            // Remove square from marker template
            var markerLegendTree = marketFarmTree2.legend.markers.template;
            markerLegendTree.disposeChildren();

            // Add custom image instead
            let treeMarketLegendImage = markerLegendTree.createChild(am4core.Image);
            treeMarketLegendImage.width = 20;
            treeMarketLegendImage.height = 20;
            treeMarketLegendImage.verticalCenter = "top";
            treeMarketLegendImage.horizontalCenter = "left";
            treeMarketLegendImage.togglable = true;


            // We're going to use an adapter to set href
            treeMarketLegendImage.adapter.add("href", function(href, target) {
                return target.dataItem.dataContext.dataContext.img; 
            });

            marketFarmTree2.legend.itemContainers.template.events.on("toggled", function(event){
    
                dataForModalTree = dataForModalTree.map(x => {
                    if(event.target.dataItem.name === x.name) {
                        x.active = !x.active
                        let productUpper = x.name.toUpperCase()
                        x.img = x.active ? `/project_images/${farm_products[productUpper].imgB}` : `/project_images/${farm_products[productUpper].img}`
                        x.children[0].img = x.active ? `/project_images/${farm_products[productUpper].imgB}` : `/project_images/${farm_products[productUpper].img}`
                    }
                    return x
                })

                marketFarmTree2.legend.reinit()
            })


            // var titleModalTree = marketFarmTree2.titles.create();
            // titleModalTree.text = "[bold]Cantidad de Hectáreas (Ha) por cultivo[/]";
            // titleModalTree.fontSize = 40;
            // titleModalTree.marginTop = 15













            const newPyramidTreeDiv = document.createElement("div")
            newPyramidTreeDiv.setAttribute("class", "modalBodyPyramid")
            newPyramidTreeDiv.setAttribute("id", "marketFarmPyramid2")
            document.getElementById("modalBodyPyramid").appendChild(newPyramidTreeDiv);


            var marketPiramidContainer2 = am4core.create("marketFarmPyramid2", am4core.Container);
            marketPiramidContainer2.width = am4core.percent(100);
            marketPiramidContainer2.height = am4core.percent(100);
            marketPiramidContainer2.layout = "horizontal";

            var marketPiramidState2 = marketPiramidContainer2.createChild(am4charts.XYChart);
            marketPiramidState2.paddingRight = 0;
            marketPiramidState2.data = JSON.parse(JSON.stringify(dataForModalPyramid));


            // Create axes
            var stateFarmCategoryAxis2 = marketPiramidState2.yAxes.push(new am4charts.CategoryAxis());
            stateFarmCategoryAxis2.dataFields.category = "farmValue";
            stateFarmCategoryAxis2.renderer.grid.template.location = 0;
            //maleCategoryAxis.renderer.inversed = true;
            stateFarmCategoryAxis2.renderer.minGridDistance = 15;

            var stateFarmValueAxis2 = marketPiramidState2.xAxes.push(new am4charts.ValueAxis());
            stateFarmValueAxis2.renderer.inversed = true;
            stateFarmValueAxis2.min = 0;
            stateFarmValueAxis2.max = dataForModalPyramid[0].totalValue;
            stateFarmValueAxis2.strictMinMax = true;

            //stateFarmValueAxis2.numberFormatter = new am4core.NumberFormatter();
            stateFarmValueAxis.numberFormatter.numberFormat = "#,###,###' HA'";

            // Create series
            var stateFarmSeries2 = marketPiramidState2.series.push(new am4charts.ColumnSeries());
            stateFarmSeries2.dataFields.valueX = "farmValueHA";
            stateFarmSeries2.columns.template.configField = "config"
            //stateFarmSeries2.dataFields.valueXShow = "percent";
            //stateFarmSeries2.calculatePercent = true;
            stateFarmSeries2.dataFields.categoryY = "farmValue";
            stateFarmSeries2.interpolationDuration = 1000;
            stateFarmSeries2.columns.template.tooltipText = "{product}: {valueX}";
            //stateFarmSeries2.sequencedInterpolation = true;

            var valueLabelPyramidModal = stateFarmSeries2.bullets.push(new am4charts.LabelBullet());
            valueLabelPyramidModal.label.html = '';
            //valueLabelPyramidModal.label.horizontalCenter = "left";
            valueLabelPyramidModal.label.dx = -30;
        // valueLabelPyramidModal.label.hideOversized = false;
            //valueLabelPyramidModal.label.truncate = false;

            valueLabelPyramidModal.label.adapter.add("html", function(html, target) {
                let product = farm_products[(target.dataItem.dataContext.product).toUpperCase()].imgB
                return `<div><img src="/project_images/${product}" width="35px" height="35px"><div/>`
            });


            var totalFarmChart2 = marketPiramidContainer2.createChild(am4charts.XYChart);
            totalFarmChart2.paddingLeft = 0;
            totalFarmChart2.data = JSON.parse(JSON.stringify(dataForModalPyramid));

            // Create axes
            var totalFarmCategoryAxis2 = totalFarmChart2.yAxes.push(new am4charts.CategoryAxis());
            totalFarmCategoryAxis2.renderer.opposite = true;
            totalFarmCategoryAxis2.dataFields.category = "totalValue";
            totalFarmCategoryAxis2.renderer.grid.template.location = 0;
            totalFarmCategoryAxis2.renderer.minGridDistance = 15;


            var totalFarmValueAxis2 = totalFarmChart2.xAxes.push(new am4charts.ValueAxis());
            //totalFarmValueAxis2.numberFormatter = new am4core.NumberFormatter();
            totalFarmValueAxis2.numberFormatter.numberFormat = "#,###,###' HA'";
            totalFarmValueAxis2.renderer.minLabelPosition = 0.01;

            totalFarmValueAxis2.min = 0;
            totalFarmValueAxis2.max = dataForModalPyramid[0].totalValue;
            totalFarmValueAxis2.strictMinMax = true;
            

            // Create series
            var totalFarmSeries2 = totalFarmChart2.series.push(new am4charts.ColumnSeries());
            totalFarmSeries2.dataFields.valueX = "totalValue";
            //totalFarmSeries2.dataFields.valueXShow = "percent";
            totalFarmSeries2.calculatePercent = true;
            totalFarmSeries2.fill = "#000000b0";
            totalFarmSeries2.stroke = "#000000b0";
            //totalFarmSeries2.sequencedInterpolation = true;
            totalFarmSeries2.columns.template.tooltipText = "{product}: {valueX}";
            totalFarmSeries2.dataFields.categoryY = "totalValue";
            totalFarmSeries2.interpolationDuration = 1000;

            // let legendData = dataForModalPyramid.map(value => {
            //     return {
            //         name: value.product,
            //         fill: value.config.fill,
            //         img: `/project_images/${farm_products[(value.product).toUpperCase()].imgB}`,
            //     }
            // })

            // legendData.push({
            //     name: "Total",
            //     fill: "#000000b0",
            //     img: "/project_images/baseline_eco_black_48dp.png",
            // })

            // let legendPyramid = new am4charts.Legend();
            // legendPyramid.position = "left";
            // legendPyramid.scrollable = true;
            // legendPyramid.reverseOrder = true;

            // marketPiramidState2.legend = legendPyramid;
            // legendPyramid.data = legendData


            // // Remove square from marker template
            // var markerLegendPiramid = marketPiramidState2.legend.markers.template;
            // markerLegendPiramid.disposeChildren();

            // // Add custom image instead
            // let piramidMarketLegendImage = markerLegendPiramid.createChild(am4core.Image);
            // piramidMarketLegendImage.width = 20;
            // piramidMarketLegendImage.height = 20;
            // piramidMarketLegendImage.verticalCenter = "top";
            // piramidMarketLegendImage.horizontalCenter = "left";
            // piramidMarketLegendImage.togglable = true;


            // // We're going to use an adapter to set href
            // piramidMarketLegendImage.adapter.add("href", function(href, target) {
            //     return target.dataItem.dataContext.img;  
            // });


            // legendPyramid.itemContainers.template.events.on("toggled", function(event){

            //     dataForModalPyramid = dataForModalPyramid.map(x => {
            //         if(x.product === event.target.dataItem.dataContext.name) {
            //             x.active = !event.target.isActive

            //             legendData = legendData.map(y => {
            //                 let productUpper = y.name.toUpperCase()
            //                 if(y.name === "Total") return y
            //                 if(y.name === event.target.dataItem.dataContext.name){
            //                     y.img = x.active ? `/project_images/${farm_products[productUpper].imgB}` : `/project_images/${farm_products[productUpper].img}`
            //                 }
                            
            //                 return y
            //             })
                    
            //         }

            //         return x
            //     })

            //     let dataForModalPyramidCopy = dataForModalPyramid.filter(x => x.active)

            //     marketPiramidState2.data = JSON.parse(JSON.stringify(dataForModalPyramidCopy));
            //     stateFarmValueAxis2.max = dataForModalPyramidCopy.length > 0 ? dataForModalPyramidCopy[0].totalValue : 0;
            //     totalFarmChart2.data = JSON.parse(JSON.stringify(dataForModalPyramidCopy));
            //     totalFarmValueAxis2.max = dataForModalPyramidCopy.length > 0 ? dataForModalPyramidCopy[0].totalValue : 0;

            //     marketPiramidState2.legend.reinit()
            // })









            const newChartForcedTreeDiv = document.createElement("div")
            newChartForcedTreeDiv.setAttribute("class", "modalBodyForcedTree")
            newChartForcedTreeDiv.setAttribute("id", "marketDirectTree2")
            document.getElementById("modalBodyForcedTree").appendChild(newChartForcedTreeDiv);

            var chartForcedTree2 = am4core.create("marketDirectTree2", am4plugins_forceDirected.ForceDirectedTree);
            var chartForecedTreeSeries2 = chartForcedTree2.series.push(new am4plugins_forceDirected.ForceDirectedSeries())

            chartForcedTree2.data = dataForModalForcedTree;

            chartForecedTreeSeries2.dataFields.value = "value";
            chartForecedTreeSeries2.dataFields.name = "name";
            chartForecedTreeSeries2.dataFields.children = "children";
            chartForecedTreeSeries2.nodes.template.tooltipText = "{valueState}";
            chartForecedTreeSeries2.nodes.template.fillOpacity = 1;

            chartForecedTreeSeries2.nodes.template.label.text = "{name}"
            chartForecedTreeSeries2.numberFormatter.numberFormat = "#,###,###' HA'";
            chartForecedTreeSeries2.fontSize = 15;

            chartForecedTreeSeries2.links.template.strokeWidth = 1;
            chartForecedTreeSeries2.dataFields.collapsed = "collapsed";

            chartForecedTreeSeries2.minRadius = 30
            chartForecedTreeSeries2.maxRadius = 130

            var hoverState2 =   chartForecedTreeSeries2.links.template.states.create("hover");
            hoverState2.properties.strokeWidth = 3;
            hoverState2.properties.strokeOpacity = 1;

            chartForecedTreeSeries2.nodes.template.events.on("over", function(event) {
                event.target.dataItem.childLinks.each(function(link) {
                    link.isHover = true;
                })
                if (event.target.dataItem.parentLink) {
                    event.target.dataItem.parentLink.isHover = true;
                }
            })

            chartForecedTreeSeries2.nodes.template.events.on("out", function(event) {
                event.target.dataItem.childLinks.each(function(link) {
                    link.isHover = false;
                })
                if (event.target.dataItem.parentLink) {
                    event.target.dataItem.parentLink.isHover = false;
                }
            })


            chartForecedTreeSeries2.nodes.template.adapter.add("fill", function(fill, target) {
                return !(/^[0-9]/).test(target.dataItem.name) ? fill : target.dataItem.dataContext.fill
            });

            chartForecedTreeSeries2.nodes.template.adapter.add("stroke", function(fill, target) {
                return !(/^[0-9]/).test(target.dataItem.name) ? fill : target.dataItem.dataContext.fill
            });

            chartForecedTreeSeries2.nodes.template.label.adapter.add("text", function(text, target) {
                return (/^[0-9]/).test(target.dataItem.dataContext.name) ? (formatComms(target.dataItem.dataContext.name.toString()) + " HA") : text
            });

            chartForcedTree2.legend = new am4charts.Legend();
            chartForcedTree2.legend.valueLabels.template.text = "[bold]{value}[/]";
            chartForcedTree2.legend.position = "bottom";
            chartForcedTree2.legend.fontSize = 20
            

            let legendDataTree = dataForModalPyramid.map(value => {
                return {
                    fill: value.config.fill,
                    name: value.product,
                    img: `/project_images/${farm_products[(value.product).toUpperCase()].imgB}`,
                }
            })

            let legendForecedTree = new am4charts.Legend();
            legendForecedTree.position = "right";
            legendForecedTree.scrollable = true;
            legendForecedTree.parent = chartForcedTree2.chartContainer;
            legendForecedTree.data = legendDataTree
            legendForecedTree.fontSize = 20
            legendForecedTree.width = 300

            // Remove square from marker template
            var markerLegendFocedTree = legendForecedTree.markers.template;
            markerLegendFocedTree.disposeChildren();

            // Add custom image instead
            let ForcedtreeMarketLegendImage = markerLegendFocedTree.createChild(am4core.Image);
            ForcedtreeMarketLegendImage.width = 20;
            ForcedtreeMarketLegendImage.height = 20;
            ForcedtreeMarketLegendImage.verticalCenter = "top";
            ForcedtreeMarketLegendImage.horizontalCenter = "left";
            ForcedtreeMarketLegendImage.togglable = true;

            // We're going to use an adapter to set href
            ForcedtreeMarketLegendImage.adapter.add("href", function(href, target) {
                return target.dataItem.dataContext.img;  
            });

        })

        $('#modalMarketPie').on('hide.bs.modal', function () {
            const chartToRemove0 = document.getElementById("mapMarket2")
            document.getElementById("firstMarket").removeChild(chartToRemove0);
            
            const chartToRemove = document.getElementById("marketFarmPie2")
            document.getElementById("modalBodyMarket").removeChild(chartToRemove);

            const chartToRemove2 = document.getElementById("marketFarmTree2")
            document.getElementById("modalBodyTree").removeChild(chartToRemove2);

            const chartToRemove3 = document.getElementById("marketFarmPyramid2")
            document.getElementById("modalBodyPyramid").removeChild(chartToRemove3);

            const chartToRemove4 = document.getElementById("marketDirectTree2")
            document.getElementById("modalBodyForcedTree").removeChild(chartToRemove4);

            $("#spinnerModal").removeClass('hidden')
        })

        //-------------------------------------------------mapa de tree

        var marketFarmTree = am4core.create("marketFarmTree", am4charts.TreeMap);
        marketFarmTree.hiddenState.properties.opacity = 0; // this makes initial fade in effect

        marketFarmTree.data = [];

        marketFarmTree.colors.step = 2;

        // define data fields
        marketFarmTree.dataFields.value = "value";
        marketFarmTree.dataFields.name = "name";
        marketFarmTree.dataFields.children = "children";
        marketFarmTree.dataFields.color = 'color'

        marketFarmTree.zoomable = false;
        var bgColor = new am4core.InterfaceColorSet().getFor("background");

        // level 0 series template
        var level0SeriesTemplate = marketFarmTree.seriesTemplates.create("0");
        var level0ColumnTemplate = level0SeriesTemplate.columns.template;

        level0ColumnTemplate.column.cornerRadius(0, 0, 0, 0);
        level0ColumnTemplate.fillOpacity = 0;
        level0ColumnTemplate.strokeWidth = 4;
        level0ColumnTemplate.strokeOpacity = 0;

        // level 1 series template
        var level1SeriesTemplate = marketFarmTree.seriesTemplates.create("1");
        var level1ColumnTemplate = level1SeriesTemplate.columns.template;

        level1SeriesTemplate.tooltip.animationDuration = 0;
        level1SeriesTemplate.strokeOpacity = 1;

        level1ColumnTemplate.column.cornerRadius(10, 10, 10, 10)
        level1ColumnTemplate.fillOpacity = 1;
        level1ColumnTemplate.strokeWidth = 4;
        level1ColumnTemplate.stroke = bgColor;
        level1ColumnTemplate.tooltipText = "{name}: {value} HA"

        // var bullet1 = level1SeriesTemplate.bullets.push(new am4charts.LabelBullet());
        // bullet1.locationY = 0.5;
        // bullet1.locationX = 0.5;
        // bullet1.label.text = "{name}";
        // bullet1.label.fill = am4core.color("#ffffff");

        marketFarmTree.maxLevels = 2;


            //************************************ */




        //------------------------------------------- piramide
        var marketPiramidContainer = am4core.create("marketFarPiramid", am4core.Container);
        marketPiramidContainer.width = am4core.percent(100);
        marketPiramidContainer.height = am4core.percent(100);
        marketPiramidContainer.layout = "horizontal";

        var marketPiramidState = marketPiramidContainer.createChild(am4charts.XYChart);
        marketPiramidState.paddingRight = 0;
        marketPiramidState.data = JSON.parse(JSON.stringify([]));

        // Create axes
        var stateFarmCategoryAxis = marketPiramidState.yAxes.push(new am4charts.CategoryAxis());
        stateFarmCategoryAxis.dataFields.category = "farmValue";
        stateFarmCategoryAxis.renderer.grid.template.location = 0;
        //maleCategoryAxis.renderer.inversed = true;
        stateFarmCategoryAxis.renderer.minGridDistance = 15;

        var stateFarmValueAxis = marketPiramidState.xAxes.push(new am4charts.ValueAxis());
        stateFarmValueAxis.renderer.inversed = true;
        stateFarmValueAxis.min = 0;
        stateFarmValueAxis.max = piramidMaxValue;
        stateFarmValueAxis.strictMinMax = true;

        stateFarmValueAxis.numberFormatter = new am4core.NumberFormatter();
        stateFarmValueAxis.numberFormatter.numberFormat = "#,###,###' HA'";
        //stateFarmValueAxis.numberFormatter.numberFormat = "#.#'%'";

        // Create series
        var stateFarmSeries = marketPiramidState.series.push(new am4charts.ColumnSeries());
        stateFarmSeries.dataFields.valueX = "farmValueHA";
        stateFarmSeries.columns.template.configField = "config"
        //stateFarmSeries.dataFields.valueXShow = "percent";
        //stateFarmSeries.calculatePercent = true;
        stateFarmSeries.dataFields.categoryY = "farmValue";
        stateFarmSeries.interpolationDuration = 1000;
        //stateFarmSeries.columns.template.tooltipText = "Males, age{categoryY}: {valueX} ({valueX.percent.formatNumber('#.0')}%)";
        //stateFarmSeries.sequencedInterpolation = true;


        var totalFarmChart = marketPiramidContainer.createChild(am4charts.XYChart);
        totalFarmChart.paddingLeft = 0;
        totalFarmChart.data = JSON.parse(JSON.stringify([]));

        // Create axes
        var totalFarmCategoryAxis = totalFarmChart.yAxes.push(new am4charts.CategoryAxis());
        totalFarmCategoryAxis.renderer.opposite = true;
        totalFarmCategoryAxis.dataFields.category = "totalValue";
        totalFarmCategoryAxis.renderer.grid.template.location = 0;
        totalFarmCategoryAxis.renderer.minGridDistance = 15;
        


        var totalFarmValueAxis = totalFarmChart.xAxes.push(new am4charts.ValueAxis());
        totalFarmValueAxis.min = 0;
        totalFarmValueAxis.max = 0;
        totalFarmValueAxis.strictMinMax = true;
        //totalFarmValueAxis.numberFormatter = new am4core.NumberFormatter();
        //totalFarmValueAxis.numberFormatter.numberFormat = "#.#'%'";
        totalFarmValueAxis.renderer.minLabelPosition = 0.01;
        totalFarmValueAxis.numberFormatter.numberFormat = "#,###,###' HA'";

        // Create series
        var totalFarmSeries = totalFarmChart.series.push(new am4charts.ColumnSeries());
        totalFarmSeries.dataFields.valueX = "totalValue";
        //totalFarmSeries.dataFields.valueXShow = "percent";
        totalFarmSeries.calculatePercent = true;
        totalFarmSeries.fill = "#000000b0";
        totalFarmSeries.stroke = "#000000b0";
        //totalFarmSeries.sequencedInterpolation = true;
        //totalFarmSeries.columns.template.tooltipText = "Females, age{categoryY}: {valueX} ({valueX.percent.formatNumber('#.0')}%)";
        totalFarmSeries.dataFields.categoryY = "totalValue";
        totalFarmSeries.interpolationDuration = 1000;

        });



        /////////----------------------------------------directed-tree

        var chartForcedTree = am4core.create("marketDirectTree", am4plugins_forceDirected.ForceDirectedTree);
        var networkSeries = chartForcedTree.series.push(new am4plugins_forceDirected.ForceDirectedSeries())

        chartForcedTree.data = []

        networkSeries.dataFields.value = "value";
        networkSeries.dataFields.name = "name";
        networkSeries.dataFields.children = "children";
        networkSeries.nodes.template.tooltipText = "{valueState}";
        networkSeries.nodes.template.fillOpacity = 1;

        networkSeries.nodes.template.label.text = "{name}"
        networkSeries.fontSize = 15;

        networkSeries.links.template.strokeWidth = 1;
        networkSeries.dataFields.collapsed = "collapsed";

        networkSeries.minRadius = 5
        networkSeries.maxRadius = 70

        var hoverState = networkSeries.links.template.states.create("hover");
        hoverState.properties.strokeWidth = 3;
        hoverState.properties.strokeOpacity = 1;

        networkSeries.nodes.template.events.on("over", function(event) {
        event.target.dataItem.childLinks.each(function(link) {
            link.isHover = true;
        })
        if (event.target.dataItem.parentLink) {
            event.target.dataItem.parentLink.isHover = true;
        }

        })

        networkSeries.nodes.template.events.on("out", function(event) {
            event.target.dataItem.childLinks.each(function(link) {
                link.isHover = false;
            })
            if (event.target.dataItem.parentLink) {
                event.target.dataItem.parentLink.isHover = false;
            }
        })


        $("#expand-all").click(event => {
            const headerHidden = $("body").find('.brand').hasClass('hidden')
            const sideBar = $("body").find('.ts-sidebar').hasClass('hideSidebar')
            const content = $("body").find('.content-wrapper').hasClass('marginNone')

            headerHidden ? $("body").find('.brand').removeClass('hidden') : $("body").find('.brand').addClass('hidden')
            sideBar ? $("body").find('.ts-sidebar').removeClass('hideSidebar') : $("body").find('.ts-sidebar').addClass('hideSidebar')
            content ? $("body").find('.content-wrapper').removeClass('marginNone') : $("body").find('.content-wrapper').addClass('marginNone')
            
            headerHidden ? $(event.currentTarget).html('<i class="fa fa-plus-square-o fa-2x" aria-hidden="true" style="position: absolute;top: -15px;right:10px;cursor: pointer;z-index: 100;"></i>') : $(event.currentTarget).html('<i class="fa fa-minus-square-o fa-2x" aria-hidden="true" style="position: absolute;top: -15px;right: 10px;cursor: pointer;z-index: 100;"></i>')
        })

        
        //abrir modal del market
        $("#openModalPie").click(function(){
            if(!stateAndFarmActives()) return
            $('#modalMarketPie').modal('show')
            $('a[href="#firstMarket"]').tab('show') 
        })

        $("#openModalMap").click(function(){
            if(!stateAndFarmActives()) return
            $('#modalMarketPie').modal('show')
            $('a[href="#secondMarket"]').tab('show') 
        })

        $("#openModalPiramid").click(function(){
            if(!stateAndFarmActives()) return
            $('#modalMarketPie').modal('show')
            $('a[href="#thirdMarket"]').tab('show') 
        })

        $("#openModalTree").click(function(){
            if(!stateAndFarmActives()) return
            $('#modalMarketPie').modal('show')
            $('a[href="#fourthMarket"]').tab('show') 
        })

        const stateAndFarmActives = () => {        
            let activeFarms = []
        
            $('table > tbody  > tr > th').each(function(i, th) { 
                const element = $(th)
                if(element.attr('active') === "true" && !element.hasClass('ignore')){
                    activeFarms.push(farm_products[element.attr('value')].adapterBase)
                }
            });

            if(statesBaseMarket.length <= 0 || activeFarms.length <= 0){
                return false
            } 

            return true
        }
})

var formatter_1 = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
    minimunFractionDigits: 1,
});










let productsByLt = []
let ingredentsByProduct = {}
let rowGeneraCountId = 0


const userCanSeePrice = $('#pricePermission').attr('permissiongranted')


$('.addGeneralRowMarket').click(function(e){
    let dinamycCollapsedId = "collapse" + rowGeneraCountId.toString()
    let dinamycHeadId = "heading" + rowGeneraCountId.toString()
    let dinamyTableId = "zctb" + rowGeneraCountId.toString()


    const rowGeneralToadd = `
        <div class="panel panel-default overflow-visible ${dinamycCollapsedId}">
            <div class="panel-heading collapsedHeader" role="tab" id="${dinamycHeadId}">
            <div class="panel-title displayFlex">
                <div class="col-md-2">
                    <div class="toggleSearchCultivo">
                        <span class="searchCultivoLabel">Seleccionar Cultivo </span> <img src="/project_images/add2.png" width="20px" height="20px">                         
                    </div>
                    <div class="CultivoAdded" class="col-md-12 no-padding"></div>
                    <div>
                        <div class="dropdown-content myDropdownCultivo">
                            <input type="text" placeholder="Buscar.." autocomplete="off" class="searchComplete searchCultivo">
                            <div class="showValuesCultivos"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="toggleSearchStates">
                        <span class="searchStateLabel">Seleccionar estados</span> <img src="/project_images/add2.png" width="20px" height="20px">                         
                    </div>

                    <div class="col-md-12 no-padding StatedAdded"></div>
                    <div>
                        <div class="dropdown-content myDropdownState">
                            <input type="text" placeholder="Buscar.." autocomplete="off" class="searchComplete searchState">
                            <div class="showValuesStates"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <span class="collapsedLabels">Problema</span> <input type="text" class="form-control" placeholder="Descripción" id="marketProblem">
                </div>

                <div class="col-md-2">
                    <span class="collapsedLabels">Hectareas Sembradas</span> <input type="text" class="form-control haSembradas" placeholder="Mosquitos" value="0" disabled="disabled">
                </div>
                
                <div class="col-md-2">
                    <span class="collapsedLabels">Hectareas tratadas</span> <input type="text" class="form-control haTratadas" placeholder="0">
                </div>

                <div class="col-md-2 collapsedButtons">
                    <div role="button" data-toggle="collapse" href="#${dinamycCollapsedId}" aria-expanded="true" aria-controls="${dinamycCollapsedId}" style="padding-right: 10px">
                        <i class="fa fa-angle-down fa-3x" aria-hidden="true"></i>
                    </div>
                    <div class="cursor deleteGeneralRowMarket">
                        <i class="fa fa-trash-o fa-3x" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            </div>

            
            <div id="${dinamycCollapsedId}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="${dinamycHeadId}">
            <div class="panel-body">
                <div class="panel-body">
                    <div id="zctb_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <button class="button-add-product btn btn-primary">Agregar producto</button>
                                <button class="button-market-grahp btn btn-info">Analisis market share</button>
                                <table id="${dinamyTableId}" class="display table table-striped table-bordered table-hover dataTable table-scroll" cellspacing="0" width="100%" role="grid" aria-describedby="zctb_info">
                                    <thead>
                                        <tr role="row">
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="5" rowspan="1" colspan="1">Producto</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="6" rowspan="1" colspan="1">Ingrediente&nbsp;Activo</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="7" rowspan="1" colspan="1">Presentación</th>
                                            ${userCanSeePrice ? '<th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="8" rowspan="1" colspan="1">Precio&nbsp;Público</th>' : null}
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="9" rowspan="1" colspan="1">Precio&nbsp;Distribuidor</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="10" rowspan="1" colspan="1">Dosis&nbsp;por&nbsp;Ha</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="11" rowspan="1" colspan="1">Costo&nbsp;por&nbsp;Ha</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="12" rowspan="1" colspan="1">No.&nbsp;De&nbsp;Aplicaciónes&nbsp;por&nbsp;ciclo</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="13" rowspan="1" colspan="1">Costo&nbsp;por&nbsp;Ciclo&nbsp;por&nbsp;Ha</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="14" rowspan="1" colspan="1">Mercado&nbsp;Potencial&nbsp;Valor</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="15" rowspan="1" colspan="1">Mercado&nbsp;potencial&nbsp;en&nbsp;Ha&nbsp;Aplicadas</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="16" rowspan="1" colspan="1">N°&nbsp;de&nbsp;aplicaciones&nbsp;probables</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="17" rowspan="1" colspan="1">Mercado&nbsp;probable&nbsp;aplicado</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="18" rowspan="1" colspan="1">Objetivo</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="19" rowspan="1" colspan="1">MS&nbsp;Deseado&nbsp;en&nbsp;Ha</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="20" rowspan="1" colspan="1">Valor&nbsp;MS&nbsp;Deseado</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="21" rowspan="1" colspan="1">Litros&nbsp;equivalentes</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="22" rowspan="1" colspan="1">Analisis&nbsp;total</th>
                                            <th class=""  aria-controls="${dinamyTableId}"  aria-label="Name:" tabindex="23" rowspan="1" colspan="1">Eliminar</th>
                                        </tr>
                                    </thead>
        
                                    <tbody>
                                        <tr role="row" id="" class="marketTable">
                                            <td class="cursor">
                                                <div class="dropdownMarket toggleSearchProduct">
                                                    <button class="dropbtnMarket selectedProduct">
                                                        <div id="0">Seleccionar</div>
                                                    </button>
                                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                </div>
                                                <div>
                                                    <div class="dropdown-content myDropdownProduct">
                                                        <input type="text" placeholder="Buscar.." autocomplete="off" class="searchComplete searchProduct">
                                                        <div class="showValueProducts"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cursor iActivo td-disabled"></td>
                                            <td class="cursor unit td-disabled"></td>
                                            ${userCanSeePrice ? '<td class="cursor priceProduct td-disabled"></td>' : null}
                                            <td class="cursor">
                                                <input type="text" class="borderless pDistribuidor" placeholder="$0.00"/>
                                            </td>
                                            <td class="cursor">
                                                <input type="text" class="borderless dosis" placeholder="0"/>
                                            </td>
                                            <td class="cursor td-disabled">
                                                <input type="text" class="borderless priceHa" placeholder="$0.00" disabled="disabled"/>
                                            </td>
                                            <td class="cursor">
                                                <input type="text" class="borderless numberApplications" placeholder="0"/>
                                            </td>
                                            <td class="cursor td-disabled">
                                                    <input type="text" class="borderless pricePerCicle" placeholder="$0.00" disabled="disabled"/>
                                            </td>

                                            <td class="cursor td-disabled">
                                                    <input type="text" class="borderless potencialPrice" placeholder="$0.00" disabled="disabled"/>
                                            </td>

                                            <td class="cursor td-disabled">
                                                    <input type="text" class="borderless potencialPriceHa" placeholder="0" disabled="disabled"/>
                                            </td>
                                            <td class="cursor">
                                                    <input type="text" class="borderless ApplicationsWish" placeholder="0"/>
                                            </td>
                                            <td class="cursor td-disabled">
                                                <input type="text" class="borderless wishMarketHaApplications" placeholder="0" disabled="disabled"/>
                                            </td>

                                            <td class="cursor">
                                                <input type="text" class="borderless MsPercent" placeholder="0%">
                                            </td>

                                            <td class="cursor td-disabled">
                                                <input type="text" class="borderless MsWishHa" placeholder="0" disabled="disabled"/>
                                            </td>
                                            <td class="cursor td-disabled">
                                                <input type="text" class="borderless MsWish" placeholder="$0.00" disabled="disabled"/>
                                            </td>
                                            <td class="cursor td-disabled">
                                                <input type="text" class="borderless ltEquivalent" placeholder="0.00" disabled="disabled"/>
                                            </td>
                                            <td class="cursor td-button">
                                                <div class="marketAllData">Analizar</div>
                                            </td>
                                            <td class="cursor td-delete">
                                                <div class="deleteProductRow">
                                                    <i class="fa fa-times fa-lg" aria-hidden="true"></i>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    `

    $('.marketValueSection').append(rowGeneralToadd)
    rowGeneraCountId = rowGeneraCountId + 1
})


$('.panel-group').on("click", ".deleteGeneralRowMarket", function(e){
    $(this).closest('.panel-default').remove()
})




$('.panel-group').on("click", ".toggleSearchCultivo", function(e){
    let dropCultivo = $(this).closest('.panel-title').find('.myDropdownCultivo')
    let searchCultivo = $(this).closest('.panel-title').find('.searchCultivo')
    let showValuesCultivos = $(this).closest('.panel-title').find('.showValuesCultivos')

    if(dropCultivo.hasClass('show')){
        dropCultivo.removeClass('show')

    }else{
        searchCultivo.val("")
        dropCultivo.addClass('show')
        let cultivos = []

        let farms = Object.keys(farm_products)
        cultivos = farms.filter(x => farm_products[x].active)

        showValuesCultivos.html('');

        cultivos.forEach(val => {
            showValuesCultivos.append(`<div class="searchedValueCultivo" name="${val}" id="${val}">${val}</div>`)
        })

        if(cultivos.length === 0) showValuesCultivos.append('<div class="searchedValueCultivoEmpty">No hay resultados</div>')
    }
})

$('.panel-group').on("keyup", ".searchCultivo", function(ev){
    let value = ev.target.value
    let cultivos = []
    let farms = Object.keys(farm_products)
    cultivos = farms.filter(x => farm_products[x].active)

    const result = (cultivos.filter(cultivo => {
        let cultivoNormalize = deleteAcentos(cultivo).toUpperCase()
        let valueNormalize = deleteAcentos(value).toUpperCase()
        return cultivoNormalize.includes(valueNormalize)
    })).slice(0, 10)

    let showValuesCultivos = $(this).closest('.panel-title').find('.showValuesCultivos')
    showValuesCultivos.html('')

    result.forEach(val => {
        showValuesCultivos.append(`<div class="searchedValueCultivo" name="${val}" id="${val}">${val}</div>`)
    })

    if(cultivos.length === 0) showValuesCultivos.append('<div class="searchedValueCultivoEmpty">No hay resultados</div>')
})


$('body').on("click", ".searchedValueCultivo", function(e){
    let name = $(this).attr('name')
    let id = $(this).attr('id')
    $(this).closest('.myDropdownCultivo').removeClass('show')
    $(this).closest('.panel-title').find('.CultivoAdded').html(`<div id="${id}" name="${name}" class="labelCultivo"><span class="label label-primary text-normal">${name} &nbsp; <i class="fa fa-times deleteCultivo" aria-hidden="true"></i> </span></div>`)
    
    let stateNames = []
    $(this).closest('.panel-title').find('.StatedAdded').children('div').each(function () {
        stateNames.push($(this).attr('name'))
    });

    if(stateNames.length > 0 && name.length > 0){
        const elem = $(this).closest('.panel-title').find('.haSembradas')
        getHaBystatesAndfarm(stateNames, name, elem)
    }
})

$('body').on("click", ".deleteCultivo", function(e){
    $(this).closest('.panel-title').find('.haSembradas').val("0")
    $(this).closest('div').remove();
})


// const getCultivos = () => {
//     $.ajax({
//         type: "GET",
//         url: '/farms',
//         success: function( data ) {
//             cultivosMarket = data["farms"]
//         }
//     })
// }










$('.panel-group').on("click", ".toggleSearchStates", function(e){
    let dropState = $(this).closest('.panel-title').find('.myDropdownState')
    let searchState = $(this).closest('.panel-title').find('.searchState')
    let showValuesState = $(this).closest('.panel-title').find('.showValuesStates')

    if(dropState.hasClass('show')){
        dropState.removeClass('show')

    }else{
        searchState.val("")
        dropState.addClass('show')

        let mxStates
        let keyStates = Object.keys(states)
        mxStates = keyStates.filter(x => states[x].active)

        showValuesState.html('');

        mxStates.forEach(val => {
            showValuesState.append(`<div class="searchedValueState" name="${states[val].name}" id="${val}">${states[val].name}</div>`)
        })

        if(mxStates.length === 0) showValuesState.append('<div class="searchedValueCultivoEmpty">No hay resultados</div>')
    }
})

$('.panel-group').on("keyup", ".searchState", function(ev){
    let value = ev.target.value
    let keyStates = Object.keys(states)
    mxStates = keyStates.filter(x => states[x].active)

    const result = (mxStates.filter(state => {
        let stateNormalize = deleteAcentos(state).toUpperCase()
        let valueNormalize = deleteAcentos(value).toUpperCase()
        return stateNormalize.includes(valueNormalize)
    })).slice(0, 10)

    let showValuesStates = $(this).closest('.panel-title').find('.showValuesStates')
    showValuesStates.html('')

    result.forEach(val => {
        showValuesStates.append(`<div class="searchedValueState" name="${states[val].name}" id="${val}">${states[val].name}</div>`)
    })

    if(result.length === 0) showValuesStates.append('<div class="searchedValueCultivoEmpty">No hay resultados</div>')
})


$('body').on("click", ".searchedValueState", function(e){
    let name = $(this).attr('name')
    let id = $(this).attr('id')
    $(this).closest('.myDropdownState').removeClass('show')
    
    let exist = false
    let states = []

    $(this).closest('.panel-title').find('.StatedAdded').children('div').each(function () {
        states.push($(this).attr('name'))
        if(exist) return 
        exist = $(this).attr('id') === id
    });

    if(!exist){
        $(this).closest('.panel-title').find('.StatedAdded').append(`<div id="${id}" name="${name}" class="labelState col-md-12"><span class="label label-primary text-normal">${name} &nbsp; <i class="fa fa-times deleteState" aria-hidden="true"></i> </span></div>`)
        states.push(name)
        let cultivoDiv = $(this).closest('.panel-title').find('.CultivoAdded').children('div')[0]

        const elem = $(this).closest('.panel-title').find('.haSembradas')

        if(cultivoDiv != undefined){
            getHaBystatesAndfarm(states, $(cultivoDiv).attr('name'), elem)
        }
    }
})

$('body').on("click", ".deleteState", function(e){
    let states = []
    let name =  $(this).closest('div').attr('name')

    $(this).closest('.panel-title').find('.StatedAdded').children('div').each(function () {
        name === $(this).attr('name') ? null : states.push($(this).attr('name'))
    });

    if(states.length >= 1){
        let cultivoDiv = $(this).closest('.panel-title').find('.CultivoAdded').children('div')[0]

        const elem = $(this).closest('.panel-title').find('.haSembradas')

        if(cultivoDiv != undefined){
            getHaBystatesAndfarm(states, $(cultivoDiv).attr('name'), elem)
        }
    }else{
        $(this).closest('.panel-title').find('.haSembradas').val("0")
    }

    $(this).closest('div').remove();
})




$('.panel-group').on("keyup", ".haTratadas", function(e){
    let value = e.target.value.length <= 0 ? "" : formatComms(e.target.value.replace(/\D/g, ""))
    $(this).val(value)

    $(this).closest('.panel-default').find('.pricePerCicle').each(function(){
        let pricePerCicle = $(this).val()
        let mul = parseInt(e.target.value.replace(/\D/g, "")) * parseFloat(pricePerCicle.replace(/[$,]/gm, ""))
        let finalValueA = '$' + (isNaN(mul) ? "0.00" : formatPrice(mul.toFixed(2)))
        $(this).closest('.marketTable').find('.potencialPrice').val(finalValueA)
    })

    $(this).closest('.panel-default').find('.numberApplications').each(function(){
        let numberApplications = $(this).val()
        let mulA = parseInt(numberApplications) * parseInt(e.target.value.replace(/\D/g, ""))
        let finalValue = isNaN(mulA) ? "0" : formatComms(mulA.toString())
        $(this).closest('.marketTable').find('.potencialPriceHa').val(finalValue)
    })

    $(this).closest('.panel-default').find('.ApplicationsWish').each(function(){
        let ApplicationsWish = $(this).val()
        let mulB = parseFloat(ApplicationsWish) * parseInt(e.target.value.replace(/\D/g, ""))
        let finalValueB = isNaN(mulB) ? "0" : formatComms(mulB.toString())
        $(this).closest('.marketTable').find('.wishMarketHaApplications').val(finalValueB)
        $(this).closest('.marketTable').find('.wishMarketHaApplications').change()
    })
})


// const getMxStates = () => {
//     $.ajax({
//         type: "GET",
//         url: '/mxStates',
//         success: function( data ) {
//             mxStates = data["states"]
//         }
//     })
// }

const getHaBystatesAndfarm = (states, farm, elem) => {
    let farms = [deleteAcentos(farm.toUpperCase())]

    $.ajax({
        type: "GET",
        url: '/market/farming/values/'+ JSON.stringify(states) + "/" + JSON.stringify(farms),
        success: function( data ) {
            $(elem).val(formatComms(data["total_superficie"].toString()))
        },
        error: (e) => {
            console.log(e)
        }
    });
}

const getHaBystatesAndfarms = (states, farms, elem) => {

    $.ajax({
        type: "GET",
        url: '/market/farming/values/'+ JSON.stringify(states) + "/" + JSON.stringify(farms),
        success: function( data ) {
            $(elem).val(formatComms(data["total_superficie"].toString()))
            $('#marketF5SuperficiePercent').trigger('keyup', [{ extra : 'random string' }])
            firstLoadModalMarket = false
        },
        error: (e) => {
            console.log(e)
        }
    });
}










$('.panel-group').on("click", ".button-add-product", function(e){
    let row = `
        <tr role="row" id="" class="marketTable">
            <td class="cursor">
                <div class="dropdownMarket toggleSearchProduct">
                    <button class="dropbtnMarket selectedProduct">
                        <div id="0">Seleccionar</div>
                    </button>
                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                </div>
                <div>
                    <div class="dropdown-content myDropdownProduct">
                        <input type="text" placeholder="Buscar.." autocomplete="off" class="searchComplete searchProduct">
                        <div class="showValueProducts"></div>
                    </div>
                </div>
            </td>
            <td class="cursor iActivo td-disabled"></td>
            <td class="cursor unit td-disabled"></td>
            ${userCanSeePrice ? '<td class="cursor priceProduct td-disabled"></td>' : null }
            <td class="cursor">
                <input type="text" class="borderless pDistribuidor" placeholder="$0.00"/>
            </td>
            <td class="cursor">
                <input type="text" class="borderless dosis" placeholder="0"/>
            </td>
            <td class="cursor td-disabled">
                <input type="text" class="borderless priceHa" placeholder="$0.00" disabled="disabled"/>
            </td>
            <td class="cursor">
                <input type="text" class="borderless numberApplications" placeholder="0"/>
            </td>
            <td class="cursor td-disabled">
                    <input type="text" class="borderless pricePerCicle" placeholder="$0.00" disabled="disabled"/>
            </td>

            <td class="cursor td-disabled">
                    <input type="text" class="borderless potencialPrice" placeholder="$0.00" disabled="disabled"/>
            </td>

            <td class="cursor td-disabled">
                    <input type="text" class="borderless potencialPriceHa" placeholder="0" disabled="disabled"/>
            </td>
            <td class="cursor">
                    <input type="text" class="borderless ApplicationsWish" placeholder="0"/>
            </td>
            <td class="cursor td-disabled">
                <input type="text" class="borderless wishMarketHaApplications" placeholder="0" disabled="disabled"/>
            </td>

            <td class="cursor">
                <input type="text" class="borderless MsPercent" placeholder="0%">
            </td>

            <td class="cursor td-disabled">
                <input type="text" class="borderless MsWishHa" placeholder="0" disabled="disabled"/>
            </td>
            <td class="cursor td-disabled">
                <input type="text" class="borderless MsWish" placeholder="$0.00" disabled="disabled"/>
            </td>
            <td class="cursor td-disabled">
                <input type="text" class="borderless ltEquivalent" placeholder="0.00" disabled="disabled"/>
            </td>
            <td class="cursor td-button">
                <div class="marketAllData">Analizar</div>
            </td>
            <td class="cursor td-delete">
                <i class="fa fa-times fa-lg" aria-hidden="true"></i>
            </td>
        </tr>
    `

    $(this).closest('div').find('tbody').append(row)
})


let selectedCategoryIds = []
let marketShareDataChart = []
let seriesForMarket = []
let marketShareTotal = 0

$('.panel-group').on("click", ".td-delete", function(e){
    selectedCategoryIds.pop()
    $(this).closest('tr').remove()
})


$('.panel-group').on("click", ".button-market-grahp", function(e){

    let tipo = $(this).closest('div').find('.selectedProduct').find('div').attr('tipo')

    let classFromId = $(this).closest('.panel-collapse').attr('id')
    let cultivo = $('.'+classFromId).find('.CultivoAdded').find('div').attr('name')

    let cultivoAdapt = farm_products[cultivo].adapterBase

    let states = []

    $('.'+classFromId).find('.StatedAdded').children('div').each(function () {
        states.push($(this).attr('name'))
    });

    if(tipo != undefined && cultivo != undefined && states.length > 0){
        if(tipo != 'Fungicida' && tipo != 'Herbicida' && tipo != 'Insecticida') tipo = 'Otro'

        let marketshareUser = []
        let totalValue = 0

        $(this).closest('div').find('.marketTable').each(function () {
            let name = $(this).find('.selectedProduct').find('div').text()
            let value = $(this).find('.MsWish').val() != "" ? parseFloat($(this).find('.MsWish').val().replace(/[$,]/gm, "")) : 0

            totalValue = totalValue + value


            if(name != "Seleccionar"){
                marketshareUser.push({ "value" : value , "name" : name })
            }
        });

        $.ajax({
            type: "GET",
            url: '/market/getBaseValue/' + cultivoAdapt + '/' + JSON.stringify(states) + '/' + tipo,
            success: function( data ) {
                let typevalue = data['typevalue'] > totalValue ? data['typevalue'] : data['typevalue'] + totalValue

                marketshareUser = marketshareUser.sort((a,b) => (a.value < b.value) ? 1 : ((b.value < a.value) ? -1 : 0)); 

                let marketshareUserConcat = marketshareUser.reduce((carry, val) => {
                    carry[val.name] = parseFloat(((val.value * 100) / typevalue).toFixed(2)) * -1
                    return carry
                }, {})
                
                let total = { [tipo]: 100}
                let cult = {'category': cultivoAdapt}

                Object.assign(cult, marketshareUserConcat, total)
                
                marketShareDataChart = Object.assign(cult, marketshareUserConcat, total)

                let positiveColor = am4core.color(typeProductColors[tipo]);
                let negativeColor = ['#0088aaff','#5599ffff', '#00aad4ff', '#aaccffff', '#afdde9ff', '#d5d5ffff', '#9d93acff', '#8080ffff',  '#ccaaffff', '#c6afe9ff']

                let light = 0

                seriesForMarket = marketshareUser.map((x, index) => {
                    light = light + 0.2
                    return [x.name, x.name + ` - $${formatPrice(x.value.toString())}`, negativeColor[index]]
                })

                seriesForMarket.push( [tipo, tipo + ` - $${formatPrice(typevalue.toString())}`, positiveColor])

                marketShareTotal = data['total']

                $('#modalMarketshare').modal('show')

            }
        })

    }
})

$('#modalMarketshare').on('show.bs.modal', function (event) {
    $('#marketSharePreChart').html('<div id="marketShareChart"></div>')

    // Create chart instance
    let chart = am4core.create("marketShareChart", am4charts.XYChart);

    // Title
    let title = chart.titles.push(new am4core.Label());
    title.text = "Analisis de market share";
    title.fontSize = 35;
    title.marginBottom = 15;

    // Add data
    chart.data = [marketShareDataChart]

    // Create axes
    let categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "category";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.inversed = true;
    categoryAxis.renderer.minGridDistance = 20;
    categoryAxis.renderer.axisFills.template.disabled = false;
    categoryAxis.renderer.axisFills.template.fillOpacity = 0.05;
    categoryAxis.fontSize = 30;


    let valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
    valueAxis.min = -100;
    valueAxis.max = 100;
    valueAxis.renderer.minGridDistance = 50;
    valueAxis.renderer.ticks.template.length = 5;
    valueAxis.renderer.ticks.template.disabled = false;
    valueAxis.renderer.ticks.template.strokeOpacity = 0.4;
    
    valueAxis.renderer.labels.template.adapter.add("text", function(text) {
        return text + "%";
    })

    // Legend
    chart.legend = new am4charts.Legend();
    chart.legend.position = "bottom";
    chart.legend.minWidth = 250
    chart.legend.fontSize = 20
    chart.legend.verticalCente = "center"
    chart.legend.contentValign = "center"


    chart.legend.valueLabels.template.text = "{valueX}";

    // Use only absolute numbers
    chart.numberFormatter.numberFormat = "#.#s";

    // Create series
    function createSeries(field, name, color) {
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueX = field;
        series.dataFields.categoryY = "category";
        series.stacked = true;
        series.name = name;
        series.stroke = color;
        series.fill = color;
        
        var label = series.bullets.push(new am4charts.LabelBullet);
        label.label.text = "{valueX}%";
        label.label.fill = am4core.color("#fff");
        label.label.strokeWidth = 0;
        label.label.truncate = false;
        label.label.hideOversized = true;
        label.label.fontSize = 23;
        label.locationX = 0.5;
        return series;
    }

    seriesForMarket.forEach(x => {
        createSeries(x[0], x[1], x[2]);
    })


    chart.legend.events.on("layoutvalidated", function(event){
    chart.legend.itemContainers.each((container)=>{
        if(container.dataItem.dataContext.name == "Herbi"){
            container.toBack();
            }
        })
    })
})



let allDataMarketRow = []
let allDataMarketMoneyRow = []

$('.panel-group').on("click", ".marketAllData", function(e){
    let potencialPriceValue = $(this).closest('tr').find('.potencialPrice').val() === "" ? 0 : parseFloat($(this).closest('tr').find('.potencialPrice').val().replace(/[$,]/gm, ""))
    let potencialPriceHaValue = $(this).closest('tr').find('.potencialPriceHa').val() === "" ? 0 : parseFloat($(this).closest('tr').find('.potencialPriceHa').val().replace(/[$,]/gm, ""))
    let wishMarketAppValue = $(this).closest('tr').find('.wishMarketHaApplications').val() === "" ? 0 : parseFloat($(this).closest('tr').find('.wishMarketHaApplications').val().replace(/[$,]/gm, ""))
    let msWishHa = $(this).closest('tr').find('.MsWishHa').val() === "" ? 0 : parseFloat($(this).closest('tr').find('.MsWishHa').val().replace(/[$,]/gm, ""))
    let msWish = $(this).closest('tr').find('.MsWish').val() === "" ? 0 : parseFloat($(this).closest('tr').find('.MsWish').val().replace(/[$,]/gm, ""))
    let ltEquivalent = $(this).closest('tr').find('.ltEquivalent').val() === "" ? 0 : parseFloat($(this).closest('tr').find('.ltEquivalent').val().replace(/[$,]/gm, ""))

    allDataMarketRow = [
        //{name: "Mercado Potencial Valor", value: potencialPriceValue},
        {name: "Mercado potencial en Ha Aplicadas", value: potencialPriceHaValue},
        {name: "Mercado  Deseado HA Aplicadas", value: wishMarketAppValue},
        {name: "MS Deseado en Ha", value: msWishHa},
       // {name: "Valor  MS Deseado", value: msWish},
        {name: "Litros equivalentes", value: ltEquivalent},
    ]

    let percentWish = (msWish*100)/potencialPriceValue ? ((msWish*100)/potencialPriceValue).toFixed(2).toString() + '%' : "0%"

    allDataMarketMoneyRow = [{
        name: potencialPriceValue,
        children: [
        {
            name: msWish,
            value: msWish,
            percent1: percentWish
        }],
        value: potencialPriceValue,
        percent1: "100%"
    }]

    allDataMarketRow = allDataMarketRow.sort((a,b) => (a.value > b.value) ? 1 : ((b.value > a.value) ? -1 : 0)); 

    let classFromId = $(this).closest('.panel-collapse').attr('id')
    let title = $('.'+classFromId).find('#marketProblem').val() != undefined ? $('.'+classFromId).find('#marketProblem').val() : ""


    $('#titleMarketShare').text(`Resultados Mercado ${title}`)

    $('#modalMarketFunnel').modal('show')
})


$('#modalMarketFunnel').on('show.bs.modal', function (event) {
    $('#marketFunnelPreChart').html('<div id="marketFunnelChart"></div>')

    let chart = am4core.create("marketFunnelChart", am4charts.SlicedChart);
    chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

    chart.data = allDataMarketRow;


    let series = chart.series.push(new am4charts.FunnelSeries());
    series.colors.step = 2;
    series.dataFields.value = "value";
    series.dataFields.category = "name";
    series.alignLabels = true;

    series.labelsContainer.paddingLeft = 15;
    series.labelsContainer.width = 300;
    series.labels.template.textAlign = "end"

    //series.orientation = "horizontal";
    //series.bottomRatio = 1;

    chart.legend = new am4charts.Legend();
    chart.legend.position = "bottom";
    chart.legend.margin(5,5,20,5);
    chart.legend.valueLabels.template.text = "";
    

    series.labels.template.adapter.add("text", function(text, target) {
        let valueFormatter = formatComms(target.dataItem.label.dataItem.dataContext.value.toString())

        return target.dataItem.label.dataItem.dataContext.name.includes('Litros') ? `${text} \n ${valueFormatter}` : `${text} \n ${valueFormatter} HA`
    });






    ///forced-tree
    $('#marketTree4PreChart').html('<div id="marketTree4Chart" style="height: 100%"></div>')

    let chartForced= am4core.create("marketTree4Chart", am4plugins_forceDirected.ForceDirectedTree);
    let chartForecedSeries = chartForced.series.push(new am4plugins_forceDirected.ForceDirectedSeries())

    chartForced.data = allDataMarketMoneyRow;

    chartForecedSeries.dataFields.value = "value";
    chartForecedSeries.dataFields.name = "name";
    chartForecedSeries.dataFields.children = "children";
    chartForecedSeries.nodes.template.tooltipText = "{value}";
    chartForecedSeries.nodes.template.fillOpacity = 1;

    chartForecedSeries.nodes.template.label.text = "{name} \n {percent1}"
    chartForecedSeries.numberFormatter.numberFormat = "'$'#,###,###";
    chartForecedSeries.fontSize = 15;

    chartForecedSeries.links.template.strokeWidth = 1;
    chartForecedSeries.dataFields.collapsed = "collapsed";

    chartForecedSeries.minRadius = 50
    chartForecedSeries.maxRadius = 130

    let hoverState2 =   chartForecedSeries.links.template.states.create("hover");
    hoverState2.properties.strokeWidth = 3;
    hoverState2.properties.strokeOpacity = 1;

    chartForecedSeries.nodes.template.events.on("over", function(event) {
        event.target.dataItem.childLinks.each(function(link) {
            link.isHover = true;
        })
        if (event.target.dataItem.parentLink) {
            event.target.dataItem.parentLink.isHover = true;
        }
    })

    chartForecedSeries.nodes.template.events.on("out", function(event) {
        event.target.dataItem.childLinks.each(function(link) {
            link.isHover = false;
        })
        if (event.target.dataItem.parentLink) {
            event.target.dataItem.parentLink.isHover = false;
        }
    })

    let colorsFill = ["#d9534f", "#f47c3c"]

    chartForecedSeries.nodes.template.adapter.add("fill", function(fill, target, i) {
        return fill.hex === "#67b7dc" || fill.hex === "#d9534f"? colorsFill[0] : colorsFill[1]
    });

    chartForecedSeries.nodes.template.adapter.add("stroke", function(fill, target) {
        return fill.hex === "#67b7dc" || fill.hex === "#d9534f"? colorsFill[0] : colorsFill[1]
    });

    let legendDataTree = [
        {
            fill: "#d9534f",
            name: "Mercado Potencial Valor",
        },
        {
            fill: "#f47c3c",
            name: "Valor  MS Deseado",
        }
    ]
    

    let legendForecedTree4 = new am4charts.Legend();
    legendForecedTree4.position = "bottom";
    legendForecedTree4.valign = "bottom";
    legendForecedTree4.margin(5,5,20,5);
    legendForecedTree4.parent = chartForced.chartContainer;
    legendForecedTree4.data = legendDataTree

})




$('.panel-group').on("click", ".toggleSearchProduct", function(e){
    let dropProduct = $(this).closest('.marketTable').find('.myDropdownProduct')
    let searchProduct = $(this).closest('.marketTable').find('.searchProduct')
    let showValuesProducts = $(this).closest('.marketTable').find('.showValueProducts')

    if(dropProduct.hasClass('show')){
        dropProduct.removeClass('show')

    }else{
        searchProduct.val("")
        dropProduct.addClass('show')
        let products = productsByLt.slice(0, 10)

        showValuesProducts.html('');

        products.forEach(val => {
            let unidad = val.unidad === 'Mililitros' ? "Litro" : (val.unidad === 'Gramos' || val.unidad === 'Kilo') ? "Kilogramo" : val.unidad
            showValuesProducts.append(`<div class="searchedValue" categoryId="${val.categoria_id}" tipo="${val.tipo_producto}" name="${val.nombre_producto}" id="${val.id}" unit="${'1 ' + unidad}" iActivo="${val.ingrediente_activo}" price="${val.precio_por_medida}">${val.nombre_producto}</div>`)
        })
    }
})

$('.panel-group').on("keyup", ".searchProduct", function(ev){
    let value = ev.target.value
    let products = productsByLt
    const result = (products.filter(product => {
        let stateNormalize = deleteAcentos(product.nombre_producto).toUpperCase()
        let valueNormalize = deleteAcentos(value).toUpperCase()
        return stateNormalize.includes(valueNormalize)
    })).slice(0, 10)

    let showValuesProducts = $(this).closest('.marketTable').find('.showValueProducts')
    showValuesProducts.html('')

    result.forEach(val => {
        let unidad = val.unidad === 'Mililitros' ? "Litro" : (val.unidad === 'Gramos' || val.unidad === 'Kilo') ? "Kilogramo" : val.unidad
        showValuesProducts.append(`<div class="searchedValue" categoryId="${val.categoria_id}" tipo="${val.tipo_producto}" name="${val.nombre_producto}" id="${val.id}" unit="${'1 ' + unidad}" iActivo="${val.ingrediente_activo}" price="${val.precio_por_medida}">${val.nombre_producto}</div>`)
    })
})


$('body').on("click", ".searchedValue", function(e){
    let categoryId = $(this).attr('categoryId')
    let isValid = false

    let rows = $(this).closest('tbody').children().length
    let categorySelected = categoryId

    $(this).closest('tbody').find('tr').each(function(){
        let currentCategory = $(this).closest('.marketTable').find('.selectedProduct').find('div').attr('categoryId')
        if (currentCategory != undefined) categorySelected = currentCategory
    })
 

    if(categoryId != 1 && categoryId != 4 && categoryId != 5 ) categoryId = 4

    if(rows <= 1 || categorySelected === categoryId) {
        isValid = true
    }else{
        isValid = false
    }

    if(isValid){
        selectedCategoryIds.push(categoryId)

        let name = ($(this).attr('name')).replace(/\s/g, '&nbsp;')
        let iActivo = ($(this).attr('iActivo')).replace(/\s/g, '&nbsp;')
        let tipo = $(this).attr('tipo')
        $(this).closest('.marketTable').find('.myDropdownProduct').removeClass('show')
        $(this).closest('.marketTable').find('.selectedProduct').html(`<div categoryId="${categoryId}" tipo="${tipo}">${ name }</div>`)
        $(this).closest('.marketTable').find('.unit').html(`<div>${ $(this).attr('unit') }</div>`)
        $(this).closest('.marketTable').find('.priceProduct').html(`<div>${ $(this).attr('price') }</div>`)
        $(this).closest('.marketTable').find('.iActivo').html(`<div>${iActivo}</div>`)
    }else{
        alert("Debe seleccionar productos de una misma categoria.")
    }
})

$('.panel-group').on("blur", ".pDistribuidor", function(e){
    let value = e.target.value.length <= 0 ? "" : formatPrice(e.target.value)
    let valYeh = e.target.value.length <= 0 ? "" : "$" + formatPrice(e.target.value)
    $(this).val(valYeh)

    let dosis = $(this).closest('.marketTable').find('.dosis').val()

    let pDistribuidorFloat = parseFloat(value.replace(/[$,]/gm, ""))
    let dosisInt = parseFloat(dosis)
    let priceHa = pDistribuidorFloat * dosisInt
    let finalValue = '$' + (isNaN(priceHa) ? "0.00" : formatPrice(priceHa.toFixed(2)))
    $(this).closest('.marketTable').find('.priceHa').val(finalValue)
    $(this).closest('.marketTable').find('.priceHa').change()

    let MsWish = parseFloat($(this).closest('.marketTable').find('.MsWish').val().replace(/[$,]/gm, ""))
    let finalValueB = isNaN((MsWish/pDistribuidorFloat)) ? "$0.00" : '$' + formatComms((MsWish/pDistribuidorFloat).toFixed(2))
    $(this).closest('.marketTable').find('.ltEquivalent').val(finalValueB)
})

$('.panel-group').on("keyup", ".pDistribuidor, .haTratadas, .MsPercent, .ApplicationsWish, .dosis, .numberApplications", function(e){
    if(e.keyCode===13){
        $(this).blur();
    }
})

$('.panel-group').on("blur", ".dosis", function(e){
    let value = formatPercent(e.target.value)
    $(this).val(value)

    let pDistribuidor = $(this).closest('.marketTable').find('.pDistribuidor').val()

    let pDistribuidorFloat = parseFloat(pDistribuidor.replace(/[$,]/gm, ""))
    let dosisInt = parseFloat(value)
    let priceHa = pDistribuidorFloat * dosisInt
    let finalValue = '$' + (isNaN(priceHa) ? "0.00" : formatPrice(priceHa.toFixed(2)))
    $(this).closest('.marketTable').find('.priceHa').val(finalValue)
    $(this).closest('.marketTable').find('.priceHa').change()
})

$('.panel-group').on("blur", ".numberApplications", function(e){
    let value = formatPercent(e.target.value)
    $(this).val(value)
    
    let priceHa = $(this).closest('.marketTable').find('.priceHa').val()

    let priceHaFloat = parseFloat(priceHa.replace(/[$,]/gm, ""))
    let applicationInt = parseFloat(value)
    let pricePerCicle = priceHaFloat * applicationInt
    $(this).closest('.marketTable').find('.pricePerCicle').val('$' + (isNaN(pricePerCicle) ? "0.00" : formatPrice(pricePerCicle.toFixed(2))))
    $(this).closest('.marketTable').find('.pricePerCicle').change()

    let classFromId = $(this).closest('table').closest('.panel-collapse').attr('id')
    let haTratadas = parseInt($('.' + classFromId).find('.haTratadas').val().replace(/[\s,HA]/gm, ""))
    let finalValue = isNaN(haTratadas*applicationInt) ? "0.00" : formatComms((haTratadas*applicationInt).toString())
    $(this).closest('.marketTable').find('.potencialPriceHa').val(finalValue)

    
    let wishApps = parseFloat($(this).closest('.marketTable').find('.ApplicationsWish').val())

    if(wishApps > applicationInt){
        $(this).closest('.marketTable').find('.ApplicationsWish').val(value)
        $(this).closest('.marketTable').find('.ApplicationsWish').keyup()
    }
})

$('.panel-group').on("change", ".priceHa", function(e){
    let value = e.target.value
    
    let numberApplications = $(this).closest('.marketTable').find('.numberApplications').val()
    let priceHaFloat = parseFloat(value.replace(/[$,]/gm, ""))

    if(value.length > 0 &&  numberApplications.length > 0){
        let applicationInt = parseFloat(numberApplications)
        let pricePerCicle = priceHaFloat * applicationInt
        $(this).closest('.marketTable').find('.pricePerCicle').val('$' + formatPrice(pricePerCicle.toFixed(2)))
        $(this).closest('.marketTable').find('.pricePerCicle').change()
    }

    let MsWishHa = parseFloat($(this).closest('.marketTable').find('.MsWishHa').val().replace(/[,]/gm, ""))
    let finalValue = isNaN((priceHaFloat*MsWishHa)) ? "$0.00" : '$' + formatComms((priceHaFloat*MsWishHa).toFixed(2))
    $(this).closest('.marketTable').find('.MsWish').val(finalValue)
    $(this).closest('.marketTable').find('.MsWish').change()
})

$('.panel-group').on("change", ".pricePerCicle", function(e){
    let classFromId = $(this).closest('table').closest('.panel-collapse').attr('id')
    let haTratadas = parseInt($('.' + classFromId).find('.haTratadas').val().replace(/[\s,HA]/gm, ""))
    let pricePerCicle = parseFloat(e.target.value.replace(/[$,]/gm, ""))
    let finalValue = '$' + (isNaN(haTratadas*pricePerCicle) ? "0.00" : formatPrice((haTratadas*pricePerCicle).toFixed(2)))

    $(this).closest('.marketTable').find('.potencialPrice').val(finalValue)
})

$('.panel-group').on("blur", ".ApplicationsWish", function(e){
    let value = formatPercent(e.target.value)
    $(this).val(value)
    
    let applicationsValue =  parseFloat($(this).closest('.marketTable').find('.numberApplications').val())
    value = parseFloat(value)

    if(value > applicationsValue){
        $(this).val(applicationsValue)
        value = applicationsValue
    }

    let classFromId = $(this).closest('table').closest('.panel-collapse').attr('id')
    let haTratadas = parseInt($('.' + classFromId).find('.haTratadas').val().replace(/[\s,HA]/gm, ""))
    let mul = haTratadas * value

    $(this).closest('.marketTable').find('.wishMarketHaApplications').val(formatComms((isNaN(mul) ? 0 : mul).toString()))
    $(this).closest('.marketTable').find('.wishMarketHaApplications').change()
})

$('.panel-group').on("change", ".wishMarketHaApplications", function(e){
    
    let wishMarketHaApplications = parseInt($(this).val().replace(/\D/g, ""))
    let MsPercent = parseFloat(($(this).closest('.marketTable').find('.MsPercent').val()).replace(/[%]/gm, ""))
    let finalValue = isNaN((MsPercent*wishMarketHaApplications)/100) ? "0" : formatComms(((MsPercent*wishMarketHaApplications)/100).toFixed(2))

    $(this).closest('.marketTable').find('.MsWishHa').val(finalValue)
    $(this).closest('.marketTable').find('.MsWishHa').change()
})

$('.panel-group').on("blur", ".MsPercent", function(e){
    let value = e.target.value.length <= 0 ? "" : formatPercent(e.target.value)
    let valueShow = e.target.value.length <= 0 ? "" : formatPercent(e.target.value) + "%"
    $(this).val(valueShow)

    let MsPercent = parseFloat(value)
    let wishMarketHaApplications = ($(this).closest('.marketTable').find('.wishMarketHaApplications').val()).replace(/\D/g, "")
    let finalValue = isNaN((MsPercent*wishMarketHaApplications)/100) ? "0" : formatComms(((MsPercent*wishMarketHaApplications)/100).toFixed(2))
    $(this).closest('.marketTable').find('.MsWishHa').val(finalValue)
    $(this).closest('.marketTable').find('.MsWishHa').change()
})

$('.panel-group').on("change", ".MsWishHa", function(e){
    let MsWishHa = parseFloat(e.target.value.replace(/[,]/gm, ""))

    let priceHa = $(this).closest('.marketTable').find('.priceHa').val()
    let priceHaFloat = parseFloat(priceHa.replace(/[$,]/gm, ""))

    let finalValue = isNaN((priceHaFloat*MsWishHa)) ? "$0.00" : '$' + formatComms((priceHaFloat*MsWishHa).toFixed(2))
    $(this).closest('.marketTable').find('.MsWish').val(finalValue)
    $(this).closest('.marketTable').find('.MsWish').change()
})


$('.panel-group').on("change", ".MsWish", function(e){
    let MsWish = parseFloat(e.target.value.replace(/[$,]/gm, ""))
    let pDistribuidor = parseFloat(($(this).closest('.marketTable').find('.pDistribuidor').val()).replace(/[$,]/gm, ""))
    let finalValue = isNaN((MsWish/pDistribuidor)) ? "0.00" : formatComms((MsWish/pDistribuidor).toFixed(2))
    $(this).closest('.marketTable').find('.ltEquivalent').val(finalValue)
})





const getProductsLt = () => {
    $.ajax({
        type: "GET",
        url: '/productsByLt',
        success: function( data ) {
            productsByLt = data["products"]
        }
    })
}


getProductsLt()



































const deleteAcentos = (texto)  => {
    return texto
           .normalize('NFD')
           .replace(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi,"$1")
           .normalize();
}

const formatPrice = (value) => {
    let dotExist = value.indexOf(".") === -1 ? false : true
    let firstValue = dotExist ? value.split(".")[0] : value
    let cleanFirst = firstValue.replace(/\D/g, "")

    if(cleanFirst.length <= 0) return ""
    let finalfirst = cleanFirst.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    let secondValue = dotExist ? (value.split(".")[1]).slice(0, 2) : "00"
    let formarSecondValue = dotExist ? secondValue.length === 0 ? "00" : secondValue.length === 1 ? secondValue + "0" : secondValue : "00"

    return finalfirst + "." + formarSecondValue
}

const formatPercent = (value, decim = 2) => {
    let dotExist = value.indexOf(".") === -1 ? false : true
    let firstValue = dotExist ? value.split(".")[0] : value
    let cleanFirst = firstValue.replace(/\D/g, "")

    if(cleanFirst.length <= 0) return ""
    let finalfirst = cleanFirst.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    let secondValue = dotExist ? (value.split(".")[1]).slice(0, decim).replace(/\D/g, "") : "00"
    let formarSecondValue = dotExist ? secondValue.length === 0 ? "00" : secondValue.length === 1 ? secondValue + "0" : secondValue : "00"

    return dotExist ? (finalfirst + "." + formarSecondValue) : finalfirst
}


const formatEntryWithDot = value => {
    let dotExist = value.indexOf(".") === -1 ? false : true
    let firstValue = dotExist ? value.split(".")[0] : value
    let cleanFirst = firstValue.replace(/\D/g, "")

    if(cleanFirst.length <= 0) return ""
    let finalfirst = cleanFirst.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    let secondValue = dotExist ? '.' + (value.split(".")[1]).slice(0, 2).replace(/\D/g, "") : ""

    return dotExist ? (finalfirst + secondValue) : finalfirst
}




const formatComms = value => value.replace(/\B(?=(\d{3})+(?!\d))/g, ",")

const buildRowsForAdvance = (farms, states, id) => {
    const farmDivs = farms.map(farm => `<div>&bull; ${farm_products[farm].adapterBase}</div>`)
    const statesDivs = states.map(state => `<div>&bull; ${state}</div>`)

    const row = `
        <tr role="row" states="${states}" farms="${farms}" id="${id}">
            <td class="center-td">
                <div class="checkbox checkbox-primary row" style="padding: 0px">
                    <input type="checkbox">
                    <label for="${id}"></label>
                </div>
            </td>
            <td>${farmDivs.join('')}</td>
            <td>${statesDivs.join('')}</td>
            <td class="center-td cursor">
                <i class="fa fa-trash-o fa-2x delete-advanced-values" aria-hidden="true" id="${id}"></i>
            </td>
        </tr>
    `

    return row
}





$($.fn.dataTable.tables(true)).DataTable()
   .columns.adjust();

