@extends('layouts.app')

@section('content')

    <div class="px-6 mx-auto">
        <div class="border-2" style="width: 800px; margin: auto; height: 550px; background-color: #fff;overflow: hidden; border-radius: 20px">
            <div style="height: 15%; display: flex;align-items: center;justify-content: center" class="bg-indigo-800">
                <span style="text-align: center; font-size: 25px; color: #fff; font-weight: 700">Editar Empresa</span>
            </div>
            <div style="height: 95%">
                <form action="{{route('company.update', $company)}}" method="POST" enctype="multipart/form-data" style="height: 90%; display: flex;flex-direction: column; justify-content: space-around">
                    @csrf
                    @method('put')
                    <div style="padding: 5px 50px;">
                        <label for="" style="display: block; color: #1E40AF; font-weight: 600">Nombre:</label>
                        <input type="text" name="nombre" value="{{$company->nombre}}" style="width: 100%; padding: 8px 8px" class="focus:outline-none rounded border">
                        @error('nombre')
                        <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                    <div style="padding: 5px 50px;">
                        <label for="" style="display: block; color: #1E40AF; font-weight: 600">Nit:</label>
                        <input type="number" name="nit" value="{{$company->nit}}" style="width: 100%; padding: 8px 8px" class="focus:outline-none rounded border">
                        @error('nit')
                        <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                    <div style="padding: 5px 50px;">
                        <label for="" style="display: block; color: #1E40AF; font-weight: 600">Dirección:</label>
                        <input type="text" name="direccion" value="{{$company->direccion}}" style="width: 100%; padding: 8px 8px" class="focus:outline-none rounded border">
                        @error('direccion')
                        <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                    <div style="padding: 5px 50px;">
                        <label for="" style="display: block; color: #1E40AF; font-weight: 600">N° empleados:</label>
                        <input type="number" name="empleados" value="{{$company->empleados}}" style="width: 100%; padding: 8px 8px" class="focus:outline-none rounded border">
                        @error('empleados')
                        <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                    <div style="padding: 5px 50px;">
                        <label for="" style="display: block; color: #1E40AF; font-weight: 600">Imagen:</label>
                        <input type="file" name="imagen" accept="image/*" style=" width: 100%" value="{{$company->imagen}}">
                        @error('imagen')
                        <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" style="width: 200px; padding: 8px 0;text-align: center; margin: auto;color: #fff; font-weight: 700" class="bg-pink-600 rounded">Editar</button>
                </form>
            </div>

        </div>
    </div>

@endsection