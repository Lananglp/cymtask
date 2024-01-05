@extends('layouts.sidebar')

@section('content')

<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <form action="/toko/search" class="row" method="post">
        <div class="col-lg-6 mb-2">
            <input type="search" name="toko_search" class="form-control" placeholder="Cari produk disini. . .">
        </div>
        <div class="col-lg-6 mb-2">
            <select name="toko_filter" class="form-select">
                <option value="">Pilih Kategori</option>
            </select>
        </div>
        <button type="submit" class="d-none"></button>
    </form>

    <div class="row mt-3">
        <div class="col-lg-3">
            <div class="rounded-3 shadow-sm border">
                <img src="/img/mie_goreng.jpg" alt="" class="rounded-top-3 img-fluid">
                <div class="p-2">
                    <h2 class="fw-semibold fs-6">Mie Goreng + Telor + Sayur</h2>
                    <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere atque at aliquid alias in sed perspiciatis quae.</p>
                    <div class="d-flex align-items-center">
                        <a href="/toko/show" class="btn btn-sm btn-dark py-0 me-1"><i class="fa fa-fw fa-sm fa-eye"></i> Detail</a>
                        <form action="/toko/beli" method="post">
                            <button class="btn btn-sm btn-primary py-0 me-1"><i class="fa fa-fw fa-sm fa-cart-shopping"></i> Beli</button>
                        </form>
                        <form action="/toko/like" method="post">
                            <button class="btn btn-sm btn-danger py-0 me-1"><i class="fa fa-fw fa-sm fa-heart"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="rounded-3 shadow-sm border">
                <img src="/img/nasi_goreng.jpg" alt="" class="rounded-top-3 img-fluid">
                <div class="p-2">
                    <h2 class="fw-semibold fs-6">Nasi Goreng Special</h2>
                    <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere atque at aliquid alias in sed perspiciatis quae.</p>
                    <div class="d-flex align-items-center">
                        <a href="/toko/show" class="btn btn-sm btn-dark py-0 me-1"><i class="fa fa-fw fa-sm fa-eye"></i> Detail</a>
                        <form action="/toko/beli" method="post">
                            <button class="btn btn-sm btn-primary py-0 me-1"><i class="fa fa-fw fa-sm fa-cart-shopping"></i> Beli</button>
                        </form>
                        <form action="/toko/like" method="post">
                            <button class="btn btn-sm btn-danger py-0 me-1"><i class="fa fa-fw fa-sm fa-heart"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection