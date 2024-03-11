<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>


            <div class="p-4 sm:p-8 bg-gray-100 shadow sm:rounded-lg ">
                <h2 class="text-lg font-medium text-gray-900">My reservations</h2>
                <div class="flex">
                    @foreach ($reservations as $item)
                        <div class="max-w-sm shadow sm:rounded-lg m-5 bg-white">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2 text-gray-800"> {{ $item->event->title }}</div>
                                <p class="text-gray-800 text-base">
                                    {{ $item->reservation_status }}
                                </p>
                            </div>

                            <div class="px-6 pt-4 pb-2 flex justify-between">
                                <span
                                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#
                                    {{ $item->reference }}</span>
                                <div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>

</x-app-layout>
