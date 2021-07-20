@extends('DashboardModule::dashboard.index')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lista wszystkich Hoteli</h4>
                        <table class="table table-striped"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @javascript('statuses', $statuses)
@endsection
@section('javascripts')
    @parent

    <script>

        $('.table').zdrojowaTable({

            ajax: {
                url: "{{route('ApartmentModule::apartments.ajax')}}",
                method: "POST",
                data: {
                    "_token": "{{csrf_token()}}"
                },
            },
            headers: [
                {
                    name: 'L.p',
                    type: 'index',
                },
                {
                    name: 'Numer',
                    type: 'text',
                    ajax: 'number',
                    orderable: true,
                },
                {
                    name: 'Piętro',
                    type: 'text',
                    ajax: 'floor',
                    orderable: true
                },
                {
                    name: 'Status',
                    type: 'select',
                    ajax: 'status',
                    select: Object.keys(statuses).map(function (key) {
                        return [statuses[key], statuses[key]];
                    }),
                    orderable: true
                },
                {
                    name: 'Data utworzenia',
                    orderable: true,
                    ajax: 'created_at'
                },
                {
                    name: 'Akcje',
                    ajax: 'key',
                    type: 'actions',
                    buttons: [
                        @permission('ApartmentModule.edit')
                        {
                            color: 'primary',
                            icon: 'mdi mdi-pencil',
                            class: 'remove',
                            url: "{{route('ApartmentModule::apartments.edit', ['apartment' => '%%id%%'])}}"
                        },
                        @endpermission
                        @permission('ApartmentModule.delete')
                        {
                            color: 'danger',
                            icon: 'mdi mdi-delete',
                            class: 'ZdrojowaTable--remove-action',
                            url: "{{route('ApartmentModule::apartments.destroy', ['apartment' => '%%id%%'])}}"
                        },
                        @endpermission
                    ]
                }
            ]
        });
    </script>
@endsection
