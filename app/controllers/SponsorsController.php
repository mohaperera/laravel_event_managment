<?php

class SponsorsController extends \BaseController {


	protected $layout = 'layouts.base';

	public function __construct(Sponsor $sponsor)
	{
		//parent::__construct();
		
		$this->beforeFilter('auth');
		$this->sponsor = $sponsor;
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id='')
	{
		$results = Sponsor::all();
		$validation = false;
		$this->layout->content =  View::make('sponsors.index', compact('results', 'validation'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content =  View::make('sponsors.create');
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

		$destinationPath = $destinationPathcompanyLogo = $companyImage = $eventImage = '';
		
		if (Input::hasFile('image'))
		{
			$destinationPath = 'uploads/sponser/'.str_random(8);
			$eventImage = Input::file('image')->getClientOriginalName();

			Input::file('image')->move($destinationPath, $eventImage);				   		
		}

		if (Input::hasFile('compnayLogo'))
		{
			$destinationPathcompanyLogo = 'uploads/sponser/'.str_random(8);
			$companyImage = Input::file('compnayLogo')->getClientOriginalName();

			Input::file('compnayLogo')->move($destinationPathcompanyLogo, $companyImage);				   		
		}

		
		if ($this->sponsor->validate($input)) {

			
			$input['image_path'] = $destinationPath;
			$input['image'] = $eventImage;

			$input['company_path'] = $destinationPathcompanyLogo;
			$input['compnayLogo'] = $companyImage;			

			$sponsors = $this->sponsor->create($input);
			
			return Redirect::to('sponsors')->with('success', 'Insert Record Successfully');
			$validation = false;
		} else {
			// failure
			$validation = true;
		    $errors = $this->sponsor->errors();			
		    // return Redirect::route('sponsors.create')
		    View::share(compact('validation'));
		    return Redirect::route('sponsors.index')
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
		$result = Sponsor::find($id);
		$this->layout->content =  View::make('sponsors.show', compact('result'));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id = '')
	{
		$data = Sponsor::find($id);
		$results = Sponsor::all();
		$this->layout->content = View::make('sponsors.edit', compact('results', 'data', 'id'));
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

		$destinationPath = $destinationPathcompanyLogo = $companyImage = $eventImage = '';
		
		if (Input::hasFile('image'))
		{
			$destinationPath = 'uploads/sponser/'.str_random(8);
			$eventImage = Input::file('image')->getClientOriginalName();

			Input::file('image')->move($destinationPath, $eventImage);				   		
		}

		if (Input::hasFile('compnayLogo'))
		{
			$destinationPathcompanyLogo = 'uploads/sponser/'.str_random(8);
			$companyImage = Input::file('compnayLogo')->getClientOriginalName();

			Input::file('compnayLogo')->move($destinationPathcompanyLogo, $companyImage);				   		
		}

		
		if ($this->sponsor->validate($input)) {

			
			$input['image_path'] = $destinationPath;
			$input['image'] = $eventImage;

			$input['company_path'] = $destinationPathcompanyLogo;
			$input['compnayLogo'] = $companyImage;					
			
			$sponsor = $this->sponsor->find($id);
			$sponsors = $sponsor->update($input);
			
			return Redirect::to('sponsors')->with('success', 'Updated Record Successfully');
			
		} else {
			// failure
		    $errors = $this->sponsor->errors();			
		    return Redirect::route('sponsors.edit', $id)
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
		$obj = Sponsor::find($id);
		$obj->delete();
		return Redirect::to('sponsors')->with('success', 'Record Deleted Successfully');
	}

}