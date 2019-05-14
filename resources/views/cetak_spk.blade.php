<html>
    <head>
    <title>Atma Auto</title>
        <style>
            .mytable{
                border-top:1px solid black;
                border-bottom:1px solid black;
            }
            table,th,td{
                /* border:1px solid black; */
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
                        <td rowspan="5" colspan="2" style="text-align:right;padding:3px">
                            <img src="{{ public_path('/images/Logo_Transparan.png') }}" alt="Logo_AA" width="120px;">
                        </td>
                        <td colspan="3" style="text-align:center;font-size:20pt;">
                            ATMA AUTO
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:center;">
                            MOTORCYCLE SPAREPARTS AND SERVICE
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:center;">
                            Jl. Babarsari No. 43 Yogyakarta 552181
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:center;">
                            Telp. (0274) 487711
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:center;">
                            http://atmauto.jasonfw.com/
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="mytable" style="font-weight:bold;text-align:center;padding:5px;">SURAT PERINTAH KERJA</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="text-align:right;">{{ date('d M Y H:i:s', strtotime($datas[0]->updated_at)) }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" style="font-size:18px;">{{$datas[0]->Jenis_Transaksi.'-'.date('dmy', strtotime($datas[0]->Tanggal_Transaksi)).'-'.$datas[0]->Id_Transaksi }}</td>
                    </tr>
                    
                    <tr>
                        <td>Cust</td>
                        <td colspan="2">NAMA KONSUMEN</td>
                        <td>CS</td>
                        <td>NAMA CUST SERVICE</td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td colspan="2">TELEPON KONSUMEN</td>
                        <td>Montir</td>
                        <td>NAMA MONTIR</td>
                    </tr>
                    <tr>
                        <td style="padding-bottom:15px;">Motor</td>
                        <td colspan="2" style="padding-bottom:15px;">Merk Motor Jenis Motor Plat Motor</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="mytable" style="font-size:16px;font-weight:bold;text-align:center;padding:2px;">SPAREPARTS</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="mytable" style="padding:10px;"></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="mytable" style="padding:1px;"></td>
                    </tr>
                    <tr class="mytable">
                        <th class="mytable" style="text-align:center;">Kode</th>
                        <th class="mytable" style="text-align:center;">Nama</th>
                        <th class="mytable" style="text-align:center;">Merk</th>
                        <th class="mytable" style="text-align:center;">Rak</th>
                        <th class="mytable" style="text-align:center;">Jumlah</th>
                    </tr>
                    @foreach($datas as $data)
                    <tr>
                        <td>888-RTZ-123</td>
                        <td>Bohlam Depan</td>
                        <td>Yamaha</td>
                        <td>DPN-KACA-01</td>
                        <td style="text-align:right">1</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" class="mytable" style="padding:1px;"></td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align:right">3</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="mytable" style="padding:1px;"></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="mytable" style="padding:10px;"></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="mytable" style="font-size:16px;font-weight:bold;text-align:center;padding:2px;">SERVICES</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="mytable" style="padding:10px;"></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="mytable" style="padding:1px;"></td>
                    </tr>
                    <tr class="mytable">
                        <th class="mytable" style="padding-left:10px;">Kode</th>
                        <th class="mytable">Nama</th>
                        <th class="mytable"></th>
                        <th class="mytable"></th>
                        <th class="mytable" style="text-align:right;">Jumlah</th>
                    </tr>
                    @foreach($datas as $data)
                    <tr>
                        <td style="padding-left:10px;">1</td>
                        <td>Service Roda</td>
                        <td></td>
                        <td></td>
                        <td style="text-align:right">1</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" class="mytable" style="padding:1px;"></td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align:right">3</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="mytable" style="padding:1px;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>

    
</html>
