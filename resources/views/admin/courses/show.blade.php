@extends('layouts.app', ['title' => __('Course Management')])

@section('content')
    @include('admin.users.partials.header', ['title' => __('Show Course')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                            <h3 class="mb-0">{{ __('Course Name:') }} {{$course->title}}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('courses.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="course-img">
                                    @if ($course->photo)
                                    <img class="img-fluid" src="/courses/{{$course->photo->filename}}" alt="">
                                    @else
                                    <img class="img-fluid" src="/courses/1.jpg" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="course-info">
                                <h3>{{$course->title}}</h3>
                                <h5><a href="/admin/tracks/{{$course->track->id}}">{{$course->track->name}}</a></h5>
                                <span class="{{ $course->status == 0 ? 'text-success' : 'text-danger'}}">{{ $course->status == 0 ? 'FREE' : 'PAID'}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3 class="mb-0">{{ __('Videos') }}</h3>
                                </div>
                                <div class="col-2 text-right">
                                <a href="/admin/courses/{{$course->id}}/videos/create" class="btn btn-sm btn-primary">{{ __('Add Video') }}</a>
                                </div>
                                <div class="col-2 text-right">
                                <a href="/admin/courses/{{$course->id}}/quizzes/create" class="btn btn-sm btn-primary">{{ __('Add Quiz') }}</a>
                                </div>
                            </div>
                        </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{$error}}
                                    @endforeach
                                </div>
                            @endif
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
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('Title') }}</th>
                                        <th scope="col">{{ __('Creation Date') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($course->videos))
                                    @foreach ($course->videos as $video)
                                        <tr>
                                        <td title="{{$video->title}}"><a href="{{route('videos.show', $video)}}">{{Str::limit($video->title, 50)}}</a></td>
                                            <td>{{ $video->created_at->diffForHumans() }}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <form action="{{ route('videos.destroy', $video) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            
                                                            <a class="dropdown-item" href="{{ route('videos.edit', $video) }}">{{ __('Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this Track?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>    
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">
                                {{ $course->videos->links() }}
                            </nav>
                        </div> --}}
                    </div>
                </div>
            </div>
        

        @include('layouts.footers.auth')
    </div>
@endsection