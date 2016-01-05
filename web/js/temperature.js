

var trtlora = (function (my) {

    function createGraph(sensorData) {

        var margin = {
            top: 30,
            right: 20,
            bottom: 30,
            left: 50
        },
            width = 600 - margin.left - margin.right,
            height = 270 - margin.top - margin.bottom;

        var parseDate = d3.time.format("%Y-%m-%dT%H:%M:%S%Z").parse;

        var x = d3.time.scale().range([0, width]);
        var y = d3.scale.linear().range([height, 0]);

        sensorData.forEach(function (data) {
            data.time = parseDate(data.time);
            data.data_plain = +data.data_plain;
        });

        x.domain(d3.extent(sensorData, function(d) { return d.time; }));
        y.domain([20, 30]);

        var xAxis = d3.svg.axis().scale(x)
            .orient("bottom").ticks(5);

        var yAxis = d3.svg.axis().scale(y)
            .orient("left").ticks(5);

        var valueline = d3.svg.line()
            .x(function(d) { return x(d.time); })
            .y(function(d) { return y(d.data_plain); });

        var svg = d3.select(".graph")
            .append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", 
                    "translate(" + margin.left + "," + margin.top + ")");


        svg.append("path")
            .attr("class", "line")
            .attr("d", valueline(sensorData));

        svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);

         svg.append("g")
            .attr("class", "y axis")
            .call(yAxis);
    }

    my.main = function () {
        var feed = '/api/node/02031002';

        $.getJSON(feed).then(function (data) {
            createGraph(data);
        });
    };

    return my;
}(trtlora || {}));

trtlora.main();
