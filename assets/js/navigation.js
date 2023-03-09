function highlightActiveLink() {
    // Obtener el nombre de la página actual
    var currentPage = window.location.pathname.split('/').pop();
     
    // Resaltar el enlace activo
    $('#' + currentPage + '-link').parent().addClass('active');
  }
  
  $(document).ready(function() {
    // Llamar a la función para resaltar el enlace activo
    highlightActiveLink();
  });
  
  
  

