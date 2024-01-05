@extends('layouts.sidebar')

@section('content')

<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <div class="row">
        <div class="col-lg-6">
            <div class="d-flex justify-content-center">
                <img src="/img/hp.jpg" alt="" class="rounded-3 img-fluid ratio ratio-16x9">
            </div>
            <div class="row row-cols-6 mt-2">
                <div class="col">
                    <img src="/img/hp.jpg" alt="" class="rounded-3 img-fluid">
                </div>
                <div class="col">
                    <img src="/img/hp.jpg" alt="" class="rounded-3 img-fluid">
                </div>
                <div class="col">
                    <img src="/img/hp.jpg" alt="" class="rounded-3 img-fluid">
                </div>
                <div class="col">
                    <img src="/img/hp.jpg" alt="" class="rounded-3 img-fluid">
                </div>
                <div class="col">
                    <img src="/img/hp.jpg" alt="" class="rounded-3 img-fluid">
                </div>
                <div class="col">
                    <img src="/img/hp.jpg" alt="" class="rounded-3 img-fluid">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <p class="mb-0 text-primary">Nama Produk :</p>
            <h1 class="fs-4 fw-semibold">Apple iPhone 13 128GB Garansi Resmi INDONESIA</h1>
            <p class="mb-0 text-primary">Harga :</p>
            <p class="d-inline-block fw-semibold mt-1 fs-6 bg-primary text-white rounded-3 px-2 py-1"><i class="fa fa-fw fa-dollar"></i> Rp. 8.199.000,00</p>
            <p class="mb-0 text-primary">Toko :</p>
            <p class="fs-6">Official Apple Store Bali <i class="fa fa-fw fa-circle-check text-primary"></i></p>
            <p class="mb-0 text-primary">Kuantitas :</p>
            <div class="d-flex align-items-center mt-1">
                <table class="mb-0 table table-sm table-borderless w-25">
                    <tbody>
                        <tr class="align-middle text-center">
                            <td class="p-0"><div class="border rounded-start"><button class="btn btn-sm bg-none border-0 w-100 p-0"><i class="fa fa-sm fa-chevron-left"></i></button></div></td>
                            <td class="py-0 border">1</td>
                            <td class="p-0"><div class="border rounded-end"><button class="btn btn-sm bg-none border-0 w-100 p-0"><i class="fa fa-sm fa-chevron-right"></i></button></div></td>
                        </tr>
                    </tbody>
                </table>
                <p class="mb-0 ms-2">1.283 Items</p>
            </div>

            <div class="mt-3 mb-2">
                <a href="#" class="btn btn-sm border-0 px-3 btn-primary rounded-3"><i class="fa fa-fw fa-cart-shopping"></i> Beli</a>
                <button class="btn btn-sm border-0 px-3 btn-danger rounded-3"><i class="fa fa-fw fa-heart"></i> Like</button>
                <a href="#" class="btn btn-sm border-0 px-3 btn-dark rounded-3"><i class="fa fa-fw fa-flag"></i> Laporkan</a>
            </div>

            <p class="mb-0 text-secondary fs-6">1.587 Terjual</p>

            <div class="row gx-0 row-cols-3 mt-2">
                <div class="col px-1 p-3 text-primary">
                    <div class="d-flex flex-column justify-content-center align-items-center border rounded py-2">
                        <i class="fa fa-fw fa-shield fs-3"></i>
                        <p class="mb-0 fw-semibold mt-2">Garansi 12 Bulan</p>
                    </div>
                </div>
                <div class="col px-1 p-3 text-primary">
                    <div class="d-flex flex-column justify-content-center align-items-center border rounded py-2">
                        <i class="fa fa-fw fa-shield fs-3"></i>
                        <p class="mb-0 fw-semibold mt-2">100% Original</p>
                    </div>
                </div>
                <div class="col px-1 p-3 text-primary">
                    <div class="d-flex flex-column justify-content-center align-items-center border rounded py-2">
                        <i class="fa fa-fw fa-shield fs-3"></i>
                        <p class="mb-0 fw-semibold mt-2">Gratis Ongkir</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <p class="mt-4 border-bottom fw-semibold pb-2">Spesifikasi Produk</p>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="text-secondary py-0">Kategori</td>
                            <td class="py-0">:</td>
                            <td class="w-75 py-0">Elektronik</td>
                        </tr>
                        <tr>
                            <td class="text-secondary py-0">Merk</td>
                            <td class="py-0">:</td>
                            <td class="w-75 py-0">Apple</td>
                        </tr>
                        <tr>
                            <td class="text-secondary py-0">Penyimpanan</td>
                            <td class="py-0">:</td>
                            <td class="w-75 py-0">128 GB</td>
                        </tr>
                        <tr>
                            <td class="text-secondary py-0">Chipset</td>
                            <td class="py-0">:</td>
                            <td class="w-75 py-0">Apple Bionic 16</td>
                        </tr>
                        <tr>
                            <td class="text-secondary py-0">Chipset</td>
                            <td class="py-0">:</td>
                            <td class="w-75 py-0">Apple Bionic 16</td>
                        </tr>
                        <tr>
                            <td class="text-secondary py-0">Berat</td>
                            <td class="py-0">:</td>
                            <td class="w-75 py-0">12 kg</td>
                        </tr>
                        <tr>
                            <td class="text-secondary py-0">Dikirim Dari</td>
                            <td class="py-0">:</td>
                            <td class="w-75 py-0">Denpasar, Bali</td>
                        </tr>
                        <tr>
                            <td class="text-secondary py-0">Disukai</td>
                            <td class="py-0">:</td>
                            <td class="w-75 py-0">12.284 Like</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <p class="mt-4 border-bottom fw-semibold pb-2">Deskripsi Produk</p>

            <p class="mb-0">Ukuran layar: 6.1 inci, 1170 x 2532 pixels, Super Retina XDR OLED, HDR10, Dolby Vision, 800 nits (HBM), 1200 nits (peak)
                Memori: RAM 6 GB, ROM 128 GB / 256 GB / 512 GB / 1 TB
                Sistem operasi: iOS 15
                CPU: Apple A15 Bionic (5 nm), Hexa-core (2x3.22 GHz Avalanche + 4xX.X GHz Blizzard)
                GPU: Apple GPU (4-core graphics)
                Kamera: 12 MP, f/1.6, 26mm (wide), 1.7µm, dual pixel PDAF, sensor-shift OIS, 12 MP, f/2.4, 120˚, 13mm (ultrawide). Depan 12 MP, f/2.2, 23mm (wide), 1/3.6"
                SIM: Nano-SIM/eSIM
                Baterai: Li-Ion 3240 mAh
                Dimensi: 146.7 x 71.5 x 7.65 mm
                Berat: 174 gr
                Garansi Resmi</p>
        </div>
    </div>
</div>
@endsection