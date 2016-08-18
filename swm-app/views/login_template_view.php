<!doctype html>
<html class="no-js" lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo (isset($the_title)) ? '{the_title} | {title_default}' : '{title_default}'; ?></title>
        <script src="http://openlayers.org/en/v3.16.0/build/ol.js"></script>
        {headerinc}
        <style type="text/css">
            body{background: #252830; color: #E8E8E9;}
            #space{height: 100px;}
            p{font-size: 30px;}
            h2{font-size: 1.6rem;}
            form{border: 1px solid #434857; padding: 15px;}
            label{color: #E8E8E9}
            input[type='submit']{float: right;}
            .callout{padding: 5px; font-size: .8rem;}
            .callout .close-button{margin-top: -5px;}
        </style>
    </head>
    <body>
        {content}
        {footerinc}
    </body>
</html>
