//**********************************************
// Pure PHP Upload 2.1
// Version: 2.1.3
//
// Copyright (c) 2003 - 2004, George Petrov, Patrick Woldberg, DMXzone.com
//
//*************** GLOBALS VARS *****************

var GP_MSG_ScriptPHPFileSaved = 'The file "incPureUpload.php" has been copied into your site ScriptLibrary directory.\nDon\'t forget to upload it to your remote site.'
var GP_MSG_ScriptJSFileSaved = 'The file "incPureUpload.js" has been copied into your site ScriptLibrary directory.\nDon\'t forget to upload it to your remote site.'
var GP_MSG_OnlyOneInstanceAllowed = "Only one instance of this behavior is allowed on a page. Modify the existing " +
                                    "behavior by double clicking it in the Server Behavior panel";
var GP_MSG_PleaseSaveSite = "Please put this document in a site before using this feature.\n";
var GP_MSG_saveDocument = "The current document must be saved before this Server Behavior can be used.\n";
var GP_MSG_NoForms   = "Before using this Server Behavior, please create a form that has a File Field on it.\n";
var MSG_CHOOSEFOLDER = "Choose a Directory";

var extensionFile = "PurePHPUpload21";

var _emptyControls =
  new Array("storeType","file","timeout","600","sizeLimit","","nameConflict","over","requireUpload","true","minWidth","","minHeight","","maxWidth","","maxHeight","","saveWidth","","saveHeight","","progressWidth","300","progressHeight","100");

var progressFolderURL = dreamweaver.getConfigurationPath() + "/Shared/DMXzone/Pure Upload/Progress Bars";

//******************* API **********************

function displayHelp(){
  dreamweaver.browseDocument(dreamweaver.getConfigurationPath() + '/ExtensionsHelp/DMXzone/Pure PHP Upload/index.htm');
}

var _thepath = new SmartDataRelFolderTextField("Pure PHP Upload.htm", "thepath", "");
var _redirectURL = new TextField("Pure PHP Upload.htm", "redirectURL", "");
var _formName = new FileFormsMenu("Pure PHP Upload.htm", "formName", "");
var _storeType = new SmartOptionsField("Pure PHP Upload.htm", "storeType", "");
var _timeout = new TextField("Pure PHP Upload.htm", "timeout", "");
var _sizeLimit = new TextField("Pure PHP Upload.htm", "sizeLimit", "");
var _extensions = new TextField("Pure PHP Upload.htm", "extensions", "");
var _nameConflict = new SmartListField("Pure PHP Upload.htm", "nameConflict", "");
var _maxHeight = new TextField("Pure PHP Upload.htm", "maxHeight", "");
var _minHeight = new TextField("Pure PHP Upload.htm", "minHeight", "");
var _requireUpload = new CheckboxFieldTF("Pure PHP Upload.htm", "requireUpload", "");
var _minWidth = new TextField("Pure PHP Upload.htm", "minWidth", "");
var _maxWidth = new TextField("Pure PHP Upload.htm", "maxWidth", "");
var _saveWidth = new FormHiddenFieldsMenu("Pure PHP Upload.htm", "saveWidth", "");
var _saveHeight = new FormHiddenFieldsMenu("Pure PHP Upload.htm", "saveHeight", "");
var _progressBar= new progressFilesMenu("Pure PHP Upload.htm", "progressBar", "");
var _progressWidth = new TextField("Pure PHP Upload.htm", "progressWidth", "");
var _progressHeight = new TextField("Pure PHP Upload.htm", "progressHeight", "");

//***************** LOCAL FUNCTIONS  ******************

function windowDimensions(platform)
{
  if(navigator.platform.charAt(0)=="M")
  {
    return "490,490";
  } else {
    return "";
  }
}

function initializeUI() {
  var elts;

  _thepath.initializeUI();
  _redirectURL.initializeUI();
  _formName.initializeUI();
  _storeType.initializeUI();
  _timeout.initializeUI();  
  _sizeLimit.initializeUI();
  _extensions.initializeUI();
  _nameConflict.initializeUI();
  _saveWidth.initializeUI();
  _saveHeight.initializeUI();
  _maxHeight.initializeUI();
  _minHeight.initializeUI();
  _requireUpload.initializeUI();
  _minWidth.initializeUI();
  _maxWidth.initializeUI();  
  _progressBar.initializeUI();  
  _progressWidth.initializeUI();
  _progressHeight.initializeUI();  

  var tab0 = findObject("Tab0");
  var tab1 = findObject("Tab1");
  var tab2 = findObject("Tab2");

   //Initialize the TabControl.  (Pass in the prefix used for the tab layers)
   T = new TabControl('Tab');

   //Add tab pages.   (Pass the layer name, and the page object)
   T.addPage('page01', new Pg1("Main"));
   T.addPage('page02', new Pg1("Advanced"));
   T.addPage('page03', new Pg1("About"));

	 T.start();

   changeImagesForOS(T.getTotalPages());
	 
   findObject("loading").visibility = "hidden";
   findObject("page01").visibility = "visible";
}

