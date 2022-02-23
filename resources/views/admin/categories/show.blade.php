@extends('layouts.dashboard')

@section('content')
    <section>
        <h1>Post in questa categoria</h1>

        <div class="posts">
            <div class="row row-cols-4">

                @forelse ($posts as $post)

                    <div class="col">
                        {{-- Single Card  --}}
                        <div class="card mt-3">
                            {{-- <img src="..." class="card-img-top" alt="..."> --}}
                            <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text mb-2">Slug: {{ $post->slug }}</p>
                            <p class="card-text">{{ Str::substr($post->content, 0, 70) }}</p>
                            <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary">Visualizza post</a>
                            </div>
                        </div>
                    </div>

                @empty 
                    <div>Nessun Risultato</div>
                @endforelse
            </div>
        </div>
@endsection
