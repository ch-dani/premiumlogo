 <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>
<script>

var LIST = [
	{appid:'anb_fxml',name:'FXMLPlayer',url:'http://msx.fxml.ru',text:'FXMLPlayer СЌС‚Рѕ РїСЂРѕРіСЂР°РјРјР° РґР»СЏ СѓРґРѕР±РЅРѕРіРѕ РїСЂРѕСЃРјРѕС‚СЂР° С‚РІ, С„РёР»СЊРјРѕРІ, С‚РµР»РµРїРµСЂРµРґР°С‡ Рё РґСЂСѓРіРѕРіРѕ'},
    {appid:'anb_appstore',name:'AlexxNB AppStore',url:'http://hisense.alexxnb.ru',text:'AlexxNB AppStore - РЎР°РјС‹Р№ РјР°Р»РµРЅСЊРєРёР№ РІ РјРёСЂРµ РјР°РіР°Р·РёРЅ РїСЂРёР»РѕР¶РµРЅРёР№ РґР»СЏ С‚РµР»РµРІРёР·РѕСЂРѕРІ Hisense. РџСЂРµРґР»Р°РіР°РµС‚ РЅР°РёР±РѕР»РµРµ РІРѕСЃСЃС‚СЂРµР±РѕРІР°РЅРЅС‹Рµ РїСЂРёР»РѕР¶РµРЅРёСЏ, РѕС‚СЃСѓС‚СЃС‚РІСѓСЋС‰РёРµ РІ РјР°РіР°Р·РёРЅРµ С‚РµР»РµРІРёР·РѕСЂР°.'},
    {appid:'anb_vewd',name:'VEWD App Store',url:'https://hisense.tvstore.opera.com',text:'Vewd App Store РїСЂРёРЅРѕСЃРёС‚ РІСЃРµ Р»СѓС‡С€РёРµ СЂР°Р·РІР»РµС‡РµРЅРёСЏ СЃРѕ РІСЃРµРіРѕ РјРёСЂР°, РїСЂРµРґР»Р°РіР°СЏ РїРѕР»СЊР·РѕРІР°С‚РµР»СЏРј РєРѕРЅС‚РµРЅС‚, РєРѕС‚РѕСЂС‹Р№ РёРј РїРѕ РґСѓС€Рµ. Vewd App Store РЅР°РёР±РѕР»РµРµ РѕР±РЅРѕРІР»СЏРµРјС‹Р№ РјР°РіР°Р·РёРЅ РїСЂРёР»РѕР¶РµРЅРёР№ РґР»СЏ Smart TV.'},
    {appid:'anb_forkplayer',name:'ForkPlayer',url:'http://operatv.obovse.ru/2.5/',text:'ForkPlayer вЂ” СЌС‚Рѕ Р±СЂР°СѓР·РµСЂ СЃ Р°РґР°РїС‚РёСЂРѕРІР°РЅРЅС‹Рј РїРѕРґ РІР°С€Рµ СѓСЃС‚СЂРѕР№СЃС‚РІРѕ РїСЂРѕСЃРјРѕС‚СЂРѕРј СЃР°Р№С‚РѕРІ (СЃРїРёСЃРѕРє СЃР°Р№С‚РѕРІ РїРѕСЃС‚РѕСЏРЅРЅРѕ РѕР±РЅРѕРІР»СЏРµС‚СЃСЏ) Рё СЃРѕР·РґР°РЅРЅС‹С… РІР°РјРё XML, M3U (IPTV) РїР»РµР№Р»РёСЃС‚РѕРІ. Р’РµСЃСЊ РєРѕРЅС‚РµРЅС‚ Р±РµСЂРµС‚СЃСЏ РЅР°РїСЂСЏРјСѓСЋ СЃ РёРЅС‚РµСЂРЅРµС‚ СЃР°Р№С‚РѕРІ Рё РїРѕСЃР»Рµ РѕР±СЂР°Р±РѕС‚РєРё Рё РїСЂРµРѕР±СЂР°Р·РѕРІР°РЅРёСЏ СЃС‚СЂР°РЅРёС†С‹ РІ СЃРѕР±СЃС‚РІРµРЅРЅС‹Р№ С„РѕСЂРјР°С‚ РѕС‚РѕР±СЂР°Р¶Р°РµС‚СЃСЏ РІ РїСЂРёР»РѕР¶РµРЅРёРё ForkPlayer'},
    {appid:'anb_ottplayer',name:'OttPlayer',url:'http://widget.ottplayer.es/operatv/',text:'Ottplayer - СЌС‚Рѕ СЃРµСЂРІРёСЃ, РєРѕС‚РѕСЂС‹Р№ РїРѕР·РІРѕР»СЏРµС‚ РІР°Рј СЃРѕР±СЂР°С‚СЊ РІСЃС‘ РІР°С€Рµ IP-С‚РµР»РµРІРёРґРµРЅРёРµ РІ РѕРґРЅРѕРј РїР»РµР№Р»РёСЃС‚Рµ, РЅР°СЃС‚СЂРѕРёС‚СЊ РїРѕСЂСЏРґРѕРє РєР°РЅР°Р»РѕРІ, РїРѕР»СѓС‡РёС‚СЊ СЌР»РµРєС‚СЂРѕРЅРЅСѓСЋ РїСЂРѕРіСЂР°РјРјСѓ РїРµСЂРµРґР°С‡.'},
    {appid:'anb_ottplayertest',name:'OttPlayer',url:'http://widget.ottplayer.es/test/',text:'Ottplayer Test - РўРµСЃС‚РѕРІР°СЏ РІРµСЂСЃРёСЏ СЃРµСЂРІРёСЃР° OttPlayer. РќР° С‚РµСЃС‚РѕРІРѕР№ РІРµСЂСЃРёРё Р±СѓРґСѓС‚ С‚РµСЃС‚РёСЂРѕРІР°С‚СЊСЃСЏ РІСЃРµ РЅРѕРІРѕРІРІРµРґРµРЅРёСЏ, РєРѕС‚РѕСЂС‹Рµ РїРѕСЃР»Рµ РїСЂРѕРІРµСЂРѕРє Р±СѓРґСѓС‚ РїРѕРїР°РґР°С‚СЊ РІ РѕСЃРЅРѕРІРЅСѓСЋ РІРµСЂСЃРёСЋ.	'},
    {appid:'anb_xsmart',name:'XSmart',url:'http://app.xsmart.tv',text:'XSMART - СЌС‚Рѕ РїСЂРёР»РѕР¶РµРЅРёРµ РґР»СЏ СѓСЃС‚СЂРѕР№СЃС‚РІ СЃ РїРѕРґРґРµСЂР¶РєРѕР№ Smart TV, РєРѕС‚РѕСЂРѕРµ РѕР±СЉРµРґРёРЅСЏРµС‚ РІ СЃРµР±Рµ СЂР°Р·Р»РёС‡РЅС‹Рµ С„СѓРЅРєС†РёРё. РўРµРїРµСЂСЊ Сѓ Р’Р°СЃ РЅРµС‚ РЅРµРѕР±С…РѕРґРёРјРѕСЃС‚Рё РїРѕР»СЊР·РѕРІР°С‚СЊСЃСЏ СЂР°Р·РЅС‹РјРё РїСЂРёР»РѕР¶РµРЅРёСЏРјРё, С‡С‚РѕР±С‹ СЃРјРѕС‚СЂРµС‚СЊ С„РёР»СЊРјС‹ РёР»Рё РєР°РЅР°Р»С‹ IP-TV, СЃР»СѓС€Р°С‚СЊ РјСѓР·С‹РєСѓ РёР»Рё СЂР°РґРёРѕ, Р° С‚Р°Рє Р¶Рµ РїРѕРёРіСЂР°С‚СЊ РІ РјРёРЅРё-РёРіСЂС‹, РєРѕСЂРѕС‚Р°СЏ РІСЂРµРјСЏ. Р’СЃРµ СЌС‚Рѕ РґРѕСЃС‚СѓРїРЅРѕ РІ РЅР°С€РµРј РїСЂРёР»РѕР¶РµРЅРёРё Рё РЅР°С…РѕРґРёС‚СЃСЏ РІ РѕРґРЅРѕРј РЅР°Р¶Р°С‚РёРё РєРЅРѕРїРєРё РЅР° РїСѓР»СЊС‚Рµ Р”РЈ.'},
    {appid:'anb_1tv',name:'РџРµСЂРІС‹Р№',url:'http://smart.1tv.ru/opera/',text:'РџСЂРёР»РѕР¶РµРЅРёРµ РџРµСЂРІРѕРіРѕ РєР°РЅР°Р»Р°'},
    {appid:'anb_getstv',name:'GetsTV',url:'http://kinogets.ru/LG/',text:'GetsTV - РїСЂРёР»РѕР¶РµРЅРёРµ РґР»СЏ РїСЂРѕСЃРјРѕС‚СЂР° РўР’, С„РёР»СЊРјРѕРІ Рё СЃРµСЂРёР°Р»РѕРІ'},
    {appid:'anb_smotreshka',name:'РЎРјРѕС‚СЂС‘С€РєР°',url:'http://mag.smotreshka.tv/',text:'РџСЂРёР»РѕР¶РµРЅРёРµ РґР»СЏ РїСЂРѕСЃРјРѕС‚СЂР° РўР’'},
    {appid:'anb_siptv',name:'Smart IPTV',url:'http://opera.siptv.eu',text:'РџСЂРёР»РѕР¶РµРЅРёРµ РґР»СЏ РїСЂРѕСЃРјРѕС‚СЂР° IPTV.'},
    {appid:'anb_radio10',name:'Р Р°РґРёРѕ10',url:'http://hisense.alexxnb.ru/radio10',text:'Р Р°РґРёРѕ 10 РІРµС‰Р°РµС‚ РёР· СЃС‚РѕВ­Р»РёС†С‹ РљР°СЂРµВ­Р»РёРё, РіРѕСЂРѕРґР° РџРµС‚В­СЂРѕВ­Р·Р°В­РІРѕРґВ­СЃРєР°. Р—РґРµСЃСЊ СЃРѕР±СЂР°РЅС‹ СЃР°РјС‹Рµ СЏСЂРєРёРµ С…РёС‚С‹: РґСѓС€РµРІВ­РЅС‹Рµ, Р»СЋР±РёРјС‹Рµ Рё РјРµР»РѕВ­РґРёС‡В­РЅС‹Рµ вЂ” СЌС‚Рё РїРµСЃРЅРё РїРѕРґВ­РЅРёРјР°СЋС‚ РЅР°СЃС‚СЂРѕВ­РµВ­РЅРёРµ Рё РЅР°РІРµВ­РІР°СЋС‚ РІРѕСЃРїРѕРјРёВ­РЅР°В­РЅРёСЏ. Р¤РѕСЂРјР°С‚ СЂР°РґРёРѕВ­СЃС‚Р°РЅС†РёРё РїРѕР·В­РІРѕВ­Р»СЏРµС‚ РѕС‚РїСЂР°В­РІРёС‚СЊСЃСЏ РІ РјСѓР·С‹РєР°Р»СЊВ­РЅРѕРµ РїСѓС‚РµС€РµВ­СЃС‚РІРёРµ РІРѕ РІСЂРµРјРµРЅРё.'}
]


