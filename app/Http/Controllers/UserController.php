<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Session;

class UserController extends Controller
{
    public function getSignup()
    {
        return view('user.signup');
    }

    public function postSignup(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'password' => 'required|min:4'
        ]);

        $user = new User([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        $user->save();

        Auth::login($user);

        if (Session::has('oldUrl')) {
            $oldUrl = Session::get('oldUrl');
            Session::forget('oldUrl');

            return redirect()->to($oldUrl);
        }

        return redirect()->route('user.profile');
        
    }

    public function getSignin()
    {
       
        return view('user.signin');
    }

    public function postSignin(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required|min:4'
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            if (Session::has('oldUrl')) {
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                #dd($oldUrl);
                return redirect()->to($oldUrl);
            }
            return redirect()->route('user.profile');
            #return redirect()->route('checkout');
        }
        return redirect()->back();
    }

    public function getProfile() {
        $totalCost =0;
        if(!Auth::user()->orders == null){
        $orders = Auth::user()->orders;
       
        $allOrders = array();
        $subset = $orders->map(function ($user) {
            return collect($user->toArray())
                ->only(['cart',])
                ->all();
        });
           
            // $subset = unserialize($subset);
           foreach($subset as $element => $inner_array){
            foreach($inner_array as $item){
            $item = unserialize($item);
            $items[] = $item;
            // foreach ($item as $key => $value) {
            //     $totalCost += $value['price'];
                
            // }
            
            }

           }
           $orders = $items;
           
           return view('user.profile', ['orders' => $orders]);
        }
        $orders = Auth::user()->orders;
        
        return view('user.profile', ['orders' => $orders]);
    }
    
    public function getLogout() {
        Auth::logout();
        return redirect()->to('/cart');
    }
}
