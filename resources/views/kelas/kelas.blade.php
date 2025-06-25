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
                <span>Data Kelas</span>
                <button type="button" class="btn btn-outline-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addKelasModal">
                    <i class="fas fa-plus me-1"></i> Tambah Kelas
                </button>
            </div>
            <div class="card-body">
                <div class="dataTable-wrapper">
                    <table class="table table-striped dataTable-table" id="table1">
                        <thead>
                            <tr>
                                <th>Nama Kelas</th>
                                <th>Kompetensi Keahlian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $item)
                            <tr>
                                <td>{{ $item->nama_kelas }}</td>
                                <td>{{ $item->kompetensi_keahlian }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editKelasModal{{ $item->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <!-- Tombol Hapus -->
                                    <form id="deleteForm{{ $item->id }}" action="{{ route('kelas.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editKelasModal{{ $item->id }}" tabindex="-1" aria-labelledby="editKelasLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editKelasLabel">Edit Kelas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('kelas.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <label>Nama Kelas:</label>
                                                <input type="text" name="nama_kelas" class="form-control" value="{{ $item->nama_kelas }}" required>

                                                <label>Kompetensi Keahlian:</label>
                                                <input type="text" name="kompetensi_keahlian" class="form-control" value="{{ $item->kompetensi_keahlian }}" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
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
<div class="modal fade" id="addKelasModal" tabindex="-1" aria-labelledby="addKelasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKelasLabel">Tambah Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label>Nama Kelas:</label>
                    <input type="text" name="nama_kelas" class="form-control" required>

                    <label>Kompetensi Keahlian:</label>
                    <input type="text" name="kompetensi_keahlian" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data yang dihapus tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }
</script>

@endsection
