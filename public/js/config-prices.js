$(document).ready(function () {
  $('.js_submit_form').on('submit', function (e) {
    e.preventDefault();
    let dataForm = $(this).serializeArray();
    let requestUrl = $(this).attr('action');
    let r = confirm('Bạn có chắc chắn muốn cập nhật bảng giá?');
    if (r == true) {
      // call ajax
      ajaxPut(requestUrl, dataForm, 'callBackAjaxPut', 'json', '#js-form-config-price .js-loading');
    }
  })
});

/**
 * Callback when ajax
 * @param dataResponse
 */
function callBackAjaxPut(dataResponse) {
  if (dataResponse.status === 'success') {
    let messageResponse = dataResponse.message;
    $.toaster({
      message: messageResponse,
      title: 'Thông báo',
      priority: 'success'
    });
  } else {
    let messageResponse = dataResponse.message;
    $.toaster({
      message: messageResponse,
      title: 'Thông báo',
      priority: 'danger'
    });
  }

  if (dataResponse.redirect) {
    setTimeout(function () {
      window.location.replace(dataResponse.redirect);
    }, 3000);
  }
}

/**
 * add row config price service
 * @param obj this
 * @param appendObj class element get content html template
 * @param type service | service-extra
 */
function addItemPrice(obj, appendObj, type='service') {
  let objTable = $(obj).closest('table');
  let objLast = objTable.find('.' + appendObj + ':visible').last();

  // kiem tra can nhap data truoc khi them dong moi
  let valueCheck = 1;
  if (type === 'service') {
    valueCheck = objLast.find('td:nth-child(2) > input').val(); // khoi luong den (kg)
  } else if (type === 'service-extra') {
    valueCheck = objLast.find('td:nth-child(4) > input').val(); // Gia tri den (VND)
  }
  if (valueCheck === '0') {
    $.toaster({
      message: 'Vui lòng nhập dữ liệu trước khi thêm dòng khác!',
      title: 'Thông báo',
      priority: 'danger'
    });
    return;
  }

  // Tinh key cho dong moi them
  let valueKey = objLast.data('key');
  valueKey = parseInt(valueKey) + 1;
  if (valueKey === null || valueKey === undefined) {
    $.toaster({
      message: 'Không thêm được item mới!',
      title: 'Thông báo',
      priority: 'danger'
    });
    return;
  }
  let contentData = objTable.find('.' + appendObj + '.hidden').html();
  contentData = '<tr class="' + appendObj + '" data-key="'+ valueKey +'">' + contentData.replace(/disabled="disabled"/g, '') + '</tr>';
  contentData = contentData.replace(/js-select2/g, 'select2');
  contentData = contentData.replace(/KEY_DATA/g, valueKey);
  objTable.find('.' + appendObj + ':visible').last().after(contentData);
  objTable.find('select.select2').select2();
}

/**
 * Remove row price
 * @param elmnt
 */
function removeItemPrice(elmnt) {
  let objTr = $(elmnt).closest('tr');
  let objTable = objTr.closest('table');
  let className = objTr.attr('class');
  if (objTable.find('tr.' + className + ':visible').length <= 1) {
    // dong cuoi cung -> ko dc xoa
    $.toaster({
      message: 'Bảng giá dịch vụ cần có ít nhất 1 dòng!',
      title: 'Thông báo',
      priority: 'danger'
    });
    return;
  }
  objTr.remove();
}

$(document).ready(function () {
  $('.editable').click(function (e) {
    e.stopPropagation();
    var value = $(this).html() ?? 0 ;
    var levelId = $(this).attr('data');

    updateVal('.editable-'+levelId, value, levelId);
  });

  function updateVal(currentEle, value, levelId) {
    $(currentEle).html('<input class="thVal-'+ levelId +'" data="'+ levelId +'" type="text" width="2" value="' + value + '" />');

    let inputGHNMarkup = ".thVal-" + levelId;
    $(inputGHNMarkup, currentEle).focus().keyup(function (event) {
      if (event.keyCode === 13) {
        let id = $(this).attr('data')
        let ghn_markup = $(inputGHNMarkup).val().trim();
        ghn_markup = ghn_markup ? ghn_markup : 0;

        $(currentEle).html(ghn_markup);
        updateGHNMarkup(ghn_markup, id);
      }
    }).click(function(e) {
      e.stopPropagation();
    });

    $(document).click(function() {
      $(inputGHNMarkup).replaceWith(function() {
        var id = $(this).attr('data')
        var ghn_markup = $(this).val()
        ghn_markup = ghn_markup ? ghn_markup : 0;

        $(currentEle).html(ghn_markup);
        updateGHNMarkup(ghn_markup, id);
      });
    });
  }

  function updateGHNMarkup(ghn_markup, id) {
    // cap nhat markup
    $.ajax({
      type: 'POST',
      url: '/config-price/update-config-ghn-markup/' + id,
      data: {"ghn_markup": ghn_markup},
      dataType: 'JSON',
      success: function (data) {
        $.toaster({message: data.message,title: 'Thông báo', priority: 'success'});
      },
      error: function (data){
        $.toaster({message: data.message, title: 'Thông báo', priority: 'danger'});
      }
    });
  }
});