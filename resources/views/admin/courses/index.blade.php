@extends('layouts.app', ['title' => __('Course Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Courses') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('courses.create') }}" class="btn btn-sm btn-primary">{{ __('Add Course') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    @if (count($courses))
                    <div class="row">
                        @foreach ($courses as $course)
                        <div class="card col-sm-4" style="width: 18rem;">
                            @if ($course->photo)
                            <img class="card-img-top" src="/courses/{{$course->photo->filename}}" alt="Card image cap">
                            @else
                            <img class="card-img-top" src="/courses/1.jpg" alt="Card image cap">
                            @endif
                            <div class="card-body">
                              <h5 class="card-title">{{Str::limit($course->title,100)}}</h5>
                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <form action="{{route('courses.destroy', $course)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{route('courses.edit',$course)}}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{route('courses.show',$course)}}" class="btn btn-info btn-sm">Show</a>
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm" name="deleteCourse">
                            </form>
                            </div>
                          </div>
                        @endforeach
                        </div>
                    @endif
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $courses->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection