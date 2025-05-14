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
        @php
            $categories = [
                'Development & IT',
                'AI Services',
                'Design & Creative',
                'Sales & Marketing',
                'Admin & Customer Support',
                'Writing & Translation',
                'Finance & Accounting',
                'Engineering & Architecture',
                'Legal',
                'HR & Training'
            ];
            $selectedCategory = old('category', $job->category ?? '');
        @endphp
        <select id="category" name="category">
            <option value="">-- Choose Category --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ $selectedCategory == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        <button type="submit" class="submit-btn">{{ isset($job) ? 'Update' : 'Submit' }}</button>
      </form>
    </div>
</main>
@endsection