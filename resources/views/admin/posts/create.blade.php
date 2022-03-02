@extends('layouts.dashboard')

@section('content')
    <section>
        <h1>Crea un nuovo Post</h1>

        @include('components.error-log')

        {{-- In alternativa al monoblocco puoi usare questo per far apparire il messaggio di errore sotto la input  --}}
        {{-- @error('id_della_input')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror --}}

        <form action="{{ route('admin.posts.store') }}" method="post">
            @csrf
            @method('POST')

            {{-- Post Title  --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>

            {{-- Category  --}}
            <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="">Nessuna</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : ''  }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Content  --}}
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ old('content') }}</textarea>
            </div>

            {{-- Tags  --}}
            <div class="mb-3">
                <h4>Tags:</h4>
    
                @foreach ($tags as $tag)
                    <div class="form-check">
                        {{-- Il name='tags[]' serve a raccogliere le value di ogni input selezionata
                        (in questo caso l'id del tag) nel form dentro l' array tags  --}}
                        {{-- Si puo fare anche con il contain al posto di in array  --}}
                        <input {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} class="form-check-input" type="checkbox" value="{{ $tag->id }}" id="tag-{{ $tag->id }}" name="tags[]">
                        <label class="form-check-label" for="tag-{{ $tag->id }}">
                        {{ $tag->name }}
                        </label>
                    </div>                
                @endforeach
            </div>
               
            <button type="submit" class="btn btn-primary">Crea</button>
        </form>
    </section>
@endsection