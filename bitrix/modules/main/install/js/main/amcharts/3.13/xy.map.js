{"version":3,"file":"xy.min.js","sources":["xy.js"],"names":["AmCharts","AmXYChart","Class","inherits","AmRectangularChart","construct","a","this","type","base","call","cname","theme","createEvents","maxZoomFactor","applyTheme","initChart","dataChanged","updateData","dispatchDataUpdated","updateScrollbar","drawChart","autoMargins","marginsUpdated","measureMargins","marginLeftReal","c","marginTopReal","b","plotAreaWidth","d","plotAreaHeight","graphsSet","clipRect","bulletSet","trendLinesSet","prepareForExport","clipPath","container","remove","createValueAxes","xAxes","yAxes","valueAxes","e","length","f","position","rotate","setOrientation","orientation","push","ValueAxis","processValueAxis","graphs","processGraph","ifArray","chartData","chartScrollbar","updateScrollbars","selfZoom","horizontalPosition","prevPlotAreaWidth","verticalPosition","prevPlotAreaHeight","zoomChart","cleanChart","hideXScrollbar","scrollbarH","removeListener","handleHSBZoom","destroy","hideYScrollbar","scrollbarV","handleVSBZoom","dispDUpd","chartCreated","zoomScrollbars","callMethod","chartCursor","toggleZoomOutButton","zoomObjects","zoomTrendLines","dispatchAxisZoom","heightMultiplier","widthMultiplier","showZB","isNaN","min","max","coordinateToValue","dispatchZoomEvent","minTemp","maxTemp","updateObjectSize","zoom","NaN","parseData","dataProvider","Infinity","k","g","data","valueField","m","h","Number","maxValue","minValue","valueBalloonsEnabled","zoomOut","chart","minMaxField","listenTo","handleAxisSelfZoom","isString","xAxis","getValueAxisById","yAxis","valueAxis","axes","x","y","id","q","n","serialDataItem","index","p","l","value","xField","yField","errorField","error","values","processFields","graph","formatString","numberFormatter","nf","formatValue","indexOf","formatDataContextValue","dataContext","addChartScrollbar","scrollbarHeight","split","SimpleChartScrollbar","skipEvent","copyProperties","updateTrendLines","trendLines","processObject","TrendLine","valueAxisX","Date","getTime","updateMargins","getScrollbarPosition","adjustMargins","updateChartScrollbar","draw","relativeZoom","fitMultiplier","fitH","fitV","multiplier","setAnimationPlayed","handleCursorZoom","selectionWidth","selectionHeight","selectionY","selectionX","removeChartScrollbar","handleReleaseOutside"],"mappings":"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"}