class FabricCurveControl{
	constructor(canvas, path=false, oleft=0, otop=0){
		this.canvas = canvas;
		this.control_points = [];
		this.points = [];
		this.offset_left = oleft;
		this.offset_top = otop;
		
		if(path){
			this.parsePath(path);
			this.drawCurve();					
			this.getPoints();
		}
		this.bind();
	}
	
	getPoints(){
	
		var arr = [];
		this.line.path.forEach((bl)=>{
			bl.forEach((v)=>{
				if(Number.isFinite(parseFloat(v))){
					arr.push(parseFloat(v));
				}
			});
		});
		
		this.poins = arr;
		return this.poins;
	}
	
	parsePath(svg){
		this.svg_path = svg;
		this.path_points = this.svg_path.replace(/\s\s+/g, ' ').split(/\s|C|M|,/).filter(function (el) {
		  return el != "";
		});
		
		var flag = false;
		this.path_points = this.path_points.map((x) =>{
			return parseInt(x);
		});
	}
	
	drawCurve(){
		var line = new fabric.Path(this.svg_path, {
			left: this.offset_left,
			top: this.offset_top,
			fill: '',
			stroke: 'black',
			objectCaching: false
		});
		
		line.selectable = false;
		this.canvas.add(line);
		this.line = line;


		//начальная
		console.log(this.path_points[0]);
		
		var p0 = this.makeCurvePoint(this.path_points[0]+this.offset_left, this.path_points[1]+this.offset_top, line, null, null, null);
		p0.name = "p0";
		this.canvas.add(p0);


//		var p1 = this.makeCurvePoint(this.path_points[2], this.path_points[3], line, null, null, null)
//		p1.name = "p1";
//		this.canvas.add(p1);
//		var p2 = this.makeCurvePoint(this.path_points[4], this.path_points[5], line, null, null, null);
//		p2.name = "p2";
//		this.canvas.add(p2);
//		//конечная
//		var p3 = this.makeCurvePoint(this.path_points[6], this.path_points[7], line, null, null, null);
//		p3.name = "p3";
//		this.canvas.add(p3);
	}
	
	bind(){
		this.canvas.on({
			'object:selected': (e)=>{this.onObjectSelected(e)},
			'object:moving': (e)=>{this.onObjectMoving(e)},
			'before:selection:cleared': (e)=>{this.onBeforeSelectionCleared(e)}
		});
	}

	onBeforeSelectionCleared(e) {
		var activeObject = e.target;
	}
	
	onObjectSelected(e){
		var activeObject = e.target;

	}
	onObjectMoving(e) {
		var p = e.target;
		var radius = -p.radius;
		
		if (e.target.name == "p0") {
			p.line1.path[0][1] = p.left-radius;
			p.line1.path[0][2] = p.top-radius;
		}
		else if (e.target.name == "p1"){
//			p.line1.path[1][1] = p.left-radius;
//			p.line1.path[1][2] = p.top-radius;
		}				
		else if(e.target.name == "p2"){
//			p.line1.path[1][3] = p.left-radius;
//			p.line1.path[1][4] = p.top-radius;
		}
		else if(e.target.name == "p3"){
//			p.line1.path[1][5] = p.left-radius;
//			p.line1.path[1][6] = p.top-radius;
		}
		this.getPoints();
	}
	
	makeCurveCircle(left, top, line1, line2, line3, line4) {
		var radius = 6;
		var c = new fabric.Circle({

			left: left-radius,
			top: top-radius,
			strokeWidth: 5,
			radius: radius,
			fill: 'blue',
			stroke: '#666'
		});

		c.hasBorders = c.hasControls = false;
		c.line1 = line1;
		return c;
	}
	makeCurvePoint(left, top, line1, line2, line3, line4) {
		var radius = 10;
		var c = new fabric.Circle({
			left: left-radius,
			top: top-radius,
			strokeWidth: 1,
			radius: 10,
			fill: 'red',
		});
		c.hasBorders = c.hasControls = false;
		c.line1 = line1;
		return c;
	}
}
