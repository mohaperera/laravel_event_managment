<?php

class ManagersController extends \BaseController {


	protected $layout = 'layouts.base';

	public function __construct(Managers $manager)
	{
		//parent::__construct();
		$this->beforeFilter('auth');
		$this->manager = $manager;
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id='')
	{
		$user = Auth::user();
		if ($user->group_id != 1) {
			return Redirect::to('profile')->with('error', 'You were not authorized to access that url');
		}		
		$results = Managers::where('group_id', '=', 2)->get();	
		$this->layout->content =  View::make('managers.index', compact('results', 'validation'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content =  View::make('managers.create');
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

		if ($this->manager->validate($input)) {
			
			//Hash::make(

			$input['password'] = Hash::make($input['password']);

			$managers = $this->manager->create($input);
			
			return Redirect::to('managers')->with('success', 'Insert Record Successfully');
			$validation = false;
		} else {
			// failure			
		    $errors = $this->manager->errors();			
		    // return Redirect::route('managers.create')		
		    return Redirect::route('managers.index')
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
		$result = Managers::find($id);
		$this->layout->content =  View::make('managers.show', compact('result'));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id = '')
	{
		$data = Managers::find($id);
		$results = Managers::all();
		$this->layout->content = View::make('managers.edit', compact('results', 'data', 'id'));
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

		if ($this->manager->validate($input)) {	
			
			$manager = $this->manager->find($id);
			$managers = $manager->update($input);
			
			return Redirect::to('managers')->with('success', 'Updated Record Successfully');
			
		} else {
			// failure
		    $errors = $this->manager->errors();			
		    return Redirect::route('managers.edit', $id)
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
		$obj = Managers::find($id);
		$obj->delete();
		return Redirect::to('managers')->with('success', 'Record Deleted Successfully');
	}

}