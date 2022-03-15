@extends('user.layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title mb-3 text-center">Tentang Kami</h5>
                    <img src="{{ $setting->logo() }}" alt="" class="img-fluid w-100">
                    <div class="table-responsive">
                        <table class="table table-borderless mt-4">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $setting->name }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $setting->address }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Hp</th>
                                <td>{{ $setting->phone_number }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $setting->email }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $setting->description }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection