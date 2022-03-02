@extends('layouts.dashboard')

@section('content')
    <section>
        <h1>Modifica il Post</h1>

        @include('components.error-log')

        <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post">
            @csrf
            @method('PUT')

            {{-- Post title  --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
            </div>

            {{-- Category  --}}
            <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="">Nessuna</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category->id) == $category->id ? 'selected' : ''  }}>{{ $category->name }}</option>
                    @endforeach
                    
                </select>
            </div>

            {{-- Content  --}}
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ old('content', $post->content) }}</textarea>
            </div>

            {{-- Tags  --}}
            <div class="mb-3">
                <h4>Tags:</h4>
    
                @foreach ($tags as $tag)
                    <div class="form-check">
                        @if ($errors->any())
                            {{-- Se ci sono errori di validazione, decido se mettere checked o meno in base a old() 
                            perche' altrimenti in_array cercherebe dentro $post->tags che e' una classe e non un array --}}
                            <input {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
                        @else
                            {{-- Atrimenti se non ci sono errori di validazione, decido se mettere checked o meno in base a $post->tags->contains --}}
                            <input {{ $post->tags->contains($tag) ? 'checked' : '' }} class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
                        @endif
                        
                        <label class="form-check-label" for="tag-{{ $tag->id }}">
                        {{ $tag->name }}
                        </label>
                    </div>                
                @endforeach
            </div>
               
            <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
    </section>
@endsection