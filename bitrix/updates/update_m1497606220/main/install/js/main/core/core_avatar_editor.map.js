{"version":3,"file":"core_avatar_editor.min.js","sources":["core_avatar_editor.js"],"names":["BX","window","avatarEditorTabs","d","node","tabs","this","repo","type","isArray","tab","last","shift","add","show","prototype","head","body","findChild","attribute","data-bx-role","bind","proxy","header","hasOwnProperty","was","ii","hasAttribute","removeAttribute","removeClass","hide","setAttribute","addClass","onCustomEvent","push","showPrevious","pop","getActive","hasClass","webRTC","avatarEditorZoom","params","scale","knob","minus","plus","moveKnob","decrease","increase","startMoving","move","delegate","stopMoving","step","init","reset","document","e","v","x","percent","size1","size2","parseFloat","getAttribute","moveKnob2","pos","p","Math","min","max","ceil","pageX","fixEventPageXY","adjust","style","left","attrs","data-bx-percent","unbind","canvasConstructor","UploaderFileCnvConstr","canvasMaster","canvas","ctx","getContext","canvasBlock","parentNode","scaleMultiplier","visibleWidth","width","visibleHeight","height","canvasIsSet","clearRect","disableToMove","cursor","set","video","w","h","k","clientWidth","clientHeight","props","UploaderUtils","scaleImage","destin","top","zeroLeft","zeroTop","overWidth","overHeight","zoomScale","drawImage","calculateOffsets","firstScale","firstLeft","firstTop","maxScale","load","file","onLoadFile","onLoadingFileIsFailed","showError","message","arguments","textMessage","args","oldZeroLeft","oldZeroTop","oldZoomScale","newLeft","newTop","enableToMove","transform","unbindAll","pageY","pack","result","dataURLToBlob","toDataURL","changed","getCanvas","abs","canvasPreview","visibleSize","position","AvatarEditor","id","Date","valueOf","popup","handlers","apply","cancel","onPopupShow","onAfterPopupShow","onPopupClose","webrtc","limitations","getLimitText","getTemplate","bodies","headers","join","location","protocol","indexOf","enabled","html","length","replace","onTabHasBeenChanged","active","tabObject","tagName","addEventListener","navigator","mediaDevices","getUserMedia","audio","ideal","then","stream","srcObject","getTracks","stop","catch","error","errorNode","innerHTML","pause","src","addFiles","files","j","isImage","name","size","bindTemplate","addCustomEvent","data-bx-canvas","preview","tabObj","n","button","attr","onclick","PreventDefault","zoomNode","className","zoom","c","f","target","cloneNode","value","insertBefore","removeChild","DD","isDomNode","dropZone","dropFiles","supported","ajax","FormData","isSupported","dt","entry","fileCopy","isFile","dragEnter","isFileTransfer","dataTransfer","types","items","b","i","dragLeave","editorNode","create","display","PopupWindowManager","autoHide","lightShadow","closeIcon","closeByEsc","titleBar","content","zIndex","getMaxZIndex","overlay","events","buttons","PopupWindowButton","text","click","PopupWindowButtonLink","adjustPosition","showFile","url","close","setTimeout","removeCustomEvent","destroy"],"mappings":"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"}