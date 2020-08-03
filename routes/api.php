<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

    
});
Route::middleware('auth:api')->get('/nailist', function (Request $request) {
    return $request->nailist();

    
});


Route::get('users',function(){
	return App\User::all();
});
Route::delete('users/{id}',function($id){

	$user = App\User::find($id);

	$user->delete();

	return response()->json([
        'success' => 'user deleted successfully!'
    ]);

});

Route::patch('users/{id}',function($id,Request $request){

	$user = App\User::find($id);

	$user->update($request->all());

	return response()->json([
        'success' => 'user updated successfully!'
    ],200);

});


Route::get('nailists',function(){
	return App\Nailist::all();
});
Route::delete('nailists/{id}',function($id){

	$nailist = App\Nailist::find($id);

	$nailist->delete();

	return response()->json([
        'success' => 'nailist deleted successfully!'
    ]);

});

Route::patch('nailists/{id}',function($id,Request $request){

	$id = $request->input('id');

    $nailist = App\Nailist::find($id);
    

	$nailist->update($request->all());

	return response()->json([
        'success' => 'nailist updated successfully!'
    ],200);

});
