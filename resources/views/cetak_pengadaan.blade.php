<html>
    <head>
    <title>Atma Auto</title>
        <style>
            .mytable{
                border:1px solid black;
            }
            table,th,td{
                /* border:1px solid black;
                border-style:dashed; */
            }
            table {
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
        <!-- <div class="container">
            <div style="float:left; width:40%; padding:15px; margin:15px auto; text-align:right;">
                <img src="{{ asset('/images/Logo_Transparan.png') }}" alt="Logo_AA">
            </div>
            <div style="float:right; width:30%; padding:15px; margin: 15px 330px auto auto;">
                <h1 style="text-align:center;">ATMA AUTO</h1>
                <p style="text-align:center;">MOTORCYCLE SPAREPARTS AND SERVICES</p>
                <p style="text-align:center;">Jl. Babarsari No. 43 Yogyakarta 552181</p>
                <p style="text-align:center;">Telp. (0274) 487711</p>
                <p style="text-align:center;">http://atmauto.jasonfw.com/</p>
            </div>
        </div> -->
        <div style="border : 1px solid black;">
            <table style="margin:25px;">
                <tbody>
                    <tr>
                        <td rowspan="5" colspan="2" style="text-align:right;padding:3px">
                            <img src="{{ public_path('/images/Logo_Transparan.png') }}" alt="Logo_AA" width="120px;">
                        </td>
                        <td colspan="4" style="text-align:center;font-size:20pt;">
                            ATMA AUTO
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:center;">
                            MOTORCYCLE SPAREPARTS AND SERVICE
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:center;">
                            Jl. Babarsari No. 43 Yogyakarta 552181
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:center;">
                            Telp. (0274) 487711
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:center;">
                            http://atmauto.jasonfw.com/
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" style="border-top:1px solid black;font-weight:bold;text-align:center;padding:5px;">SURAT PEMESANAN</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>No :</td>
                        <td>{{ $datas[0]->Id_Pengadaan }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Tanggal :</td>
                        <td>{{ date('d M Y', strtotime($datas[0]->Tanggal_Pengadaan)) }}</td>
                    </tr>
                    <!-- <tr>
                        <td colspan="2" rowspan="4">
                        Kepada Yth: <br>
                        {{ $datas[0]->Nama_Supplier }} <br>
                        {{ $datas[0]->Alamat_Supplier }} <br>
                        {{ $datas[0]->Telepon_Supplier }}
                        </td>
                    </tr> -->
                    <tr>
                        <td colspan="2" style="border-top:1px solid black; border-left:1px solid black; border-right:1px solid black;; border-bottom:0px; border-style:dashed;padding:3px;">Kepada Yth:</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-top:0px; border-left:1px solid black; border-right:1px solid black;; border-bottom:0px; border-style:dashed;padding:3px;">{{ $datas[0]->Nama_Supplier }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-top:0px; border-left:1px solid black; border-right:1px solid black;; border-bottom:0px; border-style:dashed;padding:3px;">{{ $datas[0]->Alamat_Supplier }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-top:0px; border-left:1px solid black; border-right:1px solid black;; border-bottom:1px solid black; border-style:dashed;padding:3px;">{{ $datas[0]->Telepon_Supplier}} </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="padding:10px;" >Mohon untuk disediakan barang-barang berikut :</td>
                    </tr>
                    <tr class="mytable">
                        <th class="mytable" style="text-align:center;">No</th>
                        <th class="mytable" style="text-align:center;">Nama Barang</th>
                        <th class="mytable" style="text-align:center;">Merk</th>
                        <th class="mytable" style="text-align:center;">Tipe Barang</th>
                        <th class="mytable" style="text-align:center;">Satuan</th>
                        <th class="mytable" style="text-align:center;">Jumlah</th>
                    </tr>
                    {{$i=0}}
                    @foreach($datas as $data)
                    {{$i++}}
                    <tr>
                        <td class="mytable" style="text-align:center;padding:5px;">{{$i}}</td>
                        <td class="mytable" style="padding:5px;">{{$data->Nama_Sparepart}}</td>
                        <td class="mytable" style="padding:5px;">{{$data->Merk_Sparepart}}</td>
                        <td class="mytable" style="padding:5px;">{{$data->Tipe_Barang}}</td>
                        <td class="mytable" style="text-align:center;padding:5px;">{{$data->Harga_Beli}}</td>
                        <td class="mytable" style="text-align:center;padding:5px;">{{$data->Jumlah}}</td>
                    </tr>
                    @endforeach
                    <!-- <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total Harga :</td>
                        <td> {{$datas[0]->Total_Harga}} </td>
                    </tr> -->
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="text-align:center;padding-top:25px;padding-bottom:75px;">Hormat Kami,</td>
                    </tr>
                    
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="text-align:center;">(Philips Purnomo)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>

    
</html>
