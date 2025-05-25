@extends('layouts.main')
@section('content')

    <!-- Search Bar -->
    <div class="search-container">
        <i>🔍</i>
        <input type="text" placeholder="Cari Nama Pekerjaan / Perusahaan / Lokasi">
    </div>

    <div class="container category-wrapper">
    <div class="row text-center justify-content-center">
        <div class="col-6 col-md-3 category-item">
          <a href="{{ route('all-category') }}" class="text-decoration-none text-dark">
            <div class="circle-logo">
              <img src="{{ asset('storage/category/all.png') }}" style="width:95%; height:95%; object-fit:cover;" class="rounded-circle">
            </div>
            <div class="category-label">All Category</div>
          </a>
        </div>
    
      @foreach($category as $item)
        <div class="col-6 col-md-3 category-item">
          <a href="{{ route('category.show', $item->id) }}" class="text-decoration-none text-dark">
            <div class="circle-logo">
              <img src="{{ asset('storage/category/' . ($item->image ? $item->image : 'no-img.jpg')) }}" alt="{{ $item->name }}" style="width:95%; height:95%; object-fit:cover;" class="rounded-circle">
            </div>
            <div class="category-label">{{ $item->name }}</div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
@endsection
