
@extends('layouts.app')


@section('sidebar')
<div class="sidebar">
    <a   href="{{route('home')}}">Home</a>
    <a class="active"   href="{{route('company')}}">Registrar Compañía</a>
    <a   href="{{route('viewCompany')}}">Ver Compañías</a>

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
	<form action="POST" name="regCompany" id="regCompany">
		<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"></input>
		<input type="hidden" name="token2" id="token2">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header"><strong>Información de la compañía</strong></div>

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

						<div class="row">
							<div class="col-md-6">  <div class="form-group">
								<label for="document_id">*Tipo de documento de identificación</label>
								<select class="form-control" id="document_id" name="document_id">
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
							<input type="text" class="form-control" id="companyname" name="companyname" placeholder="Nombre de la compañía">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="merchant_name">*Registro Mercantíl</label>
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
							<input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button type="button" class="btn btn-primary" id="register_company" name="register_company">Registrar Compañía</button>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header"><strong>Software</strong></div>

			<div class="card-body">
				@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
				@endif

				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="id_software">*Id Set de Pruebas</label>
							<input type="text" class="form-control" id="id_set_pruebas" name="id_set_pruebas" placeholder="Id Set Pruebas">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="id_software">*Id Software</label>
							<input type="text" class="form-control" id="id_software" name="id_software" placeholder="Id Software">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="pin">*Pin</label>
							<input type="text" class="form-control" id="pin" name="pin" placeholder="pin">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button type="button" class="btn btn-primary" id="register_software" name="register_software">Registrar Software</button>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header"><strong>Certificado</strong></div>

			<div class="card-body">
				@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
				@endif

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="digitalCertificate">Certificado Digital (Base 64)</label>
							<textarea class="form-control" id="digitalCertificate" name="digitalCertificate" rows="3"></textarea>
						</div>
					</div>

				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button type="button" class="btn btn-primary" id="upload_certificate" name="upload_certificate">Cargar Certificado</button>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header"><strong>Resolución</strong></div>

			<div class="card-body">
				@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
				@endif

				<div class="row">
					<div class="col-md-6">  <div class="form-group">
						<label for="document_to_send">Tipo de documento a expedir</label>
						<select class="form-control" id="document_to_send" name="document_to_send">
							<option selected="selected">Escoja Opción</option>

						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="prefix">Prefijo</label>
						<input type="text" class="form-control" id="prefix" name="prefix" placeholder="Prefijo">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="resolution">Resolución</label>
						<input type="text" class="form-control" id="resolution" name="resolution" placeholder="Resolución">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="resolution_date">Fecha de Resolución</label>
						<input type="date" class="form-control datepicker" id="resolution_date" name="resolution_date" placeholder="Resolución">
					</div>
				</div>

			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="technicalkey">Llave Técnica</label>
						<input type="text" class="form-control" id="technicalkey" name="technicalkey" placeholder="Llave Técnica">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="techkeyfrom">Desde</label>
						<input type="number" class="form-control" id="techkeyfrom" name="techkeyfrom" placeholder="Desde">
					</div>
				</div>

			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="techkeyto">Hasta</label>
						<input type="number" class="form-control" id="techkeyto" name="techkeyto" placeholder="Hasta">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="generatedtodate">Generado en</label>
						<input type="text" class="form-control" id="generatedtodate" name="generatedtodate" placeholder="0" value="0" readonly="0">
					</div>
				</div>

			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="resolutionfrom">Resolución Desde</label>
						<input type="date" class="form-control" id="resolutionfrom" name="resolutionfrom" placeholder="Desde">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="resolutionto">Resolución  Hasta</label>
						<input type="date" class="form-control" id="resolutionto" name="resolutionto" placeholder="Hasta">
					</div>
				</div>

			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<button type="button" class="btn btn-primary" id="upload_resolution" name="upload_resolution">Cargar Resolución</button>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
</div>

