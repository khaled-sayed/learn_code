<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index() 
	{
		$user_courses = User::findOrFail(1)->courses;
		return view('home', compact('user_courses'));
	}
}
