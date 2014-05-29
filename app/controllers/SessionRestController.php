<?php

class SessionRestController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$sessionUser=  Mysession::all()->toArray();
		return json_encode(array(
			'error' => false,
			'events' => $sessionUser));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$sessionUser= new Mysession;
		$sessionUser->session_title = Request::get('sessionName');
		$sessionUser->description = Request::get('description');
		$sessionUser->room= Request::get('room');
	
		$sessionUser->save();

		return Response::json(array(
			'error' => false,
			'events' => $sessionUser->toArray()),
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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$sessionUser= Mysession::where('id',$id)->first();
		return  json_encode($sessionUser->toArray());		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$sessionUser = Mysession::where('id', $id)->find($id);			
		
		if( Request::get('sessionName'))
		{
			$sessionUser->session_title = Request::get('sessionName');
		}
		if( Request::get('description'))
		{
			$sessionUser->description = Request::get('description');
		}
		if( Request::get('room'))
		{
			$sessionUser->room = Request::get('room');
		}

		$sessionUser->save();

		return Response::json(array(
		        'error' => false,
		        'message' => 'Sesssion udpated successfully'),
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$sessionUser = Mysession::where('id',$id)->find($id);
		$sessionUser->delete();
		return Response::json(array(
			'error' =>false,
			'message' => 'Sessioin Deleted successfully'),
			200
		);			
	}

}
