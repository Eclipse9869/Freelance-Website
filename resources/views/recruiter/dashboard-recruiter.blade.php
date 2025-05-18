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
            <div class="job-item d-flex align-items-start justify-content-between p-4 border-bottom">
                <div class="d-flex">
                    <div class="logo-box border me-4 d-flex justify-content-center align-items-center" style="width:90px; height:90px;">
                        <strong>LOGO</strong>
                    </div>
                    <div>
                        <h4 class="mb-1">{{ $item->name }}</h4>
                        <p class="mb-0" style="font-size: 18px;">{{ $item->desc }}</p>
                    </div>
                </div>
                <div class="text-end">
                    <button class="btn btn-lg btn-purple mb-3 px-4">
                        <a href="{{ route('projects.show', $item->id) }}">View Detail</a>
                    </button><br>
                    <button class="btn btn-lg btn-purple px-4">Show Bids</button>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <h5>You haven't created any projects yet.</h5>
            </div>
        @endforelse
    </div>
@endsection