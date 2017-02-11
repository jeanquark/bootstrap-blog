<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Tag;

use \Michelf\MarkdownExtra;
use Carbon\Carbon;
use Validator;
use Redirect;
use Session;
use Input;
use View;
use Form;

class PostController extends Controller
{
    protected $rules = [		
	 	'title' => ['required'],		
	 	'text' => ['required'],	
	 	'slug'  => ['required', 'min:2', 'alpha_dash'],
        'image' => ['mimes:jpeg,jpg,png,JPG,PNG', 'image_size:>=900,>=300', 'max:10000']
 	];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();

        return View::make('admin.post.index')->with('posts', $posts);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::pluck('name', 'id');

        return View::make('admin.post.create')->with('tags', $tags);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
            return Redirect::to('admin/post/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $post = new Post;

            $post->user_id = \Auth::user()->id;
            $post->title = Input::get('title');
            $post->slug = Input::get('slug');
            $post->content_raw = Input::get('text');
            $post->content_html = MarkdownExtra::defaultTransform(Input::get('text'));
            $post->excerpt = '';

            if (Input::hasfile('image')) {
            	$image_input = Input::file('image');
            	Post::formatImage($image_input, $post);
            } else {
                $post->image_path = '';
            }

            $post->save();

            // Save tags
            $tags = Input::get('tags');
            //dd($tags);

            if ($tags != NULL) {
                $post->tags()->sync($tags);
                // $post->tags()->attach($tags);
            } else {
                $post->tags()->detach();
            }

            /*if ($post->save()) {
                $post_id = $post->id;

                $post = Post::find($post_id);
                if (Input::has('tags')) {   
                    foreach ($tags as $tag) {     
                        $post->tags()->attach($tag);
                    }
                }
            }*/

            return Redirect::route('admin.post.index')->with('success', 'New Post created!');

        } //end if
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return View::make('admin.post.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $tags = Tag::pluck('name', 'id');
        $selected_tags = $post->tags()->pluck('tags.id')->toArray();
        
        return View::make('admin.post.edit')
            ->with('post', $post)
            ->with('tags', $tags)
            ->with('selected_tags', $selected_tags);
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
            return Redirect::to('admin/post/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $post = Post::findorFail($id);

            // Update title and slug
            $post->title = Input::get('title');
            $post->slug = Input::get('slug');

            $post->content_raw = Input::get('text');
            $post->content_html = MarkdownExtra::defaultTransform(Input::get('text'));

            // If a new image is uploaded
            if (Input::hasfile('image')) {
            	$image_input = Input::file('image');
            	Post::formatImage($image_input, $post);
            }

            // Update published status
            $old_status = $post->is_published;
            $new_status = Input::get('published');
            if ($new_status !== $old_status) { // If change in status
                $post->is_published = $new_status;
                if ($new_status == 1) { // If post is published
                    $post->published_at = Carbon::now();
                } else { // If post is unpublished
                    $post->published_at = NULL;
                }
            }

            $new_tags = Input::get('tags');
            //dd($new_tags);

            if ($new_tags != NULL) {
            	$post->tags()->sync($new_tags);
            } else {
            	$post->tags()->detach();
            }
        
            $post->save();
            
            return Redirect::to('admin/post')->with('success', 'Successfully updated post!');

        } // end else
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd('abc');
        $post = Post::findOrFail($id);
        $filename = $post->image_path;

        // Delete the image
        if (file_exists($filename)) {
            unlink($filename);
        }

        // Delete reference in pivot table
        $post->tags()->detach();

        $post->delete();

        return redirect::to('admin/post')->with('success', 'Successfully deleted post!');

        //$added = ['status' => 'success', 'msg' => 'Successfully deleted post.'];

        //return $added;
    }

    /**
     * Change resource status.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus() 
    {
        $id = Input::get('id');

        $post = Post::findOrFail($id);
        if ($post->content_html == '') {
            $post->content_html = MarkdownExtra::defaultTransform($post->content_raw);
        }
        $post->is_published = !$post->is_published;
        $post->published_at = Carbon::now();
        $post->save();

        return response()->json($post);
    }
}