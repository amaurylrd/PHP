function form_verif(f) {
	var set = true;
	var range = f.elements.length-2;
	for (let i = 1 ; i < range ; i++) {
		var item = f.elements[i];
		var val = item.value;
		if (val == '') {
			set = false;
			item.className = "err";
		}
		else {
			var pwd = f.elements[5];
			var conf = f.elements[6];
			if (pwd.value != conf.value) {
				pwd.className = "err";
				conf.className = "err";
				set = false;
				pwd.value = '';
				conf.value = '';
			}
		}
	}
	return set;
}

function form_verif2(f) {
	var set = true;
	var range = f.elements.length-1;
	for (let i = 1 ; i < range ; i++) {
		var item = f.elements[i];
		var val = item.value;
		if (val == '') {
			set = false;
			item.className = "err";
		}
		else {
			item.className = '';
		}
	}
	return set;
}

function form_clean(f) {
	var range = f.elements.length-2;
	for (let i = 0 ; i < range ; i++) {
		var item = f.elements[i];
		item.className = '';
	}
}

document.addEventListener('DOMContentLoaded', function() {
	window.onscroll = function(ev) {
		var _scrollable = jQuery(document).height();
		var _value = window.pageYOffset;
		var _pos = (_value * 300 / _scrollable);
		document.getElementById('bar').style.width = _pos+"%";
		document.getElementById("cRetour").className = (window.pageYOffset > 100) ? "cVisible" : "cInvisible";
	};
});

function addHoraire() {
	var cmp = (document.querySelectorAll(".time").length)/2;
	console.log(cmp);
	var d = document.getElementById("date").cloneNode(false);
	var t = document.getElementById("time").cloneNode(false);
	d.setAttribute("id", "date"+cmp);
	t.setAttribute("id", "time"+cmp);
	d.setAttribute("name", "date"+cmp);
	t.setAttribute("name", "time"+cmp);
	var f = document.getElementById("formSondage");
	var i = document.getElementById("description");
	f.insertBefore(d,i);
	f.insertBefore(t,i);
}

function removeHoraire(){
	var cmp = ((document.querySelectorAll(".time").length)/2) -1;
	console.log(cmp);
	var d = document.getElementById(new String("date"+cmp));
	var t = document.getElementById(new String("time"+cmp));
	var f = document.getElementById("formSondage");
	f.removeChild(d);
	f.removeChild(t);
}
function ctrr() {
	var cmp = ((document.querySelectorAll(".time").length)/2) -1;
	console.log(cmp);
	return cmp;
}