@extends('main')

@section('content')
    <a href="{{route('pets')}}"
       class="text-blue-600 hover:text-blue-800 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-400 p-2 rounded-md">
        ← Go back
    </a>
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md border border-gray-300">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Pet</h2>
        <form action="{{ route('pet.save') }}" method="post">
            @csrf
            @method('POST')
            <input type="hidden" name="id" value="{{$pet->id ?? ''}}"/>
            <input type="hidden" name="photoUrls" value="0"/>
            <input type="hidden" name="tags" value="0"/>
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name:</label>
                <input type="text" id="name" name="name" value="{{ $pet->name ?? '' }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="mb-4">
                <label for="category_name" class="block text-gray-700">Category Name:</label>
                <input type="text" id="category_name" name="category[name]" value="{{ $pet->category['name'] ?? '' }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="mb-4">
                <label for="tag_name" class="block text-gray-700">Status name:</label>
                <select id="status" name="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @foreach ($petStatuses as $petStatus)
                        <option value="{{$petStatus->value}}"
                                @isset($pet)
                                    @if ($pet->status == $petStatus->value) selected @endif
                            @endisset
                        >{{$petStatus->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="tag_name" class="block text-gray-700">Tags</label>
                <div id="existed_tags">
                    @isset($pet)
                        @foreach($pet->tags as $tag)
                            <div class="tag" id="{{$loop->index}}_existing_tag_input">{{$tag['name']}}
                                <button type="button"
                                        class=" ml-4 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75"
                                        onclick="deleteTag({{$loop->index}})"> x
                                </button>
                                <input type="hidden" value="{{$tag['name']}}" name="{{$loop->index}}_existing_tag"/>
                            </div>
                        @endforeach
                    @endisset
                </div>
                <div id="tags-list">
                </div>
            </div>

            <div class="relative group">
                <input type="text" id="tag-input-field" placeholder="Insert new tag here"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"/>
                <div class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-2 hidden group-hover:block bg-gray-800 text-white text-sm px-2 py-1 rounded">
                    Remember to click "Add tag button" only tags above this input will be added.
                </div>
            </div>

            <button id="add_tag"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                Add tag
            </button>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tagInputField = document.getElementById('tag-input-field');
            const tagsList = document.getElementById('tags-list');
            const tagsInput = document.getElementById('tags');
            let tags = [];

            function renderTags() {
                tagsList.innerHTML = '';
                tags.forEach((tag, index) => {
                    const tagElement = document.createElement('div');
                    tagElement.classList.add('tag');
                    tagElement.innerText = tag;
                    tagElement.setAttribute('name', index + '_new_tag');
                    tagElement.setAttribute('data-index', index);
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = index + '_new_tag';
                    hiddenInput.value = tag;
                    tagElement.appendChild(hiddenInput);
                    tagElement.innerHTML += '<button type="button" class=" ml-4 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75" onclick="removeTag(' + index + ')"> x </button>';
                    tagsList.appendChild(tagElement);
                });
                tagsInput.value = tags.join(',');
            }

            const button = document.getElementById("add_tag");
            if (button) {
                button.addEventListener("click", function () {
                    event.preventDefault();
                    const tag = tagInputField.value.trim();
                    if (tag && !tags.includes(tag)) {
                        tags.push(tag);
                        renderTags();
                    }
                    tagInputField.value = '';
                });
            }

            tagInputField.addEventListener('keydown', function (event) {
                if (event.key === 'Enter' || event.key === ',') {
                    event.preventDefault();
                    const tag = tagInputField.value.trim();
                    if (tag && !tags.includes(tag)) {
                        tags.push(tag);
                        renderTags();
                    }
                    tagInputField.value = '';
                }
            });

            window.removeTag = function (index) {
                tags.splice(index, 1);
                renderTags();
            };

            window.deleteTag = function (id) {
                const tagInput = document.getElementById(id + '_existing_tag_input');
                tagInput.remove();
            }
        });
    </script>

@endsection
