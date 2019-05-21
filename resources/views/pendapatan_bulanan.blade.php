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
            .tac{
                text-align:center;
            }
            .tar{
                text-align:right;
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
                <p style="text-align:center;"></p'>http://atmauto.jasonfw.com/</p>
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
                        <td colspan="5" style="margin-top:1px solid black;font-weight:bold;text-align:center;padding:5px;border-top:1px solid black;">LAPORAN PENDAPATAN BULANAN</td>
                    </tr>
                    <tr>
                        <td style="padding-left:2px;">Tahun :</td>
                        <td>{{$year}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="mytable tac" width="10%">No</td>
                        <td class="mytable tac">Bulan</td>
                        <td class="mytable tac">Services</td>
                        <td class="mytable tac">Spareparts</td>
                        <td class="mytable tac">Total</td>
                    </tr>
                    @for($i=0;$i<=11;$i++)
                    <tr>
                        <td class="mytable tac">{{$i+1}}</td>
                        <td class="mytable">{{$data[$i]->Bulan}}</td>
                        <td class="mytable tar">{{number_format($data[$i]->Service)}}</td>
                        <td class="mytable tar">{{number_format($data[$i]->Sparepart)}} </td>
                        <td class="mytable tar">{{number_format($data[$i]->Total)}}</td>
                    </tr>
                    @endfor
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="tar" style="font-weight:bold">TOTAL</td>
                        <td class="tar" style="border:1px solid black; font-weight:bold">{{number_format($total[0]->Total_Transaksi)}}</td>
                    </tr>
                    <tr class="tar">
                        <td colspan="5" style="padding-top:50px;">Dicetak Tanggal {{date('d M Y', strtotime($date))}}</td>
                    </tr>
                </tbody>
            </table>
            <div id="container2">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </body>
</html>

<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script src="/html2canvas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    let bul = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September"
                , "Oktober", "November", "Desember"];
    // const urlParams = new URLSearchParams(window.location.search);    
    // let jenis = null;
    // if(urlParams.get('jenis') !== null) {
    //     jenis = urlParams.get('jenis');
    // }
    // if(jenis === 'cetak') {
    //     document.querySelector('#dicetak').style.display = 'block';
    //     let date = new Date().getDate();
    //     let month = new Date().getMonth();
    //     let year = new Date().getFullYear();
    //     let bulan = bul[month];
    //     document.querySelector('#tanggal').innerHTML = date + ' ' + bulan + ' ' + year;
        
    // } 
    let table = document.querySelector('#tableBulan tbody');
    let total1 = 0;
    let tahun = [];
    let cabang = [];
    let datas = [];
    let temp2;
    let ct = [];
    
    axios.get('/api/pendapatan_bulanan/'+$year)
    .then((result) => {
        let temp = result.data;
        let temp2 = result.data;
        console.log(temp);
        for(let j = 0; j < temp.length; j++) {
            total1 += temp[j].total;
            if(!tahun.includes(temp[j].tahun))
                tahun.push(temp[j].tahun);
        
            let tr = table.insertRow(-1);
            let td = document.createElement('td');      
            for(let k = 0; k < 4; k++){
                td = tr.insertCell();  
                if (k == 0)
                    td.innerHTML = j+1;
                else if (k == 1) {
                    td.innerHTML = temp[j].tahun;
                } else if (k == 2) {
                    td.innerHTML = temp[j].cabang;
                } else if (k == 3)
                    td.innerHTML = temp[j].total;
            } 
            if(!cabang.includes(temp[j].cabang)) {
                let data = {};
                cabang.push(temp[j].cabang);
                data.cabang = temp[j].cabang;
                data.total = [];
                data.total.push(temp[j].total);
                datas.push(data);
            }
            
        }
        for(let i = 0; i < cabang.length; i++) {
            for(let b = 0; b < tahun.length; b++) {
                let data = {};
                data.cabang = cabang[i];
                data.tahun = tahun[b];
                ct.push(data);
            }
        }
        console.log(ct);
        for(let h = 0; h < ct.length; h++) {
            for(let a = 0; a < temp2.length; a++) {
                if(ct[h].cabang == temp2[a].cabang && ct[h].tahun == temp2[a].tahun) {
                    // console.log("ketemu"+temp2[a].total);
                    for(let z = 0; z < datas.length; z++) {
                        if(datas[z].cabang == temp2[a].cabang)
                        {
                            
                            console.log(temp2[a].total)
                            datas[z].total.push(temp2[a].total);
                            break;
                        }
                            // 
                    }
                }
                // } else if (ct[h].cabang == temp2[a].cabang && ct[h].tahun != temp2[a].tahun) {
                //     console.log("nggak ketemu");
                //     for(let z = 0; z < datas.length; z++) {
                //         if(datas[z].cabang == ct[h].cabang)
                //             datas[z].total.push(0);
                //     }
                // }
            }
                
        }
        
        console.log(cabang);
        console.log(datas);
        console.log(tahun);
        document.querySelector('#total').innerHTML = total1;
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: tahun,
                datasets: []
            },
            options: {
                legend: {
                    position: 'right'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                        beginAtZero: true
                        }
                    }]
                }
            }
        });
        datas.forEach(function(data){
            myChart.data.datasets.push({
                label: data.cabang,
                backgroundColor: '#' + (Math.random().toString(16) + "000000").substring(2,8),
                data: data.total
            });
            myChart.update();
        })
    
        if(jenis === 'cetak')
            setTimeout(printDong, 500);
        
    }).catch((err) => {
        
    });   
    function printDong(quality = 2) {
        window.print();
    } 
</script>