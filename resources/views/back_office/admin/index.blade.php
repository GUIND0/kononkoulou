@extends('back_office.partials.main')
@section('content')
<style>
    #chart_permis,#chart_carte {
          width: 100%;
          height: 500px;
      }

  </style>
<div class="col-md-12 grid-margin">
    <div class="row">
      <div class="col-md-4 mb-4 stretch-card transparent">
         <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img
                    src="/new/assets/img/icons/unicons/chart-success.png"
                    alt="chart success"
                    class="rounded"
                  />
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Nombre de campagnes en cours</span>
              <h3 class="card-title mb-2">{{ $nbr_campagne_en_cours }}</h3>
            </div>
          </div>
      </div>

      <div class="col-md-4 mb-4 stretch-card transparent">
            <div class="card">
                <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                    <img
                        src="/new/assets/img/icons/unicons/chart-success.png"
                        alt="chart success"
                        class="rounded"
                    />
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Nombre de projet financé</span>
                <h3 class="card-title mb-2">{{ $nbr_campagne_valider }}</h3>
                </div>
            </div>
      </div>

      <div class="col-md-4 mb-4 stretch-card transparent">
        <div class="card">
            <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                <img
                    src="/new/assets/img/icons/unicons/chart-success.png"
                    alt="chart success"
                    class="rounded"
                />
                </div>
            </div>
            <span class="fw-semibold d-block mb-1">Nombre de financement echoué</span>
            <h3 class="card-title mb-2">{{ $nbr_campagne_echoues }}</h3>
            </div>
        </div>

      </div>

    </div>



    <div class="row">
        <div class="col-md-4 mb-4 stretch-card transparent">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img
                                    src="/new/assets/img/icons/unicons/chart-success.png"
                                    alt="chart success"
                                    class="rounded"
                                />
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Nombre de contributions</span>
                        <h3 class="card-title mb-2">{{ $nbr_contributions }}</h3>
                    </div>
                </div>
        </div>

        <div class="col-md-4 mb-4 stretch-card transparent">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img
                                src="/new/assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                            />
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Montant total recolté</span>
                    <h3 class="card-title mb-2">{{ number_format($montant_total,0,'.',' ') }} FCFA</h3>
                </div>
            </div>
        </div>



        <div class="col-md-4 mb-4 stretch-card transparent">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img
                                src="/new/assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                            />
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Nombre d'utilisateur</span>
                    <h3 class="card-title mb-2">{{ $nbre_utilisateur }}</h3>
                </div>
            </div>
        </div>
    </div>




    <div class="row">

        <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img
                                src="/new/assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                            />
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Montant total Prévisionnel</span>
                    <h3 class="card-title mb-2">{{ number_format($montant_previsionnel,0,'.',' ') }} FCFA</h3>
                </div>
            </div>

        </div>


        <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img
                                src="/new/assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                            />
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total vues</span>
                    <h3 class="card-title mb-2">{{ $total_vues }}</h3>
                </div>
            </div>
        </div>

    </div>



    <div class="row">
         <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Montant de contributions par mois</h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li>
                                <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div id="chart_carte" class="apex-charts"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row mt-2">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <p class="card-title mb-0">Nombre de campagne par Secteur</p>
              <div class="table-responsive">

                <table class="table table-striped table-borderless">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Nom</th>

                    </tr>
                  </thead>
                  <tbody>
                      @forelse ($rsCampaign as $campaign)
                      <tr>
                        <td>{{ $campaign["nombre"]  }}</td>
                        <td>{{ $campaign["name"]  }}</td>
                      </tr>
                      @empty
                      <td>Aucune données</td>
                      @endforelse
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        </div>
    </div>


    <div class="row mt-2">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <p class="card-title mb-0">Nombre de campagne par Type de campagne</p>
              <div class="table-responsive">

                <table class="table table-striped table-borderless">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Nom</th>

                    </tr>
                  </thead>
                  <tbody>
                      @forelse ($rsTypeCampaign as $v)
                      <tr>
                        <td>{{ $v["nombre"]  }}</td>
                        <td>{{ $v["name"]  }}</td>
                      </tr>
                      @empty
                      <td>Aucune données</td>
                      @endforelse
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
    </div>


    <div class="row mt-2">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <p class="card-title mb-0">Nombre d'utilisateur par pays</p>
              <div class="table-responsive">

                <table class="table table-striped table-borderless">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Nom</th>

                    </tr>
                  </thead>
                  <tbody>
                      @forelse ($rsUser as $user)
                      <tr>
                        <td>{{ $user["nombre"]  }}</td>
                        <td>{{ $user["libelle"]  }}</td>
                      </tr>
                      @empty
                      <td>Aucune données</td>
                      @endforelse
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
    </div>

  </div>
</div>

@endsection
@section('script')
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/frozen.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/spiritedaway.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<script>
    am4core.ready(function() {

            // Themes begin
            //am4core.useTheme(am4themes_material);
            am4core.useTheme(am4themes_animated);
            am4core.color("#fff");
            // Themes end

            // Create chart instance
            var chart_carte = am4core.create("chart_carte", am4charts.XYChart3D);

            // Add data
            chart_carte.data = @json($contributions_par_mois)

            // Create axes
            let categoryAxis = chart_carte.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "mois";
            categoryAxis.renderer.labels.template.rotation = 270;
            categoryAxis.renderer.labels.template.hideOversized = false;
            categoryAxis.renderer.minGridDistance = 20;
            categoryAxis.renderer.labels.template.horizontalCenter = "right";
            categoryAxis.renderer.labels.template.verticalCenter = "middle";
            categoryAxis.tooltip.label.rotation = 270;
            categoryAxis.tooltip.label.horizontalCenter = "right";
            categoryAxis.tooltip.label.verticalCenter = "middle";

            let valueAxis = chart_carte.yAxes.push(new am4charts.ValueAxis());
            //valueAxis.title.text = "Mois";
            valueAxis.title.fontWeight = "bold";

            // Create series
            var series = chart_carte.series.push(new am4charts.ColumnSeries3D());
            series.dataFields.valueY = "nombre";
            series.dataFields.categoryX = "mois";
            series.name = "Nombre";
            series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
            series.columns.template.fillOpacity = .8;

            series.tooltip.getFillFromObject = false;
            series.tooltip.label.propertyFields.fill = "color";
            series.tooltip.background.propertyFields.stroke = "color";

            var columnTemplate = series.columns.template;
            columnTemplate.strokeWidth = 2;
            columnTemplate.strokeOpacity = 1;
            columnTemplate.stroke = am4core.color("#FFFFFF");

            columnTemplate.adapter.add("fill", function(fill, target) {
            return chart_carte.colors.getIndex(target.dataItem.index);
            })

            columnTemplate.adapter.add("stroke", function(stroke, target) {
            return chart_carte.colors.getIndex(target.dataItem.index);
            })

            chart_carte.cursor = new am4charts.XYCursor();
            chart_carte.cursor.lineX.strokeOpacity = 0;
            chart_carte.cursor.lineY.strokeOpacity = 0;

}); // end am4core.ready()
</script>
@endsection
