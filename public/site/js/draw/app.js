// https://www.freelogodesign.org/
fabric.Text.prototype.setGradient = function (type = "linear", params) {
    let ctx = this.canvas.getContext("2d");

    const w = (this.width * 1/* this.scaleX */);
    const h = (this.height * 1/* this.scaleY */);

    var gradient = ctx.createLinearGradient(
        (params.x1 * w) - w / 2,
        params.y1 * h - h / 2,
        params.x2 * w - w / 2,
        params.y2 * h - h / 2
    );

    gradient.colorStops = [];
    gradient.type = type;
    gradient.x1 = params.x1;
    gradient.y1 = params.y1;
    gradient.x2 = params.x2;
    gradient.y2 = params.y2;

    for (const color of params.colorStops) {
        gradient.colorStops.push({
            color: color.color,
            alpha: color.alpha || color.alpha == 0 ? color.alpha : 1,
            offset: color.offset,
        });

        /// Надо переводить в ргба
        gradient.addColorStop(color.offset, color.color);
    }

    // gradient.addColorStop(0, '#000000');
    // gradient.addColorStop(.5, '#ffffff');
    // gradient.addColorStop(1, '#ff0000');
    //this.setSelectionStyles({fill: gradient},0,this.text.length);
    this.fill = gradient;
};

class Util {
    constructor() {
        this.defaultProperties = ['transparentCorners', '_id', 'fill', '_element_type'];
    }

    getScaleToSize(width, height, widthTo, heightTo) {
        return Math.min(widthTo / width, heightTo / height);
    }

    rgbStringToHex(rgb) {
        rgb = rgb
            .replace(/rgb\(|\)| /g, "")
            .split(",")
            .map((cl) => Number(cl));

        return (
            "#" +
            (rgb && rgb.length === 3 ?
                ("0" + parseInt(rgb[0], 10).toString(16)).slice(-2) +
                ("0" + parseInt(rgb[1], 10).toString(16)).slice(-2) +
                ("0" + parseInt(rgb[2], 10).toString(16)).slice(-2) :
                rgb)
        );
    }

    getUniqGradient(edit, objects) {
        objects = objects || this.canvas.getActiveObjects();
        const colors = edit.getAllColors(objects);
        if (colors.length) {
            const firstColor = colors[0];
            let isInvalid = firstColor._ids.find(id => typeof id != 'object');
            if (isInvalid) return false;

            const allGradients = edit.getObjectsList(objects).map(obj => obj.fill);
            if (allGradients.reduce((bad, gradient) => (typeof gradient != 'object' || !gradient.colorStops) ? true : bad, false)) {
                return false;
            }

            if (allGradients.reduce((bad, gradient) => {
                if (gradient.colorStops.length == 1) {
                    bad = true
                }

                return bad;
            }, false)) {
                return false;
            }

            const firstGradient = allGradients[0];
            for (const gradient of allGradients) {
                if (gradient.colorStops.length != firstGradient.colorStops.length) {
                    return false;
                }

                for (const color of firstGradient.colorStops) {
                    const byOffset = gradient.colorStops.find(cl => cl.offset == color.offset && color.offset != undefined);
                    if (!byOffset || byOffset.color != color.color) {
                        return false;
                    }
                }
            }

            // for (const color of colors) {
            //     color._ids.forEach((id, index) => {
            //         const firstId = color._ids[0];

            //         const params = firstColor._ids[index];
            //         if (params.id != id.id || firstId.offset != id.offset || firstId.gradientIndex != id.gradientIndex) {
            //             console.log(1, params.id != id.id, firstId.offset != id.offset, firstId.gradientIndex != id.gradientIndex);
            //             console.log(2, params.id, id.id, firstId.offset, id.offset, firstId.gradientIndex, id.gradientIndex);
            //             isInvalid = true;
            //         }
            //     });

            //     if (isInvalid) return false;
            // }

            return true;
        } else {
            return false;
        }
    }

    isUniqColor(colors = [], edit) {
        if (colors.length != 1) return false;

        const uniqIds = colors[0]._ids.reduce((uniqIds, idObject) => {
            let currentId = typeof idObject == 'object' ? idObject.id : idObject;
            if (!uniqIds.find(id => id == currentId)) {
                uniqIds.push(currentId);
            }

            return uniqIds;
        }, []);

        const allIds = colors[0]._ids.reduce((allIds, idObject) => {
            let currentId = typeof idObject == 'object' ? idObject.id : idObject;
            allIds.push(currentId);

            return allIds;
        }, []);

        const ln = allIds.length == uniqIds.length;
        if (!ln) return false;

        if (!edit) return false;
        const allObjects = edit.getObjectsList().filter(obj => uniqIds.find(uniqId => uniqId == obj._id) && typeof obj.fill == 'object');
        for (const obj of allObjects) {
            if (obj.fill.colorStops.length > 1) {
                return false;
            }
        }

        return true;
    }

    getControlPointsGradient(edit, objects) {
        const colors = edit.getObjectsList(objects).filter(obj => typeof obj.fill == 'object' && obj.fill.colorStops);

        let controlPoints = [];
        const firstColor = colors[0];
        for (const color of firstColor.fill.colorStops) {
            controlPoints.push(`${color.color} ${color.offset * 100}%`);
        }

        return controlPoints;
    }

    fillGradientToHex(gradient) {
        const defaultColor = "#ff0000";
        if (gradient.colorStops) {
            return gradient.colorStops;
            try {
                const colors = [];

                // for(const color of gradient.colorStops) {
                //     if (/^rgb\(/.test(color.color)) {
                //         colors.push(this.rgbStringToHex(color));
                //     } else {
                //         colors.push( 
                //     }
                // }
                const color = gradient.colorStops[0].color;
                return color;
                // if (/^rgb\(/.test(color)) {
                //     return this.rgbStringToHex(color);
                // } else {
                //     //console.log("fillGradientToHex (not RGB)", gradient);
                //     return defaultColor;
                // }
            } catch (err) {
                console.error(err);
                return defaultColor;
            }
        } else {
            console.log("fillGradientToHex", gradient);

            return defaultColor;
        }
    }

    rangeRandomNum(min, max) {
        return parseInt(min + Math.random() * (max - min));
    }

    uuidv4(prefix = '') {
        return prefix + 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }

    async JSONToFabricObject(json) {
        return await new Promise(resolve => fabric.util.enlivenObjects(json, objects => resolve(objects)));
    }
}

class History {
    constructor(edit) {
        this.util = new Util();
        this.store = [];
        this.canvas = edit.canvas;
        this.edit = edit;

        this.canvas.on('object:modified', e => this.objectModify(e));
        this.canvas.on('object:added', e => this.objectAdded(e));

        this.selected = null;
        this.events = [];
    }

