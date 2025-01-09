<div>
    <div class="content-header text-lg font-semibold">Dashboard</div>
    <div class="content-body">
        <div class="flex gap-2 mb-4 items-center">
            <div class="w-[50px] text-right mr-1">ปี</div>
            <div class="w-[100px]">
                <select class="form-control" wire:model="selectedYear">
                    @foreach ($yearList as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-[50px] text-right mr-1">เดือน</div>
            <div class="w-[200px]">
                <select class="form-control" wire:model="selectedMonth">
                    @foreach ($monthList as $index => $month)
                        <option value="{{ $index + 1 }}">{{ $month }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-[200px]">
                <button class="btn-info ml-2" wire:click="fetchData">
                    <i class="fa-solid fa-magnifying-glass mr-2"></i>
                    แสดงรายการ
                </button>
            </div>
        </div>
        <div class="flex gap-2 text-right">
            <div class="box-income p-2">
                <div class="font-bold text-sm">
                    <i class="fa-solid fa-coins mr-1"></i>
                    รายได้
                </div>
                <div class="text-2xl">{{ number_format($income) }}</div>
            </div>
            <div class="box-room-fee p-2">
                <div class="font-bold text-sm">
                    <i class="fa-solid fa-bed mr-1"></i>
                    ห้องว่าง
                </div>
                <div class="text-2xl">{{ $roomFee }}</div>
            </div>
            <div class="box-debt p-2">
                <div class="font-bold text-sm">
                    <i class="fa-solid fa-handshake mr-1"></i>
                    ค้างจ่าย
                </div>
                <div class="text-2xl">{{ number_format($debt) }}</div>
            </div>
            <div class="box-pay p-2">
                <div class="font-bold text-sm">
                    <i class="fa-solid fa-dollar-sign mr-1"></i>
                    รายจ่าย
                </div>
                <div class="text-2xl">{{ number_format($pay) }}</div>
            </div>
            <div class="{{ $income - $pay > 0 ? 'box-balance-positive' : 'box-balance-negative' }} p-2">
                <div class="font-bold text-sm">
                    <i class="fa-solid fa-chart-bar mr-1"></i>
                    ผลประกอบการ
                </div>
                <div class="text-2xl">{{ number_format($income - $pay) }}</div>
            </div>
        </div>

        <div class="flex gap-6">
            <div id="incomeChart" class="mt-5 bg-slate-50 p-6 rounded-lg shadow-sm border border-slate-200 w-2/3"></div>
            <div id="pieChart" class="mt-5 bg-slate-50 p-6 rounded-lg shadow-sm border border-slate-200 w-1/3"></div>
        </div>
    </div>
</div>


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('livewire:init', function() {
            // สร้างธีมกลางสำหรับทั้งสองกราฟ
            const commonTheme = {
                chart: {
                    foreColor: '#334155',
                    fontFamily: 'Inter, system-ui, -apple-system, sans-serif',
                    background: '#ffffff',
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800,
                        animateGradually: {
                            enabled: true,
                            delay: 150
                        },
                        dynamicAnimation: {
                            enabled: true,
                            speed: 300
                        }
                    }
                },
                colors: ['#334155', '#64348b', '#94a3b8'],
                title: {
                    style: {
                        fontSize: '24px',
                        fontWeight: '600',
                        color: '#1e293b'
                    },
                    margin: 30
                },
                tooltip: {
                    theme: 'light',
                    style: {
                        fontSize: '14px'
                    },
                    y: {
                        formatter: function(value) {
                            return value.toLocaleString('th-TH') + ' บาท';
                        }
                    }
                }
            };

            // กราฟแท่งรายได้รายเดือน
            const barOptions = {
                ...commonTheme,
                chart: {
                    ...commonTheme.chart,
                    type: 'bar',
                    height: 400,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'รายได้',
                    data: @json(array_values($incomeInMonths))
                }],
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '45%',
                        distributed: false,
                        rangeBarOverlap: true,
                        dataLabels: {
                            position: 'top'
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val.toLocaleString('th-TH') + ' ฿';
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '13px',
                        colors: ['#475561'],
                        fontWeight: '500'
                    }
                },
                xaxis: {
                    categories: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.',
                        'ต.ค.', 'พ.ย.', 'ธ.ค.'
                    ],
                    labels: {
                        style: {
                            fontSize: '13px',
                            fontWeight: '500'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return val.toLocaleString('th-TH') + ' ฿';
                        },
                        style: {
                            fontSize: '13px'
                        }
                    }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 5,
                    padding: {
                        top: 20,
                        right: 15,
                        bottom: 0,
                        left: 15
                    }
                },
                states: {
                    hover: {
                        filter: {
                            type: 'darken',
                            value: 0.9
                        }
                    }
                },
                title: {
                    text: 'รายได้รายเดือน',
                    align: 'center'
                }
            };

            // กราฟวงกลมแสดงสัดส่วน
            const pieOptions = {
                ...commonTheme,
                chart: {
                    ...commonTheme.chart,
                    type: 'donut',
                    height: 400
                },
                series: @json($incomePie),
                labels: ['รายวัน', 'รายเดือน'],
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            background: 'transparent',
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '16px',
                                    offsetY: 0
                                },
                                value: {
                                    show: true,
                                    fontSize: '20px',
                                    fontWeight: '600',
                                    formatter: function(val) {
                                        return val.toLocaleString('th-TH') + ' ฿';
                                    }
                                },
                                total: {
                                    show: true,
                                    label: 'รายได้ทั้งหมด',
                                    fontSize: '16px',
                                    fontWeight: '600',
                                    formatter: function(w) {
                                        const total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        return total.toLocaleString('th-TH') + ' ฿';
                                    }
                                }
                            }
                        }
                    }
                },
                stroke: {
                    show: false
                },
                legend: {
                    position: 'bottom',
                    fontSize: '14px',
                    fontWeight: '500',
                    markers: {
                        width: 10,
                        height: 10,
                        radius: 5
                    },
                    itemMargin: {
                        horizontal: 15
                    }
                },
                title: {
                    text: 'สัดส่วนรายได้ตามประเภท',
                    align: 'center'
                }
            };

            // สร้างกราฟ
            new ApexCharts(document.querySelector("#incomeChart"), barOptions).render();
            new ApexCharts(document.querySelector("#pieChart"), pieOptions).render();
        });
    </script>
@endpush
