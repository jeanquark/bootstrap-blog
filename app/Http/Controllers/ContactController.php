<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

use Validator;
use Redirect;
use Input;
use View;

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
        $contact = Contact::findOrFail($id);

        $contact->delete();

        return redirect::to('admin/contact')->with('success', 'Successfully deleted message!');
    }

    /**
     * Change contact read status.
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