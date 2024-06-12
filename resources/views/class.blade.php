<x-default-layout>
    <div class="mx-auto container">
        <livewire:header/>

    </div>
    <div class="mx-auto max-w-5xl px-3 mt-8">
        <h1 class="font-bold text-2xl ">
            {{$user->name}}
        </h1>

        <p class="mt-10">
            Access your resources below
        </p>
        <div class="mt-12">
            <h2 class="text-xl font-bold mb-4">
                Links
            </h2>

            <div class="flex flex-col gap-4 border p-4 rounded-lg">


                @foreach($links as $link)

                    <a class=" rounded-lg shadow-2xl p-3 block" style="background-color: {{$link['color']}}"
                       href="{{$link['link']}}">
                        <h2 class="text-lg font-bold " style="color: white; mix-blend-mode: hard-light;">
                            {{$link['name']}}

                        </h2>
                        <p style="mix-blend-mode: hard-light; color: white" class="text-sm mt-4">
                            {{$link['description']}}
                        </p>

                        <p class="mt-2 text-white" style="mix-blend-mode: hard-light">
                            Visit link
                        </p>

                    </a>

                @endforeach

            </div>

        </div>


    </div>
</x-default-layout>
