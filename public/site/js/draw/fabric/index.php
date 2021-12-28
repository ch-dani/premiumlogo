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
		<script type="text/javascript" src="/site/js/draw/fabric/ctxtextpath.js"></script> 
		<script type="text/javascript" src="/site/js/draw/fabric/opentype.js"></script> 		
		<script type="text/javascript" src="/site/js/draw/fabric/curvecontrol.js"></script> 				
		
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



			function point1Handler(eventData, target) {
				console.log("mouse handle");
				alert("mouse handle");
			}

			fabric.Object.prototype.controls.point1 = new fabric.Control({
				x: 0,
				y: 0,
				offsetY: -16,
				offsetX: 16,
				cursorStyle: 'pointer',
				mouseMoveHandler: point1Handler,
				//mouseDownHandler: point1Handler,				
				render: point1(),
				cornerSize: 24
			});
			
			function point1(){
				return function renderCircle(ctx, left, top, styleOverride, fabricObject) {
					var size = this.cornerSize;
					ctx.save();
					ctx.translate(left, top);
					ctx.rotate(fabric.util.degreesToRadians(fabricObject.angle));
					
					ctx.beginPath();
					ctx.arc(0, 0, 10, 0, 2 * Math.PI);
					ctx.fillStyle = "orange";
					ctx.fill();
					//ctx.drawImage(icon, -size/2, -size/2, size, size);
					ctx.restore();
				}				
			}



			
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
				curve_control: false,
				pathToArray(){
					this.path_array = this.path.replace(/\s\s+/g, ' ').split(/\s|C|M|,/).filter(function (el) {
					  return el != "";
					});
					this.path_array = this.path_array.map(x => parseInt(x));
				},

				initDimensions: function () {
					this.isEditing && this.initDelayedCursor();
					this.clearContextTop();
					this.callSuper('initDimensions');
					if(this.width){
						if(!this.curve_control){
							if(!this.path){
								this.buildPath();
								if(!this.canvas){
									this.curve_control =  new FabricCurveControl(this.xcanvas, this.path, this.left, this.top+this.height);
								}else{
									alert("xxxxxxx");
								}

							}
						}
					}
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
				
				buildPath(){
					var top = this.height;
					var a = [
						0,top,
						this.width*0.25,top,
						this.width*0.75,top,
						this.width, top
					];
					
					this.path = `M${a[0]},${a[1]} C${a[2]},${a[3]} ${a[4]},${a[5]} ${a[6]},${a[7]}`;
					this.path_array = a;
					this.curve_boundary = {
						width: this.width,
						height: this.height
					}
				},
				_renderTextCommon: function (ctx, method) {
					ctx.save();
					console.log("render text common");
					textOnCurve(this.fill, this.curve_boundary,ctx, font, this.text,0,...this.path_array);
					
					ctx.restore();
				},
			});

			var canv = document.getElementById("temp_canvas");
			var ctx = canv.getContext("2d");
			
			var arial_url = "/site/js/draw/fabric/arial.ttf";
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
				
//				var path = new fabric.Path(svg_path, {
//					left: 100,
//					top: 100,
//					stroke: 'red',
//					strokeWidth: 1,
//					fill: false,
//				});

//				var gradient = ctx.createLinearGradient(path.left, path.top, path.width,path.height);
//				gradient.addColorStop(0, "rgb(255, 0, 128)");
//				gradient.addColorStop(0.5, "rgb(0, 0, 0)");
//				gradient.addColorStop(1, "rgb(255, 153, 51)");
				gradient = "red";

				var text = new fabric.CurvedText('hello word hello word hello word', { 
					fontFamily: 'Arial', 
					fontSize: 32,
					left: 100, 
					top: 100,
					fill: gradient,
					path: svg_path,//false, //[0,0, 137,150, 284,0, 389,0]
					xcanvas: canvas,
				});
				//canvas.add(path);
				canvas.add(text);

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
