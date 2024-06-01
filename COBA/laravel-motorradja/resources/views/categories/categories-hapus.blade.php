@extends('layouts.app')

@section('title')
Hapus Category | Radja Admin
@endsection

@section('content')
<h3>Hapus Categories</h3>
<div class="form-login">
  <h4>Ingin Menghapus Data ?</h4>
  <a href="{{ url('/category/destroy/' . $category->id_categories ) }}" class="btn btn-simpan" style="width: 40%; margin: 20px auto;">
    Yes
  </a>
  <a href="{{ url('/category') }}" class="btn btn-simpan" style="width: 40%; margin: 20px auto;">
    No
  </a>
</div>
@endsection
