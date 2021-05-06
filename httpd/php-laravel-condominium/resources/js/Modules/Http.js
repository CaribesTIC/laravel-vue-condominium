export const Http = (() => {

  const send = async config => {

    let eWait = WaitElement.show();

    try {             
      return await axios(config);
    } catch (error) {
      throw new Error(error);      
    } finally {
      WaitElement.hidden(eWait);
    }

  }

  return {

    request(config) {
      return send(config);
    }

  }

})();


