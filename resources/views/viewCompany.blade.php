
@extends('layouts.app')


@section('sidebar')
<div class="sidebar">
    <a   href="{{route('home')}}">Home</a>
    <a   href="{{route('company')}}">Registrar Compañía</a>
    <a  class="active"  href="{{route('viewCompany')}}">Ver Compañías</a>

    <a  href="{{route('client')}}">Registrar Cliente</a>
    <a   href="{{route('viewClient')}}">Ver Clientes</a>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de compañías en el sistema</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div id="tag_container">
                     @include('presult')
                 </div>
             </div>
         </div>
     </div>
 </div>
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
    
    $(document).ready(function()
    {
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

