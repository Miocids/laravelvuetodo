<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tasks Apps</title>
</head>
<body class="bg-success">
    
    <div id="app">
        @yield('content')
    </div>

    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
</body>
</html>