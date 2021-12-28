function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

const _cache = new class {
    constructor() {
        this.store = [];
    }

    inStore(obj) {
        return this.store.find((item) => item.id == obj._id);
    }

    add(obj) {
        let object = this.inStore(obj);
        if (object) return object;

        object = { id: obj._id, data: obj.toDataURL() };
        this.store.push(object);

        return object;
    }

    remove(obj) {
        const id = obj._id;
        const index = this.store.findIndex((ob) => ob.id == id);

        if (obj._id && index != -1) {
            this.store.splice(index, 1);
        }
    }
}

function debounce(f, ms) {
    let isCooldown = false;

    return function () {
        if (isCooldown) return;

        f.apply(this, arguments);
        isCooldown = true;
        setTimeout(() => isCooldown = false, ms);
    };
}

function fitToScreen(edit) {
    const w = $(".dashboard_content").width();
    const h =
        $(".dashboard_content").height() - $(".dashboard_content_footer").height();

    edit.canvas.setWidth(w);
    edit.canvas.setHeight(h);
}

var edit; 
edit = new LogoEditor("canvas", []);

fitToScreen(edit);
$(window).resize(() => fitToScreen(edit));
$("#bgColorInput").on("input", (e) => edit.setBackgroundColor(e.target.value));
$("#bgColorInput").on("change", (e) => edit.setBackgroundColor(e.target.value, true));
$(".name_logo_wrapper").find(".name_logo").on("input", e => changeSelectedText(e, false));
$(".name_logo_wrapper").find(".name_logo").on("change", e => changeSelectedText(e, true));

function changeSelectedText(e, isUpdate = false) {
    edit.setTextToActiveText(e.target.value, isUpdate);
    _cache.remove(edit.canvas.getActiveObject());

    if (edit.canvas.getActiveObject().group) {
        edit.canvas.getActiveObject().group.addWithUpdate();
        edit.canvas.renderAll();
    }

    ev.configurationSelectedText(edit.canvas.getActiveObject());
}

$('#controlObjectColor').find('.control_shape_btn').click(e => {
    e.preventDefault();
    const colors = edit.getAllColors(edit.canvas.getActiveObjects());
    const uniqColor = edit.util.isUniqColor(colors, edit);

    const color = (uniqColor && colors.length ? colors[0].fill : '#000000');
    edit.setGradientToObjects(undefined, [
        { offset: 0, color },
        { offset: 1, color },
    ]);
});

function updateUndoRedo() {
    const { undo, redo } = edit.history.getStatus();
    const undoEl = $('.control_btn.undo');
    const redoEl = $('.control_btn.redo');

    undo ? undoEl.removeClass('deactive') : undoEl.addClass('deactive');
    redo ? redoEl.removeClass('deactive') : redoEl.addClass('deactive');
}

edit.history.addEvent({
    name: 'addChange',
    callback: function (data) {
        updateUndoRedo();
        console.log('FIRE add object');
    }
});

$('.control_btn.undo').click(async e => {
    e.preventDefault();
    await edit.history.undo();
    updateUndoRedo();
});

$('.control_btn.redo').click(async e => {
    e.preventDefault();
    await edit.history.redo();
    updateUndoRedo();
});

$("#footerPositionX").on('change', e => edit.setActiveObjectsParams({ left: e.target.value }));
$("#footerPositionY").on('change', e => edit.setActiveObjectsParams({ top: e.target.value }));
$("#footerPositionAngle").on('change', e => edit.setActiveObjectsParams({ angle: e.target.value }));
$("#footerPositionW").on('change', e => edit.setActiveObjectsParams({ width: e.target.value }));
$("#footerPositionH").on('change', e => edit.setActiveObjectsParams({ height: e.target.value }));

