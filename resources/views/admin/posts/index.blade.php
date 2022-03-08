@extends('layouts.dashboard')

@section('content')
    <section>
        <h1>Lista dei Post</h1>

        <div class="posts">
            <div class="row row-cols-4">

                @foreach ($posts as $post)

                    <div class="col">
                        {{-- Single Card  --}}
                        <div class="card mt-3">
                            @if ($post->cover)
                                <img src="{{asset('storage/' . $post->cover)}}" class="card-img-top" alt="post cover">                                
                            @endif
                            <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text mb-2">Slug: {{ $post->slug }}</p>
                            <p class="card-text">{{ Str::substr($post->content, 0, 70) }}</p>
                            <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary">Visualizza post</a>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>

        <div class="mt-3">
            {{ $posts->links() }}
        </div>
    </section>


@endsection