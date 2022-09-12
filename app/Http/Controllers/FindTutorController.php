<?php

namespace App\Http\Controllers;

use App\Allcountry;
use App\AllLanguages;
use App\Appointment;
use App\Favourites;
use App\Instructor;
use App\ReviewRating;
use App\Specialties;
use App\Time_zone;
use App\CountryCurrency;
use App\EuroExchangeRate;
use App\tutorCertificate;
use App\tutorEducation;
use App\tutorWorkExperience;
use App\PartnerStudent;
use Carbon\Carbon;
use Faker\Provider\ka_GE\DateTime;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Http;
use Auth;
use App\SearchLog;
use Session;
use Cache;


class FindTutorController extends Controller
{	
	public function getTutorSlots()
	{
		$slots_alert = __('backend.slots_alert');
		$tutor = Instructor::with('user','languages', 'schedule', 'favourite', 'bookedSlots', 'reviews')->where(['id'=>$_GET['tutor_id']])->first();
		$html = '<script>(function($){$(".responsive").slick({ infinite: false, }); $(document).ready(function () { $("#checkBtn").click(function() { checked = $("input[type=checkbox]:checked").length; if(!checked) { alert("'.$slots_alert.'"); return false; } }); }); $(".clo-item").on("click", function() { $(".bookingModal").removeClass("active"); });})(jQuery);</script>';
		$html .= '<div class="modal-content"><button class="close clo-item" type="button"><svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg"><path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path></svg></button><div class="photo" style="margin-top: -30px !important;"><img src="'.url('/images/user_img/'.$tutor->user->user_img).'" class="bookingImage" alt="" title=""></div><div class="text-center mt-4"><h3 class="title">'.__('backend.instant_booking').'</h3><p class="mt-2">'.__('backend.tutor_slots_text').'</p></div><form action="/slots/appointment" method="get" enctype="multipart/form-data" class="bookingForm" onsubmit="myButton.disabled = true;" id="slots_form">';

        $time_zone = \App\Time_zone::find($tutor->user->time_zone_id);
        $time_offs = \App\TutorTimeOff::where('tutor_id', $tutor->id )->where('end_date' , '>=' ,  \Carbon\Carbon::now()->format('Y-m-d') )->get();

        $html .= '<div class="responsive">';
        
		$week = 0;
        $dayOfMonth = substr(\Carbon\Carbon::today(), 8,2 );
        $origDate = \Illuminate\Support\Carbon::now();
        $i = \Illuminate\Support\Carbon::now();
        
		while($week < 4)
		{
			$week_first_day = $origDate->format('d');
			$week_first_month = $origDate->format('F');
			$week_first_year = $origDate->format('Y');
			$week_last_date = $origDate->addDay(6);
			$week_last_day = $week_last_date->format('d');
			$week_last_month = $week_last_date->format('F');
			$week_last_year = $week_last_date->format('Y');
			
			//$html .= '<div><div class="between"><p class="day-ma">'.substr($origDate, 0, 10).' TO '.substr($origDate->addDay(6),0, 10).'</p><p class="timezone"><i class="fas fa-globe-americas"></i> Times are shown in your local timezone </p><p class="textsacand"><i class="fas fa-info-circle"></i> At least 2 days notice between the schedule and your first lesson</p></div><div class="num-book"><div class="row">';
			$html .= '<div><div class="between"><p class="day-ma">'.$week_first_day.' '.__('frontend.'.$week_first_month).' '.$week_first_year.' '.__('frontend.to').' '.$week_last_day.' '.__('frontend.'.$week_last_month).' '.$week_last_year.'</p><p class="timezone"><i class="fas fa-globe-americas"></i> '.__('backend.tutor_slots_week_text_1').' </p><p class="textsacand"><i class="fas fa-info-circle"></i> '.__('backend.tutor_slots_week_text_2').'</p></div><div class="num-book"><div class="row">';
			//$html .= '<select name="slots[]" multiple>';

            $dayOfWeek = \Carbon\Carbon::today();
            
			while($dayOfWeek < \Carbon\Carbon::today()->addDay(7))
			{
                $html .= '<div class="col innerbook"><div class="innernum active"><p class="sat active">'.__('frontstaticword.'.$dayOfWeek->format('l')).'</p><div class="numb dayOfMonth"> '.$dayOfMonth.'</div>';

                foreach($tutor->schedule as $schedule)
				{
                    if($schedule->day == $dayOfWeek->format('l'))
					{
                        //$html .= '<nav class="listnum">';
                        $currentTime = $schedule->getOriginal()['start_time'];
                        $currentDate= $i->format('Y-m-d');
                        
						while($currentTime < $schedule->getOriginal('end_time'))
						{
                            $bookedFlag = false;
                            $passedFlag = false;
                            $time_zone = \App\Time_zone::find($tutor->user->time_zone_id);

                            $slot_time = date(" H:i:s", strtotime("$currentTime"));

                            $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d'). $slot_time , $time_zone->time_zone_name )->setTimezone(session('currentTimeZoneName') );
                            $correct_time1 = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');

                            if($currentDate ==  \Illuminate\Support\Carbon::today()->timezone((session('currentTimeZoneName') ))->format('Y-m-d')  && $correct_time1 < \Illuminate\Support\Carbon::now()->timezone((session('currentTimeZoneName') ))->format('H:i:s'))
							{
                                $passedFlag = true;
							}
                            
							foreach($tutor->bookedSlots as $bookedSlot)
							{
                                //if(substr($currentTime, 0, 8) == $bookedSlot->getOriginal()['start_time'] && date('Y-m-d',strtotime(substr(\Illuminate\Support\Carbon::now(), 0,8).$dayOfMonth)) == $bookedSlot->date)
								if(substr($currentTime, 0, 8) == $bookedSlot->getOriginal()['start_time'] && $currentDate == $bookedSlot->date)
								{
                                    $bookedFlag = true;
								}
							}

                            if($bookedFlag == false)
							{
                                if($time_zone != null )
								{
                                    $slot_time = date(" H:i:s", strtotime("$currentTime"));
                                    $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d'). $slot_time , $time_zone->time_zone_name )->setTimezone(session('currentTimeZoneName') );
                                    $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');
                                }
								else
								{
                                    $correct_time = "";
                                }
                                
								foreach ($time_offs as $time_off)
								{
                                    if($time_off != null)
									{
                                        $start_date_time = \Carbon\Carbon::parse($time_off->start_date . ' ' .$time_off->start_time )->format('Y-m-d H:i:s');
                                        $end_date_time = \Carbon\Carbon::parse($time_off->end_date . ' ' .$time_off->end_time )->format('Y-m-d H:i:s');
                                        $session_time = \Carbon\Carbon::parse($currentDate . ' ' . $correct_time)->format('Y-m-d H:i:s') ;
                                        if( ($session_time > $start_date_time) && ($session_time < $end_date_time))
										{
                                            $correct_time = "";
                                        }
                                    }
								}

                                if($passedFlag == false)
								{
                                    //$html .= '<option  value="'.$tutor->id.','.$currentDate.','.substr($currentTime, 0, 5).'"> '.$correct_time.' </option>';
									$html .= '<li id="ck-button" class="active" onmouseover="" style="cursor: pointer;"><label class="required"><input type="checkbox" name="slots[]" value="'.$tutor->id.','.$currentDate.','.substr($currentTime, 0, 5).'"><span> '.$correct_time.' </span></label></li>';
								}
							}
							else
							{
                                //$html .= '<option class="active">Booked</option>';
								$html .= '<li id="ck-book" class="active"><label><span>'.__('backend.booked').'</span></label></li>';
							}

                            $currentTime = date("H:i:s", strtotime("$currentTime +1 hour"));
						}
                        //$html .= '</nav>';
					}
				}
				
                $html .= '</div></div><div><button type="submit" id="submitBooking" class="submitBooking" name="myButton" hidden="hidden">'.__('frontend.search').'</button></div>';
                $dayOfWeek->addDay(1);
                if($dayOfMonth < substr(\Carbon\Carbon::now()->endOfMonth(), 8,2))
				{
                    $dayOfMonth++;
				}
				else
				{
                    $dayOfMonth = 1;
				}
                $i = $i->addDay(1);
			}
            $html .= '</div></div></div>';
            $week++;
            $origDate->addDay(1);
			//$html .= '</select>';
		}
		
        $html .= '</div><div class="bot-de bot-card modal_sticky_footer"><button type="submit" class="bottom booknow" id="checkBtn">'.__('frontend.submit').'</button><span class="bottom clo-item">'.__('frontend.cancel').' </span></div></form></div>';
		echo $html;
	}
	
