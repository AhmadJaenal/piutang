@extends('admin.master')
@section('content') <br><br><br>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Mitra</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('listPartners')}}">List Daftar Mitra</a></li>
                        <li class="breadcrumb-item active">Tambah Mitra</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content"> 
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <div class="card">
                            <form action="{{ route('storePartners') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="profile_partner" class="font-weight-bold">Foto Profil</label>
                                    <input id="profile_partner" type="file" class="form-control @error('profile_partner') is-invalid @enderror" name="profile_partner">
                                </div>
                                <div class="form-group">
                                    <label for="partner_name">Nama Mitra</label>
                                    <input type="text" name="partner_name" id="partner_name" class="form-control" required placeholder="Enter partner name">
                                </div>
                                <input type="hidden" name="name" id="name" value="Partner">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required placeholder="Enter email" autocomplete="email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required placeholder="Enter password" autocomplete="current-password">
                                </div>
                                <!-- Mengubah field role menjadi hidden dan otomatis mengisi "Partner" -->
                                <input type="hidden" name="userType" id="userType" value="partner">

                                <div class="form-group">
                                    <label for="npwp">NPWP</label>
                                    <input type="text" name="npwp" id="npwp" class="form-control" required placeholder="Enter npwp">
                                </div>
                                <div class="form-group">
                                    <label for="pic_name">Nama PIC</label>
                                    <input type="text" name="pic_name" id="pic_name" class="form-control" required placeholder="Enter pic name">
                                </div>
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <input type="text" name="address" id="address" class="form-control" required placeholder="Enter address">
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('listPartners') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
