<?php

class GroupsController extends \BaseController {


	protected $layout = 'layouts.base';

	public function __construct(Groups $group)
	{
		//parent::__construct();
		$this->beforeFilter('auth');
		$this->group = $group;
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id='')
	{
		$results = Groups::all();
		$this->layout->content =  View::make('groups.index', compact('results'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content =  View::make('groups.create');
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

		if ($this->group->validate($input)) {
			
			$groups = $this->group->create($input);
			
			return Redirect::to('groups')->with('success', 'Insert Record Successfully');
			
		} else {
			// failure
		    $errors = $this->group->errors();			
		    return Redirect::route('groups.create')
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
		$result = Groups::find($id);
		$this->layout->content =  View::make('groups.show', compact('result'));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id = '')
	{

		$data = Groups::find($id);
		$results = Groups::all();
		$this->layout->content = View::make('groups.edit', compact('results', 'data', 'id'));

		

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

		if ($this->group->validate($input)) {	
			
			$group = $this->group->find($id);
			$groups = $group->update($input);
			
			return Redirect::to('groups')->with('success', 'Updated Record Successfully');
			
		} else {
			// failure
		    $errors = $this->group->errors();			
		    return Redirect::route('groups.edit', $id)
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
		$obj = Groups::find($id);
		$obj->delete();
		return Redirect::to('groups')->with('success', 'Record Deleted Successfully');
	}

}