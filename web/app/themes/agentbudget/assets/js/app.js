const ajaxurl = APP.ajaxUrl;
const $ = jQuery;

$(document).ready(() => {

  $(document).on('click', 'a[href="#"]', e => e.preventDefault());

  //  SHOW/HIDE PASSWORD
  $('.showPass').on('click', function () {
    const $input = $(this).prev();
    if ($input.attr('type') === 'text') {
      $input.attr('type', 'password');
      $(this)
        .removeClass('fa-eye-slash')
        .addClass('fa-eye');
    } else {
      $input.attr('type', 'text');
      $(this)
        .removeClass('fa-eye')
        .addClass('fa-eye-slash');
    }
  });


});

function storeDataToWP(DATA, redirect = '') {
  showLoader();
  m_wp_ajax_post('action=update_wp_user_data&data=' + DATA,
    (_) => {
      showLoader('hide');
      if (redirect !== '') {
        window.location.href = redirect;
      }
    },
    (_) => {
      showLoader('hide');
      d_noty_alert('Something went wrong, please try again later.', 'error');
    });
}

function initIMask() {
  $('.currency-mask').each((index, element) => {
    IMask(element, {
      mask: '$num',
      blocks: {
        num: {
          scale: 0,
          mask: Number,
          thousandsSeparator: ',',
          radix: '.',
          mapToRadix: [','],
        },
      },
    });
  });
  $('.percent-mask').each((index, element) => {
    IMask(element, {
      mask: [
        {
          mask: '',
        },
        {
          mask: 'num%',
          lazy: false,
          blocks: {
            num: {
              mask: Number,
              scale: 3,
              min: 2,
              max: 100,
              radix: '.',
              mapToRadix: [','],
            },
          },
        }
      ]
    });
  });
  $('.number-mask').each((index, element) => {
    IMask(element, {
      mask: Number,
      scale: 2,
      signed: false,
      thousandsSeparator: '',
      padFractionalZeros: false,
      normalizeZeros: true,
      radix: '.',
      mapToRadix: ['.'],
      min: 0,
    });
  });
}

function m_wp_ajax_post(data, success_callback, error_callback) {
  return m_ajax_request(APP.ajaxUrl, "post", "json", data, false, success_callback, error_callback);
}

function m_wp_ajax_get(data, success_callback, error_callback) {
  return m_ajax_request(APP.ajaxUrl, "get", "json", data, false, success_callback, error_callback);
}

function m_ajax_request(url, request_type, data_type, data, cache, success_callback, error_callback, always_callback, headers) {
  const form = {
    url: url,
    type: request_type,
    data: data,
    cache: cache,
    dataType: data_type,
    headers: headers ? headers : {},
    success: function (response) {
      if (url.includes("pstmn.io")) {
        success_callback(response);
        return;
      }

      if (response.success || response.property || response.properties || response.data || response.total) {
        return success_callback(response);
      } else if (error_callback !== undefined) {
        return error_callback(response);
      }
    },
    error: function (response) {
      if (error_callback !== undefined) {
        return error_callback(response);
      }
    }
  };

  if (typeof data == 'object') {
    form.processData = false;
    form.contentType = false;
  }
  jQuery.ajax(form);
}

function showLoader(hide) {
  const toggle = hide ? 'hide' : 'show';
  $.LoadingOverlay(toggle, {
    imageColor: '#7BBA42'
  });
}

function d_noty_alert(text, type = "alert", layout = "topRight", timeout = 4000) {
  new Noty({
    type: type,
    layout: layout,
    text: text,
    timeout: timeout,
    killer: true
  }).show();
}