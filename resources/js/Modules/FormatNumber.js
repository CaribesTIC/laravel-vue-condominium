export const FormatNumber = (() => {

  return {  
      
      put: function (numVal = 0, sepMil = '.', sepDec = ',', cantDec = 0) {        
        let numStr = numVal.toFixed(cantDec).toString();
        let regExp = /\./;
        let array = [];       
        if (regExp.test(numStr))
          array = numStr.split('.');
        else {
          array[0] = numStr;
          array[1] = '0';
        }
        regExp=/(\d+)(\d{3})/;
	    while (regExp.test(array[0]))           
          array[0] = array[0].replace(regExp, '$1' + sepMil + '$2');
	    return array[0] + ( ( cantDec != 0 ) ? sepDec + array[1] : '' );
      },

      delete: function(val1) {
	    let val2='';
	    for ( let i=0; i < (val1.length); i++ ){
	      if (val1.charAt(i)!='.'){
            val2=val2+val1.charAt(i);
		  }
	    }
	    return val2.replace(',', '.');
      }
  
  }

})();


