<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
    <style>
        p{
            margin:3px;
        }
        .tab{
            margin-left: 2em;
        }
    </style>
</head>

<p>
<h1>Basic information</h1>
<p>Name: {{$user->displayName}}</p>
<p>Mail: {{$user->mail}}</p>
<p>BME status: {{$user->bmeunitscope}}</p>
<p>Address: {{$user->permanentaddress}}</p>
<p>Date of birth: {{$user->birthdate}}</p>

<h1>Currently Attended Courses</h1>
@foreach($attendedcourses as $attendedcourse)
    <p>
        {{$attendedcourse->course}}
    </p>
@endforeach

<h1>Schönherz Active Directory Memberships</h1>
@foreach($admemberships as $admembership)
    <p>
        {{$admembership->membership}}
    </p>
@endforeach
<h1>Entrants</h1>
@foreach($entrants as $entrant)
    <p>
        {{$entrant->group_name}} (id: {{$entrant->group_id}})
    <p class="tab">
        type: {{$entrant->entrant_type}}
    </p>
    </p>
@endforeach
<h1>Linked Accounts</h1>
@foreach($linkedaccounts as $linkedaccount)
    <p>
        {{$linkedaccount->account_type}}: {{$linkedaccount->account_name}}
    </p>
@endforeach
<h1>Student Club Memberships</h1>
@foreach($studentclubmemberships as $studentclubmembership)
    <p>
        {{$studentclubmembership->club_name}}  (id: {{$studentclubmembership->club_id}})
        <br>
    <p class="tab">
        status:{{$studentclubmembership->status}}<br>
        since: {{$studentclubmembership->start}}<br>
        till: {{$studentclubmembership->end ? null : "now"}}
    </p>
    </p>
    @endforeach
    </body>
</html>



