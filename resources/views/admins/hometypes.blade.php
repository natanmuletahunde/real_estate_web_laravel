@extends('layouts.admin')

@section('content')


<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        @if (\Session::has('success'))
        <div class="alert alert-success">
          <p>{!!\Session::get('success') !!}</p>
        </div>
        @endif
        <h5 class="card-title mb-4 d-inline">Hometypes</h5>
        <a href="{{route('hometypes.create')}}" class="btn btn-primary mb-4 text-center float-right">Create Hometypes</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">name</th>
              <th scope="col">update</th>
              <th scope="col">delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ( $allHomeTypes as $hometype )
            <tr>
              <th scope="row">{{$hometype->id}}</th>
              <td>{{$hometype->hometypes}}</td>
              <td><a href="{{route('hometypes.edit',$hometype->id)}}" class="btn btn-warning text-white text-center ">Update</a></td>
              <td><a href="delete-hometype.html" class="btn btn-danger  text-center ">Delete</a></td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection