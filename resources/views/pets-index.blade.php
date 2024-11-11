<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<form action="{{ route('pets', ['status' => $selectedStatus]) }}" method="GET" class="mb-4">
    <div class="flex items-center space-x-4">
        <label for="status" class="font-medium text-gray-700">Filter by Status:</label>
        <select id="status" name="status" class="bg-white border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @foreach ($petStatuses as $petStatus)
                <option value="{{$petStatus->value}}"
                        @if ($selectedStatus == $petStatus->value) selected @endif>
                    {{$petStatus->name}}
                </option>
            @endforeach
        </select>
        <button type="submit" class="bg-indigo-500 text-white px-6 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">Change Filter</button>
    </div>
</form>

<table class="min-w-full table-auto bg-white border border-gray-300 rounded-lg shadow-md">
    <thead>
    <tr class="bg-gray-100 text-gray-700">
        <th class="px-4 py-2 text-left">ID</th>
        <th class="px-4 py-2 text-left">Name</th>
        <th class="px-4 py-2 text-left">Category ID</th>
        <th class="px-4 py-2 text-left">Category Name</th>
        <th class="px-4 py-2 text-left">Tag ID</th>
        <th class="px-4 py-2 text-left">Tag Name</th>
        <th class="px-4 py-2 text-left">Status</th>
        <th class="px-4 py-2 text-left">Edit</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($pets as $pet)
        <tr class="border-t hover:bg-gray-50">
            <td class="px-4 py-2">{{$pet['id']}}</td>
            <td class="px-4 py-2">
                @isset($pet['name'])
                    {{$pet['name']}}
                @else
                    <span class="text-gray-500">Undefined</span>
                @endisset
            </td>
            <td class="px-4 py-2">
                @isset($pet['category']['id'])
                    {{$pet['category']['id']}}
                @else
                    <span class="text-gray-500">Undefined</span>
                @endisset
            </td>
            <td class="px-4 py-2">
                @isset($pet['category']['name'])
                    {{$pet['category']['name']}}
                @else
                    <span class="text-gray-500">Undefined</span>
                @endisset
            </td>
            <td class="px-4 py-2">
                @isset($pet['tags']['id'])
                    {{$pet['tags']['id']}}
                @else
                    <span class="text-gray-500">Undefined</span>
                @endisset
            </td>
            <td class="px-4 py-2">
                @isset($pet['tags']['name'])
                    {{$pet['tags']['name']}}
                @else
                    <span class="text-gray-500">Undefined</span>
                @endisset
            </td>
            <td class="px-4 py-2">{{$pet['status']}}</td>
            <td class="px-4 py-2">
                <a href="" class="text-indigo-600 hover:text-indigo-800">Edit</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
