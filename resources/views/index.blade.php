<html>
<head>
    <title>asdasd</title>
</head>
<body>
<div class="flex items-center justify-end mt-4">
    <a class="btn" href="{{ url('auth/schonherz') }}"
       style="background: #3B5499; color: #ffffff; padding: 10px; width: 30%; text-align: center; display: block; border-radius:3px;">
        Login with SCH
    </a>
    <a class="btn" href="{{ url('auth/schonherz/logout') }}"
       style="background: #993B99; color: #ffffff; padding: 10px; width: 30%; text-align: center; display: block; border-radius:3px;">
        Log outta SCH
    </a>
    <h1>
        ezt mindenki látja
    </h1>
    @auth
        <h1>
            ezt csak a belépett
        </h1>
    @endauth
</div>
</body>
</html>
