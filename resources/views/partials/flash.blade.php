@if (session('status'))
    <p role="status" class="rounded bg-green-100 p-3">{{ session('status') }}</p>
@endif
