<html>
<head>
    <title>App Name - @yield('title')</title>
</head>
<body>
@section('sidebar')
    This is the master sidebar.
@show

<div class="container">
    @foreach($users as $user)
        <p>This is user {{ $user->name }}</p>
    @endforeach
</div>
</body>
</html>