function updateUI(tab,action,text) {
  if (action == "help")
    var HelpDiv = findObject('Help0' + tab);
  if (HelpDiv) {
    HelpDiv.visibility = "hidden";
    HelpDiv.innerHTML = text;
    HelpDiv.visibility = "visible";    
  }
}

function browse_button(control) {
if (control == "redirectURL")
  {
    var theRedirect_url = dw.browseForFileURL("select", MM.LABEL_FileRedirect,0,0); 
    
    if (theRedirect_url.length > 0)
    {
      // convert any script blocks to concat values
      theRedirect_url = theRedirect_url.replace(/<\?php\s+(?:echo\s+)?/gi, "\" . ");
      theRedirect_url = theRedirect_url.replace(/;?\s*\?>/gi, " . \"");
      
      _redirectURL.setValue(theRedirect_url); 
    }    
  }

  // default case - throw error message 
  else 
  {
    alert("The following control does not exist: " + control); 
  }
}

function checkForServerBehavior(searchString) {
  var ssRecs = dw.serverBehaviorInspector.getServerBehaviors();
  for (var i=0; i < ssRecs.length; i++) {
    if (ssRecs[i].type == searchString) {
      return true;
    }
  }
  return false;
}

function checkForRedirect(sbObj) {
  redirectURL = sbObj.parameters.redirectURL;
	if (redirectURL != null) {
		if (redirectURL != '' && redirectURL[0] == '"' && redirectURL[redirectURL.length-1] == '"') {
			redirectURL = redirectURL.substring(1,redirectURL.length-1)
		}
	} else {
		redirectURL = '';
	}
  if (redirectURL != '') {
    return false;
  }
  return true;
}

function checkForOtherRedirects(sbObj) {
  if (checkForServerBehavior('UpdateRecord')) {
    if (!checkForRedirect(sbObj)) {
      alert('Please Remove the redirect URL from "Pure PHP Upload" server behavior.\nOtherwise the code for "Update Record" will never be executed.\nTo change the redirect URL, make the parameter "After Uploading, Go To:" empty.')
      return false;
	}
  }
  if (checkForServerBehavior('InsertRecord')) {
    if (!checkForRedirect(sbObj)) {
      alert('Please Remove the redirect URL from "Pure PHP Upload" server behavior.\nOtherwise the code for "Insert Record" will never be executed.\nTo change the redirect URL, make the parameter "After Uploading, Go To:" empty.')
      return false;
	}
  }
  return true;
}

function findServerBehaviors() {
  var paramObj = new Object();
  var i, j, sb;

  _thepath.findServerBehaviors(paramObj);
  _redirectURL.findServerBehaviors(paramObj);
  _formName.findServerBehaviors(paramObj);
  _storeType.findServerBehaviors(paramObj);
  _timeout.findServerBehaviors(paramObj);  
  _sizeLimit.findServerBehaviors(paramObj);
  _extensions.findServerBehaviors(paramObj);
  _nameConflict.findServerBehaviors(paramObj);
  _saveWidth.findServerBehaviors(paramObj);
  _saveHeight.findServerBehaviors(paramObj);
  _maxHeight.findServerBehaviors(paramObj);
  _minHeight.findServerBehaviors(paramObj);
  _requireUpload.findServerBehaviors(paramObj);
  _minWidth.findServerBehaviors(paramObj);
  _maxWidth.findServerBehaviors(paramObj);
  _progressBar.findServerBehaviors(paramObj);  
  _progressWidth.findServerBehaviors(paramObj);
  _progressHeight.findServerBehaviors(paramObj);
  
  sbArray = dwscripts.findSBs();

  return sbArray;
}

