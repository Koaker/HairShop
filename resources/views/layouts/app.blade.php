<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HairShop</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>


<body style="height: 100%;">
    <div id="app" style="height: 100%;">
        <nav class="navbar navbar-expand-md navbar-dark bg-custom shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    HairShop
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav mr-5">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('cadastro-cliente') }}">{{ __('Registrar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>

        </nav>
        @auth
        <div class="container-fluid" style="height: 100%;">
            <div class="row" style="height: 100%;">          
               <nav class="col-md-2 bg-custom shadow-sm sidebar navbar-dark">
                   <div class="sidebar-sticky">
                       <ul class="nav flex-column ml-3">
                        <li class="nav-item mt-3"> 
                          <i data-feather="users"></i> Usuários </a>
                                <ul class="nav flex-column ml-3">
                                    <li><i data-feather="chevron-right" ></i> <a href="{{route('cadastro-usuario')}}">Cadastrar usuário</a></li>
                                    <li><i data-feather="chevron-right" size="2"></i> <a href="{{route('listar-usuario')}}">Listar Cliente</a></li>
                                    <li><i data-feather="chevron-right" size="2"></i> <a href="{{route('listar-usuario')}}">Listar Funcionários</a></li>
                                   
                                </ul>
                        </li>
                         <li class="nav-item mt-3"> 
                            <i data-feather="list"></i> Serviços
                            <ul class="nav flex-column ml-3 sub-list" >
                                   <li><i data-feather="chevron-right"></i> <a href="{{route('cadastro-servico')}}">Cadastrar Serviço</a></li>  
                                   <li><i data-feather="chevron-right"></i> <a href="{{route('listar-servico')}}">Listar Serviços</a></li>
                                    <li><i data-feather="chevron-right"></i> <a href="{{route('cadastro-cargo')}}">Cadastrar Cargo</a></li>
                                   <li><i data-feather="chevron-right"></i> <a href="{{route('listar-cargo')}}">Listar Cargos</a></li>
                                  
                                </ul>
                        </li>
                         <li class="nav-item mt-3"> 
                            <i data-feather="book"></i> Agendamentos
                            <ul class="nav flex-column ml-3 sub-list">
                                   <li><i data-feather="chevron-right"></i> <a href="{{route('cadastro-agendamento')}}">Cadastrar agendamento</a></li>
                                   <li><i data-feather="chevron-right"></i> <a href="{{route('listar-agendamento')}}">Listar agendamentos</a></li>
                                 
                                </ul>
                        </li>
                       </ul>
                   </div>
               </nav>
             @endauth 
           

            <main class="col-md-10 mt-5 px-4" role="main">
                @yield('content')
            </main>
        </div> 
    </div>

 

    </div>


      @yield('scripts')
</body>
</html>
  <script>

    $(document).ready(function(){
        feather.replace()
       
        // $(".sidebar .nav-item").click(function(){  

        //  if($(this).children('ul').is(':visible'))
        //    $(this).children('ul').hide()
        // else
        //     $(this).children('ul').show()
            
        // });

    })

      
    </script>