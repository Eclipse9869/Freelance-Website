@extends('layouts.main')
@section('content')
    <div class="search-container">
        <form method="GET" action="{{ route('bid.index') }}" class="flex items-center gap-2 w-full">
            <i>🔍</i>
            <input type="text" name="search" placeholder="Search Your Project" value="{{ request('search') }}" class="flex-1">
            <button type="submit" class="btn btn-purple">Search</button>
        </form>
    </div>

    <!-- Job List -->
    <div class="container mt-5">
        <!-- Pagination -->
        <div class="text-center mt-4">
            {{ $bids->links() }}
        </div>

        @forelse ($bids as $bid)
            @foreach ($bid->bidDetails as $detail)
                <div class="job-item d-flex justify-content-between align-items-center p-4 border-bottom">
                    <div class="d-flex">
                        <div>
                            <div class="logo-box border me-4 d-flex justify-content-center align-items-center" style="width:90px; height:90px;">
                                <strong>LOGO</strong>
                            </div>
                            <div class="text-center mt-1" style="width: 90px;">
                                <small class="text-muted">{{ $bid->created_at->format('d M Y') }}</small>
                            </div>
                        </div>
                        <div>
                            <h4 class="mb-1"  style="font-size: 18px; color: #420068;"><strong>{{ $detail->project->name }}</strong></h4>
                            <p class="mb-1">{{ $detail->project->desc }}</p>
                            <div>
                                @foreach($detail->project->job as $job)
                                    <span class="badge bg-warning text-dark me-2">{{ $job->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @php
                        $status = ucfirst($bid->status);
                        $class = 'border-primary text-primary';

                        if ($status === 'Approve') {
                            $class = 'border-success text-success';
                        } elseif ($status === 'Rejected') {
                            $class = 'border-danger text-danger';
                        }
                    @endphp

                    <!-- Kontainer kanan: badge dan tombol -->
                    <div class="d-flex flex-column align-items-end justify-content-center gap-2">
                        <!-- Badge Status -->
                        <span class="px-4 py-2 border {{ $class }} rounded-pill bg-white fw-semibold">
                            {{ $status }}
                        </span>

                        <!-- Tombol Add File di bawah badge jika status Accept -->
                        @if ($status === 'Approve')
                            <a href="#" class="btn btn-purple">
                                Add File
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        @empty
            <div class="text-center py-5">
                <h5>You haven't bid on any projects yet.</h5>
            </div>
        @endforelse
    </div>
@endsection
