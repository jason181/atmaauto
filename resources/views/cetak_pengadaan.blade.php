<html>
    <head>
    <title>Atma Auto</title>
        <style>
            .container{
                border : 1px solid black;
                width : 100%;
                height: 100%;
            }
            .header-left{
                float : left;
                width : 30%;
                padding : 15px;
                margin : 50px auto;
            }
            .header-left{
                float : right;
                width : 70%;
                padding : 15px;
                margin : 50px auto;
            }
            table,th,td{
                border:1px solid black;
                /* border-style:dashed; */
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
                        <td rowspan="5" colspan="2">
                            <img src="{{ public_path('/images/Logo_Transparan.png') }}" alt="Logo_AA">
                        </td>
                        <td colspan="4" style="text-align:center;">
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
                        <td></td>
                        <td></td>
                        <td colspan="2" style="font-weight:bold;">SURAT PEMESANAN</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>No :</td>
                        <td>{{ $pengadaan->Id_Pengadaan }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Tanggal :</td>
                        <td>{{ $pengadaan->Tanggal_Pengadaan }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Kepada Yth:</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">{{ $supplier->Nama_Supplier }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">{{ $supplier->Alamat_Supplier }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">{{ $supplier->Telepon_Supplier}} </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr style="margin:100px;">
                        <td colspan="6">Mohon untuk disediakan barang-barang berikut :</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>

    
</html>