function canApplyServerBehavior(sbObj) {
  var success = true;

  if (!sbObj) {
    // attempting to add the behavior - check to see if one already exists on the page
    if (getssRecByType("Pure PHP Upload") != null) {
      alert(GP_MSG_OnlyOneInstanceAllowed);
      success=false;
    }
  } 
  
 	var siteURL = dw.getSiteRoot();
	var filePath = dreamweaver.getDocumentPath("document");
	
  if (!siteURL.length) {
    alert(GP_MSG_PleaseSaveSite);
    success = false;
  }
	if (filePath == "") {
    alert(GP_MSG_saveDocument);
    success = false;
  }
  
  if (success)
    success = _thepath.canApplyServerBehavior(sbObj);
  if (success)
    success = _redirectURL.canApplyServerBehavior(sbObj);
  if (success)
    success = _formName.canApplyServerBehavior(sbObj);
  if (success)
    success = _storeType.canApplyServerBehavior(sbObj);
  if (success)
    success = _timeout.canApplyServerBehavior(sbObj);
  if (success)
    success = _sizeLimit.canApplyServerBehavior(sbObj);
  if (success)
    success = _extensions.canApplyServerBehavior(sbObj);
  if (success)
    success = _nameConflict.canApplyServerBehavior(sbObj);
  if (success)
    success = _saveWidth.canApplyServerBehavior(sbObj);
  if (success)
    success = _saveHeight.canApplyServerBehavior(sbObj);
  if (success)
    success = _maxHeight.canApplyServerBehavior(sbObj);
  if (success)
    success = _minHeight.canApplyServerBehavior(sbObj);
  if (success)
    success = _requireUpload.canApplyServerBehavior(sbObj);
  if (success)
    success = _minWidth.canApplyServerBehavior(sbObj);
  if (success)
    success = _maxWidth.canApplyServerBehavior(sbObj);
  if (success)
    success = _progressBar.canApplyServerBehavior(sbObj);
  if (success)
    success = _progressWidth.canApplyServerBehavior(sbObj);
  if (success)
    success = _progressHeight.canApplyServerBehavior(sbObj);

  var path = dw.getConfigurationPath() + '/Commands/' + extensionFile + '_install.htm';
  var metaFile, hasRun, key;
  metaFile = MMNotes.open(path, true);
  if (metaFile) {
    hasRun = MMNotes.get(metaFile, 'PREF_hasRun');
    key = MMNotes.get(metaFile, 'PREF_key');    
    if (!hasRun || !key) {
      success = false;
      MMNotes.set(metaFile, "PREF_hasRun", true);
      MMNotes.close(metaFile);   

	  dw.runCommand(extensionFile + "_install.htm"); 
    }
    else {
      MMNotes.close(metaFile);
    }
  }
    
  return success;
}

