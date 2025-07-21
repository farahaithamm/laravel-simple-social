@extends('layouts.navbar')

@section('title', 'View Post')

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

body{
    background:#eee;
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
    margin-top:30px
}

.media-body{
    margin-top:10px;
    margin-bottom:20px;
}

</style>
@endsection


@section('content')

<div class="container">
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="media g-mb-30 media-comment">
                <img src="{{ asset($post->user->pfp) }}"
                alt="User Image"
                style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;"
                class="d-block g-mt-3 g-mr-15">

                <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                <div class="g-mb-15">
                            <a href="{{ route('profile', $post->user->id) }}" class="h3 g-color-gray-dark-v1 mb-0" style="display: block; text-decoration: none;">
                                {{ $post->user->name }}
                            </a>
                    <span class="g-color-gray-dark-v4 g-font-size-12">{{ $post->created_at->copy()->addHours(3)->format('d/m/Y h:i A') }}</span>
                </div>
                <h5>{{$post['title']}}</h5>
                <p>{{$post['description']}}</p>

                <ul class="list-inline d-sm-flex my-0">
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
        </div>
        <div class="media g-mb-30 media-comment mt-4">
            <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                <form action="{{ route('comments.store', $post->id) }}" method="POST">
                    @csrf
                    <div class="d-flex align-items-start">
                        <textarea name="body" class="form-control me-2" rows="1" placeholder="Write your comment..." style="resize: none; flex: 1;"></textarea>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </div>
                </form>
            </div>
        </div>
        <h5 class="mt-4 ms-2">Comments</h5>

        @forelse($post->comments as $comment)
            <div class="media g-mb-30 media-comment" style="max-width: 95%; margin-left: auto; margin-right: auto;">
                <img src="{{ asset($comment->user->pfp ?? 'default.png') }}"
                    alt="User Image"
                    style="width: 45px; height: 45px; object-fit: cover; border-radius: 50%;"
                    class="d-block g-mt-3 g-mr-15">

                <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                    <div class="g-mb-15">
                        <strong class="h6 mb-0">
                            <a href="{{ route('profile', $comment->user->id) }}" class="text-dark text-decoration-none">
                                {{ $comment->user->name }}
                            </a>
                        </strong>
                        <span class="g-color-gray-dark-v4 g-font-size-12"> – {{ $comment->created_at->copy()->addHours(3)->format('d/m/Y h:i A') }}</span>
                    </div>

                    <p class="mb-0">{{ $comment->body }}</p>

                    @if (auth()->id() === $comment->user_id)
                        <li class="list-inline-item g-mr-20">
                            <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="{{ route('comments.edit', $comment->id) }}">
                                Edit
                            </a>
                        </li>
                        <li class="list-inline-item g-mr-20">
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="fake-link">Delete</button>
                            </form>
                        </li>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-muted ms-2" >No comments yet.</p>
        @endforelse
    </div>
</div>

@endsection
