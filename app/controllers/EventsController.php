<?php

class EventsController extends \BaseController {


	protected $layout = 'layouts.base';
	protected $user_id = '';

	public function __construct(Events $event)
	{
		//parent::__construct();
		$this->beforeFilter('auth');
		$this->event = $event;

		$this->user_id = Auth::user()->id;
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id='')
	{
		$results = Events::all();
		$user_id = $this->user_id;
		$this->layout->content =  View::make('events.index', compact('results', 'user_id'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content =  View::make('events.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$input = Input::all();
		$input = array_except($input, '_token');
		$destinationPath = $eventImage = '';
		
		if (Input::hasFile('image'))
		{
			$destinationPath = 'uploads/events/'.str_random(8);
			$eventImage = Input::file('image')->getClientOriginalName();

			Input::file('image')->move($destinationPath, $eventImage);				   		
		}

		
		if ($this->event->validate($input)) {

			$input['image_path'] = $destinationPath;
			$input['image'] = $eventImage;
			
			$events = $this->event->create($input);
			
			return Redirect::to('events')->with('success', 'Insert Record Successfully');
			
		} else {
			// failure
		    $errors = $this->event->errors();			
		    // return Redirect::route('events.create')
		    return Redirect::route('events.index')
			->withInput()
			->withErrors($errors)
			->with('error', 'There were validation errors.');
		}			
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id = '')
	{
		$result = Events::find($id);
		$this->layout->content =  View::make('events.show', compact('result'));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id = '')
	{
		$data = Events::find($id);
		$results = Events::all();
		$user_id = $this->user_id;
		$this->layout->content = View::make('events.edit', compact('results', 'data', 'id', 'user_id'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
		$input = Input::all();
		$input = array_except($input, '_token');

		$destinationPath = $eventImage = '';
		
		if (Input::hasFile('image'))
		{
			$destinationPath = 'uploads/events/'.str_random(8);
			$eventImage = Input::file('image')->getClientOriginalName();

			Input::file('image')->move($destinationPath, $eventImage);				   		
		}

		
		if ($this->event->validate($input)) {

			$input['image_path'] = $destinationPath;
			$input['image'] = $eventImage;
		
			
			$event = $this->event->find($id);
			$events = $event->update($input);
			
			return Redirect::to('events')->with('success', 'Updated Record Successfully');
			
		} else {
			// failure
		    $errors = $this->event->errors();			
		    return Redirect::route('events.edit', $id)
			->withInput()
			->withErrors($errors)
			->with('error', 'There were validation errors.');
		}
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id='')
	{
		$obj = Events::find($id);
		$obj->delete();
		return Redirect::to('events')->with('success', 'Record Deleted Successfully');
	}

}