export const Notification = ( ()=> {  

  return {

    acept(msg) {

      Swal.fire({
        icon: 'success',
        title: msg,
        showConfirmButton: true
      });

    },

    success(msg) {

      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: msg,
        showConfirmButton: false,
        timer: 1500
      });

    },

    error(msg) {

      Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: msg,
        showConfirmButton: true,
        timer: 6000
      });

    },

    confirm(callback) {

      Swal.fire({
        title: '¿Desea eliminar este registro?',//'Are you sure?',
        //text: "You won't be able to revert this!", ¡No podrás revertir esto!
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Aceptar!'//'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          callback();
        }
      });

    }

  }

})();









