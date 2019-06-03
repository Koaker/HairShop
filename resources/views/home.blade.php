@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            
                
                    @if (!Auth::check())
                    <p> Você não está logado </p>
                    @endif
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @can('isAdmin')
                    Você esta logado como administrador!
                   
                    @include('dashboard-admin')
                     
                 
                    @endcan

                    @can('isVendedor')
                    Você está logado como Vendedor
                    
                    @endcan
                 
                
        
    </div>
</div>

@endsection
  