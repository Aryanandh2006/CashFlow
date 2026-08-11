<x-layout title="User Settings">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- Update Profile Information --}}
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Profile Information</h2>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full border rounded px-3 py-2" required>
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-1 font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full border rounded px-3 py-2" required>
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Save Changes
                </button>
            </form>
        </div>

        {{-- Update Password --}}
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Update Password</h2>

            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Current Password</label>
                    <input type="password" name="current_password" class="w-full border rounded px-3 py-2" required>
                    @error('current_password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium">New Password</label>
                    <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-1 font-medium">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2"
                        required>
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Update Password
                </button>
            </form>
        </div>

    </div>


</x-layout>