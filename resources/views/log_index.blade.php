@extends('sbadmin')
@section('content')



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Log</h3>
        </div>
   
      </div>

<div class="card-body">
<table class="table table-striped table-bordered" id="myTable">
  <thead>
<tr>
  <th style="text-align: center; vertical-align: middle;">ID</th>
  <th style="text-align: center; vertical-align: middle;">User</th>
  <th style="text-align: center; vertical-align: middle;">Role</th>
  <th style="text-align: center; vertical-align: middle;">Activity</th>
  <th style="text-align: center; vertical-align: middle;">Timestamp</th>
</tr>
</thead>
@if(count($logM) > 0)
@foreach ($logM as $log)

<tr>
                        <td style="text-align: center; vertical-align: middle;">{{ $log->id }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $log->name }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $log->role }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $log->activity }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $log->created_at }}</td>
    </form>
</tr>
@endforeach
@else
<tr>
  <td colspan="4" style="text-align: center; vertical-align: middle;">Data Tidak Ditemukan</td> 
</tr>
@endif
       </table>
    </div>

    <script type= "text/javascript">
      let table = new DataTable('#myTable');
  </script>

  </section>
  <!-- /.content -->
@endsection