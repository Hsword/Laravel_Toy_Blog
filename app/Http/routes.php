<?php

use App\Essay;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
 * Get the essay page
 */
Route::get("/",function(){
	return Redirect::route("login");
});
Route::match(['post','get'],'/login',[
	"as" => "login",
	"uses" => "AuthController@loginAction",
]);
Route::match(['post','get'],'/register',[
	"as" => "register",
	"uses" => "AuthController@registerAction"
]);

Route::group(['middleware' => 'auth'],function(){
    Route::get('/blog',[
	    "as" => "home",
	    "uses" => "BlogController@index",
    ]);
    Route::get('/logout',[
	    "as" => "logout",
	    "uses" => "AuthController@logoutAction"
    ]);
    /*
    Route::get('/', function () {
        $essays = Essay::orderBy('created_at', 'asc')->get();
        //$tasks = DB::table('task')->orderBy('created_at', 'asc')->get();
        return view('essays',[
            'essays' => $essays
	    ]);
	});
     */
    Route::get('user/{name?}',function($name='Hsword'){
	    return 'Hello'.$name;
    });
    Route::get('essay/{id}','BlogController@show');
    Route::get('edit/{id}','BlogController@edit');
    /*
    * Add a essay
    */
    Route::get('create','BlogController@create');
    Route::post('update','BlogController@update');
	Route::post('/essay', function(Request $request){

		//Use a validator to check the data
		$validator = Validator::make($request->all(), [
			'name' => 'required | max:255',
			'content' => 'required | max:3000'
		]);

		//Fail the Validation
		if($validator->fails())
		{
			return Redirect::route("home")->withInput()->withErrors($validator);
		}

		$essay = new Essay;
		$essay->name = $request->name;
		$essay->content = $request->content;
		$essay->save();

		return Redirect::route("home");
	});

	/*
	 * Delete a essay
	 */

	Route::delete('/essay/{id}', function($id){
		Essay::findOrFail($id)->delete();

		return Redirect::route("home");
	});
});
