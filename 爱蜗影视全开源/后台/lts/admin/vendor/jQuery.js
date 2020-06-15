function Simplement(){
	var _del = document.getElementById('del');
	if(_del.value==''){
		alert("请输入安全码");
		console.log(_id);
	}else{
		document.location="../handle.php?del="+del.value+"&id="+_id;
	}
}
var _id = '';
function delRow(_this){
	var dels = document.getElementById('dels');
	var td = _this.parentNode;
	var tr = td.parentNode;
	var tbody = tr.parentNode;
	//tbody.removeChild(tr);
	_id = _this.title;
}

function createXmlHttp() {
    if (window.XMLHttpRequest) {
       xmlHttp = new XMLHttpRequest();
    } else {
       xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
}

function getSource() {
	var url = "../handle.";
	var sic = "list";
    createXmlHttp();
    xmlHttp.onreadystatechange = writeSource;
    xmlHttp.open("GET", url+"php?"+sic+"=1", true);
    xmlHttp.send(null);
}

function writeSource() {
    if (xmlHttp.readyState == 4) {
        document.getElementById("content").innerHTML = xmlHttp.responseText;
    }
}

getSource();