<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <style>
        body {
            font-family: sans-serif;
        }

        #reportsPDF {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        header {
            width: 100%;
            margin: 0px 20px
        }

        header img {
            width: 200px;
        }

        .header {
            font-weight: bold;
        }

        .header,
        .column {
            border: 1px solid black;
            text-align: center;
            font-size: 11px;
            padding: 2px;
            color: black;
        }
    </style>
</head>
<body>

    <table id="reportsPDF">
        <thead>
            <tr>
                <td colspan="8">
                    Date exported: {{ date('M d, Y') }}
                </td>
                <td colspan="9">
                    Date covered: {{ date('M d, Y', strtotime($start_date)) }} - {{ date('M d, Y', strtotime($end_date)) }}
                </td>
            </tr>
            <tr>
                <td colspan="17" style='text-align: center;font-weight:bold;font-size:16px;color:white;background-color:#009345'>
                    COREONGATE
                </td>
            </tr>
            <tr class="row">
                <td colspan="2" style="text-align: center;font-weight:bold;font-size:13px;background-color:#014129;color:white;">CLIENT #</td>
                <td colspan="2" style="text-align: center;font-weight:bold;font-size:13px;background-color:#014129;color:white;">NAME</td>
                <td colspan="2" style="text-align: center;font-weight:bold;font-size:13px;background-color:#014129;color:white;">USERNAME</td>
                <td colspan="3" style="text-align: center;font-weight:bold;font-size:13px;background-color:#014129;color:white;">EMAIL</td>
                <td colspan="2" style="text-align: center;font-weight:bold;font-size:13px;background-color:#014129;color:white;">PLAN</td>
                <td colspan="2" style="text-align: center;font-weight:bold;font-size:13px;background-color:#014129;color:white;">EXPIRATION</td>
                <td colspan="2" style="text-align: center;font-weight:bold;font-size:13px;background-color:#014129;color:white;">CREATED AT</td>
                <td colspan="2" style="text-align: center;font-weight:bold;font-size:13px;background-color:#014129;color:white;">STATUS</td>
            </tr>
        </thead>
        <tbody>
            @if($clients->count() > 0)
                @foreach($clients as $client)
                    <tr class="row"> 
                        <td colspan="2" style="text-align:center">{{ $client->id }}</td>
                        <td colspan="2" style="text-align:center">{{ ucfirst($client->first_name) }} {{ ucfirst($client->last_name) }}</td>
                        <td colspan="2" style="text-align:center">{{ $client->username }}</td>
                        <td colspan="3" style="text-align:center">{{ $client->email }}</td>
                        <td colspan="2" style="text-align:center">{{ ($client->plan->first()) ? $client->plan->first()->name : 'No current plan' }}</td>
                        <td colspan="2" style="text-align:center">{{ ($client->plan->first() && $client->plan->first()->pivot->end_date) ? date('M d, Y', strtotime($client->plan->first()->pivot->end_date)) : 'No Expiration' }}</td>
                        <td colspan="2" style="text-align:center">{{ date('M d, Y', strtotime($client->created_at)) }}</td>
                        @if($client->monitoring->count() > 0)
                            <td colspan="2" style="text-align:center">{{ ($client->monitoring->last()->check_out) ? date('m d, Y', strtotime($client->monitoring->last()->check_out)) : date('M d, Y', strtotime($client->monitoring->last()->check_in)) }}</td>
                        @else
                            <td colspan="2" style="text-align:center">N/A</td>    
                        @endif
                    </tr>
                @endforeach
            @else
                <tr class="row">
                    <td colspan="17" style="text-align:center;">No client found</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>