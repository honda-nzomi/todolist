<!DOCTYPE>

<html lang="ja">
    
<head>
  <meta chardet="UTF-8">
  <meta name="viewport" content="widsh=device-width,initial-scale=1.0">
  <meta http-equiv="X-UACompatible" content="ie=edge">
  <title>Todo</title>
  <!--TailWindCssの導入のため-->
  <!--<script src="https://cdn.tailwindcss.com"></script>-->
  <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
            <nav class="navbar navbar-light bg-dark">
              <div class="container-fluid">
                <a class="navbar-brand text-light">Todoアプリ</a>
                <form class="d-flex" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-light" type="submit">{{ __('Logout') }}</button>
                </form>
              </div>
            </nav>

            {{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}
            @yield('content')
    </body>

<!--<body class="flex flex-col min-h-[100vh]">-->
<!--  <header class="bg-slate-800">-->
<!--    <div class="max-w7xl mx-aoto px-4 sm:px-6">-->
<!--      <div class="py-6">-->
<!--        <P class="text-white text-xl">Todoアプリ</P>-->
<!--      </div>-->
<!--    </div>-->
<!--  </header>-->
<!--  @yield('content')-->
  

<!--</body>-->

</html>