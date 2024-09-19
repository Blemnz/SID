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

    @include('massage.massageError')
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">SID</th>
            <th scope="col">Antrian</th>
            <th scope="col">Originating</th>
            <th scope="col">Terminating</th>
            <th scope="col">Service</th>
            <th scope="col">Bulan</th>
            <th scope="col">Tahun</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ strVal($item->id) }}</td>
                <td>{{ $item->antrian }}</td>
                <td>{{ $item->originating }}</td>
                <td>{{ $item->terminating }}</td>
                <td>{{ $item->service }}</td>
                <td>{{ $item->bulan }}</td>
                <td>{{ $item->tahun }}</td>
                <td>
                    <a href="{{ url('admin/terminating/'.$item->id.'/edit') }}" class="btn btn-primary"> <i data-feather="edit"></i></a>
                    <form class="d-inline" onsubmit="return confirm('Yakin akan menghapus data?')"  action="{{ url('terminating/delete/'.$item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i data-feather="x-square"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </main>
@endsection

