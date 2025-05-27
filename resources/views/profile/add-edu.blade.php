@extends('layouts.recruiter')
@section('content')
<main>
    <div class="breadcrumb">Home > Open Recruitment</div>
    <div class="form-container">
      <form action="{{ isset($edu) ? route('edu.update', $edu->id) : route('edu.store') }}" method="POST">
        @csrf
        @if(isset($edu))
            @method('PUT')
        @endif

        <label for="education_level_id">Education level :</label>
        <select id="education_level_id" name="education_level_id" required>
            <option value="">-- Select Education Level --</option>
            @foreach($eduLevels as $level)
                <option value="{{ $level->id }}"
                    {{ old('education_level_id', $edu->education_level_id ?? '') == $level->id ? 'selected' : '' }}>
                    {{ $level->name }}
                </option>
            @endforeach
        </select>

        <label for="school_name">University :</label>
        <input type="text" id="school_name" name="school_name" value="{{ old('school_name', $edu->school_name ?? '') }}" required>

        <label for="major">Major :</label>
        <input type="text" id="major" name="major" value="{{ old('major', $edu->major ?? '') }}" required>

        <label for="start">Start Year :</label>
        <input type="text" id="start" name="start" value="{{ old('start', $edu->start ?? '') }}" required>

        <label for="end">End Year :</label>
        <input type="text" id="end" name="end" value="{{ old('end', $edu->end ?? '') }}" required>

        <label for="desc">Description :</label>
        <textarea id="desc" name="desc" required>{{ old('desc', $edu->desc ?? '') }}</textarea>

        <button type="submit" class="submit-btn">{{ isset($edu) ? 'Update Education' : 'Save' }}</button>
      </form>
    </div>
</main>
@endsection
