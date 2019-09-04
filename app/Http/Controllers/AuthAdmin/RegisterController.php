<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Admin;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {

        return view('authadmin.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($validator->fails()){
            return redirect()->back()->with('error','Insert All Fields');
        }else{

            $admins = new Admin();

            $admins ->name = $request->input('name');
            $admins ->email =$request->input('email');
            $password = $this->generatePassword();
            $admins ->password  = Hash::make($password);


            if($admins->save()){

                try{
                    //send mail with credentials to user
                    $name = $request['name'];
                    $email = $request['email'];
                    $detail ='Your Manager account has been updated.';
                    $year = date("Y");
                    $sender = "Mark";

                    $context=[

                        'name'=>$name,
                        'detail'=>$detail,
                        'password'=>$password,
                        'year'=>$year,
                        'sender'=>$sender

                    ];

                    Mail::send('authadmin.email.email',$context,
                        function ($message) use ($email){
                        $message -> to($email)->subject('Password');
                        $message->from('markgichohi24@gmail.com', 'Markariks');
                    });
                } catch ( \Exception $exception ) {
                    Log::error($exception);
                }

                return redirect()->route('admin.home')->with('success' , 'Admin '.$admins->name.' updated successfully');
            }else{
                return back()->withInput()->with('errors', ['unable to update Manager']);
            }


        }

    }

    public function send()
    {
        Mail::send(['text'=>'authadmin.email.email2'],['name',''],function ($message){
            $message -> to('kariukimarkg@yahoo.com','To Admin')->subject('Test Email');
            $message->from('markgichohi24@gmail.com', 'Markariks');
        });
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }




    function generatePassword($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }
}