$(".font_weight").on("click", e => edit.changeFontWeight());
$(".font_italics").on("click", e => edit.changeFontStyle());
$(".flip-object").on("click", e => edit.flipObjects(e.delegateTarget.dataset.val));
$(".text-align").on("click", e => edit.setTextAlign(e.delegateTarget.dataset.align));
$(".rotate-object").on("click", e => edit.incrAngleObjects(e.delegateTarget.dataset.to == 'left' ? -1 : 1));
$(".object-move").on("click", e => edit.moveObjects(e.delegateTarget.dataset.to));
$(".clone-object").on("click", e => edit.dublicateActiveObjects());
$(".group-objects").on("click", e => edit.changeGroupStatusActiveObjects());
$(".delete-object").on("click", e => {
    if (confirm('Delete object?')) {
        edit.removeSelectedObjects();
    }
});
$('.reset_project').click(e => {
    e.preventDefault();
    if(confirm('Reset all?')){
        loadQuery();
    }
});

$(document).on("click", ".template_buttons", function(e){
	e.preventDefault();
	var action = $(this).data("action");
	switch(action){
		case 'choose-bg':
			templateEditor.choseBackground();
		break;
		case 'apply-bg':
			templateEditor.applayBackground();
		break;
		case 'set-editable-area':
			templateEditor.drawArea();
		break;
		case 'apply-editable-area':
			templateEditor.applyArea();
		break;

		
		case 'save':
			templateEditor.save();
		break;
	};
});

$('.add-new-text').click(e => edit.addText('New Text'));

$('.copy_text').click(e => edit.copySelectedObject());
$('.paste_text').click(e => edit.pasteCopiedObjects());
$('.open_preview_modal').click(async e => {
    const clipElement = edit.canvas.getObjects().find(o => o._element_type == 'clip');

    console.log('WTF', clipElement);
    let b64 = '';
    if(clipElement) {
        console.log('YES');
        b64 = edit.canvas.toDataURL({
            left: clipElement.left,
            top: clipElement.top,
            width: clipElement.width * clipElement.scaleX,
            height: clipElement.height * clipElement.scaleY
        });
    } else {
        edit._setActiveObjects(edit.canvas.getObjects());
        b64 = edit.canvas.getActiveObject().toDataURL({ type: 'jpeg', quality: .7 });
        edit.canvas.discardActiveObject();
        edit.canvas.renderAll();
    }
    
    //const b64 = await edit.getCanvasDataURL({ padding: 20, w: 600, h: 600, save: { type: 'jpeg', quality: .7 } });
    $('#previewModal').html(`<img src="${b64}">`);
    $('#preview_modal').css({ display: 'block' });
});

$('.layer-order').click(e => edit.layerOrder(e.delegateTarget.dataset.to));
$('.char_spacing_range').on('input', e => {
    edit.changeCharSpacing(e.target.value);
    $('.char_spacing_value').val(e.target.value);
}).on('change', e => edit.changeCharSpacing(e.target.value, true));

$('.char_spacing_value').on('input', e => {
    $('.char_spacing_range').val(e.target.value);
    edit.changeCharSpacing(e.target.value);
}).on('change', e => edit.changeCharSpacing(e.target.value, true));

$(".scale-object").on("click", e => {
    let scale = { x: .1, y: .1 };
    if (e.delegateTarget.dataset.to == 'down') {
        scale = { x: -.1, y: -.1 };
    }

    edit.incrScaleObject(scale);
});

$('#dropdownWidget').on('click', e => {
    _cache.store = [];
    ev.updateSelectList();
});

