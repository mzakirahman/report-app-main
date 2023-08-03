@extends('layouts.app')

{{-- set title --}}
@section('title', 'Laporan')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            {{-- error --}}
            @if ($errors->any())
                <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- breadcumb --}}
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Laporan</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Laporan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- add card --}}
            @can('laporan_create')
                <div class="content-body">
                    <section id="add-home">
                        <div class="row">
                            <div class="col-12">

                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <a data-action="collapse">
                                            <h4 class="card-title text-white">Add Data</h4>
                                            <a class="heading-elements-toggle"><i
                                                    class="la la-ellipsis-v font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <ul class="list-inline mb-0">
                                                    <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="card-content collapse hide">
                                        <div class="card-body card-dashboard">

                                            <form class="form form-horizontal" action="{{ route('backsite.laporan.store') }}"
                                                method="POST" enctype="multipart/form-data">

                                                @csrf

                                                <div class="form-body" id="show_item">
                                                    <div class="form-section">
                                                        <p>Please complete the input <code>required</code>, before you click the
                                                            submit button.</p>
                                                    </div>

                                                    <div
                                                        class="form-group row {{ $errors->has('dosen_id') ? 'has-error' : '' }}">
                                                        <label class="col-md-3 label-control">Nama Dosen <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="dosen_id" id="dosen_id" class="form-control select2">
                                                                <option value="{{ '' }}" disabled selected>Choose
                                                                </option>
                                                                @foreach ($dosen as $key => $dosen_item)
                                                                    <option value="{{ $dosen_item->id }}">
                                                                        {{ $dosen_item->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                            @if ($errors->has('dosen_id'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('dosen_id') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="form-group row {{ $errors->has('kelas_id') ? 'has-error' : '' }}">
                                                        <label class="col-md-3 label-control">Nama Kelas <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="kelas_id" id="kelas_id" class="form-control select2">
                                                                <option value="{{ '' }}" disabled selected>Choose
                                                                </option>
                                                                @foreach ($kelas as $key => $kelas_item)
                                                                    <option value="{{ $kelas_item->id }}">
                                                                        {{ $kelas_item->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                            @if ($errors->has('kelas_id'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('kelas_id') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="agenda">Agenda <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="agenda" name="agenda[]"
                                                                class="form-control" value="{{ old('agenda.0') }}"
                                                                autocomplete="off" placeholder="example Kegiatan Seminar Kelas">

                                                            @if ($errors->has('agenda'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('agenda') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="deskripsi">Deskripsi <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="deskripsi" name="deskripsi[]"
                                                                class="form-control" value="{{ old('deskripsi.0') }}"
                                                                autocomplete="off"
                                                                placeholder="example Seminar tentang pentingnya belajar pemrograman bagi generasi z">

                                                            @if ($errors->has('deskripsi'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('deskripsi') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="tindakan">Tindakan <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="tindakan" name="tindakan[]"
                                                                value="{{ old('tindakan.0') }}" class="form-control"
                                                                autocomplete="off"
                                                                placeholder="example Berjalan sesuai dengan apa yang telah direncanakan">

                                                            @if ($errors->has('tindakan'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('tindakan') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="lampiran">Lampiran <code
                                                                style="color:green;">optional</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <div class="custom-file">
                                                                <input type="file"
                                                                    accept="image/png, image/svg, image/jpeg"
                                                                    class="custom-file-input" id="lampiran"
                                                                    name="lampiran[]" value="{{ old('lampiran') }}">
                                                                <label class="custom-file-label" for="lampiran"
                                                                    aria-describedby="lampiran">Choose File</label>
                                                            </div>

                                                            <p class="text-muted"><small class="text-danger">Hanya dapat
                                                                    mengunggah 1 file</small><small> dan yang dapat digunakan
                                                                    JPEG, SVG, PNG & Maksimal ukuran file hanya 10
                                                                    MegaBytes</small></p>

                                                            @if ($errors->has('lampiran'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('lampiran') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-md-3"></div>
                                                        <div class="col-md-9 mx-auto">
                                                            <div class="row mx-auto justify-content-end">
                                                                <button class="btn btn-success" id="addButton">
                                                                    <i class="la la-plus-square-o"></i> Tambah Agenda
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-actions text-right">
                                                    <button type="submit" style="width:120px;" class="btn btn-cyan"
                                                        onclick="return confirm('Are you sure want to save this data ?')">
                                                        <i class="la la-check-square-o"></i> Submit
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endcan

            {{-- table card --}}
            @can('laporan_table')
                <div class="content-body">
                    <section id="table-home">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Laporan List</h4>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">

                                            <div class="table-responsive">
                                                <table
                                                    class="table table-striped table-bordered text-inputs-searching default-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Dosen</th>
                                                            <th>Kelas</th>
                                                            <th>Dokumen</th>
                                                            <th>Kaprodi</th>
                                                            <th>Kajur</th>
                                                            {{-- <th>Lampiran</th> --}}
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($results as $item)
                                                            <tr data-entry-id="{{ $item->id }}">
                                                                <td>{{ isset($item->created_at) ? date('d/m/Y H:i:s', strtotime($item->created_at)) : '' }}
                                                                </td>
                                                                <td>{{ $item->dosen_name }}</td>
                                                                <td>{{ $item->kelas_name }}</td>
                                                                <td><a href="{{ route('backsite.laporan.pdf', $item->id) }}"
                                                                        class="text-bold" target="_blank">Print PDF</a>
                                                                </td>
                                                                <td>
                                                                    @if ($item->status_kaprodi == 1)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Validasi Diterima' }}</span>
                                                                    @elseif($item->status_kaprodi == 2)
                                                                        <span
                                                                            class="badge badge-info">{{ 'Menunggu Validasi' }}</span>
                                                                    @elseif($item->status_kaprodi == 3)
                                                                        <span
                                                                            class="badge badge-warning">{{ 'Revisi' }}</span>
                                                                    @elseif($item->status_kaprodi == 4)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Selesai Revisi' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->status_kajur == 1)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Validasi Diterima' }}</span>
                                                                    @elseif($item->status_kajur == 2)
                                                                        <span
                                                                            class="badge badge-info">{{ 'Menunggu Validasi' }}</span>
                                                                    @elseif($item->status_kajur == 3)
                                                                        <span
                                                                            class="badge badge-warning">{{ 'Revisi' }}</span>
                                                                    @elseif($item->status_kajur == 4)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Selesai Revisi' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->status_kajur == 1)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Validasi Diterima' }}</span>
                                                                    @elseif($item->status_kajur == 2)
                                                                        <span
                                                                            class="badge badge-info">{{ 'Menunggu Validasi' }}</span>
                                                                    @elseif($item->status_kajur == 3)
                                                                        <span
                                                                            class="badge badge-warning">{{ 'Revisi' }}</span>
                                                                    @elseif($item->status_kajur == 4)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Selesai Revisi' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                {{-- <td><a data-fancybox="gallery"
                                                                        data-src="{{ request()->getSchemeAndHttpHost() . '/storage' . '/' . $item->lampiran }}"
                                                                        class="blue accent-4">Show</a></td> --}}
                                                                <td class="text-center">
                                                                    <div class="btn-group mr-1 mb-1">
                                                                        <button type="button"
                                                                            class="btn btn-info btn-sm dropdown-toggle"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">
                                                                            @can('laporan_show')
                                                                                <a href="#mymodal"
                                                                                    data-remote="{{ route('backsite.laporan.show', $item->id) }}"
                                                                                    data-toggle="modal" data-target="#mymodal"
                                                                                    data-title="Laporan Detail"
                                                                                    class="dropdown-item">
                                                                                    Show
                                                                                </a>
                                                                            @endcan
                                                                            @can('laporan_edit')
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('backsite.laporan.edit', $item->id) }}">
                                                                                    Edit
                                                                                </a>
                                                                            @endcan
                                                                            @can('laporan_delete')
                                                                                <form
                                                                                    action="{{ route('backsite.laporan.destroy', $item->id) }}"
                                                                                    method="POST"
                                                                                    onsubmit="return confirm('Are you sure want to delete this data ?');">
                                                                                    @csrf
                                                                                    <input type="hidden" name="_method"
                                                                                        value="DELETE">
                                                                                    <input type="hidden" name="_token"
                                                                                        value="{{ csrf_token() }}">
                                                                                    <input type="submit" class="dropdown-item"
                                                                                        value="Delete">
                                                                                </form>
                                                                            @endcan
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Dosen</th>
                                                            <th>Kelas</th>
                                                            <th>Dokumen</th>
                                                            <th>Kaprodi</th>
                                                            <th>Kajur</th>
                                                            {{-- <th>Lampiran</th> --}}
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endcan
            @can('laporan_dosen_table')
                <div class="content-body">
                    <section id="table-home">
                        <!-- Zero configuration table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Laporan List</h4>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">

                                            <div class="table-responsive">
                                                <table
                                                    class="table table-striped table-bordered text-inputs-searching default-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Dosen</th>
                                                            <th>Kelas</th>
                                                            <th>Dokumen</th>
                                                            <th>Kaprodi</th>
                                                            <th>Kajur</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($results as $item)
                                                            <tr data-entry-id="{{ $item->id }}">
                                                                <td>{{ isset($item->created_at) ? date('d/m/Y H:i:s', strtotime($item->created_at)) : '' }}
                                                                </td>
                                                                <td>{{ $item->dosen_name }}</td>
                                                                <td>{{ $item->kelas_name }}</td>
                                                                <td><a href="{{ route('backsite.laporan.pdf', $item->id) }}"
                                                                        class="text-bold" target="_blank">Print PDF</a>
                                                                </td>
                                                                <td>
                                                                    @if ($item->status_kaprodi == 1)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Validasi Diterima' }}</span>
                                                                    @elseif($item->status_kaprodi == 2)
                                                                        <span
                                                                            class="badge badge-info">{{ 'Menunggu Validasi' }}</span>
                                                                    @elseif($item->status_kaprodi == 3)
                                                                        <span
                                                                            class="badge badge-warning">{{ 'Revisi' }}</span>
                                                                    @elseif($item->status_kaprodi == 4)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Selesai Revisi' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->status_kajur == 1)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Validasi Diterima' }}</span>
                                                                    @elseif($item->status_kajur == 2)
                                                                        <span
                                                                            class="badge badge-info">{{ 'Menunggu Validasi' }}</span>
                                                                    @elseif($item->status_kajur == 3)
                                                                        <span
                                                                            class="badge badge-warning">{{ 'Revisi' }}</span>
                                                                    @elseif($item->status_kajur == 4)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Selesai Revisi' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="btn-group mr-1 mb-1">
                                                                        <button type="button"
                                                                            class="btn btn-info btn-sm dropdown-toggle"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">
                                                                            @can('laporan_show')
                                                                                <a href="#mymodal"
                                                                                    data-remote="{{ route('backsite.laporan.show', $item->id) }}"
                                                                                    data-toggle="modal" data-target="#mymodal"
                                                                                    data-title="Laporan Detail"
                                                                                    class="dropdown-item">
                                                                                    Show
                                                                                </a>
                                                                            @endcan
                                                                            @can('laporan_edit')
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('backsite.laporan.revisi', $item->id) }}">
                                                                                    Edit
                                                                                </a>
                                                                            @endcan
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Dosen</th>
                                                            <th>Kelas</th>
                                                            <th>Dokumen</th>
                                                            <th>Kaprodi</th>
                                                            <th>Kajur</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endcan
            @can('laporan_kajur_table')
                <div class="content-body">
                    <section id="table-home">
                        <!-- Zero configuration table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Laporan List</h4>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">

                                            <div class="table-responsive">
                                                <table
                                                    class="table table-striped table-bordered text-inputs-searching default-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Dosen</th>
                                                            <th>Kelas</th>
                                                            <th>Dokumen</th>
                                                            <th>Kaprodi</th>
                                                            <th>Kajur</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($results as $item)
                                                            <tr data-entry-id="{{ $item->id }}">
                                                                <td>{{ isset($item->created_at) ? date('d/m/Y H:i:s', strtotime($item->created_at)) : '' }}
                                                                </td>
                                                                <td>{{ $item->dosen_name }}</td>
                                                                <td>{{ $item->kelas_name }}</td>
                                                                <td><a href="{{ route('backsite.laporan.pdf', $item->id) }}"
                                                                        class="text-bold" target="_blank">Print PDF</a>
                                                                </td>
                                                                <td>
                                                                    @if ($item->status_kaprodi == 1)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Validasi Diterima' }}</span>
                                                                    @elseif($item->status_kaprodi == 2)
                                                                        <span
                                                                            class="badge badge-info">{{ 'Menunggu Validasi' }}</span>
                                                                    @elseif($item->status_kaprodi == 3)
                                                                        <span
                                                                            class="badge badge-warning">{{ 'Revisi' }}</span>
                                                                    @elseif($item->status_kaprodi == 4)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Selesai Revisi' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->status_kajur == 1)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Validasi Diterima' }}</span>
                                                                    @elseif($item->status_kajur == 2)
                                                                        <span
                                                                            class="badge badge-info">{{ 'Menunggu Validasi' }}</span>
                                                                    @elseif($item->status_kajur == 3)
                                                                        <span
                                                                            class="badge badge-warning">{{ 'Revisi' }}</span>
                                                                    @elseif($item->status_kajur == 4)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Selesai Revisi' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="btn-group mr-1 mb-1">
                                                                        <button type="button"
                                                                            class="btn btn-info btn-sm dropdown-toggle"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">
                                                                            @can('laporan_show')
                                                                                <a href="#mymodal"
                                                                                    data-remote="{{ route('backsite.laporan.show', $item->id) }}"
                                                                                    data-toggle="modal" data-target="#mymodal"
                                                                                    data-title="Laporan Detail"
                                                                                    class="dropdown-item">
                                                                                    Show
                                                                                </a>
                                                                            @endcan
                                                                            @can('laporan_edit_kaprodi')
                                                                                <form
                                                                                    action="{{ route('backsite.laporan.status_kaprodi', $item->id) }}"
                                                                                    method="POST">
                                                                                    @method('PUT')
                                                                                    @csrf
                                                                                    <input type="hidden" name="_token"
                                                                                        value="{{ csrf_token() }}">
                                                                                    <input type="submit" name="pilihan"
                                                                                        class="dropdown-item" value="Terima">
                                                                                </form>
                                                                            @endcan
                                                                            @can('laporan_edit_kaprodi')
                                                                                <form
                                                                                    action="{{ route('backsite.laporan.status_kaprodi', $item->id) }}"
                                                                                    method="POST">
                                                                                    @method('PUT')
                                                                                    @csrf
                                                                                    <input type="hidden" name="_token"
                                                                                        value="{{ csrf_token() }}">
                                                                                    <input type="submit" name="pilihan"
                                                                                        class="dropdown-item" value="Revisi">
                                                                                </form>
                                                                            @endcan
                                                                            @if($item->status_kaprodi == 1)
                                                                            @can('laporan_edit_kajur')
                                                                                <form
                                                                                    action="{{ route('backsite.laporan.status_kajur', $item->id) }}"
                                                                                    method="POST">
                                                                                    @method('PUT')
                                                                                    @csrf
                                                                                    <input type="hidden" name="_token"
                                                                                        value="{{ csrf_token() }}">
                                                                                    <input type="submit" name="pilihan"
                                                                                        class="dropdown-item" value="Terima">
                                                                                </form>
                                                                            @endcan
                                                                            @can('laporan_edit_kajur')
                                                                                <form
                                                                                    action="{{ route('backsite.laporan.status_kajur', $item->id) }}"
                                                                                    method="POST">
                                                                                    @method('PUT')
                                                                                    @csrf
                                                                                    <input type="hidden" name="_token"
                                                                                        value="{{ csrf_token() }}">
                                                                                    <input type="submit" name="pilihan"
                                                                                        class="dropdown-item" value="Revisi">
                                                                                </form>
                                                                            @endcan
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Dosen</th>
                                                            <th>Kelas</th>
                                                            <th>Dokumen</th>
                                                            <th>Kaprodi</th>
                                                            <th>Kajur</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endcan
            @can('laporan_wadir_table')
                <div class="content-body">
                    <section id="table-home">
                        <!-- Zero configuration table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Laporan List</h4>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">

                                            <div class="table-responsive">
                                                <table
                                                    class="table table-striped table-bordered text-inputs-searching default-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Dosen</th>
                                                            <th>Kelas</th>
                                                            <th>Dokumen</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($results as $item)
                                                            <tr data-entry-id="{{ $item->id }}">
                                                                <td>{{ isset($item->created_at) ? date('d/m/Y H:i:s', strtotime($item->created_at)) : '' }}
                                                                </td>
                                                                <td>{{ $item->dosen_name }}</td>
                                                                <td>{{ $item->kelas_name }}</td>
                                                                <td><a href="{{ route('backsite.laporan.pdf', $item->id) }}"
                                                                        class="text-bold" target="_blank">Print PDF</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Dosen</th>
                                                            <th>Kelas</th>
                                                            <th>Dokumen</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endcan
            
        </div>
    </div>
    <!-- END: Content-->

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css') }}">

    <style>
        .label {
            cursor: pointer;
        }

        .img-container img {
            max-width: 100%;
        }
    </style>
@endpush

@push('after-script')
    {{-- Inputmask --}}
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/inputmask.js') }}"></script>
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/bindings/inputmask.binding.js') }}"></script>

    {{-- Fancybox --}}
    <script src="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js') }}" type="text/javascript">
    </script>

    {{-- Custom JS --}}
    <script>
        // Modal
        jQuery(document).ready(function($) {
            $('#mymodal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });

            // Selector
            $('.select-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2-full-bg')
                $select2.find('option').prop('selected', 'selected')
                $select2.trigger('change')
            })

            $('.deselect-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2-full-bg')
                $select2.find('option').prop('selected', '')
                $select2.trigger('change')
            })
        });

        // Datatable
        $('.default-table').DataTable({
            "order": [],
            "paging": true,
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
            "pageLength": 10,
        });

        // Inputmask
        $(function() {
            $(":input").inputmask();
        });

        // Fancybox
        Fancybox.bind('[data-fancybox="gallery"]', {
            infinite: false
        });

        // Input dinamis
        var i = 0;
        $(document).ready(function() {
            $('#addButton').click(function(e) {
                e.preventDefault();
                ++i;
                $('.form-body').append(
                    `<div class="col">
                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="agenda">Agenda <code
                                style="color:red;">required</code></label>
                            <div class="col-md-9 mx-auto">
                                <input type="text" id="agenda" name="agenda[]"
                                    class="form-control" value="{{ old('agenda.0') }}"
                                    autocomplete="off" placeholder="example Kegiatan Seminar Kelas">

                                    @if ($errors->has('agenda'))
                                        <p style="font-style: bold; color: red;">
                                        {{ $errors->first('agenda') }}</p>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="deskripsi">Deskripsi <code
                                style="color:red;">required</code></label>
                            <div class="col-md-9 mx-auto">
                                <input type="text" id="deskripsi" name="deskripsi[]"
                                    class="form-control" value="{{ old('deskripsi.0') }}"
                                    autocomplete="off"
                                    placeholder="example Seminar tentang pentingnya belajar pemrograman bagi generasi z">

                                    @if ($errors->has('deskripsi'))
                                        <p style="font-style: bold; color: red;">
                                        {{ $errors->first('deskripsi') }}</p>
                                    @endif
                            </div>
                        </div>                            

                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="tindakan">Tindakan <code
                                style="color:red;">required</code></label>
                            <div class="col-md-9 mx-auto">
                                <input type="text" id="tindakan" name="tindakan[]"
                                    class="form-control" value="{{ old('tindakan.0') }}"
                                    autocomplete="off"
                                    placeholder="example Berjalan sesuai dengan apa yang telah direncanakan">

                                    @if ($errors->has('tindakan'))
                                        <p style="font-style: bold; color: red;">
                                        {{ $errors->first('tindakan') }}</p>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="lampiran">Lampiran <code
                                    style="color:green;">optional</code></label>
                            <div class="col-md-9 mx-auto">
                                <div class="custom-file">
                                    <input type="file"
                                        accept="image/png, image/svg, image/jpeg"
                                        class="custom-file-input"  id="lampiran"
                                        name="lampiran[]" value="{{ old('lampiran.0') }}">
                                    <label class="custom-file-label" for="lampiran"
                                        aria-describedby="lampiran">Choose File</label>
                                </div>

                                <p class="text-muted"><small class="text-danger">Hanya dapat
                                        mengunggah 1 file</small><small> dan yang dapat digunakan
                                        JPEG, SVG, PNG & Maksimal ukuran file hanya 10
                                        MegaBytes</small></p>

                                @if ($errors->has('lampiran'))
                                    <p style="font-style: bold; color: red;">
                                        {{ $errors->first('lampiran') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9 mx-auto">
                                <div class="row mx-auto justify-content-end">
                                    <button class="btn btn-danger"
                                        id="removeButton">
                                        <i class="la la-plus-square-o"></i> Hapus Agenda
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>`
                );
            });
            $(document).on('click', '#removeButton', function(e) {
                e.preventDefault();
                $(this).parents('.col').remove();
            });
        });
    </script>

    {{-- Modal --}}
    <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="btn close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fa fa-spinner fa spin"></i>
                </div>
            </div>
        </div>
    </div>
@endpush