    addEvent(event = {}) {
        this.events.push(event);
    }

    getSelectedIndex() {
        return this.store.findIndex(st => st._id == this.selected && this.selected);
    }

    getStatus() {
        const indexSelected = this.getSelectedIndex();

        return {
            undo: indexSelected == -1 ? false : indexSelected >= 0,
            redo: indexSelected == -1 ? this.store.length >= 1 : indexSelected < this.store.length - 1
        };
    }

    async setChangesFromSelected(incr = 1) {
        this.lockSaveToStore = true;

        const result = await (async () => {
            const indexSelected = this.getSelectedIndex();
            const currentSelected = this.store[indexSelected];
            const change = this.store[indexSelected + incr];

            // Add first
            if (indexSelected == -1 && this.store.length >= 1 && this.store[0].type == 'add') {
                const object = (await this.util.JSONToFabricObject([this.store[0].data]))[0];
                this.canvas.add(object);
                this.selected = this.store[0]._id;

                return;
            }

            if (['add-ungrouping', 'add-grouping'].find(g => currentSelected.type == g) && incr == -1) {
                await this.edit.reloadFromJSON(currentSelected.data.before);
            }

            // if (currentSelected.type == 'add-grouping' && incr == 1) {
            //     await this.edit.reloadFromJSON(change.data.before);
            // }

            // DELETE FIRST
            if (indexSelected == 0 && !change && currentSelected.type == 'add') {
                this.canvas.remove(this.edit.getObjectById(currentSelected.data._id, this.canvas.getObjects()));
                this.selected = null;
                return;
            }

            if (currentSelected.type == 'remove' && incr == -1) {
                for (const obj of currentSelected.data.objects) {
                    if (!this.edit.getObjectById(obj._id)) {
                        const object = (await this.util.JSONToFabricObject([obj]))[0];
                        this.canvas.add(object);
                    }
                }
            }

            // change background
            if (currentSelected.type == 'backgroundColor' && incr == -1) {
                const changesBackgroundColor = this.sortStore(this.getChangesToSelected(change._id).filter(ch => ch.type == 'backgroundColor'), -1);
                const color = changesBackgroundColor[0] ? changesBackgroundColor[0].data.color : 'rgba(0, 0, 0, 0)';
                this.canvas.backgroundColor = color;
                // Найти старый цвет ближайший или же rgba(0, 0, 0, 0);
            }

            // to group

            if (['add-ungrouping', 'add-grouping'].find(ch => ch == change.type)) {
                await this.edit.reloadFromJSON(change.data.current);
            } else if (change.type == 'backgroundColor') {
                this.canvas.backgroundColor = change.data.color;
            } else {
                if (!currentSelected || !change) return;

                let changesData = (change.data.type == 'activeSelection' ? change.data.objects : [change.data]);
                let changeObjects = changesData.map(obj => this.edit.getObjectById(obj._id));

                for (let q = 0; q < changeObjects.length; q++) {
                    const object = changeObjects[q];

                    await this.setChanges(change, object, changesData[q], incr);
                }

                if (incr < 0) {
                    const activeChanges = this.getChangesToSelected(change._id);

                    for (const object of (currentSelected.data.type == 'activeSelection' ? currentSelected.data.objects : [currentSelected.data])) {
                        const lastChange = this.sortStore(activeChanges, -1).find(ch => {
                            if (ch.data.type == 'activeSelection') {
                                return ch.data.objects.find(co => co._id == object._id);
                            } else {
                                return ch.data._id == object._id;
                            }
                        });

                        if (lastChange && !['add-ungrouping', 'add-grouping'].find(g => g == lastChange.type)) {
                            let changesData = lastChange.data.type == 'activeSelection' ? lastChange.data.objects.find(ob => ob._id == object._id) : lastChange;

                            await this.setChanges({ type: 'modify-active' }, this.edit.getObjectById(object._id), changesData.data, incr);
                        }
                    }
                }
            }

            // REMOVE ALL OLD OBJECTS
            if (incr == -1) {
                const changes = this.store.filter(st => st && st.type == 'add' && st.time > change.time);
                for (const change of changes) {
                    for (const objChange of (change.type == 'activeSelection' ? change.objects : [change.data]).filter(ch => ch)) {
                        const object = this.edit.getObjectById(objChange._id);

                        this.canvas.remove(object);
                    }
                }
            }

            this.selected = change._id;
        })();

        this.canvas.discardActiveObject();
        this.canvas.renderAll();
        this.lockSaveToStore = false;
        return result;
    }

    async setChanges(change, object, changeData, incr) {
        const type = change.type;
        switch (true) {
            case type == 'add': {
                if (object) {
                    this.setModifyObject(object, changeData, object);
                } else {
                    const object = (await this.util.JSONToFabricObject([changeData]))[0];
                    this.canvas.add(object);
                }

                break;
            }

            case /^modify\-/g.test(type): {
                this.setModifyObject(object, changeData, object);

                object.setCoords();
                break;
            }

            case type == 'remove': {
                if (incr == 1) {
                    this.canvas.remove(object);
                }

                break;
            }
        }
    }

    setModifyObject(object, change, currentObject) {
        if (object.type == 'group') {
            for (const obj of object.getObjects()) {
                const changeObjectInGroup = change.objects.find(o => o._id == obj._id);

                if (changeObjectInGroup) {
                    const diff = this.getDifferenceObjects(changeObjectInGroup, obj);
                    //console.log(diff);
                    obj.set(diff);
                }
            }
        }

        const params = this.getDifferenceObjects(change, currentObject);
        console.log(params);
        object.set(params);
    }

    getDifferenceObjects(obj1, obj2, keys) {
        const change = {};
        for (const key in obj1) {
            if (obj2[key] != obj1[key] && key != 'objects' && key != 'path' /* (keys ? !!keys.find(k => k == key) : true) */) {
                change[key] = obj1[key];
            }
        }

        return change;
    }

    getChangesToSelected(id) {
        const selected = this.store.find(change => change._id == (id || this.selected));
        if (!selected) return;

        return this.sortStore(this.store.filter(change => change.time <= selected.time));
    }

    sortStore(store, by = 1) {
        return (store || this.store).sort((a, b) => {
            if (a.time > b.time) return by == 1 ? 1 : -1;
            if (a.time < b.time) return by == 1 ? -1 : 1;

            return 0;
        });
    }

    async undo() {
        if (!this.getStatus().undo) return;
        await this.setChangesFromSelected(-1);
    }

