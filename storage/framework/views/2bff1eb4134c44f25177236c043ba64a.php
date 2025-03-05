<script>
    
    // sale chart
var options = {
    series: [
        {
            data: [
                <?php $__currentLoopData = $numberRoomInWeek; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($item['value']); ?>,
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ],
        },
    ],
    chart: {
        height: 350,
        type: "bar",
        toolbar: {
            show: false,
        },
        events: {
            click: function (chart, w, e) {},
        },
    },
    colors: ["#f34451"],
    plotOptions: {
        bar: {
            columnWidth: "40%",
            distributed: true,
            startingShape: "rounded",
            endingShape: "rounded",
        },
    },
    dataLabels: {
        enabled: false,
    },
    legend: {
        show: false,
    },
    xaxis: {
        categories: [
            <?php $__currentLoopData = $numberRoomInWeek; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    "<?php echo e($item['thu']); ?>",
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ],
        labels: {
            style: {
                fontSize: "12px",
                fontFamily: "Roboto, sans-serif",
            },
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
    },
    responsive: [
        {
            breakpoint: 576,
            options: {
                chart: {
                    height: 200,
                },
            },
        },
    ],
};

var chart = new ApexCharts(document.querySelector("#sale-chart"), options);
chart.render();
</script><?php /**PATH D:\Lập Trình Web PHP NC\Project_Laravel\Web_QL_PhongTro_L10\resources\views/js/chartDashboard.blade.php ENDPATH**/ ?>