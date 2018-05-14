<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
    <link id="gridcss" rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/dark-bootstrap/all.min.css" />

    <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
    <script type="text/javascript" src="http://www.prepbootstrap.com/Content/js/gridData.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#cuanti').hide(); //oculto mediante id
            $('.cuanti').hide();
            $('#cuali').hide(); //muestro mediante id
            $('.cuali').hide();
        $("#cualitativo").on( "click", function() {
            $('#cuali').show(); //muestro mediante id
            $('.cuali').show(); //muestro mediante clase
            $('#cuanti').hide(); //oculto mediante id
            $('.cuanti').hide(); //muestro mediante clase
         });
        $("#cuantitativo").on( "click", function() {
            $('#cuali').hide(); //muestro mediante id
            $('.cuali').hide(); //muestro mediante clase
            $('#cuanti').show(); //oculto mediante id
            $('.cuanti').show(); //muestro mediante clase
        });
    });
    </script>