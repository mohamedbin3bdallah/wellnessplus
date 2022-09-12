<?php

namespace App\Http\Controllers;

use App\Messenger_message;
use App\Messenger_participant;
use App\Messenger_thread;
use App\User;
use App\Instructor;
use App\Notification;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Events\MessageSent;
use DB;


class MessagesController extends Controller
{
    /**
     * @var Pusher
     */

    public function __construct()
    {
        $this->middleware('auth');

    }


    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        // All threads, ignore deleted/archived participants
        $threads = Thread::getAllLatest()->get();

        // All threads that user is participating in
        // $threads = Thread::forUser(Auth::id())->latest('updated_at')->get();

        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages(Auth::id())->latest('updated_at')->get();

        return view('messenger.index', compact('threads'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', __('backend.updated_successfully', ['id'=>$id]));

            return redirect()->route('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        $userId = Auth::id();
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        return view('messenger.show', compact('thread', 'users'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return view('messenger.create', compact('users'));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        $input = Request::all();
        if ($input['message'] == null){
            session()->flash("error",__('backend.please_enter_your_message'));

            return redirect()->to('/find/tutor');
        }


        $user = User::find(Auth::user()->id);
        $user->fname= $input['fname'];
        $user->lname= $input['lname'];
        $user->save();

        $thread = Messenger_thread::create(
            [
                //'subject' => $input['subject'],
                'subject' => 'Message To Tutor',

            ]
        );

        // Recipients
        if (Request::has('recipientId')) {
           
            $instructor = Instructor::find($input['recipientId']);
            $receipientUser = User::find($instructor->user_id);

            
            // Message
            $message = Messenger_message::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => $receipientUser->id,
                    'sender_id' => Auth::user()->id,
                    'body'      => $input['message'],
                ]
            );

            Messenger_participant::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => $receipientUser->id,
                    'sender_id' => Auth::user()->id,
                    'last_read' => new Carbon,
                ]);

            $notification = new Notification;
            $notification->type = 6;
            $notification->notifiable_type  = "Instructor" ;
            $notification->notifiable_id  = $receipientUser->id;
            $notification->data  = __('backend.you_have_a_new_message');
            $notification->save();

            $broadcast = event(new MessageSent($receipientUser, $message));

        }

        \Session::flash('flash_message_success', __('backend.sent_successfully'));

        return redirect()->back();
    }

    public function studentMessage(Request $request)
    {
        $input = Request::all();
        if ($input['message'] == null){
            session()->flash("error",__('backend.please_enter_your_message'));

            return redirect()->to('/find/tutor');
        }


        $user = User::find(Auth::user()->id);
        $user->fname= $input['fname'];
        $user->lname= $input['lname'];
        $user->save();

        $thread = Messenger_thread::create(
            [
                //'subject' => $input['subject'],
                'subject' => ($user->role == 'user')? __('backend.message_to_tutor'):__('backend.message_to_student'),

            ]
        );

        // Recipients
        if (Request::has('recipientId')) {
           
            $receipientUser = User::find($input['recipientId']);

            
            // Message
            $message = Messenger_message::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => $receipientUser->id,
                    'sender_id' => Auth::user()->id,
                    'body'      => $input['message'],
                ]
            );

