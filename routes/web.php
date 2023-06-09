<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
/**Aqui estamos criando uma nova rota
 * definimos que o método dela será
 * um get depois temos que colocar 2 parametros
 * o primeiro parametro é a /página de redirecionamento
 * o segundo parametro é uma função de callback, onde vamos
 * retornar uma view
 */
Route::get('/empresa', function(){
    //estou dizendo que ela está dentro da pasta site
    return view('site/empresa');
});

Route::any('/any', function(){
    return 'está rota permite todo tipo de acesso http(put, delete, get, post)';
});

/**O tipo de rota match permite apenas os tipos de acessos
 * que nós mesmos permitimos, no exemplo a seguir eu consigo
 * acessar a página pela url pois ela permite tipo get
 */
Route::match(['get', 'post'], '/match', function(){
    return 'permite apenas acessos definidos';
});
/**
 * Já nesse exemplo apareça a seguinte mensagem:
 * The GET method is not supported for route match. Supported methods: POST.
 * pois ele permite apenas métodos post, isso dar uma maior segurança ao site
 */
Route::match(['post'], '/post', function(){
    return 'permite apenas acessos definidos';
});
