<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">

		<title>--SHIXIJS-- curve</title>
		<meta name="description" content="The HTML5 Herald">
		<meta name="author" content="SitePoint">

		<link rel="stylesheet" href="css/styles.css?v=1.0">
		<script src="./fabric.js"></script>
		<script src="./konva.js"></script>
		<script type="text/javascript" src="/site/js/draw/fabric/ctxtextpath.js"></script> 
		<script type="text/javascript" src="/site/js/draw/fabric/opentype.js"></script> 		
		<script type="text/javascript" src="/site/js/draw/fabric/curvecontrol.js"></script> 				
		<script src="https://cdn.jsdelivr.net/npm/@svgdotjs/svg.js@latest/dist/svg.min.js"></script>
	</head>
	<body>
		<canvas id="temp_canvas" width="600" height="270" ></canvas>
		<canvas width="1900" height=900 style="border: 1px solid red" id="fcanvas"></canvas>
		<div id="glyphs" style="display: flex; max-width: 800px; flex-wrap: wrap;"></div>
		
		<script>
		
			var fcanvas = new fabric.Canvas('fcanvas');
			var svg_path = "M100,250 C100,100 400,100 400,250";
			
			var cc = new FabricCurveControl(fcanvas, svg_path);
			
			console.log(cc.getPoints());

			
			
		</script>
	
		
	</body>
</html>
