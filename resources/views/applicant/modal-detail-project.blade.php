<!-- Modal untuk project detail -->
<div class="modal fade" id="projectDetailModal{{ $item->id }}" tabindex="-1" aria-labelledby="projectDetailModalLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="projectDetailModalLabel{{ $item->id }}">{{ $item->name }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <p>{{ $item->desc }}</p>
        <hr>

        <div class="mb-3">
          <h6>Project Owner:</h6>
          <div class="d-flex gap-3 align-items-center">
            <div>
              @if($item->users->profile_pic)
                <img src="{{ asset('storage/profile_pics/' . $item->users->profile_pic) }}"
                    alt="{{ $item->users->name }}" width="80" height="80" style="object-fit: cover; border-radius: 50%;">
              @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->users->name) }}&background=4B007D&color=ffffff&size=80"
                    alt="{{ $item->users->name }}" width="80" height="80" style="object-fit: cover; border-radius: 50%;">
              @endif
            </div>
            <div>
              <strong>{{ $item->users->name }}</strong><br>
              Kota {{ $item->users->domicile ?? '-' }}
            </div>
          </div>
        </div>

        <div>
          <p><strong>Syarat Minimal:</strong> {{ $item->req_edu ?? '-' }}</p>
          <p><strong>Published Date:</strong> {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</p>
          <p><strong>Published Budget:</strong>
            Rp {{ number_format($item->amount_min, 0, ',', '.') }} -
            Rp {{ number_format($item->amount_max, 0, ',', '.') }}
          </p>
          <p><strong>Deadline Project:</strong> {{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('d F Y') }}</p>
        </div>
      </div>

      <div class="modal-footer">
        <a href="{{ route('projects.edit', $item->id) }}" class="btn btn-purple">Edit Project</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
