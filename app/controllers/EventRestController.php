<?php


class EventRestController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
			$events=  Eventmanager::all()->toArray();
			return json_encode($events);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
			$events = new Eventmanager;
			$events->title = Request::get('title');
			$events->description = Request::get('description');
			$events->start_date = Request::get('start_date');
			$events->finish_date = Request::get('finish_date');
			$events->city = Request::get('city');
			$eventsMain = $events->save();
			return Response::json(array(
			'error' => false,
			'events' => $events->toArray()),
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
			$events = Eventmanager::where('id',$id)->first();
			return  json_encode($events->toArray());		
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
			$events = Eventmanager::where('id', $id)->find($id);			
			if ( Request::get('title') )
			{
		       $events->title= Request::get('title');
		    }
		    if ( Request::get('description') )
		    {
		        $events->description = Request::get('description');
		    }
		    if( Request::get('start_date')){
				$events->start_date = Request::get('start_date');
		    }
			if(Request::get('finish_date'))
			{
				$events->finish_date = Request::get('finish_date');
			}	
			if(Request::get('city'))
			{
				$events->city= Request::get('city');			
			}		    
    		$events->save();
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
		$events = User::where('id',$id)->find($id);
		$events->delete();
		return Response::json(array(
			'error' =>false,
			'message' => 'Events Deleted successfully'),
			200
		);
	}

}