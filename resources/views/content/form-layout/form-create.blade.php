@extends('layouts.contentNavbarLayout')

@section('title', ' Créer Nouvelle Op')

@section('content')
@if (isset($error))
    <div class="alert alert-danger alert-dismissible">
        <h5>{{ $error }}</h5>
    </div>
@endif



    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Créer/</span>nouvelle</h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic with Icons -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Créer nouvelle OCBG </h5>
                </div>
                <div class="card-body">
                <form method="post" action="{{ route('créer.store') }}" enctype="multipart/form-data">

                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="numero">Numéro OP *</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="numero_OP" name="numero_OP" placeholder="Enter Numéro OP"  required/>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="section">section *</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="section" name="section">
                                    <option value="Athlétisme">Athlétisme</option>
                                    <option value="karaté">karaté</option>
                                    <option value="Gymnastique">Gymnastique</option>
                                    <option value="Natation">Natation</option>
                                    <option value="Halteroptrit">Halteroptrit</option>
                                    <option value="Cyclisme">Cyclisme</option>
                                    <option value="Petanque">Petanque</option>
                                    <option value="Tennis">Tennis</option>
                                    <option value="Tir au vol">Tir au vol</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="numero">Date Regèlement *</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input type="Date" class="form-control" id="Date_regèlement" name="Date_regèlement" placeholder="Enter Date Regèlement" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="numero">libelle</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="libelle" name="libelle" placeholder="Enter libelle" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="numero">montant *</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="montant" name="montant" placeholder="Enter montant" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="justification">Justification</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="justification" name="justification">
                                    <option value="non">Non</option>
                                    <option value="oui">Oui</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="pdf_file">PDF File</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="pdf_file" name="pdf_file" accept=".pdf">
                                <small class="text-muted">Max file size: 2MB</small>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success">créer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