const ev = new class {
    constructor() {
        this.lastRender = Date.now();
    }

    updateColors(event) {
        //openPanel(event);
        let colors = edit.getAllColors();
        $('#globalToolBar').find('.colors').css({ display: !colors.length ? 'none' : 'block' });

        let colorsBlock = ``;
        for (let color of colors) {
            colorsBlock += `<div class="bg_dashboard_tool_wrapper">
                <input type="color" data-ids="${color._ids.map(id => typeof id == 'object' ? id.id : id).join(',')}" value="${color.fill}" class="bg_dashboard_tool main-color-input" />
            </div>`;

            //`<input type="color" data-ids="${color._ids.join(';')}" value="${color.fill}" class="main-color-input" />`;
            // `<div class="color-block" style="background: ${color};"></div>`;
        }

        $(".colors_wrapper").html(colorsBlock);
        $('.main-color-input').unbind();
        let objects = [];
        let gradientMap = [];

        $('.main-color-input').click(e => {
            $('#controlObjectColor').find('.controlGradient').removeAttr('data-imprint');

            const ids = e.delegateTarget.dataset.ids.split(',');
            objects = edit.getObjectsList().filter(obj => obj._id && ids.find(id => id == obj._id));
            const startColor = e.delegateTarget.value;

            for (const obj of objects.filter(obj => typeof obj.fill == 'object')) {
                obj.fill.colorStops.forEach((color, index) => {
                    if (color.color.toLowerCase() == startColor.toLowerCase()) {
                        const grIndex = gradientMap.findIndex(gm => gm._id == obj._id);
                        if (grIndex == -1) {
                            gradientMap.push({
                                _id: obj._id,
                                map: [{ offset: color.offset, index }]
                            });
                        } else {
                            gradientMap[grIndex].map.push({ offset: color.offset, index });
                        }
                    }
                });
            }
        });

        $('.main-color-input').on('input', debounce(function (e) {
            const value = e.target.value;
            edit.setFillColorsByIds(objects.filter(obj => typeof obj.fill != 'object').map(obj => obj._id), value);
            for (const gm of gradientMap) {
                const obj = objects.find(o => o._id == gm._id);
                if (obj) {
                    const colorStops = obj.fill.colorStops.map((color, index) => {
                        const findByIndex = gm.map.find(g => g.index == index);
                        if (findByIndex && findByIndex.offset == color.offset) {
                            color.color = value;
                        }

                        return color;
                    });

                    edit.setGradientToObjects([obj], colorStops);
                }
            }
        }, 10));

        $('.main-color-input').on('change', e => {
            const value = e.target.value;
            //edit.setFillColorsByIds(e.target.dataset.ids.split(','), value);
            edit.history.addChange(`modify-color`, { objects: objects.map(o => o.toJSON(edit.util.defaultProperties)), type: 'activeSelection' });
            this.updateColors();
        });
    }

    updateSelectList(isSelected = false) {
        this.updateColors();
        //selectFont(event);
        let options = ``;
        let selectedHTML = "";

        const objs = edit.getObjectsList();
        objs.forEach((obj, i) => {
            const type = edit.getObjectType(obj);

            const activeObjects = edit.canvas.getActiveObjects();
            const activeObject =
                activeObjects && activeObjects.length == 1 ?
                    activeObjects[0] :
                    undefined;
            let selected = activeObject && activeObject._id == obj._id;

            if (!isSelected) {
                options += `<div class="dropdown_option editor-item" data-id="${obj._id}">
                    <img src="${_cache.add(obj).data}"/>
                    ${type == "text" ? "Text" : "Shape"} ${i}
                </div>`;
            }


            if (selected) {
                selectedHTML = `<img src="${_cache.add(obj).data}"/>
                ${type == "text" ? "Text" : "Shape"} ${i}`;
            }
        });

        if (!selectedHTML) {
            selectedHTML = `Dashboard Layers`;
        }
        $("#dropdownWidget").find(".dropdown_select").html(selectedHTML);
        if (!isSelected) {
            $("#dropdownWidget").find(".dropdown_option_wrapper").html(options);

            $('.editor-item').unbind();
            $('.editor-item').on('click', e => {
                $('.editor-item').closest('.dropdown_option_wrapper').removeClass('active');
                edit.setActiveObjectById(e.delegateTarget.dataset.id);
            });
        }

        // $('#fabricObjectsSelector').html(options);
        // setTimeout(() => {
        //     updateTextPanel();
        //     ev.changeActionVisible();
        // }, 1);
    }

    onChangeSelection(event) {
        if (Date.now() - this.lastRender < 100) return;
        this.lastRender = Date.now();

        this.eventInspector();
        //openPanel();
        const target = event ?
            event.target || event.transform.target :
            edit.canvas.getActiveObject();

        if (!target) {
            $("#globalToolBar").css({ display: "block" });
            $(".textBar").css({ display: "none" });
            $("#controlPanel").css({ display: "none" });
            $("#controlObjectColor").css({ display: "none" });
            return;
        }

        $("#globalToolBar").css({ display: "none" });
        const type = edit.getObjectType(target);

        if (type == "text") {
            //$('#controlObjectColor').find('.controlGradient').removeAttr('data-imprint');
            $("#controlObjectColor").css({ display: "flex" });
            $(".textBar").css({ display: "block" });

            $('.char_spacing_value').val(target.charSpacing);
            $('.char_spacing_range').val(target.charSpacing);

            $('#miniText').find('.dropdown_select').html(`${target.fontFamily}`);
            $('#miniText').find('.dropdown_select').css({ 'font-family': target.fontFamily });
            this.setSelectedObjectsColor($('#controlObjectColor'));

            // if (!$('.selected_text_color').is(":focus")) {
            //     // TODO: добавить проверку градиента
            //     $('.text_color_wrapper').html(`<input type="color" value="${target.fill}" class="bg_dashboard_tool selected_text_color"/>`);

            //     $('.selected_text_color').unbind();
            //     $('.selected_text_color').on('input', e => edit.changeSelectedTextColor(e.target.value));
            // }

            this.configurationSelectedText(target);
        } else {
            $(".textBar").css({ display: "none" });
            $('#controlObjectColor').css({ display: "flex" });
            this.setSelectedObjectsColor($('#controlObjectColor'));
        }

        $("#controlPanel").css({ display: "block" });
    }

    setSelectedObjectsColor(element, objects) {
        if (!objects) {
            objects = edit.canvas.getActiveObjects();
        }

        const colors = edit.getAllColors(objects);
        const uniqGradient = edit.util.getUniqGradient(edit, objects);
        const uniqColor = edit.util.isUniqColor(colors, edit);
        const imprint = edit.getObjectsList(objects, true);

        if (!uniqColor && ((!element.find('.controlGradient')[0] && uniqGradient) || (element.find('.controlGradient').attr('data-imprint') != imprint && uniqGradient))) {
            element.find('.controlGradient').html('');

            element.find('.controlGradient').css({ 'display': 'block' });
            element.find('.controlGradient').attr({ 'data-imprint': imprint });
            element.find('.bg_dashboard_tool_wrapper').css({ 'display': 'none' });
            element.find('.control_shape_btn').css({ 'display': 'none' });

            element.find(".controlGradient").gradientPicker({
                onHide: e => {
                    const objectsParsed = edit.getObjectsList(edit.canvas.getActiveObjects()).map(obj => obj.toJSON(edit.util.defaultProperties));

                    edit.history.addChange('modify-set-gradient', { objects: objectsParsed, type: 'activeSelection' });
                },
                change: function (points, styles) {
                    edit.setGradientToObjects(undefined, points.map(point => {
                        return {
                            offset: point.position,
                            color: point.color
                        };
                    }));
                },
                // Посчитать градус поворота
                fillDirection: "45deg",
                type: 'linear',
                controlPoints: edit.util.getControlPointsGradient(edit, objects)
            });
        } else if (!uniqGradient || uniqColor) {
            element.find('.controlGradient').removeAttr('data-imprint');
            element.find('.controlGradient').css({ 'display': 'none' });
            element.find('.bg_dashboard_tool_wrapper').css({ 'display': 'block' });
            element.find('.control_shape_btn').css({ 'display': 'block' });
            const uniqColors = colors.reduce((cls, color) => {
                if (!cls.find(cl => cl == color.fill)) {
                    cls.push(color.fill);
                }

                return cls;
            }, []);

            element.find('.bg_dashboard_tool').val(uniqColor ? uniqColors[0] : '#000000');
            element.find('.bg_dashboard_tool').unbind();
            element.find('.bg_dashboard_tool').on('input', debounce(function (e) {
                const selectedIds = colors.reduce((ids, color) => {
                    ids.push(...color._ids.map(id => typeof id == 'object' ? id.id : id));

                    return ids;
                }, []);

                edit.setFillColorsByIds(selectedIds, e.target.value);
            }, 1));
        }
    }

    configurationSelectedText(textObject) {
        if (edit.getObjectType(textObject) != "text") return;
        //_cache.remove(textObject);

        $(".mini_text").html(`<img src="${_cache.add(textObject).data}"/>`);
        $(".name_logo_wrapper").find(".name_logo").val(textObject.text);
        //$('.name_logo').value(textObject.text);
    }

    eventInspector(event) {
        const target = event ? (!event.target && !event.transform ? null : (event.target || event.transform.target)) :
            edit.canvas.getActiveObject();
        //if (!target) return;

        if (target) {
            this.changeFooterActive(true);
            const { left, top, width, height, angle } = edit.getObjectPositions(target);

            $("#footerPositionX").val(left);
            $("#footerPositionY").val(top);

            $("#dropdownDashboardFooter").find('.dropdown_select')
                .html(parseInt(edit.canvas.getObjects().indexOf(edit.canvas.getActiveObjects()[0]) + 1));
            $("#dropdownDashboardFooter").find('.dropdown_option_wrapper').html(edit.canvas.getObjects().reduce((result, obj, i) => {
                result += `<div class="dropdown_option order-layer" data-to="${i}">${i + 1}</div>`;

                return result;
            }, ''));
            $('.order-layer').unbind();
            $('.order-layer').click(e => {
                $('.order-layer').closest('.dropdown_option_wrapper').removeClass('active');
                edit.layerOrder('to', e.delegateTarget.dataset.to);
            });

            $("#footerPositionAngle").val(angle);
            $("#footerPositionW").val(width);
            $("#footerPositionH").val(height);
        } else {
            this.changeFooterActive();
        }
    }

    changeFooterActive(isActive) {
        [
            'footerPositionX', 'footerPositionY',
            'dropdownDashboardFooter', 'footerPositionAngle',
            'footerPositionW', 'footerPositionH'
        ].forEach(id => {
            if (isActive) {
                $(`#${id}`).removeAttr('disabled');
            } else {
                $(`#${id}`).attr('disabled', true);
                if (id == 'dropdownDashboardFooter') {
                    $(`#${id}`).find('.dropdown_select').html('#');
                    $('.order-layer').closest('.dropdown_option_wrapper').removeClass('active');
                    $("#dropdownDashboardFooter").find('.dropdown_option_wrapper').html('');
                } else {
                    $(`#${id}`).val('');
                }
            }
        });
    }

    onRender(event) {
        this.onChangeSelection();
    }

    onModified(e) {
        const target = e.target;

        if (target && target._objects) {
            for (const obj of target._objects) {
                _cache.remove(obj);
            }
        } else {
            _cache.remove(e.target);
        }
    }
}

