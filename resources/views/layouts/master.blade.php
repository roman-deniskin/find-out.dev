<!DOCTYPE html>
<html lang="{{ Lang::getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="Find-Out">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
	  <!-- User styles -->
    <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet"/>
    
    <!-- Google fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('head')
  </head>
  <body @yield('background')>
    <header class="header">
      <div class="container">
      	<div class="col-md-12">
          <a href="{{ url('/') }}"><div class="logo col-md-4"></div></a>
          <div class="rightHeaderBlock col-md-8">
            <p class="rightHeaderBlockText">Зарегистрированный пользователь?</p>
            <button class="button" id="entryButton">Вход</button>
          </div>
      	</div>
      </div>
    </header>
    <div class="container">
  	<div class="col-md-12">
            <div class="col-md-3 entryContainer">
              <div class="tillContainer"></div>
              <h2 class="H1Text entryText">{{ trans('user::names.authorization') }}</h2>
                    <form role="form" method="POST" action="{{ url('/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" placeholder="{{ trans('user::names.login') }}" class="inputEntryField" name="login" required="true" value="{{ old('login') }}"/>
                        <input type="password" placeholder="{{ trans('user::names.password') }}" class="inputEntryField" value="" name="password" required="true" value="{{ old('password') }}"/>

                        <button class="button entryContainerButton">{{ trans('user::names.authorization') }}</button>
                    </form>
            </div>

@if(Session::has('message'))
    <div class="container">
        <div class="chip">
            {{ Session::get('message') }}
        </div>
    </div>
    <?php Session::forget('message') ?>
@endif

@yield('content')

  	</div>
    </div>
    <footer class="footer">
      <div class="container">
        <div class="col-md-12">
            <div class="bottomMenu">
              <ul>
                <a href="#"><li class="bottomMenuLi">О сервисе</li></a>
                <a href="#"><li class="bottomMenuLi">Разработчикам</li></a>
                <a href="#"><li class="bottomMenuLi">Инвесторам</li></a>
                <a href="#"><li class="bottomMenuLi">Поддержка</li></a>
              </ul>
            </div>
        </div>
      </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/register/floatingHints.js') }}"></script>
    <script src="{{ asset('js/commonFiles/entryWindow.js') }}"></script>
  </body>
</html>