function applyServerBehavior(sbObj) {
  var paramObj = new Object();
  var errStr = "";
  if (!errStr)
    errStr = _thepath.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _redirectURL.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _formName.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _extensions.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _requireUpload.applyServerBehavior(sbObj, paramObj);

  //Copy the Standard ScriptLibrary/incPureUpload.php
  if (!errStr) {
  	var fileURL = dw.getSiteRoot() + "ScriptLibrary";
  	if (!DWfile.exists(fileURL)){
  		//Create folder if it does not exist
  		DWfile.createFolder(fileURL);
  	}
  	var libPath = absoluteToRelativeURL(fileURL,docBase(),true);
  	libPath = (libPath[0] == '/') ? libPath.substring(1,libPath.length) : '../' + libPath;
  	fileURL += "/incPureUpload.php"
  	var origFileURL = dw.getConfigurationPath() + '/Shared/DMXzone/Pure Upload/PHP/incPureUpload.php';
  	if (!DWfile.exists(fileURL)){
  		if (!DWfile.copy(origFileURL,fileURL)) {
  			errStr = 'File copy failed!';
  			return errStr;
  		}
  		alert(GP_MSG_ScriptPHPFileSaved);
  	}
  	else {
  		//Check if the file is different
  		orgFile = DWfile.read(origFileURL);
  		curFile = DWfile.read(fileURL);
  		if (orgFile != curFile) {
  			if (!DWfile.copy(origFileURL,fileURL)) {
    			errStr = 'File copy failed!';
    			return errStr;
  			}
  			alert(GP_MSG_ScriptPHPFileSaved);
  		}
  	}
  	var fileURL = dw.getSiteRoot() + "ScriptLibrary";
  	if (!DWfile.exists(fileURL)){
  		//Create folder if it does not exist
  		DWfile.createFolder(fileURL);
  	}
  	var libPath = absoluteToRelativeURL(fileURL,docBase(),true);
  	libPath = (libPath[0] == '/') ? libPath.substring(1,libPath.length) : '../' + libPath;
  	fileURL += "/incPureUpload.js"
  	var origFileURL = dw.getConfigurationPath() + '/Shared/DMXzone/Pure Upload/PHP/incPureUpload.js';
  	if (!DWfile.exists(fileURL)){
  		if (!DWfile.copy(origFileURL,fileURL)) {
  			errStr = 'File copy failed!';
  			return errStr;
  		}
  		alert(GP_MSG_ScriptJSFileSaved);
  	}
  	else {
  		//Check if the file is different
  		orgFile = DWfile.read(origFileURL);
  		curFile = DWfile.read(fileURL);
  		if (orgFile != curFile) {
  			if (!DWfile.copy(origFileURL,fileURL)) {
    			errStr = 'File copy failed!';
    			return errStr;
  			}
  			alert(GP_MSG_ScriptJSFileSaved);
  		}
  	}
    // Add include param
    paramObj.relpath = libPath;    

    //Add progress bar if needed
    //Files
    var progressBar = _progressBar.getValue();
    if (progressBar != '') { //Only when progressBar is choosen
      var progressWidth = _progressWidth.getValue(); if (progressWidth == '') progressWidth = 300;
      var progressHeight = _progressHeight.getValue(); if (progressHeight == '') progressHeight = 100;  
    
      var progressFile = progressFolderURL +'/' + progressBar;
      var fileDOM = dreamweaver.getDocumentDOM(progressFile);
      if (fileDOM) {
        var filesArr = fileDOM.parentWindow.getProgressWindowFiles();
        var files = filesArr.split(',');
        var curFolder = docBase(),copiedFiles = new Array();
        for (var i=0;i<files.length;i++) {
          fileURL = curFolder + '/' + files[i];
        	if (!DWfile.exists(fileURL)){        
            if (!DWfile.copy(progressFolderURL + '/' + files[i],fileURL)) {
              errStr = 'File copy failed! File ' + files[i];
              return errStr;
            }
            copiedFiles.push(files[i]);
          }
        }
        if (copiedFiles.length > 0)
          alert('The following files are now copied to your site folder:\n' + copiedFiles);
      }
    }
  }

  if (paramObj.redirectURL == '""') {
    paramObj.redirectURL = null;
  }

  var formName = _formName.getValue().getAttribute("name");
  if (!formName) {
    formName = dwscripts.getUniqueNameForTag("FORM", "form");
    _formName.getValue().setAttribute("name", formName);
  } 

  paramObj["formName"] = formName; 

  var actionForm = _formName.getValue();
  var extensions = _extensions.getValue();
  var requireUpload = _requireUpload.getValue();
  
  paramObj.form__tag = actionForm;
	paramObj.head__tag = dw.getDocumentDOM().getElementsByTagName("HEAD")[0];
	
  if (!errStr)
    errStr = _storeType.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _timeout.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _sizeLimit.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _nameConflict.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _saveWidth.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _saveHeight.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _maxHeight.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _minHeight.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _minWidth.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _maxWidth.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _progressBar.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _progressWidth.applyServerBehavior(sbObj, paramObj);
  if (!errStr)
    errStr = _progressHeight.applyServerBehavior(sbObj, paramObj);    
  if (!errStr) {
    dwscripts.fixUpSelection(dw.getDocumentDOM(), true, true);
    dwscripts.applySB(paramObj, sbObj);
		
    //Add form actions  
    var timeout = _timeout.getValue(); if (timeout == '') timeout = "600";    
    var sizeLimit = _sizeLimit.getValue(); if (sizeLimit == '') sizeLimit = "''";  
    var minWidth = _minWidth.getValue(); if (minWidth == '') minWidth = "''";
    var minHeight = _minHeight.getValue(); if (minHeight == '') minHeight = "''";  
    var maxWidth = _maxWidth.getValue(); if (maxWidth == '') maxWidth = "''";
    var maxHeight = _maxHeight.getValue(); if (maxHeight == '') maxHeight = "''";  
    var saveWidth = "'" + _saveWidth.getValue() + "'";
    var saveHeight = "'" + _saveHeight.getValue() + "'";
  
    deleteScript("showProgressWindow");
    deleteScript("checkFileUpload");
    deleteScript("checkOneFileUpload");
    deleteScript("showImageDimensions");
    deleteScript("checkImageDimensions");

	  var dom = dw.getDocumentDOM();
	  var forms = dom.getElementsByTagName("FORM");
	  for (var i=0; i < forms.length; i++) {
	  	if (forms[i].getAttribute("ACTION") == "<?php echo $GP_uploadAction; ?>") {
	  		forms[i].setAttribute("ACTION", '');
	  	}
	    removeJavaScriptFunctionCall(forms[i],"ONSUBMIT","showProgressWindow");    
	    removeJavaScriptFunctionCall(forms[i],"ONSUBMIT","checkFileUpload");
	    //remove script from all file fields
	    var fileFields = findAllFormFileFields(forms[i]);
	    for (j=0;j<fileFields.length;j++) {
	      removeJavaScriptFunctionCall(fileFields[j],"ONCHANGE","checkFileUpload");  
	      removeJavaScriptFunctionCall(fileFields[j],"ONCHANGE","checkOneFileUpload");  
	    }  
	  }

    if (actionForm.getAttribute("ACTION") != "<?php echo $editFormAction; ?>") {
      actionForm.setAttribute("ACTION","<?php echo $GP_uploadAction; ?>");     
    }  
    actionForm.setAttribute('ENCTYPE','multipart/form-data');
    actionForm.setAttribute('METHOD','post');

    addJavaScriptAction(actionForm,"ONSUBMIT","checkFileUpload(this,'" + extensions + "'," + requireUpload + "," + sizeLimit + "," + minWidth + "," + minHeight + "," + maxWidth + "," + maxHeight + "," + saveWidth + "," + saveHeight + ")");
    addJavaScriptAction(actionForm,"ONSUBMIT","return document.MM_returnValue");

    if (progressBar != '') { //Only when progressBar is choosen    
      addJavaScriptAction(actionForm,"ONSUBMIT","showProgressWindow('"+progressBar+"',"+ progressWidth +","+progressHeight+")");   
    }

    //add script to all file fields
    var fileFields = findAllFormFileFields(actionForm);
    var uniqueFileFieldName= new Array();
	    for (i=0;i<fileFields.length;i++) {
    var found = false;
 		for (var c=0;c<uniqueFileFieldName.length;c++){
			if (fileFields[i].getAttribute("NAME") == uniqueFileFieldName[c]) {
				 found = true;		
			 }
		}
   	if (!fileFields[i].getAttribute("NAME") || found) fileFields[i].setAttribute("NAME", dwscripts.getUniqueNameForTag("INPUT", "file"));
    addJavaScriptAction(fileFields[i],"ONCHANGE","checkOneFileUpload(this,'" + extensions + "'," + requireUpload + "," + sizeLimit + "," + minWidth + "," + minHeight + "," + maxWidth + "," + maxHeight + "," + saveWidth + "," + saveHeight + ")");  
		uniqueFileFieldName.push(fileFields[i].getAttribute("NAME"));
  }  
    
  }

  return errStr;
}

