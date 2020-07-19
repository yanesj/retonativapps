
@extends('layouts.app')


@section('sidebar')
<div class="sidebar">
    <a   href="{{route('home')}}">Home</a>
    <a   href="{{route('company')}}">Registrar Compañía</a>
    <a   href="{{route('viewCompany')}}">Ver Compañías</a>

    <a    href="{{route('client')}}">Registrar Cliente</a>
    <a class="active"   href="{{route('viewClient')}}">Ver Clientes</a>
    <a href="{{route('sendInvoice')}}">Enviar Factura</a>
    <a  href="{{route('sendDebitNote')}}">Enviar Nota Débito </a>
    <a  href="{{route('sendCreditNote')}}">Enviar Nota Crédito</a>
    <a class="dropdown-item" href="{{ route('logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    Salir
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>
</div>
@endsection

@section('content')

<div class="container">
    <div class="row clientList">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Clientes en el sistema</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div id="tag_container">
                       @include('presultClient')
                   </div>
               </div>
           </div>
       </div>
   </div>
   <form action="POST" name="registerClient" id="registerClient" style="display: none">
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"></input>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>Información del cliente</strong></div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nit">*Nit</label>
                                <input type="number" class="form-control" id="nit" name="nit" placeholder="Nit">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dv">*DV</label>
                                <input type="number" class="form-control" id="dv" name="dv" placeholder="DV">
                            </div>
                        </div>
                    </div>
                    <!-- class="form-control" -->
                    <div class="row">
                        <div class="col-md-6">  <div class="form-group">
                            <label for="document_id">*Tipo de documento de identificación</label>
                            <select  id="document_id" name="document_id" class="form-control" >
                                <option selected="selected" value="">Escoja Opción</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="organization_id">*Tipo de organización</label>
                            <select class="form-control" id="organization_id" name="organization_id">
                                <option selected="selected" value="">Escoja Opción</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">  <div class="form-group">
                        <label for="regime_id">*Tipo de Régimen</label>
                        <select class="form-control" id="regime_id" name="regime_id">
                            <option selected="selected" value="">Escoja Opción</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="liability_id">*Tipo de Obligación</label>
                        <select multiple  class="form-control" id="liability_id" name="liability_id">

                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="municipio_id">*Municipio</label>
                        <select class="form-control" id="municipio_id" name="municipio_id">
                            <option selected="selected" value="">Escoja Opción</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="companyname">*Nombre de la compañía</label>
                        <input type="text" class="form-control" id="companyname" name="companyname" readonly="readonly" placeholder="Nombre de la compañía" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="apellido1">*Apellido 1</label>
                        <input type="text" class="form-control" id="apellido1" name="apellido1" readonly="readonly" placeholder="Apellido 1">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="apellido2">Apellido 2</label>
                        <input type="apellido2" class="form-control" id="apellido2" name="apellido2" readonly="readonly" placeholder="Apellido 2">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre1">*Nombre 1</label>
                        <input type="text" class="form-control" id="nombre1" name="nombre1" readonly="readonly" placeholder="Nombre 1">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre2">Nombre 2</label>
                        <input type="nombre2" class="form-control" id="nombre2" name="nombre2" readonly="readonly" placeholder="Nombre 2">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="merchant_name">Registro Mercantíl</label>
                        <input type="text" class="form-control" id="merchant_name" name="merchant_name" placeholder="Registro Mercantíl">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">*Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Dirección">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">*Teléfono</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Teléfono">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">*E-mail</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="E-mail">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fax">Fax</label>
                        <input type="text" class="form-control" id="fax" name="fax" placeholder="Fax">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Observaciones">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                    </div>
                </div>

            </div>

            <!-- !-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_name">*Nombre del Contacto</label>
                        <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Nombre del Contacto">
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_email">*Email del Contacto</label>
                        <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Email del Contacto">
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_phone">*Teléfono del contacto</label>
                        <input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="Teléfono del Contacto">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tax_id">*Tipo de impuesto</label>
                        <select class="form-control" id="tax_id" name="tax_id">
                            <option selected="selected" value="">Escoja Opción</option>
                        </select>
                    </div>
                </div>

            </div>
            <!-- !-->








            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nit_download">*Nit de la persona encargada de descargar documentos (sin el DV)</label>
                        <input type="text" class="form-control" id="nit_download" name="nit_download" placeholder="Nit de la persona encargada de descargar documentos">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dv_download">*Dígito de verificación del encargado</label>
                        <input type="text" class="form-control" id="dv_download" name="dv_download" placeholder="Dígito de verificación del encargado">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pagina_web">Página web de la compañía</label>
                        <input type="text" class="form-control" id="pagina_web" name="pagina_web" placeholder="Página web de la compañía">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="zip_code">*Código Postal</label>
                        <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Código Postal">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="register_client" name="register_client">Actualizar Cliente</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<br>

