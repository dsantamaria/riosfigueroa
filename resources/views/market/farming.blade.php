@extends('layouts.app')
@section('content')
@can('market')
<div class="col-md-12">
    <div id="pricePermission"  @can('price') permissiongranted="true" @endcan></div>

    <div id="expand-all" active="false">
        <i class="fa fa-plus-square-o fa-2x" aria-hidden="true" style="position: absolute;top: -15px;right:10px;cursor: pointer;z-index: 100;"></i>
    </div>

    <div class="col-md-12">

        <div class="col-md-12" style="font-size: 25px; font-weight: bold">Valor del mercado <span class="addGeneralRowMarket">Agregar +</span></div>

        <div class="panel-group col-md-12 marketValueSection" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default overflow-visible collapseFirst">
                <div class="panel-heading collapsedHeader" role="tab" id="headingFirst">
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
                        <div role="button" data-toggle="collapse" href="#collapseFirst" aria-expanded="true" aria-controls="collapseFirst" style="padding-right: 10px">
                            <i class="fa fa-angle-down fa-3x" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                </div>
    
                
                <div id="collapseFirst" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFirst">
                <div class="panel-body">
                    <div class="panel-body">
                        <div id="zctb_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="button-add-product btn btn-primary">Agregar producto</button>
                                    <button class="button-market-grahp btn btn-info">Analisis market share</button>
                                    <table id="zctbFirst" class="display table table-striped table-bordered table-hover dataTable table-scroll" cellspacing="0" width="100%" role="grid" aria-describedby="zctb_info">
                                        <thead>
                                            <tr role="row">
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="5" rowspan="1" colspan="1">Producto</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="6" rowspan="1" colspan="1">Ingrediente&nbsp;Activo</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="7" rowspan="1" colspan="1">Presentación</th>
                                                @can('price')<th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="8" rowspan="1" colspan="1">Precio&nbsp;Público</th>@endcan
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="9" rowspan="1" colspan="1">Precio&nbsp;Distribuidor</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="10" rowspan="1" colspan="1">Dosis&nbsp;por&nbsp;Ha</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="11" rowspan="1" colspan="1">Costo&nbsp;por&nbsp;Ha</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="12" rowspan="1" colspan="1">No.&nbsp;De&nbsp;Aplicaciónes&nbsp;por&nbsp;ciclo</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="13" rowspan="1" colspan="1">Costo&nbsp;por&nbsp;Ciclo&nbsp;por&nbsp;Ha</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="14" rowspan="1" colspan="1">Mercado&nbsp;Potencial&nbsp;Valor</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="15" rowspan="1" colspan="1">Mercado&nbsp;potencial&nbsp;en&nbsp;Ha&nbsp;Aplicadas</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="16" rowspan="1" colspan="1">N°&nbsp;de&nbsp;aplicaciones&nbsp;probables</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="17" rowspan="1" colspan="1">Mercado&nbsp;probable&nbsp;aplicado</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="18" rowspan="1" colspan="1">Objetivo</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="19" rowspan="1" colspan="1">MS&nbsp;Deseado&nbsp;en&nbsp;Ha</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="20" rowspan="1" colspan="1">Valor&nbsp;MS&nbsp;Deseado</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="21" rowspan="1" colspan="1">Litros&nbsp;equivalentes</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="22" rowspan="1" colspan="1">Analisis&nbsp;total</th>
                                                <th class=""  aria-controls="zctbFirst"  aria-label="Name:" tabindex="23" rowspan="1" colspan="1">Eliminar</th>
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
                                                @can('price')<td class="cursor priceProduct td-disabled"></td>@endcan
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
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-5" style="margin-top: 5px">
        <div class="col-md-6" style="border-right: solid 1px #6f6fec;">
            <div  class="col-md-12" id="marketFarmPie" style="height: 200px;" > </div>
            <div class="external-chart" id="openModalPie">
                <i class="fa fa-external-link fa-lg" data-toggle="modal"></i>
            </div>
            <div style="position: absolute;width: 100%;text-align: center;top: 0;left: 0;font-size: 12px;">Porcentaje de Hectáreas (Ha)</div>
        </div>

        <div class="col-md-6" >
            <div class="col-md-12" id="marketFarmTree" style="height: 200px;"> </div>
            <div class="external-chart" id="openModalMap">
                <i class="fa fa-external-link fa-lg" data-toggle="modal"></i>
            </div>
            <div style="position: absolute;width: 100%;text-align: center;top: 0;left: 0;font-size: 12px;">Cantidad de Hectáreas (Ha) por cultivo</div>
        </div>

        <div class="col-md-6" style="border-right: solid 1px #6f6fec; border-top: solid 1px #6f6fec;">
            <div class="col-md-12" id="marketFarPiramid" style="height: 200px;"> </div>
            <div class="external-chart" id="openModalPiramid">
                <i class="fa fa-external-link fa-lg" data-toggle="modal"></i>
            </div>
            <div style="position: absolute;width: 100%;text-align: center;top: 0;left: 0;font-size: 12px;">Superficie Cultivo vs Siembra Cultivo Nacional</div>
        </div>

        <div class="col-md-6" style="border-top: solid 1px #6f6fec;">
            <div style="position: absolute;width: 100%;height: 100%;z-index: 10;"></div>
            <div class="col-md-12" id="marketDirectTree" style="height: 200px;"> </div>
            <div class="external-chart" id="openModalTree">
                <i class="fa fa-external-link fa-lg" data-toggle="modal"></i>
            </div>
            <div style="position: absolute;width: 100%;text-align: center;top: 0;left: 0;font-size: 12px;">Superficie seleccionada vs Superficie sembrada</div>
        </div>
        

        <div class="col-md-12" id="market-products-table">
            <div class="col-md-12" style="text-align: center">
                <div>Cultivos</div>
            </div>
            <table style="width:100%">
                <tbody>
                    <tr id="market-table-first-tr">
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="AGAVE" title="agave" product="agave"><img src="/project_images/Agave N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="AGUACATE" title="Aguacate" product="aguacate"><img src="/project_images/Aguacate N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="AJO" title="Ajo" product="ajo"><img src="/project_images/Ajo N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="ALFALFA VERDE" title="alfalfa" product="alfalfa"><img src="/project_images/Alfalfa N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="ALGODN HUESO" title="Algodon" product="algodon"><img src="/project_images/Algodón N.svg" width="30px" height="30px"></th>
                    </tr>
        
                    <tr>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="ARROZ PALAY" title="Arroz palay" product="arroz palay"><img src="/project_images/Arroz N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="AVENA GRANO" title="Avena" product="avena"><img src="/project_images/Avena Grano N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="BERENJENA" title="Berenjena" product="berenjena"><img src="/project_images/Berenjena N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="BROCOLI" title="Brócoli" product="brocoli"><img src="/project_images/Brócoli N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="CACAO" title="Cacao" product="cacao"><img src="/project_images/Cacao N.svg" width="30px" height="30px"></th>
                    </tr>
        
                    <tr>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="CALABACITA" title="Calabacita" product="calabacita"><img src="/project_images/Calabacita N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="CAA DE AZUCAR" title="Caña de azucar" product="caña de azucar"><img src="/project_images/Caña de Azúcar N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="CEBOLLA" title="Cebolla" product="cebolla"><img src="/project_images/Cebolla N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="CHILE VERDE" title="Chile" product="chile"><img src="/project_images/Chile Verde N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="CRISANTEMO (Gruesa)" title="Crisantemo" product="crisantemo"><img src="/project_images/Crisantemo N.svg" width="30px" height="30px"></th>
                    </tr>
        
                    <tr>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="DURAZNO" title="Durazno" product="durazno"><img src="/project_images/Durazno N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="ESPARRAGO" title="Esparrago" product="esparrago"><img src="/project_images/Esparrago N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="FRAMBUESA" title="Frambuesa" product="frambuesa"><img src="/project_images/Frambuesa N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="FRESA" title="Fresa" product="fresa"><img src="/project_images/Fresa N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="FRIJOL" title="Frijol" product="frijol"><img src="/project_images/Frijol N.svg" width="30px" height="30px"></th>
                    </tr>

                    <tr>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="GLADIOLA (Gruesa)" title="Gladiola" product="limon"><img src="/project_images/Gladiola N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="LECHUGA" title="Lechuga" product="lechuga"><img src="/project_images/Lechuga N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="LIMON" title="Limon" product="limon"><img src="/project_images/Limón N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="MAIZ GRANO" title="Maíz" product="maiz"><img src="/project_images/Maíz (Grano) N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="MANGO" title="Mango" product="mango"><img src="/project_images/Mango N.svg" width="30px" height="30px"></th>
                    </tr>

                    <tr>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="MANZANA" title="Manzana" product="manzana"><img src="/project_images/Manzana N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="MELON" title="Melón" product="melon"><img src="/project_images/Melón N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="NARANJA" title="Naranja" product="naranaja"><img src="/project_images/Naranja N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="NUEZ" title="Nogal (Nuez)" product="nogal (nuez)"><img src="/project_images/Nogal (Nuez) N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="PAPA" title="Papa" product="papa"><img src="/project_images/Papa N.svg" width="30px" height="30px"></th>
                    </tr>
                        
                    <tr>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="PAPAYA" title="Papaya" product="papaya"><img src="/project_images/Papaya N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="PEPINO" title="Pepino" product="pepino"><img src="/project_images/Pepino N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="PIA" title="Piña" product="piña"><img src="/project_images/Piña N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="PLATANO" title="Platano" product="platano"><img src="/project_images/Plátano N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="ROSA (Gruesa)" title="Rosas (Gruesa)" product="rosas (gruesas)"><img src="/project_images/Rosas (Gruesa) N.svg" width="30px" height="30px"></th>
                    </tr>

                    <tr>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="SANDIA" title="Sandía" product="sandia"><img src="/project_images/Sandía N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="SORGO GRANO" title="Sorgo" product="sorgo"><img src="/project_images/Sorgo N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="SOYA" title="Soya" product="soya"><img src="/project_images/Soya N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="TABACO" title="Tabaco" product="tabaco"><img src="/project_images/Tabaco N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="TOMATE ROJO (JITOMATE)" title="Tomate" product="tomate"><img src="/project_images/Jitomate (Tomate) N.svg" width="30px" height="30px"></th>
                    </tr>

                    <tr>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="TOMATE VERDE" title="Tomate Verde" product="tomate verde"><img src="/project_images/Tomate Verde N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="TORONJA (POMELO)" title="Toronja (Pomelo)" product="toronja (pomelo)"><img src="/project_images/Toronja (Pomelo) N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="TRIGO GRANO" title="Trigo" product="trigo"><img src="/project_images/Trigo Grano N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="UVA" title="Uva" product="uva"><img src="/project_images/Uva N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="ZANAHORIA" title="Zanahoria" product="zanahoria"><img src="/project_images/Zanahoria N.svg" width="30px" height="30px"></th>
                    </tr>

                    <tr id="market-table-last-tr">
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="ZARZAMORA" title="Zarzamora" product="zarzamora"><img src="/project_images/Zarzamora N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="CAF CEREZA" title="Café" product="cafe"><img src="/project_images/Café N.svg" width="30px" height="30px"></th>
                        <th class="market-product-desactive" active="false" data-toggle="tooltip" value="COLIFLOR" title="Col (repollo)" product="coliflor"><img src="/project_images/Col (Repollo) N.svg" width="30px" height="30px"></th>
                        <th class="market-all ignore" active="false" data-toggle="tooltip" value="" title="" product=""><img src="/project_images/baseline_eco_black_48dp.png" width="30px" height="30px"></th>
                        <th class="ignore" active="false" data-toggle="tooltip" value="" title="" product="" style="background-color: white"></th>
                    </tr>

                    {{-- <th class="market-product-desactive" active="false" data-toggle="tooltip" value="PASTOS Y PRADERAS" title="Pastos y praderas" product="pastos y praderas"><img src="/project_images/Pastos y Praderas N.svg" width="30px" height="30px"></th> --}}
                    {{-- <th class="market-product-desactive" active="false" data-toggle="tooltip" value="ARANDANO" title="Arandano" product="arandano"><img src="/project_images/Arándano N.svg" width="30px" height="30px"></th> --}}
                    {{-- <th class="market-product-desactive" active="false" data-toggle="tooltip" value="CACAHUETE" title="Cacahuete" product="cacahuete"><img src="/project_images/Cacahuate N.svg" width="30px" height="30px"></th> --}}
                    {{-- <th class="market-product-desactive" active="false" data-toggle="tooltip" value="PALMA DE ACEITE" title="Palma de aceite" product="palma de aceite"><img src="/project_images/Palma de Aceite N.svg" width="30px" height="30px"></th> --}}
                    {{-- <th class="market-product-desactive" active="false" data-toggle="tooltip" value="CAFE" title="Cafe" product="cafe"><img src="/project_images/Café N.svg" width="30px" height="30px"></th> --}}
                    {{-- <th class="market-product-desactive" active="false" data-toggle="tooltip" value="CHICHARO" title="Chicharo" product="chicharo"><img src="/project_images/Chícharo N.svg" width="30px" height="30px"></th> --}}
                    {{-- <th class="market-product-desactive" active="false" data-toggle="tooltip" value="CLAVEL" title="Clavel" product="clavel"><img src="/project_images/Clavel N.svg" width="30px" height="30px"></th>
                    <th class="market-product-desactive" active="false" data-toggle="tooltip" value="" title="" product=""><img src="/project_images/baseline_eco_black_48dp.png" width="30px" height="30px"></th> --}}
                    {{-- <th class="market-product-desactive" active="false" data-toggle="tooltip" value="COL (REPOLLO)" title="Col (Repollo)" product="col (repollo)"><img src="/project_images/Col (Repollo) N.svg" width="30px" height="30px"></th> --}}
                </tbody>
              </table>
        </div>

        <div class="col-md-12" style="margin-top: 10px">
            <div class="col-md-2 col-md-offset-1 market-product-item" style="text-align: center">
                <i class="fa fa-square fa-2x default-color-product" active="false" id="insecticida-product-market"></i>
                <div>Insecticida</div> 
            </div>
            <div class="col-md-2 market-product-item" style="text-align: center">
                <i class="fa fa-square fa-2x default-color-product" active="false" id="herbicida-product-market"></i>
                <div>Herbicida</div> 
            </div>
            <div class="col-md-2 market-product-item" style="text-align: center">
                <i class="fa fa-square fa-2x default-color-product" active="false" id="fungicida-product-market"></i>
                <div>Fungicida</div> 
            </div>
            <div class="col-md-2 market-product-item" style="text-align: center">
                <i class="fa fa-square fa-2x default-color-product" active="false" id="otros-product-market"></i>
                <div>Otros</div> 
            </div>
            <div class="col-md-2 market-product-item" style="text-align: center">
                <i class="fa fa-square fa-2x default-color-product" active="false" id="total-product-market"></i>
                <div>Total</div> 
            </div>            
        </div>
    </div>

    <div class="col-md-7">
        <div class="row">
            <div class="col-md-6">
                <div id="mapMarket" style="width: 80%; height: 400px; margin-left:10%"></div>
                <div style="text-align: center">
                    <button id="selectFarmingAll" active="false">Seleccionar Todos</button>
                    <button id="selectFarmingRegion">Seleccionar Región</button>
                    <button id="saveRegion">Guardar Selección</button>
                </div>              

                {{-- <div class="checkbox checkbox-primary row">
                    <div class="col-md-12" style="margin-bottom: 12px">
                        <input type="checkbox" id="market-advance-farms-states">
                        <label for="market-advance-farms">Visualizar valores personalizados</label>
                    </div>
                </div> --}}
            </div>
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-danger" style="font-size: 24px; color: white;background-color:#c10000;display: flex;justify-content: space-between;">Insecticida: <span id="insecticidaValue">$0</span></li>
                    <li class="list-group-item list-group-item-success" style="font-size: 24px; color: white;background-color:#026f02;display: flex;justify-content: space-between;">Herbicida: <span id="herbicidaValue">$0</span></li>
                    <li class="list-group-item list-group-item-warning" style="font-size: 24px; color: white; background-color: #750275;display: flex;justify-content: space-between;">Fungicida: <span id="fungicidaValue">$0</span></li>
                    <li class="list-group-item list-group-item-warning" style="font-size: 24px; color: white;background-color: orange;display: flex;justify-content: space-between;">Otros: <span id="otrosValue">$0</span></li>
                    <li class="list-group-item list-group-item-info" style="font-size: 24px; color: white;background-color: darkblue;display: flex;justify-content: space-between;">Total: <span id="totalValue">$0</span></li>
                </ul>
            </div>

            <div class="col-md-12">
                <div style="text-align: center;padding-top: 10px;font-size: 15px;">Resumen por cultivo</div>
                <div style="position: absolute;color: skyblue;top: 6px;right: 20px;z-index: 1;cursor: pointer" id="toggleModalBaseMarketConfig">
                    <i class="fa fa-asterisk fa-lg" aria-hidden="true"></i>
                </div>
                <div style="position: absolute;top: 8px;right: 45px;z-index: 1;cursor: pointer" id="toggleModalBaseMarket">
                    <i class="fa fa-external-link fa-lg" aria-hidden="true"></i>
                </div>
                <div id="baseMarketSmall" style="height: 400px"></div>
            </div>
        </div>
    </div>

    {{-- <div class="col-md-8 col-md-offset-4" style="">

        <div id="testiiing" style="height: 400px"></div>

        {{-- <div style="padding-bottom: 5px;color: skyblue;cursor: pointer;font-weight: bold;" id="toggleAdvancedMarket">
            <i class="fa fa-asterisk" aria-hidden="true"></i> Configuraciones avanzadas
        </div> --}}

        {{-- <div class="row hidden" id="marketAdvanced">
            <div class="form-group col-md-12">
                <label>Superficie sembrada</label>
                <input type="text" class="form-control" disabled="disabled" placeholder="0" id="marketF5SuperficieSembrada" valueNum="0">
            </div>
            <div class="row" style="padding-left: 15px;padding-right: 15px;display: flex;align-items: center;">
                <div class="form-group col-md-5">
                    <label for="marketF5SuperficiePercent">Superficie tratada %</label>
                    <input type="text" class="form-control" id="marketF5SuperficiePercent" placeholder="0">
                </div>
                <div class="col-md-2" style="font-size: 40px;text-align: center;">=</div>
                <div class="form-group col-md-5">
                    <label for="marketF5SuperficieVal">Superficie tratada HA</label>
                    <input type="text" class="form-control" id="marketF5SuperficieVal" placeholder="0">
                </div>
            </div>
            
            <div class="form-group col-md-12">
                <label for="marketF5GastoTotal">Gasto total de agro por HA</label>
                <input type="text" class="form-control" id="marketF5GastoTotal" placeholder="$0">
            </div>
            <div class="form-group col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <label for="marketF5Inc">Gasto en % por sector</label>
                    </div>
    
                    <div class="col-md-3">
                        <input id="m5IncPercent" type="text" class="form-control" placeholder="Inc..." style="border-color: red">
                    </div>
                    <div class="col-md-3">
                        <input id="m5HerPercent" type="text" class="form-control" placeholder="Her..." style="border-color: green">
                    </div>
                    <div class="col-md-3">
                        <input id="m5FunPercent" type="text" class="form-control" placeholder="Fun.." style="border-color: purple">
                    </div>
                    <div class="col-md-3">
                        <input id="m5OtrPercent" type="text" class="form-control" placeholder="Otr..." style="border-color: orange">
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <ul class="list-group">
            <li class="list-group-item list-group-item-danger" style="font-size: 24px; color: white;background-color: red;display: flex;justify-content: space-between;">Insecticida: <span id="insecticidaValue">$0</span></li>
            <li class="list-group-item list-group-item-success" style="font-size: 24px; color: white;background-color: green;display: flex;justify-content: space-between;">Herbicida: <span id="herbicidaValue">$0</span></li>
            <li class="list-group-item list-group-item-warning" style="font-size: 24px; color: white; background-color: purple;display: flex;justify-content: space-between;">Fungicida: <span id="fungicidaValue">$0</span></li>
            <li class="list-group-item list-group-item-warning" style="font-size: 24px; color: white;background-color: orange;display: flex;justify-content: space-between;">Otros: <span id="otrosValue">$0</span></li>
            <li class="list-group-item list-group-item-info" style="font-size: 24px; color: white;background-color: darkblue;display: flex;justify-content: space-between;">Total: <span id="totalValue">$0</span></li>
        </ul> --}}

        {{-- <div style="text-align: right" class="hidden" id="save-advanced-market">
            <button class="btn btn-primary" style="font-size: 16px" id="save-advanced-market-button">Guardar valores</button>
        </div> 
    </div> --}}


    <div class="modal fade" tabindex="-1" role="dialog" id="modalMarketPie">
        <div class="modal-dialog" role="document" style="width: 95%">
          <div class="modal-content">
                <button type="button" style="position: absolute;top: 15px;right: 15px;z-index: 1500;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-body">
            
                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#firstMarket" aria-controls="firstMarket" role="tab" data-toggle="tab" class="tabs-modal-farmMarket">Porcentaje de Hectáreas (Ha)</a></li>
                      <li role="presentation"><a href="#secondMarket" aria-controls="secondMarket" role="tab" data-toggle="tab" class="tabs-modal-farmMarket">Cantidad de Hectáreas (Ha) por cultivo</a></li>
                      <li role="presentation"><a href="#thirdMarket" aria-controls="thirdMarket" role="tab" data-toggle="tab" class="tabs-modal-farmMarket"> Análisis de Superficie por Cultivo vs Siembra del Cultivo a nivel Nacional</a></li>
                      <li role="presentation"><a href="#fourthMarket" aria-controls="fourthMarket" role="tab" data-toggle="tab" class="tabs-modal-farmMarket">Análisis de superficie seleccionada vs superficie sembrada por Estado</a></li>
                    </ul>
                  
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="spinner" id="spinnerModal">
                            <i class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i>
                        </div>
                      <div role="tabpanel" class="tab-pane active" id="firstMarket">
                            <div class="modalCharttitle">Porcentaje de Hectáreas (Ha)</div>
                          <div style="width: 80%; float: left;" id="modalBodyMarket"></div>
                        </div>
                      <div role="tabpanel" class="tab-pane" id="secondMarket">
                            <div class="modalCharttitle">Cantidad de Hectáreas (Ha) por cultivo</div>
                          <div id="modalBodyTree"></div>
                        </div>
                      <div role="tabpanel" class="tab-pane" id="thirdMarket">
                            <div class="modalCharttitle">Análisis de Superficie por Cultivo vs Siembra del Cultivo a nivel Nacional</div>
                            <div id="modalBodyPyramid"></div>
                        </div>
                      <div role="tabpanel" class="tab-pane" id="fourthMarket">
                        <div class="modalCharttitle">Análisis de superficie seleccionada vs superficie sembrada por Estado</div>
                          <div id="modalBodyForcedTree"></div>
                        </div>
                    </div>
                  
                  </div>


            
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" tabindex="-1" role="dialog" id="modalMarketshare">
        <div class="modal-dialog" role="document" style="width: 95%">
          <div class="modal-content">
            {{-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Analisis de market share</h4>
            </div> --}}
            <div class="modal-body bodyMarketShare">  
                <div id="marketSharePreChart"></div>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" tabindex="-1" role="dialog" id="modalMarketFunnel">
        <div class="modal-dialog" role="document" style="width: 95%">
          <div class="modal-content">
            {{-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Analisis de market share</h4>
            </div> --}}
            <div id="titleMarketShare"></div>

            <div class="modal-body bodyMarketShare" style="display: flex">  
                <div id="marketFunnelPreChart" style="width: 50%"></div>
                <div id="marketTree4PreChart" style="width: 50%"></div>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" tabindex="-1" role="dialog" id="modalBaseMarket">
        <div class="modal-dialog" role="document" style="width: 95%">
          <div class="modal-content">
            {{-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Analisis de market share</h4>
            </div> --}}
            <div class="modal-body" id="bodyBaseMarket">
                <div class="col-md-12">
                    <div style="font-size: 40px; font-weight: bold; text-align: center">Resumen por cultivo</div>
                    <div class="modalDownload"><i class="fa fa-download fa-2x" aria-hidden="true"></i></div>
                </div>
                <div class="spinner" id="spinnerModalBase">
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i>
                </div>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" tabindex="-1" role="dialog" id="modalBaseMarketConfig">
        <div class="modal-dialog" role="document" style="width: 95%">
          <div class="modal-content">
            {{-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Analisis de market share</h4>
            </div> --}}
            <div class="modal-body" id="bodyBaseMarketConfig">
                <div class="col-md-12">
                    <div style="font-size: 40px; font-weight: bold; text-align: center">Resumen por cultivo</div>
                    <div class="modalDownload"><i class="fa fa-download fa-2x" aria-hidden="true"></i></div>
                </div>
                
                <div class="spinner" id="spinnerModalBaseConfig">
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i>
                </div>

                <div id="bodyBaseMarketInnerConfig">

                </div>
                
                <div class="row hidden col-md-2" id="marketAdvanced" style="margin-top: 7vh; padding: 0px">
                    <div class="col-md-12" style="font-size: 15px; font-weight: bold">Cultivos</div>
                    <div id="modalBaseFarms" class="col-md-12" style="cursor: pointer;">
                    </div>
                    <div class="col-md-12" style="border-color: gray; height: 1px; background-color: gray; width: 100%; margin-top: 20px; margin-bottom: 20px"></div>
                    <div>
                        <div class="form-group col-md-12">
                            <label>Superficie sembrada</label>
                            <input type="text" class="form-control" disabled="disabled" placeholder="0" id="marketF5SuperficieSembrada" valueNum="0">
                        </div>
                        {{-- <div class="row" style="padding-left: 15px;padding-right: 15px;display: flex;align-items: center;"> --}}
                            <div class="form-group col-md-12">
                                <label for="marketF5SuperficiePercent">Superficie tratada %</label>
                                <input type="text" class="form-control" id="marketF5SuperficiePercent" placeholder="0">
                            </div>
                            {{-- <div class="col-md-12" style="font-size: 40px;text-align: center;">=</div> --}}
                            <div class="form-group col-md-12">
                                <label for="marketF5SuperficieVal">Superficie tratada HA</label>
                                <input type="text" class="form-control" id="marketF5SuperficieVal" placeholder="0">
                            </div>
                        {{-- </div> --}}
                        
                        <div class="form-group col-md-12">
                            <label for="marketF5GastoTotal">Gasto total de agro por HA</label>
                            <input type="text" class="form-control" id="marketF5GastoTotal" placeholder="$0">
                        </div>
                        <div class="form-group col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="marketF5Inc">Gasto en % por sector</label>
                                </div>
                
                                <div class="col-md-12">
                                    <input id="m5IncPercent" type="text" class="form-control" placeholder="Insecticida" style="border-color: red; margin-bottom: 5px">
                                </div>
                                <div class="col-md-12">
                                    <input id="m5HerPercent" type="text" class="form-control" placeholder="Herbicida" style="border-color: green; margin-bottom: 5px">
                                </div>
                                <div class="col-md-12">
                                    <input id="m5FunPercent" type="text" class="form-control" placeholder="Fungicida" style="border-color: purple; margin-bottom: 5px">
                                </div>
                                <div class="col-md-12">
                                    <input id="m5OtrPercent" type="text" class="form-control" placeholder="Otros" style="border-color: orange; margin-bottom: 5px">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="text-align: center;">
                            <button class="btn btn-primary" style="font-size: 15px">Salvar</button>
                        </div>
                    </div>
                </div>
                
                
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <div id="chartdiv"></div>
    <div id="legend"></div>
</div>
@endcan
@stop

