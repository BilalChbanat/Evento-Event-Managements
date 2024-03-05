<x-app-layout>
    @include('layouts.aside')
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
        <div class="w-full px-6 py-6 mx-auto">
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div
                        class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                        <div
                            class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between">
                            <h6 class="p-4">Categories managements</h6>
                            
                        </div>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <a href="{{ route('categories.index') }}"
                                    class="ml-6 text-[.75rem] p-2 text-gray-500 border-b border-dotted">
                                    <- Back to previous page </a>

                                        @if (session('status'))
                                            <div class="alert alert-success">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                        <div
                                            class="mt-4 w-full min-w-max p-8 text-center flex flex-col items-center justify-center">
                                            <form class="text-center flex flex-col w-[50%] items-center justify-center"
                                                method="POST" action="{{ url('dashboard/categories/' . $category->id . '/edit') }}">
                                                @csrf
                                                @method('PUT')
                                                <input
                                                    class="px-4 py-1 w-[50%] focus:outline-none border-2 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 rounded-md"
                                                    type="text" required name="name" value="{{$category->name}}"
                                                    placeholder="Tech ...">
                                                @error('name')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                                <button class="bg-sky-900 px-6 py-2 rounded-md mt-3 text-white"
                                                    type="submit">ADD</button>
                                            </form>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
