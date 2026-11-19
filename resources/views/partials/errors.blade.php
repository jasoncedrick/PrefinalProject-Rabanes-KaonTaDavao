@if ($errors->any())
    <div class="rounded border border-red-300 bg-red-50 p-4 text-red-800" role="alert">
        <p class="font-semibold">Please check the form.</p>
        <ul class="list-inside list-disc">
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
