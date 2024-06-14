@extends('layouts.layoutC2')
@section('content')

<?php

?>

<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{URL::to('/post')}}">Tin tức</a></li>
            <li class="breadcrumb-item"><a href="{{URL::to('/post/'.$post->type->slug_typePost)}}">{{$post->type->name_typePost}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bài viết</li>
        </ol>
    </nav>
</div>

<div class="post-content">
    <article>
        <h1 class="title-detail-post">{{$post->name_post}}</h1>
        <div class="author-post">
            <div>{{$post->author_post}}<span> - {{$post->created_at}}</span></div>
        </div>
        <div class="img-detail-post">
            <img src="{{URL::to('/public/upload/post/'.$post->avatar_post)}}" alt="{{$post->name_post}}">
        </div>
        <div class="content-detail-post">
            <?php echo $post->content_post ?>
        </div>
    </article>
</div>


@endsection