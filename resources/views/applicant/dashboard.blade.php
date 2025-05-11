@extends('layouts.main')
@section('content')

    <!-- Search Bar -->
    <div class="search-container">
        <i>🔍</i>
        <input type="text" placeholder="Cari Nama Pekerjaan / Perusahaan / Lokasi">
    </div>

    <div class="container category-wrapper">
    <div class="row text-center justify-content-center">
      <!-- 1 -->
      <div class="col-6 col-md-3 category-item">
        <div class="circle-logo">🟧🟧🟧🟧</div>
        <div class="category-label">Semua Kategori</div>
      </div>
      <!-- 2 -->
      <div class="col-6 col-md-3 category-item">
        <div class="circle-logo">LOGO</div>
        <div class="category-label">Frontend Developer</div>
      </div>
      <!-- 3 -->
      <div class="col-6 col-md-3 category-item">
        <div class="circle-logo">LOGO</div>
        <div class="category-label">Backend Developer</div>
      </div>
      <!-- 4 -->
      <div class="col-6 col-md-3 category-item">
        <div class="circle-logo">LOGO</div>
        <div class="category-label">Mobile App Developer</div>
      </div>
      <!-- 5 -->
      <div class="col-6 col-md-3 category-item">
        <div class="circle-logo">LOGO</div>
        <div class="category-label">Website Developer</div>
      </div>
      <!-- 6 -->
      <div class="col-6 col-md-3 category-item">
        <div class="circle-logo">LOGO</div>
        <div class="category-label">Database Administrator</div>
      </div>
      <!-- 7 -->
      <div class="col-6 col-md-3 category-item">
        <div class="circle-logo">LOGO</div>
        <div class="category-label">UI/UX Designer</div>
      </div>
      <!-- 8 -->
      <div class="col-6 col-md-3 category-item">
        <div class="circle-logo">LOGO</div>
        <div class="category-label">Software Engineering</div>
      </div>
    </div>
  </div>
@endsection
