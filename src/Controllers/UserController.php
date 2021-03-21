<?php

namespace App\Http\Controllers\Authsch;

use App\Models\Authsch\AdMemberships;
use App\Models\Authsch\User;
use App\Models\Authsch\AttendedCourses;
use App\Models\Authsch\LinkedAccounts;
use App\Models\Authsch\StudentClubMemberships;
use App\Models\Authsch\Entrants;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Controller;

use Auth;

class UserController extends Controller
{
    public function index(){
        $user = Auth::user();
        $admemberships = $user->get_ad_memberships()->get();
        $attendedcourses = $user->get_attended_courses()->get();
        $entrants = $user->get_entrants()->get();
        $linkedaccounts = $user->get_linked_accounts()->get();
        $studentclubmemberships = $user->get_student_club_memberships()->get();


        return view('authsch.user',compact('user','admemberships','attendedcourses','entrants','linkedaccounts','studentclubmemberships'));
    }
}
