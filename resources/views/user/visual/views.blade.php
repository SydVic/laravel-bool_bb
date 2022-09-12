@extends('layouts.dashboard')

@push('css')
  <link rel="stylesheet" href="{{ asset('css/stats.css') }}">
@endpush

@section('content')
  <h1>Visualizzazioni</h1>
  <div class="container-fluid d-flex justify-content-left flex-wrap my-4">
    <div>
    <div>
      <label for="data">Seleziona anno:</label>
      <select id="year" onchange="aggiora(this)" onchange="aggiorm(this)" name="data" id="data">
      <option value="--"> --</option>
      @foreach ($anno as $age)
          <option value="{{$age}}">
            {{ $age }}</option>
      @endforeach
      </select>
    </div>
    <label for="data">Seleziona mese:</label>
      <select id="month" onchange="aggiorm(this)">
          <option value="--">--</option>
          <option value="gennaio">Gennaio</option>
          <option value="febbraio">Febbraio</option>
          <option value="marzo">Marzo</option>
          <option value="aprile">Aprile</option>
          <option value="maggio">Maggio</option>
          <option value="giugno">Giugno</option>
          <option value="luglio">Luglio</option>
          <option value="agosto">Agosto</option>
          <option value="settembre">Settembre</option>
          <option value="ottobre">Ottobre</option>
          <option value="novembre">Novembre</option>
          <option value="dicembre">Dicembre</option>
        </select>
      <div> 
      <canvas id="bar-chart" width="1500" height="800">
      </canvas>
      </div>
      
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@^3"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment@^2"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@^1"></script>


  <!-- CHARTS -->
  <script>
      const valore1 = <?php echo json_encode($anno_2022); ?>

      const valore2 = <?php echo json_encode($anno_2021); ?>

      const valore3 = <?php echo json_encode($anno_2020); ?>

      const valore4 = <?php echo json_encode($anno_2019); ?>

      const valore5 = <?php echo json_encode($anno_2018); ?>

      const valore6 = <?php echo json_encode($anno_2017); ?>

      const valore7 = <?php echo json_encode($anno_2016); ?>

      const valore8 = <?php echo json_encode($anno_2015); ?>
      
      const mese_22_1 = <?php echo json_encode($anno_2022_mese_January); ?> 

      const mese_22_2 = <?php echo json_encode($anno_2022_mese_February); ?> 
      
      const mese_22_3 = <?php echo json_encode($anno_2022_mese_March); ?> 
      
      const mese_22_4 = <?php echo json_encode($anno_2022_mese_April); ?> 
      
      const mese_22_5 = <?php echo json_encode($anno_2022_mese_May); ?> 
      
      const mese_22_6 = <?php echo json_encode($anno_2022_mese_June); ?> 

      const mese_22_7 = <?php echo json_encode($anno_2022_mese_July); ?> 

      const mese_22_8 = <?php echo json_encode($anno_2022_mese_August); ?> 

      const mese_22_9 = <?php echo json_encode($anno_2022_mese_September); ?> 

      const mese_22_10 = <?php echo json_encode($anno_2022_mese_October); ?> 

      const mese_22_11 = <?php echo json_encode($anno_2022_mese_November); ?> 

      const mese_22_12 = <?php echo json_encode($anno_2022_mese_December); ?> 

      const mese_21_1 = <?php echo json_encode($anno_2021_mese_January); ?> 

      const mese_21_2 = <?php echo json_encode($anno_2021_mese_February); ?> 

      const mese_21_3 = <?php echo json_encode($anno_2021_mese_March); ?> 

      const mese_21_4 = <?php echo json_encode($anno_2021_mese_April); ?> 

      const mese_21_5 = <?php echo json_encode($anno_2021_mese_May); ?> 

      const mese_21_6 = <?php echo json_encode($anno_2021_mese_June); ?> 

      const mese_21_7 = <?php echo json_encode($anno_2021_mese_July); ?> 

      const mese_21_8 = <?php echo json_encode($anno_2021_mese_August); ?> 

      const mese_21_9 = <?php echo json_encode($anno_2021_mese_September); ?> 

      const mese_21_10 = <?php echo json_encode($anno_2021_mese_October); ?> 

      const mese_21_11 = <?php echo json_encode($anno_2021_mese_November); ?> 

      const mese_21_12 = <?php echo json_encode($anno_2021_mese_December); ?> 

      const mese_20_1 = <?php echo json_encode($anno_2020_mese_January); ?> 

      const mese_20_2 = <?php echo json_encode($anno_2020_mese_February); ?> 

      const mese_20_3 = <?php echo json_encode($anno_2020_mese_March); ?> 

      const mese_20_4 = <?php echo json_encode($anno_2020_mese_April); ?> 

      const mese_20_5 = <?php echo json_encode($anno_2020_mese_May); ?> 

      const mese_20_6 = <?php echo json_encode($anno_2020_mese_June); ?> 

      const mese_20_7 = <?php echo json_encode($anno_2020_mese_July); ?> 

      const mese_20_8 = <?php echo json_encode($anno_2020_mese_August); ?> 

      const mese_20_9 = <?php echo json_encode($anno_2020_mese_September); ?> 

      const mese_20_10 = <?php echo json_encode($anno_2020_mese_October); ?> 

      const mese_20_11 = <?php echo json_encode($anno_2020_mese_November); ?> 

      const mese_20_12 = <?php echo json_encode($anno_2020_mese_December); ?> 

      const mese_19_1 = <?php echo json_encode($anno_2019_mese_January); ?> 

      const mese_19_2 = <?php echo json_encode($anno_2019_mese_February); ?> 

      const mese_19_3 = <?php echo json_encode($anno_2019_mese_March); ?> 

      const mese_19_4 = <?php echo json_encode($anno_2019_mese_April); ?> 

      const mese_19_5 = <?php echo json_encode($anno_2019_mese_May); ?> 

      const mese_19_6 = <?php echo json_encode($anno_2019_mese_June); ?> 

      const mese_19_7 = <?php echo json_encode($anno_2019_mese_July); ?> 

      const mese_19_8 = <?php echo json_encode($anno_2019_mese_August); ?> 

      const mese_19_9 = <?php echo json_encode($anno_2019_mese_September); ?> 

      const mese_19_10 = <?php echo json_encode($anno_2019_mese_October); ?> 

      const mese_19_11 = <?php echo json_encode($anno_2019_mese_November); ?> 

      const mese_19_12 = <?php echo json_encode($anno_2019_mese_December); ?> 

      const mese_18_1 = <?php echo json_encode($anno_2018_mese_January); ?> 

      const mese_18_2 = <?php echo json_encode($anno_2018_mese_February); ?> 

      const mese_18_3 = <?php echo json_encode($anno_2018_mese_March); ?> 

      const mese_18_4 = <?php echo json_encode($anno_2018_mese_April); ?> 

      const mese_18_5 = <?php echo json_encode($anno_2018_mese_May); ?> 

      const mese_18_6 = <?php echo json_encode($anno_2018_mese_June); ?> 

      const mese_18_7 = <?php echo json_encode($anno_2018_mese_July); ?> 

      const mese_18_8 = <?php echo json_encode($anno_2018_mese_August); ?> 

      const mese_18_9 = <?php echo json_encode($anno_2018_mese_September); ?> 

      const mese_18_10 = <?php echo json_encode($anno_2018_mese_October); ?> 

      const mese_18_11 = <?php echo json_encode($anno_2018_mese_November); ?> 

      const mese_18_12 = <?php echo json_encode($anno_2018_mese_December); ?> 
        
      const mese_17_1 = <?php echo json_encode($anno_2017_mese_January); ?> 

      const mese_17_2 = <?php echo json_encode($anno_2017_mese_February); ?> 

      const mese_17_3 = <?php echo json_encode($anno_2017_mese_March); ?> 

      const mese_17_4 = <?php echo json_encode($anno_2017_mese_April); ?> 

      const mese_17_5 = <?php echo json_encode($anno_2017_mese_May); ?> 

      const mese_17_6 = <?php echo json_encode($anno_2017_mese_June); ?> 

      const mese_17_7 = <?php echo json_encode($anno_2017_mese_July); ?> 

      const mese_17_8 = <?php echo json_encode($anno_2017_mese_August); ?> 

      const mese_17_9 = <?php echo json_encode($anno_2017_mese_September); ?> 

      const mese_17_10 = <?php echo json_encode($anno_2017_mese_October); ?> 

      const mese_17_11 = <?php echo json_encode($anno_2017_mese_November); ?> 

      const mese_17_12 = <?php echo json_encode($anno_2017_mese_December); ?>
       
      const mese_16_1 = <?php echo json_encode($anno_2016_mese_January); ?> 

      const mese_16_2 = <?php echo json_encode($anno_2016_mese_February); ?> 

      const mese_16_3 = <?php echo json_encode($anno_2016_mese_March); ?> 

      const mese_16_4 = <?php echo json_encode($anno_2016_mese_April); ?> 

      const mese_16_5 = <?php echo json_encode($anno_2016_mese_May); ?> 

      const mese_16_6 = <?php echo json_encode($anno_2016_mese_June); ?> 

      const mese_16_7 = <?php echo json_encode($anno_2016_mese_July); ?> 

      const mese_16_8 = <?php echo json_encode($anno_2016_mese_August); ?> 

      const mese_16_9 = <?php echo json_encode($anno_2016_mese_September); ?> 

      const mese_16_10 = <?php echo json_encode($anno_2016_mese_October); ?> 

      const mese_16_11 = <?php echo json_encode($anno_2016_mese_November); ?> 

      const mese_16_12 = <?php echo json_encode($anno_2016_mese_December); ?> 
       
      const mese_15_1 = <?php echo json_encode($anno_2015_mese_January); ?> 

      const mese_15_2 = <?php echo json_encode($anno_2015_mese_February); ?> 

      const mese_15_3 = <?php echo json_encode($anno_2015_mese_March); ?> 

      const mese_15_4 = <?php echo json_encode($anno_2015_mese_April); ?> 

      const mese_15_5 = <?php echo json_encode($anno_2015_mese_May); ?> 

      const mese_15_6 = <?php echo json_encode($anno_2015_mese_June); ?> 

      const mese_15_7 = <?php echo json_encode($anno_2015_mese_July); ?> 

      const mese_15_8 = <?php echo json_encode($anno_2015_mese_August); ?> 

      const mese_15_9 = <?php echo json_encode($anno_2015_mese_September); ?> 

      const mese_15_10 = <?php echo json_encode($anno_2015_mese_October); ?> 

      const mese_15_11 = <?php echo json_encode($anno_2015_mese_November); ?> 

      const mese_15_12 = <?php echo json_encode($anno_2015_mese_December); ?>

      const ctx = $("#bar-chart");

      const mese =['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];

      const giorno = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];

      const data = {
        
        datasets: [
          {
            label: "Visualizzazioni",
            data: [
              {id: 'year', financials:
                {
                  2022: { gennaio:mese_22_1, febbraio:mese_22_2, marzo:mese_22_3, aprile:mese_22_4, maggio:mese_22_5, giugno:mese_22_6, luglio:mese_22_7, agosto:mese_22_8, settembre:mese_22_9, ottombre:mese_22_10, novembre:mese_22_11, dicembre:mese_22_12}
                }
              }
            ] ,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)'
            ],
              borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
              ],
              borderWidth: 1
  }]
      };
 
 
      const chart1 = new Chart(ctx, {
        type: "bar",
        data: data,
        options: {
          plugins: {
            title: {
                display: true,
                text: 'Chart.js'
            }
        },
          labels: {
            x: {
              type: 'time',
              time: {
                unit: 'day'
              }
            },
            y: {
              beginAtZero: true
            }
          }
        },
      });

  function aggiorm(prova) {

        if(prova.value === 'gennaio'){
          chart1.config.data.datasets[0].data = mese_22_1
          chart1.config.data.labels = giorno 
        }
        if(prova.value === 'febbraio'){
          chart1.config.data.datasets[0].data = mese_22_2
          chart1.config.data.labels = giorno 
        }
        if(prova.value === 'marzo'){
          chart1.config.data.datasets[0].data = mese_22_3
          chart1.config.data.labels = giorno 
        } 
        if(prova.value === 'aprile'){
          chart1.config.data.datasets[0].data = mese_22_4
          chart1.config.data.labels = giorno 
        }
        if(prova.value === 'maggio'){
          chart1.config.data.datasets[0].data = mese_22_5
          chart1.config.data.labels = giorno 
        }
        if(prova.value === 'giugno'){
          chart1.config.data.datasets[0].data = mese_22_6
          chart1.config.data.labels = giorno 
        }        
        if(prova.value === 'luglio'){
          chart1.config.data.datasets[0].data = mese_22_7
          chart1.config.data.labels = giorno 
        }
        if(prova.value === 'agosto'){
          chart1.config.data.datasets[0].data = mese_22_8
          chart1.config.data.labels = giorno 
        }
        if(prova.value === 'settembre'){
          chart1.config.data.datasets[0].data = mese_22_9
          chart1.config.data.labels = giorno 
        }
        if(prova.value === 'ottobre'){
          chart1.config.data.datasets[0].data = mese_22_10
          chart1.config.data.labels = giorno 
        }
        if(prova.value === 'novembre'){
          chart1.config.data.datasets[0].data = mese_22_11
          chart1.config.data.labels = giorno 
        }
        if(prova.value === 'dicembre'){
          chart1.config.data.datasets[0].data = mese_22_12
          chart1.config.data.labels = giorno 
        }
        chart1.update();
      }
      function aggiora(prova) {
        if(prova.value == '--'){
          chart1.config.data.datasets[0].data = pr
          chart1.config.data.labels = pr
        }if(prova.value === '2022'){
          chart1.config.data.datasets[0].data = valore1
          chart1.config.data.labels = mese 
        }if(prova.value === '2021'){
          chart1.config.data.datasets[0].data = valore2
          chart1.config.data.labels = mese 
        }if(prova.value === '2020'){
          chart1.config.data.datasets[0].data = valore3
          chart1.config.data.labels = mese 
        }if(prova.value === '2019'){
          chart1.config.data.datasets[0].data = valore4
          chart1.config.data.labels = mese 
        }if(prova.value === '2018'){
          chart1.config.data.datasets[0].data = valore5
          chart1.config.data.labels = mese 
        }if(prova.value === '2017'){
          chart1.config.data.datasets[0].data = valore6
          chart1.config.data.labels = mese 
        }if(prova.value === '2016'){
          chart1.config.data.datasets[0].data = valore7
          chart1.config.data.labels = mese 
        }if(prova.value === '2015'){
          chart1.config.data.datasets[0].data = valore8
          chart1.config.data.labels = mese 
        }
        chart1.update();
      }
</script>
@endsection