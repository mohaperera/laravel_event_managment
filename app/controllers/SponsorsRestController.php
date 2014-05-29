<?php

class SponsorsRestController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$sponsorUser=  Sponsor::all()->toArray();
		return json_encode(array(
			'error' => false,
			'sponsors' => $sponsorUser));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$sponsorUser= new Sponsor;
		$sponsorUser->companyName = Request::get('companyName');
		$sponsorUser->compnayLogo = Request::get('compnayLogo');
		$sponsorUser->boothNumber = Request::get('boothNumber');
		$sponsorUser->sponsorshipcategory = Request::get('scategory');
		$sponsorUser->category = Request::get('category');
		$sponsorUser->website = Request::get('website');
		$sponsorUser->productsName = Request::get('productsName');
		$sponsorUser->image = Request::get('image');
		$sponsorUser->productDescription = Request::get('description');
		$sponsorUser->save();

		return Response::json(array(
			'error' => false,
			'sponsors' => $sponsorUser->toArray()),
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
		$sponsors= Sponsor::where('id',$id)->first();
		return  json_encode($sponsors->toArray());		

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
		$sponsorsUser = Sponsor::where('id', $id)->find($id);	

		if( Request::get('companyName'))
		{
			$sponsorsUser->companyName = Request::get('companyName');
		}
		if( Request::get('compnayLogo'))
		{
			$sponsorsUser->compnayLogo = Request::get('compnayLogo');
		}

		if( Request::get('boothNumber'))
		{
			$sponsorsUser->boothNumber = Request::get('boothNumber');
		}
		if( Request::get('scategory'))
		{
			$sponsorsUser->sponsorshipcategory = Request::get('scategory');
		}
		if( Request::get('category'))
		{
			$sponsorsUser->category = Request::get('category');
		}
		if( Request::get('website'))
		{
			$sponsorsUser->website = Request::get('website');
		}
		if( Request::get('productsName'))
		{
			$sponsorsUser->productsName = Request::get('productsName');
		}
		if( Request::get('image'))
		{
			$sponsorsUser->image = Request::get('image');
		}
		if( Request::get('description'))
		{
			$sponsorsUser->productDescription = Request::get('description');
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
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$sponsorsUser = Sponsor::where('id',$id)->find($id);
		$sponsorsUser->delete();
		return Response::json(array(
			'error' =>false,
			'message' => 'Sessioin Deleted successfully'),
			200
		);				
	}

}
