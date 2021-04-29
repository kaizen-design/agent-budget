'use strict';

const STORAGE = window.localStorage;

let activeForm;

$(document).ready(() => {

  //activeForm = parseInt($('.questionnaire-form:not(.d-none)').data('id'));

  $('.questionnaire-form').on('submit', function (e) {
    e.preventDefault();
    e.stopPropagation();
    const $form = $(this);
    if ($form[0].checkValidity()) {
      $form.attr('data-is-completed', 'true');
      switchForms($form, $form.next());
      updateProgressCounter();
      /*const formData = new FormData($form[0]);
      for(let [name, value] of formData) {
        alert(`${name} = ${value}`);
      }*/
    } else {
      d_noty_alert('Please answer the question to proceed!', 'error');
    }
    $form.addClass('was-validated');
  });

  //handlePagination();

});

function handlePagination() {
  const form = $('.questionnaire-form[data-id="' + activeForm +  '"]');
  $('#paginationPrevBtn').on('click', function () {
    switchForms(form, form.prev());
  });
  $('#paginationNextBtn').on('click', function () {
    switchForms(form, form.next());
  })
}

function switchForms(current, next) {
  showLoader();
  current.addClass('d-none');
  setTimeout(() => {
    next.removeClass('d-none');
    showLoader(true);
  }, 1000);
  //activeForm = parseInt(next.data('id'));
  //handlePagination();
}

function updateProgressCounter() {
  const completedForms = $('.questionnaire-form[data-is-completed="true"]').length,
        formsTotal = $('.questionnaire-form').length,
        progress = Math.round(completedForms * 100 / formsTotal) + '%';
  $('.progress-bar').css('width', progress);
  $('.progress-bar-label').text(`${progress} Completed`);
}