function inspectServerBehavior(sbObj) {

  // We check that each parameter has a value.
  // Replace the undefined parameters with ""
  inspectEmptyControls(sbObj);

  _thepath.inspectServerBehavior(sbObj);
  _redirectURL.inspectServerBehavior(sbObj);
  _formName.inspectServerBehavior(sbObj);
  _storeType.inspectServerBehavior(sbObj);
  _timeout.inspectServerBehavior(sbObj);  
  _sizeLimit.inspectServerBehavior(sbObj);
  _extensions.inspectServerBehavior(sbObj);
  _nameConflict.inspectServerBehavior(sbObj);
  _saveWidth.inspectServerBehavior(sbObj);
  _saveHeight.inspectServerBehavior(sbObj);
  _maxHeight.inspectServerBehavior(sbObj);
  _minHeight.inspectServerBehavior(sbObj);
  _requireUpload.inspectServerBehavior(sbObj);
  _minWidth.inspectServerBehavior(sbObj);
  _maxWidth.inspectServerBehavior(sbObj);
  _progressBar.inspectServerBehavior(sbObj);  
  _progressWidth.inspectServerBehavior(sbObj);
  _progressHeight.inspectServerBehavior(sbObj);
    
  fileTypes = findObject("fileTypes");
  if (_extensions.getValue() == 'GIF,JPG,JPEG,BMP,PNG') {
    fileTypes[0].checked = false;
    fileTypes[1].checked = true;
    fileTypes[2].checked = false;    
  }
  else {  
    if (_extensions.getValue() == '') {
      fileTypes[0].checked = true;
      fileTypes[1].checked = false;
      fileTypes[2].checked = false;    
    }
    else {
      fileTypes[0].checked = false;
      fileTypes[1].checked = false;
      fileTypes[2].checked = true;        
    }
  }
    
	T.obj.visibility = "hidden";
	findObject("updatingDialog").visibility = "hidden";
	T.obj.visibility = "visible";
}

function deleteServerBehavior(sbObj) {

  var formName = sbObj.parameters.formName;
    
  _thepath.deleteServerBehavior(sbObj);
  _redirectURL.deleteServerBehavior(sbObj);
  _formName.deleteServerBehavior(sbObj);
  _storeType.deleteServerBehavior(sbObj);
  _timeout.deleteServerBehavior(sbObj);  
  _sizeLimit.deleteServerBehavior(sbObj);
  _extensions.deleteServerBehavior(sbObj);
  _nameConflict.deleteServerBehavior(sbObj);
  _saveWidth.deleteServerBehavior(sbObj);
  _saveHeight.deleteServerBehavior(sbObj);
  _maxHeight.deleteServerBehavior(sbObj);
  _minHeight.deleteServerBehavior(sbObj);
  _requireUpload.deleteServerBehavior(sbObj);
  _minWidth.deleteServerBehavior(sbObj);
  _maxWidth.deleteServerBehavior(sbObj);
  _progressBar.deleteServerBehavior(sbObj);  
  _progressWidth.deleteServerBehavior(sbObj);
  _progressHeight.deleteServerBehavior(sbObj);
  
  dwscripts.deleteSB(sbObj);

  var actionForm = getFormByName(formName);    

  if (actionForm) {
    if (actionForm.getAttribute("ACTION") == "<?php echo $GP_uploadAction; ?>") {
      actionForm.setAttribute("ACTION","")
    }
  }  

  //Get the onsubmit attributes  
  actionForm = getFormByName(formName);      
  removeJavaScriptFunctionCall(actionForm,"ONSUBMIT","checkFileUpload");     
  actionForm = getFormByName(formName); 
  removeJavaScriptFunctionCall(actionForm,"ONSUBMIT","showProgressWindow");        

  //remove script from all file fields
  actionForm = getFormByName(formName);    
  var fileFields = findAllFormFileFields(actionForm);
  for (i=0;i<fileFields.length;i++) {
    removeJavaScriptFunctionCall(fileFields[i],"ONCHANGE","checkFileUpload");  
    actionForm = getFormByName(formName);    
    fileFields = findAllFormFileFields(actionForm);
    removeJavaScriptFunctionCall(fileFields[i],"ONCHANGE","checkOneFileUpload");  
    actionForm = getFormByName(formName);    
    fileFields = findAllFormFileFields(actionForm);
  }    
}

