@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Laporan')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Edit Laporan</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Laporan</li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- forms --}}
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="horizontal-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-basic">Form Input</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                        <div class="card-text">
                                            <p>Please complete the input <code>required</code>, before you click the submit
                                                button.</p>
                                        </div>
                                        <form class="form form-horizontal"
                                            action="{{ route('backsite.laporan.update', $laporan->id) }}"
                                            method="POST" enctype="multipart/form-data">

                                            @method('PUT')
                                            @csrf
                                            <div class="form-body">
                                                
                                                <h4 class="form-section"><i class="fa fa-edit"></i> Form Laporan</h4>
                                                @foreach ($laporanGroups as $created_at => $laporans)
                                                    <div
                                                        class="form-group row {{ $errors->has('dosen_id') ? 'has-error' : '' }}">
                                                        <label class="col-md-3 label-control">Nama Dosen <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="dosen_id" id="dosen_id"
                                                                class="form-control select2" required>
                                                                <option value="{{ '' }}" disabled selected>Choose
                                                                </option>
                                                                @foreach ($dosen as $key => $dosen_item)
                                                                    <option value="{{ $dosen_item->id }}"
                                                                        {{ $laporan->dosen_id == $dosen_item->id ? 'selected' : '' }}>
                                                                        {{ $dosen_item->name }}</option>
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
                                                            <select name="kelas_id" id="kelas_id"
                                                                class="form-control select2" required>
                                                                <option value="{{ '' }}" disabled selected>
                                                                    Choose
                                                                </option>
                                                                @foreach ($kelas as $key => $kelas_item)
                                                                    <option value="{{ $kelas_item->id }}"
                                                                        {{ $laporan->kelas_id == $kelas_item->id ? 'selected' : '' }}>
                                                                        {{ $kelas_item->name }}</option>
                                                                @endforeach
                                                            </select>

                                                            @if ($errors->has('kelas_id'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('kelas_id') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @foreach ($laporans as $item)
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="agenda">Agenda
                                                                <code style="color:red;">required</code></label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="agenda"
                                                                    name="agenda[{{ $loop->index }}]" class="form-control"
                                                                    placeholder="example 28731123411415"
                                                                    value="{{ old('agenda.' . $loop->index, $item->agenda) }}"
                                                                    autocomplete="off" required>

                                                                @if ($errors->has('agenda'))
                                                                    <p style="font-style: bold; color: red;">
                                                                        {{ $errors->first('agenda') }}</p>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="deskripsi">Deskripsi
                                                                <code style="color:red;">required</code></label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="deskripsi"
                                                                    name="deskripsi[{{ $loop->index }}]"
                                                                    class="form-control" placeholder="example Bengkalis"
                                                                    value="{{ old('deskripsi.' . $loop->index, $item->deskripsi) }}"
                                                                    autocomplete="off" required>

                                                                @if ($errors->has('deskripsi'))
                                                                    <p style="font-style: bold; color: red;">
                                                                        {{ $errors->first('deskripsi') }}</p>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="tindakan">Tindakan
                                                                <code style="color:red;">required</code></label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="tindakan"
                                                                    name="tindakan[{{ $loop->index }}]"
                                                                    class="form-control"
                                                                    value="{{ old('tindakan.' . $loop->index, $item->tindakan) }}"
                                                                    autocomplete="off"
                                                                    placeholder="example +628xxxxxxxxxx" required>

                                                                @if ($errors->has('tindakan'))
                                                                    <p style="font-style: bold; color: red;">
                                                                        {{ $errors->first('tindakan') }}</p>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="lampiran">Lampiran
                                                                <code style="color:green;">optional</code></label>
                                                            <div class="col-md-9 mx-auto">
                                                                <div class="custom-file">
                                                                    <input type="file"
                                                                        accept="image/png, image/svg, image/jpeg"
                                                                        class="custom-file-input" id="lampiran"
                                                                        name="lampiran[{{ $loop->index }}]"
                                                                        value="{{ old('lampiran.' . $loop->index, $item->lampiran) }}">
                                                                    <label class="custom-file-label" for="lampiran"
                                                                        aria-describedby="lampiran">Choose File</label>
                                                                </div>

                                                                <p class="text-muted"><small class="text-danger">Hanya
                                                                        dapat
                                                                        mengunggah 1 file</small><small> dan yang dapat
                                                                        digunakan
                                                                        JPEG, SVG, PNG & Maksimal ukuran file hanya 10
                                                                        MegaBytes</small></p>

                                                                @if ($errors->has('lampiran'))
                                                                    <p style="font-style: bold; color: red;">
                                                                        {{ $errors->first('lampiran') }}</p>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endforeach

                                            </div>

                                            <div class="form-actions text-right">
                                                <a href="{{ route('backsite.laporan.index') }}" style="width:120px;"
                                                    class="btn bg-blue-grey text-white mr-1"
                                                    onclick="return confirm('Are you sure want to close this page? , Any changes you make will not be saved.')">
                                                    <i class="ft-x"></i> Cancel
                                                </a>
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

        </div>
    </div>
    <!-- END: Content-->

@endsection


@push('after-script')
    {{-- inputmask --}}
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/inputmask.js') }}"></script>
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/bindings/inputmask.binding.js') }}"></script>

    <script>
        $(function() {
            $(":input").inputmask();
        });
    </script>
@endpush
