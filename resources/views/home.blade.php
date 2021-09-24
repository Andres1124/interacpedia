@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-blue-600 title-home ">Bienvenido</h1>
    </div>
    <div class="grid gap gap-6 md:grid-cols-1 lg:grid-cols-2">
        <div class="box-home rounded border">
            <div class="w-full border-b-2 mx-auto px-4">
                <h2 class="text-blue-600 subtitle">Empresas</h2>
            </div>
            <div class="w-full py-5">
                <p class="text-base tracking-wide paragraph">Crea, edita empresas, todo a tu gusto.</p>
            </div>
            
            <a href="{{ route('companies') }}" class="btn-home rounded">Ir a empresas</a>
        </div>
        <div class="box-home border rounded">
            <div class="w-full border-b-2 mx-auto px-4">
                <h2 class="text-blue-600 subtitle">Desafíos</h2>
            </div>
            <div class="w-full py-5">
                <p class="text-base tracking-wide paragraph">Crea y asigna desafíos a las empresas creadas.</p>
            </div>
            <a href="{{ route('challenges') }}" class="btn-home rounded">Ir a desafíos</a>
        </div>
@endsection
