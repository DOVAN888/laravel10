(function($){
  "use strict"; // Chế độ nghiêm ngặt
  var HT = {};

    HT.seoPreview=()=>{
      $('input[name=meta_title]').on('keyup',function(){
      let input=$(this)
      let value=input.val()
      $('.meta-title').html(value)

      })

      //duong dan 
     $('input[name=canonical]').css({
      'padding-left':parseInt($('.baseUrl').outerWidth())+10

     })
       $('input[name=canonical]').on('keyup',function(){
      let input=$(this)
      let value= HT.removeUtf8(input.val())
      $('.canonical').html(BASE_URL+value+SUFFIX)
    })

       // the mo ta
       $('textarea[name=meta_description]').on('keyup',function(){
           let input=$(this)
      let value=input.val()
      $('.meta_description').html(value)
       })

    }
    HT.removeUtf8 = (str) => {
    // Chuyển đổi chuỗi thành chữ thường
    str = str.toLowerCase();

    // Thay thế tất cả các ký tự có dấu bằng phiên bản không dấu
    // de khi danh ten vao duong linh bang tiwng veit 
    // thi khi len duong linh ki tu van khong co dau 
    str = str.replace(/[àáảãạâầấẩẫậăắằẳẵặ]/g, 'a');
    str = str.replace(/[èéẹẽẻêềếểễệ]/g, 'e');
    str = str.replace(/[ìíịĩỉ]/g, 'i');
    str = str.replace(/[òóọõỏôồốổỗộơờớởỡợ]/g, 'o');
    str = str.replace(/[ùúụũủưừứửữự]/g, 'u');
    str = str.replace(/[ỳýỵỹỷ]/g, 'y');
    str = str.replace(/[đ]/g, 'd');
    str = str.replace(/[^\x00-\x7F]/g, '');


    // Thêm các quy tắc thay thế khác tại đây nếu cần

    return str;
};




  $(document).ready(function(){
      HT.seoPreview();
    
  });
})(jQuery);



 

