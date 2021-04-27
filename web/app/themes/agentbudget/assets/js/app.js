const ajaxurl = APP.ajaxUrl;
const $ = jQuery;
jQuery(document).ready(function ($) {

});

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
  var toggle = hide ? 'hide' : 'show';
  jQuery.LoadingOverlay(toggle, {
    imageColor: '#46CE90'
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