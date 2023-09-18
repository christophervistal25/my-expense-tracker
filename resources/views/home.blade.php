@extends('layouts.app')
@prepend('page-css')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endprepend
@section('page-title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-dark">
                    <div class="card-title text-white">
                        Pie Chart <span class="text-lowercase">of</span> Expenses
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-dark">
                    <div class="card-title text-white">
                        Pie Chart <span class="text-lowercase">of</span> Expenses
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div id="chart-bills"></div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-dark">
                <div class="card-title text-white">
                    Daily Expenses
                </div>
            </div>
            <div class="card-body">
                <div class="col-lg-12">
                    <div id="bar-chart"></div>
                </div>
            </div>
        </div>
    </div>
    @push('page-scripts')
        <script>
            let transactionsCategorized = @json($transactionsCategorized);
            let pieChartLabels = Object.keys(transactionsCategorized);
            let pieChartValues = [];

            Object.values(transactionsCategorized).map((transactions, key) => {
                let totalExpenses = 0;
                transactions.map((transaction) => {
                    totalExpenses += transaction.expense;
                });
                pieChartValues.push(totalExpenses);
            });

            let options = {
                series: pieChartValues,
                chart: {
                    width: 600,
                    type: 'donut',
                    fontFamily: 'Inter'
                },
                dataLabels: {
                    enabled: false,
                },
                labels: pieChartLabels,
                responsive: [{
                    options: {
                        chart: {
                            width: 300
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        </script>


        <script>
            let bills = @json($bills);
            let debts = @json($debts);
            let billPieChartOptions = {
                series: [bills, debts],
                chart: {
                    width: 530,
                    type: 'donut',
                    fontFamily: 'Inter'
                },
                dataLabels: {
                    enabled: false,
                },
                labels: ['BILLS', 'DEBTS'],
                responsive: [{
                    options: {
                        chart: {
                            width: 300
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            let chartBills = new ApexCharts(document.querySelector("#chart-bills"), billPieChartOptions);
            chartBills.render();
        </script>

        <script>
            let transactionsGrouppedByDate = @json($transactionsGrouppedByDate);
            let barChartValues = [];
            Object.values(transactionsGrouppedByDate).map((transactions, key) => {
                let totalBarChart = 0;
                transactions.map((value, key) => {
                    totalBarChart += value.expense;
                });
                barChartValues.push(totalBarChart);
            });
            let barChartOptions = {
                series: [{
                    name: 'Expenses',
                    data: barChartValues,
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return `${parseFloat(val).toFixed(2)}`;
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },

                xaxis: {
                    categories: Object.keys(transactionsGrouppedByDate),
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#D8E3F0',
                                colorTo: '#BED1E6',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function(val) {
                            return "PHP: " + parseFloat(val).toFixed(2);
                        }
                    }

                },
                title: {
                    text: 'Daily Expenses',
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                }
            };

            let barChart = new ApexCharts(document.querySelector("#bar-chart"), barChartOptions);
            barChart.render();
        </script>
    @endpush
@endsection
