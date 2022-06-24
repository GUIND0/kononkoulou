@extends('back_office.partials.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-body">

                <div class="table-responsive table-scrollable">
                    <table class="table table-bordered table-hover text-center" id="table-javascript">
                        <thead class="thead-light"></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    $('#table-javascript').bootstrapTable({
            data: @json($users),
            toolbar: "#toolbar",
            cache: false,
            striped: false,
            pagination: true,
            pageSize: 10,
            pageList: [10, 25, 50, 100, 200],
            sortOrder: "asc",
            sortName: "libelle",
            locale: "fr-FR",
            search: true,
            searchAlign : "right",
            minimumCountColumns: 2,
            clickToSelect: false,
            tooltip: false,
            showFooter: false,
            showLoading: false,
            showExport: false,
            showPaginationSwitch: true,
            exportDataType : "selected",
            mobileResponsive: true,
            showColumns: false,
            showMultiSort: false,
            filterControl: false,
            fixedNumber: 8,
            fixedRightNumber: 10,
            columns: [
                {
                    title: 'state',
                    checkbox: true,
                },
                {
                    field: 'firstname',
                    title: "Prénom",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'lastname',
                    title: "Nom",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'email',
                    title: "Email",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'profil_libelle',
                    title: "Profil",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'validate',
                    title: "Status",
                    sortable: true,
                    formatter: statusFormatter,
                    filterControl: "input",
                },
                {
                    field: 'id',
                    title: "Action",
                    sortable: true,
                    filterControl: "input",
                    formatter: actionFormatter
                },
            ]

        });

        function statusFormatter(value, row, index){
            if(value == 1){
                 return `<span class="badge bg-primary">Valider</span>`;

            }else{
                return `<span class="badge bg-warning">En Attente</span>`;
            }
        }

        function actionFormatter(value, row, index){
            return `
             <a href="{{ route('user.show','') }}/${value}" class="btn btn-primary">Détail</a>
             `;
        }


</script>
@endsection
