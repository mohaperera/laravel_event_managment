<?php

class SpeakerRestController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
			$speakers=  Speaker::all()->toArray();
			return json_encode(array('events'=>$speakers));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$speakers= new Speaker;
		$speakers->event_id = Request::get('eventID');
		$speakers->SpeakerName = Request::get('name');
		$speakers->jobTitle = Request::get('job');
		$speakers->companyName= Request::get('company');
		$speakers->sessionTitle = Request::get('session');
		$speakers->facebookAccount = Request::get('facebook');
		$speakers->twitterAccount = Request::get('twitter');

		$speakers->save();

		return Response::json(array(
			'error' => false,
			'events' => $speakers->toArray()),
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
			$speakers = Speaker::where('id',$id)->first();
			return  json_encode($speakers->toArray());		
			
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$speakers = Speaker::where('id', $id)->find($id);			
		if( Request::get('eventID'))
		{
			$speakers->event_id = Request::get('eventID');
		}
		if ( Request::get('name') )
		{
	       $speakers->SpeakerName= Request::get('name');
	    }
    	if ( Request::get('job') )
		{
	       $speakers->jobTitle= Request::get('job');
	    }
    	if ( Request::get('company') )
		{
	       $speakers->companyName= Request::get('company');
	    }
	   	if ( Request::get('session') )
		{
	       $speakers->sessionTitle= Request::get('session');
	    }
		if ( Request::get('facebook') )
		{
	       $speakers->facebookAccount= Request::get('facebook');
	    }
    	if ( Request::get('twitter') )
		{
	       $speakers->twitterAccount= Request::get('twitter');
	    }
	
		$speakers->save();
		
		return Response::json(array(
		        'error' => false,
		        'message' => 'Speakers udpated successfully'),
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
		$speakers = Speaker::where('id',$id)->find($id);
		$speakers->delete();
		return Response::json(array(
			'error' =>false,
			'message' => 'Speakers Deleted successfully'),
			200
		);	
	}

}
