<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //
    public function index(){
        if(Auth::user()->role !== 'admin'){
            $accounts = Account::where('user_id','=',Auth::id())->get();
            $totalincome = Account::where('user_id', Auth::id())->where('type','income')->sum('amount');
            $totalexpense = Account::where('user_id',Auth::id())->where('type','expense')->sum('amount');
            return view('dashboard',compact('accounts','totalincome','totalexpense'));
        }elseif(Auth::user()->role == 'admin'){
            $accounts = Account::paginate(4);
            $totalincome = Account::where('type','income')->sum('amount');
            $totalexpense = Account::where('type','expense')->sum('amount');
            return view('dashboard',compact('accounts','totalincome','totalexpense'));
        }
    }

    public function create_user(){
        $users = User::all();
        return view('user',compact('users'));
    }
    public function store(Request $request){
      $account = new Account();

      $account->user_id = Auth::id();
      $account->item= $request->item;
      $account->type = $request->type;
      $account->amount = $request->amount;

      $account->save();

        return back()->with('success','Account created successfully');
    }

    public function show_edit($id){
        $account = Account::find($id);

        return view('edit',compact('account'));
    }

    public function update(Request $request, $id){
        $account = Account::find($id);

        $account->item = $request->item;
        $account->type = $request->type;
        $account->amount =$request->amount;

        $account->update();

        return redirect('/dashboard')->with('success','updated successfully');

    }

    public function delete($id){
        $account = Account::find($id);
        $account->delete();

        return back()->with('success','deleted successfully');
    }

    public function store_user(Request $request){
        $user =new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = $request->password;

        $user->save();

        return back()->with('success','user created successfully');
    }

    public function delete_user($id){
        $account = User::find($id);
        $account->delete();

        return back()->with('success','deleted successfully');
    }
}
