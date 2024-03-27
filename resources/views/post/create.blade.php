@extends('layouts.main')
@section('content')
<div>
<form action="{{route('post.store')}}" method="post">
@csrf
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
  </div>
  <div class="mb-3">
    <label for="content" class="form-label">Content</label>
    <textarea class="form-control" id="content" name="content" placeholder="Content"></textarea>
  </div>
  <div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="text" class="form-control" id="image" name="image" placeholder="Image">
  </div>
  <button type="submit" class="btn btn-primary">Create</button>
</form>
</div>
@endsection