	/*public function getTutorSlots()
	{
		$tutor = Instructor::with('user','languages', 'schedule', 'favourite', 'bookedSlots', 'reviews')->where(['id'=>$_GET['tutor_id']])->first();
		$html = '<script>$(".responsive").slick({ infinite: false, }); $(".bookingData").on("click", function() { var time = $(this).attr("slotTime"); var day = $(".day").text(); var selectedDate = $(this).attr("selectedDate"); document.getElementById("date").value = selectedDate; document.getElementById("time").value = time; currentActionURL = $(".bookingForm").attr("action"); updatedActionURL = currentActionURL + '.$_GET['tutor_id'].' + "/" + selectedDate + "/" + time; $(".bookingForm").attr("action", updatedActionURL); $("#submitBooking").click(); $(".submitBooking").prop("disabled", true); }); $(".clo-item").on("click", function() { $(".bookingModal").removeClass("active"); }); </script>';
		$html .= '<div class="modal-content"><button class="close clo-item" type="button"><svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg"><path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path></svg></button><div class="photo" style="margin-top: -30px !important;"><img src="'.url('/images/user_img/'.$tutor->user->user_img).'" class="bookingImage" alt="" title=""></div><div class="text-center mt-4"><h3 class="title">Instant Booking</h3><p class="mt-2"> Check tutors vacant hours and choose what suits you </p></div><form action="/course/appointment/" method="post" enctype="multipart/form-data" class="bookingForm" onsubmit="myButton.disabled = true;"><input type="hidden" name="_token" value="'.csrf_token().'" />';

        $time_zone = \App\Time_zone::find($tutor->user->time_zone_id);
        $time_offs = \App\TutorTimeOff::where('tutor_id', $tutor->id )->where('end_date' , '>=' ,  \Carbon\Carbon::now()->format('Y-m-d') )->get();

        $html .= '<div class="responsive">';
        
		$week = 0;
        $dayOfMonth = substr(\Carbon\Carbon::today(), 8,2 );
        $origDate = \Illuminate\Support\Carbon::now();
        $i = \Illuminate\Support\Carbon::now();
        
		while($week < 4)
		{
			$html .= '<div><div class="between"><p class="day-ma">'.substr($origDate, 0, 10).' TO '.substr($origDate->addDay(6),0, 10).'</p><p class="timezone"><i class="fas fa-globe-americas"></i> Times are shown in your local timezone </p><p class="textsacand"><i class="fas fa-info-circle"></i> At least 2 days notice between the schedule and your first lesson</p></div><div class="num-book"><div class="row">';

            $dayOfWeek = \Carbon\Carbon::today();
            
			while($dayOfWeek < \Carbon\Carbon::today()->addDay(7))
			{
                $html .= '<div class="col innerbook"><div class="innernum active"><p class="sat active">'.substr($dayOfWeek->format('l'), 0, 3).'</p><div class="numb dayOfMonth"> '.$dayOfMonth.'</div>';

                foreach($tutor->schedule as $schedule)
				{
                    if($schedule->day == $dayOfWeek->format('l'))
					{
                        $html .= '<nav class="listnum">';
                        $currentTime = $schedule->getOriginal()['start_time'];
                        $currentDate= $i->format('Y-m-d');
                        
						while($currentTime < $schedule->getOriginal('end_time'))
						{
                            $bookedFlag = false;
                            $passedFlag = false;
                            $time_zone = \App\Time_zone::find($tutor->user->time_zone_id);

                            $slot_time = date(" H:i:s", strtotime("$currentTime"));

                            $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d'). $slot_time , $time_zone->time_zone_name )->setTimezone(session('currentTimeZoneName') );
                            $correct_time1 = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');

                            if($currentDate ==  \Illuminate\Support\Carbon::today()->timezone((session('currentTimeZoneName') ))->format('Y-m-d')  && $correct_time1 < \Illuminate\Support\Carbon::now()->timezone((session('currentTimeZoneName') ))->format('H:i:s'))
							{
                                $passedFlag = true;
							}
                            
							foreach($tutor->bookedSlots as $bookedSlot)
							{
                                if(substr($currentTime, 0, 8) == $bookedSlot->getOriginal()['start_time'] && date('Y-m-d',strtotime(substr(\Illuminate\Support\Carbon::now(), 0,8).$dayOfMonth)) == $bookedSlot->date)
								{
                                    $bookedFlag = true;
								}
							}

                            if($bookedFlag == false)
							{
                                if($time_zone != null )
								{
                                    $slot_time = date(" H:i:s", strtotime("$currentTime"));
                                    $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d'). $slot_time , $time_zone->time_zone_name )->setTimezone(session('currentTimeZoneName') );
                                    $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');
                                }
								else
								{
                                    $correct_time = "";
                                }
                                
								foreach ($time_offs as $time_off)
								{
                                    if($time_off != null)
									{
                                        $start_date_time = \Carbon\Carbon::parse($time_off->start_date . ' ' .$time_off->start_time )->format('Y-m-d H:i:s');
                                        $end_date_time = \Carbon\Carbon::parse($time_off->end_date . ' ' .$time_off->end_time )->format('Y-m-d H:i:s');
                                        $session_time = \Carbon\Carbon::parse($currentDate . ' ' . $correct_time)->format('Y-m-d H:i:s') ;
                                        if( ($session_time > $start_date_time) && ($session_time < $end_date_time))
										{
                                            $correct_time = "";
                                        }
                                    }
								}

                                if($passedFlag == false)
								{
                                    $html .= '<li class="active bookingData"  onmouseover="" style="cursor: pointer;" slotTime="'.substr($currentTime, 0, 5).'" selectedDate="'.$currentDate.'"> '.$correct_time.' </li>';
								}
							}
							else
							{
                                $html .= '<li class="active">Booked</li>';
							}

                            $currentTime = date("H:i:s", strtotime("$currentTime +1 hour"));
						}
                        $html .= '</nav>';
					}
				}
                $html .= '</div></div><div><button type="submit" id="submitBooking" class="submitBooking" name="myButton" hidden="hidden">Search</button></div>';
                $dayOfWeek->addDay(1);
                if($dayOfMonth < substr(\Carbon\Carbon::now()->endOfMonth(), 8,2))
				{
                    $dayOfMonth++;
				}
				else
				{
                    $dayOfMonth = 1;
				}
                $i = $i->addDay(1);
			}
            $html .= '</div></div></div>';
            $week++;
            $origDate->addDay(1);
		}
        $html .= '</div><input name="date" type="text" id="date" value="" hidden><input name="time" type="text" id="time" value="" hidden><div class="bot-de bot-card pt-0"><span class="bottom clo-item">Cancel </span></div></form></div>';
		echo $html;
	}*/
	
