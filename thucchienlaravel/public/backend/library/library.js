(function ($) {
    'use strict';
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr('content');

    // Hàm này thực hiện việc kích hoạt Switchery cho tất cả các phần tử có class 'js-switch'
    HT.switchery = function () {
        $('.js-switch').each(function () {
        	//.each ham nay d lap qua tung phan tu 
            var switchery = new Switchery(this, { color: '#1AB394' });
        });
    };

    // Phần này thực hiện việc kích hoạt Select2 cho tất cả các phần tử có class 'setupSelect2'
    HT.select2 = function () {
        if ($('.setupSelect2').length) {
            $('.setupSelect2').select2();
        }
    };



    //phan nay de goi abum anh co the di chuyen va doi cho anh cho nhau
   HT.sortui = () => {
    $("#sortable").sortable(); // Sửa "$("$sortable")" thành $("#sortable")
    $("#sortable").disableSelection(); // Sửa "$("$sortable")" thành $("#sortable")
};

        

    // Hàm này thực hiện việc lắng nghe sự kiện 'change' cho các phần tử có class 'status'
    // day la nut check tinh trang 
 HT.changeStatus = function () {
    let statusElements = $('.status');

    if (statusElements.length) {
        statusElements.on('change', function (e) {
            // In ra console giá trị 1 khi có sự kiện thay đổi

            let _this = $(this);

            let option = {
                'value': _this.val(),  // lay gia tri 0 hoac 1
                'modelId': _this.attr('data-modelId'),  // lay id cua san pham 
                'model': _this.attr('data-model'),//attr() de truy xuat thuoc tinh ben the html cu the la input de truy cap den thang model
                'field': _this.attr('data-field'),// lay thang publish
                '_token': typeof _token !== 'undefined' ? _token : null  // Vì sử dụng phương thức POST nên phải có token
            };

            console.log(option);

            $.ajax({
                url: 'ajax/dashboad/changeStatus',
                type: 'POST',
                dataType: 'json',
                data: option,
                success: function (response) {
                    let inputValue=((option.value==1)?2:1)
                    if(res.flag==true){
                        _this.val(inputValue)
                    }
                    console.log(response); // Thay 'res' bằng 'response'
                },
                error: function (error) {
                    console.error('Ajax request failed', error);
                }
            });

            // Ngăn chặn hành vi mặc định của sự kiện (nếu có)
            e.preventDefault();
        });
    }
};



/// day la phan chon hang loat checkbox 
//checkItem 

HT.chckBoxItem=()=>{
    if($('.checkBoxItem').length){
        $(document).on('click','.checkBoxItem',function(){
            let _this=$(this)
            HT.changeBackground(_this)
            HT.allChecked()
            

        })
    }


}
HT.changeBackground=(object)=>{
    let isChecked=object.prop('checked')
            // let uncheckedCheckboxesExist =$('.input-check:not(:checked)').length>0;
            // $('#checkAll').prop('checked',!uncheckedCheckboxesExist);
             if(isChecked){
                object.closest('tr').addClass('active-bg')
            }else{
                object.closest('tr').removeClass('active-bg')
            }


}

HT.allChecked=()=>{
    let allChecked = $('.checkBoxItem:checked').length ===$('.checkBoxItem').length;
    $('#checkAll').prop('checked',allChecked);
}

// nut check all
HT.checkAll = () => {
    if($('#checkAll').length){
    // Sử dụng sự kiện delegation để xử lý sự kiện click trên một phần tử cha
    $(document).on('click', '#checkAll', function() {
        // Khi người dùng nhấn vào phần tử có ID là 'checkAll'
        let isChecked = $(this).prop('checked');

        $('.checkBoxItem').prop('checked', isChecked);
        $('.checkBoxItem').each(function(){
            let _this = $(this)
            if( isChecked ){
                _this.closest('tr').addClass('active-bg')
            }else{
                _this.closest('tr').removeClass('active-bg')
            }
        })
        //closest('tr'): Đây là một phương thức jQuery được sử dụng để tìm phần tử cha gần nhất (closest) có thẻ là <tr> (table row)

        // Sử dụng toggleClass để thêm hoặc loại bỏ lớp 'checked' dựa trên giá trị của isChecked

    
        // Ngăn chặn hành động mặc định của sự kiện click
    });
}
}
///// day la phan ket thuc  chon hang loat checkbox 


//phann nay bat tat ca cong tac cong khai pusblish dong loat cung mot luc 

HT.changeStatusAll = () => {
    if ($('.changeStatusAll').length) {
        $(document).on('click', '.changeStatusAll', function () {
            let _this = $(this); // $(this) chính là phần tử được click
            let id = [];// de lay id cua nhung checkbox item da duoc chon 

            // Sử dụng :checked để lọc các checkbox đã chọn
            $('.checkBoxItem:checked').each(function (e) {
                let checkBox = $(this);
                id.push(checkBox.val());
            });
            // console.log(id);

            return false;

            let option = {
                'value': _this.val('data-value'), // Lấy giá trị 0 hoặc 1
                'model': _this.attr('data-model'), // data() thay thế cho attr() để truy xuất data-* attributes
                'field': _this.attr('data-field'), // Lấy giá trị từ thuộc tính data-field
               'id':id,
                '_token': typeof _token !== 'undefined' ? _token : null // Sử dụng phương thức POST nên phải có token
            };

             $.ajax({
                url: 'ajax/dashboad/changeStatusAll',
                type: 'POST',
                dataType: 'json',
                data: option,
                success: function (response) {
                    if(response.flag==true){
                        
                    }
                    console.log(response); // Thay 'res' bằng 'response'
                },
                error: function (error) {
                    console.error('Ajax request failed', error);
                }
            });


            // Gọi hàm xử lý với các thông tin đã thu thập được
            //handleStatusChange(id, option);
            e.preventDefault();
        });
    }
};




    // Hàm này sẽ thực thi sau khi DOM đã sẵn sàng
    $(document).ready(function () {
        // Gọi các hàm để thực hiện các công việc cụ thể
        HT.switchery();
        HT.select2();
        HT.changeStatus();
        HT.checkAll();
        HT.chckBoxItem();
        HT.changeStatusAll();
          HT.sortui();
    });
})(jQuery);
