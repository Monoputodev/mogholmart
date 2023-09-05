
<script>
  $(document).ready(function() {
    function init_summernote() {

      if ($('.textarea').length > 0) {
        $('.textarea').summernote({
          minHeight: 100,
          onCreateLink: function (url) {
            if (url.indexOf('http://') !== 0 && url.indexOf('#') !== 0) {
              url = url;
            }
            return url;
          },
        });
      }

    }

    init_summernote();

  });

  $('input[type=text]').attr('autocomplete','off');
  $('input[type=number]').attr('autocomplete','off');
  $('.menu ul li').find('a').each(function () {

    var pageurl = document.location.href;
    var myarr = pageurl.split("/");
    var str_url=myarr[0] + "/" + myarr[1] + "/" + myarr[2]+ "/" + myarr[3]+ "/" + myarr[4];

    var currenturl = $(this).attr('href');
    var myarr2 = currenturl.split("/");
    var cur_url=myarr2[0] + "/" + myarr2[1] + "/" + myarr2[2]+ "/" + myarr2[3]+ "/" + myarr2[4];

    if (str_url == cur_url) {
      $(this).parents().addClass("active");
      $(this).addClass("active");

    }
  });

  $(document).click(function(e) {

    $clicked = $(e.currentTarget);

    if ($clicked.closest('.dropdown').length === 0) {

      $('.dropdown').removeClass('open');
    }
  });




</script>

