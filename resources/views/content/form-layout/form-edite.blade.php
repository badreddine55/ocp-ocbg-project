@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Op')

@section('content')
@if (isset($error))
    <div class="alert alert-danger alert-dismissible">
        <h5>{{ $error }}</h5>
    </div>
@endif
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Edit/</span>op</h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic with Icons -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit OCBG</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('update-ocbg', $ocbg->id) }}"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="numero">Numéro Op</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="numero_OP" name="numero_OP" value="{{ $ocbg->numero_OP }}" aria-label="OP-001" aria-describedby="basic-icon-default-fullname2" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="section">section</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="section" name="section">
                                <option value="{{ $ocbg->section }}">{{ $ocbg->section }}</option>
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
                            <label class="col-sm-2 col-form-label" for="numero">Date Regèlement</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                <input type="date" class="form-control" id="Date_regèlement"   value="{{ $ocbg->Date_regèlement }}" name="Date_regèlement" placeholder="Enter Date Reglement" />

                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="numero">libelle</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="libelle" value="{{ $ocbg->libelle }}" name="libelle" placeholder="Enter libelle" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="numero">montant</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="montant" value="{{ $ocbg->montant }}" name="montant" placeholder="Enter montant" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">justification</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="exampleFormControlSelect1" name="justification"
                                    aria-label="Default select example">
                                    <option value="{{ $ocbg->justification }}">{{ $ocbg->justification }}</option>
                                    <option value="non">non</option>
                                    <option value="oui">oui</option>
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
                                <button type="submit" class="btn btn-success">Modifier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection


