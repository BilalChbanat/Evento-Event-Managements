@extends('layouts.home')
@section('content')
    <main class="w-[80vw]">

        <div class="">
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div class="transition-colors duration-300 w-[95vw] h-[100vh] pt-[5rem]">
                        <div class="container mx-auto  p-4">
                            <div class="bg-white shadow rounded-lg p-6">
                                <a href="{{ route('my.events') }}"
                                    class="ml-6 pb-7 text-[.75rem] p-2 text-gray-500 border-b border-dotted">
                                    <- Back to previous page </a>
                                    @if (session('status'))
                                            <div class="px-4 py-3 leading-normal text-green-700 bg-green-100 rounded-lg w-[40rem] ml-6"
                                                role="alert">
                                                <p> {{ session('status') }}</p>
                                            </div>
                                        @endif
                                        <h1 class="text-xl font-semibold mb-4 text-gray-900">Events Information</h1>
                                        <p class="text-gray-600  mb-6">Use a permanent address where you can receive mail.
                                        </p>

                                        <form action="{{ route('events.create') }}" method="post"
                                            enctype="multipart/form-data">

                                            @csrf
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                                <input type="text" placeholder="Event title"
                                                    class="border p-2 rounded w-full" name="title" required
                                                    value="{{ old('title') }}">
                                                @error('title')
                                                    <span class="text-red-700">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-4 w-full">
                                                <input type="text" placeholder="Event location"
                                                    class="border p-2 rounded w-full" name="location" required
                                                    value="{{ old('location') }}">
                                                @error('location')
                                                    <span class="text-red-700">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-4 w-full">
                                                <input type="number" min="1" placeholder="Event capacity"
                                                    class="border p-2 rounded w-full" name="capacity" required
                                                    value="{{ old('capacity') }}">
                                                @error('capacity')
                                                    <span class="text-red-700">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4 w-full">
                                                <input type="number" min="1" placeholder="Event price"
                                                    class="border p-2 rounded w-full" name="price" required
                                                    value="{{ old('price') }}">
                                                @error('price')
                                                    <span class="text-red-700">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-4 w-full">
                                                <input type="date" class="border p-2 rounded w-full" name="date"
                                                    required value="{{ old('date') }}">
                                                @error('date')
                                                    <span class="text-red-700">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <input type="email" placeholder="Email address"
                                                    class="border p-2 rounded w-full cursor-not-allowed" name="email"
                                                    value="{{ $user->email }}" disabled>
                                            </div>
                                            <div class="mb-4 w-full">
                                                <div class="inline-flex items-center">
                                                    <label
                                                        class="relative flex items-center p-3 rounded-full cursor-pointer"
                                                        htmlFor="check">
                                                        <input type="checkbox" name="acceptance" 
                                                            class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10"
                                                            id="check" />
                                                        <span
                                                            class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                                viewBox="0 0 20 20" fill="currentColor"
                                                                stroke="currentColor" stroke-width="1">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </span>
                                                    </label>
                                                    <label class="mt-px font-light text-gray-700 cursor-pointer select-none"
                                                        htmlFor="check">
                                                        Manual acceptance
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <select name="category_id" id="category_id"
                                                    class="border p-2 rounded w-full">
                                                    @foreach ($categories as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="text-red-700">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- Add similar error handling for other input fields -->

                                            <div class="flex items-center justify-center w-full">
                                                <label for="dropzone-file"
                                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50  hover:bg-gray-100 ">
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        <svg class="w-8 h-8 mb-4 text-gray-500 " aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 20 16">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                        </svg>
                                                        <p class="mb-2 text-sm text-gray-500 "><span
                                                                class="font-semibold">Click
                                                                to
                                                                upload</span>
                                                            or drag and drop</p>
                                                        <p class="text-xs text-gray-500 ">SVG, PNG, JPG or GIF (MAX.
                                                            800x400px)</p>
                                                    </div>
                                                    <input id="dropzone-file" type="file" class="hidden"
                                                        name="image" />
                                                </label>
                                            </div>

                                            <div class="mb-4">
                                                <textarea name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <span class="text-red-700">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <button type="submit" name="addwiki" id="theme-toggle"
                                                class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600 focus:outline-none transition-colors">
                                                Add Event
                                            </button>
                                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
