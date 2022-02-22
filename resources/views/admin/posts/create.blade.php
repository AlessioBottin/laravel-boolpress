@extends('layouts.dashboard')

@section('content')
    <section>
        <h1>Crea un nuovo Post</h1>

        @include('components.error-log')

        <form action="{{ route('admin.posts.store') }}" method="post">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ old('content') }}</textarea>
            </div>
               
            <button type="submit" class="btn btn-primary">Crea</button>
        </form>
    </section>
@endsection