$(document).ready(function () {
  $('.accordion_header').click(function () {
    var content = $('#sideBar .accordion_content');
    // メニューの表示・非表示を切り替え
    content.slideToggle(200);
    var arrow = $(this).find('.arrow');
    // 矢印の切り替え
    arrow.toggleClass('fa-chevron-down fa-chevron-up');
  });

  $('.delete_icon').hover(
    function () { // マウスが乗った時
      $(this).attr('src', 'images/trash-h.png');
    },
    function () { // マウスが離れた時
      $(this).attr('src', 'images/trash.png');
    }
  );
  $('.edit_btn').click(function () {
    var postId = $(this).attr('data-id');
    $('#editModal' + postId).addClass('active');
    return false;
  });
  $(window).click(function (event) {
    // クリックされた要素がモーダルコンテンツを持っていない、またはモーダルコンテンツの外側である場合
    if (!$(event.target).closest('.modal_body').length && !$(event.target).is('.edit_btn')) {
      // モーダルを非アクティブ化
      $('.modal_container').removeClass('active');
    }
  });

  $('#customButton').click(function () {
    $('#realFile').click();
  });

  $('#realFile').change(function () {
    var fileName = $(this).val().split('\\').pop();
    if (fileName) {
      $('#customText').text(fileName);
    } else {
      $('#customText').text('選択されていません');
    }
  });

  function confirmDeletion(deleteUrl) {
    var $modal = $('#confirmationModal');
    var $confirmButton = $('#confirmDeleteButton');
    $modal.show();

    $confirmButton.off('click').on('click', function () {
      window.location.href = deleteUrl;
    });
  }
  function closeModal() {
    $('#confirmationModal').hide();
  }

  var $cancelButton = $('#cancelButton');
  $cancelButton.on('click', closeModal);

  $(window).on('click', function (event) {
    var $modal = $('#confirmationModal');
    if ($(event.target).is($modal)) {
      $modal.hide();
    }
  });
  window.confirmDeletion = confirmDeletion;
});