if (typeof console  != "undefined") 
    if (typeof console.log != 'undefined')
        console.olog = console.log;
    else
        console.olog = function() {};

console.log = function(message) {
    console.olog(message);
    var msg = '';
    if (typeof message == 'object') {
        msg = (JSON && JSON.stringify ? JSON.stringify(message) : message);
    } else {
        msg = message;
    }
    $('#debugDiv').append('<p>' + msg + '</p>');
};
console.error = console.debug = console.info =  console.log

var ids = [];
var pos = 0;

$(document).ready(function() {
	var objH = getHisenseObject();
	if(!objH){
		$('#unsupport').removeClass('hide');
	}else{
		makeList();
		markInstalled();
		bindKeys();
		ids[pos].focus();
	}
});

var getType = function(object) {
	var _t;
	return ((_t = typeof(object)) == "object" ? object == null && "null" || Object.prototype.toString.call(object).slice(8, -1) : _t).toLowerCase();
}
function AlexxNB_isString(o) {
	return getType(o) == "string";
}

function AlexxNB_checkArrayItemExist(array,item) {
	var count;
	for (count = 0;count < array.length;count++) {
		if ((item.AppName.toLowerCase() == array[count].AppName.toLowerCase())||(item.URL==array[count].StartCommand)) {
			break;
		}		
	}
	if(count == array.length)
	{
		return 0;
	}
	else {
		return 1;	
	}
}

