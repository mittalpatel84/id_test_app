# id_test_app
interior define test app

-In this project I define three api end points for create,list,delete shorter url based on requirements

Route::get('short_links/list', 'ShorterLinkController@list')->middleware('my.auth');
Route::post('short_links/create', 'ShorterLinkController@create')->middleware('my.auth');
Route::delete('short_links/{code}', 'ShorterLinkController@delete')->middleware('my.auth');

-also added other routes for register,login,logout users

Route::post('/login', 'Auth\LoginController@login')->name('login.api');
Route::post('/register','Auth\RegisterController@register')->name('register.api');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout.api');

-also I added my authentication file to allow access only to autorize users
'my.auth' => \App\Http\Middleware\MyAuthenticate::class

let me know if you have any question or suggestion
