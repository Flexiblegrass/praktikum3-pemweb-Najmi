<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container">

    <div class="form-card">
        <h2 class="form-title">Edit Pasien</h2>

        <form action="{{ route('pets.update', $pet->id) }}" 
              method="POST" 
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Hewan</label>
                <input type="text" 
                       name="pet_name" 
                       value="{{ $pet->pet_name }}" 
                       required>
            </div>

            <div class="form-group">
                <label>Nama Pemilik</label>
                <input type="text" 
                       name="owner_name" 
                       value="{{ $pet->owner_name }}" 
                       required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Jenis</label>
                    <select name="species_id" id="species" required>
                        @foreach($species as $s)
                            <option value="{{ $s->id }}" 
                                {{ $pet->species_id == $s->id ? 'selected' : '' }}>
                                {{ $s->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Ras</label>
                    <select name="breed_id" id="breed" required>
                        @php
                            $breeds = \App\Models\Breed::where('species_id', $pet->species_id)->get();
                        @endphp

                        @foreach($breeds as $breed)
                            <option value="{{ $breed->id }}" 
                                {{ $pet->breed_id == $breed->id ? 'selected' : '' }}>
                                {{ $breed->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Umur</label>
                    <input type="number" 
                           name="age_value" 
                           value="{{ $pet->age_value }}" 
                           required>
                </div>

                <div class="form-group">
                    <label>Satuan</label>
                    <select name="age_unit" required>
                        <option value="Hari" {{ $pet->age_unit == 'Hari' ? 'selected' : '' }}>Hari</option>
                        <option value="Bulan" {{ $pet->age_unit == 'Bulan' ? 'selected' : '' }}>Bulan</option>
                        <option value="Tahun" {{ $pet->age_unit == 'Tahun' ? 'selected' : '' }}>Tahun</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Gender</label>
                <select name="gender" required>
                    <option value="Jantan" {{ $pet->gender == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                    <option value="Betina" {{ $pet->gender == 'Betina' ? 'selected' : '' }}>Betina</option>
                </select>
            </div>

            <div class="form-group">
                <label>Foto Hewan</label>
                <input type="file" name="photo" accept="image/*">
            </div>

            @if($pet->photo)
                <div class="form-group">
                    <label>Foto Saat Ini:</label>
                    <img src="{{ asset('storage/' . $pet->photo) }}" 
                         width="150" 
                         style="border-radius:10px;">
                </div>
            @endif

            <div style="display:flex; gap:15px;">
                <button type="submit" class="btn-submit">
                    Update Pasien
                </button>

                <a href="{{ route('pets.index') }}" 
                   class="btn btn-edit"
                   style="text-align:center;">
                    Batal
                </a>
            </div>

        </form>
    </div>

</div>