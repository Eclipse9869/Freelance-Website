@extends('layouts.main')
@section('content')
<main>
    <div class="breadcrumb">Home > Project > Add Bid</div>
    <div class="form-container">
        <form action="{{ route('bid.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-2 mt-4 position-relative">
            <img 
                src="{{ $users->profile_pic ? asset('storage/' . $users->profile_pic) : 'https://ui-avatars.com/api/?name=' . urlencode($users->name) }}" 
                alt="Profile Photo" 
                class="rounded-full mx-auto" 
                style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #420068;"
            />
        </div>

        <input type="hidden" name="project_id" value="{{ $project->id }}">

        <label for="name">Name :</label>
        <input type="text" id="name" name="name" value="{{ $users->name }}" readonly>

        <label for="gender">Gender :</label>
        <input type="text" id="gender" name="gender" value="{{ $users->gender }}" readonly>

        <label for="date_of_birth">Date of Birth :</label>
        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ \Carbon\Carbon::parse($users->date_of_birth)->format('Y-m-d') }}" readonly>

        <label for="domicile">Domicile :</label>
        <input type="text" id="domicile" name="domicile" value="{{ $users->domicile }}" readonly>

        <label for="email">Email :</label>
        <input type="text" id="email" name="email" value="{{ $users->email }}" readonly>

        <label for="phone">Phone Number :</label>
        <input type="text" id="phone" name="phone" value="{{ $users->phone }}" readonly>

        <div>
            <label for="education">Education :</label>
            <div class="bg-white space-y-6 border-2 border-orange-400 rounded-md p-4">
                @forelse ($educations as $edu)
                    <div class="bg-white border-b pb-3">
                        <h4 class="text-md font-bold"><strong>{{ $edu->school_name }} ({{ $edu->edulevel->name ?? 'N/A' }})</strong></h4>
                        <p class="text-sm text-gray-800 italic">{{ $edu->major }}</p>
                        <p class="text-sm text-gray-600">{{ $edu->start }} - {{ $edu->end }}</p>
                        <p class="text-sm mt-2">
                            <strong>Pengalaman Organisasi/Pengembangan Diri :</strong><br>
                            {{ $edu->desc }}
                        </p>
                        <!-- <div>
                            <a href="{{ route('edu.edit', $edu->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('edu.destroy', $edu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </div> -->
                    </div>
                @empty
                    <p class="text-gray-500 italic">Belum ada data pendidikan.</p>
                @endforelse
            </div>
            <!-- <div class="mt-2 text-end">
                <a href="{{ route('edu.create') }}">
                    <x-danger-button>Add</x-danger-button>
                </a>
            </div> -->
        </div>

        <div>
            <label for="experience">Experience :</label>
                <div class="bg-white space-y-6 border-2 border-orange-400 rounded-md p-4">
                    @forelse ($experiences as $experience)
                        <div class="bg-white border-b pb-3">
                            <h4 class="text-md font-bold"><strong>{{ $experience->company_name }}</strong></h4>
                            <p class="text-sm text-gray-800 italic">{{ $experience->job_name }} ({{ $experience->type }})</p>
                            <p class="text-sm text-gray-800 italic">{{ $experience->industry }}</p>
                            <p class="text-sm text-gray-600">{{ $experience->start }} - {{ $experience->end }}</p>
                            <p class="text-sm mt-2">
                                <strong>Pengalaman Organisasi/Pengembangan Diri :</strong><br>
                                {{ $experience->desc }}
                            </p>
                            <!-- <div>
                                <a href="{{ route('experience.edit', $experience->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('experience.destroy', $experience->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div> -->
                        </div>
                    @empty
                        <p class="text-gray-500 italic">Belum ada data pengalaman.</p>
                    @endforelse
                </div>
                <!-- <div class="mt-2 text-end">
                    <a href="{{ route('experience.create') }}">
                        <x-danger-button>Add</x-danger-button>
                    </a>
                </div> -->
            </div>

            <div class="mb-3">
                <label for="cv">Upload CV (PDF only):</label>
                <input type="file" id="cv" name="cv" accept="application/pdf" required>
            </div>

            <div class="mb-3">
                <label for="cover_letter">Upload Surat Lamaran Kerja (PDF only):</label>
                <input type="file" id="cover_letter" name="cover_letter" accept="application/pdf" required>
            </div>

            <div class="mb-3">
                <label for="amount">Amount (Rp):</label>
                <input 
                    type="text" 
                    id="amount" 
                    name="amount" 
                    placeholder="Rp. " 
                    oninput="formatRupiah(this)" 
                    required
                >
            </div>
        <button type="submit" class="submit-btn">Bid</button>
      </form>
    </div>
</main>

<script>
function formatRupiah(input) {
    let value = input.value.replace(/[^,\d]/g, '').toString();
    let split = value.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/g);
    
    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    input.value = 'Rp. ' + rupiah;
}
</script>
@endsection



