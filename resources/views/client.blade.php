
@extends('layouts.app')


@section('sidebar')
<div class="sidebar">
    <a   href="{{route('home')}}">Home</a>
    <a   href="{{route('company')}}">Registrar Compañía</a>
    <a   href="{{route('viewCompany')}}">Ver Compañías</a>

    <a class="active"   href="{{route('client')}}">Registrar Cliente</a>
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
	<form action="POST" name="registerClient" id="registerClient">
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
							<label for="nit_download">*Nit/Cédula de la persona encargada de descargar documentos (sin el DV)</label>
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
							<button type="button" class="btn btn-primary" id="register_client" name="register_client">Registrar Cliente</button>
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

	function resetform() {
     $("form select").each(function() { this.selectedIndex = 0 });
     $("form input[type=text],form input[type=number] , form textarea").each(function() { this.value = '' });
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

	$(document).ready(function() {
		$.ajaxSetup({
			headers: {'X-CSRF-Token': $('#_token').val()}
		});
         //Get Tipo de documento de identificacion
         getDataForSelectBoxes("#document_id",'{{route("getTypeDocuments")}}');
		//Get Tipo de organizaciones
		getDataForSelectBoxes("#organization_id",'{{route("getTypeOrganizations")}}');
		//Get tipo de obligaciones
		getDataForSelectBoxes("#liability_id",'{{route("getTypeliabilities")}}');
        //Get tipo de impuestos
        getDataForSelectBoxes("#tax_id",'{{route("getTaxId")}}');
        //Get municipios
        getDataForSelectBoxes("#municipio_id",'{{route("getMunicipalities")}}');
		//Get tipo de régimen
		getDataForSelectBoxes("#regime_id",'{{route("getTypeRegimes")}}');

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


		$("#register_client").bind( "click", function() {
			
			if($("#organization_id").val()=='1'){
				var personas = [{"container": "#nit"},{"container": "#dv"},{"container": "#document_id"},{"container": "#organization_id"},{"container": "#regime_id"},{"container": "#liability_id"},{"container": "#municipio_id"},{"container":"#companyname"},{"container":"#address"},{"container":"#phone"},{"container":"#email"},{"container":"#contact_name"},{"container":"#contact_email"},{"container":"#contact_phone"},{"container":"#tax_id"},{"container":"#nit_download"},{"container":"#dv_download"},{"container":"zip_code"}]

			}
			else
			{
				var personas = [{"container": "#nit"},{"container": "#dv"},{"container": "#document_id"},{"container": "#organization_id"},{"container": "#regime_id"},{"container": "#liability_id"},{"container": "#municipio_id"},{"container": "#apellido1"},{"container": "#nombre1"},{"container":"#address"},{"container":"#phone"},{"container":"#email"},{"container":"#contact_name"},{"container":"#contact_email"},{"container":"#contact_phone"},{"container":"#tax_id"},{"container":"#nit_download"},{"container":"#dv_download"},{"container":"zip_code"}]
			}
			if(confirm("Desea registrar este cliente en el sistema?")){
				if(validateFieldsToSend(personas)){
					var nit = $("#nit").val();dv =$("#dv").val();document_id=$("#document_id").val(); 
					organization_id= $("#organization_id").val();regime_id=$("#regime_id").val();liability_id=$("#liability_id").val();
					municipio_id=$("#municipio_id").val();companyname=$("#companyname").val();apellido1=$("#apellido1").val();apellido2=$("#apellido2").val();
					nombre1=$("#nombre1").val();nombre2=$("#nombre2").val();merchant_name=$("#merchant_name").val();
					address=$("#address").val();phone=$("#phone").val();email=$("#email").val();fax=$("#fax").val();observaciones=$("#observaciones").val();
					contact_name=$("#contact_name").val();contact_email=$("#contact_email").val();contact_phone=$("#contact_phone").val();
					tax_id=$("#tax_id").val();nit_download=$("#nit_download").val();dv_download=$("#dv_download").val();
					pagina_web=$("#pagina_web").val();zip_code=$("#zip_code").val(); //fax,observaciones

					$.ajax({
						type: "post",
						url: "/registerClient",
						data: {
							nit: nit,dv:dv,document_id:document_id,organization_id:organization_id,regime_id:regime_id,liability_id:liability_id,
							municipio_id:municipio_id,companyname:companyname,apellido1:apellido1,apellido2:apellido2,nombre1:nombre1,nombre2:nombre2,merchant_name:merchant_name,address:address,phone:phone,email:email,fax:fax,observaciones:observaciones,contact_name:contact_name,contact_email:contact_email,contact_phone:contact_phone,tax_id:tax_id,nit_download:nit_download,dv_download:dv_download,pagina_web:pagina_web,
							zipcode:zip_code

						},
						beforeSend: function()
						{
						        // setting a timeout
						        $("#register_client").prop('disabled', true);
						        $("#register_client").text('Enviando Datos...');
						    },
						    success: function (msg) {
						    	
						    	alert(msg[0].message);
						    	$("#register_client").prop('disabled', false);
						    	$("#register_client").text('Registrar Cliente');
						    	resetform();
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

