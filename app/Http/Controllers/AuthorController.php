<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
        $authors = Author::with('books')->get();
        return view ('authors.index', compact('authors'));
    }

    public function show($id){
        $authors = Author::with('books')->findOrFail($id);
        return view('authors.index', compact('authors'));
    }

    public function create(){
        return view('authors.create');
    }

    public function store (Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birth_Date' => 'nullable|date',
        ]);

        Author::create($validatedData);
        return redirect()->route('authors.index')->with('sucess', 'Autor criando com sucesso!');
    }

    
    // Função para atualizar um autor no banco de dados
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
        ]);

        $author = Author::findOrFail($id);
        $author->update($validatedData);

        return redirect()->route('authors.index')->with('success', 'Autor atualizado com sucesso!');
    }

    // Função para excluir um autor do banco de dados
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Autor excluído com sucesso!');
    }

}
