<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function StatusPost(Request $request)
    {
      $this->validate($request,[
          'status' => 'required|max:1000'
      ]);

      Auth::user()->statuses()->create([
         'body' => $request->input('status')
      ]);
      return redirect()
         ->route('home')
         ->with('info','Succesuful');
    }

    public function PostOut(Request $request, $statusId)
    {
      $this->validate($request,[
          "reply-{$statusId}"=> 'required|max:1000'
      ],[
          'required'=>'Обязятельно для заполнения'
      ]);

      $status = Status::notReply()->find($statusId);

      if(! $status ) redirect()->route('home');

      if(! Auth::user()->isFriend($status->user)
          && Auth::user()->id !== $status->user->id){
              return redirect()->route('home');
        }
        $reply = new Status();
        $reply->body = $request->input("reply-{$status->id}");
        $reply->user()->associate(Auth::user());
        
        $status->replies()->save($reply);

        return redirect()->back();
    }
}
