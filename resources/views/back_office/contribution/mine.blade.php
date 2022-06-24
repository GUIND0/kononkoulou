@extends('back_office.partials.main')
@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title mb-0">Mes contributions</p>
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
                data: @json($contributions),
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
                        field: 'montant',
                        title: "Montant (FCFA)",
                        sortable: true,
                        filterControl: "input",
                        formatter: amountFormatter
                    },
                    {
                        field: 'projects_nom',
                        title: "Projet",
                        sortable: true,
                        filterControl: "input",

                    },
                    {
                        field: 'created_at',
                        title: "Date",
                        sortable: true,
                        filterControl: "input",
                        formatter: dateFormatter
                    }

                ]

            });



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


</script>
@endsection
