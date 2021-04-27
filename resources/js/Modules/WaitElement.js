export const WaitElement = (() => {

  return {

    show() {

     const eWait = document.createElement('div');
     const eImg = document.createElement('img');
     eImg.setAttribute("src", "../../img/loader.gif");
     eImg.setAttribute("border", "0");
     //eWait.textContent = "Loading !!!";
     const style = `width: 100%; 
                    height: 100%;
                    z-index: 4004;
                    position: fixed;
                    left:50%;
                    top:50%;
                    /*background: url(../../img/loader.gif) no-repeat center 0;*/
                    margin: auto;
                    opacity: 0.3;`;
     eWait.setAttribute('style', style);
     eWait.appendChild(eImg);
     document.getElementsByTagName('body')[0].appendChild(eWait);
     return eWait; 

    },

    hidden(eWait) {
      eWait.parentNode.removeChild(eWait);
    }

  }

})();

