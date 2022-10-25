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
                        <!-- <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="file" class="form-control-file">
                        </div> -->

                        <!-- Inicio: Código para traer la imagen al formulario de editar y validando imagen -->
                        <div class="form-group">
                            <label>Imagen</label>
                            @if(!empty($post->image))
                            <div class="div">
                                <img class="card-img-top" src="{{ url('storage/'. old('image', $post->image)) }}" alt="image">
                                <input class="col-12 mt-3 offset-3" type="file" name="file">
                            </div>
                            @else
                            <div class="alert alert-secondary" role="alert">
                                ¡Este post no contiene imagen de portada!
                            </div>
                            <input class="form-control-file" type="file" name="file">
                            @endif
                        </div>
                        <!-- Fin: Código para traer la imagen al formulario de editar  y validando imagen-->

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