function pais(valor){
	var url = 'DibujaEstadox.php';
	var pars = ("filtro=" + valor);
	var myAjax = new Ajax.Updater('divEstado', url, { method: 'get', parameters: pars});
}
function familias(valor){
	var url = '/DibujaEstadoo.php';
	var pars = ("filtro=" + valor);
	var myAjax = new Ajax.Updater('divEstadox', url, { method: 'get', parameters: pars});
}