</form>
</div>



<script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });

    function getDataForSelectBoxes(id_container,path){
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: path,
            success: function (data) {
                $.each(data, function(i,item){
                    $(id_container).append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
                    
                })
            },
            error: function() { 
                console.log(data);
            }
        });
    }
    
    $(document).ready(function()
    {
      $.ajaxSetup({
        headers: {'X-CSRF-Token': $('#_token').val()}
    });

      //Get Tipo de documento de identificacion
/*      getDataForSelectBoxes("#document_id",'/getTypeDocuments');
        //Get Tipo de organizaciones
        getDataForSelectBoxes("#organization_id",'/getTypeOrganizations');
        //Get tipo de obligaciones
        getDataForSelectBoxes("#liability_id",'/getTypeliabilities');
        //Get tipo de impuestos
        getDataForSelectBoxes("#tax_id",'/getTaxId');
        //Get municipios
        getDataForSelectBoxes("#municipio_id",'/getMunicipalities');
        //Get tipo de régimen
        getDataForSelectBoxes("#regime_id",'/getTypeRegimes');*/

            $("#organization_id").change(function() {
            if($("#organization_id").val()=='1'){
                $("#companyname").prop('readonly', false);
                $("#apellido1").prop('readonly', true);
                $("#apellido2").prop('readonly', true);
                $("#nombre1").prop('readonly', true);
                $("#nombre2").prop('readonly', true);
            }
            else
            {
                $("#companyname").prop('readonly', true);
                $("#apellido1").prop('readonly', false);
                $("#apellido2").prop('readonly', false);
                $("#nombre1").prop('readonly', false);
                $("#nombre2").prop('readonly', false);  
            }
            
        });

        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();

            $('li').removeClass('active');
            $(this).parent('li').addClass('active');

            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];

            getData(page);
        });
    });

    function mostrar(id){

        $(".clientList").fadeOut("medium");
        $("#registerClient").fadeIn("medium");
        //
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: "/viewDetailedClient/"+id,
            success: function (data) {
               $("#nit").val(data[0].identification_number);
               $("#dv").val(data[0].verification_digit);
               $("#document_id option[value="+ data[0].identifiaction_type +"]").attr("selected",true);
               $("#organization_id option[value="+ data[0].person_type +"]").attr("selected",true);
               $("#municipio_id option[value="+ data[0].municipality_code +"]").attr("selected",true);
               $("#tax_id option[value="+ data[0].tax_id +"]").attr("selected",true);
               $("#nit_download").val(data[0].downloadable_person_id);
               $("#dv_download").val(data[0].verification_digit_downloadable_person);
               $("#contact_email").val(data[0].contact_email);
               $("#pagina_web").val(data[0].business_url);
               $("#zip_code").val(data[0].zipcode);
                $.each(data[0]['liability'], function(i,item){
                    $("#liability_id option[value="+data[0]['liability'][i].liability_id+"]").attr("selected",true);
                });
               $("#regime_id option[value="+ data[0].regime +"]").attr("selected",true);
               $("#address").val(data[0].address);
               $("#phone").val(data[0].phone);
               $("#email").val(data[0].email);
               $("#fax").val(data[0].fax_phone);
               $("#observaciones").val(data[0].contact_observations);
               $("#contact_phone").val(data[0].contact_phone);
               $("#contact_name").val(data[0].contact_name);
               if(data[0].regime=='2'){
                 $("#apellido1").val(data[0].lastname1);
                 $("#apellido2").val(data[0].lastname2);
                 $("#nombre1").val(data[0].name1);
                 $("#nombre2").val(data[0].name2);
             }
             else
             {
                $("#companyname").val(data[0].business_name);
            }
               //
           },
           error: function() { 
            console.log(data);
        }
    });
    }

    function getData(page){
        $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#tag_container").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
          alert('No response from server');
      });
    }
</script>
@endsection

