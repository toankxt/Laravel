@extends('layouts.app')

@section('content')
  <h1 class="">Services</h1>
  <p class="">This is page Services</p>

  @if( count( $services ) > 0)
  <ul>
    @foreach ( $services as $service)
      <li> {{ $service }} </li>
    @endforeach
  </ul>
  @endif
@endsection
