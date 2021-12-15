@extends('master.layout')
@section('content')
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    
    <h1 style='color:white'>CADASTRO DE URL</h1> 

    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-4 md:grid-cols-4">
            <div class="p-6">
                <div class="flex items-center">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel.com/docs" class="underline text-gray-900 dark:text-white">BEM VINDO</a></div>
                </div>

                <div class="col-12">
                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        Estamos disponibilizando para você um sistema de cadastro de URL para organizar os links favoritos ou de trabalho para futuras consultas. 
                        Os links serão validados a cada 10 minutos e disponilizados no sistema para sua apreciação.  É necessario o registro, escolha uma das opções:
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Login</a>
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Registrar</a>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

</div>
@endsection