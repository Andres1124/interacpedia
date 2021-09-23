@extends('layouts.app')

@section('content')
    <section class="container px-6 py-4 mx-auto">
        <a href="{{route('company.create')}}" class="bg-pink-600 rounded" style="display: block; width: 250px; padding: 10px 0; color: #fff;
text-decoration: none; margin: auto; text-align: center; font-weight: 700; font-size: 18px">Registrar empresa</a>
        <div class="grid mb-8 md:grid-cols-3">
            <!-- Card 1 -->
            @foreach( $companies as $company )
                <div class="border-2 mt-10" style="width: 350px; height: 350px; padding-bottom: 12px; border-radius: 10px; background-color: #fff;overflow: hidden">
                    <div class="" style="height: 60%; width: 100%">
                        <img style="height: 100%; width: 100%" src="{{ url($company->imagen )}}" alt="">
                    </div>
                    <div class="py-1 text-center border-2" style="width: 100%; height: 15%; border-right: none; border-left: none; border-top: none;display: flex; align-items: center;justify-content: center;font-weight: 700;">
                        <h4 class="text-center text-black mb-1" style="font-size: 20px;color: #1E40AF">{{$company->nombre}}</h4>
                    </div>
                    <div style="width: 100%; height: 25%; display: flex; align-items: center; justify-content: space-around">
                        <div>
                            <a href="{{ route('company.show', $company) }}" class="bg-pink-600 rounded" style="padding: 8px 15px; color: #fff; font-weight: 600;text-decoration: none">Ver perfil</a>
                        </div>
                        <div>
                            <a href="{{ route('company.edit', $company) }}" class="rounded" style="padding: 7px 14px; color: #DB2777; font-weight: 600; border: 1.5px solid #DB2777;text-decoration: none">Editar</a>
                        </div>
                        <form action="{{ route('company.destroy', $company) }}" method="POST" style="">
                            @csrf
                            @method('delete')
                            <button type="submit" style="padding: 7px 14px; color: #DB2777; font-weight: 600; border: 1.5px solid #DB2777" class="rounded">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
