<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Http\Requests\SendMessageRequest;
use Illuminate\Support\Facades\Auth;
use Session;
 
class MessageController extends Controller
{
    
 
    public function index()
    {
       

        if (Auth::user()->isAdmin){
             $messages =  Message::addSelect([
            'fullname' => User::select('fullnames') ->whereColumn('users.id', 'messages.user_id')
            ] )->get();   
        }else{
            $messages =  Message::addSelect([
                'fullname' => User::select('fullnames') ->whereColumn('users.id', 'messages.user_id')
                ] )->where('user_id', Auth::id())->get();
            
        }
     
       return view('mymessages', ['messages' => $messages, 'isAdmin' => Auth::user()->isAdmin]);
     
}

    public function newmessage()

    {
        return view('newmessage', ['isAdmin' => Auth::user()->isAdmin]);
    }

    public function store(SendMessageRequest $request)
    {
      

      $message = Message::create(
      $request->only('message')
        + [
            'user_id' =>   Auth::id()
        ]
    );

    return redirect("mymessages")->withSuccess('Message Successfully Sent');
    }
}
