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
</head>
<body>
    <ul id="content" class="posts flip">
        <div class="loading"></div>
    </ul>
</body>

<script>
$(document).ready(function() {
    $('#content').load("views/feed.php", function() {
        $( this ).hide().fadeIn('slow');
        if($(window).width() > 600) {
            stroll.bind( 'ul' );
        }
    });
});
</script>

</html>