</form>
</div>
<br/>
<script>
	function validateFieldsToSend(objects){
		var item,response=true;
		objects.forEach(function(object, index) {
			
			if($(object.container).val()==''){
				response= false;
			}
		});
		return response;
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
	//municipio_id
	$(document).ready(function() {
		$.ajaxSetup({
			headers: {'X-CSRF-Token': $('#_token').val()}
		});
		//Get Tipo de documento de identificacion
		getDataForSelectBoxes("#document_id",'{{route("getTypeDocuments")}}');
		//Get Tipo de organizaciones
		getDataForSelectBoxes("#organization_id",'{{route("getTypeOrganizations")}}');
		//Get tipo de régimen
		getDataForSelectBoxes("#regime_id",'{{route("getTypeRegimes")}}');
		//Get tipo de obligaciones
		getDataForSelectBoxes("#liability_id",'{{route("getTypeliabilities")}}');
		//Get municipios
		getDataForSelectBoxes("#municipio_id",'{{route("getMunicipalities")}}');
		//Get Tipos de documento a enviar, facturas de venta, notas débito, etc
		getDataForSelectBoxes("#document_to_send",'{{route("getTypeDocumentToSend")}}');

		$("#register_company").bind( "click", function() {
			
			var personas = [{"container": "#nit"},{"container": "#dv"},{"container": "#document_id"},{"container": "#organization_id"},{"container": "#regime_id"},{"container": "#liability_id"},{"container": "#municipio_id"},{"container": "#companyname"},{"container": "#merchant_name"},{"container": "#address"},{"container": "#phone"},{"container": "#email"}];
			
			if(confirm("Desea registrar esta empresa en el sistema?")){
				if(validateFieldsToSend(personas)){
					var nit = $("#nit").val();dv =$("#dv").val();document_id=$("#document_id").val(); 
					organization_id= $("#organization_id").val();regime_id=$("#regime_id").val();liability_id=$("#liability_id").val();
					municipio_id=$("#municipio_id").val();companyname=$("#companyname").val();merchant_name=$("#merchant_name").val();
					address=$("#address").val();phone=$("#phone").val();email=$("#email").val();
					

					$.ajax({
						type: "post",
						url: "/registerCompany",
						data: {
							nit: nit,dv:dv,document_id:document_id,organization_id:organization_id,regime_id:regime_id,liability_id:liability_id,
							municipio_id:municipio_id,companyname:companyname,merchant_name:merchant_name,address:address,phone,phone,email

						},
						beforeSend: function()
						{
						        // setting a timeout
						        $("#register_company").prop('disabled', true);
						        $("#register_company").text('Enviando Datos...');
						    },
						    success: function (msg) {
						    	
						    	alert(msg[0].message);
						    	$("#register_company").prop('disabled', false);
						    	$("#register_company").text('Registrar Compañía');
						    }
						});


				}
				else{
					alert('Los campos marcados con * son obligatorios.');
				}
			}
		});

		$("#register_software").bind( "click", function() {
			
			var campos = [{"container": "#id_software"},{"container": "#pin"},{"container":"#id_set_pruebas"}];
			
			if(confirm("Desea registrar este software en el sistema?")){
				if(validateFieldsToSend(campos)){
					var idsoft = $("#id_software").val();pinsoft =$("#pin").val(); proof_test=$("#id_set_pruebas").val();
					$.ajax({
						type: "post",
						url: "/registerSoftware",
						data: {idSoftware:idsoft,pin:pinsoft,proof_test},
						beforeSend: function()
						{
						        // setting a timeout
						        $("#register_software").prop('disabled', true);
						        $("#register_software").text('Enviando Datos...');
						    },
						    success: function (msg) {
						    	
						    	alert(msg[0].message);
						    	$("#register_software").prop('disabled', false);
						    	$("#register_software").text('Registrar Software');
						    }
						});


				}
				else{
					alert('Los campos marcados con * son obligatorios.');
				}
			}
		});

		$("#upload_certificate").bind( "click", function() {
			
			var campos = [{"container": "#digitalCertificate"},{"container": "#password"}];
			
			if(confirm("Desea cargar el certificado en el sistema?")){
				if(validateFieldsToSend(campos)){
					var certificate = $("#digitalCertificate").val();password =$("#password").val();
					$.ajax({
						type: "post",
						url: "/uploadCertificate",
						data: {certificate:certificate,password:password},
						beforeSend: function()
						{
						        // setting a timeout
						        $("#upload_certificate").prop('disabled', true);
						        $("#upload_certificate").text('Enviando Datos...');
						    },
						    success: function (msg) {
						    	
						    	alert(msg[0].message);
						    	$("#upload_certificate").prop('disabled', false);
						    	$("#upload_certificate").text('Cargar Certificado');
						    }
						});


				}
				else{
					alert('Los campos marcados con * son obligatorios.');
				}
			}
		});

		$("#upload_resolution").bind( "click", function() {
			
			var campos = [{"container": "#document_to_send"},{"container": "#prefix"},{"container": "#resolution"},{"container": "#resolution_date"},
			{"container": "#technicalkey"},{"container": "#techkeyfrom"},{"container": "#techkeyto"},{"container": "#generatedtodate"},
			{"container": "#resolutionfrom"},{"container": "#resolutionto"}];
			
			if(confirm("Desea cargar La resolución en el sistema?")){
				if(validateFieldsToSend(campos)){
					var type_document_id = $("#document_to_send").val();prefix =$("#prefix").val();resolution = $("#resolution").val();
					resolution_date =$("#resolution_date").val();technical_key =$("#technicalkey").val();from =$("#techkeyfrom").val();
					to =$("#techkeyto").val();generated_to_date =$("#generatedtodate").val();date_from =$("#resolutionfrom").val();
					date_to =$("#resolutionto").val();



					    //voy por acá, pasándole valor a las variables para consumir la ruta
					    $.ajax({
					    	type: "post",
					    	url: "/uploadResolution",
					    	data: {documentToSend:type_document_id,prefix:prefix,resolution:resolution,resolutionDate:resolution_date,
                                   technicalKey:technical_key,resolutionFrom:from,resolutionTo:to,generatedAt:generated_to_date,
                                   resolutionDateFrom:date_from,resolutionDateTo:date_to 
					    	      },
					    	beforeSend: function()
					    	{
						        // setting a timeout
						        $("#upload_resolution").prop('disabled', true);
						        $("#upload_resolution").text('Enviando Datos...');
						    },
						    success: function (msg) {
						    	
						    	alert(msg[0].message);
						    	$("#upload_resolution").prop('disabled', false);
						    	$("#upload_resolution").text('Cargar Certificado');
						    }
						});


					}
					else{
						alert('Los campos marcados con * son obligatorios.');
					}
				}
			});
	});
</script>
@endsection


