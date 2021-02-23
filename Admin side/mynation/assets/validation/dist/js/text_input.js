/*! jQuery v1.10.2 | (c) 2005, 2013 jQuery Foundation, Inc. | jquery.org/license
//@ sourceMappingURL=jquery-1.10.2.min.map
 */
function allowIntegerOnly(charCode) {
	//alert(charCode);
	if (charCode >= 48 && charCode <= 57) {
		return true;
	}else{
		return false;
	}
}

function allowNumberOnly(charCode) {
	//alert(charCode);
	if ((charCode >= 48 && charCode <= 57) || charCode == 46) {
		return true;
	}else{
		return false;
	}
}