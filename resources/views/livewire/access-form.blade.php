<div>
    <div class="max-w-2xl mx-auto p-8 border  rounded-lg shadow-2xl  "><p>
            Input your name and password and get access to your resources
        </p>
        @session('error')
        {{session('error')}}
        @endsession
        <x-filament::input type="text" wire:model="name" placeholder="Name" class="p-2 rounded-lg mt-2"/>
        <x-filament::input type="password" wire:model="password" placeholder="Password"
                           class="p-2 rounded-lg mt-2"/>
        <button class="p-2 bg-blue-500 w-full rounded-lg font-bold mt-2 text-[#fff]"
                wire:click="submit"
        >Submit

            <div wire:loading>
                ...
            </div>
        </button>
    </div>


</div>
