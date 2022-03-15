@extends('user.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title mb-3 text-center">
                        Panduan Pembayaran
                    </h5>
                    <p class="card-text text-center small">Silahkan transfer dengan nominal berikut</p>
                    <h1 class="display-4 text-center mt-2 mb-2 font-weight-bold" style="font-size: 28px">Rp {{ number_format($item->transaction_total) }}</h1>
                </div>
            </div>
            <div class="card shadow mt-3">
                <div class="card-body px-3">
                    <div class="card-title text-center">
                        Transfer ke rekening a/n <span class="font-weight-bold">{{ $item->payment->description }}</span>
                    </div>
                    <h5 class="text-center my-4">{{ $item->payment->name }}</h5>
                    <h3 class="text-center">{{ $item->payment->number }}</h3>
                    <p class="card-text small text-center mt-4">Segera lakukan pembayaran sesuai nominal diatas</p>
                </div>
            </div>
            <div class="card shadow mt-3 mb-2">
                <div class="card-body px-3 text-center">
                    <div class="card-title text-center">
                        Sudah Melakukan Pembayaran?
                    </div>
                    <p class="card-text small text-center mt-4">Silahkan klik konfirmasi pembayaran</p>

                    <form action="{{ route('transaction.confirm',$item->id) }}" method="post">
                        @csrf
                        <button class="text-center btn btn-primary mt-4">Konfirmasi Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection