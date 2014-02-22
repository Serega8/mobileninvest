<div class="row-fluid sortable ui-sortable">
    <div class="box-content">
        <div id="sincos"  class="center" style="height:300px" ></div>
        <p id="hoverdata">Позиция мыши (<span id="x">0</span>, <span id="y">0</span>). 
            <span id="clickdata"></span></p>

        <div id="piechart" style="height:300px">
        </div>
    </div>
    <div class="wrapper">
        <table>
            <? foreach ($stats as $stat) { ?>
                <tr>
                    <td class="ident"><?= $stat['id']; ?></td>
                    <td class="from"><?= Text::limit_chars(urldecode($stat['from']), 60, '...'); ?></td>
                    <td class="to"><?= Text::limit_chars($stat['to'], 60, '...'); ?></td>
                    <td class="browser"><a title="<?= $stat['browser']; ?>"><?= Text::limit_chars($stat['browser'], 80, '...'); ?></a></td>
                    <td class="date"><?= Date('Y-m-d / H:i:s', $stat['date']); ?></td>
                </tr>
            <? } ?>
        </table>
        <?= $pagination; ?>
    </div>
</div>
<style>
    .legend table {
        width:100px;
        background:rgba(0,0,0,0.5);
    }
    .legend table tr {
        height: 20px;
    }
    .legend table tr:hover {
        background: none;
    }
    .legend div:first-child {
        background: none !important;
    }
</style>

<script>
    $(document).ready(function() {

        var data_browsers = new Array();
<? foreach ($br as $k => $b) { ?>
            data_browsers.push({label: '<?= $k; ?>', data: <?= $b ?>});
<? } ?>
<? ?>


//        if ($("#donutchart").length)
//        {
//            $.plot($("#donutchart"), data,
//                    {
//                        series: {
//                            pie: {
//                                innerRadius: 0.5,
//                                show: true
//                            }
//                        },
//                        legend: {
//                            show: false
//                        }
//                    });
//        }
        if ($("#piechart").length) {
            $.plot($("#piechart"), data_browsers, {
                series: {
                    pie: {
                        show: true
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                },
                legend: {
                    show: false
                }
            });
        }














        if ($("#sincos").length)
        {
            var sin = [], cos = [];

            for (var i = 0; i < 14; i += 0.5) {
                sin.push([i, Math.sin(i) / i]);
                cos.push([i, Math.cos(i)]);
            }

            var plot = $.plot($("#sincos"),
                    [{data: sin, label: "sin(x)/x"}, {data: cos, label: "cos(x)"}], {
                series: {
                    lines: {show: true},
                    points: {show: true}
                },
                grid: {hoverable: true, clickable: true, backgroundColor: {colors: ["#696969", "#696969"]}},
                yaxis: {min: -1.2, max: 1.2},
                colors: ["#539F2E", "#3C67A5"]
            });

            function showTooltip(x, y, contents) {
                $('<div id="tooltip">' + contents + '</div>').css({
                    position: 'absolute',
                    display: 'none',
                    top: y + 5,
                    left: x + 5,
                    border: '1px solid #fdd',
                    padding: '2px',
                    'background-color': 'none',
                    opacity: 0.80
                }).appendTo("body").fadeIn(200);
            }

            var previousPoint = null;
            $("#sincos").bind("plothover", function(event, pos, item) {
                $("#x").text(pos.x.toFixed(2));
                $("#y").text(pos.y.toFixed(2));

                if (item) {
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;

                        $("#tooltip").remove();
                        var x = item.datapoint[0].toFixed(2),
                                y = item.datapoint[1].toFixed(2);

                        showTooltip(item.pageX, item.pageY,
                                item.series.label + " of " + x + " = " + y);
                    }
                }
                else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });



            $("#sincos").bind("plotclick", function(event, pos, item) {
                if (item) {
                    $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
                    plot.highlight(item.series, item.datapoint);
                }
            });
        }
    });
</script>