edit.setCallbackEvents([{
    name: "selection:updated",
    func: (e) => ev.onChangeSelection(e),
    isCanvas: true,
},
{ name: 'object:added', func: e => ev.updateSelectList(), isCanvas: true },
// { name: 'mouse:down', func: e => ev.onMouseDown(e) },
// { name: 'mouse:up', func: e => ev.onMouseUp(e), isCanvas: true },

{ name: "object:moving", func: (e) => ev.eventInspector(e), isCanvas: true },
{ name: "object:scaling", func: (e) => ev.eventInspector(e), isCanvas: true },
{
    name: "object:rotating",
    func: (e) => ev.eventInspector(e),
    isCanvas: true,
},
// { name: 'rotating', func: eventInspector },
{ name: "object:modified", func: (e) => ev.onModified(e), isCanvas: true },
{ name: "after:render", func: (e) => ev.onRender(e), isCanvas: true },
{ name: "mouse:up", func: (e) => setTimeout(() => { ev.onChangeSelection(); ev.updateSelectList(true); }, 100), isCanvas: true },
    // { name: 'selection:cleared', func: e => ev.onChangeDeselection(e), isCanvas: true }
]);

$(document).on('keydown', e => {
    // console.log(e.keyCode, e);
    const isFocus = !!(Array.from($('input')).find(el => $(el).is(":focus")));
    if (isFocus) return;
    //console.log(e.keyCode, e);

    switch (e.keyCode) {
        case 46: {
            if (edit.canvas.getActiveObjects().length) {
                if (confirm('Delete object?')) {
                    edit.removeSelectedObjects();
                }
            }

            break;
        }

        case 67: {
            if (e.ctrlKey) {
                edit.copySelectedObject();
                e.preventDefault();
                break;
            }
        }

        case 86: {
            if (e.ctrlKey) {
                edit.pasteCopiedObjects();
                e.preventDefault();
                break;
            }
        }
    }
});

