<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category as CategoryModel;

class Categories extends Controller
{
    public function index()
    {
        $categories = $this->getCategories();
        return view('settings.categories', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        try {
            CategoryModel::create([
                'description' => $request->description,
                'created_at' => date('d-m-Y')
            ]);

            return back()->with('success', 'Categoria cadastrada com sucesso!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Erro ao cadastrar categoria!');
        }
    }

    public function getCategories()
    {
        return CategoryModel::query()
            ->select('id', 'description')
            ->get();
    }

    public function destroy($id)
    {
        try {
            CategoryModel::find($id)->delete();
            return back()->with('success', 'Categoria removida com sucesso!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Erro ao remover categoria!');
        }
    }

    public function edit($id)
    {
        $category = CategoryModel::find($id);

        return view('settings.edit.categories', ['category' => $category]);
    }
}
