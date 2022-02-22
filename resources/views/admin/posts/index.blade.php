@extends('layouts.dashboard')

@section('content')
    <section>
        <h1>Lista dei Post</h1>

        <div class="posts">
            <div class="row row-cols-4">

                @foreach ($posts as $post)

                    {{-- Single Card  --}}
                    <div class="card">
                        {{-- <img src="..." class="card-img-top" alt="..."> --}}
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </section>


@endsection