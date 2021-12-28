class TemplatesEditor {
	constructor() {
		this.file_input = false;
		this.background_file = false;
		this.background_element = false;
		this.editable_area = false;
		this.area_exist = false;
		if (tshirt_template) {
			try {
				this.template = JSON.parse(tshirt_template);
				this.loadTemplate();
			} catch (e) {
				console.error(e);
			}
		}
	}

	async loadTemplate() {
		const objects = await edit.util.JSONToFabricObject(JSON.parse(tshirt_template).splice(0, 2));
		const bgImage = objects[0];
		const rect = objects[1];

		const w = edit.canvas.width;
		const h = edit.canvas.height;

		const scale = Math.min(w / bgImage.width, h / bgImage.height);

		const left = (w - (bgImage.width * scale)) / 2;
		const top = (h - (bgImage.height * scale)) / 2;

		const originalScaleX = (bgImage.width * scale) / (bgImage.width * bgImage.scaleX);
		const originalScaleY = (bgImage.height * scale) / (bgImage.height * bgImage.scaleY);

		const diffScaleX = (bgImage.width * bgImage.scaleX) / (rect.width * rect.scaleX);
		const diffScaleY = (bgImage.height * bgImage.scaleY) / (rect.height * rect.scaleY);

		const lockOptions = {
			selectable: false,
			lockMovementX: true,
			lockMovementY: true,
			hoverCursor: 'default'
		}

		rect.set({
			absolutePositioned: true,
			left: (rect.left - bgImage.left) * originalScaleX + left,
			top: (rect.top - bgImage.top) * originalScaleY + top,
			width: (bgImage.width * scale) / diffScaleX,
			height: (bgImage.height * scale) / diffScaleY,
			scaleX: 1, scaleY: 1,
			...lockOptions, _element_type: 'clip',
			fill: 'rgba(255, 0, 0, 0)'
		});

		bgImage.set({
			_element_type: 'background',
			scaleX: scale,
			scaleY: scale,
			left, top,
			...lockOptions
		});

		edit.canvas.add(bgImage);
		edit.canvas.add(rect).renderAll();

		$('.admin_template_editor').remove();
	}

	percentToPixels(val = 0, canvas_val = 0) {
		return Math.ceil(canvas_val * val / 100);
	}


	async backgroundSelected(ev) {
		this.background_file = this.file_input[0].files[0] ?? false;
		var reader = new FileReader();
		var file_loaded = new Promise(function (resolve) {
			reader.onload = function (event) {
				resolve(event.target.result);
			}
		});
		reader.readAsDataURL(this.background_file);
		this.background_element = await edit.loadImageByURL(await file_loaded);
		this.stepDone("choose-bg");
	}

	async save() {
		var objects = edit.canvas.getObjects();

		await Swal.fire({
			title: "<strong style='font-size: 20px;'>Select category and enter title</strong>",
			icon: "info",
			html: `
				<div class=''>xn
					<select>
						<option value="tshirt">T-shirt maker</option>
						<option value="tshirt">Card Maker</option>
						<option value="tshirt">Envelope Maker</option>
					</select>
				</div>
			`,
			showCloseButton: true,
			showCancelButton: true,
			focusConfirm: false,
			confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
			confirmButtonAriaLabel: 'Thumbs up, great!',
			cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
			cancelButtonAriaLabel: 'Thumbs down'
		});

		var sw = await Swal.fire({
			title: 'Do you want to save the changes?',
			showDenyButton: true,
			showCancelButton: true,
			confirmButtonText: `Save`,
			denyButtonText: `Don't save`,
		})
		//		.then((result) => {
		//		
		//			if (result.isConfirmed) {
		//				Swal.fire('Saved!', '', 'success')
		//			} else if (result.isDenied) {
		//				Swal.fire('Changes are not saved', '', 'info')
		//			}
		//		});
		console.log("sw");

		return;



		var for_save = [];
		objects.forEach((obj) => {
			for_save.push({
				percent_bounding: this.getPercentagePosition(obj),
				...obj.toObject(['left', 'top', 'width', 'height', 'scaleX', 'scaleY']),
			});
		});

		var response = await $.ajax({
			url: "/admin-ui/save-template",
			method: "post",
			type: "json",
			data: {
				_token: $("[name='csrf-token']").attr("content"),
				type: 'tshirt',
				content: JSON.stringify(for_save),
				bg_path: "none",
				bg_relative_path: "none",
			}
		});

		alert("ok");
	}

	choseBackground() {
		if (!this.file_input) {
			this.file_input = $(document.createElement("input"));
			this.file_input.attr({ "type": "file", "accept": "image/*" });
			this.file_input.on("change", (e) => { this.backgroundSelected(e) });
		}
		this.file_input.trigger("click");
	}


	getPercentagePosition(obj) {
		var cw = edit.canvas.width,
			ch = edit.canvas.height,
			cs = edit.canvas.scale;
		var ow = obj.width,
			oh = obj.height,
			ol = obj.left,
			ot = obj.top,
			os = obj.scaleX;
		function percFrom(canvas_width = 100, val = 1, half = 0, scale = 1) {
			console.log(canvas_width, val, half, scale);
			return ((val - half) * scale) * 100 / canvas_width;
		}

		return {
			left: percFrom(cw, ol, 1, 1),
			top: percFrom(ch, ot, 1, 1),
			width: percFrom(cw, ow, 0, obj.scaleX),
			height: percFrom(cw, ow, 0, obj.scaleY),
			scaleX: obj.scaleX,
			scaleY: obj.scaleY
		}
	}

	drawArea() {
		this.area_exist = false;
		edit.canvas.on('mouse:down', (e) => { this.mousedown(e); });
		edit.canvas.on('mouse:move', (e) => { this.mousemove(e); });
		edit.canvas.on('mouse:up', (e) => { this.mouseup(e); });
		this.started = false;
		this.x = 0;
		this.y = 0;
	}

	mousedown(e) {
		if (this.area_exist) {
			return false;
		}

		var mouse = edit.canvas.getPointer(e);
		this.started = true;
		this.x = mouse.x;
		this.y = mouse.y;

		var square = new fabric.Rect({
			width: 0,
			height: 0,
			left: this.x,
			top: this.y,
			fill: 'rgba(200, 100, 0, 0.1)',
			stroke: "black",
			strokeDashArray: [5]

		});
		this.editable_area = square;
		edit.canvas.add(square);
		edit.canvas.renderAll();
		edit.canvas.setActiveObject(square);
	}
	mousemove(e) {
		if (this.area_exist) {
			return false;
		}

		if (!this.started) {
			return false;
		}

		var mouse = edit.canvas.getPointer(e);

		var w = Math.abs(mouse.x - this.x),
			h = Math.abs(mouse.y - this.y);

		if (!w || !h) {
			return false;
		}

		var square = edit.canvas.getActiveObject();
		square.set('width', w).set('height', h);
		edit.canvas.renderAll();
	}

	mouseup(e) {
		if (this.area_exist) {
			return false;
		}
		if (this.started) {
			this.started = false;
		}
		var square = edit.canvas.getActiveObject();
		this.area_exist = square;

		edit.canvas.add(square);
		edit.canvas.renderAll();
		this.stepDone("set-editable-area");
	}

	applyArea() {
		this.editable_area.selectable = false;
		edit.canvas.discardActiveObject();
		edit.canvas.renderAll();
		this.stepDone("apply-editable-area");
	}

	applayBackground() {
		this.background_element.selectable = false;
		edit.canvas.discardActiveObject();
		edit.canvas.renderAll();
		this.stepDone("apply-bg");
	}

	stepDone(ac) {
		var button = $(`.template_buttons[data-action='${ac}']`);
		button.css({ "pointer-events": "none" });
		$(".status", button).html("OK");
	}

	percentPosition() {

	}

}


var templateEditor = false;
$(document).on("logo_editor_inited", function () {
	templateEditor = new TemplatesEditor();
})
