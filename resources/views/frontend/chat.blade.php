@extends('frontend.layouts.layout')
@section('title', __('frontend.messages'))
@section('pageContent')
<script
   src="https://code.jquery.com/jquery-3.6.0.min.js"
   integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
   crossorigin="anonymous"></script>
<style>
   .container{max-width:1170px; margin:auto;}
   img{ max-width:100%;}
   .inbox_people {
   background: #f8f8f8 none repeat scroll 0 0;
   float: left;
   overflow: hidden;
   width: 40%; border-right:1px solid #c4c4c4;
   }
   .inbox_msg {
   border: 1px solid #c4c4c4;
   clear: both;
   overflow: hidden;
   }
   .top_spac{ margin: 20px 0 0;}
   .recent_heading {float: left; width:40%;}
   .srch_bar {
   display: inline-block;
   text-align: right;
   width: 60%; padding:
   }
   .headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}
   .recent_heading h4 {
   color: #05728f;
   font-size: 21px;
   margin: auto;
   }
   .srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
   .srch_bar .input-group-addon button {
   background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
   border: medium none;
   padding: 0;
   color: #707070;
   font-size: 18px;
   }
   .srch_bar .input-group-addon { margin: 0 0 0 -27px;}
   .chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
   .chat_ib h5 span{ font-size:13px; float:right;}
   .chat_ib p{ font-size:14px; color:#989898; margin:auto}
   .chat_img {
   float: left;
   width: 11%;
   }
   .chat_ib {
   float: left;
   padding: 0 0 0 15px;
   width: 88%;
   }
   .chat_people{ overflow:hidden; clear:both;}
   .chat_list {
   border-bottom: 1px solid #c4c4c4;
   margin: 0;
   padding: 18px 16px 10px;
   }
   .inbox_chat { height: 550px; overflow-y: scroll;}
   .active_chat{ background:#ebebeb;}
   .incoming_msg_img {
   display: inline-block;
   width: 6%;
   }
   .received_msg {
   display: inline-block;
   padding: 0 0 0 10px;
   vertical-align: top;
   width: 92%;
   }
   .received_withd_msg p {
   background: #ebebeb none repeat scroll 0 0;
   border-radius: 3px;
   color: #646464;
   font-size: 14px;
   margin: 0;
   padding: 5px 10px 5px 12px;
   width: 100%;
   }
   .time_date {
   color: #747474;
   display: block;
   font-size: 12px;
   margin: 8px 0 0;
   }
   .received_withd_msg { width: 57%;}
   .mesgs {
   float: left;
   padding: 30px 15px 0 25px;
   width: 100%;
   }
   .sent_msg p {
   background: #05728f none repeat scroll 0 0;
   border-radius: 3px;
   font-size: 14px;
   margin: 0; color:#fff;
   padding: 5px 10px 5px 12px;
   width:100%;
   }
   .outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
   .sent_msg {
   float: right;
   width: 46%;
   }
   .input_msg_write input {
   background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
   border: medium none;
   color: #4c4c4c;
   font-size: 15px;
   min-height: 48px;
   width: 100%;
   }
   .type_msg {border-top: 1px solid #c4c4c4;position: relative;}
   .msg_send_btn {
   background: #05728f none repeat scroll 0 0;
   border: medium none;
   border-radius: 50%;
   color: #fff;
   cursor: pointer;
   font-size: 17px;
   height: 33px;
   position: absolute;
   right: 0;
   top: 11px;
   width: 33px;
   }
   .messaging { padding: 0 0 50px 0;}
   .msg_history {
   height: 400px;
   overflow-y: auto;
   }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
<div class="container">
   <h5>  {{ __('frontend.messages').' '.__('frontend.with') }} {{$user->fname}} {{$user->lname}} </h5>
   <div class="messaging">
      <div class="inbox_msg">
         <div class="mesgs">
            <div class="msg_history" id="out">
               @if(count($messages) > 0 )
               @foreach($messages as $message)
               @if($message->user_id == Auth::user()->id)
               <div class="incoming_msg">
                  <div class="incoming_msg_img"><img src="@if($message->user->user_img == null) /frontAssets/images/profile-1.png @else {{ url('/images/user_img/'.$message->user->user_img) }} @endif"
                     alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}" />
                  </div>
                  <div class="received_msg">
                     <div class="received_withd_msg">
                        <p>{{$message->body}}</p>
                        <span class="time_date">{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</span>
                     </div>
                  </div>
               </div>
               @else
               <div class="outgoing_msg">
                  <div class="sent_msg">
                     <p>{{$message->body}}</p>
                     <span class="time_date">{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</span>
                  </div>
               </div>
               @endif
               @endforeach
               @endif
            </div>
            <div class="type_msg">
               <div class="input_msg_write">
                  <form action="{{ route('send.message') }}" method="POST">
                     @csrf
                     <input type="hidden" value="{{$user->id}}" name="reciever_id" />
                     <input type="text" class="write_msg" id="messageTextArea" name="message" placeholder="{{ __('frontend.type_a_message') }}" required />
                     <button class="msg_send_btn" id="message_submit" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                     <div class="alert alert-danger" role="alert" id="warning">{{ __('frontend.type_a_message_text') }} <a href="{{url('terms_condition')}}" title="Terms">{{ __('frontstaticword.Terms&Condition') }}</a>
                  </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   var out = document.getElementById("out");
   // allow 1px inaccuracy by adding 1
   var isScrolledToBottom = out.scrollHeight - out.clientHeight <= out.scrollTop + 1;

   // filter message for links , urls , numbers

   function detectURLs(message) {
     var urlRegex = /(((https?:\/\/)|(www\.))[^\s]+)/g;
     return message.match(urlRegex)
   }

   function detectNumber(number) {
       var matches = number.match(/\d+/g);
       if (matches != null) {
           return true;
       }
   }

   var searchWords = ["gmail", "outlook" , "yahoo "  , "hotmail" , "facebook" , "contact"];

   function searchStringInArray (str, strArray) {
       for (var j=0; j<strArray.length; j++) {
           if (strArray[j].match(str)) return j;
       }
       return -1;
   }

   (function($){
   $( document ).ready(function() {
     $('#out').scrollTop($('#out')[0].scrollHeight);

       $( "#warning" ).hide();
       $('#messageTextArea').keyup(function () {
           text = $('#messageTextArea').val();
           if(detectURLs(text) ){
               $("#message_submit").prop("disabled", true);
           }else{
               $("#message_submit").removeAttr('disabled');
           }

           var array_of_words = text.split(" ");

           for (var j=0; j<array_of_words.length; j++) {
               var word = array_of_words[j].toLowerCase();
               if( (word == "@") || (detectNumber(word)) ){
                   $( "#warning" ).show();
                   $("#message_submit").prop("disabled", true);
               }
               if((word.length > 4) ){
                   if( searchStringInArray( word , searchWords) != -1 ){
                       $( "#warning" ).show();
                       $("#message_submit").prop("disabled", true);
                   }else{
                       $( "#warning" ).hide();
                       $("#message_submit").removeAttr('disabled');
                   }
               }
               // check for special characters
               var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

               if(format.test(word)){
                   $( "#warning" ).show();
                   $("#message_submit").prop("disabled", true);
               }
           }
       });
   });
   })(jQuery);
</script>
@endsection
