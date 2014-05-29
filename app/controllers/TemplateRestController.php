<?php

class TemplateRestController extends \BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Template::all()->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param $alias
     * @internal param int $id
     * @return Response
     */
    public function show($alias)
    {
        $template = Template::where('alias', '=', $alias)->first();
        return  json_encode($template->toArray());
    }
}
