(function ($) {
    'use strict';

    var HT = {};
    // Khai báo các biến district_id, ward_id, province_id nếu chưa được khai báo ở đây

    HT.getLocation = function () {
        $(document).on('change', '.location', function () {
            var _this = $(this);

            var option = {
                data: {
                    'location_id': _this.val(),
                },
                target: _this.data('target'), // Sử dụng data() thay vì attr()
                _token: '{{ csrf_token() }}',
            };

            // console.log(option);
            HT.sendDataTogetLocation(option);
        });
    };

    HT.sendDataTogetLocation = function (option) {
        $.ajax({
            url: 'ajax/location/getLocation',
            type: 'GET',
            dataType: 'json',
            data: option,
            success: function (response) {
                $('.' + option.target).html(response.html);

                // Doan nay de luu lai gia tri sau khi nhap
                // Khai báo biến district_id và ward_id nếu chưa được khai báo
                if (district_id != '' && option.target == 'districts') {
                    $('.districts').val(district_id).trigger('change');
                }
                if (ward_id != '' && option.target == 'wards') {
                    $('.wards').val(ward_id).trigger('change');
                }
            },
            error: function (error) {
                console.error('Ajax request failed', error);
            }
        });
    };

    // Doan nay de khi an luu xong thi cac gia tri con giu nguyen
    HT.loadCity = function () {
        if (province_id != '') {
            $(".province").val(province_id).trigger('change');
        }
    };

    $(document).ready(function () {
        HT.getLocation();
        // HT.sendDataTogetLocation(); // Bạn không cần gọi hàm này ở đây vì đã gọi nó trong hàm getLocation
        HT.loadCity();
    });

})(jQuery);
