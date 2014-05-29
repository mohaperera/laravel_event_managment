<?php

class MysessionsController extends \BaseController {


	protected $layout = 'layouts.base';

	public function __construct(Mysession $mysession)
	{
		//parent::__construct();
		
		$this->beforeFilter('auth');
		$this->mysession = $mysession;
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id='')
	{
		$results = Mysession::all();
		$validation = false;
		$this->layout->content =  View::make('mysessions.index', compact('results', 'validation'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content =  View::make('mysessions.create');
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

		if ($this->mysession->validate($input)) {
			
			$mysessions = $this->mysession->create($input);
			
			return Redirect::to('session')->with('success', 'Insert Record Successfully');
			$validation = false;
		} else {
			// failure
			$validation = true;
		    $errors = $this->mysession->errors();			
		    // return Redirect::route('mysessions.create')
		    View::share(compact('validation'));
		    return Redirect::route('session.index')
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
		$result = Mysession::find($id);
		$this->layout->content =  View::make('mysessions.show', compact('result'));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id = '')
	{
		$data = Mysession::find($id);
		$results = Mysession::all();
		$this->layout->content = View::make('mysessions.edit', compact('results', 'data', 'id'));
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

		if ($this->mysession->validate($input)) {	
			
			$mysession = $this->mysession->find($id);
			$mysessions = $mysession->update($input);
			
			return Redirect::to('session')->with('success', 'Updated Record Successfully');
			
		} else {
			// failure
		    $errors = $this->mysession->errors();			
		    return Redirect::route('session.edit', $id)
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
		$obj = Mysession::find($id);
		$obj->delete();
		return Redirect::to('session')->with('success', 'Record Deleted Successfully');
	}

}