<form wire:submit="submit">
    @if(session('status'))
        {{ session('status') }}
    @endif
    <div class="mb-6">
        <label class="block mb-2 text-coolGray-800 font-medium leading-6" for="">Email</label>
        @error('email') <span class="text-sm text-red-600">
            {{ $message }}
        </span> @enderror
        <input
            class="block w-full py-2 px-3 appearance-none border border-coolGray-200 rounded-lg shadow-md text-coolGray-500 leading-6 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50"
            type="email" placeholder=""
            wire:model="email"
        >
    </div>
    <div class="mb-6">
        <label class="block mb-2 text-coolGray-800 font-medium leading-6" for="">Phone</label>
        @error('phone') <span class="text-sm text-red-600">
            {{ $message }}
        </span> @enderror
        <input
            class="block w-full py-2 px-3 appearance-none border border-coolGray-200 rounded-lg shadow-md text-coolGray-500 leading-6 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50"
            type="text" placeholder=""
            wire:model="phone"
        >
    </div>
    <div class="mb-6">
        <label class="block mb-2 text-coolGray-800 font-medium leading-6" for="">Message</label>

        @error('message') <span class="text-sm text-red-600">
            {{ $message }}
        </span> @enderror

        <textarea

            class="block h-32 md:h-52 w-full py-2 px-3 appearance-none border border-coolGray-200 rounded-lg shadow-md text-coolGray-500 leading-6 focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 placeholder-coolGray-200 resize-none"
            type="text" placeholder="Your message..."
            wire:model="message"
        ></textarea>
    </div>
    <button
        type="submit"
        class="text-center w-full py-4 px-6 text-lg leading-6 text-coolGray-50 font-medium bg-green-500 hover:bg-green-600 focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 rounded-md shadow-sm flex justify-center gap-3">
        Send
        <div wire:loading>
            <x-filament::loading-indicator class="w-6 h-6 animate-spin"/>


        </div>
    </button>
</form>
