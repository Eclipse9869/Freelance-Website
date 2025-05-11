@extends('layouts.recruiter')
@section('content')
    <!-- Search Bar -->
    <div class="search-container">
        <i>🔍</i>
        <input type="text" placeholder="Cari Nama Pekerjaan / Perusahaan / Lokasi">
    </div>

    <!-- Job List -->
    <div class="container mt-5">
        <div class="job-item d-flex align-items-start justify-content-between p-4 border-bottom">
            <div class="d-flex">
                <div class="logo-box border me-4 d-flex justify-content-center align-items-center" style="width:90px; height:90px;">
                    <strong>LOGO</strong>
                </div>
                <div>
                    <h4 class="mb-1">Dicari Backend Developer Laravel</h4>
                    <p class="mb-0" style="font-size: 18px;">Keterangan Bla..Bla..</p>
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-lg btn-purple mb-3 px-4">View Detail</button><br>
                <button class="btn btn-lg btn-purple px-4">Show Bids</button>
            </div>
        </div>

        <div class="job-item d-flex align-items-start justify-content-between p-4 border-bottom">
            <div class="d-flex">
                <div class="logo-box border me-4 d-flex justify-content-center align-items-center" style="width:90px; height:90px;">
                    <strong>LOGO</strong>
                </div>
                <div>
                    <h4 class="mb-1">Dicari Frontend Developer</h4>
                    <p class="mb-0" style="font-size: 18px;">Keterangan Bla..Bla..</p>
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-lg btn-purple mb-3 px-4">View Detail</button><br>
                <button class="btn btn-lg btn-purple px-4">Show Bids</button>
            </div>
        </div>

        <div class="job-item d-flex align-items-start justify-content-between p-4 border-bottom">
            <div class="d-flex">
                <div class="logo-box border me-4 d-flex justify-content-center align-items-center" style="width:90px; height:90px;">
                    <strong>LOGO</strong>
                </div>
                <div>
                    <h4 class="mb-1">Dicari Database Administrator</h4>
                    <p class="mb-0" style="font-size: 18px;">Keterangan Bla..Bla..</p>
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-lg btn-purple mb-3 px-4">View Detail</button><br>
                <button class="btn btn-lg btn-purple px-4">Show Bids</button>
            </div>
        </div>

        <!-- Pagination -->
        <div class="text-center mt-4" style="font-size: 20px;">
            <span class="me-4">&laquo; Prev</span>
            <strong>1</strong>
            <span class="ms-4">Next &raquo;</span>
        </div>
    </div>
@endsection