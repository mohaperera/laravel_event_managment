<?php

class BoothsController extends \BaseController {

	/**
	 * Display a listing of booths
	 *
	 * @return Response
	 */
	public function index()
	{
		$booths = Booth::all();

		return View::make('booths.index', compact('booths'));
	}

	/**
	 * Show the form for creating a new booth
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('booths.create');
	}

	/**
	 * Store a newly created booth in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Booth::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Booth::create($data);

		return Redirect::route('booths.index');
	}

	/**
	 * Display the specified booth.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$booth = Booth::findOrFail($id);

		return View::make('booths.show', compact('booth'));
	}

	/**
	 * Show the form for editing the specified booth.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$booth = Booth::find($id);

		return View::make('booths.edit', compact('booth'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$booth = Booth::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Booth::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$booth->update($data);

		return Redirect::route('booths.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Booth::destroy($id);

		return Redirect::route('booths.index');
	}

}