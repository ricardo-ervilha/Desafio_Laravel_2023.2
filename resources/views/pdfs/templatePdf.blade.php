<head>
    <title>Relatório Geral de Consultas</title>
    <style>
        @page{
            margin: 70px 0;
        }

        body{
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background-color: #f8f8f8;
        }

        .header{
            position: absolute;
            top:-70px;
            left:0;
            right:0;
            width: 100%;
            color: #f5f5f5;
            text-align: center;
            background-color: #343a40;
            padding: 10px;
        }

        footer{
            position:fixed;
            bottom: -70px;
            left:0;
            width: 100%;
            padding: 5px 10px 10px 10px;
            text-align: center;
            background-color: #343a40;
            color: #f5f5f5;
        }

        footer .page{
            background-color: #f5f5f5;
            color: black;
            position: fixed;
            right: 15px;
            padding: 5px 10px;
            text-align: center;
            font-size: 15px;
            border-radius: 100%;
        }

        footer .page:after{
            content: counter(page);
        }

        table{
            width: 100%;
            border: 1px solid black;
            margin: 0;
            padding: 0;
        }

        th{
            text-transform: uppercase;
        }

        table, th, td{
            border: 1px solid #555555;
            border-collapse: collapse;
            text-align: center;
            padding: 10px;
        }

        tr:nth-child(2n+0){
            background-color: #d7d5d5;
        }

        .data{
            margin-top: 50px;
            margin-left: 1rem;
            margin-right: 1rem;
            color: gray;
            border: 2px dashed black;
        }

        .data .sec1, .sec2{
            width: 300px;
            min-width: 100px;
            display: inline-block;
            vertical-align: top;
        }

        .sec1{
            margin-left: 0.3rem;
        }

        .sec2{
            padding: 0;
            position: fixed;
            right: 1rem;
        }

        .data h3{
            font-weight: lighter;
        }

        .month{
            margin-left: 1rem;
            margin-bottom: -0.1rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Relatório de Consultas</h1>
    </div>

    <div class="data">
        <div class="sec1">
            <h3>Emissor: {{\Illuminate\Support\Facades\Auth::user()->name}}</h3>
            <h3>E-mail: {{\Illuminate\Support\Facades\Auth::user()->email}}</h3>
        </div>
        <div class="sec2">
            <h3>Data da emissão: {{now()->toDateString()}}</h3>
            <h3>Horário da emissão: {{\Carbon\Carbon::now()->toTimeString()}} BRT</h3>
        </div>
    </div>
    @for($i = 1; $i <= 12; $i++)
        @php
            $consultationsInMonth = $consultations->filter(function($consult) use ($i) {
                return explode('-', $consult->startDate)[1] == $i;
            });
        @endphp

        @if($consultationsInMonth->count() > 0)
            <h3 class="month">{{$meses[$i]}}</h3>
            <table>
                <tr>
                    <th>Animal</th>
                    <th>Proprietário</th>
                    <th>Diagnóstico</th>
                    <th>Medicamentos</th>
                    <th>Início</th>
                    <th>Término</th>
                </tr>
                @foreach($consultationsInMonth as $consult)
                    <tr>
                        <td>{{$animals[$consult->animal_id]->name}}</td>
                        <td>{{$owners[$animals[$consult->animal_id]->owner_id]->name}}</td>
                        <td>{!! $consult->treatment == null ? '<hr>' : $consult->treatment->diagnostic !!}</td>
                        <td>{!! $consult->treatment == null ? '<hr>' : $consult->treatment->medicines !!}</td>
                        <td>{{$consult->startDate}}</td>
                        <td>{{$consult->endDate}}</td>
                    </tr>
                @endforeach
            </table>
        @endif
        <footer> <span>© 2023 Laravel. All Rights Reserved.</span> <span class="page"></span></footer>
    @endfor


</body>
</html>
