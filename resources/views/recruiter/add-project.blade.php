@extends('layouts.recruiter')
@section('content')
<main>
    <div class="breadcrumb">Home > Open Recruitment</div>
    <div class="form-container">
      <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <label for="name">Project Name :</label>
        <input type="text" id="name" name="name" required>

        <label for="desc">Description :</label>
        <textarea id="desc" name="desc" required></textarea>

        <label for="name">Minimum education :</label>
        <input type="text" id="req_edu" name="req_edu" required>

        <label>Budget Range :</label>
        <div class="budget-range">
          <span>Rp</span>
          <input type="text" name="amount_min" required>
          <span>-</span>
          <input type="text" name="amount_max" required>
        </div>

        <label for="job">Channel Job :</label>
        <select name="job[]" multiple required size="5">
          @foreach ($job as $channel)
            <option value="{{ $channel->id }}">{{ $channel->name }}</option>
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
          <input type="date" id="deadline" name="deadline" style="flex: 1;">
          <!-- <div class="calendar-icon"></div> -->
        </div>

        <button type="submit" class="submit-btn">Save and Publish</button>
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