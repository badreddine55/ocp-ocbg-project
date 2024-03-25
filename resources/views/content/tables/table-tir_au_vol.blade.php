@extends('layouts/contentNavbarLayout')

@section('title', 'Tableau - Tout- OP')

@section('content')
    <style>
        .libelle-tooltip .truncated-text {
            max-width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .libelle-tooltip:hover .truncated-text {
            max-width: none;
            overflow: visible;
            white-space: normal;
            word-wrap: break-word;
        }
    </style>

    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Tableau /</span> Tir au vol
    </h4>

    <div class="card">
        <h5 class="card-header">Tableau Tir au vol OCBG</h5>
        <div class="table-responsive">
            <div class="row mb-3">

                <div class="row">
                    <div class="col-md-7">

                    </div>
                    <div class="col-md-3">
                        <input type="number" id="filterYear" name="filterYear" class="form-control" min="1900" max="2100"
                            placeholder="Enter Year">
                    </div>
                    <div class="col-md-2">
                        <button id="filterBtn" class="btn btn-success">Filter</button>
                    </div>
                </div>
            </div>
            

            <table class="table">
                <thead>
                    <tr>
                        <th>Numero OP</th>
                        <th>section</th>
                        <th>Date Regèlement</th>
                        <th>libelle</th>
                        <th>montant</th>
                        <th>justification</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalOperations = count($ocbg);
                        $totalMontant = 0;
                    @endphp
                    @forelse ($ocbg as $op)
                        @php
                            $totalMontant += $op->montant;
                        @endphp
                        <tr>
                            <td><span class="fw-medium">{{ $op->numero_OP }}</span></td>
                            <td>
                                <div class="libelle-tooltip" title="{{ $op->section }}">
                                    <span class="truncated-text"
                                        style="max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $op->section }}</span>
                                </div>
                            </td>
                            <td><span class="fw-medium">{{ $op->Date_regèlement }}</span></td>
                            <td><span class="fw-medium">{{ $op->libelle }}</span></td>
                            <td>
                                <span class="fw-medium">{{ $op->montant }}.00DH</span>
                            </td>
                            <td>
                                <span
                                    class="badge  {{ $op->justification == 'oui' ? 'bg-label-success' : 'bg-label-danger' }} me-1">
                                    {{ $op->justification }}
                                </span>
                            </td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a class="dropdown-item" href="{{ route('edit-op', $op->id) }}"><i class="bx bx-edit-alt"></i></a>
                                @if ($op->pdf_file_path)
                                    <a class="dropdown-item" href="{{ route('download-op-pdf', $op->id) }}"><i class="bx bx-download"></i></a>
                                @endif
                                <form method="post" action="{{ route('destroy-op', $op->id) }}" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item" style="border: none; background: none; cursor: pointer;">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No operations found.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Total Operations: {{ $totalOperations }}</th>
                        <th colspan="2">Total Montant: {{ $totalMontant }} DH</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('filterBtn').addEventListener('click', function() {
            var filterYear = document.getElementById('filterYear').value;
            window.location.href = "{{ route('filter-ocbg') }}?filterYear=" + filterYear;
        });
    </script>
@endsection
