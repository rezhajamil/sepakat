<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->orderBy('title')->get();

        return view('admin.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'date' => ['required'],
            'image' => ['required', 'image'],
            'caption' => ['required'],
        ]);

        if ($request->hasFile('image')) {
            $image = $request->image->store('event');

            Event::create([
                'author_id' => auth()->user()->id,
                'title' => ucwords($request->title),
                'slug' => Str::slug($request->title),
                'caption' => $request->caption,
                'date' => $request->date,
                'image' => $image,
            ]);
        }

        return redirect()->route('admin.event.index')->with('success', 'Berhasil Menambahkan Event');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::with(['author'])->find($id);

        return view('admin.event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);

        return view('admin.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required'],
            'date' => ['required'],
            'image' => ['nullable', 'image'],
            'caption' => ['required'],
        ]);

        $event = Event::find($id);

        if ($request->image && $request->hasFile('image')) {
            $image = $request->image->store('event');
            Storage::delete($event->image);

            $event->title = ucwords($request->title);
            $event->slug = Str::slug($request->title);
            $event->caption = $request->caption;
            $event->image = $image;
            $event->save();
        } else {
            $event->title = ucwords($request->title);
            $event->slug = Str::slug($request->title);
            $event->caption = $request->caption;
            $event->save();
        }

        return redirect()->route('admin.event.index')->with('success', 'Berhasil Mengedit Event');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
