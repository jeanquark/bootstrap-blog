<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

use Validator;
use View;
use Redirect;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('id', 'desc')->paginate(4);

        return View::make('admin.contact.index')
            ->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array (
            'name' => 'required|alpha|max:128',
            'email' => 'required|email',
            'message' => 'required|max:2048'
        );

        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
            return Redirect::to('contact')
                ->withErrors($validator)
                ->withInput();
        } else {
            $contact = new Contact;

            $contact->name = Input::get('name');
            $contact->email = Input::get('email');
            $contact->message = Input::get('message');

            $contact->save();

            return Redirect::route('admin.contact.index')->with('success', 'New Contact created!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return View::make('admin.contact.show')->with('contact', $contact);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $contact = Contact::findOrFail($id);

        $contact->delete();

        return redirect::to('admin/contact')->with('success', 'Successfully deleted message!');
    }
}