function getHisenseObject(){
	if (typeof HiBrowser != 'undefined') {
		console.log("HiBrowser Object found.");
		return HiBrowser;
	}

	if (typeof Hisense != 'undefined') {
		console.log("Hisense Object found.");
		return Hisense;
	}
	console.log("No Hisense Object found.");
	return true;
}

function AlexxNB_getInstalledAppJsonObj() {
	var objH = getHisenseObject();
	var installedAppJsonStr = objH.File.read("launcher/Appinfo.json",1);
	if (AlexxNB_isString(installedAppJsonStr)) {
		try{
		    var presetAppObj = eval("("+installedAppJsonStr+")");
		}
		catch(e)
		{
		    return 0;
		}
		return presetAppObj;
	}
	else {
		return 0;
	}
}
 
function AlexxNB_getpresetedAppJsonObj() {
	var objH = getHisenseObject();
	var presetAppJsonStr = objH.File.read("launcher/preset.txt",1);
	if (AlexxNB_isString(presetAppJsonStr)) {
		try{
		    var presetAppObj = eval("("+presetAppJsonStr+")");
		}
		catch(e)
		{
		    return 0;
		}
		return presetAppObj;
	}
	else {
		return 0;
	}
}

function AlexxNB_writeAppObjToJson(AppJsonObj) {
	var writedata = JSON.stringify(AppJsonObj);
	var objH = getHisenseObject();
	objH.File.write("launcher/Appinfo.json",writedata,1);
}
 

