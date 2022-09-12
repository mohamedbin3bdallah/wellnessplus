<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
    	$notification = Auth()->User()->unreadNotifications->where('id', $id)->markAsRead();
        return back();
    }

    public function delete()
    {
        
        $notifications = Auth()->User()->notifications()->get();

        foreach($notifications as $notification) {

            $notification->delete();
            
        }

        return back();
    }

    public function markRead()
    {
    	DB::table('notifications')->where('notifiable_id', \Auth::User()->id )->update( [ 'read_at' => Carbon::now() ]); 
    	DB::table('messenger_messages')->where('user_id', \Auth::User()->id )->update( [ 'is_read' => 1 ]); 
        return response()->json([
            'success' => 'true',
        ]);
    }
}
