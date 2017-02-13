<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tag;

use Validator;
use Redirect;
use Session;
use Input;
use View;
use Form;

class TagController extends Controller
{
    protected $rules = [        
        'name' => ['required', 'min:3'],        
        'slug' => ['required', 'min:2', 'alpha_dash'],   
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return View::make('admin.tag.index')->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $tag = new Tag;

        $tag->name = Input::get('name');
        $tag->slug = Input::get('slug');
        $tag->color = Input::get('color');
                
        $tag->save();
     
        return Redirect::route('admin.tag.index')->with('success', 'New Tag created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        return View::make('admin.tag.edit')->with('tag', $tag);
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
        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
            return Redirect::to('admin/tag/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $tag = Tag::find($id);

            $tag->name = Input::get('name');
            $tag->slug = Input::get('slug');
            $tag->color = Input::get('color');
                
            $tag->save();

            return Redirect::to('admin/tag')->with('success', 'Successfully updated tag!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $tag = Tag::findOrFail($id);

        // Delete reference in pivot table
        $tag->posts()->detach();

        $tag->delete();

        return redirect::to('admin/tag')->with('success', 'Successfully deleted tag!');
    }
}
