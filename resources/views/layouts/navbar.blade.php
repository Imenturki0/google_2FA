<!-- resources/views/app.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="container">
        

          <!-- <label for="navbar-toggle" class="navbar-toggler">&#9776;</label>-->
            <ul class="navbar-menu">

                <li><a href="{{ route('login') }}">login</a></li>
                <li><a href="{{ route('register.process') }}">register</a></li>
            </ul>
        </div>
    </nav>


    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
