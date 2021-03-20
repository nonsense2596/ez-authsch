<?php

namespace App\Http\Controllers\Authsch;


use Illuminate\Http\Request;

use App\Models\Authsch\AdMemberships;
use App\Models\Authsch\User;
use App\Models\Authsch\AttendedCourses;
use App\Models\Authsch\LinkedAccounts;
use App\Models\Authsch\StudentClubMemberships;
use App\Models\Authsch\Entrants;
use Validator;
use Socialite;
use Exception;
use Auth;
use App\Http\Controllers\Controller as Controller;

class SocialController extends Controller
{


    //////////////////////////////////////////////////////
    public function schonherzRedirect()
    {
        return Socialite::driver('authsch')->redirect();
    }
    public function loginWithSchonherz()
    {
        $user = Socialite::driver('authsch')->stateless()->user();
        //ddd($user);
        $authuser = null;

        if($dbuser = User::where('id',$user->id)->first()){
            $authuser = $dbuser;
            $dbuser->delete();  // ez csak temp TODO
            //ddd("lol");
        }
        if(true){   // else // ez csak temp TODO



            // egyelore csak minden letezo adatot lementunk stringben
            $authuser = User::create([
                'id' => $user->id,
                'displayName' => $user->displayName,
                'sn' => $user->sn,
                'givenName' => $user->givenName,
                'mail' =>$user->mail,
                'mobile' => $user->mobile,
                'bmeunitscope' => self::get_unit_scope($user->bmeunitscope),
                'permanentaddress' => $user->permanentaddress,
                'birthdate' => $user->birthdate,
            ]);






            // ------====== linkedAccounts ======------  --> tarsitott accountok az sch acchoz
            if(!is_null($user->linkedAccounts)){
                foreach($user->linkedAccounts as $key => $value){
                    $linked_account = LinkedAccounts::create([
                        'user_id' => $user->id,
                        'account_type' => $key,
                        'account_name' => $value
                    ]);
                    $linked_account->save();
                }
            }



            // ------====== eduPersonEntitlement ======------  --> pek kortagsagok
            if(!is_null($user->eduPersonEntitlement)){
                foreach($user->eduPersonEntitlement as $key => $value){
                    //ddd($value["end"]);
                    $student_club_membership = StudentClubMemberships::create([
                        'user_id' => $user->id,
                        'club_id' => $value["id"],
                        'club_name' => $value["name"],
                        'title' => isset($value["title"]) ? implode(";",$value["title"]) : null,    // meg nem a legszebb
                        'status' => $value["status"],
                        'start' => $value["start"],
                        'end' => $value["end"]
                    ]);
                    $student_club_membership->save();
                }
            }



            // ------====== niifEduPersonAttendedCourse ======------  --> felevben felvett kurzusok
            if(!is_null($user->niifEduPersonAttendedCourse))
            {
                $exploded = explode(";",$user->niifEduPersonAttendedCourse);
                foreach($exploded as $value){
                    $attended_course = AttendedCourses::create([
                        'user_id' => $user->id,
                        'course' => $value
                    ]);
                    $attended_course->save();
                }
            }



            // ------====== entrants ======------  --> kollegiumi belepo stilus
            if(!is_null($user->entrants)){
                foreach($user->entrants as $value){
                    $entrant = Entrants::create([
                        'user_id' => $user->id,
                        'group_id' => $value["groupId"],
                        'group_name' => $value["groupName"],
                        "entrant_type" => $value["entrantType"]
                    ]);
                    $entrant->save();
                    //ddd($value);
                }
            }



            // ------====== admembership ======------  --> sch-s szolgáltatások listája
            if(!is_null($user->admembership)){
                foreach($user->admembership as $value){
                    $admembership = AdMemberships::create([
                        'user_id' => $user->id,
                        'membership' => $value
                    ]);
                    $admembership->save();
                    //ddd($value);
                }
            }







            $authuser->save();
        }


        Auth::login($authuser);

        //return redirect('/');
        return redirect()->intended();  // igy redirectel jo helyre
    }



    //////////////////////////////////////////////////////

    public function logOutOfSchonFuckingHerz()
    {
        Auth::logout();
        return redirect('/');
    }


    public function multi_implode($array, $glue)
    {
        if(is_null($array)){
            return null;
        }
        $ret = '';
        foreach ($array as $item) {
            if (is_array($item)) {
                $ret .= self::multi_implode($item, $glue) . $glue;
            } else {
                $ret .= $item . $glue;
            }
        }
        $ret = substr($ret, 0, 0-strlen($glue));
        return $ret;
    }

    public function get_unit_scope($bmeunitscope){
        // ------====== bmeunitscope ======------  --> jogviszony, valaha, aktiv, vikes aktiv,...
        $bmeunitscopes = self::multi_implode($bmeunitscope,";");

        $actualscope = null;
        if(is_null($bmeunitscopes))
        {
            $actualscope = "NULL";
        }
        else {       // longest prefix match
            if (str_contains($bmeunitscopes,"BME_VIK_NEWBIE"))
                $actualscope = "VALAKI";
            else if (str_contains($bmeunitscopes,"BME_VIK_ACTIVE"))
                $actualscope = "VIKES AKTIV";
            else if (str_contains($bmeunitscopes,"BME_VIK"))
                $actualscope = "VIKES";
            else if (str_contains($bmeunitscopes,"BME"))
                $actualscope = "BMES";
            else {
                $actualscope = "NULL-else";
            }
        }
        return $actualscope;
    }

}
