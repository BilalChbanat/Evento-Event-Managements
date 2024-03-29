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
                            <h6 class="p-4">Events managements</h6>
                            <a href="{{ route('events.create') }}"
                                class="text-white p-2 h-[2.5rem] bg-sky-900 rounded-md ">Add Event</a>
                        </div>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                #</th>
                                            <th
                                                class="px-6 py-3 pl-2 font-bold  uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 flex text-center items-center justify-center">
                                                name</th>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                email</th>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                created_at</th>
                                            
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
                                            <tr>
                                                <td
                                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <div class="flex px-6 py-1">
                                                        <span>{{$item->id}}</span>
                                                    </div>
                                                </td>
                                                <td
                                                    class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <span
                                                        class="text-xs font-semibold leading-tight text-slate-400">{{ $item->name }}</span>
                                                </td>
                                                <td
                                                    class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <span
                                                        class="text-xs font-semibold leading-tight text-slate-400">{{ $item->email }}</span>
                                                </td>
                                                <td
                                                    class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <span
                                                        class="text-xs font-semibold leading-tight text-slate-400">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                                </td>
                                                

                                                <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent pl-5">
                                            
                                                <a onclick="return confirm('Are you sure You want to Ban the user ?')" href=" {{ url('dashboard/users/'.$item->id.'/delete') }}"
                                                    class="text-xs font-semibold leading-tight ml-10 text-white py-[0.4rem] px-4 bg-red-500"> Ban 
                                                </a>
                                            </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="w-[28rem] p-8 bg-white ">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </main>
</x-app-layout>