function analyzeServerBehavior(sbObj, allRecs) {
  sbObj.incomplete = false;
  if (!checkForOtherRedirects(sbObj)) sbObj.incomplete = true;
  _thepath.analyzeServerBehavior(sbObj, allRecs);
  _redirectURL.analyzeServerBehavior(sbObj, allRecs);
  _formName.analyzeServerBehavior(sbObj, allRecs);
  _storeType.analyzeServerBehavior(sbObj, allRecs);
  _timeout.analyzeServerBehavior(sbObj, allRecs);  
  _sizeLimit.analyzeServerBehavior(sbObj, allRecs);
  _extensions.analyzeServerBehavior(sbObj, allRecs);
  _nameConflict.analyzeServerBehavior(sbObj, allRecs);
  _saveWidth.analyzeServerBehavior(sbObj, allRecs);
  _saveHeight.analyzeServerBehavior(sbObj, allRecs);
  _maxHeight.analyzeServerBehavior(sbObj, allRecs);
  _minHeight.analyzeServerBehavior(sbObj, allRecs);
  _requireUpload.analyzeServerBehavior(sbObj, allRecs);
  _minWidth.analyzeServerBehavior(sbObj, allRecs);
  _maxWidth.analyzeServerBehavior(sbObj, allRecs);
  _progressBar.analyzeServerBehavior(sbObj, allRecs);  
  _progressWidth.analyzeServerBehavior(sbObj, allRecs);
  _progressHeight.analyzeServerBehavior(sbObj, allRecs);  
}

// We check that each parameter has a value.
// Replace the undefined parameters with ""
function inspectEmptyControls(sbObj) {
  for (var i = 0; i < _emptyControls.length; i+=2)
    if (!sbObj.parameters[_emptyControls[i]]) sbObj.parameters[_emptyControls[i]] = _emptyControls[i+1];                  
}

//Get the list of forms on the page
function findAllForms() {
  var retList = new Array();
  var dom = dw.getDocumentDOM();
  var forms = dom.getElementsByTagName("FORM");
  for (var i=0; i < forms.length; i++) {
    if (findAllFormFileFields(forms[i]).length > 0)
      retList.push(forms[i]);
  }
  return retList;
}

//Returns a list of form names
function getFormNames(formList) {
  var retList = new Array();
  for (var i=0; i < formList.length; i++) {
    if (formList[i].getAttribute("NAME") != null && formList[i].getAttribute("NAME") != "")
      retList.push(formList[i].getAttribute("NAME"));
    else
      retList.push(MM.LABEL_Unnamed);
  }
  return retList;
}

//Get Form object by specified name
function getFormByName(formName) {
  var formList = findAllForms();
  for (var i=0; i < formList.length; i++) {
    if (formList[i].getAttribute("NAME") != null && formList[i].getAttribute("NAME") == formName)
      return formList[i];
  }
  return null;
}

//Returns an array of objects which contain:
// obj ref, column binding, is number
function findAllFormFileFields(formObj) {
  var retList = new Array(), node;
  var tagList = getTagElementsInOrder(new Array("INPUT"), formObj);
  //add valid types to the array of form fields
  for (var i=0; i < tagList.length; i++) {
    if (tagList[i].getAttribute("TYPE") !=null && tagList[i].getAttribute("TYPE").toUpperCase() == "FILE")
      retList.push(tagList[i]);
  }
  return retList;
}

//Returns an array of objects which contain:
// obj ref, column binding, is number
function findAllFormHiddenFields(formObj) {
  var retList = new Array(), node;
  var tagList = getTagElementsInOrder(new Array("INPUT"), formObj);
  //add valid types to the array of form fields
  for (var i=0; i < tagList.length; i++) {
    if (tagList[i].getAttribute("TYPE").toUpperCase() == "HIDDEN")
      retList.push(tagList[i]);
  }
  return retList;
}

//Returns an array of objects which contain:
// obj name
function findAllFormHiddenFieldsNames(formObj) {
  var retList = new Array(), node;
  var tagList = getTagElementsInOrder(new Array("INPUT"), formObj);
  //add valid types to the array of form fields
  for (var i=0; i < tagList.length; i++) {
    if (tagList[i].getAttribute("TYPE").toUpperCase() == "HIDDEN")
      retList.push(tagList[i].name);
  }
  return retList;
}


