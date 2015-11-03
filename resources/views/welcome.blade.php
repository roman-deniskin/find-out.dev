<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 48px;
            }

            .title a{
                color: black;
                font-size: 32px;
            }

        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5</div><br>

                @if(\Illuminate\Support\Facades\Auth::check() == false)
                    <div class="title"><a href="/login">Login</a></div>
                    <div class="title"><a href="/registration">Registration</a></div>

                @else
                    <div class="title"><a href="/logout">Logout</a></div>
                @endif



            </div>
        </div>
    </body>
</html>