	public function getTutorContent()
	{
		$tutor = Instructor::with('user','languages', 'schedule', 'favourite', 'bookedSlots', 'reviews')->where(['id'=>$_GET['tutor_id']])->first();
		$html = '<div class="hover-box"><i class="fas fa-caret-left arwoleft"></i>';
        
		if($tutor->user->youtube_url == null)
		{
			$video = explode('.', $tutor->video);
			if(strtolower(end($video)) == 'mov')
				$html .='<div class="iframe"><a data-fancybox href="#video"><video width="320" height="240"><source src="'. asset('files/instructor/'.$tutor->video) .'" type="video/mp4"></video><div class=" play-video"><div class="play-icon"></div></div></a><video width="780" height="440" controls id="video" style="display:none;"><source src="'. asset('files/instructor/'.$tutor->video) .'" type="video/mp4"></video></div>';
			else
				$html .= '<div class="iframe"><a data-fancybox data-width="780" data-height="440" href="'. asset('files/instructor/'.$tutor->video) .'"><video width="320" height="240"><source src="'. asset('files/instructor/'.$tutor->video) .'" type="video/mp4"></video><div class="play-video"><div class="play-icon"></div></div></a></div>';
		}
		else
		{
			$youtube = explode('/', $tutor->user->youtube_url);
            $html .= '<div class="iframe"><a data-fancybox data-width="780" data-height="440" href="'.$tutor->user->youtube_url.'"><img src="https://img.youtube.com/vi/'. end($youtube) .'/hqdefault.jpg" /><div class="play-video"><div class="play-icon"></div></div></a></div>';
		}
		
		if(Auth::check() && Auth::user()->role == 'user' || Auth::guest())
		{
		$slots_alert = __('backend.slots_alert');
		$html .= '<p class="timezone"><i class="fas fa-globe-americas"></i> '.__('backend.tutor_content_text').' </p><div class="calandar-wek"><ul class="nav nav-tabs" id="myTab" role="tablist"><li class="nav-item"><a class="nav-link active" id="item-1-tab" data-toggle="tab" href="#item-1" role="tab" aria-controls="item-1" aria-selected="true"></a></li></ul><div class="tab-content" id="myTabContent">';
        $html .= '<script>(function($){$(document).ready(function () { $("#checkBtn").click(function() { checked = $("input[type=checkbox]:checked").length; if(!checked) { alert("'.$slots_alert.'"); return false; } }); });})(jQuery);</script>';
		$html .= '<form action="/slots/appointment" method="get" enctype="multipart/form-data">';
		$time_zone = \App\Time_zone::find($tutor->user->time_zone_id);
        $time_offs = \App\TutorTimeOff::where('tutor_id', $tutor->id )->where('start_date' , '>=' ,  \Carbon\Carbon::now()->format('Y-m-d') )->get();
		
		if(date('D') == 'Sun') $last_sunday = date("Y-m-d", strtotime("today"));
		else $last_sunday = date("Y-m-d", strtotime("last Sunday"));
		$last_week = [
			'Sunday'=>$last_sunday,
			'Monday'=>date("Y-m-d", strtotime($last_sunday." +1 days")),
			'Tuesday'=>date("Y-m-d", strtotime($last_sunday." +2 days")),
			'Wednesday'=>date("Y-m-d", strtotime($last_sunday." +3 days")),
			'Thursday'=>date("Y-m-d", strtotime($last_sunday." +4 days")),
			'Friday'=>date("Y-m-d", strtotime($last_sunday." +5 days")),
			'Saturday'=>date("Y-m-d", strtotime($last_sunday." +6 days")),
		];
		
		foreach($tutor->schedule->groupBy('day') as $day => $schedule)
		{
			$html.= '<div class="tab-pane fade show active" id="item-1" role="tabpanel" aria-labelledby="item-1-tab"><div class="times-day"><h3 class="title">'.__('frontend.'.$day).'</h3><div class="row" style="margin:0px 9px;">';
			foreach($schedule as $sch)
			{
				$html .= '<div class="active" id="ck-button" style="padding:9px 0px;"><label class="required">';
                if($time_zone != null )
				{
                    $slot_time = date(" H:i:s", strtotime("$sch->start_time"));
                    // convert from time zone to time zone saved in session
                    $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d'). $slot_time ,  $time_zone->time_zone_name)->setTimezone(session('currentTimeZoneName'));
                    $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');
                }
				else
				{
                    $correct_time = '';
                }

                // 1- get time off for this tutor
				// 2- convert that time into student time zone
                // 3- append that time to today so you know the date
                // 4- check if the date inside the time off
                foreach ($time_offs as $time_off)
				{
                    if($time_off != null)
					{
                        $start_date_time = \Carbon\Carbon::parse($time_off->start_date . ' ' .$time_off->start_time )->format('Y-m-d H:i:s');
                        $end_date_time = \Carbon\Carbon::parse($time_off->end_date . ' ' .$time_off->end_time )->format('Y-m-d H:i:s');

                        $session_time = \Carbon\Carbon::parse($currentDate . ' ' . $correct_time)->format('Y-m-d H:i:s') ;
                        if( ($session_time > $start_date_time) && ($session_time < $end_date_time))
						{
                            $correct_time = "";
                        }
                    }
                }
				//$html .= $correct_time.' </p></div></label></div>';
				$html .= '<input type="checkbox" name="slots[]" value="'.$tutor->id.','.$last_week[$day].','.substr($slot_time, 0, 5).'"><span class="label-text">'.$correct_time.' </span></label></div>';
			}
			$html .= '</div></div></div>';
		}
		$html .= '<div class="text-center"><button type="submit" class="bottom booknow" id="checkBtn">'.__('frontend.submit').'</button></div>';
		$html .= '<div class="text-center"><a class="bottom" href="/tutor/page/'.$tutor->id.'">'.__('frontend.view_full_schedule').'</a></div>';
		$html .= '</form></div></div>';
		}
		$html .= '</div>';
		echo $html;
	}
	