function bindKeys(){

    $('body').keydown(function( event ) {
        var key = event.which;
        if ( key == 38) {
           event.preventDefault();
           up();
        }

        if ( key==40 ) {
            event.preventDefault();
            down();
         }
    });
}

function down(){
    last = ids.length-1;
    pos++;
    if(pos > last) pos=last;
    ids[pos].focus();
}

function up(){
    pos--;
    if(pos < 0) pos=0;
    ids[pos].focus();
}

function makeList(){
    $.each(LIST,function(k,data){
        addTile(data);
    });
    
}

function addTile(data){
    var img = 'http://hisense.fxml.ru/images/'+data.appid+'.png';
    var cnt = $('#container');
    var tile = $('#empty_tile').clone();
    tile.find('.icon img').attr('src',img);
    tile.find('.name').text(data.name);
    tile.find('.text').text(data.text);
    tile.find('.install').data('appid',data.appid);
    tile.removeClass('hide');
    cnt.append(tile);

    tile.find('.install').click(function(){
        AlexxNB_installApp(data.appid, data.name, img, img, img, data.url, function(){
            markInstalled();
        });
    });

    tile.find('.delete').click(function(){
        AlexxNB_uninstallApp(data.appid, function(){
            markInstalled();
        });
    });
}

function markInstalled(){
    var dataJSON = AlexxNB_getInstalledApps(function(err,list){});
    var data = JSON.parse(dataJSON);
    var INSTALLED = [];
    $.each(data.AppInfo,function(k,v){
        if(v.AppId != null) INSTALLED.push(v.AppId);
    });

    ids = [];
    $('.tile').each(function(){
        var button = $(this).find('.install');
        var del = $(this).find('.delete');
        var mark = $(this).find('.installed');
        var appid = button.data('appid');
        if($.inArray( appid, INSTALLED ) < 0) {
           // mark.addClass('hide');
            del.addClass('hide');
            button.removeClass('hide');
            ids.push(button);
        }else{
            button.addClass('hide');
            del.removeClass('hide');
          //  mark.removeClass('hide');
          ids.push(del);
        }
    });
}

