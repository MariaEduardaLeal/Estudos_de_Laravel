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

/**Passando informações por meio da url
 * na url vamos definir o parametro que vamos passar
 * faremos isso colcoando uma segunda / após o nome
 * do na url, abrimos chaves {} e colocamos o parametro
 * que vamos passar, no nosso caso o id.
 * Mas para passarmos primeiramente temos que intercepta-lo
 * para isso colocamos a variável que se refere a essa
 * informação dentro do parametro da function
 */
Route::get('/produto/{id}', function($id_produto){
    return "O id do produto é:".$id_produto;
});
//Exemplo de como vai ficar nossa url http://127.0.0.1:8000/produto/123

/**Passando mais de um parametro na url */
Route::get('/loja/{id}/{categoria}', function($id_produto, $categoria){
    return "O id do produto é:".$id_produto."<br>"."Acategoria é:".$categoria;
});
//Exemplo de como vai ficar nossa url http://127.0.0.1:8000/loja/123/limpeza

/**Para podermos passar parametros em branco
 * para situações, por exemplo, onde o usuário pode
 * ou não preencher tais valores, colocamos uma interrogação
 * após a variável que pode vir em branco
*/
Route::get('/loja/{id}/{categoria?}', function($id_produto, $categoria =''){
    return "O id do produto é:".$id_produto."<br>"."Acategoria é:".$categoria;
});