	/*public function getTutorContent()
	{
		$tutor = Instructor::with('user','languages', 'schedule', 'favourite', 'bookedSlots', 'reviews')->where(['id'=>$_GET['tutor_id']])->first();
		$html = '<div class="hover-box"><i class="fas fa-caret-left arwoleft"></i>';
        
		if($tutor->user->youtube_url == null)
		{
			$video = explode('.', $tutor->video);
			if(strtolower(end($video)) == 'mov')
				$html .='<div class="iframe"><a data-fancybox href="#video"><video width="320" height="240"><source src="'. asset('files/instructor/'.$tutor->video) .'" type="video/mp4"></video><div class=" play-video"><div class="play-icon"></div></div></a><video width="780" height="440" controls id="video" style="display:none;"><source src="'. asset('files/instructor/'.$tutor->video) .'" type="video/mp4"></video></div>';
			else
				$html .= '<div class="iframe"><a data-fancybox data-width="780" data-height="440" href="'. asset('files/instructor/'.$tutor->video) .'"><video width="320" height="240"><source src="'. asset('files/instructor/'.$tutor->video) .'" type="video/mp4"></video><div class="play-video"><div class="play-icon"></div></div></a></div>';
		}
		else
		{
			$youtube = explode('/', $tutor->user->youtube_url);
            $html .= '<div class="iframe"><a data-fancybox data-width="780" data-height="440" href="'.$tutor->user->youtube_url.'"><img src="https://img.youtube.com/vi/'. end($youtube) .'/hqdefault.jpg" /><div class="play-video"><div class="play-icon"></div></div></a></div>';
		}
		
		$html .= '<p class="timezone"><i class="fas fa-globe-americas"></i> Times are shown in your local timezone </p><div class="calandar-wek"><ul class="nav nav-tabs" id="myTab" role="tablist"><li class="nav-item"><a class="nav-link active" id="item-1-tab" data-toggle="tab" href="#item-1" role="tab" aria-controls="item-1" aria-selected="true"></a></li></ul><div class="tab-content" id="myTabContent">';
        $time_zone = \App\Time_zone::find($tutor->user->time_zone_id);
        $time_offs = \App\TutorTimeOff::where('tutor_id', $tutor->id )->where('start_date' , '>=' ,  \Carbon\Carbon::now()->format('Y-m-d') )->get();
		foreach($tutor->schedule->groupBy('day') as $day => $schedule)
		{
			$html.= '<div class="tab-pane fade show active" id="item-1" role="tabpanel" aria-labelledby="item-1-tab"><div class="times-day"><h3 class="title">'.$day.'</h3><div class="row">';
			foreach($schedule as $sch)
			{
				$html .= '<div class="col-sm-2 ch-item"><label class="chebox-time"><input type="checkbox" name="checkbox"><div class="label-text"><p>';
                if($time_zone != null )
				{
                    $slot_time = date(" H:i:s", strtotime("$sch->start_time"));
                    // convert from time zone to time zone saved in session
                    $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d'). $slot_time ,  $time_zone->time_zone_name)->setTimezone(session('currentTimeZoneName'));
                    $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');
                }
				else
				{
                    $correct_time = '';
                }

                // 1- get time off for this tutor
				// 2- convert that time into student time zone
                // 3- append that time to today so you know the date
                // 4- check if the date inside the time off
                foreach ($time_offs as $time_off)
				{
                    if($time_off != null)
					{
                        $start_date_time = \Carbon\Carbon::parse($time_off->start_date . ' ' .$time_off->start_time )->format('Y-m-d H:i:s');
                        $end_date_time = \Carbon\Carbon::parse($time_off->end_date . ' ' .$time_off->end_time )->format('Y-m-d H:i:s');

                        $session_time = \Carbon\Carbon::parse($currentDate . ' ' . $correct_time)->format('Y-m-d H:i:s') ;
                        if( ($session_time > $start_date_time) && ($session_time < $end_date_time))
						{
                            $correct_time = "";
                        }
                    }
                }
				$html .= $correct_time.' </p></div></label></div>';
			}
			$html .= '</div></div></div>';
		}
		$html .= '<div class="text-center"><a class="bottom" href="/tutor/page/'.$tutor->id.'">View Full Schedule</a></div></div></div></div>';
		echo $html;
	}*/
	
