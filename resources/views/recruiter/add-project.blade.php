@extends('layouts.recruiter')
@section('content')
<main>
    <div class="breadcrumb">Home > Open Recruitment</div>
    <div class="form-container">
      <form action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}" method="POST">
        @csrf
        @if(isset($project))
          @method('PUT')
        @endif
        <label for="name">Project Name :</label>
        <input type="text" id="name" name="name" value="{{ old('name', $project->name ?? '') }}" required>

        <label for="desc">Description :</label>
        <textarea id="desc" name="desc" required>{{ old('desc', $project->desc ?? '') }}</textarea>

        <label for="req_edu">Minimum education :</label>
        <select id="req_edu" name="req_edu" class="mt-1 block w-full" required>
            <option value="">-- Choose Education --</option>
            <option value="SMA/SMK/Sederajat" {{ old('req_edu', $project->req_edu ?? '') == 'SMA/SMK/Sederajat' ? 'selected' : '' }}>SMA/SMK/Sederajat</option>
            <option value="D1" {{ old('req_edu', $project->req_edu ?? '') == 'D1' ? 'selected' : '' }}>D1</option>
            <option value="D2" {{ old('req_edu', $project->req_edu ?? '') == 'D2' ? 'selected' : '' }}>D2</option>
            <option value="D3" {{ old('req_edu', $project->req_edu ?? '') == 'D3' ? 'selected' : '' }}>D3</option>
            <option value="D4" {{ old('req_edu', $project->req_edu ?? '') == 'D4' ? 'selected' : '' }}>D4</option>
            <option value="S1" {{ old('req_edu', $project->req_edu ?? '') == 'S1' ? 'selected' : '' }}>S1</option>
            <option value="S2" {{ old('req_edu', $project->req_edu ?? '') == 'S2' ? 'selected' : '' }}>S2</option>
            <option value="S3" {{ old('req_edu', $project->req_edu ?? '') == 'S3' ? 'selected' : '' }}>S3</option>
        </select>

        <label>Budget Range :</label>
        <div class="budget-range">
          <span>Rp</span>
          <input type="text" name="amount_min" value="{{ old('amount_min', $project->amount_min ?? '') }}" required>
          <span>-</span>
          <input type="text" name="amount_max" value="{{ old('amount_max', $project->amount_max ?? '') }}" required>
        </div>

        <label for="job">Channel Job :</label>
        @php
            $selectedJobs = old('job', isset($project) ? $project->job->pluck('id')->toArray() : []);
        @endphp
        <select id="job" name="job[]" multiple="multiple" required>
          @foreach ($job as $channel)
            <option value="{{ $channel->id }}" {{ in_array($channel->id, $selectedJobs) ? 'selected' : '' }}>
              {{ $channel->name }}
            </option>
          @endforeach
        </select>

        <!-- <select id="channel" name="channel">
          <option value="">-- Pilih Channel --</option>
          <option value="email">Email</option>
          <option value="linkedin">LinkedIn</option>
          <option value="website">Website</option>
        </select> -->

        <label for="deadline">Deadline :</label>
        <div style="display: flex;">
          <input type="date" id="deadline" name="deadline" value="{{ old('deadline', isset($project) ? \Carbon\Carbon::parse($project->deadline)->format('Y-m-d') : '') }}" style="flex: 1;">
          <!-- <div class="calendar-icon"></div> -->
        </div>

        <button type="submit" class="submit-btn">{{ isset($project) ? 'Update Project' : 'Save and Publish' }}</button>
      </form>
    </div>
</main>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#liveSearch').on('keyup', function() {
        let keyword = $(this).val();

        $.ajax({
            url: "{{ route('projects.index') }}",
            type: "GET",
            data: { search: keyword },
            success: function(data) {
                $('#projectResults').html(data);
            }
        });
    });
</script> -->
@endsection