const _render = new class {
    constructor() {
        this.searchIconVal = false;
        this.searchIconPage = 1;
        this.loadAjaxIcons = false;
    }

    getPagination(links = []) {
        let html = ``;
        if (links.length == 3) return '';

        for (const link of links) {
            switch (link.label) {
                case 'Previous': {
                    html += `<li><a href="#" class="prev pagination-arrow${!link.url ? ' disabled' : ''}" data-link="${link.url}">
                        <svg width="9" height="14" viewBox="0 0 9 14" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.38742 2.15001L3.53742 7.00001L8.38742 11.85C8.50314 11.9657 8.59494 12.1031 8.65757 12.2543C8.7202 12.4055 8.75244 12.5676 8.75244 12.7313C8.75244 12.8949 8.7202 13.057 8.65757 13.2082C8.59494 13.3594 8.50314 13.4968 8.38742 13.6125C8.27169 13.7282 8.1343 13.82 7.98309 13.8827C7.83189 13.9453 7.66983 13.9775 7.50617 13.9775C7.3425 13.9775 7.18044 13.9453 7.02924 13.8827C6.87803 13.82 6.74064 13.7282 6.62492 13.6125L0.887416 7.87501C0.399916 7.38751 0.399916 6.60001 0.887416 6.11251L6.62492 0.375015C6.74056 0.259136 6.87792 0.167201 7.02914 0.104475C7.18035 0.0417479 7.34246 0.00946033 7.50617 0.00946034C7.66988 0.00946035 7.83198 0.041748 7.9832 0.104475C8.13441 0.167201 8.27177 0.259136 8.38742 0.375015C8.86242 0.862515 8.87492 1.66251 8.38742 2.15001Z"
                                fill="#363636"></path>
                        </svg>
                    </a></li>`;
                    break;
                }

                case 'Next': {
                    html += `<li>
                        <a href="#" class="next pagination-arrow${!link.url ? ' disabled' : ''}" data-link="${link.url}">
                            <svg width="9" height="14" viewBox="0 0 9 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.612585 11.85L5.46258 6.99999L0.612585 2.14999C0.496857 2.03426 0.405058 1.89687 0.342427 1.74567C0.279795 1.59446 0.247559 1.4324 0.247559 1.26874C0.247559 1.10507 0.279795 0.943013 0.342427 0.791808C0.405058 0.640603 0.496857 0.503214 0.612585 0.387487C0.728312 0.27176 0.8657 0.179959 1.01691 0.117328C1.16811 0.0546971 1.33017 0.0224609 1.49383 0.0224609C1.6575 0.0224609 1.81956 0.0546971 1.97076 0.117328C2.12197 0.179959 2.25936 0.27176 2.37508 0.387487L8.11258 6.12499C8.60008 6.61249 8.60008 7.39999 8.11258 7.88749L2.37508 13.625C2.25944 13.7409 2.12208 13.8328 1.97086 13.8955C1.81965 13.9583 1.65754 13.9905 1.49383 13.9905C1.33012 13.9905 1.16802 13.9583 1.0168 13.8955C0.865588 13.8328 0.728227 13.7409 0.612585 13.625C0.137585 13.1375 0.125085 12.3375 0.612585 11.85Z"
                                    fill="#363636"></path>
                            </svg>
                        </a>
                    </li>`;
                    break;
                }

                default: {
                    html += ` <li>
                        <a href="#" class="page${link.active ? ' active disabled' : ''}" data-link="${link.url}">${link.label}</a>
                    </li>`;
                    break;
                }
            }
        }

        return html;
    }

    async renderShapes(url = '/logos/json/shapes') {
        if (!url) return;

        const shapes = await http.post(url).then(res => res.json());
        let html = '';

        for (const shape of shapes.data) {
            html += `<div class="content_popup_item">
                <img src="${shape.image}" alt="${shape.name_translate}" title="${shape.name_translate}"/>
            </div>`;
        }

        $('#shapeModal').find('.content_popup_row').html(html);
        $('#shapeModal').find('.content_popup_item').click(e => {
            e.preventDefault();
            $('.close_popup').click();
            edit.loadSVGByURL($(e.delegateTarget).find('img').attr('src'));
        });

        $('#shapeModal').find('.module__pagination').html(this.getPagination(shapes.links));
        $('#shapeModal').find('a').click(e => this.renderShapes(e.delegateTarget.dataset.link));
    }

    async renderIcons(url = '/logos/json/icons') {
        let query = $('#searchIconVal').val();

        if (!url || !query.length) return;

        if (query !== this.searchIconVal) {
            this.searchIconVal = query;
            this.searchIconPage = 1;
            this.loadAjaxIcons = false;
        }

        if (this.loadAjaxIcons) return;

        this.loadAjaxIcons = true;
        const icons = await http.post(url + '?query=' + this.searchIconVal + '&page=' + this.searchIconPage).then(res => res.json());
        let html = '';

        for (const icon of icons.data) {
            html += `<div class="content_popup_item">
                <img src="${icon.image}" alt="${icon.name_translate}" title="${icon.name_translate}"/>
            </div>`;
        }

        if (this.searchIconPage === 1) {
            $('#iconsModal').find('.content_popup_row').html(html);
        } else {
            $('#iconsModal').find('.content_popup_row').append(html);
        }

        if (icons.data.length) {
            this.loadAjaxIcons = false;
            this.searchIconPage++;
        }

        // $('#iconsModal').find('.module__pagination').html(this.getPagination(icons.links));
        // $('#iconsModal').find('a').click(e => this.renderIcons(e.delegateTarget.dataset.link));
    }

    async renderLogoCategories() {
        const categories = await http.post('/logos/json/categories').then(res => res.json());
        let html = '';

        for (const category of categories) {
            html += `<li><a href="#" class="category_item" data-id="${category.id}">${category.name_translate}<span>${category.amount}</span></a></li>`;
        }

        $('#add_logo').find('.categorie_list').find('ul').html(html);
        $('.category_item').click(e => {
            this.selectCategoryById(e.delegateTarget.dataset.id);

            this.renderLogos(undefined, e.delegateTarget.dataset.id);
        });
        // $('#logosModal').find('.content_popup_item').click(e => {
        //     e.preventDefault();
        //     console.log($(e.delegateTarget).find('img').attr('src'));
        // });
    }

    selectCategoryById(categoryId) {
        $('#add_logo').find('.categorie_list').find('a').removeAttr('style');
        $('#add_logo').find('.categorie_list').find('li').removeAttr('style');

        const active = $('#add_logo').find('.categorie_list').find(`a[data-id=${categoryId}]`);
        active.css({ color: '#ffffff' });
        active.closest('li').css({ 'background-color': '#3BE2AB' });
    }

    async renderLogos(url = '/logos/json/logos', categoryId, query = '') {
        if (!url) return;

        const sufix = ((categoryId || categoryId == 0) ? `/${categoryId}` : '');
        const logos = await http.post(`${url}${sufix}${query}`).then(res => res.json());
        let html = '';

        for (const logo of logos.data) {
            html += `<div class="content_popup_item">
                <img src="${logo.image}" alt="${logo.name_translate}"/>
            </div>`;
        }

        $('#logosModal').find('.content_popup_row').html(html);
        $('#logosModal').find('.content_popup_item').click(e => {
            e.preventDefault();
            $('.close_popup').click();
            edit.loadImageByURL($(e.delegateTarget).find('img').attr('src'));
        });

        $('#logosModal').find('.module__pagination').html(this.getPagination(logos.links));
        $('#logosModal').find('a').click(e => this.renderLogos(e.delegateTarget.dataset.link));
        if (categoryId || categoryId == 0) {
            this.selectCategoryById(categoryId);
        }
    }
};