    public function index(){
        $tutors = Instructor::with('user','languages', 'schedule', 'favourite', 'bookedSlots', 'reviews')
            ->join('users', 'users.id', 'instructors.user_id')
            ->join('allcountry', 'allcountry.id', 'users.country_id')
            ->where('instructors.status', 1)
            ->where('users.visibility', 1)
            ->select('instructors.id', 'instructors.user_id', 'instructors.PricePerHour', 'instructors.recommendation', 'instructors.headline', 'instructors.video', 'instructors.detail', 'instructors.created_at','allcountry.name As country_name', 'allcountry.iso', DB::raw('IF(((`video` IS NOT NULL AND `video` !="") OR (youtube_url IS NOT NULL AND youtube_url !="")), 1, 0) `sortOrder`'))
            ->orderByDesc('sortOrder')
            ->orderBy('turor_order','asc')
            ->paginate(5);
            //->appends(request()->query());
        //dd($tutors);

        //$residences = Allcountry::all();
		$residences = DB::table('users')
					->join('allcountry', 'users.country_residence_id', '=', 'allcountry.id')
					->join('instructors', 'users.id', '=', 'instructors.user_id')
					->select('users.country_residence_id as id','allcountry.name as name')
					->where(['users.role'=>'instructor', 'instructors.status'=>1])
					->distinct()
					->groupBy('users.country_residence_id')
					->get();
		//$countries = Allcountry::all();
		$countries = DB::table('users')
					->join('allcountry', 'users.country_id', '=', 'allcountry.id')
					->join('instructors', 'users.id', '=', 'instructors.user_id')
					->select('users.country_id as id','allcountry.name as name')
					->where(['users.role'=>'instructor', 'instructors.status'=>1])
					->distinct()
					->groupBy('users.country_id')
					->get();
        $specialties = Specialties::all();
       // dd($specialties);
		/*$specialties = DB::table('instructors')
					->join('specialties', 'instructors.specialty', '=', 'specialties.id')
					->select('specialties.id as id','specialties.specialty as specialty')
					->where('instructors.status','1')
					->distinct()
					->groupBy('instructors.specialty')
					->get();*/
        $allLanguages = AllLanguages::all(); 
		/*$allLanguages = DB::table('users')
					->join('user_language', 'users.id', '=', 'user_language.user_id')
					->join('all_languages', 'user_language.language_id', '=', 'all_languages.id')
					->join('instructors', 'users.id', '=', 'instructors.user_id')
					->select('user_language.language_id as id','all_languages.isoName as isoName')
					->where(['users.role'=>'instructor', 'instructors.status'=>1])
					->distinct()
					->groupBy('user_language.language_id')
					->get();*/
        $weekDays = Carbon::getDays();


        return view('frontend.find-tutor.findtutor', compact('tutors','countries', 'residences', 'specialties', 'allLanguages', 'weekDays'));
    }


