<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Requests\PostRequest;

use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->latest()->get(); //Traer los post del usuario logueado.
        // $posts = Post::latest()->get(); //Traer los posts de todos los usuarios.

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //dd($request->all());
        //salvar
        $post = Post::create([
            'user_id' => auth()->user()->id
        ] + $request->all());

        //imagen
        if($request->file('file')){
            $post->image = $request->file('file')->store('posts','public');
            $post->save();
        }

        //retornar
        return back()->with('status','Creado con éxito');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        //dd($request->all());
        
        // $post->update($request->all()); //Actualizar todos los campos masivamente.

        //Actualizar campos en específicos (campos requeridos)
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'iframe' => $request->iframe
        ]);

        if($request->file('file')){
            Storage::disk('public')->delete($post->image);
            $post->image = $request->file('file')->store('posts','public');
            $post->save();
        }

        //Retornar a la vista anterior
        // return back()->with('status','Actualizado con éxito');

        //Retornar a la ruta especificada enviando el objeto actualizado (Solución para el slug).
        return redirect()->route('posts.edit', $post)->with('status','Actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //eliminación imagen
        Storage::disk('public')->delete($post->image);
        $post->delete();

        return back()->with('status','Eliminado con éxito');
    }
}
