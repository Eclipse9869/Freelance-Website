@extends('layouts.recruiter')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="search-container">
        <form method="GET" action="{{ route('projects.index') }}" class="flex items-center gap-2 w-full">
            <i>🔍</i>
            <input type="text" name="search" placeholder="Search Your Project" value="{{ request('search') }}" class="flex-1">
            <button type="submit" class="btn btn-purple">Search</button>
        </form>
    </div>

    <!-- Job List -->
    <div class="container mt-5">
        <!-- Pagination -->
        <div class="text-center mt-4">
            {{ $project->links() }}
        </div>

        @forelse ($project as $item)
            <div class="job-item d-flex align-items-start justify-content-between p-4 border-bottom flex-wrap">
                <div class="d-flex" style="flex: 1 1 0%; min-width: 0;">
                    <div class="logo-box border me-4 d-flex justify-content-center align-items-center" style="width:90px; height:90px; flex-shrink: 0;">
                        <strong>LOGO</strong>
                    </div>
                    <div style="min-width: 0;">
                        <h4 class="mb-1" style="font-size: 18px; color: #420068;"><strong>{{ $item->name }}</strong></h4>
                        <p class="mb-1 text-truncate" style="font-size: 18px; max-width: 600px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $item->desc }}
                        </p>
                        <div>
                            @foreach($item->job as $job)
                                <span class="badge bg-warning text-dark me-2">{{ $job->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column text-end" style="min-width: 160px; flex-shrink: 0;">
                    <a href="{{ route('projects.show', $item->id) }}" class="btn btn-lg btn-purple mb-2 px-4">View Detail</a>
                    <a href="{{ route('projects.bids', $item->id) }}" class="btn btn-lg btn-purple px-4">Show Bids</a>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <h5>You haven't created any projects yet.</h5>
            </div>
        @endforelse
    </div>
@endsection