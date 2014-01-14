<html>
<!--
      ___                       ___           ___           ___     
     /\  \          ___        /\__\         /\  \         /\  \    
    /::\  \        /\  \      /:/  /        /::\  \       /::\  \   
   /:/\:\  \       \:\  \    /:/  /        /:/\:\  \     /:/\:\  \  
  /::\~\:\  \      /::\__\  /:/__/  ___   /::\~\:\  \   /::\~\:\  \ 
 /:/\:\ \:\__\  __/:/\/__/  |:|  | /\__\ /:/\:\ \:\__\ /:/\:\ \:\__\
 \/_|::\/:/  / /\/:/  /     |:|  |/:/  / \:\~\:\ \/__/ \/_|::\/:/  /
    |:|::/  /  \::/__/      |:|__/:/  /   \:\ \:\__\      |:|::/  / 
    |:|\/__/    \:\__\       \::::/__/     \:\ \/__/      |:|\/__/  
    |:|  |       \/__/        ~~~~          \:\__\        |:|  |    
     \|__|                                   \/__/         \|__|    

By David Hariri, 2014
http://www.dhariri.com
-->
<head>
    <title>River</title>
    <!-- So Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="styles/normal.css">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
    <link rel="stylesheet" type="text/css" href="styles/stroll.css">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <!-- Scripts -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/stroll.js"></script>
    <script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <!-- Humans -->
    <link rel="author" href="humans.txt">
</head>
<body>
    <div class="stats">
        <div class="stats-box">
        </div>
    </div>
    <ul id="content" class="posts flip">
        <div class="loading"></div>
    </ul>
</body>

<script type="text/javascript">

$('.stats').click(function() {
    if($(this).height() > 50) {
        $(this).removeClass('open').addClass('closed');
    } else {
        $(this).removeClass('closed').addClass('open');
    }
});

$(document).ready(function() {
    $('#content').load("views/feed.php", function() {
        $( this ).hide().fadeIn('slow');

        //Prevent mobile from loading unneccesarily
        if($(window).width() > 600) {
            stroll.bind( 'ul' );

            $.getJSON( "data/stats.php", function( data ) {
                var serviceVals = [];
                var categoryVals = [];

                $.each( data[0], function( key, val ) {
                    //Service Data
                    serviceVals.push ( val );
                });

                $.each( data[1], function( key, val ) {
                    //Category Data
                    categoryVals.push ( val );
                });

                var serviceData = [serviceVals];
                var categoryData = [categoryVals];

                var m = 10,
                    r = 100,
                    z = d3.scale.category20c();

                var svg = d3.select(".stats-box").selectAll("svg")
                .data(serviceData)
                .enter().append("svg:svg")
                .attr("width", (r + m) * 2)
                .attr("height", (r + m) * 2)
                .append("svg:g")
                .attr("transform", "translate(" + (r + m) + "," + (r + m) + ")");

                svg.selectAll("path")
                .data(d3.layout.pie())
                .enter().append("svg:path")
                .attr("d", d3.svg.arc()
                .innerRadius(r / 2)
                .outerRadius(r))
                .style("fill", function(d, i) { 
                    switch(i) {
                        case 0:
                            return "#EA4C89";
                            break;
                        case 1:
                            return "#2ecc71";
                            break;
                        case 2:
                            return "#E1DDD3";
                            break;
                        case 3:
                            return "#55ACEE";
                            break;
                    }
                });
            });
        }
    });
});
</script>
</html>
