<!doctype html>
<html class="no-js" lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo (isset($the_title)) ? '{the_title} | {title_default}' : '{title_default}'; ?></title>
        <script src="http://openlayers.org/en/v3.16.0/build/ol.js"></script>
        {headerinc}
    </head>
    <body>


        <div id="main" class="row">
            <aside class="small-hide medium-4 large-3 columns">
                <div id="dashboard-logo">
                    <a href="#"><i class="fa fa-map-marker"></i><span>Simple<strong>WebMap</strong></span></a>
                    <small><a href="#">SWM</a></small>
                </div>

                <form id="dashboard-search">
                    <span class="icon"><i class="fa fa-search"></i></span>
                    <input type="search" id="search" placeholder="Search..." />
                </form>



                <ul class="menu vertical">
                    {menu}
                </ul>
            </aside>
            <section class="small-12 medium-8 large-9 columns">
                {content}
            </section>
        </div>

        <footer class="row">
            {footer}
            <p class="text-right">Desenvolvido com <a href="https://github.com/SimpleWebMap/SWM">SimpleWebMap</a></p>
        </footer>
        {footerinc}
    </body>
</html>
