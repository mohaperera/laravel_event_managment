<?php

use Carbon\Carbon;

class TemplatesController extends BaseController
{
    /**
     * Template Repository
     *
     * @var Template
     */
    protected $template;

    /**
     * Constructor
     */
    public function __construct(Template $template)
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->template = $template;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       $templates = $this->template->all();
        return View::make('templates.index', compact('templates'))
            ->with('template_types', TemplateType::lists('name', 'id'))
            ->with('binding_methods', BindingMethod::lists('name', 'id'))
            ->with('cover_types', CoverType::lists('name', 'id'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return View::make('templates.create')
            ->with('template_types', TemplateType::lists('name', 'id'))
            ->with('binding_methods', BindingMethod::lists('name', 'id'))
            ->with('cover_types', CoverType::lists('name', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws Exception
     * @return Response
     */
    public function store()
    {
        $validation = Validator::make(Input::all(), Template::$rules);

        if (!$validation->passes()) {
            return Redirect::route('templates.create')
                ->withInput()
                ->withErrors($validation)
                ->with('flash_error', 'There were validation errors.');
        }

        $input = array_filter(
            Input::except('_token'),
            function ($val) {
                return !empty($val);
            }
        );

        // Save the new template
        $template = new Template($input);
        $template->user_id = Auth::user()->id;
        $template->save();

        // Check if a file was uploaded for this template, and rename it using the template alias
        $unique_name = Session::getId() . "_" . Session::get('_token');
        $uploaded_filename =  Config::get('tms.upload_path') . "/{$unique_name}.7z";
        if (file_exists($uploaded_filename)) {
            $new_filename = Config::get('tms.upload_path') . "/{$template->alias}.7z";
            rename($uploaded_filename, $new_filename);
        }

        $data = [
            'alias'=>Input::get('alias'),
            'email' => Auth::user()->email
        ];

        Queue::push('TmsParseQueue', $data);

        return Redirect::route('templates.index')
            ->with(
                'flash_notice',
                'Your template has been uploaded, and will be processed momentarily.' .
                'You will receive an email once your template is ready.'
            )
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $template = $this->template->findOrFail($id);
        return View::make('templates.show', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $template = $this->template->find($id);
        if (is_null($template)) {
            return Redirect::route('templates.index');
        }
        return View::make('templates.edit', compact('template'))
            ->with('template_types', TemplateType::lists('name', 'id'))
            ->with('binding_methods', BindingMethod::lists('name', 'id'))
            ->with('cover_types', CoverType::lists('name', 'id'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $validation = Validator::make(Input::all(), Template::$rules);
        if ($validation->fails()) {
            return Redirect::route('templates.edit', $id)
                ->withInput()
                ->withErrors($validation)
                ->with('flash_error', 'There were validation errors.');
        } else {
            $template = Template::find($id);
            $template->update(Input::except('_token'));
            $template->save();
        }

        return Redirect::route('templates.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->template->find($id)->delete();
        return Redirect::route('templates.index');
    }
}
