@extends('layouts.app',['title'=>'Branch List'])

@section('content')

<div class="container">
<ul class="list-group">
    <li class="list-group-item list-group-item-info"><b>Reports From </b><small>{{ $from }}</small><b> To</b> <small>{{ $to }}</small></li>
</ul>
    <div class="" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
            <div class="panel-heading">
                <h4 >Patients Reports</h4>
                <div class="pull-right" style="margin-top:-20px !important; ">
                    Total: <div class="badge" >{{count($pacients)}}</div>
                </div>
            </div>

            <div class="table-responsive">

                <table class="table table-condensed table-hover table-striped">
                    <thead>
                    <tr>

                        <th>No</th>
                        <th>Patient Name</th>
                        <th>Patient Phone</th>
                        <th>Address</th>
                        <th>age / Gender</th>
                        <th>Referred by</th>
                        <th>Payed Amount</th>
                        <th>Discount</th>
                        <th>Total Amount</th>


                    </tr>
                    </thead>
                    <tbody>
                    @php $payed = 0; $discount = 0; $total = 0; @endphp
                    <!-- List of all Branches-->
                    @foreach($pacients as $pacient)
                        <tr>
                            <td>{{ $loop->index + 1}}</td>
                            <td>{{ $pacient->name }}</td>
                            <td>0{{ $pacient->phone }}</td>
                            <td>{{ $pacient->address }}</td>

                            <td>
                                @if($pacient->gender == 0){{ $pacient->age }}years / {{ 'Female'}}
                                @else {{ $pacient->age }}years / {{ 'Male'}}
                                @endif




                            </td>
                            @php
                                $pacient_payed = $pacient->total_amount - $pacient->discount - $pacient->remained_amount;
                                $payed = $payed + $pacient_payed;
                                $discount = $discount + $pacient->discount;
                                $total = $total + $pacient->remained_amount;
                            @endphp
                            <td>{{ $pacient->doctor->name }}</td>
                            <td>{{ $pacient_payed }}</td>
                            <td>{{ $pacient->discount }}</td>
                            <td>{{ $pacient->remained_amount }}</td>

                        </tr>
                    @endforeach()
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a class="btn btn-success" href="#" onclick="window.print()" ><i class="glyphicon glyphicon-print"></i> Print</a></td>
                        <td>{{ $payed }} /AFN</td>
                        <td>{{ $discount }} /AFN</td>
                        <td>{{ $total }} /AFN</td>
                    </tr>
                    </tbody>
                </table>

            </div>
            {{--<div class="panel-footer">--}}
                {{--{!!$data->links();!!}--}}
            {{--</div>--}}
        </div>
        <div class=" panel-primary">
            <div class="panel-heading">
                <h4 >
                    Item  Reports</h4>
                <div class="pull-right" style="margin-top:-20px !important; ">
                    Total: <div class="badge" >{{count($materials)}}</div>
                </div>
            </div>

            <div class="table-responsive">

                <table class="table table-condensed table-hover table-striped">
                    <thead>
                    <tr>

                        <th>No</th>
                        <th>Test Name</th>
                        <th>Brunch Name</th>
                        <th>Quantity</th>


                    </tr>
                    </thead>
                    <tbody>
                    <!-- List of all Branches-->
                    @foreach($materials as $material)
                        <tr>
                            <td>{{ $loop->index + 1}}</td>
                            <td>{{ $material->test->name }}</td>

                            <td>{{ $material->branch->name }}</td>
                            <td>{{ $material->quantity }}</td>

                        </tr>
                    @endforeach()
                    </tbody>
                </table>
            </div>
            {{--<div class="panel-footer">--}}
                {{--{!!$data->links();!!}--}}
            {{--</div>--}}
        </div>
    </div>
@stop