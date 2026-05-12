<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold text-dark mb-0" style="font-family: 'Poppins', sans-serif;">
                {{ __('My Reported Items') }}
            </h2>
            <a href="{{ route('report.index') }}" 
            class="btn btn-primary btn-sm rounded-pill px-4 py-2 shadow-sm ms-3">
                <i class="ti ti-plus me-1"></i> Report New
            </a>
        </div>
    </x-slot>
    <div class="py-5" style="font-family: 'Poppins', sans-serif;">
        <div class="container">
            <div class="row">
                @forelse($items as $item)
                                    <div class="col-md-6 col-lg-4 grid-margin">
                                        <div class="card border-0 shadow-sm h-100 transition-up overflow-hidden">
                                            <div class="position-relative">
                                                @if($item->image)
                                                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top"
                                                        alt="{{ $item->name }}" style="height: 200px; object-fit: cover;">
                                                @else
                                                                    <div class="d-flex align-items-center justify-content-center {{ $item->type ==
                                                    'lost' ? 'bg-gradient-danger' : 'bg-gradient-info' }}" style="height: 200px;">
                                                                        <span class="display-1 fw-bold text-dark opacity-25">{{ substr($item-> name, 0, 1) }}</span>
                                                                    </div>
                                                @endif
                                                <span class="badge bg-white text-black shadow-sm position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill small fw-bold border-0">
                                                    {{ strtoupper($item->type) }}
                                                </span>
                                            </div>
                                            <div class="card-body p-4">
                                                <h4 class="fw-bold text-dark mb-1">{{ $item->name }}</h4>
                                                <p class="text-muted small mb-4">
                                                    <i class="ti ti-calendar-event me-1"></i> Reported {{ $item->created_at-> diffForHumans() }}
                                                </p>
                                                <div class="p-3 rounded-3 mb-4 {{ $item->status == 'claimed_requested' ? 'bg-light border-start border-warning border-4' : 'bg-light border-start border-success border-4' }}">
                                                    <label class="d-block text-muted tiny-text text-uppercase fw-bold mb-1"
                                                        style="font-size: 0.65rem;">Current Status</label>
                                                    @if($item->status == 'claimed_requested')
                                                        <span class="text-dark fw-semibold">
                                                            <i class="ti ti-alert-circle me-1 text-warning"></i> Claim Requested
                                                        </span>
                                                    @elseif($item->status == 'found')
                                                        <span class="text-dark fw-semibold">
                                                            <i class="ti ti-circle-check me-1 text-success"></i> Item Found
                                                        </span>
                                                    @else
                                                        <span class="text-dark fw-semibold">{{ ucfirst($item->status) }}</span>
                                                    @endif
                                                </div>
                                                <div class="d-grid">
                                                    @php 
                                                        $route = ($item->type == 'found') ? route('report.foundview', $item->id) :
                                                                route('report.show', $item->id); 
                                                    @endphp
                                                    <a href="{{ $route }}" class="btn btn-outline-dark btn-sm rounded-pill py-2 fw-
                    medium text-center">
                                                        View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="opacity-50 mb-3">
                            <i class="ti ti-camera-off" style="font-size: 5rem;"></i>
                        </div>
                        <h3 class="text-dark fw-bold">No reports yet</h3>
                        <p class="text-muted">Once you report an item with a photo, it will appear
                            here.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <style>
        .transition-up {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .transition-up:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12) !important;
        }

        .tiny-text {
            letter-spacing: 1px;
            font-size: 0.65rem;
        }

        .card-img-top {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
    </style>
</x-app-layout>