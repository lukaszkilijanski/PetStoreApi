<html>
<body>
<form action="{{ route('pets', ['status' => $selectedStatus]) }}" method="GET">
    <select id="status" name="status">
        @foreach ($petStatuses as $petStatus)
            <option
                value="{{$petStatus->value}}"
            @if ($selectedStatus == $petStatus->value)
                selected
                @endif
            >
                {{$petStatus->name}}</option>
        @endforeach
    </select>
    <button type="submit">Change filter</button>
</form>

{{ dd($pets) }}
</body>
</html>
