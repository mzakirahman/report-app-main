@extends('layouts.app')

{{-- set title --}}
@section('title', 'Chat')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Chat</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Chat</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- add card --}}
            @can('chat_create')
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

                                            <form class="form form-horizontal" action="{{ route('backsite.chat.store') }}"
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
                                                        <label class="col-md-3 label-control" for="deskripsi">Deskripsi <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="deskripsi" name="deskripsi"
                                                                class="form-control" value="{{ old('deskripsi') }}"
                                                                autocomplete="off"
                                                                placeholder="example Seminar tentang pentingnya belajar pemrograman bagi generasi z">

                                                            @if ($errors->has('deskripsi'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('deskripsi') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    @can('chat_pesan')
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="pesan">Pesan <code
                                                                    style="color:red;">required</code></label>
                                                            <div class="col-md-9 mx-auto">
                                                                <textarea id="pesan" name="pesan" value="{{ old('pesan') }}" autocomplete="off" class="form-control"></textarea>

                                                                @if ($errors->has('pesan'))
                                                                    <p style="font-style: bold; color: red;">
                                                                        {{ $errors->first('pesan') }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endcan

                                                    @can('chat_balasan')
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="balasan">Balasan <code
                                                                    style="color:red;">required</code></label>
                                                            <div class="col-md-9 mx-auto">
                                                                <textarea id="balasan" name="balasan" value="{{ old('balasan') }}" class="form-control" autocomplete="off"></textarea>

                                                                @if ($errors->has('balasan'))
                                                                    <p style="font-style: bold; color: red;">
                                                                        {{ $errors->first('balasan') }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endcan

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
            @can('chat_table')
                <div class="content-body">
                    <section id="table-home">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Chat List</h4>
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
                                                            <th>Nama</th>
                                                            <th>Kelas</th>
                                                            <th>Dosen</th>
                                                            <th>Pesan</th>
                                                            <th>Balasan</th>
                                                            <th>Status</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($chat as $item)
                                                            <tr data-entry-id="{{ $item->id }}">
                                                                <td>{{ isset($item->created_at) ? date('d/m/Y H:i:s', strtotime($item->created_at)) : '' }}
                                                                </td>
                                                                <td>{{ $item->user->name ?? '' }}</td>
                                                                <td>{{ $item->kelas->name ?? '' }}</td>
                                                                <td>{{ $item->dosen->name ?? '' }}</td>
                                                                <td>{{ $item->pesan ?? '' }}</td>
                                                                <td>{{ $item->balasan ?? '' }}</td>
                                                                <td>
                                                                    @if ($item->status == 1)
                                                                        <span
                                                                            class="badge badge-warning">{{ 'Menunggu Balasan' }}</span>
                                                                    @elseif($item->status == 2)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Sudah Dibalas' }}</span>
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
                                                                            @can('chat_show')
                                                                                <a href="#mymodal"
                                                                                    data-remote="{{ route('backsite.chat.show', $item->id) }}"
                                                                                    data-toggle="modal" data-target="#mymodal"
                                                                                    data-title="Chat Detail"
                                                                                    class="dropdown-item">
                                                                                    Show
                                                                                </a>
                                                                            @endcan
                                                                            @can('chat_edit')
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('backsite.chat.edit', $item->id) }}">
                                                                                    Balas
                                                                                </a>
                                                                            @endcan
                                                                            @can('chat_delete')
                                                                                <form
                                                                                    action="{{ route('backsite.chat.destroy', $item->id) }}"
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
                                                            <th>Nama</th>
                                                            <th>Kelas</th>
                                                            <th>Dosen</th>
                                                            <th>Pesan</th>
                                                            <th>Balasan</th>
                                                            <th>Status</th>
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
