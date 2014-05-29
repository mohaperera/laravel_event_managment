<?php

class BoothsRestController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$booths=  Booth::all()->toArray();
		return json_encode($booths);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$booths= new Booth;
		$booths->boothnumber = Request::get('boothnumber');
		$booths->companyName = Request::get('companyName');
		$booths->statues = Request::get('statues');
		
		$booths->save();

		return Response::json(array(
			'error' => false,
			'BOOTHS' => $booths->toArray()),
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
		$booths= Exhibitor::where('id',$id)->first();
		return  json_encode($booths->toArray());		
	
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$booths= new Booth;

		if( Request::get('boothnumber'))
		{
			$booths->boothnumber = Request::get('boothnumber');
		}
		if( Request::get('ompanyName'))
		{
			$booths->companyName = Request::get('companyName');	
		}
		if( Request::get('statues'))
		{
			$booths->statues = Request::get('statues');
		}
		$booths->save();

		return Response::json(array(
			'error' => false,
			'BOOTHS' => 'Booths updated successfully',
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
		$booths = Booths::where('id',$id)->find($id);
		$booths->delete();
		return Response::json(array(
			'error' =>false,
			'message' => 'Booths Deleted successfully'),
			200
		);	
				
	}

}