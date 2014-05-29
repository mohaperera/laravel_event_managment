<?php

class SpeakersController extends \BaseController {

	/**
	 * Display a listing of speakers
	 *
	 * @return Response
	 */
	public function index()
	{
		$speakers = Speaker::all();

		return View::make('speakers.index', compact('speakers'));
	}

	/**
	 * Show the form for creating a new speaker
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('speakers.create');
	}

	/**
	 * Store a newly created speaker in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Speaker::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Speaker::create($data);

		return Redirect::route('speakers.index');
	}

	/**
	 * Display the specified speaker.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$speaker = Speaker::findOrFail($id);

		return View::make('speakers.show', compact('speaker'));
	}

	/**
	 * Show the form for editing the specified speaker.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$speaker = Speaker::find($id);

		return View::make('speakers.edit', compact('speaker'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$speaker = Speaker::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Speaker::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$speaker->update($data);

		return Redirect::route('speakers.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Speaker::destroy($id);

		return Redirect::route('speakers.index');
	}

}