'use strict';

const STORAGE = window.localStorage;
let QUESTIONNAIRE = {};
let STATE = {
  is_completed: false,
  completed_forms: [],
  current_form: 1,
};

$(document).ready(() => {

  initQuestionnaire();

  //  FORM VALIDATION
  $('.questionnaire-form').on('submit', function (e) {
    e.preventDefault();
    const $form = $(this);
    if ($form[0].checkValidity()) {
      const id = parseInt($form.data('id'));
      updateCompletedForms(id);
      switchForms($form, $form.next(), new FormData($form[0]));
    } else {
      d_noty_alert('Please answer the question to proceed!', 'error');
    }
    $form.addClass('was-validated');
  });

  //  HANDLE ACCEPT DEFAULT BUTTON
  $(document).on('click', '.acceptDefaultBtn', function () {
    const formControl = $(this).parent().prev('.form-control');
    const defaultValue = formControl.attr('placeholder');
    formControl.val(defaultValue);
  });

  //  PAGINATION
  $('.pagination .page-link').on('click', function () {
    const formID = $(this).data('id');
    const activeForm = $('.questionnaire-form[data-id="' + formID + '"]');
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

  //  NAV MENU
  $('.questionnaire-nav .list-group-item-action').on('click', function (e) {
    e.preventDefault();
    const menuID = $(this).data('id');
    const formID = $(this).data('form-id');
    setActiveNavItem(menuID);
    setActiveForm(formID);
  });

  //  ADD REVENUE SHARE LEVEL
  let revenueShareFormIds = [];
  for (let i = 41; i < 71; i++) {
    revenueShareFormIds.push(i);
  }
  $('.addNewRecruitingLevel').on('click', () => {
    revenueShareFormIds.splice(0, 5);
  });
  $('.noMoreRecruitingLevels').on('click', () => {
    for (const id of revenueShareFormIds) {
      $('.questionnaire-form[data-id="' + id + '"]').remove();
    }
    switchForms(getActiveForm(), $('.questionnaire-form[data-id="71"]'));
  });

  //  HANDLE ENTER KEYPRESS
  $(document).keypress(function (e) {
    if (e.which === 13) {
      const form = getActiveForm();
      form.submit();
    }
  });

  //  VIEW REPORT
  $('.viewReportBtn').on('click', (e) => {
    e.preventDefault();
    QUESTIONNAIRE['is_report_available'] = true;
    storeDataToWP(JSON.stringify(QUESTIONNAIRE), '/my-report/');
  });

  //  INIT INPUT MASK/VALIDATION
  initIMask();

});

function initQuestionnaire() {
  showLoader();
  if (!STATE['is_completed']) {
    if (STORAGE.getItem('questionnaire')) {
      QUESTIONNAIRE = JSON.parse(STORAGE.getItem('questionnaire'));
      loadQuestionnaire(QUESTIONNAIRE);
    }
    if (STORAGE.getItem('state')) {
      STATE = JSON.parse(STORAGE.getItem('state'));
    }
    loadState();
  } else {
    showSuccessModal();
  }
  setTimeout(() => {
    showLoader(true);
  }, 1000);
}

function loadQuestionnaire(data) {
  for (const prop in data) {
    if (data.hasOwnProperty(prop)) {
      const $input = $('input[name="' + prop + '"]');
      if ($input.length) {
        if ($input.is(':radio')) {
          $('input[name="' + prop + '"][value="' + data[prop] + '"]')
            .prop('checked', true);
        } else {
          $input.val(data[prop]);
        }
      }
    }
  }
}

function loadState() {
  setActiveForm(STATE['current_form']);
  updateSidebarNav(STATE['current_form']);
  updateProgressBar();
}

function updateState(id) {
  if (id) {
    STATE['current_form'] = id;
    updateSidebarNav(id);
    updateProgressBar();
  }
  STORAGE.setItem('state', JSON.stringify(STATE));
}

function updateStorage(data) {
  for (let [name, value] of data) {
    QUESTIONNAIRE[name] = value;
    STORAGE.setItem('questionnaire', JSON.stringify(QUESTIONNAIRE));
  }
}

function updateCompletedForms(id) {
  let completed_forms = STATE['completed_forms'];
  if (completed_forms.indexOf(id) === -1) {
    completed_forms.push(id);
    STATE['completed_forms'] = completed_forms;
  }
}

function updateSidebarNav(id) {
  switch (true) {
    case id >= 10 && id <= 12:
      setActiveNavItem(2);
      break;
    case id >= 13 && id <= 19:
      setActiveNavItem(3);
      break;
    case id >= 20 && id <= 35:
      setActiveNavItem(4);
      break;
    case id >= 36 && id <= 70:
      setActiveNavItem(5);
      break;
    case id >= 71 && id <= 102:
      setActiveNavItem(6);
      break;
    case id >= 103 && id <= 107:
      setActiveNavItem(7);
      break;
    case id === 108:
      setActiveNavItem(8);
      break;
    case id === 109:
      setActiveNavItem(9);
      break;
    case id === 110:
      setActiveNavItem(10);
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

function getActiveForm() {
  return $('.questionnaire-form[data-id="' + STATE["current_form"] + '"]');
}

function setActiveForm(id) {
  switchForms(getActiveForm(), $('.questionnaire-form[data-id="' + id + '"]'))
}

function switchForms(current, next, data) {
  if (data) {
    updateStorage(data);
  }
  if (next && !isQuestionnaireCompleted()) {
    showLoader();
    setTimeout(() => {
      current.addClass('d-none');
      next.removeClass('d-none');
      updateState(next.data('id'));
      showLoader(true);
    }, 1000);
  } else {
    STATE['is_completed'] = true;
    updateState();
    showSuccessModal();
  }
}

function updateProgressBar() {
  const completedForms = STATE['completed_forms'].length,
    formsTotal = $('.questionnaire-form').length,
    progress = Math.round(completedForms * 100 / formsTotal) + '%';
  $('.progress-bar').css('width', progress);
  $('.progress-bar-label').text(`${progress} Completed`);
}

function isQuestionnaireCompleted() {
  return $('.questionnaire-form').length === STATE['completed_forms'].length;
}

function showSuccessModal() {
  const successModal = new bootstrap.Modal(document.getElementById('successModal'), {
    backdrop: 'static',
    keyboard: false
  });
  successModal.show();
}