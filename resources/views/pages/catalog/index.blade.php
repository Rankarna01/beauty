@extends('layouts.app')

@section('content')
    <livewire:catalog-list :category="$category" />
@endsection
