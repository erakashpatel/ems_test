@extends('layout')
@section('content')

</style>
<div class="align-items-center d-flex justify-content-md-center align-items-center vh-100">
		<div class="card">
		<div class="card-body detailForm">
			<form action="{{ route('import.process') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<input type="file" name="csv_file" required>
			<button type="submit" class="btn btn-primary">Import</button>
			</form>
		</div>
	</div>
</div>
@endsection
@section('styles')
<style>
	.card{
		align-items: center;
    width: 50%;
    margin: auto;
	}
</style>
@endsection