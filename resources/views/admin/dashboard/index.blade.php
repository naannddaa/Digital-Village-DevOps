@extends('admin.layout.main')
@section('title', 'Dashboard')
@section('content')

<section class="section">
  <div class="section-header d-flex justify-content-between align-items-center">
    <h1>Dashboard</h1>
    <div class="text end">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-tasks"></i> {{-- 🔹 Total Sortir --}}
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Sortir</h4>
          </div>
          <div class="card-body" id="totalSortir">
            88
          </div>
        </div>
      </div>
    </div>

    {{-- GRADE A (Hijau) --}}
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-apple-alt"></i> {{-- 🍅 Grade A --}}
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>A</h4>
          </div>
          <div class="card-body" id="totalA">
           89
          </div>
        </div>
      </div>
    </div>

    {{-- GRADE B (Kuning) --}}
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="fas fa-apple-alt"></i> {{-- 🌱 Grade B --}}
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>B</h4>
          </div>
          <div class="card-body" id="totalB">
            90
          </div>
        </div>
      </div>
    </div>

    {{-- GRADE C (Merah) --}}
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="fas fa-apple-alt"></i> {{-- 🍃 Grade C --}}
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>C</h4>
          </div>
          <div class="card-body" id="totalC">
            87
          </div>
        </div>
      </div>
    </div>                  
  </div>

@endsection