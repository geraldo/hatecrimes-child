plotChart("any", "scatter", "crimenes de odio por año", "divYear", true);
plotChart("sentencia", "bar", "crimenes de odio por sentencia", "divSentencia");
plotChart("delito", "bar", "crimenes de odio por delito", "divDelito");


function plotChart(dataType, chartType, title, htmlElement, xaxis=false) {
    Plotly.d3.tsv("https://crimenesdeodio.info/data/?t="+dataType, function(err, rows) {

    	var w = 800,
            data = [],
            keys = Object.keys(rows[0]),
            text = unpackCombine(rows, keys[1], keys[0]).map(String);

        if (dataType === "any") text = unpack(rows, keys[0]).map(String);

        var max = 0;

        for (var i=1; i<keys.length; i++) {

            var yValues = unpack(rows, keys[i]);
            thisMax = Math.max.apply(null, yValues);
            if (thisMax > max) max = thisMax;
            
            data.push({
                type: chartType,
                textposition: 'outside',
                x: unpack(rows, keys[0]),
                y: yValues,
                text: text,
                textfont: {
                    size: 20,
                    color: '#aa0000',
                },
                //hoverinfo: 'none',
                //xaxis: 'x1',
                yaxis: 'y1',
                name: keys[i],
                marker: {
                    color: '#e01a4d',
                }
            });
        }

        if (dataType !== "any") max *= 1.4;

        var layout = {
            width: w,
            height: 400,
            xaxis: {
                visible: xaxis,
                tickangle: -25,
                fixedrange: true,
            },
            yaxis: {
                range: [0,max*1.2],
                /*title: {
                    text: 'cantidad',
                },*/
                //hoverformat: ".1f",
            },
            legend: {
                //x: 1,
                y: 0.5,
                itemclick: false,
                itemdoubleclick: false,
            },
            margin: {
                t: 100,
                b: 60,
            }
        }

        var options = {
            displayModeBar: false,
            showLink: false,
            locale: 'es'
        }

        Plotly.newPlot(htmlElement, data, layout, options);
    });
}

// convert array of objects to array of elements defined by key
function unpack(rows, key) {
    var unpack = rows.map(function(row) { return row[key]; });
    // remove last element in case last line is empty
    if (unpack[unpack.length-1] === undefined) 
        unpack = unpack.slice(0,unpack.length-1);
    return unpack;
}

// convert array of objects to array of elements defined by 2 keys
function unpackCombine(rows, key1, key2) {
    var unpack = rows.map(function(row) { return row[key1]+"<br>"+row[key2]; });
    // remove last element in case last line is empty
    if (unpack[unpack.length-1] === undefined) 
        unpack = unpack.slice(0,unpack.length-1);
    return unpack;
}