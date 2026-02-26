<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container">

    <h1>🐾 PetHealth Manager</h1>

    {{-- DASHBOARD --}}
    <div class="dashboard-stats">
        <div class="stat-card">
            <h3>Total Pasien</h3>
            <p>{{ $pets->count() }}</p>
        </div>

        <div class="stat-card">
            <h3>Kunjungan Hari Ini</h3>
            <p>{{ $todayVisits ?? 0 }}</p>
        </div>

        <div class="stat-card">
            <h3>Pasien Sakit Hari Ini</h3>
            <p>{{ $sickToday ?? 0 }}</p>
        </div>
    </div>

    {{-- HERO --}}
    <div class="hero">
        <img src="{{ asset('images/DogCats.png') }}" class="hero-image">

        <div class="hero-text">
            <p>Sistem Manajemen Data Pasien Klinik Hewan</p>
            <a href="{{ route('pets.create') }}" class="btn-hero">
                Tambahkan Pasien
            </a>
        </div>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="section-title">Daftar Pasien</h2>

    @if($pets->count() == 0)
        <p class="empty">Belum ada data pasien.</p>
    @endif

    @foreach($pets as $pet)

        @php
            $latestVisit = $pet->visits->sortByDesc('visit_date')->first();
        @endphp

        <div class="pet-card">
            <div class="pet-content">

                {{-- FOTO --}}
                @if($pet->photo)
                    <div class="pet-image">
                        <img src="{{ asset('storage/' . $pet->photo) }}">
                    </div>
                @endif

                {{-- INFO --}}
                <div class="pet-info">

                    <h3>{{ $pet->pet_name }}</h3>

                    <p><strong>Pemilik:</strong> {{ $pet->owner_name }}</p>
                    <p><strong>Jenis:</strong> {{ $pet->species->name ?? '-' }}</p>
                    <p><strong>Ras:</strong> {{ $pet->breed->name ?? '-' }}</p>
                    <p><strong>Umur:</strong> {{ $pet->age_value }} {{ $pet->age_unit }}</p>

                    {{-- DATA KUNJUNGAN --}}
                    @if($latestVisit)

                        <p>
                            <strong>Status Terakhir:</strong>
                            <span class="status-badge status-{{ strtolower($latestVisit->status) }}">
                                {{ $latestVisit->status }}
                            </span>
                        </p>

                        <p><strong>Kunjungan Terakhir:</strong> {{ $latestVisit->visit_date }}</p>

                        @if($latestVisit->weight)
                            <p><strong>Berat Terakhir:</strong> {{ $latestVisit->weight }} kg</p>
                        @endif

                        @if($latestVisit->notes)
                            <p><strong>Catatan:</strong> {{ $latestVisit->notes }}</p>
                        @endif

                        @if($latestVisit->follow_up)
                            <p>
                                <strong>Tindakan Lanjut:</strong> 
                                {{ $latestVisit->follow_up }}
                            </p>
                        @endif

                    @else
                        <p><em>Belum ada riwayat kunjungan.</em></p>
                    @endif


                    {{-- ACTION BUTTONS --}}
                    <div class="pet-actions">

                        <a href="{{ route('visits.create', $pet->id) }}"
                           class="btn btn-visit">
                            Tambah Kunjungan
                        </a>

                        <a href="{{ route('pets.edit', $pet->id) }}"
                           class="btn btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('pets.destroy', $pet->id) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-delete"
                                    onclick="return confirm('Yakin hapus data ini?')">
                                Hapus
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>

    @endforeach

</div>