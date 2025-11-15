@extends('layouts.admin.app')

@section('content')
            {{-- Main content --}}
            {{-- menu di bawah topbar --}}
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- chart/grafik --}}
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Worldwide Sales</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="worldwide-sales"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Salse & Revenue</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="salse-revenue"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            {{-- main content yang di tengah --}}
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Data Penerima Bantuan</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                    <th scope="col">Nama Penerima</th>
                                    <th scope="col">Program Bantuan</th>
                                    <th scope="col">Tanggal Daftar</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Verifikasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle flex-shrink-0" src="{{ asset('assets-admin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                                            <div class="ms-3">
                                                <h6 class="mb-0">Wilhelm S Tamba</h6>
                                                <small class="text-muted">wilhelm@example.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Bantuan Sosial Tunai</td>
                                    <td>14 Nov 2025</td>
                                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-primary" href=""><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-warning" href=""><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger" href=""><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-success btn-penerima" data-id="1" data-name="Wilhelm S Tamba">
                                            <i class="fa fa-check"></i> Terima
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle flex-shrink-0" src="{{ asset('assets-admin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                                            <div class="ms-3">
                                                <h6 class="mb-0">Sarah Johnson</h6>
                                                <small class="text-muted">sarah@example.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Bantuan Pendidikan</td>
                                    <td>13 Nov 2025</td>
                                    <td><span class="badge bg-success">Diterima</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-primary" href=""><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-warning" href=""><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger" href=""><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-secondary" disabled>
                                            <i class="fa fa-check-circle"></i> Diterima
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle flex-shrink-0" src="{{ asset('assets-admin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                                            <div class="ms-3">
                                                <h6 class="mb-0">Michael Brown</h6>
                                                <small class="text-muted">michael@example.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Bantuan UMKM</td>
                                    <td>12 Nov 2025</td>
                                    <td><span class="badge bg-danger">Ditolak</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-primary" href=""><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-warning" href=""><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger" href=""><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-success btn-penerima" data-id="3" data-name="Michael Brown">
                                            <i class="fa fa-check"></i> Terima
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle flex-shrink-0" src="{{ asset('assets-admin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                                            <div class="ms-3">
                                                <h6 class="mb-0">Lisa Anderson</h6>
                                                <small class="text-muted">lisa@example.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Bantuan Sosial Tunai</td>
                                    <td>11 Nov 2025</td>
                                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-primary" href=""><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-warning" href=""><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger" href=""><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-success btn-penerima" data-id="4" data-name="Lisa Anderson">
                                            <i class="fa fa-check"></i> Terima
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle flex-shrink-0" src="{{ asset('assets-admin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                                            <div class="ms-3">
                                                <h6 class="mb-0">David Wilson</h6>
                                                <small class="text-muted">david@example.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Bantuan Kesehatan</td>
                                    <td>10 Nov 2025</td>
                                    <td><span class="badge bg-success">Diterima</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-primary" href=""><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-warning" href=""><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger" href=""><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-secondary" disabled>
                                            <i class="fa fa-check-circle"></i> Diterima
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- diatas footer --}}
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">Messages</h6>
                                <a href="">Show All</a>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0"
                                    src="{{ asset('assets-admin/img/user.jpg') }}" alt=""
                                    style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0"
                                    src="{{ asset('assets-admin/img/user.jpg') }}" alt=""
                                    style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0"
                                    src="{{ asset('assets-admin/img/user.jpg') }}" alt=""
                                    style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-3">
                                <img class="rounded-circle flex-shrink-0"
                                    src="{{ asset('assets-admin/img/user.jpg') }}" alt=""
                                    style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Calender</h6>
                                <a href="">Show All</a>
                            </div>
                            <div id="calender"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">To Do List</h6>
                                <a href="">Show All</a>
                            </div>
                            <div class="d-flex mb-2">
                                <input class="form-control bg-transparent" type="text" placeholder="Enter task">
                                <button type="button" class="btn btn-primary ms-2">Add</button>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Verifikasi data penerima baru</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Update status bantuan</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox" checked>
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span><del>Buat laporan bulanan</del></span>
                                        <button class="btn btn-sm text-primary"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Review pengajuan bantuan</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Koordinasi dengan tim lapangan</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end main content --}}

            {{-- Modal Konfirmasi Penerima --}}
            <div class="modal fade" id="modalPenerima" tabindex="-1" aria-labelledby="modalPenerimaLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalPenerimaLabel">Konfirmasi Penerimaan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menerima <strong id="namaPenerima"></strong> sebagai penerima bantuan?</p>
                            <div class="mb-3">
                                <label for="catatanPenerima" class="form-label">Catatan (Opsional)</label>
                                <textarea class="form-control" id="catatanPenerima" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-success" id="confirmPenerima">Ya, Terima</button>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let selectedId = null;
        let selectedName = null;

        // Event listener untuk semua button penerima
        document.querySelectorAll('.btn-penerima').forEach(button => {
            button.addEventListener('click', function() {
                selectedId = this.getAttribute('data-id');
                selectedName = this.getAttribute('data-name');

                // Set nama di modal
                document.getElementById('namaPenerima').textContent = selectedName;

                // Reset catatan
                document.getElementById('catatanPenerima').value = '';

                // Show modal
                const modal = new bootstrap.Modal(document.getElementById('modalPenerima'));
                modal.show();
            });
        });

        // Konfirmasi penerimaan
        document.getElementById('confirmPenerima').addEventListener('click', function() {
            const catatan = document.getElementById('catatanPenerima').value;

            // Simulasi AJAX request
            console.log('Menerima ID:', selectedId);
            console.log('Nama:', selectedName);
            console.log('Catatan:', catatan);

            // Disable button yang diklik
            const button = document.querySelector(`.btn-penerima[data-id="${selectedId}"]`);
            if (button) {
                button.disabled = true;
                button.innerHTML = '<i class="fa fa-check-circle"></i> Diterima';
                button.classList.remove('btn-success');
                button.classList.add('btn-secondary');

                // Update status di tabel
                const row = button.closest('tr');
                const statusCell = row.querySelector('td:nth-child(5)');
                if (statusCell) {
                    statusCell.innerHTML = '<span class="badge bg-success">Diterima</span>';
                }
            }

            // Show success message
            alert(`Berhasil menerima ${selectedName} sebagai penerima bantuan!`);

            // Hide modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalPenerima'));
            modal.hide();
        });

        // Bulk action untuk checkbox
        document.querySelector('thead input[type="checkbox"]').addEventListener('change', function() {
            const isChecked = this.checked;
            document.querySelectorAll('tbody input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });
    });
</script>
@endpush

@push('styles')
<style>
    .btn-penerima {
        transition: all 0.3s ease;
    }

    .btn-penerima:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .badge {
        font-size: 0.75em;
    }

    .btn-group .btn {
        margin-right: 2px;
    }

    .table img {
        object-fit: cover;
    }
</style>
@endpush
