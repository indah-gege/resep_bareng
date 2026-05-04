@extends('admin.layouts.sidebar')
@section('title', 'Tambah Resep')

@push('styles')
<style>
    .top-bar { display:flex; align-items:center; gap:12px; margin-bottom:20px; }
    .btn-back {
        background:#3a3a3a; color:white; border:none; padding:7px 16px;
        border-radius:6px; font-size:13px; cursor:pointer; text-decoration:none;
    }
    .edit-title { font-size:16px; font-weight:700; color:#222; }
    .edit-date { font-size:11px; color:#aaa; margin-left:auto; }
    .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:24px; }
    .form-section { background:white; border-radius:10px; padding:20px; }
    .form-section h3 { font-size:14px; font-weight:700; color:#333; margin-bottom:14px; }
    .form-group { margin-bottom:14px; }
    .form-group label { display:block; font-size:12px; color:#555; margin-bottom:4px; font-weight:600; }
    .form-group label span { color:#e53e3e; }
    .form-group input, .form-group textarea, .form-group select {
        width:100%; padding:9px 12px; border:1.5px solid #ddd;
        border-radius:6px; font-size:13px; outline:none;
    }
    .form-group input:focus, .form-group textarea:focus { border-color:#7b1a1a; }
    .form-group textarea { resize:vertical; min-height:80px; }
    .bahan-list, .langkah-list { display:flex; flex-direction:column; gap:8px; }
    .bahan-item { display:flex; gap:6px; align-items:center; }
    .bahan-item input { flex:1; padding:8px 10px; border:1.5px solid #ddd; border-radius:6px; font-size:13px; }
    .bahan-item .jumlah { width:90px; }
    .btn-tambah-bahan {
        border:none; background:#3a3a3a; color:white;
        padding:8px 16px; border-radius:6px; font-size:13px; cursor:pointer; margin-top:6px;
    }
    .langkah-item { display:flex; gap:8px; align-items:flex-start; }
    .langkah-num {
        width:26px; height:26px; background:#3a3a3a; color:white;
        border-radius:50%; display:flex; align-items:center; justify-content:center;
        font-size:12px; font-weight:700; flex-shrink:0; margin-top:8px;
    }
    .langkah-item textarea { flex:1; min-height:60px; }
    .upload-box {
        border:2px dashed #ddd; border-radius:8px; padding:24px;
        text-align:center; cursor:pointer; font-size:12px; color:#aaa;
        position:relative;
    }
    .upload-box input[type=file] {
        position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%;
    }
    .upload-box.has-file { border-color:#7b1a1a; color:#7b1a1a; }
    .upload-preview { width:100%; max-height:120px; object-fit:cover; border-radius:6px; margin-top:8px; }
    .form-footer { display:flex; justify-content:flex-end; gap:10px; margin-top:20px; }
    .btn-batal { background:white; border:1.5px solid #ddd; color:#555; padding:9px 24px; border-radius:6px; font-size:13px; cursor:pointer; }
    .btn-publish { background:#7b1a1a; color:white; border:none; padding:9px 24px; border-radius:6px; font-size:13px; cursor:pointer; }
</style>
@endpush

@section('content')
<div class="top-bar">
    <a href="{{ route('admin.resep.index') }}" class="btn-back">← Kembali</a>
    <span class="edit-title">Tambah resep baru</span>
    <span class="edit-date">Terakhir diubah: {{ now()->format('d M Y') }}</span>
</div>

<form method="POST" action="{{ route('admin.resep.simpan') }}" enctype="multipart/form-data">
@csrf
<div class="form-grid">
    {{-- Kolom kiri --}}
    <div>
        <div class="form-section">
            <h3>Informasi Dasar</h3>
            <div class="form-group">
                <label>Judul resep: <span>*</span></label>
                <input type="text" name="judul" placeholder="Contoh: Dessert Coklat" value="{{ old('judul') }}">
            </div>
            <div class="form-group">
                <label>Deskripsi singkat: <span>*</span></label>
                <textarea name="deskripsi_singkat" placeholder="Ceritakan sedikit tentang resep ini...">{{ old('deskripsi_singkat') }}</textarea>
            </div>
            
            <div class="form-group">
                <label>Kategori: <span>*</span></label>
                <select name="kategori_id">
                    <option value="">Pilih kategori</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}" {{ old('kategori_id')==$k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Waktu masak: <span>*</span></label>
                <input type="text" name="waktu_masak" placeholder="Contoh: 30 menit" value="{{ old('waktu_masak') }}">
            </div>

            <div class="form-group">
                <label>Foto resep:</label>
                <div class="upload-box" id="uploadBox">
                    <input type="file" name="foto" accept="image/*" onchange="previewFoto(this)">
                    <div id="uploadText">Klik untuk upload foto<br><small>PNG, JPG hingga 2MB</small></div>
                    <img id="uploadPreview" class="upload-preview" style="display:none">
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom kanan --}}
    <div>
        <div class="form-section" style="margin-bottom:16px">
            <h3>Bahan-bahan</h3>
            <div class="bahan-list" id="bahanList">
                <div class="bahan-item">
                    <input type="text" name="bahan_nama[]" placeholder="Nama bahan">
                    <input type="text" name="bahan_jumlah[]" placeholder="Jumlah" class="jumlah">
                </div>
            </div>
            <button type="button" class="btn-tambah-bahan" onclick="tambahBahan()">+ Tambah bahan</button>
        </div>
        <div class="form-section">
            <h3>Langkah-langkah</h3>
            <div class="langkah-list" id="langkahList">
                <div class="langkah-item">
                    <div class="langkah-num">1</div>
                    <textarea name="langkah[]" placeholder="Tulis langkah berikutnya..."></textarea>
                </div>
            </div>
            <button type="button" class="btn-tambah-bahan" onclick="tambahLangkah()">+ Tambah langkah</button>
        </div>
    </div>
</div>

<div class="form-footer">
    <a href="{{ route('admin.resep.index') }}" class="btn-batal">Batal</a>
    <button type="submit" class="btn-publish">Publikasikan resep</button>
</div>
</form>
@endsection

@push('scripts')
<script>
function tambahBahan() {
    const list = document.getElementById('bahanList');
    const div = document.createElement('div');
    div.className = 'bahan-item';
    div.innerHTML = `<input type="text" name="bahan_nama[]" placeholder="Nama bahan">
                     <input type="text" name="bahan_jumlah[]" placeholder="Jumlah" class="jumlah">`;
    list.appendChild(div);
}
function tambahLangkah() {
    const list = document.getElementById('langkahList');
    const num = list.children.length + 1;
    const div = document.createElement('div');
    div.className = 'langkah-item';
    div.innerHTML = `<div class="langkah-num">${num}</div>
                     <textarea name="langkah[]" placeholder="Tulis langkah berikutnya..."></textarea>`;
    list.appendChild(div);
}
function previewFoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('uploadPreview').src = e.target.result;
            document.getElementById('uploadPreview').style.display = 'block';
            document.getElementById('uploadText').style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush