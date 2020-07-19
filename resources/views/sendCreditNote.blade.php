
@extends('layouts.app')


@section('sidebar')
<div class="sidebar">
    <a   href="{{route('home')}}">Home</a>
    <a   href="{{route('company')}}">Registrar Compañía</a>
    <a   href="{{route('viewCompany')}}">Ver Compañías</a>

    <a    href="{{route('client')}}">Registrar Cliente</a>
    <a    href="{{route('viewClient')}}">Ver Clientes</a>
    <a  href="{{route('sendInvoice')}}">Enviar Factura</a>
    <a   href="{{route('sendDebitNote')}}">Enviar Nota Débito </a>
    <a class="active"  href="{{route('sendCreditNote')}}">Enviar Nota Crédito</a>
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
    <form action="POST" name="sendInvoice" id="sendInvoice" enctype="multipart/form-data">

        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"></input>
        <div class="alert" id="message" style="display: none"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Envío de Nota Crédito</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form action="POST" name="sendInvoice" id="sendInvoice" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">  <div class="form-group">
                                    <label for="document_id">*seleccione Cliente</label>
                                    <select class="form-control" id="client_id" name="client_id">
                                        <option selected="selected" value="">Escoja Opción</option>

                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="select_file">*Encabezado de la Nota Crédito</label>
                                    <input type="file" class="form-control" id="select_file" name="select_file">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="send_invoice" name="send_invoice">Enviar Encabezado</button>
                                </div>
                            </div>

                        </div>
                    </form>

                    <form action="POST" name="sendInvoiceDetail" id="sendInvoiceDetail" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="select_file">*Detalle de la Nota Crédito</label>
                                    <input type="file" class="form-control" id="select_file" name="select_file">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="send_invoice_detail" name="send_invoice_detail" disabled="true">Enviar Detalle</button>
                                    <button type="button" class="btn btn-success" id="send_invoice_group" name="send_invoice_group" disabled="true">Enviar Lode de Notas Crédito</button>
                                </div>
                            </div>

                        </div>
                    </form> 

                </div>
            </div>
        </div>
    </div>

    <span id="uploaded_text">  </span>   
</div>    
<script type="text/javascript">
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
   //Función que sube los archivos planos al servidor
   function sendFormInvoice(formId,path,textoBoton,buttonAction,buttonToActivate){
    $(formId).on('submit',function(event){
        event.preventDefault();
        $.ajax({
            url:path,
            method:"POST",
            data:new FormData(this),
            dataType:"JSON",
            contentType:false,
            cache:false,
            processData:false,
            beforeSend: function()
            {
                            // setting a timeout
                            $("#message").removeClass('alert-success');                            
                            $("#message").css('display','none');
                            $(buttonAction).prop('disabled', true);
                            $(buttonAction).html('Enviando información...');
                        },
                        success: function (data) {
                          $("#message").css('display','block');
                          $("#message").html(data.message);
                          $("#message").removeClass('alert-danger');
                          $("#message").addClass(data.class_name);
                          $(buttonAction).prop('disabled', false);
                          $(buttonAction).html(textoBoton);
                          if(data.class_name!='alert-danger'){
                            $(buttonToActivate).prop('disabled',false);
                        }

                     }

                 })
    })

}


$(document).ready(function() {
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('#_token').val()}
    });

         //Get Clientes
         getDataForSelectBoxes("#client_id",'{{route("getClients")}}');
        //Envío del formulariosend_invoice

        sendFormInvoice("#sendInvoice","/uploadFiles/headerCreditNote/type/header",'Enviar Encabezado','#send_invoice','#send_invoice_detail');
        sendFormInvoice("#sendInvoiceDetail","/uploadFiles/detailCreditNote/type/detail",'Enviar Detalle',"#send_invoice_detail",'#send_invoice_group');

         $( "#send_invoice_group" ).click(function() {

            if(confirm('Desea procesar el siguiente lote de notas credito?')){

                $("#message").removeClass('alert-success');                            
                $("#message").css('display','none');
                $("#send_invoice_group").prop('disabled',true);
                $("#send_invoice_group").html('Enviando información...');

                token=$('#_token').val();
                client=$("#client_id").val();
                $.ajax({
                        type: 'POST', //THIS NEEDS TO BE GET
                        url: '/sendCreditNotes',
                        data: {
                            client_id: client

                        },

                        success: function (data) {
                            $("#message").css('display','block');
                            $("#message").html(data.message);
                            $("#message").removeClass('alert-danger');
                            $("#message").addClass(data.class_name);
                            $("#send_invoice_group").prop('disabled', false);
                            $("#send_invoice_group").html('Enviar Lote de Notas Crédito');


                            /*alert(data.message);*/
                        },
                        error: function() { 
                            console.log(data);
                        }
                    });
            }
        });
    });
</script>
@endsection

