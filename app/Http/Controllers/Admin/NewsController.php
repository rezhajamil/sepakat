<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->orderBy('title')->get();

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
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
            'headline' => ['required', 'max:80'],
            'image' => ['required', 'image'],
            'caption' => ['required'],
        ]);

        if ($request->hasFile('image')) {
            $image = $request->image->store('news');

            News::create([
                'author_id' => auth()->user()->id,
                'title' => ucwords($request->title),
                'slug' => Str::slug($request->title),
                'headline' => $request->headline,
                'caption' => $request->caption,
                'image' => $image,
            ]);
        }

        return redirect()->route('admin.news.index')->with('success', 'Berhasil Menambahkan Berita');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::with(['author'])->find($id);

        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);

        return view('admin.news.edit', compact('news'));
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
            'headline' => ['required', 'max:80'],
            'image' => ['nullable', 'image'],
            'caption' => ['required'],
        ]);

        $news = News::find($id);

        if ($request->image && $request->hasFile('image')) {
            $image = $request->image->store('news');
            Storage::delete($news->image);

            $news->title = ucwords($request->title);
            $news->slug = Str::slug($request->title);
            $news->headline = $request->headline;
            $news->caption = $request->caption;
            $news->image = $image;
            $news->save();
        } else {
            $news->title = ucwords($request->title);
            $news->slug = Str::slug($request->title);
            $news->headline = $request->headline;
            $news->caption = $request->caption;
            $news->save();
        }

        return redirect()->route('admin.news.index')->with('success', 'Berhasil Mengedit Berita');
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