    public function search(Request $request){
		$userExchangeRate = 1;
        $currency_code = "USD";

        $user_country = $this->ip_info("Visitor", "country_code");
        if($user_country != null ){
            // get currency code
            $currency_model = CountryCurrency::where('CountryCode', $user_country)->first();
            if($currency_model != null ){
                $currency_code = $currency_model->code;
            }
            // get exchange rate from database and check update date if today
            $exchange_rate = EuroExchangeRate::first();
            if($exchange_rate != null ){
                if( Carbon::parse($exchange_rate->updated_at)->format('Y-m-d') != date('Y-m-d') ){
                    // call exhcnage rate API and truncate table then update it
                    $res = $this->getCurrencyExchangeRate();
                    $currency_code = "USD";
                }else{
                    // API was update today so get currency value from database
                    $user_ex_rate = EuroExchangeRate::where('currency_code' , $currency_code)->first();
                    if($user_ex_rate != null ){
                        // get dollar exchange rate
                        $user_ex_rate_usd = EuroExchangeRate::where('currency_code' , "USD")->first();
                        $userExchangeRate = $user_ex_rate->value / $user_ex_rate_usd->value ;
                    }
                }

            }else{
                // call exhcnage rate API and truncate table then update it
                $res = $this->getCurrencyExchangeRate();
                $currency_code = "USD";
            }
        }

		if(!Auth::guest())
		{
			$partnerstudent = PartnerStudent::select('partner_id')->where(['student_id'=>Auth::user()->id])->pluck('partner_id')->toArray();
			if(Auth::user()->role == 'user' && !empty($partnerstudent))
			{
				$tutors = Instructor::with('user','languages', 'schedule', 'favourite', 'bookedSlots', 'reviews')
					->join('users', 'users.id', 'instructors.user_id')
					->join('allcountry', 'allcountry.id', 'users.country_id')
					->join('partner_tutors', 'partner_tutors.tutor_id', 'instructors.id')
					->wherein('partner_tutors.partner_id', $partnerstudent)
					->where('users.visibility', 1)
					->where('instructors.status', 1);
			}
			else
			{
				$tutors = Instructor::with('user','languages', 'schedule', 'favourite', 'bookedSlots', 'reviews')
					->join('users', 'users.id', 'instructors.user_id')
					->join('allcountry', 'allcountry.id', 'users.country_id')
					->where('users.visibility', 1)
					->where('instructors.status', 1);
			}
		}
		else
		{
			$tutors = Instructor::with('user','languages', 'schedule', 'favourite', 'bookedSlots', 'reviews')
				->join('users', 'users.id', 'instructors.user_id')
				->join('allcountry', 'allcountry.id', 'users.country_id')
				->where('users.visibility', 1)
				->where('instructors.status', 1);
		}

        $country = null;
		$residences = null;
        $specialties = null;
        $from = null;
        $to = null;
        $language = null;
        $search_words = null;
        $native_speaker = null;
        $times = null;
        $days = null;
        $user_id = null;
		$paginate_pass = '';
       
        if ($request->country != null){
            $tutors = $tutors->whereIn('users.country_id', $request->country);
            $country = $request->country;
			foreach($request->country as $request_country) { $paginate_pass .= '&country[]='.$request_country; }
        }
		
		if ($request->residences != null){
            $tutors = $tutors->whereIn('users.country_residence_id', $request->residences);
            $residences = $request->residences;
			foreach($request->residences as $request_residence) { $paginate_pass .= '&residences[]='.$request_residence; }
        }

        if ($request->from != null){
            $tutors = $tutors->where('instructors.pricePerHour','>=', str_replace(' USD', '',$request->from));
            $from = $request->from;
			$paginate_pass .= '&from='.str_replace(' ', '+',$request->from);
        }

        if ($request->to != null){
            $tutors = $tutors->where('instructors.pricePerHour','<=', str_replace(' USD', '',$request->to));
            $to = $request->to;
			$paginate_pass .= '&to='.str_replace(' ', '+',$request->to);
        }


        if ($request->specialties != null && !in_array('1', $request->specialties)){
            $tutors = $tutors->whereIn('instructors.specialty', $request->specialties);
            $specialties = $request->specialties;
			foreach($request->specialties as $request_specialties) { $paginate_pass .= '&specialties[]='.$request_specialties; }
        }

        if ($request->Language != null){
            $tutors = $tutors->whereIn('user_language.language_id', $request->Language);
            $language = $request->Language;
			foreach($request->Language as $request_Language) { $paginate_pass .= '&Language[]='.$request_Language; }

        }
        if ($request->sort != null){
            if ($request->sort == "highestPrice") {
                $tutors = $tutors->orderBy('instructors.PricePerHour', 'desc');
            }elseif($request->sort == "lowestPrice"){
                $tutors = $tutors->orderBy('instructors.PricePerHour', 'asc');

            }
        }
        if ($request->searchWord != null){
            $tutors = $tutors->where('users.fname', 'like',$request->searchWord . '%');
//                ->orWhere('instructors.detail', 'like', '%'. $request->searchWord . '%')
//                ->orWhere('instructors.headLine', 'like', '%'. $request->searchWord . '%');
            $search_words = $request->searchWord;
			$paginate_pass .= '&searchWord='.$request->searchWord;
        }
        if (isset($request->nativeSpeaker)){
            $tutors = $tutors->where('user_language.level_id', 1);
            $native_speaker = $request->nativeSpeaker;
			$paginate_pass .= '&checkbox=on';
        }

        if ($request->times != null){
            foreach ($request->times as $timeRange){

                $times = explode('-', $timeRange);

                $startTime = date("H:i:00", strtotime("$times[0]". Session('currentTimeZoneHour') . ' hour '. Session('currentTimeMinutes') . ' minutes'));
                $endTime = date("H:i:00", strtotime(" end($times[0])". Session('currentTimeZoneHour') . ' hour '. Session('currentTimeMinutes') . ' minutes'));
                $tutors = $tutors->where('tutor_schedule_time_blocks.start_time','>=', $startTime);
                $tutors = $tutors->where('tutor_schedule_time_blocks.start_time','<=', $endTime);
				
				$paginate_pass .= '&amp;times[]='.$timeRange;

            }

            $times = $request->times;

        }

        if ($request->days != null){
//            $days = explode(',', $request->checkedDays);
            $tutors = $tutors->whereIn('tutor_schedule_time_blocks.day', $request->days);
            $days = $request->days;
			foreach($request->days as $request_days) { $paginate_pass .= '&days[]='.$request_days; }
        }

        if (Auth::check()) {
            $user_id = Auth::id();
        }

        if($from != null ){
            $search_log = new SearchLog;
            $search_log->country = json_encode($country);
			$search_log->residences = json_encode($residences);
            $search_log->specialties = json_encode($specialties);
            $search_log->from = $from;
            $search_log->to = $to;
            $search_log->language = json_encode($language);
            $search_log->search_words = $search_words;
            $search_log->times = json_encode($times);
            $search_log->days = json_encode($days);
            $search_log->native_speaker = $native_speaker;
            $search_log->user_id = $user_id;
            $search_log->save();
        }


        $tutors = $tutors->with('user','languages', 'schedule', 'favourite', 'bookedSlots', 'reviews')
            ->leftJoin('user_language', 'user_language.user_id', '=', 'instructors.user_id')
            ->leftJoin('all_languages', 'all_languages.id', '=', 'user_language.language_id')
            ->leftJoin('specialties', 'specialties.id', '=', 'instructors.specialty')
            ->leftJoin('tutor_schedule_time_blocks', 'tutor_schedule_time_blocks.user_id', 'instructors.user_id')
            ->select('instructors.id', 'instructors.user_id', 'instructors.PricePerHour', 'instructors.recommendation', 'instructors.headline', 'instructors.active_students','instructors.video', 'instructors.detail', 'instructors.created_at','allcountry.name As country_name', 'allcountry.iso', DB::raw('IF(((`video` IS NOT NULL AND `video` !="") OR (youtube_url IS NOT NULL AND youtube_url !="")), 1, 0) `sortOrder`'))
            ->orderByDesc('sortOrder')
            ->orderBy('turor_order','asc')
            ->groupBy('instructors.id')
            ->paginate(10);


        $weekDays = Carbon::getDays();

        $seconds = 7*24*60*60;
		
		//$residences = Cache::pull('residences');
        if(!Cache::has('residences')){
            $residences = Cache::remember('residences', $seconds, function () {
                return DB::table('users')
						->join('allcountry', 'users.country_residence_id', '=', 'allcountry.id')
						->join('instructors', 'users.id', '=', 'instructors.user_id')
						->select('users.country_residence_id as id','allcountry.name as name')
						->where(['users.role'=>'instructor', 'instructors.status'=>1])
						->distinct()
						->groupBy('users.country_residence_id')
						->get();
            });
        }
		
		//$countries = Cache::pull('countries');
        if(!Cache::has('countries')){
            $countries = Cache::remember('countries', $seconds, function () {
                return DB::table('users')
						->join('allcountry', 'users.country_id', '=', 'allcountry.id')
						->join('instructors', 'users.id', '=', 'instructors.user_id')
						->select('users.country_id as id','allcountry.name as name')
						->where(['users.role'=>'instructor', 'instructors.status'=>1])
						->distinct()
						->groupBy('users.country_id')
						->get();
            });
        }

        //$specialties = Cache::pull('specialties');
		if(!Cache::has('specialties')){
            $specialties = Cache::remember('specialties', $seconds, function () {
                return DB::table('instructors')
						->join('specialties', 'instructors.specialty', '=', 'specialties.id')
						->select('specialties.id as id','specialties.specialty as specialty')
						->where(['instructors.status'=>1])
						->distinct()
						->groupBy('instructors.specialty')
						->get();
            });
        }

        //$allLanguages = Cache::pull('allLanguages');
		if(!Cache::has('allLanguages')){
            $allLanguages = Cache::remember('allLanguages', $seconds, function () {
                return DB::table('users')
						->join('user_language', 'users.id', '=', 'user_language.user_id')
						->join('all_languages', 'user_language.language_id', '=', 'all_languages.id')
						->join('instructors', 'users.id', '=', 'instructors.user_id')
						->select('user_language.language_id as id','all_languages.isoName as isoName')
						->where(['users.role'=>'instructor', 'instructors.status'=>1])
						->distinct()
						->groupBy('user_language.language_id')
						->get();
            });
        }



        $residences = Cache::get('residences');
		$countries = Cache::get('countries');
        $specialties = Cache::get('specialties');
        $allLanguages = Cache::get('allLanguages');
        $specialties = Specialties::all();
        $allLanguages = AllLanguages::all();
        Session::put('userExchangeRate', $userExchangeRate );
        Session::put('currency_code', $currency_code );

        return view('frontend.find-tutor.findtutor', compact('paginate_pass','tutors','countries', 'residences', 'specialties', 'allLanguages', 'weekDays','userExchangeRate','currency_code'));


    }


    public function tutorProfile(Request $request, $id){
        $tutor = Instructor::where('instructors.id', $id)->with('user', 'schedule', 'favourite')
            ->join('users', 'users.id', 'instructors.user_id')
            ->join('allcountry', 'allcountry.id', 'users.country_id')
            ->select('instructors.*', 'allcountry.name As country_name')
            ->first();



        $tutor->update([
            'viewed' => $tutor->viewed + 1,
        ]);

        $timeZones = Time_zone::all();

        $tutorEducations = tutorEducation::where('tutor_id', $id)->get();
        $tutorExperiences = tutorWorkExperience::where('tutor_id', $id)->get();
        $tutorCertificates = tutorCertificate::where('tutor_id', $id)->get();

        $tutorReviews = ReviewRating::where('tutor_id',$id)
            ->where('course_id', null)
            ->with('user')->get();



        $reviewCounter = $tutorReviews->count();
//        dd($reviewCounter);
        $reviewTotalValue = 0;
        $averageRating = 0;

        if ($reviewCounter != 0) {
            foreach ($tutorReviews as $review) {
                $reviewTotalValue += $review->value;
            }
            $averageRating = round($reviewTotalValue / $reviewCounter );
//        dd($averageRating);
        }
        $isFavourite = Favourites::where('user_id', '=', auth()->id())
            ->where('instructor_id', '=', $id)
            ->first();

        $weekDays = Carbon::getDays();

        $bookedSlots = Appointment::where('instructor_id',$id)->where('status_id','!=', 4)
            ->select('start_time', 'date', 'user_id')
            ->get();

        $activeStudents = Appointment::where('instructor_id',$id)
            ->select('start_time', 'date', 'user_id')
            ->groupBy('user_id')
            ->get();
        $confirmedLessons = Appointment::where('instructor_id',$id)->where('appointments.status_id', 3)->get();
//dd($confirmedLessons);
        $userExchangeRate = Session('userExchangeRate') ? Session('userExchangeRate') : 1 ;
        $currency_code = Session('currency_code') ? Session('currency_code') : "USD" ;

        return view('frontend.find-tutor.tutorPage', compact('tutor', 'tutorEducations', 'tutorExperiences', 'tutorCertificates', 'tutorReviews', 'reviewCounter', 'timeZones', 'isFavourite', 'weekDays', 'bookedSlots', 'activeStudents', 'averageRating', 'confirmedLessons','userExchangeRate','currency_code'));
    }

