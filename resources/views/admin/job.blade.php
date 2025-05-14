@extends('layouts.recruiter')
@section('content')
<div class="table-section">
    <!-- <div class="breadcrumb">Home > All Job</div>
    <div class="table-header">
        <a href="{{ route('add-job') }}" class="add-btn">+ Add Job</a>
    </div> -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-container">
        <div class="breadcrumb">Home > All Job</div>
        <div class="table-header">
            <a href="{{ route('add-job') }}" class="add-btn">+ Add Job</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($job as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->desc }}</td>
                    <td>{{ $item->category }}</td>
                    <td>
                        <a href="{{ route('job.edit', $item->id) }}" class="btn btn-sm btn-info">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection