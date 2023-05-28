@extends('layouts.main')

@section('style')
    <style>
    .post-img {
        text-align: justify;
        max-width: 600px;
        max-height: 600px
    }
    </style>
@endsection

@section('content')
    <p class="h4 my-4">{{$post->title}}</p>
    <input id="postId" type="hidden" value="{{$post->id}}">
    <div class="col-md-8">
        <div class="bg-white p-5">
            <img style="float:right" src="{{ $post->user->profile_photo_url }}" width="50px" class="rounded-full"/>
            <p class="mt-2 me-3" style="display:inline-block;"><strong>{{$post->user->name}}</strong></p>
            <div class="row mt-2 mb-4">
                <div class="col-3">
                    <i class="far fa-clock"></i> <span class="comment_date text-secondary">{{$post->created_at->diffForHumans()}}</span>
                </div>
                <div class="col-3">
                    <a href="{{ route('category', [$post->category->id, $post->category->slug])}}"><i class="fa-solid fa-align-justify"></i> <span class="comment_date text-secondary">{{$post->category->title}}</span></a>
                </div>
                <div class="col-3">
                    <i class="fa-solid fa-comment"></i> <span class="comment_date text-secondary">{{ $post->comments->count() }} تعليقات</span>
                </div>
            </div>
            @if(file_exists(public_path('/storage/image/'.$post->image_path)))
                <img class="mb-4 mx-auto post-img" src="{{ asset('/storage/image/'.$post->image_path) }}" alt="">
            @endif
            <p class="lh-lg">{!! $post->body !!}</p>
        </div>
    </div>
    @include('partials.slidebar')
@endsection
