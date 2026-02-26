<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container">

    <div class="form-card">

        <h2 class="form-title">
            Tambah Kunjungan
        </h2>

        <p style="text-align:center; margin-bottom:20px;">
            Pasien: <strong>{{ $pet->pet_name }}</strong>
        </p>

        <form action="{{ route('visits.store', $pet->id) }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Tanggal Kunjungan</label>
                <input type="date" name="visit_date" required>
            </div>

            <div class="form-group">
                <label>Status Pemeriksaan</label>
                <select name="status" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Sehat">Sehat</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Kontrol">Kontrol</option>
                </select>
            </div>

            <div class="form-group">
                <label>Berat (kg)</label>
                <input type="number" step="0.1" name="weight">
            </div>

            <div class="form-group">
                <label>Catatan Dokter</label>
                <textarea name="notes" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label>Tindakan Lanjut</label>
                <textarea name="follow_up" rows="3"
                    placeholder="Contoh: Diberikan antibiotik, kontrol 3 hari lagi"></textarea>
            </div>

            <div style="display:flex; gap:15px; margin-top:15px;">
                <button type="submit" class="btn-submit">
                    Simpan Kunjungan
                </button>

                <a href="{{ route('pets.index') }}" class="btn btn-edit">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>