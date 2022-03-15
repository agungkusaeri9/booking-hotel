@extends('user.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h1 class="display-4 mb-3">{{ $item->name }}</h1>
                    <img src="{{ $item->image() }}"  alt="{{ $item->name }}" class="img-fluid w-100">
                    <h4 class="mt-3">Rp {{ number_format($item->price->price) }}/<span class="small">Hari</span></h4>
                    <p class="card-text">{{ $item->description }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Form Pemesanan</h5>
                    <form action="{{ route('transaction.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                        <div class="form-row mb-2">
                            <div class="col-3">
                                <label for="">Nama</label> 
                            </div>
                            <div class="col-9">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                            </div>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-row mb-2">
                            <div class="col-3">
                                <label for="">Jenis Kelamin</label>
                            </div>
                            <div class="col-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="laki-laki" value="laki-laki" name="gender" checked>
                                    <label class="form-check-label" for="laki-laki">Laki-laki</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="perempuan" value="perempuan" name="gender">
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-2">
                            <div class="col-3">
                                <label for="">NIK</label> 
                            </div>
                            <div class="col-9">
                                <input type="number" name="nik" class="form-control @error('nik') is-invalid @enderror">
                            </div>
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-row mb-2">
                            <div class="col-3">
                                <label for="">Durasi/Hari</label> 
                            </div>
                            <div class="col-9">
                                <input type="number" name="duration" class="form-control @error('duration') is-invalid @enderror">
                            </div>
                            @error('duration')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-row mb-2">
                            <div class="col-4">
                                <label for="">Breakfast</label> 
                            </div>
                            <div class="col-8">
                                <input class="form-check-input" type="checkbox" id="is_breakfast" value="1" name="is_breakfast">
                                <label class="form-check-label" for="is_breakfast">Ya</label>
                            </div>
                            @error('is_breakfast')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-row mb-2">
                            <div class="col-3">
                                <label for="">Pembayaran</label> 
                            </div>
                            <div class="col-9">
                                <select name="payment_id" id="payment_id" class="form-control @error('payment_id') is-invalid @enderror">
                                    <option value="" selected disabled>-- Pilih Pembayaran --</option>
                                    @foreach ($payments as $payment)
                                        <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('payment_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-row mb-2">
                            <div class="col-3">
                                <label for="">Tanggal</label> 
                            </div>
                            <div class="col-9">
                                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror">
                            </div>
                            @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <button class="float-right btn btn-primary">Checkout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection