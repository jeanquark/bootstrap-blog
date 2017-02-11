<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Controllers\Controller;
use App\Contact;
use App\User;
use App\Post;

use Hashids\Hashids;
use Validator;
use Redirect;
use Response;
use Input;
use View;
use Mail;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */


    /**
     * Display all published posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $posts = Post::where('is_published', '=', true)->orderBy('published_at', 'desc')->simplePaginate(2);

        $hashids = new Hashids();

        return View::make('home')
            ->with('posts', $posts)
            ->with('hashids', $hashids);

    }

    /**
     * Display the about page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about() {

        return View::make('about');

    }

    /**
     * Display the services page.
     *
     * @return \Illuminate\Http\Response
     */
    public function services() {

        return View::make('services');

    }

    /**
     * Display the contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact() {

        return View::make('contact');

    }


    /**
     * Validate and process the contact form.
     *
     * @return \Illuminate\Http\Response
     */
    public function store_contact() {

        $rules = array (
            'name' => 'required|max:128|regex:/^[a-z ,.\'-]+$/i',
            'email' => 'required|email',
            'message' => 'required|max:2048|regex:/^[a-z0-9 ,.\'-]+$/i'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('contact')
                ->withErrors($validator)
                ->withInput();
        } else {
            $contact = new Contact;

            $contact->name = Input::get('name');
            $contact->email = Input::get('email');
            $contact->message = Input::get('message');
            $contact->is_read = false;

            $contact->save();


            // Send an email:
            /*$data = Input::all();
            $data['messageLines'] = explode("\n", Input::get('message'));
            
            Mail::send('emails.contact', $data, function ($message) use ($data) {
                $message->from('bootstap-blog@app.com', 'Message from your bootstrap-blog');

                $message->to(getenv('MAIL_USERNAME'))->subject('Message from your bootstrap-blog');
            });*/


            return Redirect::route('contact')->with('success', 'Your message has been successfully sent. Thank you!');

        } //end if
    }

    /**
     * Change contact status.
     *
     * @return \Illuminate\Http\Response
     */
    public function readStatus() 
    {
        $id = Input::get('id');

        $contact = Contact::findOrFail($id);

        $contact->is_read = !$contact->is_read;
        $contact->save();

        return response()->json($contact);
    }
}