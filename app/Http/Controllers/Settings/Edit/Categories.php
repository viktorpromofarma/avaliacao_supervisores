<?php

namespace App\Http\Controllers\Settings\Edit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category as CategoryModel;

class Categories extends Controller
{
    public function update(Request $request)
    {
        try {

            CategoryModel::where('id', $request->id)
                ->update([
                    'description' => $request->description
                ]);

            return redirect()->route('settings.categories')->with('success', 'Categoria atualizada com sucesso!');
        } catch (\Throwable $th) {

            return back()->with('error', 'Erro ao atualizar categoria!');
        }
    }
}
