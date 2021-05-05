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

    <table style="width: 100%;">
        <tr>
            <td>
                <img src="{{ $_SERVER['DOCUMENT_ROOT'] }}/img/coreongate.png" alt="Coreon Gate" style="width:200px">
            </td>
            <td style="width:250px">
                <p style="font-size:12px">Date exported: {{ date('M d, Y') }}</p>
                <p style="font-size:12px">Date covered: {{ date('M d, Y', strtotime($start_date)) }} - {{ date('M d, Y', strtotime($end_date)) }}</p>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <table id="reportsPDF">
                    <thead>
                        <tr class="row">
                            <td class="header">client #</td>
                            <td class="header">Name</td>
                            <td class="header">Username</td>
                            <td class="header">Email</td>
                            <td class="header">Membership Plan</td>
                            <td class="header">Expiration</td>
                            <td class="header">Created at</td>
                            <td class="header">status</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if($clients->count() > 0)
                            @foreach($clients as $client)
                                <tr class="row"> 
                                    <td class="column">{{ $client->id }}</td>
                                    <td class="column">{{ ucfirst($client->first_name) }} {{ ucfirst($client->last_name) }}</td>
                                    <td class="column">{{ $client->username }}</td>
                                    <td class="column">{{ $client->email }}</td>
                                    <td class="column">{{ ($client->plan->first()) ? $client->plan->first()->name : 'No current plan' }}</td>
                                    <td class="column">{{ ($client->plan->first() && $client->plan->first()->pivot->end_date) ? date('M d, Y', strtotime($client->plan->first()->pivot->end_date)) : 'No Expiration' }}</td>
                                    <td class="column">{{ date('M d, Y', strtotime($client->created_at)) }}</td>
                                    @if($client->monitoring->count() > 0)
                                        <td class="column">{{ ($client->monitoring->last()->check_out) ? date('m d, Y', strtotime($client->monitoring->last()->check_out)) : date('M d, Y', strtotime($client->monitoring->last()->check_in)) }}</td>
                                    @else
                                        <td class="column">N/A</td>    
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr class="row">
                                <td colspan="8" style="text-align:center;">No client found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>