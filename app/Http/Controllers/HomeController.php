<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::limit(5)->get();
        $events = Event::where('date', '>=', date('Y-m-d'))->get();

        if (!count($events)) {
            $events = Event::limit(5)->orderBy('date', 'desc')->get();
        }

        return view('home', compact('news', 'events'));
    }
}
