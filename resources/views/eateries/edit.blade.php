@extends('layouts.app')

@section('content')
<h1>Edit Eatery</h1>
<form class="panel max-w-2xl space-y-4" method="POST" action="{{ route('eateries.update', $eatery) }}">
    @method('PUT')
    @include('eateries._form')
</form>
@endsection
