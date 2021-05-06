'use strict';

//const STORAGE = window.localStorage;

$(document).ready(() => {

  initQuestionnaire();

  $('.questionnaire-form').on('submit', function (e) {
    e.preventDefault();
    e.stopPropagation();
    const $form = $(this);
    if ($form[0].checkValidity()) {
      $form.attr('data-is-completed', 'true');
      switchForms($form, $form.next());
      updateProgressBar();
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

  $('.questionnaire-nav .list-group-item-action').on('click', function () {
    const menuID = $(this).data('id');
    const formID = $(this).data('form-id');
    setActiveNavItem(menuID);
    setActiveForm(formID);
  });

  updateSidebarNav();

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

function updateSidebarNav(id) {
  console.warn(id);
  switch (true) {
    case id >= 10 && id <= 12:
      setActiveNavItem(2);
      break;
    case id >= 13 && id <= 17:
      setActiveNavItem(3);
      break;
    default:
      setActiveNavItem(1);
      break;
  }
}

function setActiveNavItem(i) {
  $('.questionnaire-nav .list-group-item-action').removeClass('active');
  $('.questionnaire-nav .list-group-item-action[data-id="' + i + '"]').addClass('active');
}

function setActiveForm(id) {
  switchForms($('.questionnaire-form:not(.d-none)'), $('.questionnaire-form[data-id="' + id +  '"]'))
}

function switchForms(current, next) {
  if (next) {
    showLoader();
    current.addClass('d-none');
    setTimeout(() => {
      next.removeClass('d-none');
      updateSidebarNav(next.data('id'));
      showLoader(true);
    }, 1000);
  } else {
    //  TODO: handle redirect to the report page
  }
}

function updateProgressBar() {
  const completedForms = $('.questionnaire-form[data-is-completed="true"]').length,
        formsTotal = $('.questionnaire-form').length,
        progress = Math.round(completedForms * 100 / formsTotal) + '%';
  $('.progress-bar').css('width', progress);
  $('.progress-bar-label').text(`${progress} Completed`);
}