            Messenger_participant::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => $receipientUser->id,
                    'sender_id' => Auth::user()->id,
                    'last_read' => new Carbon,
                ]);

            $notification = new Notification;
            $notification->type = 6;
            $notification->notifiable_type  = "Instructor" ;
            $notification->notifiable_id  = $receipientUser->id;
            $notification->data  = __('backend.you_have_a_new_message');
            $notification->save();

            $broadcast = event(new MessageSent($receipientUser, $message));

        }
        \Session::flash('flash_message_success', __('backend.sent_successfully'));

        return redirect()->back();
    }
    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', __('backend.updated_successfully', ['id'=>$id]));

            return redirect('messages');
        }

        $thread->activateAllParticipants();

        // Message
        $message = Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => Input::get('message'),
            ]
        );

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipants(Input::get('recipients'));
        }

        $this->oooPushIt($message);

        return redirect()->route('messages.show', $id);
    }


    /**
     * Send the new message to Pusher in order to notify users.
     *
     * @param Message $message
     */
    protected function oooPushIt(Message $message)
    {
//        $thread = $message->thread;
//        $sender = $message->user;
//
//        $data = [
//            'thread_id' => $thread->id,
//            'div_id' => 'thread_' . $thread->id,
//            'sender_name' => $sender->first_name,
//            'thread_url' => route('messages.show', ['id' => $thread->id]),
//            'thread_subject' => $thread->subject,
//            'html' => view('frontend.homePage', compact('message'))->render(),
//            'text' => str_limit($message->body, 50),
//        ];
//
//        $recipients = $thread->participantsUserIds();
//        if (count($recipients) > 0) {
//            foreach ($recipients as $recipient) {
//                if ($recipient == $sender->id) {
//                    continue;
//                }
//
//                $this->pusher->trigger('for_user_' . $recipient, 'new_message', $data);
//            }
//        }
    }



    /**
     * Mark a specific thread as read, for ajax use.
     *
     * @param $id
     */
    public function read($id)
    {
        $thread = Thread::find($id);
        if (!$thread) {
            abort(404);
        }

        $thread->markAsRead(Auth::id());
    }

    /**
     * Get the number of unread threads, for ajax use.
     *
     * @return array
     */
    public function unread()
    {
        $count = Auth::user()->newMessagesCount();

        return ['msg_count' => $count];
    }
	
	
	/**
     * Show all of the messages - Dashboard.
     *
     * @return view
     */
    public function allMessages()
    {
        return view('admin.messages.index');
    }
	
	/**
	* Get Messages
	*/
	public function getMessages(\Illuminate\Http\Request $request)
    {
        $columns = array(
            0 =>'messenger_threads.id', 
            1 =>'sender.fname',
            2 => 'receiver.fname',
            3 => 'messenger_threads.subject',
			4 => 'messenger_messages.body',
			5 => 'messenger_messages.is_read',
			6 => 'messenger_threads.created_at',
        );
		
		$query = DB::table('messenger_threads')
				->leftJoin('messenger_messages', 'messenger_threads.id', '=', 'messenger_messages.thread_id')
				->leftJoin('users as sender', 'messenger_messages.sender_id', '=', 'sender.id')
				->leftJoin('users as receiver', 'messenger_messages.user_id', '=', 'receiver.id')
				->select('sender.fname as fnamesender','sender.lname as lnamesender','receiver.fname as fnamereceiver','receiver.lname as lnamereceiver','messenger_messages.thread_id as thread_id','messenger_messages.is_read as is_read','messenger_messages.body as body','messenger_threads.id as id','messenger_threads.subject as subject','messenger_threads.created_at as created_at');

		$totalData = $query->count();
		$totalFiltered = $totalData; 
		
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
				
		if(!empty($request->input('search.value')))
		{
			$search = $request->input('search.value');
			$query->where(function($q) use ($search) {
					$q->where('messenger_threads.subject', 'LIKE', "%{$search}%")
					  ->orWhereDate('messenger_threads.created_at', 'LIKE', "%{$search}%")
					  ->orWhere('messenger_messages.body', 'LIKE', "%{$search}%")
					  ->orWhere('sender.fname', 'LIKE', "%{$search}%")
					  ->orWhere('sender.lname', 'LIKE',"%{$search}%")
					  ->orWhere('sender.email', 'LIKE',"%{$search}%")
					  ->orWhere('receiver.fname', 'LIKE',"%{$search}%")
					  ->orWhere('receiver.lname', 'LIKE',"%{$search}%")
					  ->orWhere('receiver.email', 'LIKE',"%{$search}%");
			});
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {
                $nestedData['id'] = ++$start;
				$nestedData['subject'] = $single->subject;
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($single->created_at));
				$nestedData['sender'] = $single->fnamesender.' '.$single->lnamesender;
				$nestedData['receiver'] = $single->fnamereceiver.' '.$single->lnamereceiver;
				$nestedData['budy'] = $this->textDiv($single->body, 55);
				if($single->is_read) $nestedData['read'] = '<span class="label label-success">'.__('adminstaticword.readed').'</span>';
				elseif($single->thread_id) $nestedData['read'] = '<span class="label label-danger">'.__('adminstaticword.notreaded').'</span>';
				else $nestedData['read'] = '<span class="label label-default">'.__('adminstaticword.notsent').'</span>';
				
				$data[] = $nestedData;
            }
        }
		
		$json_data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
            
        echo json_encode($json_data); 
    }
	
	/*
	** Divide text into lines
	*/
	public function textDiv($text, $lineLength)
	{
		$words = explode(' ', $text);
		$currentLength = 0;
		$index = 0;
		$output[$index] = '';
		
		foreach ($words as $word)
		{
			// +1 because the word will receive back the space in the end that it loses in explode()
			$wordLength = strlen($word) + 1;
			
			if (($currentLength + $wordLength) <= $lineLength)
			{
				$output[$index] .= $word . ' ';
				$currentLength += $wordLength;
			}
			else
			{
				$index += 1;
				$currentLength = $wordLength;
				$output[$index] = $word;
			}
		}
		
		return implode('</br>', $output);
	}
	
	/*public function getMessages(\Illuminate\Http\Request $request)
    {
        $columns = array(
            0 =>'id', 
            1 =>'sender',
            2 => 'receiver',
            3 => 'subject',
			4 => 'body',
			5 => 'read',
			6 => 'created_at',
        );
		
		$query = Messenger_thread::with('message');

		$totalData = $query->count();
		$totalFiltered = $totalData; 
		
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
				
		if(!empty($request->input('search.value')))
		{
			$search = $request->input('search.value');
			$query->where(function($q) use ($search) {
				$q->where('subject', 'LIKE', "%{$search}%")
				  ->orWhereDate('created_at', 'LIKE', "%{$search}%")
				  ->orWhereHas('message', function($qq) use ($search) {
					$qq->where('body', 'LIKE',"%{$search}%")
					   ->orWhereHas('sender', function($qqq) use ($search) {
						 $qqq->where('fname', 'LIKE',"%{$search}%")
							 ->orWhere('lname', 'LIKE',"%{$search}%")
							 ->orWhere('email', 'LIKE',"%{$search}%");
					   })
					   ->orWhereHas('receiver', function($qqq) use ($search) {
						 $qqq->where('fname', 'LIKE',"%{$search}%")
							 ->orWhere('lname', 'LIKE',"%{$search}%")
							 ->orWhere('email', 'LIKE',"%{$search}%");
					   });
				  });
			});
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {
                $nestedData['id'] = ++$start;
				$nestedData['subject'] = $single->subject;
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($single->created_at));
				
				if((isset($single->message)))
				{
					$nestedData['sender'] = (isset($single->message->sender))? $single->message->sender->fname.' '.$single->message->sender->lname:'';
					$nestedData['receiver'] = (isset($single->message->receiver))? $single->message->receiver->fname.' '.$single->message->receiver->lname:'';
					$nestedData['budy'] = $single->message->body;
					$nestedData['read'] = ($single->message->is_read)? '<span class="label label-success">'.__('adminstaticword.readed').'</span>':'<span class="label label-danger">'.__('adminstaticword.notreaded').'</span>';
				}
				else
				{
					$nestedData['sender'] = '';
					$nestedData['receiver'] = '';
					$nestedData['budy'] = '';
					$nestedData['read'] = '<span class="label label-default">'.__('adminstaticword.notsent').'</span>';
				}
				
				$data[] = $nestedData;
            }
        }
		
		$json_data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
            
        echo json_encode($json_data); 
    }*/


}
