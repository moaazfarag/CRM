
      <footer class="no-print">
          &copy; برمجة و تطوير شركة
          <a href="http://www.clickfordata.net/">
              <strong>
                  ClickForData
              </strong>
              {{ 'معالجة في'. round(microtime(true) - LARAVEL_START,2) .'ثانية '}}

          </a>
      </footer>
      <!-- DEMO [REMOVE IT ON PRODUCTION] -->
      {{--{{ HTML::script('dashboard/assets/_con/js/_demo.js') }}--}}
      <script src='https://www.google.com/recaptcha/api.js'></script>

      <!-- jQuery -->
      {{ HTML::script('dashboard/assets/jquery/jquery.min.js') }}
      {{--<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>--}}
      {{--<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>--}}

      <!-- jQuery RAF (improved animation performance) -->
      {{ HTML::script('dashboard/assets/jqueryRAF/jquery.requestAnimationFrame.min.js') }}

      <!-- nanoScroller -->
      {{ HTML::script('dashboard/assets/nanoScroller/jquery.nanoscroller.min.js') }}

      <!-- Materialize -->
      {{ HTML::script('dashboard/assets/materialize/js/materialize.min.js') }}


      <!-- Flot -->
      {{ HTML::script('dashboard/assets/flot/jquery.flot.min.js') }}
      {{ HTML::script('dashboard/assets/flot/jquery.flot.time.min.js') }}
      {{ HTML::script('dashboard/assets/flot/jquery.flot.pie.min.js') }}
      {{ HTML::script('dashboard/assets/flot/jquery.flot.tooltip.min.js') }}
      {{ HTML::script('dashboard/assets/flot/jquery.flot.categories.min.js') }}
      <!-- Sortable -->
      {{ HTML::script('dashboard/assets/sortable/Sortable.min.js') }}
            <!-- Main -->
      {{ HTML::script('dashboard/assets/_con/js/_con.min.js') }}

                {{ HTML::script('dashboard/assets/dataTables/js/jquery.dataTables.min.js') }}
      <!-- Google Prettify -->
      {{ HTML::script('dashboard/assets/google-code-prettify/prettify.js') }}
      {{ HTML::script('dashboard/assets/dataTables/extensions/TableTools/js/dataTables.tableTools.min.js') }}
      {{ HTML::script('dashboard/assets/pikaday/pikaday.js') }}
      {{ HTML::script('dashboard/assets/pikaday/pikaday.jquery.js') }}
      {{ HTML::script('dashboard/assets/select2/js/select2.full.min.js') }}
      {{ HTML::script('dashboard/assets/angular.min.js') }}
      {{ HTML::script('dashboard/assets/ckeditor/ckeditor.js') }}
      {{ HTML::script('dashboard/scripts/app.js') }}
      {{ HTML::script('dashboard/scripts/itemService.js') }}
      {{ HTML::script('dashboard/scripts/mainCtrl.js') }}
      {{ HTML::script('dashboard/scripts/employeeCtrl.js') }}
      {{ HTML::script('dashboard/scripts/employeeService.js') }}
      {{ HTML::script('dashboard/scripts/accountService.js') }}
      {{ HTML::script('dashboard/scripts/accountCtrl.js') }}
      {{ HTML::script('dashboard/scripts/select_model.js') }}
      {{ HTML::script('dashboard/scripts/required_msg.js') }}
      {{ HTML::script('dashboard/scripts/angular-sanitize.js') }}
      {{ HTML::script('dashboard/scripts/massautocomplete.min.js') }}
      <script type="text/javascript">
          $(document).ready(function(){
              $('#select_all').on('click',function(){
                  if(this.checked){
                      $('.checkbox').each(function(){
                          this.checked = true;
                      });
                  }else{
                      $('.checkbox').each(function(){
                          this.checked = false;
                      });
                  }
              });

              $('.checkbox').on('click',function(){
                  if($('.checkbox:checked').length == $('.checkbox').length){
                      $('#select_all').prop('checked',true);
                  }else{
                      $('#select_all').prop('checked',false);
                  }
              });
          });
      </script>
      <script>
          CKEDITOR.replace( 'ckeditor1' );
          CKEDITOR.inline( 'ckeditora' );
          CKEDITOR.replace( 'ckeditor2' );
          CKEDITOR.inline( 'ckeditorb' );

      </script>

      <script>

          $(document).ready(function(){
              $("#test_2").click(function(){
                  $("#test2_2").toggle();
              });
          });

          $(document).ready( function() {
              $('#hidden').delay(8000).fadeOut();

          });

          $(document).ready( function() {
              $('#hidden_br').delay(5000).fadeOut();

          });


                $('#table_customers').DataTable({
      "iDisplayLength": 5,
      "bLengthChange": false,
                  "aLengthMenu": [
                      [5, 10, 25, 50, -1],
                      [5, 10, 25, 50, "all"]
                    ],
      "dom": 'Tlfrtip',
                "tableTools": {
                  "sSwfPath": "{{ URL::asset('dashboard/assets/dataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf') }}"
                    ,      "aButtons": [
//                        "copy",
//                        "print",
                         "xls"
                    ]

                }
                });
              </script>
               <script>
                $('#table_expenses').DataTable({
                  "bLengthChange": false,
                  "aLengthMenu": [
                      [5, 10, 25, 50, -1],
                      [5, 10, 25, 50, "all"]
                    ]
                });
              </script>               <script>
                $('#table_supplier').DataTable({
                  "bLengthChange": false,
                  "aLengthMenu": [
                      [5, 10, 25, 50, -1],
                      [5, 10, 25, 50, "all"]
                    ]
                });
              </script>               <script>
                $('#table_partners').DataTable({
                  "bLengthChange": false,
                  "aLengthMenu": [
                      [5, 10, 25, 50, -1],
                      [5, 10, 25, 50, "all"]
                    ]
                });
              </script>               <script>
                $('#table_bank').DataTable({
                  "bLengthChange": false,
                  "aLengthMenu": [
                      [5, 10, 25, 50, -1],
                      [5, 10, 25, 50, "all"]
                    ]
                });
                $('#table_seasons').DataTable({
                    "bLengthChange": false,
                    "aLengthMenu": [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "all"]
                    ]
                });
                $('#table_management').DataTable({
                    "bLengthChange": false,
                    "aLengthMenu": [
                        [100, 10, 25, 50, -1],
                        [5, 10, 25, 50, "all"]
                    ]
                });
                $('#table_view_trans').DataTable({
                    "scrollCollapse": false,
                    "paging": false
                });
              </script>
                      {{ HTML::script('dashboard/assets/dataTables/js/jquery.dataTables.min.js') }}
      <script>


        /*
         * Revenue Line Chart
         */
        (function() {
          var chart = $("#revenueLineChart");
          var dataPhones = {
            data: [[1,1396.49],[2,1223.26],[3,1185.82],[4,1203.58],[5,1028.26],[6,1260.74],[7,1169.33],[8,1068.55],[9,1267.51],[10,1331.9],[11,1065.97],[12,1162.62]],
            idx: 0,
            label: "Phones"
          };
          var dataTablets = {
            data: [[1,1042.49],[2,1096.24],[3,868.09],[4,848.95],[5,1153.2],[6,822.75],[7,857.52],[8,755.9],[9,993.13],[10,1193.1],[11,790.67],[12,937.19]],
            idx: 1,
            label: "Tablets"
          };
          var dataWatches = {
            data: [[1,631.99],[2,585.23],[3,731.48],[4,450.13],[5,592.13],[6,743.91],[7,616.52],[8,570.09],[9,722.23],[10,525.69],[11,563.85],[12,519.79]],
            idx: 2,
            label: "Watches"
          };
          var dataTVs = {
            data: [[1,1131.78],[2,1305.13],[3,1392.68],[4,1055.79],[5,1432.01],[6,1098.6],[7,1280.68],[8,1010.23],[9,1267.37],[10,1447.23],[11,1447.43],[12,1073.42]],
            idx: 3,
            label: "TVs"
          };
          var options = {
            series: {
              lines: {
                show: true,
                lineWidth: 1,
                fill: false
              },
              points: {
                show: true,
                lineWidth: 2,
                radius: 3
              },
              shadowSize: 0,
              stack: true
            },
            grid: {
              hoverable: true,
              clickable: true,
              tickColor: "#f9f9f9",
              borderWidth: 0
            },
            legend: {
              // show: false
              backgroundOpacity: 0,
              labelBoxBorderColor: "#fff",
              labelFormatter: function(label, series){
                return '<a href="#" onClick="togglePlot('+series.idx+'); return false;" style="color: inherit">'+label+'</a>';
              }
            },
            colors: ["#ab47bc", "#5c6bc0", "#26a69a", "#ef5350"],
            xaxis: {
              ticks: [[1, "Jan"], [2, "Feb"], [3, "Mar"], [4,"Apr"], [5,"May"], [6,"Jun"],
                         [7,"Jul"], [8,"Aug"], [9,"Sep"], [10,"Oct"], [11,"Nov"], [12,"Dec"]],
              font: {
                family: "Roboto,sans-serif",
                color: "#A5A5A5"
              }
            },
            yaxis: {
              ticks:7,
              font: {color: "#A5A5A5"}
            }
          };

          var plot;
          function initFlot() {
            plot = $.plot(chart, [dataPhones, dataTablets, dataWatches, dataTVs], options);
            chart.css({
                marginTop: 25
              })
              .find('.legend table')
                .css({
                  marginTop: -35,
                  width: 'auto'
                })
              .find('td').css({
                padding: 5
              })
            chart.find('tr').css({
              display: 'block',
               'float': 'left'
             });
          }
          initFlot();
          $(window).on('resize', initFlot);


          window.togglePlot = function(seriesIdx) {
            var someData = plot.getData();
            someData[seriesIdx].lines.show = !someData[seriesIdx].lines.show;
            someData[seriesIdx].points.show = !someData[seriesIdx].points.show;
            plot.setData(someData);
            plot.draw();
          }

          function showTooltip(x, y, contents) {
            var tooltip = $('<div id="tooltip">' + contents + '</div>').css( {
              position: 'absolute',
              display: 'none',
              top: y - 60,
              color: "#fff",
              padding: '5px 10px',
              marginLeft: '-10px',
              'border-radius': '3px',
              'background-color': 'rgba(0,0,0,0.6)'
            }).appendTo("body");

            tooltip.css({
              left: x - tooltip.width() / 2
            }).fadeIn(200);
          }

          var previousPoint = null;
          chart.bind("plothover", function (event, pos, item) {
            if (item) {
              if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;

                $("#tooltip").remove();
                var x = item.datapoint[0].toFixed(0),
                    y = item.datapoint[1].toFixed(0);

                var month = item.series.xaxis.ticks[item.dataIndex].label;

                showTooltip(item.pageX, item.pageY, month + "<br>" + item.series.label + " : $" + y);
              }
            }
            else {
              $("#tooltip").remove();
              previousPoint = null;
            }
          });
        }());



        /*
         * Revenue Bar Chart
         */
        $(function() {
          var chart = $("#revenueBarChart");
          var data = [
            {data: [["Phones", 1287]], color: "#ab47bc"},
            {data: [["Tablets", 976]], color: "#5c6bc0"},
            {data: [["Watches", 649]], color: "#26a69a"},
            {data: [["TVs", 1389]], color: "#ef5350"}
          ];
          var options = {
            series: {
              bars: {
                show: true,
                barWidth: 0.5,
                lineWidth: 0,
                align: "center",
                fill: 1
              }
            },
            grid: {
              hoverable: true,
              tickColor: "#f9f9f9",
              borderWidth: 0
            },
            xaxis: {
              mode: "categories",
              font: {
                family: "Roboto,sans-serif",
                color: "#A5A5A5"
              }
            },
            yaxis: {
              ticks:7,
              font: {
                family: "Roboto,sans-serif",
                color: "#A5A5A5"
              }
            }
          };

          var plot;
          function initFlot() {
            plot = $.plot(chart, data, options);
            chart.css({
              marginTop: 25
            });
          }
          initFlot();
          $(window).on('resize', initFlot);


          function showTooltip(x, y, contents) {
            var tooltip = $('<div id="tooltip">' + contents + '</div>').css( {
              position: 'absolute',
              display: 'none',
              top: y - 40,
              color: "#fff",
              padding: '5px 10px',
              marginLeft: '-10px',
              'border-radius': '3px',
              'background-color': 'rgba(0,0,0,0.6)'
            }).appendTo("body");

            tooltip.css({
              left: x - tooltip.width() / 2
            }).fadeIn(200);
          }

          var previousPoint = null;
          chart.bind("plothover", function (event, pos, item) {
            if (item) {
              if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;

                $("#tooltip").remove();
                var x = item.datapoint[0].toFixed(0),
                    y = item.datapoint[1].toFixed(0);

                var month = item.series.xaxis.ticks[item.dataIndex].label;

                showTooltip(item.pageX, item.pageY, item.series.data[0][0] + " : $" + y);
              }
            }
            else {
              $("#tooltip").remove();
              previousPoint = null;
            }
          });
        });


        function hide(obj) {

            var el = document.getElementById(obj);

            el.style.display = 'none';

        }
        function show(obj) {

            var el = document.getElementById(obj);

            el.style.display = 'block';

        }
        function changeClass(btn, cls) {
            if(!hasClass(btn, cls)) {
                addClass(btn, cls);
            }
        }
      </script>

      {{--@include('dashboard._flash_msg');--}}






      {{--xmlhttp.open("GET","getuser.php?q="+str,true);--}}


      </body>

    </html>