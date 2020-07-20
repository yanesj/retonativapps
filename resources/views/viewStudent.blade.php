
@extends('layouts.app')


@section('sidebar')
<div class="sidebar">
    <a   href="{{route('home')}}">Home</a>
    <a   href="{{route('estudiante')}}">Crear Estudiantes</a>
    <a class="active"   href="{{route('viewStudent')}}">Ver Estudiantes</a>
    <a   href="{{route('curso')}}">Crear Cursos</a>
    <a   href="{{route('viewCourses')}}">Ver Cursos</a>
    <a   href="{{route('asigCurso')}}">Asignar Cursos</a>
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
                <div class="card-header">Lista de Estudiantes en el sistema</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div id="tag_container">
                     @include('presultStudents')
                 </div>
             </div>
         </div>
     </div>
 </div>
 <form action="POST" name="updateClient" id="updateClient" style="display: none">
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"></input>
    <input type="hidden" name="hidden2" id="hidden2" ></input>
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
                                <label for="nombre">*Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido">*Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edad">*Edad</label>
                                <input type="number" class="form-control" id="edad" name="edad" placeholder="Edad">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">*Correo Electrónico</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Correo Electrónico">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="update_student" name="update_student">Actualizar Estudiante</button>
                                <button type="button" class="btn btn-primary" id="close_panel" name="close_panel">Cerrar Panel</button>
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

    function viewStudent(){
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: '/viewStudent',
            success: function (data) {
                console.log(data);
            },
            error: function() { 
                console.log(data);
            }
        });
    }



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

    function validateFieldsToSend(objects){
        var item,response=true;
        objects.forEach(function(object, index) {

            if($(object.container).val()==''){
                response= false;
            }
        });
        return response;
    }

    function resetform() {
        $("form select").each(function() { this.selectedIndex = 0 });
        $("form input[type=text] , form textarea, form input[type=number]").each(function() { this.value = '' });
    }

    function mostrar(id){

        $(".clientList").fadeOut("medium");
        $("#updateClient").fadeIn("medium");
            //
            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: "/viewDetailedStudent/"+id,
                success: function (data) {
                 $("#hidden2").val(data[0].id);
                 $("#nombre").val(data[0].nombre);
                 $("#apellido").val(data[0].apellido);
                 $("#edad").val(data[0].edad);
                 $("#email").val(data[0].email);

             },
             error: function() { 
                console.log(data);
            }
        });
        }

        function eliminar(id){

            if(confirm('¿Desea Eliminar este estudiante del sistema?')){
                $.ajax({
                    type: 'delete', //THIS NEEDS TO BE GET
                    url: "/deleteEstudiante/"+id,
                    success: function (data) {
                     alert(data.message);
                     location.reload();

                 },
                 error: function() { 
                    console.log(data);
                }
            });
            }        
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

        $(document).ready(function()
        {
          $.ajaxSetup({
            headers: {'X-CSRF-Token': $('#_token').val()}
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
          $("#update_student").bind( "click", function() {

            var estudiantes = [{"container": "#nombre"},{"container": "#apellido"},{"container": "#edad"},{"container": "#email"}];

            if(confirm("¿Desea actualizar este estudiante en el sistema?")){
                if(validateFieldsToSend(estudiantes)){
                    var nombre = $("#nombre").val();apellido=$("#apellido").val();edad=$("#edad").val();email= $("#email").val();hidden=$("#hidden2").val();
                    $.ajax({
                        type: "put",
                        url: "/actualizarEstudiante",
                        data: {
                            nombre:nombre,apellido:apellido,edad:edad,email:email,id:hidden
                        },
                        beforeSend: function()
                        {
                                // setting a timeout
                                $("#register_student").prop('disabled', true);
                                $("#register_student").text('Enviando Datos...');
                            },
                            success: function (msg) {

                                alert(msg.message);
                                $("#register_student").prop('disabled', false);
                                $("#register_student").text('Registrar Estudiante');
                                resetform();
                            }
                        });


                }
                else{
                    alert('Los campos marcados con * son obligatorios.');
                }
            }
        });


          $("#close_panel").bind( "click", function() {
            $(".clientList").fadeIn("medium");
              $("#updateClient").fadeOut("medium");

          });


      });


  </script>
  @endsection