    async redo() {
        if (!this.getStatus().redo) return;
        await this.setChangesFromSelected(1);
    }

    resetStore() {
        this.store = [];
        this.selected = '';
    }

    emitEvent(name, data) {
        for (const event of this.events) {
            if (event.name == name && typeof event.callback == 'function') {
                event.callback(data);
            }
        }
    }

    addChange(type, data) {
        if (this.lockSaveToStore) return;
        const _id = this.util.uuidv4();
        if (this.store.find(st => st._id == _id))
            return this.addChange(type, data);

        this.removeLaterSelected();

        const object = { _id, time: Date.now(), type, data };
        this.store.push(object);
        this.selected = _id;

        this.emitEvent('addChange', object);
    }

    removeLaterSelected() {
        const indexSelected = this.getSelectedIndex();
        this.store.splice(indexSelected + 1);
    }

    objectAdded(e) {
        if (e.target) {
            const isLoaded = ['clip', 'background'].find(q => e.target._element_type == q);

            const clipElement = this.canvas.getObjects().find(obj => obj._element_type == 'clip');
            if (clipElement && !isLoaded) {
                e.target.clipPath = new fabric.Rect({
                    left: clipElement.left,
                    top: clipElement.top,
                    width: clipElement.width,
                    height: clipElement.height,
                    absolutePositioned: true
                });
            }

            if (!isLoaded) {
                this.addChange('add', e.target.toJSON(this.util.defaultProperties));
            }
        }
    }

    objectModify(e) {
        if (e.target && e.transform) {
            this.canvas.discardActiveObject();
            let json = e.target.toJSON(this.util.defaultProperties);
            this.edit._setActiveObjects(e.target.type == 'activeSelection' ? e.target._objects : [e.target]);
            this.addChange(`modify-${e.transform.action}`, json);
        }
    }

    objectRemoved(objects) {
        let json = {
            type: 'activeSelection',
            objects: objects.map(object => object.toJSON(this.util.defaultProperties))
        };

        this.addChange(`remove`, json);
    }

    pathCreated(e) {
        console.log('pathCreated', e);
    }
}

class LogoEditor {
    constructor(canvasId, callbackEvents = [], options = {}) {
        // if(edit){
        // 	return;
        // }

        this.lastTimeGradient = Date.now();
        this.util = new Util();

        this.canvas = new fabric.Canvas(canvasId || "canvas", {
            width: 300,
            height: 300,
            backgroundColor: "rgba(0, 0, 0, 0)",
            transparentCorners: false,
            preserveObjectStacking: true,
            ...options,
            //minCacheSideLimit: 10000
        });

        this.canvas.on('object:added', e => {
            if (e.target && !e.target._id) {
                e.target._id = this.util.uuidv4() + '_' + Date.now()
            }
        });
        //this.fitToScreen();
        this.setCallbackEvents(callbackEvents);
        this.history = new History(this);

    }

    getObjectById(_id, objects) {
        for (const object of objects || this.canvas.getObjects()) {
            if (object._id == _id) {
                return object;
            }
            if (object.type == 'group') {
                const obj = this.getObjectById(_id, object.getObjects());
                if (obj) return obj;
            }
        }

        return;
    }

    dispose() {
        this.canvas.getObjects().forEach(obj => this.canvas.remove(obj));
        this.history.resetStore();
        this.canvas.renderAll();
    }

    setGradientToObjects(objects = this.canvas.getActiveObjects(), gradientColors = [], opts = {}) {
        const objectsParsed = this.getObjectsList(objects);

        for (const obj of objectsParsed) {
            const objType = this.getObjectType(obj);
            switch (objType) {
                case 'text': {
                    obj.setGradient('linear', {
                        x1: 0, x2: 1, y1: .5, y2: .5,
                        colorStops: gradientColors
                    });
                    break;
                }

                case 'path': {
                    obj.set('fill', new fabric.Gradient({
                        type: 'linear',
                        coords: {
                            x1: 0, x2: 1, y1: .5, y2: .5
                        },
                        gradientUnits: 'percentage',
                        colorStops: gradientColors
                    }));
                    break;
                }
            }
        }

        // if (Date.now() - this.lastTimeGradient > 2000) {
        //     // add to history
        // }

        // this.lastTimeGradient = Date.now();
        this.canvas.renderAll();
    }

    async base64FromJSON(data) {
        if (!document.getElementById('hiddenCanvas')) {
            let canvas = document.createElement('canvas');
            canvas.setAttribute('id', 'hiddenCanvas');
            document.body.appendChild(canvas);
        }

        let ed = new LogoEditor(`hiddenCanvas`);
        return new Promise(resolve => {
            fabric.util.enlivenObjects([data], objects => {
                objects.forEach(obj => {
                    ed.canvas.add(obj)
                });
                ed.canvas.renderAll();

                resolve(ed.canvas.getObjects()[0].toDataURL());
            });
        });
    }

    showContextTopByObjectId(_id, isShow, params = {}, objects) {
        this.canvas.clearContext(this.canvas.contextTop);
        if (!isShow) return;

        for (let obj of objects || this.canvas.getObjects()) {
            if (obj.type == "group") {
                const obj2 = this.showContextTopByObjectId(
                    _id,
                    isShow,
                    params,
                    obj.getObjects()
                );
                if (obj2) return true;
            } else if (obj._id == _id) {
                obj._renderControls(this.canvas.contextTop, {
                    hasControls: false,
                    overBorderColor: "#febe88",
                    borderDashArray: [],
                    overSelectColor: "rgba(255, 243, 233, .3)",
                    ...params,
                });

                return true;
            }
        }
    }

    getObjectIndex() {
        edit.getObjectsList();
    }

