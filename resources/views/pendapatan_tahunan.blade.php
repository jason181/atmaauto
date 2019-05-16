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
                        <td colspan="5" style="margin-top:1px solid black;font-weight:bold;text-align:center;padding:5px;">LAPORAN PENDAPATAN BULANAN</td>
                    </tr>
                    <tr>
                        <td class="mytable">No</td>
                        <td class="mytable">Tahun</td>
                        <td class="mytable">Cabang</td>
                        <td class="mytable">Total</td>
                    </tr>
                    {{$i=0}}
                    @foreach($datas as $data)
                    {{$i++}}
                    <tr>
                        <td class="mytable">{{$i++}}</td>
                        <td class="mytable">{{$data->Tahun}}</td>
                        <td class="mytable">{{$data->Cabang}}</td>
                        <td class="mytable">{{$data->Total}}</td>
                    </tr>
                    @endfor
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align:right;">TOTAL</td>
                        <td>{{$total[0]->Total_Transaksi}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>

</html>
