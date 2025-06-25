@extends('layouts.master')

@section('content')
<div class="page-heading">
    <h3>{{ $header_title }}</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span>Data Petugas</span>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                data-bs-target="#addPetugasModal">
                <i class="fas fa-plus me-1"></i> Tambah Petugas
            </button>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Petugas</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($petugas as $p)
                    <tr>
                        <td>{{ $p->nama_petugas }}</td>
                        <td>{{ $p->user->username ?? '-' }}</td>
                        <td>{{ $p->user->level ?? '-' }}</td>
                        <td>
                            <!-- Edit -->
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editPetugasModal{{ $p->id }}">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Delete -->
                            <!-- Delete -->
                            <!-- Delete -->
                            <form method="POST" action="{{ route('petugas.destroy', $p->id) }}" style="display:inline;"
                                class="delete-form">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>


                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <!-- Modal Edit Petugas -->
                    <div class="modal fade" id="editPetugasModal{{ $p->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('petugas.update', $p->id) }}">
                                @csrf @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Petugas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label>Nama Petugas:</label>
                                        <input type="text" name="nama_petugas" value="{{ $p->nama_petugas }}"
                                            class="form-control" required>

                                        <label>Username:</label>
                                        <input type="text" name="username" value="{{ optional($p->user)->username }}"
                                            class="form-control" required>

                                        <label>Password (isi jika ingin ubah):</label>
                                        <input type="password" name="password" class="form-control">

                                        <label>Level:</label>
                                        <select name="level" class="form-control" required>
                                            <option value="admin"
                                                {{ optional($p->user)->level == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="petugas"
                                                {{ optional($p->user)->level == 'petugas' ? 'selected' : '' }}>Petugas
                                            </option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
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
</section>

<!-- Modal Tambah Petugas -->
<div class="modal fade" id="addPetugasModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('petugas.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Petugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Nama Petugas:</label>
                    <input type="text" name="nama_petugas" class="form-control" required>

                    <label>Username:</label>
                    <input type="text" name="username" class="form-control" required>

                    <label>Password:</label>
                    <input type="password" name="password" class="form-control" required>

                    <label>Level:</label>
                    <select name="level" class="form-control" required>
                        <option value="">-- Pilih Level --</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                    </select>
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
    // Menggunakan SweetAlert untuk konfirmasi hapus
    document.querySelectorAll('.delete-form').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Mencegah pengiriman form langsung

            // SweetAlert konfirmasi penghapusan
            Swal.fire({
                title: 'Yakin hapus petugas ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Mengirimkan form jika dikonfirmasi
                }
            });
        });
    });
</script>

@endsection
