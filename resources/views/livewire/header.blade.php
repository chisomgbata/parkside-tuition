<div class="bg-transparent ">

    <nav class="flex justify-between p-6 px-4 bg-white">
        <div class="flex justify-between items-center w-full">
            <div class="w-1/2 xl:w-1/3">
                <x-logo/>
            </div>

            <div class=" flex gap-3">
                @if(session()->get('user'))
                    <div class="flex items-center justify-end">
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button
                                class="inline-block py-2 px-4 text-sm leading-5 text-green-50 bg-green-500 hover:bg-green-600 font-medium focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 rounded-md"
                                type="submit">Logout
                            </button>
                        </form>
                    </div>
                @endif
                <div class=" xl:flex items-center justify-end"><a
                        class="inline-block py-2 px-4 text-sm leading-5 text-green-50 bg-green-500 hover:bg-green-600 font-medium focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 rounded-md"
                        href="{{ route('classes') }}">View Classes</a></div>

            </div>
        </div>

    </nav>
</div>
