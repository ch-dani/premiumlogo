var parsed_chars = {};




var textOnCurve = function(grad, cb, ctx,font,text,offset,x1,y1,x2,y2,x3,y3,x4,y4){
	var base_path = new Path2D();
	var a1 = [];
	
	for(let i=0; i!=text.length; i++){
		z = arial.getGlyph(text[i],  32);
		a1.push(z);
	};

	ctx.save();
	ctx.textAlign = "center";
	var widths = [];
	for(var i = 0; i < text.length; i ++){
		widths[widths.length] = ctx.measureText(text[i]).width;
	}
	var ch = curveHelper(x1,y1,x2,y2,x3,y3,x4,y4);
	var pos = offset;
	var cpos = 0;
	
	//ctx.setTransform(1, 0, 0, 1, 120, 120);
	ctx.translate(-(cb.width/2),-(cb.height/2));
	ctx.save();

	for(var i = 0; i < text.length; i ++){
		pos += (widths[i]/2); //-(widths[i]/2);
		cpos = ch.forward(pos); //-(widths[i]/4));
		var x = ch.tangent(cpos);
		
		var e = ch.vec.x;//-((widths[i])/2);
		var f = ch.vec.y
		
		let trans_mat = new DOMMatrix();
			trans_mat.a = ch.vect.x;
			trans_mat.b = ch.vect.y;
			trans_mat.c = -ch.vect.y;
			trans_mat.d = ch.vect.x;
			trans_mat.e = e;  //-(widths[i]/2),
			trans_mat.f = f;

		trans_mat.translateSelf(-widths[i]/2, 0)
		
		
		let letter_path = new Path2D(a1[i].path);
		ctx.setTransform(ch.vect.x, ch.vect.y, -ch.vect.y, ch.vect.x, ch.vec.x, ch.vec.y);
		ctx.save();


		base_path.addPath(letter_path, trans_mat);
		
		ctx.fillStyle= "red";
		//ctx.fillText(text[i], 0, 0);
		ctx.fillStyle= "rgba(255,255,0,0.2)";
	
		ctx.restore();
		pos += (widths[i]/2)
	}
	
	ctx.restore();
	ctx.fillStyle= grad;
	ctx.textAlign = "center";
	ctx.fill(base_path);
	
}





function curveHelper(x1, y1, x2, y2, x3, y3, x4, y4){
	var tx1, ty1, tx2, ty2, tx3, ty3, tx4, ty4;
	var a,b,c,u;
	var vec,currentPos,vec1,vect;
	vec = {x:0,y:0};
	vec1 = {x:0,y:0};
	vect = {x:0,y:0};
	quad = false;
	currentPos = 0;
	currentDist = 0;
	if(x4 === undefined || x4 === null){
		quad = true;
		x4 = x3;
		y4 = y3;
	}
	var estLen = Math.sqrt((x4 - x1) * (x4 - x1) + (y4 - y1) * (y4 - y1));
	var onePix = 1 / estLen;
	function posAtC(c){
		tx1 = x1; ty1 = y1;
		tx2 = x2; ty2 = y2;
		tx3 = x3; ty3 = y3;
		tx1 += (tx2 - tx1) * c;
		ty1 += (ty2 - ty1) * c;
		tx2 += (tx3 - tx2) * c;
		ty2 += (ty3 - ty2) * c;
		tx3 += (x4 - tx3) * c;
		ty3 += (y4 - ty3) * c;
		tx1 += (tx2 - tx1) * c;
		ty1 += (ty2 - ty1) * c;
		tx2 += (tx3 - tx2) * c;
		ty2 += (ty3 - ty2) * c;
		vec.x = tx1 + (tx2 - tx1) * c;
		vec.y = ty1 + (ty2 - ty1) * c;    
		return vec;
	}
	function posAtQ(c){
		tx1 = x1; ty1 = y1;
		tx2 = x2; ty2 = y2;
		tx1 += (tx2 - tx1) * c;
		ty1 += (ty2 - ty1) * c;
		tx2 += (x3 - tx2) * c;
		ty2 += (y3 - ty2) * c;
		vec.x = tx1 + (tx2 - tx1) * c;
		vec.y = ty1 + (ty2 - ty1) * c;
		return vec;
	}    
	function forward(dist){
		var step;
		helper.posAt(currentPos);

		while(currentDist < dist){
			vec1.x = vec.x;
			vec1.y = vec.y;            
			currentPos += onePix;
			helper.posAt(currentPos);
			currentDist += step = Math.sqrt((vec.x - vec1.x) * (vec.x - vec1.x) + (vec.y - vec1.y) * (vec.y - vec1.y));

		}
		currentPos -= ((currentDist - dist) / step) * onePix
		currentDist -= step;
		helper.posAt(currentPos);
		currentDist += Math.sqrt((vec.x - vec1.x) * (vec.x - vec1.x) + (vec.y - vec1.y) * (vec.y - vec1.y));
		return currentPos;
	}
	
	function tangentQ(pos){
		a = (1-pos) * 2;
		b = pos * 2;
		vect.x = a * (x2 - x1) + b * (x3 - x2);
		vect.y = a * (y2 - y1) + b * (y3 - y2);       
		u = Math.sqrt(vect.x * vect.x + vect.y * vect.y);
		vect.x /= u;
		vect.y /= u;
		
		        
	}


	function xtangentC(pos){
		a  = (1-pos)
		b  = 6 * a * pos;       
		a *= 3 * a;                  
		c  = 3 * pos * pos; 
		tx  = -x1 * a + x2 * (a - b) + x3 * (b - c) + x4 * c;
		ty  = -y1 * a + y2 * (a - b) + y3 * (b - c) + y4 * c;
		u = Math.sqrt(vect.x * vect.x + vect.y * vect.y);

		return [tx, tx, u]
	}  	
	
	
	function tangentC(pos){
		a  = (1-pos)
		b  = 6 * a * pos;       
		a *= 3 * a;                  
		c  = 3 * pos * pos; 
		vect.x  = -x1 * a + x2 * (a - b) + x3 * (b - c) + x4 * c;
		vect.y  = -y1 * a + y2 * (a - b) + y3 * (b - c) + y4 * c;
		u = Math.sqrt(vect.x * vect.x + vect.y * vect.y);
		vect.x /= u;
		vect.y /= u;
		
		return [vect.x, vect.y, u];
	}  
	var helper = {
		vec : vec,
		vect : vect,
		forward : forward,
	}
	if(quad){
		helper.posAt = posAtQ;
		helper.tangent = tangentQ;
		helper.xtangentC = xtangentC;
	}else{
		helper.posAt = posAtC;
				helper.xtangentC = xtangentC;
		helper.tangent = tangentC;
	}
	return helper
}






class ParseFont{
	constructor(font){
		this.font = font;
		this.glyphs = [];
	}
	getGlyph(char, fontSize=12){
		if(!char){
			return false;
		}
		var uni = char.charCodeAt(0),
			glyph = false,
			x = 0,
			y = 0;
			
		for(var index in arial.font.glyphs.glyphs) { 
			var gl = arial.font.glyphs.glyphs[index]; 
			if(gl.unicode==uni){
				glyph = gl;
				break;
			}
		}
		return {
			path: gl.getPath(x,y, fontSize).toPathData(),
			obj: gl
		};
	}

}


