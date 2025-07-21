@extends('layouts.navbar')

@section('title', 'Edit Profile')

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
</style>
@endsection


@section('content')

<div class="container">
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="media g-mb-30 media-comment">
            <div class="w-50 mx-auto">
                <form action="{{route('user.update', auth()->id())}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul style="margin: 0;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <label for="exampleFormControlInput1" class="form-label mb-3 mt-3">Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name='name' value="{{auth()->user()->name}}">

                    <label for="exampleFormControlTextarea1" class="form-label mb-3 mt-3">Email</label>
                    <input type="email" class="form-control" id="exampleFormControlTextarea1" name='email' value="{{auth()->user()->email}}">

                    <label for="pfp" class="form-label mb-3 mt-3">Profile Picture</label>
                    <input type="file" class="form-control" name="pfp" id="pfp">

                    <label for="bio" class="form-label mb-3 mt-3">Bio</label>
                    <textarea class="form-control" name="bio" id="bio" rows="3">{{ auth()->user()->bio }}</textarea>

                    <div class="mt-3 text-center">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
