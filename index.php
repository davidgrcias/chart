<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Chart</title>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
  </head>
  <body>
    <canvas id="myChart" style="width:100%;max-width:700px"></canvas>

    <script type="text/javascript">
    <?php
    require 'config.php';
    $cities = mysqli_query($conn, "SELECT * FROM cities");
    foreach($cities as $city){
      $eachcity[] = $city["city"];
      $cityid = $city["id"];
      $eachcitypopulation[] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM people WHERE city_id = $cityid"));
    }
    ?>
      new Chart("myChart", {
        type: "bar",
        data: {
          labels: <?php echo json_encode($eachcity); ?>,
          datasets: [{
            backgroundColor: ["red", "green","blue"],
            data: <?php echo json_encode($eachcitypopulation); ?>
          }]
        },
        options: {
  		    legend: {display: false},
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
              }
            }]
          }
        },
      });
    </script>
  </body>
</html>
