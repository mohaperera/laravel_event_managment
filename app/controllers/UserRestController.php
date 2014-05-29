<?php

class UserRestController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	        $users=  User::all()->toArray();
	        return json_encode($users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$users = new User;
		$users->username = Request::get('username');
		$users->password = Request::get('password');
		$users->email = Request::get('email');
		$save = $users->save();
		return Response::json(array(
			'error' => false,
			'users' => $users->toArray()),
			200
			); 
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

	public function store()
	{

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    $users = User::where('id', '=', $id)->first();
        return  json_encode($users->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
			$users = User::where('id', $id)->find($id);
		    if ( Request::get('username') )
		    {
		        $users->username = Request::get('username');
		    }
		    if ( Request::get('password') )
		    {
		        $users->password = Request::get('password');
		    }
		    if( Request::get('email')){
				$users->email = Request::get('email');
		    }
    		$users->save();
		    return Response::json(array(
		        'error' => false,
		        'message' => 'User udpated successfully'),
		        200
		    );					
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function update($id)
	{
		
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	
	public function destroy($id)
	{
		$users = User::where('id',$id)->find($id);
		$users->delete();
		return Response::json(array(
			'error' =>false,
			'message' => 'user Deleted successfully'),
			200
		);
	}
}