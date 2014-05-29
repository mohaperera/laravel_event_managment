<?php

class ExhibitorsRestController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$exhibitor=  Exhibitor::all()->toArray();
		return json_encode(array(
			'error' => false,
			'exhibitor' => $exhibitor));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$exhibitor= new Exhibitor;
		$exhibitor->companyName = Request::get('companyName');
		$exhibitor->compnayLogo = Request::get('compnayLogo');
		$exhibitor->boothNumber = Request::get('boothNumber');
		$exhibitor->category = Request::get('category');
		$exhibitor->website = Request::get('website');
		$exhibitor->productsName = Request::get('productsName');
		$exhibitor->image = Request::get('image');
		$exhibitor->productDescription = Request::get('description');
		$exhibitor->featured = Request::get('featured');
		
		$exhibitor->save();

		return Response::json(array(
			'error' => false,
			'sponsors' => $exhibitor->toArray()),
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
		$exhibitor= Exhibitor::where('id',$id)->first();
		return  json_encode($exhibitor->toArray());		

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$exhibitor = Exhibitor::where('id', $id)->find($id);	

		if( Request::get('companyName'))
		{
			$exhibitor->companyName = Request::get('companyName');
		}
		if( Request::get('compnayLogo'))
		{
			$exhibitor->compnayLogo = Request::get('compnayLogo');
		}

		if( Request::get('boothNumber'))
		{
			$exhibitor->boothNumber = Request::get('boothNumber');
		}
		if( Request::get('category'))
		{
			$exhibitor->category = Request::get('category');
		}
		if( Request::get('website'))
		{
			$exhibitor->website = Request::get('website');
		}
		if( Request::get('productsName'))
		{
			$exhibitor->productsName = Request::get('productsName');
		}
		if( Request::get('image'))
		{
			$exhibitor->image = Request::get('image');
		}
		if( Request::get('description'))
		{
			$exhibitor->productDescription = Request::get('description');
		}
		if( Request::get('featured'))
		{
			$exhibitor->featured = Request::get('featured');
		}
		

		$sponsorsUser->save();

		return Response::json(array(
		        'error' => false,
		        'message' => 'Sponsor udpated successfully'),
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
		$exhibitor = Exhibitor::where('id',$id)->find($id);
		$exhibitor->delete();
		return Response::json(array(
			'error' =>false,
			'message' => 'Sessioin Deleted successfully'),
			200
		);	

	}

}
