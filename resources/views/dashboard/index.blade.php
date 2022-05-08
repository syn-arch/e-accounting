@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
 <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5
                                class="card-title text-primary"
                            >
                                Welcome Back {{auth()->user()->name}}!
                            </h5>
                            <p class="mb-4">
                                You have done
                                <span class="fw-bold"
                                    >{{$transactions_today}}</span
                                >
                                more transactions today. Check
                                in the transactions table to see more details.
                            </p>
                        </div>
                    </div>
                    <div
                        class="col-sm-5 text-center text-sm-left"
                    >
                        <div
                            class="card-body pb-0 px-0 px-md-4"
                        >
                            <img
                                src="/sneat/assets/img/illustrations/man-with-laptop-light.png"
                                height="140"
                                alt="View Badge User"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div
                    class="col-lg-6 col-md-12 col-6 mb-4"
                >
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="card-title d-flex align-items-start justify-content-between"
                            >
                                <div
                                    class="avatar flex-shrink-0"
                                >
                                    <img
                                        src="/sneat/assets/img/icons/unicons/chart-success.png"
                                        alt="chart success"
                                        class="rounded"
                                    />
                                </div>
                            </div>
                            <span
                                class="fw-semibold d-block mb-1"
                                >Categories</span
                            >
                            <h3 class="card-title mb-2">
                                {{$categories}}
                            </h3>
                        </div>
                    </div>
                </div>
                <div
                    class="col-lg-6 col-md-12 col-6 mb-4"
                >
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="card-title d-flex align-items-start justify-content-between"
                            >
                                <div
                                    class="avatar flex-shrink-0"
                                >
                                    <img
                                        src="/sneat/assets/img/icons/unicons/wallet-info.png"
                                        alt="Credit Card"
                                        class="rounded"
                                    />
                                </div>
                            </div>
                            <span>Users</span>
                            <h3
                                class="card-title text-nowrap mb-1"
                            >
                                {{$users}}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Revenue -->
        <div
            class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4"
        >
            <div class="card">
                <div class="row row-bordered g-0">
                    <div class="col-md-12">
                        <h5
                            class="card-header m-0 me-2 pb-3"
                        >
                            Total Income {{date('Y')}}
                        </h5>
                        <div
                            id="totalRevenueChart"
                            class="px-2"
                        ></div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Total Revenue -->
        <div
            class="col-12 col-md-8 col-lg-4 order-3 order-md-2"
        >
            <div class="row">
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="card-title d-flex align-items-start justify-content-between"
                            >
                                <div
                                    class="avatar flex-shrink-0"
                                >
                                    <img
                                        src="/sneat/assets/img/icons/unicons/paypal.png"
                                        alt="Credit Card"
                                        class="rounded"
                                    />
                                </div>
                            </div>
                            <span class="d-block mb-1"
                                >Accounts</span
                            >
                            <h3
                                class="card-title text-nowrap mb-2"
                            >
                                {{$accounts}}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="card-title d-flex align-items-start justify-content-between"
                            >
                                <div
                                    class="avatar flex-shrink-0"
                                >
                                    <img
                                        src="/sneat/assets/img/icons/unicons/cc-primary.png"
                                        alt="Credit Card"
                                        class="rounded"
                                    />
                                </div>
                            </div>
                            <span
                                class="fw-semibold d-block mb-1"
                                >Transactions</span
                            >
                            <h3 class="card-title mb-2">
                                {{$transactions}}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="d-flex justify-content-between flex-sm-row flex-column gap-3"
                            >
                                <div
                                    class="d-flex flex-sm-column flex-row align-items-start justify-content-between"
                                >
                                    <div
                                        class="card-title"
                                    >
                                        <h5
                                            class="text-nowrap mb-2"
                                        >
                                            Total Expense
                                        </h5>
                                        <span
                                            class="badge bg-label-warning rounded-pill"
                                            >Year
                                            {{date('Y')}}</span
                                        >
                                    </div>
                                    <div
                                        class="mt-sm-auto"
                                    >
                                        <h3
                                            class="mb-0"
                                        >
                                            {{number_format($total_expense)}}
                                        </h3>
                                    </div>
                                </div>
                                <div
                                    id="profileReportChart"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
       /**
         * Dashboard Analytics
         */

        'use strict';

        (function () {
        let cardColor, headingColor, axisColor, shadeColor, borderColor;

        cardColor = config.colors.white;
        headingColor = config.colors.headingColor;
        axisColor = config.colors.axisColor;
        borderColor = config.colors.borderColor;

        // Total Revenue Report Chart - Bar Chart
        // --------------------------------------------------------------------
        const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
            totalRevenueChartOptions = {
            series: [
                {
                name: '2022',
                data: {!! json_encode($income_chart_value) !!},
                },
            ],
            chart: {
                height: 300,
                stacked: true,
                type: 'bar',
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                horizontal: false,
                columnWidth: '33%',
                borderRadius: 12,
                startingShape: 'rounded',
                endingShape: 'rounded'
                }
            },
            colors: [config.colors.primary, config.colors.info],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 6,
                lineCap: 'round',
                colors: [cardColor]
            },
            legend: {
                show: true,
                horizontalAlign: 'left',
                position: 'top',
                markers: {
                height: 8,
                width: 8,
                radius: 12,
                offsetX: -3
                },
                labels: {
                colors: axisColor
                },
                itemMargin: {
                horizontal: 10
                }
            },
            grid: {
                borderColor: borderColor,
                padding: {
                top: 0,
                bottom: -8,
                left: 20,
                right: 20
                }
            },
            xaxis: {
                categories: {!! json_encode($income_chart_label) !!},
                labels: {
                style: {
                    fontSize: '13px',
                    colors: axisColor
                }
                },
                axisTicks: {
                show: false
                },
                axisBorder: {
                show: false
                }
            },
            yaxis: {
                labels: {
                style: {
                    fontSize: '13px',
                    colors: axisColor
                }
                }
            },
            responsive: [
                {
                breakpoint: 1700,
                options: {
                    plotOptions: {
                    bar: {
                        borderRadius: 10,
                        columnWidth: '32%'
                    }
                    }
                }
                },
                {
                breakpoint: 1580,
                options: {
                    plotOptions: {
                    bar: {
                        borderRadius: 10,
                        columnWidth: '35%'
                    }
                    }
                }
                },
                {
                breakpoint: 1440,
                options: {
                    plotOptions: {
                    bar: {
                        borderRadius: 10,
                        columnWidth: '42%'
                    }
                    }
                }
                },
                {
                breakpoint: 1300,
                options: {
                    plotOptions: {
                    bar: {
                        borderRadius: 10,
                        columnWidth: '48%'
                    }
                    }
                }
                },
                {
                breakpoint: 1200,
                options: {
                    plotOptions: {
                    bar: {
                        borderRadius: 10,
                        columnWidth: '40%'
                    }
                    }
                }
                },
                {
                breakpoint: 1040,
                options: {
                    plotOptions: {
                    bar: {
                        borderRadius: 11,
                        columnWidth: '48%'
                    }
                    }
                }
                },
                {
                breakpoint: 991,
                options: {
                    plotOptions: {
                    bar: {
                        borderRadius: 10,
                        columnWidth: '30%'
                    }
                    }
                }
                },
                {
                breakpoint: 840,
                options: {
                    plotOptions: {
                    bar: {
                        borderRadius: 10,
                        columnWidth: '35%'
                    }
                    }
                }
                },
                {
                breakpoint: 768,
                options: {
                    plotOptions: {
                    bar: {
                        borderRadius: 10,
                        columnWidth: '28%'
                    }
                    }
                }
                },
                {
                breakpoint: 640,
                options: {
                    plotOptions: {
                    bar: {
                        borderRadius: 10,
                        columnWidth: '32%'
                    }
                    }
                }
                },
                {
                breakpoint: 576,
                options: {
                    plotOptions: {
                    bar: {
                        borderRadius: 10,
                        columnWidth: '37%'
                    }
                    }
                }
                },
                {
                breakpoint: 480,
                options: {
                    plotOptions: {
                    bar: {
                        borderRadius: 10,
                        columnWidth: '45%'
                    }
                    }
                }
                },
                {
                breakpoint: 420,
                options: {
                    plotOptions: {
                    bar: {
                        borderRadius: 10,
                        columnWidth: '52%'
                    }
                    }
                }
                },
                {
                breakpoint: 380,
                options: {
                    plotOptions: {
                    bar: {
                        borderRadius: 10,
                        columnWidth: '60%'
                    }
                    }
                }
                }
            ],
            states: {
                hover: {
                filter: {
                    type: 'none'
                }
                },
                active: {
                filter: {
                    type: 'none'
                }
                }
            }
            };
        if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
            const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
            totalRevenueChart.render();
        }

        // Profit Report Line Chart
        // --------------------------------------------------------------------
        const profileReportChartEl = document.querySelector('#profileReportChart'),
            profileReportChartConfig = {
            chart: {
                height: 80,
                // width: 175,
                type: 'line',
                toolbar: {
                show: false
                },
                dropShadow: {
                enabled: true,
                top: 10,
                left: 5,
                blur: 3,
                color: config.colors.warning,
                opacity: 0.15
                },
                sparkline: {
                enabled: true
                }
            },
            grid: {
                show: false,
                padding: {
                right: 8
                }
            },
            colors: [config.colors.warning],
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 5,
                curve: 'smooth'
            },
            series: [
                {
                data: {!! json_encode($expense_chart_value) !!},
                }
            ],
            xaxis: {
                show: false,
                lines: {
                show: false
                },
                labels: {
                show: false
                },
                axisBorder: {
                show: false
                }
            },
            yaxis: {
                show: false
            }
            };
        if (typeof profileReportChartEl !== undefined && profileReportChartEl !== null) {
            const profileReportChart = new ApexCharts(profileReportChartEl, profileReportChartConfig);
            profileReportChart.render();
        }
        })();
    </script>
@endpush
