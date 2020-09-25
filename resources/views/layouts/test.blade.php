@extends('layouts.main')
@section('body')

<body>
    <style>
        td.details-control {
            background: url({{asset('img/details_open.png')}}) no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url({{asset('img/details_close.png')}}) no-repeat center center;
        }
    </style>
<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th></th>
        <th>Name</th>
        <th>Position</th>
        <th>Office</th>
        <th>Salary</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th></th>
        <th>Name</th>
        <th>Position</th>
        <th>Office</th>
        <th>Salary</th>
    </tr>
    </tfoot>
</table>

<script>
    /* Formatting function for row details - modify as you need */
    function format ( d ) {
        if (d.user_id === 1) {
            console.log('Witojcie');
        }
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; width:100%">'+
            '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.name+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+d.extn+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
            '</tr>'+
            '</table>';
        {{--return '<div>' +--}}
                {{--'<form method="GET" action="{{ route('updateTransaction', [1]) }}">' + d.name--}}
            {{--+ '<input type="text">'--}}
            {{--+ '<input type="text">'--}}
            {{--+ '<input type="text">'--}}
            {{--+ '<input type="submit">'--}}
            {{--+ '</form>'--}}
            {{--+ '</div>';--}}
{{--        @include('siren.partials.card', ['t' => 1, 'underlying' => 'XOM']);--}}
    }

    $(document).ready(function() {
        var table = $('#example').DataTable( {
            "ajax": "{{asset('js/objects.txt')}}",
            "columns": [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { "data": "name" },
                { "data": "position" },
                { "data": "office" },
                { "data": "salary" }
            ],
            "order": [[1, 'asc']]
        } );

        // Add event listener for opening and closing details
        $('#example tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
        } );
    } );

</script>
</body>
@endsection
{{--</html>--}}