<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;





use App\Helpers\DbHelper;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function store(Request $request)
    {
      $input = $request->all();
	  $validator = Validator::make($request->all(), [
	      'Username' => 'required|string|max:50',
	      'Password' => 'required|string|min:8',
	      'Email' => 'required|string',
		  'Type' => 'required|string',
		  'Name' => 'required|string',
	    ]);
	    if ($validator->fails()) {
	      return response()->json(['errors' => $validator->errors()->all()]);
	    }
	    // $input['Password'] = md5($request->password);

	    $input['UserId'] = rand(0, 999999).date("M").time();
	    $insert = DB::insert("INSERT INTO users(Name, UserId, Username, Email, Type, Password) VALUES (?, ?, ?, ?, ? ,?)", [$input['Name'], $input['UserId'], $input['Username'], $input['Email'], $input['Type'], $input['Password']]);
	  

	   if ($insert){
	    	$response['success'] = 1;
	    	$response['success_msg'] = "User Addedd Successfully";	
	    }else{
	    	$response['success'] = 0;
	    	$response['success_msg'] = "An Error Occured";
	    }
		return response()->json($response);
    }

    public function loginUser(Request $request){
    	$input = $request->all();
    	$validator = Validator::make($request->all(), [
	      'Username' => 'required|string|max:50',
	      'Password' => 'required|string|min:8'
	    ]);
	    if ($validator->fails()) {
	      return response()->json(['errors' => $validator->errors()->all()]);
	    };	

	    // $input['PasswordBQ'] = md5($request->Password);
	    $getUser = DB::table('users')
	    			->where('Username', $input['Username'])
	    			->get();

	    			
	    if ($getUser) {
	    	if ($getUser[0]->Password === $request->Password) {
		    	$response['success'] = 1;
		    	$response['msg'] = 'Success';	 
		    	$response['User'] = $getUser[0];		
	    	}else{
	    		$response['success'] = 0;
	    		$response['msg'] = 'Invalid Password';
	    	}
	    }else{
	    	$response['success'] = 0;
	    	$response['msg'] = 'Invalid User';
	    }
		return response()->json($response);
    }

    public function storeFood(Request $request){

    	$input = $request->all();
    	$validator = Validator::make($request->all(), [
	      'foodName' => 'required|string|max:50',
	      'foodabout' => 'required|string',
	      'foodstatus' => 'required|string',
	      'user' => 'required|string'
	    ]);

	    if ($validator->fails()) {
	      return response()->json(['errors' => $validator->errors()->all()]);
	    };	

	    $input['foodId'] = rand(0,1000).date("m").time();
	    $insert = DB::insert("INSERT INTO food(foodId, FoodName, FoodDescription, Status) VALUES (?, ?, ? ,?)", [ 
			    	  $input['foodId'], 
			    	  $input['foodName'], 
			    	  $input['foodabout'],
			    	  $input['foodstatus']
			    	]);

	    $userActivity = "User ".$input['user']." added a food";
	    $useractivityId = rand(0,1000).date("m").time();
	    $activity_insert = DB::insert("INSERT INTO activity(activityId, activity) VALUES (?,?)",[
	    	$useractivityId, $userActivity ]);

	    if ($insert) {
	    	$response['success'] = 1;
	    	$response['msg'] = 'Food Registered'; 
	    }else{
	    	$response['success'] = 0;
	    	$response['msg'] = 'An error occured'; 
	    }
    	return response()->json($response);
    }

    public function getFoods(){
    	$getFoods = DB::select("SELECT * FROM food");
    	// $getFoods = [];
    	return response()->json($getFoods);
    }

    public function getOrders(){
    	$getOrders = DB::select("SELECT * FROM orders");
    	// $getOrders = [];
    	return response()->json($getOrders);
    }

    public function orderFood(Request $request){
    	$input = $request->all();
    	$validator = Validator::make($request->all(), [
	      'foodUser' => 'required|string|max:50',
	      'foodId' => 'required|string',
	      'foodAbout' => 'required|string',
	      'foodTableNumber' => 'required|string'
	    ]);

	    if ($validator->fails()) {
	      return response()->json(['errors' => $validator->errors()->all()]);
	    };	

	    $orderId = rand(0,1000).date("m").time();
	    $insert = DB::insert("INSERT INTO orders(order_id, foodUser, foodId, foodAbout, foodTableNumber)  VALUES(?, ?, ?, ?, ?)", [ 
				    	     $orderId, 
				    	     $input['foodUser'],
				    	     $input['foodId'], 
				    	     $input['foodAbout'], 
				    	     $input['foodTableNumber'] 
				    	  ]);

	    $userActivity = "User ".$input['foodUser']." Placed an order";
	    $useractivityId = rand(0,1000).date("m").time();
	    $activity_insert = DB::insert("INSERT INTO activity(activityId, activity) VALUES (?,?)",[
	    	$useractivityId, $userActivity ]);


	    if ($insert){
	    	$response['success'] = 1;
	    	$response['msg'] = 'Food Registered'; 
	    }else{
	    	$response['success'] = 0;
	    	$response['msg'] = 'An error occured'; 
	    }
	    return response()->json($response);
    }
}

