@extends('layouts.app')

@section('content')
<h1>Add Eatery</h1>
<form class="panel max-w-2xl space-y-4" method="POST" action="{{ route('eateries.store') }}">
    @include('eateries._form')
</form>
@endsection
