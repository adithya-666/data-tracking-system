<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Room;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
class RegisterController extends Controller
{


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function index (){

        $room = Room::all();

     $data = [
        'room' => $room
     ];

        return View('auth.register', $data);
    }


    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'username' => ['required', 'string', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'role' => ['required'],
    //         'room' => ['required'],
    //         'last_active' => Carbon::now(),
    //         'update_at' => Carbon::now(),
    //         'created_at' => Carbon::now(),
    //     ]);
    // }

    public function create (Request $request)
    {
      
      $validator =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            'role' => ['required'],
            'room' => ['required'],   
        ]);
        $carbonInstance = Carbon::now();
        $formattedDate = $carbonInstance->format('Y-m-d H:i:s');
        $last_active = ['last_active' =>  $formattedDate];
      
        $create = array_merge($validator, $last_active);

        $create['password'] = Hash::make($create['password']);

        User::create( $create );

        $request->session()->flash('success', 'Registrasion Successfull');

        return redirect('/');

      
    }
    

}
