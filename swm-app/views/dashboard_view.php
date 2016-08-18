<?php
defined('BASEPATH') OR exit('No direct script access allowed');

switch ($screen):
    case 'dashboard':
?>
                <header class="row">
                    <div class="small-5 columns"><h2>Dashboard</h2></div>
                    <div class="small-7 columns text-right"><small><a class="" href="<?php echo base_url('index.php/users/edit/'.get_session('user_id')); ?>">Seja bem vido, <?php echo get_session('user_name'); ?></a></small></div>
                </header>
                <article class="row">
<div style="width:400px !important; height:300px !important;"><canvas id="myChart" ></canvas></div>

<script>
window.onload = function(){
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                label: '# of Votes',
                data: [30, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            cutoutPercentage: 80,
            legend:{
                display: false
            },
            tooltip: {
                enabled: false
            }
        }
    });
}
</script>    


                </article>

<?php
        break;
endswitch;