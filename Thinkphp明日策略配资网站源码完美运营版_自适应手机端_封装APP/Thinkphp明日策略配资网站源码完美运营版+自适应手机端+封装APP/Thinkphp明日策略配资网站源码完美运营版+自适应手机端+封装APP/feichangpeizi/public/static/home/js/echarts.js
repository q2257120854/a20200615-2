define(["echarts"], function (echarts) {
    var c_width,c_height;
    return {
        chartLine: {
            chart: undefined,
            init: function (selector, json, full) {
                if (!json || !json.records)
                    return false;
                if (this.chart) {
                    this.chart.clear();
                    //释放非托管资源？
                    this.chart.dispose();
                    this.chart = undefined;
                }
                //找到html元素#chart
                var myChart = echarts.init($(selector).get(0));
                
                var xdata = [], ydata = [];
                var ymin, ymax;   
                //遍历数据，json.records是毫秒数+价格
                
                $.each(json.records, function (i, n) {//第一次   i = 0, n = [1500341400000, 6.45]
                    if (i == 0) {
                        ymin = ymax = n[1];  //ymin = ymax=6.45
                    }
                    xdata.push(n[0])//xdata=1500341400000，1500341400011
                    //比较找出最小价格和最大价格
                    ymin = ymin > n[1] ? n[1] : ymin;
                    ymax = ymax < n[1] ? n[1] : ymax;
                    ydata.push(n[1]);//ydata=6.45，6.46
                });
                //这时xdata是一个数组，里面是毫秒数；ydata是价格的数组
                var a = ymin, b = json.y_close, c = ymax;
                //a是最小价格，b是收盘价，c是最大价格
                var ab = Math.abs(b - a);//高峰线
                var cb = Math.abs(c - b);//低谷线

                var speed = ab > cb ? ab : cb;//中心线
                //console.log(speed, b);
                var min = a > b ? (b > c ? c : b) : a;
                
                if (a >= b && c >= b)//？？
                    min = min - speed;
                //ymin = 0;
                //ymax = speed * 2;
                ymin = json.y_close - speed * 1.2;
                ymax = (+json.y_close) + speed * 1.2;
                for (var i = 0; i < ydata.length; i++) {
                    //ydata[i] = ydata[i] - min
                }
                full = full || 242;
                for (var i = 0; i < full - xdata.length; i++) {
                    xdata.push("-");
                    ydata.push("-");
                }
                var markLineData = [
                     [
                          { name: '', xAxis: 0, yAxis: json.y_close },
                          { name: '', xAxis: xdata.length - 1, yAxis: json.y_close }
                     ]
                ];
                //ymax = ymax * 1.01;
                //ymin = ymin * 0.99;
                //var markLineData = [
                //     [
                //          { name: '昨日收盘', xAxis: 0, yAxis: json.y_close },
                //          { name: json.y_close, xAxis: xdata.length - 1, yAxis: json.y_close }
                //     ]
                //];
                var config = {
                    animation: false,
                    title: {
                        show: false
                    },
                    grid: {
                        x: 40,
                        x2: 45,
                        y: 5,
                        y2: 5,
                        borderColor: "#eee"
                    },
                    tooltip: {
                        trigger: 'axis',
                        borderColor: "#ccc",
                        showDelay: 10,
                        hideDelay: 10,
                        transitionDuration: 0.1,
                        borderWidth: 1,
                        backgroundColor: "#ffffff",
                        textStyle: { color: "#666", fontSize: 11, fontFamily: "微软雅黑" },
                        padding: 10,
                        formatter: function (data) {
                            var date = new Date(data[0].name);
                            var price = data[0].data;
                            var dom = date.format("yyyy年MM月dd日");
                            if (price == "-") {
                                dom = new Date().format("yyyy年MM月dd日")
                                dom += "<br/>时间：-";
                                dom += "<br/>价格：-";
                                dom += "<br/>涨跌：-";
                                dom += "<br/>涨跌幅：-";
                            }
                            else {
                                price = parseFloat(price);
                                var p = (price - json.y_close).toFixed(2);
                                var pr = (p / json.y_close * 100).toFixed(2) + "%";
                                dom += "<br/>时间：" + date.format("hh:mm:ss");
                                dom += "<br/>价格：<span style='color:" + (p > 0 ? "red" : "green") + ";'>" + price.toFixed(2) + "</span>";
                                dom += "<br/>涨跌：<span style='color:" + (p > 0 ? "red" : "green") + ";'>" + p + "</span>";
                                dom += "<br/>涨跌幅：<span style='color:" + (p > 0 ? "red" : "green") + ";'>" + pr + "</span>";
                            }
                            return dom;
                        },
                        axisPointer: {
                            lineStyle: {
                                color: '#ccc',
                                width: 1,
                                type: 'solid'
                            }
                        }
                    },
                    legend: {
                        show: false,
                        data: ['-']
                    },
                    toolbox: {
                        show: false
                    },
                    calculable: false,
                    xAxis: [
                        {
                            type: 'category',
                            boundaryGap: false,
                            data: xdata,
                            axisLine: { show: false },
                            axisTick: { show: false },
                            splitNumber: 0,
                            splitLine: {
                                show: false,
                                lineStyle: {
                                    color: ['#ccc'],
                                    width: 1,
                                    type: 'dashed'
                                }
                            }
                        }
                    ],
                    yAxis: [
                        {
                            show: true,
                            type: 'value',
                            position: 'left',
                            min: ymin,
                            max: ymax,
                            boundaryGap: false,
                            splitNumber: 4,
                            axisLine: { show: false },
                            axisTick: { show: false },
                            axisLabel: {
                                formatter: function (data) {
                                    return data.toFixed(2);
                                },
                                textStyle: {
                                    color: function (data) {
                                        var d = 1 * (+data).toFixed(2);
                                        if (d > json.y_close) return '#dd2200';
                                        if (d < json.y_close) return '#33aa60';
                                        if (json.y_close == "--") return '#c8c8c8';
                                        return '#c8c8c8';
                                    }
                                }
                            },
                            splitLine: {
                                show: true,
                                lineStyle: {
                                    color: ['#ccc'],
                                    width: 1,
                                    type: 'dashed'
                                }
                            }
                        },
                        {
                            type: 'value',
                            position: 'right',
                            min: (ymin - json.y_close) / json.y_close * 100,
                            max: (ymax - json.y_close) / json.y_close * 100,
                            boundaryGap: false,
                            splitLine: { lineStyle: { color: '#f1f1f1', width: 1, type: 'solid' } },
                            axisLine: { lineStyle: { color: '#f1f1f1', width: 0, type: 'solid' } },
                            splitNumber: 4,
                            axisLabel: {
                                formatter: function (data) { return Math.abs(data).toFixed(2) + "%"; },
                                textStyle: {
                                    color: function (data) {
                                        if (json.y_close == "--") return '#c8c8c8';
                                        var d = 1 * parseFloat(data).toFixed(3);
                                        if (d >= 0.001) return '#dd2200';
                                        if (d < 0) return '#33aa60';
                                        return '#c8c8c8';
                                    }
                                }
                            }
                        }
                    ],
                    series: [
                        {
                            name: '-',
                            type: 'line',
                            smooth: false,
                            itemStyle: {
                                normal: {
                                    areaStyle: { type: 'default' },
                                    color: "#d5e1f2",
                                    borderColor: "#3b98d3",
                                    lineStyle: { width: 1, color: ['#3b98d3'] },
                                }
                            },
                            data: ydata,
                            symbol: "circle",
                            symbolSize: 1,
                            markLine: {
                                symbol: "none",
                                clickable: false,
                                large: true,
                                itemStyle: {
                                    normal: {
                                        lineStyle: {
                                            color: ['#F96900'],
                                            width:1,
                                            type: 'dashed'
                                        }
                                    }
                                },
                                data: markLineData
                            }
                        }
                    ]
                };
                myChart.setOption(config);
                $(selector).css("background", "none");
                this.chart = myChart;
                //console.log(this.chart);
            },
            push: function (json, full) {
                //console.log(this.chart);
                if (!this.chart) return;
                if (!json || !json.records)
                    return false;
                var option = this.chart.getOption();
                var xdata = [], ydata = [];
                var ymin, ymax;
                $.each(json.records, function (i, n) {
                    if (i == 0) {
                        ymin = ymax = n[1];
                    }
                    xdata.push(n[0])
                    ymin = ymin > n[1] ? n[1] : ymin;
                    ymax = ymax < n[1] ? n[1] : ymax;
                    ydata.push(n[1]);
                });

                var a = ymin, b = json.y_close, c = ymax;
                var ab = Math.abs(b - a);
                var cb = Math.abs(c - b);

                var speed = ab > cb ? ab : cb;//中心线
                console.log(speed, b);
                var min = a > b ? (b > c ? c : b) : a;

                if (a >= b && c >= b)
                    min = min - speed;
                ymin = 0;
                ymax = speed * 2;

                for (var i = 0; i < ydata.length; i++) {
                    ydata[i] = ydata[i] - min;
                }

                full = full || 270;
                for (var i = 0; i < full - xdata.length; i++) {
                    xdata.push("-");
                    ydata.push("-");
                }
                var markLineData = [
                   [
                        { name: '', xAxis: 0, yAxis: speed },
                        { name: '', xAxis: xdata.length - 1, yAxis: speed }
                   ]
                ];
                //ymax = ymax * 1.01;
                //ymin = ymin * 0.99;
                option.yAxis[0].min = ymin;
                option.yAxis[0].max = ymax;
                option.xAxis[0].data = xdata;
                option.series[0].data = ydata;
                option.series[0].markLine.data = markLineData;
                this.chart.setOption(option);
            }
        }
    }
});