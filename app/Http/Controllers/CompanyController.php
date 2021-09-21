<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id', 'asc')->paginate(5);

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                               'nombre' => 'required',
                               'nit'=> 'required',
                               'direccion' => 'required',
                               'empleados'=> 'required',
                               'imagen'=> 'required|image|max:2040',
                           ]);
        $company = new Company();
        $company->nombre = $request->nombre;
        $company->nit = $request->nit;
        $company->direccion = $request->direccion;
        $company->empleados = $request->empleados;
        $imagen = $request->file('imagen')->store('public/imagenes');
        $company->imagen = Storage::url($imagen);

        $company->save();
        return redirect()->route('companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.profile', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
                               'nombre' => 'required',
                               'nit'=> 'required',
                               'direccion' => 'required',
                               'empleados'=> 'required',
                               'imagen'=> 'image|max:2040',
                           ]);
        if(isset($request->imagen)){
            $company->nombre = $request->nombre;
            $company->nit = $request->nit;
            $company->direccion = $request->direccion;
            $company->empleados = $request->empleados;
            $imagen = $request->file('imagen')->store('public/imagenes');
            $company->imagen = Storage::url($imagen);

            $company->update();
            return redirect()->route('company.show', $company);
        }else{
            $request->imagen = $company->imagen;
            $company->update($request->all());
            return redirect()->route('company.show', $company);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies');
    }
}
