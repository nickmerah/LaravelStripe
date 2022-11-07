<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Events\UserUpdatedEvent;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Session;

class UsersController extends Controller
{



    public function alluser(Request $request)
  {
    $status = $request->input('ustatus');
    if ($status==""){
        $users = User::where('isAdmin',  0)->get();
    }else{
        $users = User::where('isActive', $status)->where('isAdmin',  0)->get();
    }
    
        return view('users', ['users' => $users, 'isAdmin' => Auth::user()->isAdmin ]);
  }


  public function userdetails($id){

  
    try{
        $userdetail = User::findorfail($id);  
        // $userdetail->load(['hh']);
    }catch (\Exception $exception){
      //  dd(get_class($exception));
        return view('welcome');

    }
    
 
    if (!empty($userdetail)) {

        $messages = Message::where('user_id', $id)->get();
  
         return view('usersdetails', ['user' => $userdetail, 'messages' => $messages, 'isAdmin' => Auth::user()->isAdmin ]);

    }
    return redirect()->intended('dashboard')->withError('User does not Exist');
    
  }


  public function userupdate($uid,$id){

    $userdetail = User::find($uid);  
 
    if (!empty($userdetail)) {
        if ($id == 0){
        $pid = 1 ;
        }elseif ($id == 1){
         $pid = 0 ;
        }else{
          $pid = 0 ;
        }
        $userdetail->isActive = $pid;
 	    $userdetail->save();
       //send message to user via an event 
        event(new UserUpdatedEvent($userdetail));

      return redirect()->intended('users')->withSuccess('User Status Successfully Updated');

      }
       return redirect()->intended('dashboard')->withError('User does not Exist');
    }
    
  }  
    
  

