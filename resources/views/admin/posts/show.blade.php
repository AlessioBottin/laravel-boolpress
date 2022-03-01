@extends('layouts.dashboard')

@section('content')
    <section>
        <h1 class="mb-4">Dettagli del Post:</h1>

        <h3 class="mb-3">Title: {{ $post->title }}</h3>

        <div class="mb-3">Slug: {{ $post->slug }}</div>

        <div class="mb-3">Categoria: {{ $post->category_id ?  $post->category->name : 'Nessuna' }}</div>

        <div class="mb-3">Tags: 
            @forelse ($post->tags as $tag)
                {{ $tag->name }}{{ !$loop->last ? ',' : '.'}}
            @empty
                Nessun tag
            @endforelse
        </div>
             

        <p><strong>Content:</strong> {{ $post->content }}</p>

        <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Modifica Post</a>

        <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post" class="mt-2">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Azione irreversibile, procedere comunque?')">Cancella Post</button>    
        </form>
    </section>
@endsection