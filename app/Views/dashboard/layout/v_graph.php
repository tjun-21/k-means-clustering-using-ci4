<!-- chart js  -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            labels: [
                <?php foreach ($graph as $j) {
                    echo "'" . $j['barang_nama'] . "',";
                } ?>
            ],
            datasets: [{
                label: 'Barang Berdasarkan Jenis',
                data: [<?php foreach ($graph as $j) {
                            echo "'" . $j['the_count'] . "',";
                        } ?>],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>