//Returns a list of elements whose tag name matches one of those in tagList
function getTagElementsInOrder(tagList, dom) {
  var retList = new Array();
  if (dom == null) dom = dw.getDocumentDOM();
  for (var i=0; dom.hasChildNodes() && i < dom.childNodes.length; i++) {
    if (dom.childNodes[i].nodeType == Node.ELEMENT) {
      for (j=0; j < tagList.length; j++) {
        if (dom.childNodes[i].tagName == tagList[j]) {
          retList.push(dom.childNodes[i]);
          break;
      } }
      retList = retList.concat(getTagElementsInOrder(tagList,dom.childNodes[i]));
  } }
  return retList;
}

// Returns the base path for the current document.
function docBase()
{
	var docURL;
	var docBase;
	var	index	= 0;

	docURL = dreamweaver.getDocumentPath("DOCUMENT");
	if ( "" == docURL )
		return "";

	index = docURL.lastIndexOf('/');
	if ( -1 == index )
		return "";
	
	return docURL.substring(0, index);
} // function docBase()


function absoluteToRelativeURL(absURL, docURL,check)
{
  var newRef, fullURL, index, filePath, docPath;
    if ((!check || DWfile.exists(absURL)) && absURL)
  {
      newRef = '';
      fullURL = absURL;
      if (docURL && fullURL.indexOf(docURL) == 0)
        newRef = fullURL.substring(docURL.length); // doc relative, below doc
      else if (docURL) {  // doc relative, above doc
        for (index=0; index < fullURL.length && index < docURL.length; index++)
          if (fullURL.charAt(index) != docURL.charAt(index)) break;
        index = fullURL.substring(0, index).lastIndexOf(File.separator)+1; // backup to last directory
        filePath = fullURL.substring(index);
        docPath = docURL.substring(index);
        if (docPath && docPath.indexOf('|') == -1) {  // image on a separate drive
          for (var j=0; j < docPath.length; j++)
            if (docPath.charAt(j) == File.separator) newRef += "../";
          newRef += filePath;
      } }
      if (!newRef) newRef = fullURL;  // local file ref

    }
  return newRef;
}

/**********************************************************
* The addJavaScriptAction() function changes node attributes.
*
* Given a specified node in the dom, add a custom "action" (a javascript call)
* to the specified event, preserving all the existing scripts.
* Usage: addJavaScriptAction(theForm,'ONSUBMIT','callMyHandler()');
**********************************************************/
function addJavaScriptAction(theNode, event, action) {
  var oldAction = "", newAction = "", mmReturnBegin;
  if (theNode) {
    oldAction = theNode.getAttribute(event);
    if (oldAction != null && oldAction != "") {
      if (oldAction.indexOf(action) == -1) {
        mmReturnBegin = oldAction.indexOf(';return document.MM_returnValue');
        if ( mmReturnBegin != -1)
          newAction = oldAction.substring(0,mmReturnBegin) + ';' + action + ';return document.MM_returnValue';   
        else
            newAction = oldAction.length > 0 ? oldAction + ';' + action : action;
      }
      else 
        newAction = oldAction;
    }  
    else
      newAction = action;      
    theNode.setAttribute(event,newAction);
  }  
}

/**********************************************************
* The removeJavaScriptFunctionCall() function changes node attributes.
*
* Given a specified node in the dom, remove a custom "action" (a javascript call)
* to the specified event, preserving all the existing scripts.
* Usage: removeJavaScriptFunctionCall(theForm,'ONSUBMIT','callMyHandler');
**********************************************************/
function removeJavaScriptFunctionCall(theNode, event, action) {
  var oldAction = "", newAction = "", mmActionPos;
  if (theNode) {
    oldAction = theNode.getAttribute(event);
    if (oldAction != null && oldAction != "") {
      mmActionPos = oldAction.indexOf(action);
      if (mmActionPos != -1) {
        var endAct = oldAction.indexOf(";",mmActionPos);
        if (endAct == -1) endAct = oldAction.length-1;
        newAction = oldAction.substring(0,mmActionPos) + oldAction.substring(endAct+1,oldAction.length);
      }
      else 
        newAction = oldAction;
      if (newAction == ';return document.MM_returnValue' || newAction == 'return document.MM_returnValue')
        newAction = '';      
    }  
    if (newAction != '')  
      theNode.setAttribute(event,newAction);        
    else
      theNode.removeAttribute(event);  
  } 
}

// return the real HEAD node if exists
function getHeadNode(dom) {
  var theHead = null, allHeads = dom.getElementsByTagName("HEAD");
  if (allHeads && allHeads.length > 0 ) {
    if (allHeads[0].outerHTML.length > 0)
      theHead = allHeads[0];
  }    
  return theHead;
}

// return only client JavaScript blocks
function getJSScriptNodes(dom) {
  var JSScripts = new Array(), allScripts = dom.getElementsByTagName("SCRIPT");  
  if (allScripts && allScripts.length > 0 ) {
    for (i=0; i< allScripts.length; i++) {
      if ((!allScripts[i].getAttribute("LANGUAGE") || allScripts[i].getAttribute("LANGUAGE").toLowerCase() == "javascript") && !allScripts[i].getAttribute("RUNAT"))
        JSScripts.push(allScripts[i]);
    }
  }  
  return JSScripts;
}

