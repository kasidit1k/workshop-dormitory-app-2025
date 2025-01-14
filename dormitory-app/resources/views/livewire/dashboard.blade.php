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
                <button class="btn-info ml-2" wire:click="loadNewData">
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
            var incomeChart = null;
            var pieChart = null;

            function initIncomeChart() {
                const options = {
                    chart: {
                        type: 'bar',
                        height: 350,
                        toolbar: {
                            show: true,
                            tools: {
                                download: true,
                                selection: false,
                                zoom: false,
                                zoomin: false,
                                zoomout: false,
                                pan: false,
                            }
                        },
                        fontFamily: 'Sarabun, sans-serif'
                    },
                    series: [{
                        name: 'รายได้',
                        data: @json(array_values($incomeInMonths))
                    }],
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            columnWidth: '60%',
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
                            fontSize: '12px',
                            colors: ["#304758"]
                        }
                    },
                    xaxis: {
                        categories: [
                            'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.',
                            'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'
                        ],
                        position: 'bottom',
                        labels: {
                            style: {
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(val) {
                                return val.toLocaleString('th-TH') + ' ฿';
                            },
                            style: {
                                fontSize: '12px'
                            }
                        }
                    },
                    title: {
                        text: 'รายได้รายเดือน ประจำปี ' + new Date().getFullYear(),
                        align: 'center',
                        style: {
                            fontSize: '16px',
                            fontWeight: 'bold'
                        }
                    },
                    colors: ['#2E5CB8'],
                    grid: {
                        borderColor: '#E9ECEF',
                        strokeDashArray: 4
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val.toLocaleString('th-TH') + ' บาท';
                            }
                        }
                    }
                };

                incomeChart = new ApexCharts(document.querySelector('#incomeChart'), options);
                incomeChart.render();
            }

            function initPieChart() {
                const pieOptions = {
                    series: @json(array_values($incomePie)),
                    chart: {
                        type: 'pie',
                        height: 350,
                        fontFamily: 'Sarabun, sans-serif'
                    },
                    labels: ['รายวัน', 'รายเดือน'],
                    title: {
                        text: 'สัดส่วนรายได้แยกตามประเภท',
                        align: 'center',
                        style: {
                            fontSize: '16px',
                            fontWeight: 'bold'
                        }
                    },
                    colors: ['#4B7BE5', '#6259CA'],
                    legend: {
                        position: 'bottom',
                        fontSize: '14px'
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(val) {
                            return val.toFixed(1) + "%"
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val.toLocaleString('th-TH') + ' บาท';
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 480,
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

                pieChart = new ApexCharts(document.querySelector('#pieChart'), pieOptions);
                pieChart.render();
            }

            initIncomeChart();
            initPieChart();

            // อัพเดทกราฟเมื่อข้อมูลเปลี่ยนแปลง
            Livewire.on('updateCharts', (data) => {
                if (incomeChart) {
                    incomeChart.updateSeries([{
                        data: data.incomeInMonths
                    }]);
                }
                if (pieChart) {
                    pieChart.updateSeries(data.incomePie);
                }
            });
        });
    </script>
@endpush
