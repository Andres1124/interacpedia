@extends('layouts.app')

@section('content')

    <div class="continer px-6 py-8 mx-auto">
        <div class="bg-indigo-800" style="width: 100%; height: 300px; border-radius: 20px; display: flex; justify-content: space-around; overflow: hidden; align-items: center">
            <div class="" style="height: 70%; width: 33%; padding: 0 40px">
                <img src="{{$company->imagen}}" alt="photo profile company" style="width: 100%; height: 100%; border-radius: 12px">
            </div>
            <div class="" style="height: 70%; width: 33%; padding: 0 40px; display: flex;flex-direction: column; justify-content: space-around;">
                <h4 style="font-size: 25px; color: #fff;font-weight: 700">{{$company->nombre}}</h4>
                <span style="color: #fff;font-weight: 600">Dirección: <small style="font-size: 14px">{{$company->direccion}}</small></span>
                <span style="color: #fff;font-weight: 600">N° empleados: <small style="font-weight: 400">{{$company->empleados}}</small></span>
                <span style="color: #fff;font-weight: 600">Nit: <small style="font-weight: 400">{{$company->nit}}</small></span>
            </div>
            <div class="" style="height: 70%; width: 33%; padding: 40px 40px; display: flex; justify-content: space-between; flex-direction: column">
                <form action="{{route('company.destroy', $company)}}" method="POST" style="">
                    @csrf
                    @method('delete')
                    <button type="submit" style="padding: 7px 14px; color: #fff; border-radius: 10px; font-weight: 600; border: 1.5px solid #fff" class="">Eliminar</button>
                </form>
                <div>
                    <a href="{{route('company.edit', $company)}}" class="" style="padding: 7px 14px; color: #fff; border-radius: 10px; font-weight: 600; border: 1.5px solid #fff; text-decoration: none">Editar</a>
                </div>
            </div>
        </div>
    </div>
    
@endsection