    getObjectsList(objects, imprint = false) {
        function parseGroups(objects) {
            return (objects || this.canvas.getObjects()).reduce((arr, obj) => {
                if (obj.type == "group") {
                    arr.push(...parseGroups(obj.getObjects()));
                } else {
                    arr.push(obj);
                }

                return arr;
            }, []);
        }

        const objs = parseGroups(objects || this.canvas.getObjects()).sort(
            (a, b) => {
                if (a._timestamp > b._timestamp) return 1;
                if (a._timestamp < b._timestamp) return -1;
                return 0;
            }
        );

        if (imprint) {
            return JSON.stringify(objs.map(obj => obj._id)).replace(/"/g, '_').replace(/\[|\]/g, '=');
        }

        return objs;
    }

    setCallbackEvents(callbackEvents = []) {
        this.callbackEvents = callbackEvents;

        for (const event of callbackEvents.filter(
            (callback) => callback.isCanvas
        )) {
            this.canvas.on(event.name, (e) => event.func(e));
        }
    }

    setBackgroundColor(color, isUpdate = false) {
        this.canvas.backgroundColor = color;

        if (isUpdate) {
            this.history.addChange('backgroundColor', { color });
        }

        this.canvas.renderAll();
    }

    setTextAlign(textAlign) {
        if (!["left", "center", "right"].find((te) => te == textAlign)) return;

        const selectedObjects = this.canvas.getActiveObjects();
        if (
            selectedObjects.length == 1 &&
            this.getObjectType(selectedObjects[0]) == "text"
        ) {
            selectedObjects[0].set({ textAlign });
            this.canvas.renderAll();
        }
    }

    setActiveObjectById(id, objects) {
        const obj = (objects || this.canvas.getObjects()).find((obj) => {
            if (obj.type == "group") {
                this.setActiveObjectById(id, obj.getObjects());
                return false;
            }

            return obj._id == id;
        });
        if (obj) {
            this.canvas.setActiveObject(obj);
            this.canvas.renderAll();
        }
    }

    async dublicateActiveObjects() {
        // const selectedObjects = this.canvas.getActiveObjects();
        // this.canvas.discardActiveObject();

        // function replaceIds(objects) {
        //     return objects.map((obj) => {
        //         if (obj.type == "group") {
        //             obj._objects = replaceIds(obj._objects);
        //         } else {
        //             obj.set({
        //                 _id: `${obj._id.split("-")[0]}-${Date.now()}_dublicate_${parseInt(
        //                     Math.random() * 100000000000000
        //                 )}`,
        //             });
        //         }

        //         return obj;
        //     });
        // }

        // const clonedObjects = selectedObjects.reduce((clones, obj) => {
        //     clones.push(fabric.util.object.clone(obj));

        //     return clones;
        // }, []);

        // replaceIds(clonedObjects).forEach((obj) => {
        //     this.canvas.add(obj);
        // });

        // this._setActiveObjects(clonedObjects);
        // this.canvas.renderAll();

        const temp = this.copiedObjects;

        edit.copySelectedObject();
        await edit.pasteCopiedObjects();

        this.copiedObjects = temp;
    }

    async exportSVGByClip(isBackground = false, isPng = false) {
        let rect = edit.canvas.getObjects().find(o => o._element_type == (isBackground ? 'background' : 'clip'));
        const width = rect.width * rect.scaleX;
        const height = rect.height * rect.scaleY;

        if (isPng) {
            const clip = edit.canvas.getObjects().find(o => o._element_type == 'clip');
            clip.set({ opacity: 0 });

            const multiplier = Math.min(1024 / width, 1024 / height);
            const b64 = this.canvas.toDataURL({
                multiplier, left: rect.left,
                top: rect.top,
                width, height
            });

            clip.set({ opacity: 1 });
            return b64;
        }

        window.logoEditor = new LogoEditor('downloadCanvas', [], { width, height });
        edit.canvas.getObjects().forEach(o => {
            if (!isBackground && o._element_type == 'background') { } else {
                const clone = fabric.util.object.clone(o);
                clone.set({
                    left: clone.left - rect.left,
                    top: clone.top - rect.top,
                    opacity: o._element_type == 'clip' ? 0 : o.opacity
                });

                logoEditor.canvas.add(clone);
            }
        });

        logoEditor.canvas.renderAll();

        const blob = new Blob([await edit.parseSVGBeforeDownload(logoEditor.canvas.toSVG({
            suppressPreamble: true,
            viewBox: {
                x: 0,
                y: 0,
                width: logoEditor.canvas.width,
                height: logoEditor.canvas.height
            },
            width: logoEditor.canvas.width,
            height: logoEditor.canvas.height
        }), _fonts)], {
            type: "image/svg+xml"
        });

        logoEditor.canvas.dispose();

        const reader = new FileReader();
        reader.readAsDataURL(blob);

        return await new Promise((resolve, reject) => {
            reader.onloadend = () => resolve(reader.result);
            reader.onerror = reject;
        });
    }

    exportRect() {
        return this.canvas.getObjects().reduce((size, obj, index) => {
            const right = obj.left + (obj.width * obj.scaleX);
            const bottom = obj.top + (obj.height * obj.scaleY);
            const left = obj.left;
            const top = obj.top;

            if (index == 0) return { right, left, top, bottom };
            if (left < size.left) { size.left = left; }
            if (top < size.top) { size.top = top; }
            if (right > size.right) { size.right = right; }
            if (bottom > size.bottom) { size.bottom = bottom; }

            return size;
        }, { left: 0, top: 0, right: 0, bottom: 0 });
    }

    exportThumbail(size = { w: 100, h: 100 }, opts = {}) {
        let rect = this.exportRect();

        const width = rect.right - rect.left;
        const height = rect.bottom - rect.top;
        const multiplier = Math.min(size.w / width, size.h / height);

        return edit.canvas.toDataURL({ ...rect, width, height, multiplier, ...opts });
    }

    async getFontsOnCanvas(fontsData) {
        let fonts = ``;
        let fontsNames = [];

        function parseFontFamily(objects) {
            let fn = [];
            for (const obj of objects) {
                if (obj.type == "group") {
                    fn = [...fn, ...parseFontFamily(obj.getObjects())];
                } else {
                    const fontFamily = obj.fontFamily;
                    if (fontFamily && !fontsNames.find((font) => font == fontFamily)) {
                        fn.push(fontFamily);
                    }
                }
            }

            return fn;
        }

        fontsNames = parseFontFamily(this.canvas.getObjects());
        for (const fontName of fontsNames) {
            const font = fontsData.find((f) => f["font-family"] == fontName);
            if (font) {
                try {
                    let src = /\/site\//.test(font.src) ? await (async () => {
                        return new Promise(async (resolve, reject) => {
                            const reader = new FileReader();
                            const blob = await fetch(font.src).then(r => r.blob()).catch(reject);
                            reader.readAsDataURL(blob);
                            reader.onloadend = () => resolve(reader.result);
                            reader.onerror = () => reject(err);
                        });
                    })() : font.src;

                    fonts += `<style type="text/css"><![CDATA[
                            @font-face {
                                font-family: ${font["font-family"]};
                                src: url('${src}');
                            }
                        ]]></style>`;
                } catch (err) {
                    console.error('Error font loading...', font);
                }
            }
        }

