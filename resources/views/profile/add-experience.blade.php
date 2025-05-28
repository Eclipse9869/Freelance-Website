@extends('layouts.recruiter')
@section('content')
<main>
    <div class="breadcrumb">Home > Profile > Add Experience</div>
    <div class="form-container">
      <form action="{{ isset($experience) ? route('experience.update', $experience->id) : route('experience.store') }}" method="POST">
        @csrf
        @if(isset($experience))
            @method('PUT')
        @endif

        <label for="company_name">Company :</label>
        <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $experience->company_name ?? '') }}" required>

        <label for="type">Job type:</label>
        @php
            $types = ['Freelance', 'Part-time', 'Full-time', 'Contract', 'Internship'];
            $selectedType = old('type', $experience->type ?? '');
        @endphp
        <select id="type" name="type">
            <option value="" disabled {{ $selectedType == '' ? 'selected' : '' }}>-- Select Job Type --</option>
            @foreach ($types as $type)
                <option value="{{ $type }}" {{ $selectedType == $type ? 'selected' : '' }}>
                    {{ $type }}
                </option>
            @endforeach
        </select>

        <label for="job_name">Job name :</label>
        <input type="text" id="job_name" name="job_name" value="{{ old('job_name', $experience->job_name ?? '') }}" required>

        <label for="industry">Industry :</label>
        <input type="text" id="industry" name="industry" value="{{ old('industry', $experience->industry ?? '') }}" required>

        <label for="start">Start Year :</label>
        <input type="text" id="start" name="start" value="{{ old('start', $experience->start ?? '') }}" required>

        <label for="end">End Year :</label>
        <input type="text" id="end" name="end" value="{{ old('end', $experience->end ?? '') }}" required>

        <label for="desc">Description :</label>
        <textarea id="desc" name="desc" required>{{ old('desc', $experience->desc ?? '') }}</textarea>

        <button type="submit" class="submit-btn">{{ isset($experience) ? 'Update Experience' : 'Save' }}</button>
      </form>
    </div>
</main>
@endsection
