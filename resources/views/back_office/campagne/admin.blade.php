@extends('back_office.partials.main')
@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">

        <div class="card-body">
          <p class="card-title mb-3 mt-3">Liste Campagnes</p>

          @if($campagnes == '[]')
            <h3 class="alert alert-info alert-block text-center">Aucune campagne de financement enregistrée</h3>
          @else
                <div class="table-responsive table-scrollable">
                    <table class="table table-bordered table-hover text-center" id="table-javascript">
                        <thead class="thead-light"></thead>
                        <tbody></tbody>
                    </table>
                </div>
                {{-- <div class="table-responsive">
                    <table class="table table-striped table-borderless text-center">
                    <thead>
                        <tr>
                        <th>Projet</th>
                        <th>Budget(FCFA)</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Type Campagne</th>
                        <th>Status</th>
                        <th>Détails</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($campagnes as $campagne)
                            <tr>
                                <td>{{ $campagne->project->nom }}</td>
                                <td>{{ number_format($campagne->project->budget_demande,0,',',' ')  }}</td>
                                <td>{{ $campagne->startdate }}</td>
                                <td>{{ $campagne->enddate }}</td>
                                <td>{{ $campagne->type->name }}</td>
                                <td>
                                    @if ($campagne->status == 'en_cours')
                                        <span class="badge badge-info">En cours de traitement</span>
                                    @endif
                                    @if ($campagne->status == 'valider')
                                        <span class="badge badge-primary">Valider</span>
                                    @endif
                                    @if ($campagne->status == 'rejeter')
                                        <span class="badge badge-danger">Rejeter</span>
                                    @endif
                                    @if ($campagne->status == 'success')
                                        <span class="badge badge-success">Objectif Atteint</span>
                                    @endif
                                    @if ($campagne->status == 'echec')
                                        <span class="badge badge-success">Echec</span>
                                    @endif
                                </td>
                                <td><a href="#" class="btn btn-success">Voir plus</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div> --}}
          @endif

        </div>
      </div>
    </div>

  </div>
@endsection

@section('script')

    <script>
        $('#table-javascript').bootstrapTable({
                    data: @json($campagnes),
                    toolbar: "#toolbar",
                    cache: false,
                    striped: true,
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
                    toolbar: "#toolbar",
                    toggle: "tooltip",
                    tooltip: true,
                    showFooter: false,
                    showLoading: true,
                    showExport: true,
                    showPaginationSwitch: true,
                    exportTypes: ['json', 'xml', 'csv', 'txt', 'excel', 'pdf'],
                    exportDataType : "selected",
                    mobileResponsive: true,
                    showColumns: true,
                    showMultiSort: true,
                    filterControl: true,
                    fixedNumber: 8,
                    fixedRightNumber: 10,
                    columns: [
                        {
                            title: 'state',
                            checkbox: true,
                        },
                        {
                            field: 'nom',
                            title: "Projet",
                            sortable: true,
                            filterControl: "input",
                        },
                        {
                            field: 'budget_demande',
                            title: "Budget (FCFA)",
                            sortable: true,
                            filterControl: "input",
                            formatter: amountFormatter
                        },
                        {
                            field: 'startdate',
                            title: "Début",
                            sortable: true,
                            filterControl: "input",
                            formatter: dateFormatter
                        },
                        {
                            field: 'enddate',
                            title: "Fin",
                            sortable: true,
                            filterControl: "input",
                            formatter: dateFormatter
                        },
                        {
                            field: 'type',
                            title: "Type campagne",
                            sortable: true,
                            filterControl: "input",
                        },
                        {
                            field: 'status',
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
                            formatter: details,
                        },
                    ]

                });

                function details(value, row, index){

                    return `<a href="{{ route('projet.overview','') }}/${row.project_id}" class="btn btn-success">Voir plus</a></td>`;
                }

                function dateFormatter(value, row, index) {
                    if (value) {
                        let d = new Date(value);
                        let ye = new Intl.DateTimeFormat('en', {
                            year: 'numeric'
                        }).format(d);
                        let mo = new Intl.DateTimeFormat('en', {
                            month: '2-digit'
                        }).format(d);
                        let da = new Intl.DateTimeFormat('en', {
                            day: '2-digit'
                        }).format(d);
                        let hour = new Intl.DateTimeFormat('en', {
                            hour12: false,
                            hour: 'numeric'
                        }).format(d);
                        let minute = new Intl.DateTimeFormat('en', {
                            minute: '2-digit'
                        }).format(d);
                        if (parseInt(minute) < 10) {
                            minute = "0" + minute;
                        }
                        return `${da}/${mo}/${ye} ${hour}:${minute}`
                    }
                }

                function amountFormatter(value, row, index){
                    if(value == null){
                        return `<span>---</span>`;
                    }else{
                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                    }
                  }

                function statusFormatter(value, row, index){
                    if (value == 'en_cours'){
                        return `<span class="badge bg-info">En cours de traitement</span>`;
                    }
                    if (value == 'valider')
                    {
                        return `<span class="badge bg-primary">Valider</span>`;
                    }
                    if (value == 'rejeter')
                    {
                        return `<span class="badge bg-danger">Rejeter</span>`;
                    }
                    if (value == 'success'){
                        return  `<span class="badge bg-success">Objectif Atteint</span>`;
                    }

                    if (value == 'echec'){
                        return `<span class="badge bg-success">Echec</span>`;
                    }


                }
    </script>
@endsection
