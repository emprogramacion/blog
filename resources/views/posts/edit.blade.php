@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Artículo</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Título *</label>
                            <input type="text" name="title" class="form-control" required value="{{ old('title', $post->title) }}">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="file" class="form-control-file">
                        </div>

                    <!-- Inicio: Código para validar imagen en el post y mostrarla, si no muestra un mensaje diciendo que no tiene  -->
                        <!-- @if (!empty($post->image))
                          <div class="col-12">
                            <label>Imagen</label>
                          </div>
                          <div class="center">
                            <img 
                              src="{{ url('storage/'. old('image', $post->image)) }}" 
                              style="width: 60%; height: 80%"  
                              class="rounded mx-auto d-block"
                              alt="image"
                            >
                          </div> 
                        @else
                          <div class="alert alert-secondary" role="alert">
                            Este post no contiene imagen de portada!
                          </div>  
                        @endif -->
                    <!-- Fin: Código para validar imagen en el post y mostrarla, si no muestra un mensaje diciendo que no tiene  -->

                    
                    <!-- Inicio: Código para traer la imagen al formulario de editar -->
                        <!-- <div class="form-group row">
                            <label class="col-8">Imagen</label>
                                <img class="col-6 offset-3" src="{{url('storage/'.$post->image)}}" alt="">
                                <input class="col-12 mt-4" type="file" name="file">
                        </div> -->
                    <!-- Fin: Código para traer la imagen al formulario de editar -->

                        <div class="form-group">
                            <label>Contenido *</label>
                            <textarea name="body" rows="6" class="form-control" required>{{ old('body', $post->body) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Contenido embebido</label>
                            <textarea name="iframe" class="form-control"> {{ old('iframe', $post->iframe) }}</textarea>
                        </div>
                        <div class="form-group">
                            @csrf
                            @method('PUT')
                            <input type="submit" value="Actualizar" class="btn btn-sm btn-primary">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection