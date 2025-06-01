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
<style>
  /* .project-box {
    background-color: #e6e6e6;
    padding: 30px;
    border-radius: 10px;
    font-family: 'Segoe UI', sans-serif;
  } */

  .project-header h1 {
    color: #e65100;
    font-size: 28px;
    font-weight: bold;
    border-bottom: 2px solid #6a1b9a;
  }

  .project-desc {
    margin-top: 10px;
    padding-bottom: 10px;
    color: #333;
  }

  .edit-project-btn {
    background-color: #6a1b9a;
    color: white;
    border: none;
    padding: 8px 16px;
    font-size: 14px;
    float: right;
    margin-top: -50px;
  }

  .owner h2,
  .detail h2 {
    color: #e65100;
    font-size: 20px;
    font-weight: bold;
    margin-top: 20px;
    margin-bottom: 10px;
    border-bottom: 2px solid #6a1b9a;
    display: inline-block;
    padding-bottom: 4px;
  }

  .logo-box-1 {
    width: 80px;
    height: 80px;
    border: 1px solid black;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: white;
  }

  .logo-box-1 img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 0;
  }

  .project-info {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-top: 20px;
  }

  .owner,
  .detail {
    width: 48%;
  }

  .detail p {
    margin-bottom: 10px;
  }

  .detail i {
    color: #6a1b9a;
    margin-right: 8px;
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
            <div class="d-flex">
                <div class="me-4 d-flex justify-content-center align-items-center border" style="width:90px; height:90px;">
                    <strong>LOGO</strong>
                </div>
                <div>
                    <h4 class="mb-1" style="color: #e65100; font-size: 22px; font-weight: bold;">{{ $item->name }}</h4>
                    <p class="mb-2 text-muted" style="max-width: 500px; font-size: 18px; font-weight: bold;">
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
                        <a class="fw-bold text-purple d-block">{{ $item->users->name }}</a>
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

            <div class="d-flex flex-column align-items-end gap-2" style="width: 160px;">
                <button type="button" class="btn btn-purple w-100" data-bs-toggle="modal" data-bs-target="#projectDetailModal{{ $item->id }}">
                    View Detail
                </button>
                @if (auth()->id() !== $item->users->id)
                    <a href="{{ route('bid.create', $item->id) }}" class="btn btn-purple w-100">Place a Bid</a>
                @endif
            </div>
        </div>
    @empty
        <div class="text-center py-5">
            <h5>You haven't created any projects yet.</h5>
        </div>
    @endforelse
</div>

@foreach ($project as $item)
<!-- Modal -->
<div class="modal fade" id="projectDetailModal{{ $item->id }}" tabindex="-1" aria-labelledby="projectDetailLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #e6e6e6;">
        <h5 class="modal-title" id="projectDetailLabel{{ $item->id }}" style="font-size: 28px; font-weight: bold;">Detail Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body" style="background-color: #e6e6e6;">
        <div class="container-1">
          <section class="project-box">
              <div class="project-header">
                  <h1>{{ $item->name }}</h1>
              </div>
              <p class="project-desc">{{ $item->desc }}</p>
              <div class="project-info">
                  <div class="owner">
                      <h2>Project Owner</h2>
                      <div class="owner-content d-flex gap-3">
                          <div class="logo-box-1">
                          @if($item->users->profile_pic)
                              <img 
                              src="{{ asset('storage/' . $item->users->profile_pic) }}" 
                              alt="{{ $item->users->name }}" 
                              style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                          @else
                              <img 
                              src="https://ui-avatars.com/api/?name={{ urlencode($item->users->name) }}&background=4B007D&color=ffffff&size=80" 
                              alt="{{ $item->users->name }}" 
                              style="width: 80px; height: 80px; object-fit: cover;">
                          @endif
                          </div>
                          <div>
                              <strong>{{ $item->users->name }}</strong><br>
                              Kota {{ $item->users->domicile ?? '-' }}
                          </div>
                      </div>
                  </div>
                  <div class="detail mt-4">
                      <h2>Project Detail</h2>
                      <p>
                          <i class="bi bi-mortarboard-fill text-purple me-2"></i>
                          <strong>Syarat Minimal:</strong> {{ $item->req_edu ?? '-' }}
                      </p>
                      <p>
                          <i class="bi bi-calendar-event-fill text-purple me-2"></i>
                          <strong>Published Date:</strong> {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                      </p>
                      <p>
                          <i class="bi bi-cash-coin text-purple me-2"></i>
                          <strong>Published Budget:</strong>
                          Rp {{ number_format($item->amount_min, 0, ',', '.') }} -
                          Rp {{ number_format($item->amount_max, 0, ',', '.') }}
                      </p>
                      <p>
                          <i class="bi bi-hourglass-split text-purple me-2"></i>
                          <strong>Deadline Project:</strong> {{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('d F Y') }}
                      </p>
                  </div>
              </div>
          </section>
        </div>

      </div>
    </div>
  </div>
</div>
@endforeach

@endsection
