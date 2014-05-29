<?php

class ProfileController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    public function index()
    {
        return View::make('profile.index');
    }
}