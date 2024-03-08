@extends('layouts.home')
@section('content')
    <div class="font-[sans-serif]  mt-8 bg-gray-900">
        <div class="p-6 lg:max-w-7xl max-w-4xl mx-auto">
            <div class="grid items-start grid-cols-1 lg:grid-cols-5 gap-12 p-6">
                <div class="lg:col-span-3 w-full lg:sticky top-0 text-center">
                    <div class="px-4 py-10 rounded-xl  relative">
                        <img src="{{asset($event->image)}}" alt="Product"
                            class="w-4/5 rounded object-cover" />
                    </div>

                </div>
                <div class="lg:col-span-2">
                    <h2 class="text-2xl font-extrabold text-gray-300">{{ $event->title }}</h2>
                    <div class="flex flex-wrap gap-4 mt-6">
                        <p class="text-gray-300 text-4xl font-bold">$ {{ $event->price }}</p>
                        <p class="text-gray-400 text-xl"><strike>$ {{ $event->price + 50 }}</strike> <span
                                class="text-sm ml-1">OFF</span></p>
                    </div>
                    <div class="flex space-x-2 mt-4">
                        <svg class="w-5 fill-gray-300" viewBox="0 0 14 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                        </svg>
                        <svg class="w-5 fill-gray-300" viewBox="0 0 14 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                        </svg>
                        <svg class="w-5 fill-gray-300" viewBox="0 0 14 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                        </svg>
                        <svg class="w-5 fill-gray-300" viewBox="0 0 14 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                        </svg>
                        <svg class="w-5 fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                        </svg>
                        <h4 class="text-gray-300 text-base">500 Reviews</h4>
                    </div>
                    <div class="mt-10">
                        <h3 class="text-lg font-bold text-gray-300">Location</h3>
                        <div class="flex flex-wrap gap-4 mt-4 text-gray-300">
                            {{ $event->location }}
                        </div>
                    </div>
                    <div class="mt-10">
                        <h3 class="text-lg font-bold text-gray-300">Date</h3>
                        <div class="flex flex-wrap gap-4 mt-4 text-gray-300">
                            {{ $event->date }}
                        </div>
                    </div>
                    <div class="mt-10">
                        <h3 class="text-lg font-bold text-gray-300">Description</h3>
                        <div class="flex flex-wrap gap-4 mt-4 text-gray-300">
                            {{ $event->description }}
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-4 mt-10">
                        @guest
                            <a disabled href="{{route('login')}}"
                                class="cursor-not-allowed min-w-[200px] px-4 py-3 bg-yellow-600 hover:bg-yellow-500 text-white text-sm font-bold rounded">Buy
                                now</a>
                        @else
                            <a href="{{ route('reservation.store', $event->id) }}"
                                class="min-w-[200px] px-4 py-3 bg-yellow-600 hover:bg-yellow-500 text-white text-sm font-bold rounded">Buy
                                now</a>
                        @endguest

                    </div>
                </div>
                
            </div>
            <div class="mt-16 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] p-6">
                    <h3 class="text-lg font-bold text-gray-300">Event information</h3>
                    <ul class="mt-6 space-y-6 text-gray-300">
                        <li class="text-sm">Tilte <span class="ml-4 float-right">{{ $event->title }}</span></li>
                        <li class="text-sm">Capacity <span class="ml-4 float-right">{{ $event->capacity }}</span></li>
                        <li class="text-sm">available seates <span class="ml-4 float-right">{{ $event->availableSeats }}</span></li>
                        <li class="text-sm">date <span class="ml-4 float-right">{{$event->date}}</span></li>
                        <li class="text-sm">Category <span class="ml-4 float-right">{{$event->category->name}}</span></li>
                        <li class="text-sm"> Organizer <span class="ml-4 float-right">{{$event->user->name}}</span></li>
                        <li class="text-sm">Published<span class="ml-4 float-right">{{ \Carbon\Carbon::parse($event->created_at)->diffForHumans() }}</span></li>
                    </ul>
                </div>

        </div>
    </div>
@endsection
