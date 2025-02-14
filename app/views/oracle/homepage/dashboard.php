<?php
$title = 'Dashboard';
require APPROOT . '/views/inc/header.php';
require APPROOT . '/views/inc/sidebar.php';
?>

<h1 class="text-3xl text-black mb-5 text-white"><b>Dashboard</b></h1>
<div class=" object-contain grid grid-cols-1 2xl:grid-cols-3 xl:grid-cols-2 lg:grid-cols-2 gap-4 cardz place-content-evenly">

  <?php

  $Sessions = $data['Sessions'];
  $FRA = $data['FRA'];
  $FRA_Size = empty($FRA['FRA Size']) ? 'No data' : $FRA['FRA Size'];
  $FRA_Usage = empty($FRA['FRA Usage']) ? 'No data' : $FRA['FRA Usage'];
  $FRA_Percent = empty($FRA['FRA Percentage']) ? '0.0/100.0' : $FRA['FRA Percentage'];
  $DBPerfStatus = $data['DB PerfStatus'];
  $DBInfo = $data['DB Info'];
  $LockedSessions = $data['Locked Sessions'];
  $TempTS = $data['Temp TS'];
  $DBStatus = $data['DB Status'];

  ?>

  <div class="hidden" id="Sessions"><?php echo $Sessions; ?></div>
  <div class="hidden" id="DBPerfStats"><?php echo $DBPerfStatus; ?></div>
  <div class="hidden" id="DBInfoArray"><?php foreach ($DBInfo as $i) {
                                          echo $i . '/';
                                        } ?></div>

  <!--RealLine-->
  <div class="2xl:col-span-2 lg:col-span-1">

    <!--Rename for duplicate: chart1, options1-->
    <div class="w-full h-full p-5 rounded-lg mb-2 box relative">

      <div id="linechart"></div>
      <font id="noData" class="z-10 transition absolute top-1/3 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-2xl text-white font-bold">Loading Sessions...</font>

      <div class="card grid grid-rows-2 gap-2">
        <div class="row-span-1">
          <div class="grid grid-cols-3 cardp">
            <div class="cardb">
              <p>Hostname</p>
              <h1 id="Hostname" title="Hostname"><?php echo $DBInfo['Hostname']; ?></h1>
            </div>
            <div class="cardb">
              <p>IP Address</p>
              <h1 id="IP" title="IP Address"><?php echo $DBInfo['IP Address']; ?></h1>
            </div>
            <div class="cardb">
              <p>DB Size</p>
              <h1 id="Size" title="Database Size"><?php echo $DBInfo['DB SIZE']; ?></h1>
            </div>
          </div>
        </div>

        <div class="row-span-1">
          <div class="grid grid-cols-4 cardp">
            <div class="cardb">
              <p>Total Sessions</p>
              <h1 id="TotalSes" title="Total Sessions">Fetching...</h1>
            </div>
            <div class="cardb">
              <p>Inactive Sessions</p>
              <h1 id="InactiveSes" title="Total Inactive Sessions">Fetching...</h1>
            </div>
            <div class="cardb">
              <p>Active Sessions</p>
              <h1 id="Active_Num" title="Total Active Sessions">Fetching...</h1>
            </div>
            <div class="cardb">
              <p>System Sessions</p>
              <h1 id="SystemSes" title="Total System Sessions">Fetching...</h1>
            </div>
          </div>
        </div>

      </div>

    </div>



    <script>
      // For Show Window
      window.Apex = {
        chart: {
          foreColor: '#fff',
          fontFamily: 'Lexend',
          toolbar: {
            show: true
          },
        },
        colors: ['#0099ff'], //line colors palette; Multiple Series
        stroke: {
          width: 2
        },
        dataLabels: {
          enabled: false
        },
        grid: {
          borderColor: "#fff",
        },
        xaxis: {
          axisTicks: {
            color: '#873e23#'
          },
          axisBorder: {
            color: "##873e23"
          }
        },
        fill: {
          type: 'gradient',
          gradient: {
            gradientToColors: ['#6078ea', '#6094ea']
          },
        },
        tooltip: {
          theme: 'dark',
          x: {
            formatter: function(val) {
              return moment(new Date(val).getTime() - (10 - 1) * 1000).format("hh:mm:ss")
            }
          }
        },
        yaxis: {
          decimalsInFloat: 2,
          opposite: false,
          labels: {
            offsetX: -10
          }
        }
      };

      // For Randomization (Remove in the future)
      var trigoStrength = 3
      var iteration = 11

      function generateMinuteWiseTimeSeries(baseval, count, yrange) {
        var i = 0;
        var series = [];
        while (i < count) {
          var x = baseval;
          var y = 0 //((Math.sin(i / trigoStrength) * (i / trigoStrength) + i / trigoStrength + 1) * (trigoStrength * 2))

          series.push([x, y]);
          baseval += 1000;
          i++;
        }
        return series;
      }

      //15000 = 15 seconds per tick
      var xRange = 1000000; //1000000 equivalent to 5 minutes interval shown on x axis is long; 5000000/1000000/1500000 is 5 minutes but short
      //------------------------------------------- 
      var optionsLine = {
        chart: {
          height: '60%',
          type: 'area',
          id: 'realtime',
          stacked: false,
          animations: {
            enabled: false,
            easing: 'linear',
            dynamicAnimation: {
              enabled: false, // from true to false
              speed: 1000
            },
          },
          //For Multiple Series
          events: {
            animationEnd: function(chartCtx, opts) {
              const newData1 = chartCtx.w.config.series[0].data.slice()
              newData1.shift()

              // check animation end event for just 1 series to avoid multiple updates
              //For Multiple Series
              if (opts.el.node.getAttribute('index') === '0') {
                window.setTimeout(function() {
                  chartCtx.updateOptions({
                    series: [{
                      data: newData1
                    }],
                    subtitle: {
                      text: sessions,
                    },
                  }, false, false)
                }, 1000)
              }

            }
          },
          toolbar: {
            show: false
          },
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth',
          width: 5,
        },
        grid: {
          padding: {
            left: 0,
            right: 0
          }
        },
        markers: {
          size: 0,
          hover: {
            size: 0
          }
        },
        //For Multiple Series
        //initial series range '12' of x
        series: [{
          name: 'Session ',
          data: generateMinuteWiseTimeSeries(new Date().getTime() - (10 - 1) * 1000, 1, {
            min: 10,
            max: 90
          })
        }],
        xaxis: {
          type: 'datetime',
          range: xRange,
          labels: {
            // formatter: function (val) {
            //   return moment(new Date(val)).format("hh:mm")
            // }
            datetimeUTC: false, //finally the fix to the x-axis time problem
            format: 'hh:mm TT'
          }
        },
        title: {
          text: 'Realtime Active Sessions',
          align: 'left',
          style: {
            fontSize: '15px'
          }
        },
        subtitle: {
          text: '',
          floating: true,
          align: 'right',
          offsetY: 0,
          offsetX: 10,
          style: {
            fontSize: '10px'
          }
        },
        legend: {
          show: true,
          floating: true,
          verticalAlign: 'right',
          onItemClick: {
            toggleDataSeries: false
          },
          position: 'top',
          offsetY: -28,
          offsetX: 60
        },
      }

      var chartLine = new ApexCharts(
        document.querySelector("#linechart"),
        optionsLine
      );
      chartLine.render();

      window.setInterval(function() {

        iteration++;

        //For Multiple Series
        if (Sessions != null) {
          chartLine.updateSeries([{
            data: [...chartLine.w.config.series[0].data,
              [
                chartLine.w.globals.maxX + 1000,
                Sessions
              ]
            ]
          }])
          if (Number(Sessions) > highestValue) {
            highestValue = Number(Sessions);
            chartLine.updateOptions({
              subtitle: {
                text: 'Highest Sessions: ' + highestValue
              }
            });
          }
          document.getElementById("noData").style.display = "none";
        } else {
          document.getElementById("noData").style.display = "static";
        }

      }, 1000); //Set speed for chartline push
    </script>
  </div>
  <!--RealLine-->

  <script>
    var Sessions, DBPerfStatus, DBInfo, TotalSes, InactiveSes, SystemSes, highestValue = 0;
    var DBInfoArray, DBPerfArray;

    setInterval(() => {
      $.ajax({
        url: '<?php echo URLROOT.'/homepages/index/'. $_SESSION['HomepageDB']; ?>',
        dataType: 'html',
        success: function(response) {

          Sessions = jQuery(response).find('#Sessions').html();

          DBPerfArray = jQuery(response).find('#DBPerfStats').html();

          DBInfoArray = jQuery(response).find('#DBInfoArray').html();

          DBInfo = DBInfoArray.split('/');
          DBPerfStatus = DBPerfArray.split(',');
          TotalSes = DBInfo[3];
          InactiveSes = DBInfo[4];
          SystemSes = DBInfo[5];

          document.getElementById('DBPerfStatus').innerHTML = DBPerfStatus[1];
          document.getElementById('DBPerfStatus').style.color = DBPerfStatus[0];
          document.getElementById('Active_Num').innerHTML = Sessions === null ? 'Fetching...' : Sessions;
          document.getElementById('TotalSes').innerHTML = TotalSes;
          document.getElementById('InactiveSes').innerHTML = InactiveSes;
          document.getElementById('SystemSes').innerHTML = SystemSes;
        }

      });
    }, 5000); // set interval speed for data refresh
  </script>


  <div class="grid grid-cols-1 lg:grid-rows-2 gap-2 justify-center col-span-1">
    <!--Donuts-->
    <!--Must rename for duplicating: chartDonut1,myChart1, sampleChart1, config1-->
    <!-- <?php $total = explode('/', $FRA_Percent); ?> -->
    <div class="w-full box rounded-lg">
      <div class="grid grid-cols-3 place-center">
        <canvas id="chartDonut" class="col-span-2"></canvas>
        <div class="grid grid-rows-2 h-2/3 col-span-1 z-10 gap-y-6 ">
          <div class="sm-card xl:card">
            <p class="font-bold">Free</p>
            <h1 class="text-xl"><?php echo $total[0]; ?>%</h1>
          </div>
          <div class="sm-card xl:card">
            <p class="font-bold">Used</p>
            <h1 class="text-xl"><?php echo $total[1]; ?> %</h1>
          </div>
        </div>
      </div>

      <script>
        let myChartDonut = document.getElementById('chartDonut').getContext('2d');

        Chart.defaults.font.family = "Lexend";

        new Chart(myChartDonut, {
          type: 'doughnut',
          data: {
            labels: [
              'Free',
              'Used'
            ],
            datasets: [{
              label: 'My First Dataset',
              //Free, Used
              data: [<?php echo $total[0]; ?>, <?php echo $total[1]; ?>],
              backgroundColor: [
                '#339933',
                '<?php echo empty($FRA) ? '#ff3333' : '#66ff33'; ?>'
              ],
              borderColor: [
                '#339933',
                '<?php echo empty($FRA) ? '#ff3333' : '#66ff33'; ?>'
              ],

              hoverOffset: 20,
              borderWidht: 4,
            }]
          },
          options: { //this is where i do changes for chart options, ref: https://www.chartjs.org/docs/latest/configuration/title.html
            layout: {
              padding: {
                right: 10
              },
              autopadding: true
            },
            rotation: 90,
            responsive: false,
            cutout: '30%',
            hoverBorderColor: '#fff',
            plugins: {
              legend: {
                position: 'left',
                align: 'end',
                display: true, //remove the legend
                labels: {
                  color: 'white',
                  textAlign: 'start',
                  boxWidth: 20
                }
              },
              title: {
                display: true,
                text: 'Flash Recovery Area Usage',
                align: 'start',
                color: 'white',
                position: 'top',
                weight: 'bold',
                font: {
                  size: '15%'
                }
              },
              tooltip: {
                position: 'custom',
                callbacks: {
                  label: function(context) {
                    var label = context.label,
                      currentValue = context.raw

                    return label + ": " + currentValue.toFixed(2) + '%)';
                  }
                }
              }
            },
          }
        });
      </script>
    </div>
    <!--Donuts-->

    <!-- DB PerfStatuses -->
    <div id="tabs" class="w-full box rounded-lg text-md justify-center items-center" style="padding: 5px 25px 25px ;">
      <div class="flex justify-center">
        <button id="tabbtn1" onclick="tab1()" class="w-full transition-all rounded-l-full py-2 hover:bg-gray-800 hover:text-white bg-gray-800 z-10 text-white">
          Instance
        </button>
        <button id="tabbtn2" onclick="tab2()" class="w-full transition-all bg-gray-400 rounded-r-full py-2 hover:bg-gray-800 hover:text-white">
          Performance
        </button>
      </div>
      <div id="maindiv" class="relative overflow-hidden">
        <div class="inner absolute relative inline-flex h-full w-full transition duration-500 ease-in-out db-stat rounded-md">
          <div id="tabs-1" class="float-left transition-all static w-full slide-in-left">
            <table>
              <tr title="DB Instance Name">
                <th>DB Instance: </th>
                <td><span><?php echo $DBStatus['DB Name']; ?></span></td>
              </tr>
              <tr title="DB Status">
                <th>DB Status: </th>
                <td><span><?php echo $DBStatus['DB Status']; ?></span></td>
              </tr>
              <tr title="DB Uptime">
                <th>Uptime: </th>
                <td>
                  <span><?php echo $DBStatus['Start Time']; ?></span>
                </td>
              </tr>
              <tr title="Used SGA Size">
                <th>SGA Usage: </th>
                <td>
                  <span><?php echo $DBStatus['Used SGA']; ?></span>
                </td>
              </tr>
              <tr title="Free SGA Size">
                <th>SGA Free: </th>
                <td><span><?php echo $DBStatus['Free SGA']; ?></span></td>
              </tr>
              <tr title="Total SGA Size">
                <th>Total SGA: </th>
                <td>
                  <span><?php echo $DBStatus['Total SGA'];  ?></span>
                </td>
              </tr>
            </table>
          </div>
          <div id="tabs-2" class="float-left transition-all static w-full hidden">
            <table>
              <tr title="Flash Recovery Area Size">
                <th>FRA Size: </th>
                <td><span><?php echo $FRA_Size; ?></span></td>
              </tr>
              <tr title="Flash Recovery Area Usage">
                <th>FRA Usage: </th>
                <td><span><?php echo $FRA_Usage; ?></span></td>
              </tr>
              <tr title="Temp Tablespace Free Size">
                <th>Temp TS Free: </th>
                <td>
                  <?php foreach ($TempTS as $tsarray => $tsfree) { ?>
                    <span><?php echo $tsfree['TEMP FREE']; ?></span>
                    <br>
                  <?php } ?>
                </td>
              </tr>
              <tr title="Temp Tablespace Usage Size">
                <th>Temp TS Usage: </th>
                <td>
                  <?php foreach ($TempTS as $tsarray => $tsused) { ?>
                    <span><?php echo $tsused['TEMP USED']; ?></span>
                    <br>
                  <?php } ?>
                </td>
              </tr>
              <tr title="Total Locked Sessions">
                <th>Locked Session: </th>
                <td><span><?php echo $LockedSessions; ?></span></td>
              </tr>
              <tr title="Database Performance">
                <th>DB Performance: </th>
                <td><span><font id="DBPerfStatus">Fetching...</font></span></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- DB PerfStatuses -->
  </div>

</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>