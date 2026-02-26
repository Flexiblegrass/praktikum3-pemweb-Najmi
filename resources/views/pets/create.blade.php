<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container">

    <div class="form-card">
        <h2 class="form-title">Tambah Pasien</h2>

        <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Nama Hewan</label>
                <input type="text" name="pet_name" required>
            </div>

            <div class="form-group">
                <label>Nama Pemilik</label>
                <input type="text" name="owner_name" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Jenis</label>
                    <select name="species_id" id="species" required>
                        <option value="">-- Pilih Jenis --</option>
                        @foreach($species as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Ras</label>
                    <select name="breed_id" id="breed" required>
                        <option value="">-- Pilih Ras --</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Umur</label>
                    <input type="number" name="age_value" required>
                </div>

                <div class="form-group">
                    <label>Satuan</label>
                    <select name="age_unit" required>
                        <option value="Hari">Hari</option>
                        <option value="Bulan">Bulan</option>
                        <option value="Tahun">Tahun</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Gender</label>
                <select name="gender" required>
                    <option value="Jantan">Jantan</option>
                    <option value="Betina">Betina</option>
                </select>
            </div>

            <div class="form-group">
                <label>Foto Hewan</label>
                <input type="file" name="photo" accept="image/*">
            </div>

            <button type="submit" class="btn-submit">Simpan Pasien</button>

        </form>
    </div>

</div>

<script>
document.getElementById('species').addEventListener('change', function() {
    let speciesId = this.value;
    let breedSelect = document.getElementById('breed');

    if(!speciesId){
        breedSelect.innerHTML = '<option value="">-- Pilih Ras --</option>';
        return;
    }

    fetch('/get-breeds/' + speciesId)
        .then(response => response.json())
        .then(data => {
            breedSelect.innerHTML = '<option value="">-- Pilih Ras --</option>';

            data.forEach(function(breed) {
                breedSelect.innerHTML += 
                    '<option value="' + breed.id + '">' + 
                    breed.name + 
                    '</option>';
            });
        })
        .catch(error => console.error('Error:', error));
});
</script>