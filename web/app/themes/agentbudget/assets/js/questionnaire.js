'use strict';

//const STORAGE = window.localStorage;

//let activeForm;

$(document).ready(() => {

  //activeForm = parseInt($('.questionnaire-form:not(.d-none)').data('id'));

  initQuestionnaire();

  $('.questionnaire-form').on('submit', function (e) {
    e.preventDefault();
    e.stopPropagation();
    const $form = $(this);
    if ($form[0].checkValidity()) {
      $form.attr('data-is-completed', 'true');
      switchForms($form, $form.next());
      updateProgressBar();
      //activeForm++;
      /*const formData = new FormData($form[0]);
      for(let [name, value] of formData) {
        alert(`${name} = ${value}`);
      }*/
    } else {
      d_noty_alert('Please answer the question to proceed!', 'error');
    }
    $form.addClass('was-validated');
  });

  $(document).on('click', '.acceptDefaultBtn', function () {
    const formControl = $(this).parent().prev('.form-control');
    const defaultValue = formControl.attr('placeholder');
    formControl.val(defaultValue);
  });

  $('.pagination .page-link').on('click', function () {
    const formID = $(this).data('id');
    const activeForm = $('.questionnaire-form[data-id="' + formID +  '"]');
    const action = $(this).data('action');
    switch (action) {
      case 'go-to-prev':
        switchForms(activeForm, activeForm.prev());
        break;
      case 'go-to-next':
        switchForms(activeForm, activeForm.next());
        break;
    }
  });

  //handlePagination();
  //handleSidebarNav();

});

function initQuestionnaire() {
  showLoader();
  setTimeout(() => {
    //  TODO: init stuff here
    showLoader(true);
  }, 1000);
}

function updateState() {

}

function handlePagination() {
  /*const form = $('.questionnaire-form[data-id="' + activeForm +  '"]');
  $('#paginationPrevBtn').on('click', function () {
    switchForms(form, form.prev());
  });
  $('#paginationNextBtn').on('click', function () {
    switchForms(form, form.next());
  })*/
}

function handleSidebarNav() {
  /*switch (true) {
    case 1 <= activeForm <= 8:
      setActiveNavItem(1);
      break;
    case 9 <= activeForm <= 12:
      setActiveNavItem(2);
      break;
  }
  function setActiveNavItem(i) {
    $('.questionnaire-nav .list-group-item-action').removeClass('active');
    $('.questionnaire-nav .list-group-item-action[data-id="' + i + '"]').addClass('active');
  }*/
}

function switchForms(current, next) {
  if (next) {
    showLoader();
    current.addClass('d-none');
    setTimeout(() => {
      next.removeClass('d-none');
      showLoader(true);
    }, 1000);
    //activeForm = parseInt(next.data('id'));
    //handlePagination();
  } else {

  }
}

function updateProgressBar() {
  const completedForms = $('.questionnaire-form[data-is-completed="true"]').length,
        formsTotal = $('.questionnaire-form').length,
        progress = Math.round(completedForms * 100 / formsTotal) + '%';
  $('.progress-bar').css('width', progress);
  $('.progress-bar-label').text(`${progress} Completed`);
}