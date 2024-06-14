@extends('layouts.layoutC2')
@section('content')

<?php

?>

<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
        </ol>
    </nav>
</div>

<div class="post-content">
    <div class="category-post">
        <div class="panel panel-default ct-item-post">
            <div class="panel-heading <?php echo $retVal = (isset($slug_post)) ? "" : "active" ;?>">
                <h4 class="panel-title">
                    <a href="{{URL::to('/post')}}" class="link-ct-post">Mới nhất</a>
                </h4>
            </div>
        </div>
        @foreach($typeP as $t)
        <div class="panel panel-default ct-item-post">
            <div class="panel-heading <?php if (isset($slug_post)) {
                if($slug_post == $t->slug_typePost) echo "active";
            }?>">
                <h4 class="panel-title">
                    <a href="{{URL::to('/post/'.$t->slug_typePost)}}" class="link-ct-post">{{$t->name_typePost}}</a>
                </h4>
            </div>
        </div>
        @endforeach
    </div>
    <div class="list-post">
        <ul class="new-list">
            @foreach($post as $p)
            <li class="item-list-post">
                <a href="{{URL::to('/post/detail/'.$p->slug_post)}}">
                    <div class="img-post">
                        <img src="{{URL::to('/public/upload/post/'.$p->avatar_post)}}" alt="{{$p->name_post}}"
                        width="250" height="140">
                    </div>
                    <h3 class="title-post">{{$p->name_post}}</h3>
                    <div class="time-post">
                        <div class="info-post">
                            <span>{{$p->author_post}}</span>
                            <span style="margin-left: 15px;">{{$p->created_at}}</span>
                        </div>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>


@endsection