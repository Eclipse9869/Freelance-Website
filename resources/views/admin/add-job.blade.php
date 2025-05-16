@extends('layouts.recruiter')
@section('content')
<main>
    <div class="breadcrumb">Home > Add Job</div>
    <div class="form-container">
      <form action="{{ isset($job) ? route('job.update', $job->id) : route('job.store') }}" method="POST">
        @csrf
        @if(isset($job))
            @method('PUT')
        @endif
        <label for="name">Name :</label>
        <input type="text" id="name" name="name" value="{{ old('name', $job->name ?? '') }}">

        <label for="desc">Description :</label>
        <textarea id="desc" name="desc">{{ old('desc', $job->desc ?? '') }}</textarea>

        <label for="category">Category :</label>
        <select id="category" name="category">
            <option value="">-- Choose Category --</option>
            @foreach($category as $cat)
                <option value="{{ $cat->id }}" {{ (old('category', $job->category_job_id ?? '') == $cat->id) ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="submit-btn">{{ isset($job) ? 'Update' : 'Submit' }}</button>
      </form>
    </div>
</main>
@endsection