        return fonts;
    }

    async parseSVGBeforeDownload(svg, fontData = []) {
        //        console.log(1, svg);
        //        const svgDescription = `Created with logo editor ${new Date().toLocaleString()}`;
        //        const defs = svg.split("<defs>");
        //        const fonts = this.getFontsOnCanvas(fontData);
        //        console.log(232, fonts);
        //        svg = `${defs[0]}<defs>${fonts}${defs[1]}`;

        //        function parseDescription(svg) {
        //            let cloneSvg = svg;
        //            const desc = cloneSvg.split("<desc>");

        //            try {
        //                cloneSvg = `${desc[0]}<desc>${svgDescription}</desc>${desc[1].split("</desc>")[1]}`;
        //            } catch (err) {
        //                return svg;
        //            }

        //            return cloneSvg;
        //        }

        //        console.log(2, svg);
        //        svg = parseDescription(svg);

        //        return svg;
        const svgDescription = `Created with logo editor ${new Date().toLocaleString()}`;
        const fonts = await this.getFontsOnCanvas(fontData);
        var svg = $(svg);
        svg.prepend(`<defs>${fonts}</fonts>`);
        $(svg).find("desc").html("Create with Free Logo Design v1.0");
        return svg[0].outerHTML;
    }

    removeSelectedObjects() {
        const objects = this.canvas.getActiveObjects();
        objects.forEach((obj) => this.canvas.remove(obj));
        this.canvas.discardActiveObject();

        // history
        this.history.objectRemoved(objects);

        this.canvas.renderAll();
    }

    setFillColorsByIds(ids = [], color, objects) {
        const objs = [];

        for (const obj of objects || this.canvas.getObjects()) {
            if (obj.type == "group") {
                objs.push(...this.setFillColorsByIds(ids, color, obj.getObjects()));
            } else {
                if (ids.find((_id) => _id == obj._id)) {
                    obj.set({ fill: color });
                    objs.push(obj);
                }
            }
        }

        this.canvas.renderAll();

        return objs;
    }

    getAllColors(objects, colors = [], byOffset = false) {
        for (const obj of objects || this.canvas.getObjects()) {
            if (obj.type == "group") {
                colors = this.getAllColors(obj.getObjects(), colors);
            } else {
                if (obj.fill) {
                    let fill = obj.fill;
                    if (typeof fill == "object") {
                        fill = this.util.fillGradientToHex(fill);
                        fill.forEach((color, gradientIndex) => {
                            const colorIndex = colors.findIndex(cl => cl.fill == color.color);

                            if (colorIndex == -1) {
                                colors.push({
                                    fill: color.color, _ids: [{ id: obj._id, gradientIndex, offset: color.offset }]
                                });
                            } else {
                                colors[colorIndex]._ids.push({ id: obj._id, gradientIndex, offset: color.offset });
                            }
                        });
                    } else {
                        const colorIndex = colors.findIndex(cl => cl.fill == fill);

                        if (colorIndex != -1) {
                            colors[colorIndex]._ids.push(obj._id);
                        } else {
                            colors.push({ fill: fill, _ids: [obj._id] });
                        }
                    }
                }
            }
        }

        return colors;
        /* .reduce((uniq, color) => {
                            if(!uniq.find(cl => cl == color)) {
                                uniq.push(color);
                            }
 
                            return uniq;
                        },[]); */
    }

    setObjectsIds(objects, id) {
        return objects.map((obj, i) => {
            let prefix = "shape";
            if (obj.text) {
                prefix = "text";
            }

            obj._id = `${prefix}-${Date.now()}_${i}_${id}_${this.util.rangeRandomNum(100000, 1000000)}`;
            obj._timestamp = Date.now();
            obj.transparentCorners = false;

            return obj;
        });
    }

    async loadImageByURL(url, prefix, active_by_default = true, opts = {}) {
        if (!url) return;
        if (/\.svg+$/.test(url)) {
            return await this.loadSVGByURL(url, prefix);
        } else {
            return await new Promise(resolve => {
                fabric.Image.fromURL(url, img => {
                    img = this.setObjectsIds([img], 'raster_graphics')[0];

                    img.set({ ...this.groupToCenter(img), ...opts });

                    this.canvas.add(img)
                    if (active_by_default) {
                        this.canvas.setActiveObject(img);
                    }
                    this.canvas.renderAll();
                    resolve(img);
                });
            });
        }
    }

    addFromJsonByType(data, id, callback, opts = {}) {
        fabric.util.enlivenObjects([data], (objects) => {
            let fabricGroup;
            if (objects[0].type == "group") {
                objects[0]._objects = this.setObjectsIds(objects[0]._objects, id);
                fabricGroup = objects[0];
            } else {
                objects = this.setObjectsIds(objects, id);
                fabricGroup = new fabric.Group(objects);
            }

            const w = fabricGroup.width * fabricGroup.scaleX;
            const h = fabricGroup.height * fabricGroup.scaleY;
            fabricGroup.set({
                left: this.canvas.width / 2 - w / 2,
                top: this.canvas.height / 2 - h / 2,
                transparentCorners: false,
                _id: this.util.uuidv4(`group-${Date.now()}`),
                ...opts
            });

            this.canvas.add(fabricGroup).setActiveObject(fabricGroup);
            this.canvas.renderAll();

            if (callback) callback();
        });
    }

    // #opts
    // isOriginalSize - load svg as original size
    groupToCenter(fabricGroup, opts = {}) {
        const clip = edit.canvas.getObjects().find(o => o._element_type == 'clip');

        let w = fabricGroup.width * fabricGroup.scaleX;
        let h = fabricGroup.height * fabricGroup.scaleY;
        let scaleX = fabricGroup.scaleX;
        let scaleY = fabricGroup.scaleY;

        //let left = this.canvas.width / 2 - w / 2;
        //let top = this.canvas.height / 2 - h / 2;
        let left = (this.canvas.width - w) / 2;
        let top = (this.canvas.height - h) / 2;

        if (clip) {
            const clipW = clip.width * clip.scaleX;
            const clipH = clip.height * clip.scaleY;

            const min = Math.min(clipW, clipH) * .9;
            const scale = Math.min(min / fabricGroup.width, min / fabricGroup.height);

            scaleX = scale;
            scaleY = scale;

            left = clip.left + (clipW - (fabricGroup.width * scale)) / 2;
            top = clip.top + (clipH - (fabricGroup.height * scale)) / 2;

            if(fabricGroup.originX == 'center') {
                left += (fabricGroup.width * scale) / 2;
            }

            if(fabricGroup.originY == 'center') {
                top += (fabricGroup.height * scale) / 2;
            }
        } else {
            if (!opts.isOriginalSize) {
                //let size = Math.min(this.canvas.getWidth(), this.canvas.getHeight());
                //size -= (size * .5);
                //const scale = this.util.getScaleToSize(fabricGroup.width, fabricGroup.height, size, size);
                //scaleX = scale;
                //scaleY = scale;

                //w = fabricGroup.width * scale;
                //h = fabricGroup.height * scale;
                const scale = Math.min(
                    this.canvas.width * .8 / fabricGroup.width,
                    this.canvas.height * .8 / fabricGroup.height
                );                

                if(fabricGroup.width > fabricGroup.width * scale || fabricGroup.height > fabricGroup.height * scale) {
		            scaleX = scale;
		            scaleY = scale;
                
                    w = fabricGroup.width * scale;
                    h = fabricGroup.height * scale;

                    left = (this.canvas.width - (fabricGroup.width * scale)) / 2;
                    top = (this.canvas.height - (fabricGroup.height * scale)) / 2;
                }
            }
        }

        return {
            left, top,
            transparentCorners: false,
            scaleX, scaleY,
            _id: this.util.uuidv4(`group-${Date.now()}`)
        };
    }


    async loadSVGByURL(url, prefix = 'loaded_svg', opts = {}) {
        return await new Promise(resolve => {
            fabric.loadSVGFromURL(url, objects => {
                objects = this.setObjectsIds(objects, prefix);
                let fabricGroup = new fabric.Group(objects);
                fabricGroup.set(this.groupToCenter(fabricGroup));

                this.canvas.add(fabricGroup).setActiveObject(fabricGroup);
                this.canvas.renderAll();

                resolve();
            });
        });
    }

    isGroup(objects) {
        for (const obj of objects) {
            if (obj.type == "group") {
                return true;
            }
        }

        return false;
    }

    recurseUnGroup(objects) {
        let temp = [];
        for (let obj of objects) {
            if (obj.type == "group") {
                var items = obj._objects;
                obj._restoreObjectsState();
                this.canvas.remove(obj);
                for (var i = 0; i < items.length; i++) {
                    this.canvas.add(items[i]);
                }

                temp = [
                    ...temp,
                    ...items.map((t) => (t && t._id ? t._id : null)).filter((t) => t),
                    ...this.recurseUnGroup(items),
                ];
            }
        }

        return temp;
    }

    async reloadFromJSON(json) {
        this.canvas.getObjects().forEach(o => this.canvas.remove(o));
        return await new Promise(resolve => this.canvas.loadFromJSON(json, () => { this.canvas.renderAll(); resolve(); }));
    }

    changeGroupStatusActiveObjects(objects, lockActive = false, lockHistory = false) {
        const toJSONBeforeRender = this.canvas.toJSON(this.util.defaultProperties);

        const selectedObjects = objects || this.canvas.getActiveObjects();
        if (selectedObjects.length == 1 && selectedObjects[0].type != 'group') return;

        const activeObject = this.canvas.getActiveObject();
        this.canvas.discardActiveObject();

        // Разгруппировать
        if (
            this.isGroup(
                selectedObjects
            ) /* selectedObjects.find(obj => obj.type == 'group') && selectedObjects.length == 1 */
        ) {
            const notGroup = selectedObjects
                .map((obj) => (obj && obj.type != "group" ? obj._id : null))
                .filter((t) => t);

            // var items = group._objects;
            // group._restoreObjectsState();
            // this.canvas.remove(group);
            // for (var i = 0; i < items.length; i++) {
            //     this.canvas.add(items[i]);
            // }

            this.history.lockSaveToStore = true;
            const ids = this.recurseUnGroup(selectedObjects);
            this.history.lockSaveToStore = false;

            if (!lockHistory) {
                this.history.addChange('add-ungrouping', { current: this.canvas.toJSON(this.util.defaultProperties), before: toJSONBeforeRender }/* {
                    objects: (() => {
                        const objects = this.canvas.getObjects();
                        function getObjectsByIds(objects) {
                            const objs = [];
                            for(const object of objects) {
                                if(object.type == 'group') {
                                    objs.push(...getObjectsByIds());
                                } else {
                                    if(ids.find(id => id == object._id)) {
                                        objs.push(object);
                                    }
                                }
                            }
    
                            return objs;
                        }
    
                        return getObjectsByIds(objects);
                    })(), type: 'activeSelection'
                } */);
            }

            if (!lockActive) {
                this._setActiveObjects([...ids, ...notGroup], true);
            }

            // let objects = this.parseObjectFromGroup(group);
            // this.canvas.remove(group);

            // for (let obj of objects) {
            //     this.canvas.add(fabric.util.object.clone(obj));
            // }
        } else {
            let objects = [];
            for (const obj of selectedObjects) {
                objects.push(obj);
                this.canvas.remove(obj);
            }

            let options = {};
            if (activeObject) {
                options = {
                    left: activeObject.left || 0,
                    top: activeObject.top || 0,
                    width: activeObject.width,
                    height: activeObject.height,
                    scaleX: activeObject.scaleX,
                    scaleY: activeObject.scaleY,
                    skewX: activeObject.skewX,
                    skewY: activeObject.skewY,
                    _id: this.util.uuidv4(`group-${Date.now()}`)
                };
            }

            // Добавить id
            const group = new fabric.Group(objects, options);

            this.history.lockSaveToStore = true;
            this.canvas.add(group);
            this.history.lockSaveToStore = false;

            if (!lockHistory) {
                this.history.addChange('add-grouping', {
                    current: this.canvas.toJSON(this.util.defaultProperties), before: toJSONBeforeRender
                } /* group.toJSON(this.util.defaultProperties) */);
            }

            this.canvas.renderAll();
            if (!lockActive) {
                this.canvas.setActiveObject(group);
            }
        }

        this.canvas.renderAll();
    }

    async getCanvasDataURL(opts = {}) {
        this.canvas.discardActiveObject();
        const json = JSON.stringify(edit.canvas.toJSON());


        let hiddenBlock;
        if (!document.getElementById('hiddenCanvas')) {
            hiddenBlock = document.createElement('div');
            hiddenBlock.setAttribute('style', 'display: none !important;');

            let canvas = document.createElement('canvas');
            canvas.setAttribute('id', 'hiddenCanvas');

            hiddenBlock.append(canvas);
            document.body.appendChild(hiddenBlock);
        }

        const objects = this.canvas.getObjects();
        if (!objects.length) return;

        let copiedObjects = [];

        for (const object of objects) {
            copiedObjects.push(object.toJSON(this.util.defaultProperties));
        }

        let objs = [];
        for (const obj of copiedObjects) {
            await new Promise(resolve => fabric.util.enlivenObjects([obj], objects => {
                objects.forEach(object => objs.push(object));

                resolve();
            }));
        }
        const incrPadding = opts.padding ? opts.padding / 2 : 0;

        const objectsGroup = new fabric.Group(objs);
        objectsGroup.left = incrPadding;
        objectsGroup.top = incrPadding;

        const backgroundRect = new fabric.Rect({
            height: objectsGroup.height + incrPadding * 2,
            width: objectsGroup.width + incrPadding * 2,
            fill: this.canvas.backgroundColor,
            left: 0, top: 0
        });

        const gr = new fabric.Group([/* backgroundRect,  */objectsGroup]);

        if (opts.w && opts.h) {
            const scale = this.util.getScaleToSize(gr.width, gr.height, opts.w, opts.h);

            gr.set({ scaleX: scale, scaleY: scale });
        }

        if (opts.type == 'svg') {
            var sel = new fabric.ActiveSelection(this.canvas.getObjects(), { canvas: this.canvas });

            this.canvas.discardActiveObject();
            this.canvas.setActiveObject(sel);
            this.canvas.requestRenderAll();

            let svg = this.canvas.toSVG({
                suppressPreamble: true,
                viewBox: {
                    x: sel.left,
                    y: sel.top,
                    width: sel.width,
                    height: sel.height,
                }, width: 300, //Math.max(...rights),
                height: 300, //Math.max(...tops)
            });
            this.canvas.discardActiveObject().renderAll();


            const editorCanvas = new LogoEditor('hiddenCanvas');
            window.q = editorCanvas;
            editorCanvas.canvas.add(gr);
            editorCanvas.canvas.setWidth(gr.width * gr.scaleX + incrPadding * 2);
            editorCanvas.canvas.setHeight(gr.height * gr.scaleY + incrPadding * 2);

            svg = await this.parseSVGBeforeDownload(svg, opts._fonts || []);
            const result = `data:image/svg+xml;base64,${btoa(svg)}`;

            editorCanvas.canvas.dispose();
            if (hiddenBlock) { hiddenBlock.remove(); }

            return result;
        }

        return gr.toDataURL(opts.save || {});
    }

    _setActiveObjects(data, byIds = false, isGroup = false) {
        let objects = data;
        if (byIds) {
            const allObjects = isGroup ? this.canvas.getObjects() : this.getObjectsList();
            objects = [];
            for (const _id of data) {
                const obj = allObjects.find((o) => o && o._id == _id);
                if (obj) {
                    objects.push(obj);
                }
            }
        }

        let select = objects[0];
        if (objects.length != 1) {
            this.canvas.discardActiveObject();
            select = new fabric.ActiveSelection(objects, { canvas: this.canvas });
        }

        this.canvas.setActiveObject(select).renderAll();
    }

    flipObjects(by) {
        const selectedObjects = this.canvas.getActiveObjects();

        for (let object of selectedObjects) {
            if (by == "h") {
                object.flipX = !object.flipX;
            }
            if (by == "v") {
                object.flipY = !object.flipY;
            }
        }

        this.history.objectModify({ target: this.canvas.getActiveObject(), transform: { action: 'flip' } });
        this.canvas.renderAll();
    }

    incrScaleObject({ x, y }) {
        const object = this.canvas.getActiveObject();

        object.set({
            scaleX: x + object.scaleX,
            scaleY: y + object.scaleY,
        });

        this.history.objectModify({ target: object, transform: { action: 'scale' } });
        this.canvas.renderAll();
    }

    incrAngleObjects(value) {
        const object = this.canvas.getActiveObject();

        //for (let object of selectedObjects) {
        let params = {};
        if (object.originX == 'left') {
            params.left = object.left + ((object.width * object.scaleX) / 2);
        }

        if (object.originY == 'top') {
            params.top = object.top + ((object.height * object.scaleY) / 2);
        }

        object.set({
            originX: "center",
            originY: "center",
            angle: object.angle + value,
            ...params
        });
        //}
        this.history.objectModify({ target: object, transform: { action: 'rotate' } });
        this.canvas.renderAll();
    }

    copySelectedObject() {
        const objects = this.canvas.getActiveObjects();
        if (!objects.length) return;

        if (!objects.length == 1) {
            this.canvas.discardActiveObject();
        }

        this.copiedObjects = [];

        for (const object of objects) {
            this.copiedObjects.push(object.toJSON(this.util.defaultProperties));
        }

        if (!objects.length == 1) {
            this._setActiveObjects(objects);
        } else {
            this.canvas.setActiveObject(objects[0]).renderAll();
        }
    }

    async pasteCopiedObjects() {
        if (!this.copiedObjects || !this.copiedObjects.length) return;

        const ids = [];
        for (const obj of this.copiedObjects) {
            await new Promise(resolve => fabric.util.enlivenObjects([obj], objects => {
                objects.forEach(object => {
                    if (object.type == "group") {
                        object._objects = this.setObjectsIds(object._objects, 'group-paste');
                        object._id = `group-${Date.now()}-${this.util.rangeRandomNum(100000, 1000000)}`;
                    } else {
                        object = this.setObjectsIds([object], 'object-paste')[0];
                    }

                    ids.push(object._id);
                    object.left += 10;
                    object.top += 10;

                    this.canvas.add(object);

                    return object;
                });

                resolve();
            }));
        }

        this._setActiveObjects(ids, true, true);
        this.canvas.renderAll();
        // fabric.util.enlivenObjects([data], (objects) => {
        //     let fabricGroup;
        //     if (objects[0].type == "group") {
        //         objects[0]._objects = this.setObjectsIds(objects[0]._objects, id);
        //         fabricGroup = objects[0];
        //     } else {
        //         objects = this.setObjectsIds(objects, id);
        //         fabricGroup = new fabric.Group(objects);
        //     }

        //     const w = fabricGroup.width * fabricGroup.scaleX;
        //     const h = fabricGroup.height * fabricGroup.scaleY;
        //     fabricGroup.set({
        //         left: opts.left || this.canvas.width / 2 - w / 2,
        //         top: opts.top || this.canvas.height / 2 - h / 2,
        //     });

        //     this.canvas.add(fabricGroup).setActiveObject(fabricGroup);
        //     this.canvas.renderAll();

        //     if (callback) callback();
        // });
    }

    setActiveObjectsParams(params = {}) {
        const activeObject = this.canvas.getActiveObject();
        if (!activeObject) return;

        params.left = Number(params.left);
        params.top = Number(params.top);
        params.width = Number(params.width);
        params.height = Number(params.height);
        params.angle = Number(params.angle);

        if (activeObject.originX == 'left' && (params.left || params.left == 0)) {
            activeObject.originX = 'center';
            params.originX = 'center';
        }

        if (activeObject.originY == 'top' && (params.top || params.top == 0)) {
            activeObject.originY = 'center';
            params.originY = 'center';
        }

        if ((params.left || params.left == 0) && activeObject.originX == 'center') {
            params.left += (activeObject.width * activeObject.scaleX) / 2;
        } else {
            delete params.left;
        }

        if ((params.top || params.top == 0) && activeObject.originY == 'center') {
            params.top += (activeObject.height * activeObject.scaleY) / 2;
        } else {
            delete params.top;
        }

        if (params.width || params.width == 0) {
            params.scaleX = params.width / activeObject.width;
            delete params.width;
        } else {
            delete params.width;
        }

        if (params.height || params.height == 0) {
            params.scaleY = params.height / activeObject.height;
            delete params.height;
        } else {
            delete params.height;
        }

        if (!(params.angle || params.angle == 0)) {
            delete params.angle;
        }

        activeObject.set(params);
        this.canvas.renderAll();

        //this._setActiveObjects(objects);
    }

    getObjectPositions(target) {
        const left = Math.round(target.originX == 'center' ? (target.left - (target.width * target.scaleX) / 2) : target.left);
        const top = Math.round(target.originY == 'center' ? (target.top - (target.height * target.scaleY) / 2) : target.top);
        const width = Math.round(target.width * target.scaleX);
        const height = Math.round(target.height * target.scaleY);

        return { left, top, height, width, angle: Math.round(target.angle) };
    }

    changeCharSpacing(charSpacing, isUpdate = false) {
        const objects = this.canvas.getActiveObjects();
        charSpacing = Number(charSpacing);

        if (objects.length != 1 || this.getObjectType(objects[0]) != 'text'
            || (!charSpacing && charSpacing != 0) || charSpacing < 0) return;

        const text = objects[0];

        text.set({ charSpacing });

        if (isUpdate) {
            this.history.objectModify({ target: this.canvas.getActiveObject(), transform: { action: 'text-char-spacing' } });
        }

        this.canvas.renderAll();
    }

    layerOrder(to, position) {
        position = Number(position);
        const activeObjects = this.canvas.getActiveObjects();

        for (const obj of activeObjects) {
            const index = this.canvas.getObjects().indexOf(obj);

            if (index != -1) {
                switch (to) {
                    case 'down': {
                        if (index > 0)
                            obj.moveTo(index - 1);
                        break;
                    }

                    case 'up': {
                        obj.moveTo(index + 1);
                        break;
                    }

                    case 'down-all': {
                        obj.moveTo(0);
                        break;
                    }

                    case 'up-all': {
                        obj.moveTo(this.canvas.getObjects().length);
                        break;
                    }

                    case 'to': {
                        if ((position || position == 0) && position >= 0) {
                            obj.moveTo(position);
                        }
                        break;
                    }
                }
            } else {
                console.warn('Bad layer order', obj);
            }
        }
    }

    moveObjects(to, incr = false) {
        const object = this.canvas.getActiveObject();

        incr = !incr || !Number(incr) ? 1 : incr;
        switch (to) {
            case "left":
                object.left -= incr;
                break;
            case "top":
                object.top -= incr;
                break;
            case "right":
                object.left += incr;
                break;
            case "bottom":
                object.top += incr;
                break;
        }

        this.history.objectModify({ target: object, transform: { action: 'move' } });
        this.canvas.renderAll();
    }

    // changeSelectedTextColor(color, isUpdate = false) {
    //     const selectedObjects = this.canvas.getActiveObjects();
    //     if (selectedObjects.length == 1) {
    //         if(isUpdate) {
    //             this.history.objectModify({ target: this.canvas.getActiveObject(), transform: { action: 'fill-color' } });
    //         }

    //         selectedObjects[0].set({ fill: color });
    //         this.canvas.renderAll();
    //     }
    // }

    setFontFamily(font) {
        const selectedObjects = this.canvas.getActiveObjects();
        if (
            selectedObjects.length == 1 &&
            this.getObjectType(selectedObjects[0]) == "text"
        ) {
            selectedObjects[0].set({ fontFamily: font });
            this.history.objectModify({ target: this.canvas.getActiveObject(), transform: { action: 'font-family' } });
            this.canvas.renderAll();
        }
    }

    setTextToActiveText(text, isUpdate = false) {
        this.canvas.getActiveObject().set({ text });

        if (isUpdate) {
            this.history.objectModify({ target: this.canvas.getActiveObject(), transform: { action: 'change-text' } });
        }

        this.canvas.getObjects()[0].setCoords();
        this.canvas.renderAll();
    }

    changeFontWeight() {
        const active = this.canvas.getActiveObjects();
        if (active && active.length == 1) {
            active[0].fontWeight = active[0].fontWeight == "bold" ? "normal" : "bold";

            this.canvas.renderAll();
            return active[0].fontWeight;
        }

        this.history.objectModify({ target: this.canvas.getActiveObject(), transform: { action: 'font-weight' } });
        return null;
    }

    changeFontStyle() {
        const active = this.canvas.getActiveObjects();
        if (active && active.length == 1) {
            active[0].fontStyle =
                active[0].fontStyle == "italic" ? "normal" : "italic";

            this.canvas.renderAll();
            return active[0].fontStyle;
        }

        this.history.objectModify({ target: this.canvas.getActiveObject(), transform: { action: 'font-style' } });
        return null;
    }

    getObjectType(obj) {
        if (/^text-/.test(obj._id)) return "text";
        if (obj.type == "group") return "group";

        return obj.type || 'none';
    }

    addText(text, params = {}) {
        const textObject = new fabric.Text(text, {
            fontFamily: "Courier Prime",
            left: this.canvas.width / 2 - 75,
            top: this.canvas.height / 2 - 17,
            height: 10,
            width: 150,
            fill: "#000000",
            centeredScaling: true,
            transparentCorners: false,
            originX: "center",
            originY: "center",
            fontSize: 80,
            ...params,
        });

        textObject.left =
            this.canvas.width / 2 - textObject.width / textObject.scaleX / 2;
        textObject.top =
            this.canvas.height / 2 - textObject.height / textObject.scaleY / 2;

        const clip = edit.canvas.getObjects().find(o => o._element_type == 'clip');

        textObject.set({
            ...params,
            ...(clip ? this.groupToCenter(textObject) : {}),
            objectCaching: false,
            _id: `text-${Date.now()}`,
            _timestamp: Date.now(),
        });

        this.canvas.add(textObject).setActiveObject(textObject);
        this.addEvents(textObject);
        this.canvas.renderAll();
    }

    addEvents(object) {
        for (let callbackEvent of this.callbackEvents) {
            if (!callbackEvent.isCanvas) {
                object.on(callbackEvent.name, (e) => callbackEvent.func(e));
            }
        }
    }
}
