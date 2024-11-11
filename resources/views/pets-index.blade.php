@extends('main')

@section('content')
    <div class="mb-4 mt-4">
        <form action="{{ route('pet.find') }}" method="GET">
            <div class="flex items-center space-x-2">
                <input type="text" id="search" name="id"
                       class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Find by ID">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Find
                </button>
            </div>
        </form>
    </div>
    <a href="{{ route('pet.create') }}"
       class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-300 transition-all duration-200">
        Create New Pet
    </a>
    <form action="{{ route('pets', ['status' => $selectedStatus]) }}" method="GET" class="mb-4 mt-4">
        <div class="flex items-center space-x-4">
            <label for="status" class="font-medium text-gray-700">Filter by Status:</label>
            <select id="status" name="status"
                    class="bg-white border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @foreach ($petStatuses as $petStatus)
                    <option value="{{$petStatus->value}}"
                            @if ($selectedStatus == $petStatus->value) selected @endif>
                        {{$petStatus->name}}
                    </option>
                @endforeach
            </select>
            <button type="submit"
                    class="bg-indigo-500 text-white px-6 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Change Filter
            </button>
        </div>
    </form>
    <table class="min-w-full table-auto bg-white border border-gray-300 rounded-lg shadow-md">
        <thead>
        <tr class="bg-gray-100 text-gray-700">
            <th class="px-4 py-2 text-left">ID</th>
            <th class="px-4 py-2 text-left">Name</th>
            <th class="px-4 py-2 text-left">Category ID</th>
            <th class="px-4 py-2 text-left">Category Name</th>
            <th class="px-4 py-2 text-left">Tags</th>
            <th class="px-4 py-2 text-left">Status</th>
            <th class="px-4 py-2 text-left">Edit</th>
            <th class="px-4 py-2 text-left">Remove</th>
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
                    @isset($pet['tags'])
                        @foreach($pet['tags'] as $tags)
                            <div>
                                #{{$tags['name']}}
                            </div>
                        @endforeach
                    @else
                        <span class="text-gray-500">Undefined</span>
                    @endisset
                </td>
                <td class="px-4 py-2">{{$pet['status']}}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('pet.edit', ['petId' => $pet['id']]) }}"
                       class="text-indigo-600 hover:text-indigo-800">Edit</a>
                </td>
                <td class="px-4 py-2">
                    <form action="{{ route('pet.remove', ['petId' => $pet['id']]) }}" method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="text-red-600 hover:text-red-800">
                            Remove
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection



