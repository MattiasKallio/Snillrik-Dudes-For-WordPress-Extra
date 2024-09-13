
jQuery(document).ready(function ($) {
    function filterBoxes() {
        var selectedCategory = $('.helakroppen-filter-dudes-area').val();
        var selectedLetter = $('.helakroppen-filter-dudes-letter.active').data('letter');

        $('.sndude-dude-box').each(function () {
            var category = $(this).data('categories');
            var firstName = $(this).data('firstname');
            var lastName = $(this).data('lastname');

            var firstletter = $(this).data('firstletter');
            var lastletter = $(this).data('lastletter');
           
            console.log(category);

            var has_category = category != undefined && category.includes(selectedCategory);
            console.log("selected cat: "+selectedCategory);
            var matchesCategory = selectedCategory === '' || has_category;
            var matchesLetter = !selectedLetter ||
                firstletter === selectedLetter ||
                lastletter === selectedLetter;


            if (matchesCategory && matchesLetter) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    $('.helakroppen-filter-dudes-area').on('change', function () {
        filterBoxes();
    });

    $('.helakroppen-filter-dudes-letter').on('click', function () {
        $('.helakroppen-filter-dudes-letter').removeClass('active');
        $(this).addClass('active');
        filterBoxes();
    });

});
