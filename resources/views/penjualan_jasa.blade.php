<html>
    <head>
    <title>Atma Auto</title>
        <style>
            .mytable{
                border:1px solid black;
                /* border-bottom:1px solid black; */
            }
            table,th,td{
                /* border:1px solid black; */
                /* border-style:dashed; */
            }
            table {
                border-collapse: collapse;
                width:100%;
            }
        </style>
    </head>
    <body>
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
                        <td colspan="5" style="border-top:1px solid black;font-weight:bold;text-align:center;padding:5px;">LAPORAN PENJUALAN JASA</td>
                    </tr>
                    <tr>
                        <td>Tahun :</td>
                        <td>{{$year}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Bulan :</td>
                        <td>{{$month}}</td>
                    </tr>
                    <tr>
                        <td class="mytable">No</td>
                        <td class="mytable">Merk</td>
                        <td class="mytable">Tipe</td>
                        <td class="mytable">Nama Service</td>
                        <td class="mytable">Jumlah Penjualan</td>
                    </tr>
                    {{$i=0}}
                    @foreach($datas as $data)
                    {{$i++}}
                    <tr>
                        <td class="mytable">{{$i}}</td>
                        <td class="mytable">{{$data->Merk}}</td>
                        <td class="mytable">{{$data->Tipe}}</td>
                        <td class="mytable">{{$data->NamaService}}</td>
                        <td class="mytable">{{$data->JumlahService}}</td>
                    </tr>
                    @endforeach
                   
                    <tr class="tar">
                        <td colspan="5" style="padding-top:50px;">Dicetak Tanggal {{date('d M Y', strtotime($date))}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>

</html>