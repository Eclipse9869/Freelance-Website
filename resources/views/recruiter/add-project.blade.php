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

        <label for="name">Minimum education :</label>
        <input type="text" id="req_edu" name="req_edu" value="{{ old('req_edu', $project->req_edu ?? '') }}" required>

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
        <select name="job[]" multiple required size="5">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#liveSearch').on('keyup', function() {
        let keyword = $(this).val();

        $.ajax({
            url: "{{ route('dashboard-recruiter') }}",
            type: "GET",
            data: { search: keyword },
            success: function(data) {
                $('#projectResults').html(data);
            }
        });
    });
</script>
@endsection