//Used by behaviors to remove older versions of behavior functions.
//Deletes a function with a given name from the document.
//IMPORTANT! Will not work if function contains braces {} within quotes.
//Does not search included src files (use dom to do this).
//
//Arguments: fnName, dom (optional). If no dom, searches current page
//Returns: empty string if function not found, otherwise returns deleted function

function deleteScript(fnName) {
  var retVal=false, theHead, dom = dw.getDocumentDOM();
  dreamweaver.editLockedRegions(true);    
  theHead = getHeadNode(dom);
  if (theHead) {
    allScripts = getJSScriptNodes(theHead);
  }  
  else {
    theHead = dom.documentElement;
    allScripts = getJSScriptNodes(dom);
  }  
  if (theHead) {
    var i, j, aScript, startPos, curChar, braceCount;
    if (allScripts) {
      var fnPatt = new RegExp("function\\s+" + fnName + "\\s*\\(");  //find function fnName(...{
    
      for (i=0; i<allScripts.length; i++) if (allScripts[i].hasChildNodes()) {
        aScript = allScripts[i].childNodes[0].data;
        startPos = aScript.search(fnPatt);
        if (startPos != -1) { //found function, start traversing
          for (j=startPos; aScript.charAt(j) != "{"; j++);  //find first brace
          j++;
          braceCount=1;
          while (braceCount>0 && j<aScript.length) {        //count braces until 0
            curChar = aScript.charAt(j++);
            if (curChar=="{") braceCount++;
            if (curChar=="}") braceCount--;
          }
          if (braceCount == 0) {
            while (aScript.charAt(j).search(/\s/) != -1) j++; //remove trailing whitespace
            retVal = (aScript.substring(startPos,j));         //return the chunk to delete
            allScripts[i].childNodes[0].data = aScript.substring(0,startPos) + aScript.substring(j); //delete it!
            if (scriptIsEmpty(allScripts[i].childNodes[0].data)) {  // Remove the entire script if it is empty.
              allScripts[i].outerHTML = '';
            }                        
          }
          //break;
    } } }
  }
  return retVal;
}

// Determine if script is empty. Check for just white space
//  and a standard javascript comment tag.
//Arguments: String (which should be the contents of a script tag.
//Returns: true if the script contains only empty commments, otherwise false.

function scriptIsEmpty(aScript) {
  var re = /^\s*(<!--+)*\s*(\/\/+\s*--+>)*\s*$/;
  return re.test(aScript);
}

function getssRecByType(type) {
  var retssRec = null;
  var ssRecs = dw.serverBehaviorInspector.getServerBehaviors();
  for (i=0; i<ssRecs.length; i++) {
    if (ssRecs[i].type == type) {
      retssRec = ssRecs[i];
      break;
    }
  }
  return retssRec;
}

//*************** Pg1 Class *****************

//This is an example of a page class to be used with the TabControl.
//Uncomment the alert() calls to display the various events as they occur.

function Pg1(theTabLabel) {
  this.tabLabel = theTabLabel;
}
Pg1.prototype.getTabLabel = Pg1_getTabLabel;


function Pg1_getTabLabel() {
  return this.tabLabel;
}

function changeImagesForOS(p_iTabs) {
    if (dw.isOSX || dw.isXPThemed) { // MX only
	// Use appropriate images for Mac OS X and WinXP with themes:
	// - first the background image
	if (dw.isOSX()) {
	    findObject("tabBgWin").src = "../../../Shared/MM/Images/tabBgOSX480x430.gif";
/*
// resize our bg image and window so that all our controls fit in
var bgImage = findObject("tabBgWin");
bgImage.width = 578;
bgImage.height = 165;
window.resizeToContents();
*/
	}
	else if (dw.isXPThemed()) {
	    findObject("tabBgWin").src = "../../../Shared/MM/Images/tabBgWinXP.gif";
	}
	// - then the images for the tabs
	for (var i=0; i<p_iTabs; i++) {
	    var sTab = "Tab" + i;
	    var l_oTab = findObject(sTab);
	    if (dw.isOSX()) {
		var l_MultiOld = RegExp.multiline;
		RegExp.multiline = true;
		l_oTab.innerHTML = l_oTab.innerHTML.replace(/(tabBg|tabBgSel)\.gif/gi, "$1OSX.gif");
		RegExp.multiline = l_MultiOld;
		} 
	    else if (dw.isXPThemed()) {
		var l_MultiOld = RegExp.multiline;
		RegExp.multiline = true;
		l_oTab.innerHTML = l_oTab.innerHTML.replace(/(tabBg|tabBgSel)\.gif/gi, "$1XP.gif");
		RegExp.multiline = l_MultiOld;
	    }   
	}
    }
}
