function pais(valor){
	var url = 'DibujaEstado.php';
	var pars = ("filtro=" + valor);
	var myAjax = new Ajax.Updater('divEstado', url, { method: 'get', parameters: pars});
}

function sala(valor){
	var url = 'DibujaSalario.php';
	var pars = ("filtro=" + valor);
	var myAjax = new Ajax.Updater('divSalario', url, { method: 'get', parameters: pars});
}