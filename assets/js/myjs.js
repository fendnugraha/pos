$(document).ready(function () {
    $('table.display').DataTable({
        order: [
            [1, "desc"]
        ],
        bLengthChange: false,
        pageLength: 0,
        lengthMenu: [5, 10, 20, 50, 100, 200, 500]
    });

    $('#slide-menu-toggle, #close-slide-menu, .cover-body-blur').click(function(){
        $('div.slide-menu-toggle').toggleClass("active");
        $('div.cover-body-blur').toggleClass("active");
      });

    // $(".datepicker").datepicker();



});