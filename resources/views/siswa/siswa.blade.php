@extends('layouts.master')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $header_title }}</h3>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span>Data Siswa</span>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addSiswaModal">
                    <i class="fas fa-plus me-1"></i> Tambah Siswa
                </button>
            </div>
            <div class="card-body">
                <div class="dataTable-wrapper">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>NISN</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tahun SPP</th>
                                <th>Alamat</th>
                                <th>No. Telp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswas as $siswa)
                            <tr>
                                <td>{{ $siswa->nisn }}</td>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $siswa->spp->tahun ?? '-' }}</td>
                                <td>{{ $siswa->alamat }}</td>
                                <td>{{ $siswa->no_telp }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editSiswaModal{{ $siswa->nisn }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('siswa.destroy', $siswa->nisn) }}" method="POST" style="display:inline;" id="deleteForm{{ $siswa->nisn }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $siswa->nisn }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editSiswaModal{{ $siswa->nisn }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('siswa.update', $siswa->nisn) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Siswa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="nisn" value="{{ $siswa->nisn }}">
                                                <label>NIS:</label>
                                                <input type="text" name="nis" value="{{ $siswa->nis }}" class="form-control" required>
                                                <label>Nama:</label>
                                                <input type="text" name="nama" value="{{ $siswa->nama }}" class="form-control" required>
                                                <label>Kelas:</label>
                                                <select name="id_kelas" class="form-control" required>
                                                    @foreach ($kelas as $k)
                                                        <option value="{{ $k->id }}" {{ $k->id == $siswa->id_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                                                    @endforeach
                                                </select>
                                                <label>SPP (Tahun):</label>
                                                <select name="id_spp" class="form-control" required>
                                                    @foreach ($spps as $spp)
                                                        <option value="{{ $spp->id }}" {{ $spp->id == $siswa->id_spp ? 'selected' : '' }}>{{ $spp->tahun }}</option>
                                                    @endforeach
                                                </select>
                                                <label>Alamat:</label>
                                                <input type="text" name="alamat" value="{{ $siswa->alamat }}" class="form-control" required>
                                                <label>No. Telp:</label>
                                                <input type="text" name="no_telp" value="{{ $siswa->no_telp }}" class="form-control" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="addSiswaModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('siswa.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>NISN:</label>
                    <input type="text" name="nisn" class="form-control" required>
                    <label>NIS:</label>
                    <input type="text" name="nis" class="form-control" required>
                    <label>Nama:</label>
                    <input type="text" name="nama" class="form-control" required>
                    <label>Kelas:</label>
                    <select name="id_kelas" class="form-control" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                    <label>SPP (Tahun):</label>
                    <select name="id_spp" class="form-control" required>
                        <option value="">-- Pilih Tahun SPP --</option>
                        @foreach ($spps as $spp)
                            <option value="{{ $spp->id }}">{{ $spp->tahun }}</option>
                        @endforeach
                    </select>
                    <label>Alamat:</label>
                    <input type="text" name="alamat" class="form-control" required>
                    <label>No. Telp:</label>
                    <input type="text" name="no_telp" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function confirmDelete(nisn) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data yang dihapus tidak bisa dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm' + nisn).submit();
        }
    });
}
</script>
@endsection
