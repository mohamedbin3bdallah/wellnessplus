<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instructor;
use App\UserOrganization;
use App\PartnerStudent;
use App\TutorCommission;
use App\TutorCommissionLog;
use Auth;

class CommissionController extends Controller
{
    /*
	** Tutor Commission
	*/
	public static function tutorCommission($appointment,$tutor)
    {
		$instructor = Instructor::find($tutor);
        $user = PartnerStudent::where(['student_id'=>Auth::user()->id])->first();
		if($user) {
			$userorganization = UserOrganization::with('organization')->where(['user_id'=>$user->partner_id])->first();
			$org['id'] = $userorganization->organization->id;
			$org['commission'] = $userorganization->organization->commission;
		}
		else
		{
			$org['id'] = NULL;
			$org['commission'] = 10;
		}
		$tutorcommission = TutorCommission::create([
			'user_id' => Auth::user()->id,
			'tutor_id' => $tutor,
			'appointment_id' => $appointment,
			'organization_id' => $org['id'],
			'originalvalue' => $instructor->PricePerHour,
			'commissionrate' => $org['commission'],
			'commissionvalue' => number_format((($instructor->PricePerHour)*($org['commission'])/100),2),
			'created_by' => Auth::user()->id,
		]);
		$tutorcommissionlog = TutorCommissionLog::create([
			'user_id' => Auth::user()->id,
			'tutor_id' => $tutor,
			'appointment_id' => $appointment,
			'action' => 'add',
			'value' => number_format((($instructor->PricePerHour)*($org['commission'])/100),2),
			'created_by' => Auth::user()->id,
		]);
    }
	
	public static function deleteTutorCommission($appointment,$tutor)
    {
		$instructor = Instructor::find($tutor);
        $user = PartnerStudent::where(['student_id'=>Auth::user()->id])->first();
		if($user) {
			$userorganization = UserOrganization::with('organization')->where(['user_id'=>$user->partner_id])->first();
			$org['id'] = $userorganization->organization->id;
			$org['commission'] = $userorganization->organization->commission;
		}
		else
		{
			$org['id'] = NULL;
			$org['commission'] = 10;
		}
		$tutorcommission = TutorCommission::where([
			'user_id' => Auth::user()->id,
			'tutor_id' => $tutor,
			'appointment_id' => $appointment,
		])->delete();
		$tutorcommissionlog = TutorCommissionLog::create([
			'user_id' => Auth::user()->id,
			'tutor_id' => $tutor,
			'appointment_id' => $appointment,
			'action' => 'delete',
			'value' => number_format((($instructor->PricePerHour)*($org['commission'])/100),2),
			'created_by' => Auth::user()->id,
		]);
    }
}


