<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
        </style>
    </head>
    <body>
        <div class="container">
            <div style="float:left; width:40%; padding:15px; margin:15px auto; text-align:right;">
                <img src="{{ asset('/images/Logo_Transparan.png') }}" alt="Logo_AA">
                <!-- INI GAMBAR -->
            </div>
            <div style="float:right; width:30%; padding:15px; margin: 15px 330px auto auto;">
                <h1 style="text-align:center;">ATMA AUTO</h1>
                <p style="text-align:center;">MOTORCYCLE SPAREPARTS AND SERVICES</p>
                <p style="text-align:center;">Jl. Babarsari No. 43 Yogyakarta 552181</p>
                <p style="text-align:center;">Telp. (0274) 487711</p>
                <p style="text-align:center;">http://atmauto.jasonfw.com/</p>
            </div>
        </div>
    </body>

    
</html>