//function Hisense_getInstalledApps(){return {AppInfo:[]};}

AlexxNB_installApp = function(appId,appName, thumbnail,iconSmall,iconBig,appUrl,callback)
{	
	console.log("Install App from AlexxNB Store: " + appId);
	var objH = getHisenseObject();
	objH.loadLibrary("libhspdk-jsx.so");

	var mydate = new Date();
	var realMonth=mydate.getMonth()+1;
	var StoreType ="alexxnb";
	var ret = false;
	var newApp={
			"AppId":appId,
			"Thumb":thumbnail,
			"Icon_96":iconSmall,
			"Image":thumbnail,
			"URL":appUrl,
			"AppName":appName,
			"Title":appName,
			"IconURL":iconBig,
			"StartCommand":appUrl,
			"InstallTime":mydate.getFullYear()+"-"+realMonth+"-"+mydate.getDate(),
			"RunTimes":0,
			"StoreType":StoreType,
			"PreInstall":false};

		var installAppObj = AlexxNB_getInstalledAppJsonObj();
		var presetAppObj = AlexxNB_getpresetedAppJsonObj();
		var installed = 0;

		if(presetAppObj)
		{
			installed = AlexxNB_checkArrayItemExist(presetAppObj.AppInfo,newApp);
		}
		if((installAppObj)&&(!installed))
		{
			if(!AlexxNB_checkArrayItemExist(installAppObj.AppInfo,newApp))
			{
				installAppObj.AppInfo.push(newApp);
				ret = true;
			}
		}else if((!installAppObj)&&(!installed))
		{
			var newAppJsonStr = "{\"AppInfo\":["+JSON.stringify(newApp)+"]}";
			installAppObj = eval("("+newAppJsonStr+")");
			ret = true;
		}

		if(ret)
		{
			AlexxNB_writeAppObjToJson(installAppObj);
		}
	callback(0);
	return ret;
}

AlexxNB_uninstallApp = function(appId ,callback)
{
	console.log("Uninstall App begin: " + appId);
	var objH = getHisenseObject();
    objH.loadLibrary("libhspdk-jsx.so");

	var installAppObj = AlexxNB_getInstalledAppJsonObj();
	var appIndex = 0;
	var ret = false;
	if(0!=installAppObj)
	{
		for (appIndex=0;appIndex<installAppObj.AppInfo.length;appIndex++)
		{
			if(installAppObj.AppInfo[appIndex].AppId == appId)
			{
				installAppObj.AppInfo.splice(appIndex,1);
				ret = true;
			}
		}
		if (ret == false) {
			HiBrowser.File.write("launcher/Appinfo.json","",1);
		}
		else {
			AlexxNB_writeAppObjToJson(installAppObj);
		}
	}

	callback(ret);
	return ret;
}

AlexxNB_getInstalledApps = function(callback)
{
	console.log("getInstalledApps");
	var objH = getHisenseObject();
	objH.loadLibrary("libhspdk-jsx.so");

	var count = 0;
	var jsonAppObj = new Array();
	var presetAppObj = AlexxNB_getpresetedAppJsonObj();
	var installAppObj = AlexxNB_getInstalledAppJsonObj();
	var ret = "";
	if(presetAppObj){
		jsonAppObj = jsonAppObj.concat(presetAppObj.AppInfo);
	}
	if(installAppObj){
		jsonAppObj = jsonAppObj.concat(installAppObj.AppInfo);
	}
	if(jsonAppObj.length == 0)
	{
		errinfo = new Error();
		errinfo.name="getInstalledApps";
		errinfo.message="There is no App has installed!!!";
		callback(errinfo,null);
	}
	else {
		var newAppJsonStr = "{\"AppInfo\":"+JSON.stringify(jsonAppObj)+"}";
		callback(null,newAppJsonStr);
		ret = newAppJsonStr;
	}
	return ret;
}



</script>
