<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

use Activation;
use Validator;
use Redirect;
use Sentinel;
use Session;
use Input;
use View;
use Hash;

class UserController extends Controller
{
    use RegistersUsers;
    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected $rules = [
            'email' => 'required|email|max:254|unique:users,email',
            'name' => 'required|regex:/^[a-z ,.\'-]+$/i',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return View::make('admin.user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function create()
    {
        return View::make('admin.user.create');
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
            return Redirect::to('admin/user/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $user = new User;

            $user->email = Input::get('email');
            $user->name = Input::get('name');
            $user->password = bcrypt(Input::get('password'));

            $user->save();
        }

        return Redirect::Route('admin.user.index')->with('success', 'New User created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return View::make('admin.user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return View::make('admin.user.edit')->with('user', $user);
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
        $rules = array(
            'name' => 'min:2|max:32|regex:/^[a-z ,.\'-]+$/i',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/user/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $user = User::find($id);
            $user->name = Input::get('name');

            $user->save();

            return Redirect::to('admin/user')->with('success', 'Successfully updated user!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect::to('admin/user')->with('success', 'Successfully deleted user!');
    }
}