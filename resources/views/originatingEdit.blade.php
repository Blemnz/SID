@extends('partials.layout')
@section('container')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">{{ $tittle }}</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
          <svg class="bi"><use xlink:href="#calendar3"/></svg>
          This week
        </button>
      </div>
    </div>

    <form action="{{ url('originating/'.$data->id.'/edit') }}" method="POST">
        @csrf
        @method('PUT')
        @include('massage.massageError')
        <div class="mb-3">
          <label for="exampleInputProduct" class="form-label">Name</label>
          <input type="text" name="name" class="form-control" id="exampleInputProduct" required value="{{ $data->name }}">
        </div>
        <div class="mb-3">
          <label for="exampleInputDescription" class="form-label">Kode</label>
          <input type="text" name="kode" class="form-control" id="exampleInputDescription" required value="{{ $data->kode }}">
        </div>
        <button type="submit" class="btn btn-primary">edit</button>
      </form>
  </main>
@endsection
