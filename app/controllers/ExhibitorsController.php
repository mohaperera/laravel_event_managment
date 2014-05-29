<?php

class ExhibitorsController extends \BaseController {

	/**
	 * Display a listing of exhibitors
	 *
	 * @return Response
	 */
	public function index()
	{
		$exhibitors = Exhibitor::all();

		return View::make('exhibitors.index', compact('exhibitors'));
	}

	/**
	 * Show the form for creating a new exhibitor
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('exhibitors.create');
	}

	/**
	 * Store a newly created exhibitor in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Exhibitor::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Exhibitor::create($data);

		return Redirect::route('exhibitors.index');
	}

	/**
	 * Display the specified exhibitor.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$exhibitor = Exhibitor::findOrFail($id);

		return View::make('exhibitors.show', compact('exhibitor'));
	}

	/**
	 * Show the form for editing the specified exhibitor.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$exhibitor = Exhibitor::find($id);

		return View::make('exhibitors.edit', compact('exhibitor'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$exhibitor = Exhibitor::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Exhibitor::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$exhibitor->update($data);

		return Redirect::route('exhibitors.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Exhibitor::destroy($id);

		return Redirect::route('exhibitors.index');
	}

}