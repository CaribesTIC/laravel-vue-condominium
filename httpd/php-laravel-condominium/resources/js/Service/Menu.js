export const Menu = (() => {

  return {  

    async update(data, id) {
      let response = await Http.request({
          method: 'post',
          url: `${process.env.MIX_APP_URL}menus/${id}`,
          data: data
      });      
      return response;
    },
    
    async children(menuId) {
      let response = await Http.request({
          method: 'get',
          url: `${process.env.MIX_APP_URL}menus/children/${menuId}`
      });      
      return response;
    }

  }

})();