async function loadQuery() {
    showLoader("body");
    edit.dispose();
    const imageUrl = getParameterByName('url');
    const company = getParameterByName('company');
    const category = getParameterByName('category');
    // https://logo.webstaginghub.com/logo?company=test&category=5
    
    if (imageUrl) {
        await edit.loadSVGByURL(imageUrl);
    } else if (company && category) {
        await _render.renderLogos(undefined, category, `?search=${company}`);
        hideLoader();
        $('.tools_btn.open-modal[data-modal=add_logo]').click();
    } else if (getParameterByName('good')) {


        // const checkedData = dataStore.logos[0];
        // edit.addFromJsonByType(checkedData.data, 'logos', undefined, {
        //     scaleX: .5,
        //     scaleY: .5,
        //     top: 95.38871572175452,
        //     left: 418.30890922360237
        // });

        // edit.canvas.discardActiveObject();
        // setTimeout(() => {
        //     ev.onChangeSelection();
        //     edit.canvas.renderAll();
        // }, 1000);
    }

    hideLoader();

    edit.canvas.discardActiveObject();
    edit.canvas.renderAll();
    $(document).trigger("logo_editor_inited");
}

(async function () {
    showLoader("body");
    await _render.renderShapes();
    // await _render.renderIcons();
    await _render.renderLogoCategories();
    await _render.renderLogos();

    $('#searchIcon').on('click', async e => {
        await _render.renderIcons();
    });

    $('#searchIconVal').on('keyup', async e => {
        if(e.keyCode === 13) {
            await _render.renderIcons();
        }
    });

    $('#iconsModal').on('scroll', async e => {
        let $iconsModal = $('#iconsModal');

        if($iconsModal[0].scrollHeight - ($iconsModal.height() + $iconsModal.scrollTop()) <= 300) {
            await _render.renderIcons();
        }
    });

    $('#iconsModal').on('click', '.content_popup_item', e => {
        e.preventDefault();
        edit.loadImageByURL($(e.target).attr('src'));
        $('.close_popup').click();
    });
    // edit.addText("Red text", {
    //     left: 184.96875236928463,
    //     top: 131.64940249839492,
    //     fill: "#f40101",
    //     fontFamily: "Architects Daughter",
    //     scaleX: .4
    // });
    // edit.addText("Blue text", {
    //     left: 184.73382345312382,
    //     top: 225.39165420633793,
    //     fill: "#3700ff",
    // });
    // edit.addText("Pink text", {
    //     left: 185.96874533593655,
    //     top: 327.61640605098853,
    //     fill: "#ff00c8",
    //     scaleX: .5,
    //     scaleY: .5,
    //     charSpacing: 500
    // });

    // TODO FONTS
    let fonts = '';
    for (const font of _fonts) {
        fonts += `<div class="dropdown_option select-font-family" data-name="${font['font-family']}" style="font-family: ${font['font-family']};">
            ${font['font-family']}
        </div>`;
    }

    $('#miniText').find('.dropdown_option_wrapper').html(fonts);
    $('.select-font-family').on('click', e => {
        edit.setFontFamily(e.delegateTarget.dataset.name);
        $('#miniText').find('.dropdown_select').css({ 'font-family': e.delegateTarget.dataset.name });
    });

    await loadQuery();

    document.getElementsByClassName('btn_save')[0].addEventListener('click', async function (e) {
        e.preventDefault();

        const svgLogo = await edit.getCanvasDataURL({ _fonts, padding: 20, type: 'svg' });

        $.ajax({
            url: '/save-user-logo',
            method: 'post',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                logo: svgLogo
            },
            success: function (response) {
                if (response.success) {
                    location.href = '/example-logo'
                }
            }
        })
    });
})();
