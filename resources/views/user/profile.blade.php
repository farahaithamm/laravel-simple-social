@extends('layouts.navbar')

@section('title', $user->name . "'s Profile")

@section('style')
<style>
.fake-link {
    background: none;
    border: none;
    padding: 0;
    font: inherit;
    color: #777;
    cursor: pointer;
    text-decoration: underline;
}

@media (min-width: 0) {
    .g-mr-15 {
        margin-right: 1.07143rem !important;
    }
}
@media (min-width: 0){
    .g-mt-3 {
        margin-top: 0.21429rem !important;
    }
}

.g-height-50 {
    height: 50px;
}

.g-width-50 {
    width: 50px !important;
}

@media (min-width: 0){
    .g-pa-30 {
        padding: 2.14286rem !important;
    }
}

.g-bg-secondary {
    background-color: #fafafa !important;
}

.u-shadow-v18 {
    box-shadow: 0 5px 10px -6px rgba(0, 0, 0, 0.15);
}

.g-color-gray-dark-v4 {
    color: #777 !important;
}

.g-font-size-12 {
    font-size: 0.85714rem !important;
}

.media-comment {
    margin-top:20px;
    margin-bottom:20px;
}

.media-body{
    margin-top:20px;
    margin-bottom:20px;
}

body{
    background:#eee;
}

.si-border-round {
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%;
}

.social-icon-sm {
    margin: 0 5px 5px 0;
    width: 30px;
    height: 30px;
    font-size: 18px;
    line-height: 30px !important;
    color: #555;
    text-shadow: none;
    border-radius: 3px;
    overflow: hidden;
    display: block;
    float: left;
    text-align: center;
    border: 1px solid #AAA;
}
.tabs-admin > .nav-item > .nav-link.active {
    border-color: #0073ff;
    color: #0073ff;
}

.tabs-admin > .nav-item > .nav-link {
    padding: 10px 15px;
    color: #555;
    font-weight: 600;
    text-transform: capitalize;
    margin-bottom: -2px;
    border-bottom: 2px solid transparent;
}
.act-content span.text-small {
    display: block;
    color: #999;
    margin-bottom: 10px;
    font-size: 12px;
}

.text-small {
    font-size: 12px !important;
}
.admin-tab-content {
    padding: 10px 15px;
}

.pt30 {
    padding-top: 30px !important;
}
.card .card-title {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 28px;
    font-size: .9rem;
    font-weight: 600;
    line-height: 28px;
}

.card{
    background-color: #fafafa;
}

.mb20 {
    margin-bottom: 20px !important;
}
.pb20 {
    padding-bottom: 20px !important;
}

.pt20 {
    padding-top: 20px !important;
}
.text-small {
    font-size: 12px !important;
}

.text-muted {
    color: #999 !important;
}
.card .card-content {
    padding: 15px 15px;
}
.profile-header {
  background-size: cover;
  position: relative;
  overflow: hidden;
}

.profile-header .img-fluid.rounded-circle {
    max-width: 100px;
    margin: 0 auto;
    margin-bottom: 20px;
    display: block; }

.activity-list > li {
  border-bottom: 1px solid #eee;
  padding-bottom: 20px;
  margin-bottom: 20px; }

.activity-list .float-left {
  margin-right: 10px;
  width: 40px;
  height: 40px;
  float: left;
  display: block;
  border-radius: 50%;
  background-color: #eee;
  font-size: 20px;
  line-height: 100%;
  line-height: 43px;
  text-align: center; }
  .activity-list .float-left a {
    display: inline-block;
    color: #999; }

.act-content {
  overflow: hidden; }
  .act-content span.text-small {
    display: block;
    color: #999;
    margin-bottom: 10px;
    font-size: 12px; }
</style>
@endsection


@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-4 mb30 mt-30" style="padding-top: 20px">
            <div class="card">
                <div class="card-content pt20 pb20 profile-header">
                    <img src="{{ asset($user->pfp) }}"
                    alt="Profile Picture"
                    class="d-block mx-auto"
                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">

                    <h2 class="text-center mb10" >{{$user->name}}</h2>
                    <h5 class="text-center mb20" style="color:#999">{{$user->email}}</h5>
                    <p>
                        {{$user->bio}}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb30" style="padding-top: 20px">
            <div class="card">

                    <ul class="nav tabs-admin" role="tablist">
                        <li role="presentation" class="nav-item"><a class="nav-link active" href="#t1" aria-controls="t1" role="tab" data-toggle="tab">Posts</a></li>
                    </ul>

                    <div class="media g-mb-30 media-comment">
                        @foreach ($posts as $post)
                            <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                            <div class="g-mb-15">
                                <h5 class="h5 g-color-gray-dark-v1 mb-0">{{$post->user->name}}</h5>
                                <span class="g-color-gray-dark-v4 g-font-size-12">{{ $post->created_at->copy()->addHours(3)->format('d/m/Y h:i A') }}</span>
                            </div>
                            <p>{{$post['title']}}</p>

                            <ul class="list-inline d-sm-flex my-0">
                                <li class="list-inline-item g-mr-20">
                                    <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="{{route('posts.show', $post['id'])}}">
                                        View Post
                                    </a>
                                </li>
                                @if ($post['user_id'] == auth()->id())
                                    <li class="list-inline-item g-mr-20">
                                        <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="{{route('posts.edit', $post['id'])}}">
                                            Edit
                                        </a>
                                    </li>
                                    <li class="list-inline-item g-mr-20">
                                        <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="fake-link">Delete</button>
                                        </form>
                                    </li>
                                @endif
                            </ul>
                            </div>
                        @endforeach
                    </div>
        </div>
    </div>
</div>
@endsection
