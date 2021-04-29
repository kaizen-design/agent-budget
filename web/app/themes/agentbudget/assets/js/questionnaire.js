'use strict';

const STORAGE = window.localStorage;

$(document).ready(() => {

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
    }
    $form.addClass('was-validated');
  });

});

function handlePagination() {

}

function switchForms(current, next) {
  current.addClass('d-none');
  next.removeClass('d-none');
}

function updateProgressCounter() {
  const completedForms = $('.questionnaire-form[data-is-completed="true"]').length,
        formsTotal = $('.questionnaire-form').length,
        progress = Math.round(completedForms * 100 / formsTotal) + '%';
  $('.progress-bar').css('width', progress);
  $('.progress-bar-label').text(`${progress} Completed`);
}