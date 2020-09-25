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
    .test {
        border-color: black;
        border-width: 1px;
        border-style: dashed;
    }
</style>
<div class="jumbotron">
    <table id="example" class="display nowrap" style="width:100%">
        <thead>
        <tr>
            <th></th>
            {{--<th>Id</th>--}}
            <th>Underlying</th>
            <th>Asset</th>
            <th>Strike</th>
            {{--<th>Net cash</th>--}}
            {{--<th>Commission</th>--}}
            {{--<th>Size</th>--}}
            <th>Action</th>
            <th>Date</th>
            {{--<th>User id</th>--}}
            <th>Status</th>
            {{--<th>Comment</th>--}}
            {{--<th>Group</th>--}}
            {{--<th>Discuss</th>--}}
        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            {{--<td>Id</td>--}}
            <td>Underlying</td>
            <td>Transaction_type_id</td>
            <td>Strike</td>
            {{--<td>Net cash</td>--}}
            {{--<td>Commission</td>--}}
            {{--<td>Size</td>--}}
            <td>Action</td>
            <td>Date</td>
            <td>Status</td>
            {{--<td>Row 1 Data 2</td>--}}
            {{--<td>Row 1 Data 1</td>--}}
            {{--<td>Row 1 Data 2</td>--}}
        </tr>
        {{--<tr>--}}
            {{--<td>Row 2 Data 1</td>--}}
            {{--<td><button class="btn-danger" onclick="dupa"> Row 2 Data 2</button></td>--}}
        {{--</tr>--}}
        </tbody>
    </table>
</div>

    <script>

        function format ( d ) {

            // `d` is the original data object for the row
            var group = d.group_id;
            var parent = d.parent;
            if (group === 0) {
                group = 'NA';
            }
            if (!parent) {
                parent = 'NA';
            }
            return '<table cellpadding="8" cellspacing="0" border="2" style="padding-left:50px; width:75%">' +
                '<tr> ' +
                    '<td style="width:25%" >Net cash:</td>' +
                    '<td style="width:25%">' + d.cash + '</td>' +
                    '<td style="width:25%">Group:</td>' +
                    '<td style="width:25%">' + group + '</td>' +
                // '<td></td>' +
                '</tr>' +
                '<tr>' +
                    '<td style="width:25%">Transaction by:</td>' +
                    '<td>' + d.user.name + '</td>' +
                    '<td>Parent:</td>' +
                    '<td>' + parent + '</td>' +
                '</tr>' +
                '<tr>' +
                    '<td style="width:25%">Comment:</td>' +
                    '<td>' + d.comment + '</td>' +
                    '<td>Action:</td>' +
                    '<td>' + d.action.name + '</td>' +
                '</tr>' +
            '</table>' +
                '<div class="test"></div>';
        }

        $(document).ready(function() {
            var table = $('#example').DataTable( {
                "dom": '<"toolbar">frtip',
                "processing": true,
                "serverSide": false,
                "ajax": "{{ route('testData') }}",
                "columns": [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    // { "data": "id" },
                    { "data": "underlying" },
                    { "data": "transaction_type.name" },
                    { "data": "strike" },
                    // { "data": "cash" },
                    // { "data": "commission" },
                    // { "data": "size" },
                    { "data": "action.name" },
                    { "data": "date" },
                    // { "data": "user.name" },
                    { "data": "status.name" },
                    // { "data": "comment"},

                    // "render": function(data) {return "<a href="+ data.comment + ">" + "tekst</a>"; }},
                    // { "data": "group_id" },
                    // {data: null,
                    {{--render: function(data) {--}}
                        {{--return '<form action="http://127.0.0.1:8000/update/' + data.id +  '" method="POST">'--}}
                            {{--+ '@csrf'--}}
                            {{--+ '<input type="text" name="comment">'--}}
                            {{--+ '<input type="hidden" name="id" value=' + data.id +'>'--}}
                            {{--+ '<input type="hidden" name="discuss" value="true">'--}}
                            {{--+ '<input type="submit" value="Zapisz">'--}}
                            {{--+ '</form>'--}}
                    {{--}},--}}
                ],
                select: true,
                lengthChange: false,
                "order": [[1, 'asc']],
                "scrollX": true,
            //     "columnDefs": {
            //         "targets": 12 {
            //
            // }
            //     }
            } );

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
            $("div.toolbar").html('             <form action="{{ route('createTransaction') }}" method="POST">' +
                '                @csrf' +
                '                @if(auth()->id() === 1)' +
                '                    <button class="btn btn-lg btn-primary" type="submit">Create</button>' +
                '                @endif' +
                '' +
                '                Last update: {{ $lastDate }}' +
                '            </form>')
        } );
    </script>

</body>
@endsection