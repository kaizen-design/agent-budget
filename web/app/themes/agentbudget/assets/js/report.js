$(document).ready(() => {

  //  HANDLE PRINT LINK
  $(document).on('click', '.printLink', function () {
    const id = $(this).data('id');
    $('#' + id).printThis();
  });

});