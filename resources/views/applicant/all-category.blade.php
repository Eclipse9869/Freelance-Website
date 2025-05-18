@extends('layouts.main')
@section('content')
<style>
    .text-purple {
        color: #5f259f;
    }
    .badge {
        font-size: 13px;
        padding: 5px 10px;
        border-radius: 5px;
    }
</style>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="search-container mb-4">
    <form method="GET" action="{{ route('all-category') }}" class="flex items-center gap-2 w-full">
        <i>🔍</i>
        <input type="text" name="search" placeholder="Search Your Project" value="{{ request('search') }}" class="flex-1">
        <button type="submit" class="btn btn-purple">Search</button>
    </form>
</div>

<div class="container">
    <!-- Pagination -->
    <div class="text-center mb-4">
        {{ $project->links() }}
    </div>

    @forelse ($project as $item)
        <div class="d-flex justify-content-between align-items-start border rounded p-4 mb-4 shadow-sm">
            <!-- Left: Logo & Info -->
            <div class="d-flex">
                <div class="me-4 d-flex justify-content-center align-items-center border" style="width:90px; height:90px;">
                    <strong>LOGO</strong>
                </div>
                <div>
                    <h4 class="mb-1">{{ $item->name }}</h4>
                    <p class="mb-2 text-muted" style="max-width: 500px;">
                        {{ Str::limit($item->desc, 100) }}
                    </p>

                    <!-- Badges (Job Tags) -->
                    <div class="mb-2">
                        @foreach($item->job as $job)
                            <span class="badge bg-warning text-dark me-2">{{ $job->name }}</span>
                        @endforeach
                    </div>

                    <!-- Company Info -->
                    <div class="mb-2">
                        <a href="#" class="fw-bold text-purple d-block">{{ $item->users->name }}</a>
                        <small class="text-muted d-block">{{ $item->users->domicile ?? '-' }}</small>
                        <!-- <small class="text-purple">⭐ 9.8 | 14 Projects</small> -->
                    </div>

                    <!-- Detail Info -->
                    <ul class="list-unstyled text-muted mb-0" style="font-size: 14px;">
                        <li>📌 Syarat Minimal {{ $item->req_edu }}</li>
                        <li>📅 Published Date: {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</li>
                        <li>💰 Rp {{ number_format($item->amount_min, 0, ',', '.') }} - Rp {{ number_format($item->amount_max, 0, ',', '.') }}</li>
                        <li>🕒 Deadline Project: {{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('d F Y') }}</li>
                    </ul>
                </div>
            </div>

            <!-- Right: Buttons -->
            <div class="text-end">
                <a href="#" class="btn btn-purple mb-2 px-4">Place a Bid</a><br>
                <a href="#" class="btn btn-purple px-4">View Detail</a>
            </div>
        </div>
    @empty
        <div class="text-center py-5">
            <h5>You haven't created any projects yet.</h5>
        </div>
    @endforelse
</div>
@endsection