    public function favourites($id){

        $favouriteTutors = Instructor::with('user', 'schedule','bookedSlots','reviews')
            ->join('favourites', 'instructors.id','=', 'favourites.instructor_id')
            ->where('favourites.user_id', $id)
            ->join('users', 'users.id', 'instructors.user_id')
            ->join('allcountry', 'allcountry.id', 'users.country_id')
            ->select('instructors.id', 'instructors.user_id', 'instructors.PricePerHour', 'instructors.recommendation', 'instructors.headline', 'instructors.detail', 'instructors.created_at','allcountry.name As country_name', 'allcountry.iso')
            ->get();


        $favouriteTutorsCount = $favouriteTutors->count();

    return view('frontend.find-tutor.favourites', compact('favouriteTutors', 'favouriteTutorsCount'));
    }

    public function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = ($_SERVER["REMOTE_ADDR"] == NULL)  ? $_SERVER["REMOTE_ADDR"] : "72.229.28.185";
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }

    public function getCurrencyExchangeRate()
    {
        try{
            DB::table('euro_exchange_rates')->truncate();
            $response = Http::get('http://data.fixer.io/api/latest?access_key=eb3c8b97e0f2f5a0c18f97ddc72e0902&format=1');
            if($response && $response != null){
                if($response->body()){
                    $response_body = json_decode($response->body());
                    if($response_body->success != false){
                        if($response_body->rates ){
                            foreach($response_body->rates as $key => $value ){
                                $rate = new EuroExchangeRate;
                                $rate->currency_code = $key;
                                $rate->value = $value;
                                $rate->save();
                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
