<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>--SHIXIJS--</title>
		<meta name="description" content="The HTML5 Herald">
		<meta name="author" content="SitePoint">

		<link rel="stylesheet" href="css/styles.css?v=1.0">
		<script src="./fabric.js"></script>
		<script src="./konva.js"></script>
		<script type="text/javascript" src="/ctxtextpath.js"></script> 
		<script type="text/javascript" src="/opentype.js"></script> 		
		<script type="text/javascript" src="/curvecontrol.js"></script> 				
		
		<script src="https://cdn.jsdelivr.net/npm/@svgdotjs/svg.js@latest/dist/svg.min.js"></script>

	</head>
	
	<script>
	
	
	</script>

	<body>
	
		<?php if(false){ ?>
			<div id="konva_container" width="600" height="600" ></div>
		<?php } ?>
		
		

		<canvas id="temp_canvas" width="600" height="270" ></canvas>
		
		
		<canvas width="1900" height=900 style="border: 1px solid red" id="fcanvas"></canvas>
		<div id="glyphs" style="display: flex; max-width: 800px; flex-wrap: wrap;"></div>
		
		<script>
			var arial = false;
			
			fabric.CurvedText = fabric.util.createClass(fabric.IText, fabric.Observable, {
				type: 'curvedtext',
				minWidth: 20,
				lockScalingFlip: true,
				noScaleCache: false,
				fontSize: 32,
				fontFamily: 'Arial',
				textAlign: 'left', //TODO
				path: false,
				path_array: false,
				pathToArray(){
					this.path_array = this.path.replace(/\s\s+/g, ' ').split(/\s|C|M|,/).filter(function (el) {
					  return el != "";
					});
					this.path_array = this.path_array.map(x => parseInt(x));
				},
				_render: function (ctx) {
					this._setTextStyles(ctx);
					this._renderTextLinesBackground(ctx);
					this._renderTextDecoration(ctx, 'underline');
					this._renderText(ctx);
					this._renderTextDecoration(ctx, 'overline');
					this._renderTextDecoration(ctx, 'linethrough');
				},

				getCurveBoundary(ax, ay, bx, by, cx, cy, dx, dy){
					var path = new fabric.Path(this.path, {
						left: 0, //TODO
						top: 0, //TODO
						stroke: 'red',
						strokeWidth: 1,
						fill: false,
					});
					return {
						width: path.width,
						height: path.height,
					}
				},


				calcTextHeight: function () {
					if(this.path){
						if(!this.path_array){
							this.pathToArray();
						}
						let curve_boundary = this.getCurveBoundary(...this.path_array);
						this.curve_boundary = curve_boundary;
						console.log(curve_boundary)
						return Math.max(curve_boundary.height, this.fontSize);
					}else{
						var lineHeight, height = 0;
						for (var i = 0, len = this._textLines.length; i < len; i++) {
							lineHeight = this.getHeightOfLine(i);
							height += (i === len - 1 ? lineHeight / this.lineHeight : lineHeight);
						}
					}
					return height;
				},

				calcTextWidth: function () {
					if(this.path){
						if(!this.path_array){
							this.pathToArray();
						}

						let curve_boundary = this.getCurveBoundary(...this.path);
						return curve_boundary.width;
					}else{
						var maxWidth = this.getLineWidth(0);

						for (var i = 1, len = this._textLines.length; i < len; i++) {
							var currentLineWidth = this.getLineWidth(i);
							if (currentLineWidth > maxWidth) {
								maxWidth = currentLineWidth;
							}
						}
						return maxWidth;
					}
				},

				_renderTextCommon: function (ctx, method) {
					ctx.save();
					textOnCurve(this.fill, this.curve_boundary,ctx, font, this.text,0,...this.path_array);
					ctx.restore();
				},
			});

			
