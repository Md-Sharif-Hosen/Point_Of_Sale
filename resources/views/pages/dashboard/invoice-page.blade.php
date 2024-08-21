@extends('layout.sidenav-layout')
@section('content')
    @incl
    @include('components.invoice.invoice-list')
    @include('components.invoice.invoice-details')
    @include('components.invoice.invoice-delete')
@endsection