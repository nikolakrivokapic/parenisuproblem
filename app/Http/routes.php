<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Event::listen('illuminate.query', function($sql, $bindings)
{
    foreach ($bindings as $val) {
        $sql = preg_replace('/\?/', "'{$val}'", $sql, 1);
    }
    Log::info($sql);
}); 


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});




Route::group(['middleware' => ['web']], function () {

Route::get('/prednosti', function()
{
      return View::make('pages.prednosti');

});
Route::get('/ideje', function()
{
      return View::make('pages.ideje');

});
Route::get('/kakofunkcionisemo', function()
{
      return View::make('pages.kakofunkcionisemo');

});
Route::get('/blog', function()
{
      return View::make('pages.blog');

});

Route::get('/pretraga', function()
{
      return View::make('pages.pretraga');

});

Route::get('/faq', function()
{
      return View::make('faq.index');

});
Route::get('/pravila-upotrebe', function()
{
      return View::make('pages.pravila-upotrebe');

});
Route::get('/da-li-ovaj-servis-kosta', function() {  return View::make('faq.dalikosta'); });
Route::get('/kako-vam-mozemo-pomoci', function() {  return View::make('faq.kakomozemopomoci'); });
Route::get('/kako-funkcionisemo', function() {  return View::make('faq.kakofunkcionisemo'); });
Route::get('/kako-sakupiti-sredstva', function() {  return View::make('faq.kakodasakupite'); });
Route::get('/kako-voditi-kampanju', function() {  return View::make('faq.uspjesnovodjenje'); });
Route::get('/o-nama', function() {  return View::make('pages.onama'); });

Route::get('auth/social/{category}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/callback/{category}', 'Auth\AuthController@handleProviderCallback');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@logovanje');

Route::get('/', 'MainController@index');


Route::get('{slug}', 'MainController@show');
Route::get('/kampanje/nova', 'MainController@nova');
Route::get('/kategorija/{kategorija}', 'MainController@kategorija');
Route::get('/lokacija/{lokacija}', 'MainController@lokacija');
Route::get('/izdvojene/{oznaka}', 'MainController@oznaka');


Route::post('users/loggedin', function()
{
      return View::make('users.home');

});



Route::post('/podrzi', 'KampanjaController@podrzi');
Route::post('/objavi', 'KampanjaController@objavi');
Route::post('/pauziraj', 'KampanjaController@pauziraj');
Route::post('/opcije', 'KampanjaController@opcije');
Route::post('/izbrisitag', 'KampanjaController@izbrisitag');   
Route::post('/pretplati', 'EmailController@pretplati');
Route::post('/kampanja/pokreni', 'KampanjaController@pokreni');
Route::get('/dash/{slug}', 'KampanjaController@dash');
Route::get('/page-view/{slug}', 'KampanjaController@pageview');
Route::get('/page-edit/{slug}', 'KampanjaController@pageedit');
Route::get('/stranica/getlokacija', 'KampanjaController@getlokacija');
Route::get('/stranica/getpocetna', 'KampanjaController@getpocetna');
Route::get('/stranica/getnovosti', 'KampanjaController@getnovosti');
Route::get('/stranica/getkomentari', 'KampanjaController@getkomentari');
Route::get('/stranica/getpodrzali', 'KampanjaController@getpodrzali');
Route::post('/podrska/jospodrzalih', 'PodrskaController@jospodrzalih'); 

Route::post('/page-snimi/{slug}', 'KampanjaController@pagesnimi');
Route::post('/updateizmenasnimi', 'KampanjaController@updateizmenasnimi');
Route::post('/updatedelete', 'KampanjaController@updatedelete');
Route::post('/update/{slug}', 'KampanjaController@update');
Route::post('/kampanja/brisanje', 'KampanjaController@kampanjabrisanje');

Route::get('/podesavanja/{slug}', 'KampanjaController@podesavanja');
Route::get('/sredstva/{slug}', 'KampanjaController@sredstva');
Route::post('uplate/snimi', 'KampanjaController@uplatesnimi');

Route::get('users/nova', 'MainController@nova');
Route::get('users/podesavanja', 'UserController@podesavanja');
Route::post('users/snimi/{id}', 'UserController@snimi');
Route::post('users/slika/{id}', 'UserController@slika');
Route::get('users/{id}', 'UserController@profil');
Route::get('users/poruke/{id}', 'UserController@poruke');
Route::get('users/poruke/{id}/{fullname}', 'UserController@poruke1');
Route::get('users/loadmore/poruke', 'UserController@loadmore');
Route::post('users/odgovor/poruke', 'UserController@odgovor');
Route::get('users/check/poruke', 'UserController@check');
Route::get('users/loadnew/poruke', 'UserController@loadnew');

Route::post('komentar/novi/{slug}', 'KomentariController@unesi');
Route::post('komentar_objava/novi/{id}', 'KomentariController@naobjavu');
Route::post('komentari/joskomentara', 'KomentariController@joskomentara');
Route::post('brisanje/komentara', 'KomentariController@brisanjekomentara');

Route::post('poruke/slanje', 'PorukeController@slanje');
Route::post('sesija/test', 'KomentariController@sesijatest');
Route::get('/auth/logout',function(){
    //TODO check if session id match with the session id parameter
    Auth::logout();
  return Redirect::to('/');
});

Route::get('auth/reminder', 'Auth\AuthController@reminder');
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@registracija');


});




