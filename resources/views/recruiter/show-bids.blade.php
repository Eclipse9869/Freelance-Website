@extends('layouts.recruiter')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="search-container">
        <form method="GET" action="{{ route('projects.bids', $project->id) }}" class="flex items-center gap-2 w-full">
            <i>🔍</i>
            <input type="text" name="search" placeholder="Search Your Project" value="{{ request('search') }}" class="flex-1">
            <button type="submit" class="btn btn-purple">Search</button>
        </form>
    </div>

    <!-- Job List -->
    <div class="container mt-5">
        <!-- Pagination -->
        <div class="text-center mt-4">
            {{ $bids->links() }}
        </div>

        @forelse ($bids as $bid)
            <div class="job-item d-flex align-items-start justify-content-between p-4 border-bottom flex-wrap">
                <div class="d-flex" style="flex: 1 1 0%; min-width: 0;">
                    <div class="logo-box border me-4 d-flex justify-content-center align-items-center" style="width:90px; height:90px; flex-shrink: 0;">
                        @if($bid->users->profile_pic)
                            <img 
                            src="{{ asset('storage/' . $bid->users->profile_pic) }}" 
                            alt="{{ $bid->users->name }}" 
                            style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <img 
                            src="https://ui-avatars.com/api/?name={{ urlencode($project->users->name) }}&background=4B007D&color=ffffff&size=80" 
                            alt="{{ $bid->users->name }}" 
                            style="width: 80px; height: 80px; object-fit: cover;">
                        @endif
                    </div>
                    <div style="min-width: 0;">
                        <p style="font-size: 20px; color: #420068;"><strong>Bidder: {{ $bid->users->name }}</strong></p>
                        <p>
                            <a href="{{ asset('storage/' . $bid->cv) }}" target="_blank" style="color: #FF4500;">
                                CV
                            </a>
                        </p>
                        <p>
                            <a href="{{ asset('storage/' . $bid->job_app_letter) }}" target="_blank" style="color: #FF4500;">
                                Cover Letter
                            </a>
                        </p>
                        <p style="font-size: 20px; color: green;">Rp {{ number_format($bid->amount, 0, ',', '.') }}</p>
                        <p>{{ $bid->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="d-flex flex-column text-end" style="min-width: 160px; flex-shrink: 0;">
                <button 
                    type="button" 
                    class="btn btn-lg btn-purple mb-2 px-4 show-profile-detail" 
                    data-user-id="{{ $bid->users->id }}" 
                    data-user-username="{{ $bid->users->username }}"
                    data-user-name="{{ $bid->users->name }}" 
                    data-user-gender="{{ $bid->users->gender }}"
                    data-user-dob="{{ $bid->users->date_of_birth }}"
                    data-user-domicile="{{ $bid->users->domicile }}"
                    data-user-email="{{ $bid->users->email }}"
                    data-user-phone="{{ $bid->users->phone }}"
                    data-user-rating="{{ $bid->users->rating }}"
                    data-total-bids="{{ $bid->users->bids()->where('status', 'finished')->count() }}"
                    data-bid-amount="{{ $bid->amount }}"
                    data-project-name="{{ $project->name }}" 
                    data-project-desc="{{ $project->desc }}" 
                    data-project-deadline="{{ $project->deadline }}"
                >
                    Profile Detail
                </button>
                    <button class="btn btn-lg btn-purple px-4">Accept Bid</button>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <h5>Your project hasn't received any bids yet.</h5>
            </div>
        @endforelse
    </div>

    <!-- Modal -->
    <div id="profileDetailModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999;">
        <div class="modal-content" style="background-color: #e6e6e6; max-width:800px; margin:7% auto; padding:20px; display:flex; gap:20px; border-radius:10px; position:relative;">
            <button onclick="closeModal()" style="position:absolute; top:10px; right:10px; color:gray; border:none; padding:5px 10px;">X</button>
            
            <!-- Left Section - User Info -->
            <div style="flex:1;">
                <h3 style="font-size: 20px; color:#4B007D; border-bottom: 2px solid #FF4500; padding-bottom: 5px;"><strong>User Biodata</strong></h3><br>
                <p style="margin-bottom: 10px; font-size: 16px;"><strong>Username:</strong> <span id="userUsername"></span></p>
                <p style="margin-bottom: 10px; font-size: 16px;"><strong>Name:</strong> <span id="userName"></span></p>
                <p style="margin-bottom: 10px; font-size: 16px;"><strong>Gender:</strong> <span id="userGender"></span></p>
                <p style="margin-bottom: 10px; font-size: 16px;"><strong>Date of Birth:</strong> <span id="userDOB"></span></p>
                <p style="margin-bottom: 10px; font-size: 16px;"><strong>Domicile:</strong> <span id="userDomicile"></span></p>
                <p style="margin-bottom: 10px; font-size: 16px;"><strong>Email:</strong> <span id="userEmail"></span></p>
                <p style="margin-bottom: 10px; font-size: 16px;"><strong>Phone:</strong> <span id="userPhone"></span></p>
                <p style="margin-bottom: 10px; font-size: 16px;"><strong>Rating:</strong> <span id="userRating"></span> ⭐</p>
                <p style="margin-bottom: 10px; font-size: 16px;"><strong>Total Finished Bids:</strong> <span id="userTotalBids"></span></p>
                <p style="margin-bottom: 10px; font-size: 16px;"><strong>Current Bid Amount:</strong> Rp <span id="userBidAmount"></span></p>
            </div>

            <!-- Right Section - Project Info -->
            <div style="flex:1;">
                <h3 style="font-size: 20px; color:#4B007D; border-bottom: 2px solid #FF4500; padding-bottom: 5px;"><strong>Project Details</strong></h3><br>
                <p style="margin-bottom: 10px; font-size: 16px;"><strong>Project Name:</strong> <span id="projectName"></span></p>
                <p style="margin-bottom: 10px; font-size: 16px;"><strong>Description:</strong> 
                    <span id="projectDesc" style="white-space: normal; word-wrap: break-word; word-break: break-word; display: block; max-width: 100%;"></span>
                </p>
                <p style="margin-bottom: 10px; font-size: 16px;"><strong>Deadline:</strong> <span id="projectDeadline"></span></p>
            </div>
        </div>
    </div>

    <script>
        const BASE_URL = "{{ asset('storage/profile_pic') }}";
    </script>

    <script>
        function closeModal() {
            document.getElementById('profileDetailModal').style.display = 'none';
        }

        document.querySelectorAll('.show-profile-detail').forEach(button => {
            button.addEventListener('click', function () {
                // Profile picture - jika ada profile_pic, ambil dari storage, jika tidak, pakai avatar placeholder
                document.getElementById('userUsername').textContent = this.dataset.userUsername || '-';
                document.getElementById('userName').textContent = this.dataset.userName || '-';
                document.getElementById('userGender').textContent = this.dataset.userGender || '-';

                // Format tanggal lahir dengan locale indonesia (jika ada)
                const dob = this.dataset.userDob ? new Date(this.dataset.userDob) : null;
                document.getElementById('userDOB').textContent = dob ? dob.toLocaleDateString('id-ID') : '-';

                document.getElementById('userDomicile').textContent = this.dataset.userDomicile || '-';
                document.getElementById('userEmail').textContent = this.dataset.userEmail || '-';
                document.getElementById('userPhone').textContent = this.dataset.userPhone || '-';
                document.getElementById('userRating').textContent = this.dataset.userRating || '0';
                document.getElementById('userTotalBids').textContent = this.dataset.totalBids || '0';
                document.getElementById('userBidAmount').textContent = parseInt(this.dataset.bidAmount || 0).toLocaleString('id-ID');

                document.getElementById('projectName').textContent = this.dataset.projectName || '-';
                document.getElementById('projectDesc').textContent = this.dataset.projectDesc || '-';
                document.getElementById('projectDeadline').textContent = this.dataset.projectDeadline 
                    ? new Date(this.dataset.projectDeadline).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    }) 
                    : '-';
                document.getElementById('profileDetailModal').style.display = 'block';
            });
        });
    </script>
@endsection

