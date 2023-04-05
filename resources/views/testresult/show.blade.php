<html>
<head>

    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.css" media="all" >
    <style type="text/css">
        td{
            padding-right: 75px;
        }
    </style>
    <style type="text/css" media="print">

        a{
            height: 100px;
            visibility: hidden;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <table>
                <tr>
                    <td ><h4>Patient ID: <small>{{ $pacient->id }}</small></h4></td>
                    <td><h4>Referred By: <small>@if($pacient->doctor->name == 'Self')
                                    {{ $pacient->doctor->name }}
                                @else  DR.{{ $pacient->doctor->name }} @endif

                            </small></h4></td>
                    <td><h4>Date : <small>{{ $pacient->created_at }}</small></h4></td>
                </tr>
                <tr>
                    <td><h4>Patient Name: <small>{{ $pacient->name }}</small></h4></td>

                    <td><h4>Age / Sex: <small>{{ $pacient->age }} / @if($pacient->gender == 1)
                                    {{'Male'}}
                                @else
                                    {{'Female'}}
                                @endif</small></h4></td>
                </tr>
                <tr>
                    <td><h4>Address : <small>{{ $pacient->address }}</small></h4></td>
                    <td><h4>Phone: <small>0{{ $pacient->phone }}</small></h4></td>

                </tr>
            </table>





        </div>

        <div class="col-md-10 col-md-offset-1">

            <table class="table table-condensed table-hover table-striped dataTable">
                <thead style="background-color: #00caff">
                <tr>
                    <th>Department Name</th>
                    <th>Test Name</th>
                    <th>Parameter Name</th>
                    <th>Result</th>
                    <th>Unit</th>
                    <th>Normal Range</th>

                </tr>
                </thead>
                @php $tests = array(); @endphp
                <tbody>@foreach($test as $row)


                    <h3 style="text-align: center"></h3>
                    <!-- List of all pacientes-->
                    @foreach($row->testparameter as $parameter)

                        <tr>

                            <td>{{ $row->department->name }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $parameter->name }}</td>
                            <td>{{ $parameter->pacienttestresult->result }}</td>
                            <td>{{ $parameter->unit }}</td>
                            <td>{{ $parameter->normal }}.</td>


                        </tr>
                    @endforeach
                    @php
                        array_push( $tests,$row->fee) ;

                    @endphp
                @endforeach
                @php
                    $fee = 0;
                    for ($counter= 0 ; $counter<count($tests);$counter++){
                            $fee = $tests[$counter]+$fee;
                            //echo $tests[$counter];

                    }

                @endphp
                <br>
                </tbody>
            </table>
            <h5><b>Total Fee :</b> <p style="display: inline">{{ $fee }}</p></h5>
        </div>

        <a class="btn btn-primary col-md-offset-1 col-md-2" href="{{ route('showAllPacientlist') }}" >Back</a>
        <a class="btn btn-success col-md-2" href="#" onclick="window.print()" >Print</a>
    </div>
</div>
</body>
</html>