<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', function () {
	return view('auth.login');
});

Route::group(['middleware' => 'auth'], function() {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/company','CompanyController@index')->name('company');
	Route::get('/client','ClientController@index')->name('client');
	Route::get('/sendInvoice','InvoiceController@index')->name('sendInvoice');
	Route::get('/sendDebitNote','InvoiceController@debitNoteIndex')->name('sendDebitNote');
	Route::get('/sendCreditNote','InvoiceController@creditNoteIndex')->name('sendCreditNote');
	Route::get('/viewCompany','viewCompanyController@viewCompany')->name('viewCompany');
	Route::get('/viewClient','viewClientController@viewClient')->name('viewClient');
	Route::post('/registerClient','ClientController@registerClient')->name('registerClient');
	Route::get('/getClients','ClientController@getClients')->name('getClients');
	Route::post('/uploadFiles/{filename}/type/{type}','InvoiceController@uploadFiles')->name('uploadFiles/{filename}/type{type}');
	Route::post('/sendInvoices','InvoiceController@sendInvoices')->name('sendInvoices');
	Route::post('/sendCreditNotes','CreditNoteController@sendCreditNotes')->name('sendCreditNotes');
	Route::post('/sendDebitNotes','DebitNoteController@sendDebitNotes')->name('sendDebitNotes ');
	Route::get('/viewDetailedClient/{id}','ViewClientController@viewDetailedClient')->name('viewDetailedClient');

	//nuevas
	Route::get('/estudiante','EstudianteController@index')->name('estudiante');
	Route::get('/getEstudiante','EstudianteController@getEstudiante')->name('getEstudiante');
	Route::post('/registrarEstudiante','EstudianteController@registrarEstudiante')->name('registrarEstudiante');
	Route::get('/curso','CursoController@index')->name('curso');
	Route::get('/getHorarios','HorarioController@getHorarios')->name('getHorarios');
	Route::post('/registrarCurso','CursoController@registrarCurso')->name('registrarCurso');
	Route::get('/asigCurso','AsigCursoController@index')->name('asigCurso');
	Route::get('/getCursos','AsigCursoController@getCursos')->name('getCursos');
	Route::post('/asigCursoEstudiante','AsigCursoController@asigCursoEstudiante')->name('asigCursoEstudiante');




});



Route::get('/getTypeDocuments','TypeDocumentIdentificationController@getTypeDocuments')->name('getTypeDocuments');
Route::get('/getTypeOrganizations','TypeOrganizationsController@getTypeOrganizations')->name('getTypeOrganizations');
Route::get('/getTypeRegimes','TypeRegimesController@getTypeRegimes')->name('getTypeRegimes');
Route::get('/getTypeliabilities','TypeLiabilitiesController@getTypeliabilities')->name('getTypeliabilities');
Route::get('/getMunicipalities','MunicipalitiesController@getMunicipalities')->name('getMunicipalities');
Route::post('/registerCompany','CompanyController@registerCompany')->name('registerCompany');
Route::post('/updateUser','UserController@updateUser')->name('updateUser');
Route::post('/registerSoftware','CompanyController@registerSoftware')->name('registerSoftware');
Route::post('/uploadCertificate','CompanyController@uploadCertificate')->name('uploadCertificate');
Route::get('/getTypeDocumentToSend','TypeDocumentController@getTypeDocumentToSend')->name('getTypeDocumentToSend');
Route::post('/uploadResolution','CompanyController@uploadResolution')->name('uploadResolution');
Route::get('/getTaxId','TaxIdController@getTaxId')->name('getTaxId');
Route::get('/getInvoiceNumber','InvoiceController@getInvoiceNumber')->name('getInvoiceNumber');
Route::get('/exportToPDF','InvoiceController@exportToPDF')->name('exportToPDF');
Route::get('/sendEmail', 'MailController@sendEmail')->name('sendEmail');

