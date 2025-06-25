@extends('layouts.master')

@section('content')
<div class="page-heading">
    <h3>{{ $header_title }}</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span>Data Pembayaran</span>
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addPembayaranModal">
                <i class="fas fa-plus me-1"></i> Tambah Pembayaran
            </button>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Petugas</th>
                        <th>Siswa</th>
                        <th>Tanggal Bayar</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayaran as $p)
                    <tr>
                        <td>{{ $p->petugas->nama_petugas ?? '-' }}</td>
                        <td>{{ $p->siswa->nama ?? '-' }}</td>
                        <td>{{ $p->tgl_bayar }}</td>
                        <td>{{ $p->bulan_dibayar }}</td>
                        <td>{{ $p->tahun_dibayar }}</td>
                        <td>Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('pembayaran.destroy', $p->id) }}" method="POST" class="delete-form" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal Tambah -->
<div class="modal fade" id="addPembayaranModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('pembayaran.store') }}" method="POST" id="formPembayaran">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Siswa</label>
                    <select name="nisn" id="nisn" class="form-control" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($siswa as $s)
                            <option value="{{ $s->nisn }}" data-nominal="{{ optional($s->spp)->nominal }}">
                                {{ $s->nama }}
                            </option>
                        @endforeach
                    </select>

                    <label>Bulan Dibayar</label>
                    <select name="bulan_dibayar" class="form-control" required>
                        <option value="">-- Pilih Bulan --</option>
                        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                            <option value="{{ $bulan }}">{{ $bulan }}</option>
                        @endforeach
                    </select>

                    <label>Tahun Dibayar</label>
                    <input type="text" name="tahun_dibayar" class="form-control" required>

                    <label>Jumlah Bayar</label>
                    <input type="text" id="jumlah_bayar" class="form-control" readonly>

                    <!-- Hidden input untuk mengirimkan jumlah_bayar ke backend -->
                    <input type="hidden" name="jumlah_bayar" id="jumlah_bayar_hidden">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // SweetAlert untuk hapus
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin hapus data pembayaran?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
            }).then(result => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Autofill jumlah bayar dari siswa yang dipilih
    document.getElementById('nisn').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const nominal = selectedOption.getAttribute('data-nominal');
        const displayInput = document.getElementById('jumlah_bayar');
        const hiddenInput = document.getElementById('jumlah_bayar_hidden');
        if (nominal) {
            const formatted = parseInt(nominal).toLocaleString('id-ID');
            displayInput.value = 'Rp ' + formatted;
            hiddenInput.value = nominal;
        } else {
            displayInput.value = '';
            hiddenInput.value = '';
        }
    });
</script>
@endsection
    