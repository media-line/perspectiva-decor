{"version":3,"file":"item.min.js","sources":["item.js"],"names":["BX","namespace","Kanban","Item","options","type","isPlainObject","Error","this","Utils","isValidId","id","grid","columnId","layout","container","dragTarget","bodyContainer","dragElement","draggable","droppable","countable","data","Object","create","setOptions","prototype","getId","getColumnId","setColumnId","getColumn","getGrid","setGrid","Grid","setData","isBoolean","getData","isCountable","getGridData","renderLayout","getBodyContainer","cleanNode","appendChild","render","getContainer","attrs","className","data-id","data-type","children","getDragTarget","makeDraggable","makeDroppable","getDragElement","content","props","style","borderLeft","getColor","textContent","isDraggable","itemContainer","onbxdragstart","delegate","onDragStart","onbxdrag","onDrag","onbxdragstop","onDragStop","jsDD","registerObject","isDroppable","onbxdestdraghover","onDragEnter","onbxdestdraghout","onDragLeave","onbxdestdragfinish","onDragDrop","onbxdestdragstop","onItemDragEnd","registerDest","getDragMode","DragMode","ITEM","disableDropping","disableDragging","unregisterObject","enableDragging","disableDest","enableDropping","enableDest","canSortItems","classList","add","cloneNode","position","width","offsetWidth","document","body","onCustomEvent","x","y","remove","left","top","itemNode","draggableItem","getItemByElement","showDragTarget","offsetHeight","hideDragTarget","success","moveItem","height","removeProperty","DraftItem","apply","arguments","asyncEventStarted","draftContainer","draftTextArea","addToColumn","column","targetItem","Column","getItem","targetId","newItem","addItem","focusDraftTextArea","__proto__","constructor","getDraftTextArea","addCustomEvent","proxy","applyDraftEditMode","placeholder","message","events","blur","handleDraftTextAreaBlur","bind","keydown","handleDraftTextAreaKeyDown","title","util","trim","value","length","removeDraftItem","disabled","promise","getEventPromise","onItemAddedFulfilled","onItemAddedRejected","fulfill","result","getNextItemSibling","NONE","nextItem","error","removeCustomEvent","removeItem","focus","event","setTimeout","keyCode"],"mappings":"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"}