//			var temp_ctx = false;
//			
//			async function init(){
//				var arial_url = "/arial.ttf";
//				
//				var file = await fetch(arial_url).then(async (r) => {
//					return await r.arrayBuffer();
//				});
//				font = opentype.parse(file);
//				arial = new ParseFont(font);
//				
//				var canv = document.getElementById("temp_canvas");
//				var ctx = canv.getContext("2d");
//				window.ctx = ctx;
//				
//				ctx.font = "32px arial";

//				var canv = document.getElementById("temp_canvas");
//				temp_ctx = canv.getContext("2d");
//				

//				var gradient = ctx.createLinearGradient(100, 250, 400,250);
//				gradient.addColorStop(0, "rgb(255, 0, 128)");
//				gradient.addColorStop(0.5, "rgb(0, 0, 0)");
//				gradient.addColorStop(1, "rgb(255, 153, 51)");
//				ctx.fillStyle = gradient;
//				textOnCurve(ctx, font, "hello word", 0, 81,51,151,423,287,41,400,250);
//			}
//			
//			init();

			var canv = document.getElementById("temp_canvas");
			var ctx = canv.getContext("2d");
			
			
			
			var arial_url = "/arial.ttf";
			fcanvas = canvas = new fabric.Canvas('fcanvas', {
				minCacheSideLimit: 1,
				isDrawingMode: false,
			});
			
			async function initFabric(){
				var file = await fetch(arial_url).then(async (r) => {
					return await r.arrayBuffer();
				});

				font = opentype.parse(file);
				arial = new ParseFont(font);
				
				var svg_path = "M0,0 C137,150 284,0 389,0";
//				var svg_path = "M0,0 C137,250 230,-100 489,100";				
				
				var path = new fabric.Path(svg_path, {
					left: 100,
					top: 100,
					stroke: 'red',
					strokeWidth: 1,
					fill: false,
				});

				var gradient = ctx.createLinearGradient(path.left, path.top, path.width,path.height);
				gradient.addColorStop(0, "rgb(255, 0, 128)");
				gradient.addColorStop(0.5, "rgb(0, 0, 0)");
				gradient.addColorStop(1, "rgb(255, 153, 51)");

				var text = new fabric.CurvedText('hello word hello word hello word', { 
					fontFamily: 'Arial', 
					fontSize: 32,
					left: 100, 
					top: 100,
					fill: gradient,
					path: svg_path, //[0,0, 137,150, 284,0, 389,0]
				});
				canvas.add(path);
				canvas.add(text);


				svg_path = "M100,250 C100,100 400,100 400,250";
				var cc = new FabricCurveControl(fcanvas, svg_path);

			}
			
			initFabric();


			

			function cubicBezierLength(Ax,Ay,Bx,By,Cx,Cy,Dx,Dy,sampleCount){
				var ptCount=sampleCount||40;
				var totDist=0;
				var lastX=Ax;
				var lastY=Ay;
				var dx,dy;
				for(var i=1;i<ptCount;i++){
					var pt=cubicQxy(i/ptCount,Ax,Ay,Bx,By,Cx,Cy,Dx,Dy);
					dx=pt.x-lastX;
					dy=pt.y-lastY;
					totDist+=Math.sqrt(dx*dx+dy*dy);
					lastX=pt.x;
					lastY=pt.y;
				}
				dx=Dx-lastX;
				dy=Dy-lastY;
				totDist+=Math.sqrt(dx*dx+dy*dy);
				return(parseInt(totDist));
			}

			function cubicQxy(t,ax,ay,bx,by,cx,cy,dx,dy) {
				ax += (bx - ax) * t;
				bx += (cx - bx) * t;
				cx += (dx - cx) * t;
				ax += (bx - ax) * t;
				bx += (cx - bx) * t;
				ay += (by - ay) * t;
				by += (cy - by) * t;
				cy += (dy - cy) * t;
				ay += (by - ay) * t;
				by += (cy - by) * t;
				return({
					x:ax +(bx - ax) * t,
					y:ay +(by - ay) * t     
				});
			}



			
			
			
			
			
			
		</script>
	
		
	</body>
</html>
