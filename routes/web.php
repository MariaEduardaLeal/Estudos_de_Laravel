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
    return redirect()->route('admin.clients');
});

//Criando minaha primeira rota para uma página

/**Aqui estamos criando uma nova rota
 * definimos que o método dela será
 * um get depois temos que colocar 2 parametros
 * o primeiro parametro é a /página de redirecionamento
 * o segundo parametro é uma função de callback, onde vamos
 * retornar uma view
 */

Route::get('/empresa', function () {
    //estou dizendo que ela está dentro da pasta site
    return view('site/empresa');
});

//Tipos de rotas

Route::any('/any', function () {
    return 'está rota permite todo tipo de acesso http(put, delete, get, post)';
});

/**O tipo de rota match permite apenas os tipos de acessos
 * que nós mesmos permitimos, no exemplo a seguir eu consigo
 * acessar a página pela url pois ela permite tipo get
 */
Route::match(['get', 'post'], '/match', function () {
    return 'permite apenas acessos definidos';
});
/**
 * Já nesse exemplo apareça a seguinte mensagem:
 * The GET method is not supported for route match. Supported methods: POST.
 * pois ele permite apenas métodos post, isso dar uma maior segurança ao site
 */
Route::match(['post'], '/post', function () {
    return 'permite apenas acessos definidos';
});

//Passando parâmetros dentro das url


/**Passando informações por meio da url
 * na url vamos definir o parametro que vamos passar
 * faremos isso colcoando uma segunda / após o nome
 * do na url, abrimos chaves {} e colocamos o parametro
 * que vamos passar, no nosso caso o id.
 * Mas para passarmos primeiramente temos que intercepta-lo
 * para isso colocamos a variável que se refere a essa
 * informação dentro do parametro da function
 */
Route::get('/produto/{id}', function ($id_produto) {
    return "O id do produto é:" . $id_produto;
});
//Exemplo de como vai ficar nossa url http://127.0.0.1:8000/produto/123

/**Passando mais de um parametro na url */
Route::get('/loja/{id}/{categoria}', function ($id_produto, $categoria) {
    return "O id do produto é:" . $id_produto . "<br>" . "Acategoria é:" . $categoria;
});
//Exemplo de como vai ficar nossa url http://127.0.0.1:8000/loja/123/limpeza

/**Para podermos passar parametros em branco
 * para situações, por exemplo, onde o usuário pode
 * ou não preencher tais valores, colocamos uma interrogação
 * após a variável que pode vir em branco
 */
Route::get('/loja/{id}/{categoria?}', function ($id_produto, $categoria = '') {
    return "O id do produto é:" . $id_produto . "<br>" . "Acategoria é:" . $categoria;
});

//Criando redirecionamentos


Route::get('/sobre', function () {
    //Quando eu acessar a url /sobre serei redirecionada para /empresa
    return redirect('/empresa');
});

//Maneira simplificada de escrever o código acima
Route::redirect('/sobre', 'empresa');

/**Maneira simplificada do código a seguir
 * Route::get('/empresa', function(){
    //estou dizendo que ela está dentro da pasta site
    return view('site/empresa');
});
 */
Route::view('/empresa', 'site/empresa');

//Nomeando rotas


Route::get('/news', function () {
    return view('news');
})->name('noticias'); //Estou dizendo qual o nome da rota estou usando

Route::get('/novidades', function () {
    /**Quando eu acessar a url /novidades serei redirecionada
     * para a página de /news, mas ela não será redirecionada
     * pela url /news e sim pela rota /noticias que nós
     * definimos na rota passada
     */
    return redirect()->route('noticias');
    /**Essa função é interessante pois mesmo se mudarmos o nome
     * da url em algum momento a funcionalidade da rota não será
     * afetada
     */
});

//Grupo de rotas

/**Para evitar que precisemos sempre repetir o começo da rota
 * admin/
 */
// Route::get('admin/dashboard', function(){
//     return "dashboard";
// });

// Route::get('admin/users', function(){
//     return "users";
// });

// Route::get('admin/clients', function(){
//     return "clients";
// });

/**Já definimos o prefixo e depois dizemos quem são
 *grupo de rotas que usam esse prefixo */
Route::prefix('admin')->group(function () {
    Route::get('dashboard', function () {
        return "dashboard";
    })->name('admin.dashboard');

    Route::get('users', function () {
        return "users";
    })->name('admin.users');

    Route::get('clients', function () {
        return "clients";
    })->name('admin.clients');
});

//E caso quisermos agrupar pelo nome da rota
Route::name('admin.')->group(function () {
    Route::get('admin/dashboard', function () {
        return "dashboard";
    })->name('dashboard');

    Route::get('admin/users', function () {
        return "users";
    })->name('users');

    Route::get('admin/clients', function () {
        return "clients";
    })->name('clients');
});

//Redirecionando por name e prefixo ao mesmo tempo
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.' //Quando utilizamos o group a chave para usar o name é o as
], function () {
    Route::get('dashboard', function(){
        return "dashboard";
    })->name('dashboard');

    Route::get('users', function(){
        return "users";
    })->name('users');

    Route::get('clients', function(){
        return "clients";
    })->name('clients');
});
