<x-layout>
    <div
        class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col sm:flex-row items-center sm:items-start gap-6 mb-6">
        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://avatars.laravel.cloud/' . urlencode($user->email) }}"
            alt="{{ Auth()->user()->name }}" class="w-24 h-24 rounded-full object-cover border-1 shadow-sm">

        <div class="flex-1 text-center sm:text-left space-y-2">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ Auth()->user()->name }}</h1>
                    @if(Auth()->user()->name)
                        <p class="text-blue-500 font-medium">@ {{ $user->username }}</p>
                    @endif
                </div>

                @if(auth()->id() === $user->id)
                    <a href="{{ route('profile.edit') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Edit Profile
                    </a>
                @endif
            </div>

            @if($user->location)
                <p class="text-sm text-gray-500 flex items-center justify-center sm:justify-start gap-1">
                    📍 {{ $user->location}}
                </p>
            @endif

            @if($user->bio)
                <p class="text-gray-600 italic mt-2">"{{ $user->bio }}"</p>
            @endif
        </div>
    </div>
</x-layout>