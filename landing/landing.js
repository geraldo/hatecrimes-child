jQuery(document).ready(function($) {
	
	$(".front-slidedown").click(function() {
		console.log("ok");
		/*var active = parseInt($("section.landing.active").attr('id').substring(7));
		console.log(active);

		$("section.landing").removeClass("active");

		if (active >= 5) active = 1;
		else active++;
		console.log(active);

		$("#landing"+active).addClass("active");*/

		document.getElementById("landing2").scrollIntoView();  
	});

	// slider infografias
	var mySwiper = new Swiper ('.swiper-container', {
	    // Optional parameters
	    direction: 'horizontal',
	    loop: true,

	    // If we need pagination
	    pagination: {
	      el: '.swiper-pagination',
	      clickable: true,
	    },

	    // Navigation arrows
	    navigation: {
	      nextEl: '.swiper-button-next-custom',
	      prevEl: '.swiper-button-prev-custom',
	    }
	});

	// plotly infografias
	plotChart("any", "scatter", "crimenes de odio por año", "plotYear", true);
	plotChart("sentencia", "bar", "crimenes de odio por sentencia", "plotSentencia");
	plotChart("delito", "bar", "crimenes de odio por delito", "plotDelito");
});

function plotChart(dataType, chartType, title, htmlElement, xaxis=false) {
    Plotly.d3.tsv("https://crimenesdeodio.info/data/?t="+dataType, function(err, rows) {

    	var w = 700,
            data = [],
            keys = Object.keys(rows[0]),
            text = unpackCombine(rows, keys[1], keys[0]).map(String),
            hoverinfo = 'none';

        if (dataType === "any") {
        	text = unpack(rows, keys[0]).map(String);
        	hoverinfo = 'auto';
        }

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
                hoverinfo: hoverinfo,
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
            height: 450,
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
                fixedrange: true,
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

    	var plotDiv = document.getElementsByClassName(htmlElement);
        Plotly.newPlot(plotDiv[0], data, layout, options);
        
       	// fix for swiper duplicate slides (first and last)
        if (plotDiv.length > 1) {
	        Plotly.newPlot(plotDiv[1], data, layout, options);
        }
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