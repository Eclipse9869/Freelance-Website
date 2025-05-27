<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="mb-4 text-center position-relative" style="display: inline-block;">
            <!-- Foto Profil -->
            <div class="mb-2 position-relative">
                <img 
                    src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" 
                    alt="Profile Photo" 
                    class="rounded-full mx-auto" 
                    style="width: 100px; height: 100px; object-fit: cover;"
                />

                @if ($user->profile_pic)
                    <button 
                        onclick="deletePhoto()" 
                        style="
                            position: absolute; top: -5px; right: 15px;
                            background-color: red;
                            color: white;
                            border: none;
                            border-radius: 50%;
                            width: 24px;
                            height: 24px;
                            font-size: 16px;
                            line-height: 1;
                            cursor: pointer;
                        "
                        title="Hapus foto"
                    >×</button>
                @endif
            </div>

            <!-- Input Upload Foto Profil -->
            <div>
                <x-input-label for="profile_pic" :value="$user->profile_pic ? __('Ubah Foto Profil') : __('Tambah Foto Profil')" />
                <input id="profile_pic" name="profile_pic" type="file" class="form-control mt-2">
                <x-input-error class="mt-2" :messages="$errors->get('profile_pic')" />
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            <!-- @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif -->
        </div>

        <!-- <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <x-text-input 
                id="gender" 
                name="gender" 
                type="text" 
                class="mt-1 block w-full bg-gray-200 text-gray-500" 
                :value="old('gender', $user->gender)" 
                required 
                autofocus 
                autocomplete="name" 
                disabled 
            />
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div> -->

        <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <select id="gender" name="gender" class="mt-1 block w-full" required>
                <option value="male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="domicile" :value="__('Domicile')" />
            <x-text-input id="domicile" name="domicile" type="text" class="mt-1 block w-full" :value="old('domicile', $user->domicile)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('domicile')" />
        </div>

        <div>
            <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
            <input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" value="{{ old('date_of_birth', $user->date_of_birth) }}" required />
            <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <div>
        <x-input-label for="education" :value="__('Education')" />
        <div class="space-y-6 border-2 border-orange-400 rounded-md p-4">
            @forelse ($educations as $edu)
                <div class="bg-white border-b pb-3">
                    <h4 class="text-md font-bold"><strong>{{ $edu->school_name }} ({{ $edu->edulevel->name ?? 'N/A' }})</strong></h4>
                    <p class="text-sm text-gray-800 italic">{{ $edu->major }}</p>
                    <p class="text-sm text-gray-600">{{ $edu->start }} - {{ $edu->end }}</p>
                    <p class="text-sm mt-2">
                        <strong>Pengalaman Organisasi/Pengembangan Diri :</strong><br>
                        {{ $edu->desc }}
                    </p>
                    <div>
                        <!-- Tombol Edit -->
                        <a href="{{ route('edu.edit', $edu->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <!-- Tombol Delete -->
                        <form action="{{ route('edu.destroy', $edu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 italic">Belum ada data pendidikan.</p>
            @endforelse
            </div>
            <div class="mt-2 text-end">
                <a href="{{ route('edu.create') }}">
                    <x-danger-button>Add</x-danger-button>
                </a>
            </div>
        </div>

        <div>
            <x-input-label for="experience" :value="__('Experience')" />
            <div class="space-y-6 border-2 border-orange-400 rounded-md p-4">
                <div class="bg-white border-b pb-3">
                    <h4 class="text-md font-bold">PT bla bla bla</h4>
                    <p class="text-sm text-gray-800 italic">Web Developer</p>
                    <p class="text-sm text-gray-600">April 2015 - Agustus 2018</p>
                    <p class="text-sm mt-2">
                        <strong>Pengalaman Organisasi/Pengembangan Diri :</strong><br>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum pretium vulputate varius...
                    </p>
                </div>
            </div>
            <div class="mt-2 text-end">
                <x-danger-button>Add</x-danger-button>
            </div>
        </div>
</section>
