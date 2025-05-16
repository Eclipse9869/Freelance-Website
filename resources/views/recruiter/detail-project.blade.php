@extends('layouts.recruiter')
@section('content')
    <div class="container-1">
        <div class="breadcrumb">
            Home > My Project > View Detail
        </div>

        <section class="project-box">
            <div class="project-header">
                <h1>{{ $project->name }}</h1>
                <button class="btn btn-lg btn-purple px-4">
                    <a href="{{ route('projects.edit', $project->id) }}">Edit Project</a>
                </button>
            </div>
            <p class="project-desc">{{ $project->desc }}</p>

            <div class="project-info">
                <div class="owner">
                    <h2>Project Owner</h2>
                    <div class="owner-content">
                        <div class="logo-box-1">LOGO</div>
                        <div>
                            <strong>{{ $project->users->name }}</strong><br>
                            Kota {{ $project->users->domicile ?? 'Tidak diketahui' }}
                        </div>
                    </div>
                </div>

                <div class="detail">
                    <h2>Project Detail</h2>
                    <p>
                        <i class="bi bi-mortarboard-fill text-purple me-2"></i>
                        <strong>Syarat Minimal:</strong> {{ $project->req_edu ?? '-' }}
                    </p>
                    <p>
                        <i class="bi bi-calendar-event-fill text-purple me-2"></i>
                        <strong>Published Date:</strong> {{ \Carbon\Carbon::parse($project->created_at)->translatedFormat('d F Y') }}
                    </p>
                    <p>
                        <i class="bi bi-cash-coin text-purple me-2"></i>
                        <strong>Published Budget:</strong>
                        Rp {{ number_format($project->amount_min, 0, ',', '.') }} -
                        Rp {{ number_format($project->amount_max, 0, ',', '.') }}
                    </p>
                    <p>
                        <i class="bi bi-hourglass-split text-purple me-2"></i>
                        <strong>Deadline Project:</strong> {{ \Carbon\Carbon::parse($project->deadline)->translatedFormat('d F Y') }}
                    </p>
                </div>

            </div>
        </section>
    </div>
@endsection