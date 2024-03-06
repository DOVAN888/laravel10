(function($){
  "use strict"; // Chế độ nghiêm ngặt
  var HT = {};

HT.setupCkeditor = () => {
    if ($('.ck-editor')) { // Thêm `.length` để kiểm tra xem có phần tử nào hay không
        $('.ck-editor').each(function () {
            let editor = $(this);
            let elementId = editor.attr('id')
            let elementHeight=editor.attr('data-height')
            HT.ckeditor4(elementId,elementHeight); // Truyền vào id của phần tử thay vì trực tiếp phần tử
        });
    }

    //phan up load nhiu anh cung mot luc vao phan content 
    HT.multipleUpdateImageCkeidtor=()=>{
      $(document).on('click','.multiplUpdateImageCkeidtor',function(e){
        let object=$(this)
        let target = object.attr('data-target')
        HT.browseServerCkeditor(object,'Images',target)
        e.preventDefault()
      })
    }


//phan nay la phan upload anh avata
    HT.uploadImageAvatar=()=>{
      $('.image-target').click(function(){
        let input=$(this)
        let type='Images';
        HT.browseServerAvatar(input,type);
      })
    }
};



// phan nay lam abum anh 
HT.uploadAlbum = () => {
    $(document).on('click', '.upload-picture', function (e) {
      HT.browseServerAlbum();
      e.preventDefault(); // Ngăn chặn hành vi mặc định khi kéo qua phần tử
    });
  };

  // Hàm CKEditor


HT.ckeditor4 = (elementId,elementHeight) => {
  if(typeof(elementHeight)=='undefined'){
    elementHeight=200;
  }
    CKEDITOR.replace(elementId, {
   
        height:elementHeight,
        width:800,
        removeButtons: '',
        entries:true,
       
        allowedContent: true,
        toolbarGroups: [
            { name: 'clipboard', groups: ['clipboard', 'undo'] },
            { name: 'editing', groups: ['find', 'selection', 'spellchecker'] },
            { name: 'links' },
            { name: 'insert' },
            { name: 'forms' },
            { name: 'tools' },
            { name: 'document', groups: ['mode', 'document', 'doctools'] },
            { name: 'colors' },
            { name: 'others' },
            '/',
            { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
            { name: 'document', groups: ['list', 'indent', 'blocks', 'align', 'bidi'] },
            { name: 'styles' },
        ],
    });
};




// Gọi HT.setupCkeditor để khởi tạo CKEditor cho tất cả các phần tử có class 'ckeditor'
//phan nay de goi anh ra form
  HT.uploadImageToInput = () => {
    $('.upload-image').click(function(){
      let input = $(this);
      let type = input.attr('data-type'); // Sửa từ artr thành attr
      HT.setupCkFinder2(input, type);
    });
  };
//
  HT.setupCkFinder2 = (object, type) => {
    if (typeof(type) === 'undefined') {
      type = 'Images';
    }
    var finder = new CKFinder();
    finder.resourceType = type;
    finder.selectActionFunction = function(fileUrl, data) {
      object.val(fileUrl);
    };
    finder.popup(); // Cửa sổ này được sử dụng để mở cửa sổ
  };





  //phan nay lay anh cho form
HT.browseServerAvatar = (object, type) => {
    if (typeof(type) === 'undefined') {
      type = 'Images';
    }
    var finder = new CKFinder();
    var html;
    finder.resourceType = type;
    finder.selectActionFunction = function(fileUrl, data) {
      object.find('img').attr('src',fileUrl)
      object.siblings('input').val(fileUrl)
    };
    finder.popup(); // Cửa sổ này được sử dụng để mở cửa sổ
  };






  // goi ham phna nay nay la upload nhieu anh cung mot lcu vao phan hien thi o noi dung 
  HT.browseServerCkeditor=(object,type,target)=>{
    if (typeof(type) === 'undefined') {
      type = 'Images';
    }
    var finder = new CKFinder();
    finder.resourceType = type;

    finder.selectActionFunction = function(fileUrl, data,allFiles) {
          var html = '';

     for(var i=0;i<allFiles.length;i++){
      var image = allFiles[i].url
      html += '<figure>'
      html += '<img height=150 width=150 src="'+image+'" alt="'+image+'"/>'
      html += '<figcaption>nhap vao mo ta cho anh </figcaption>'
      html += '</figure>';
     

     }
      CKEDITOR.instances[target].insertHtml(html)// up lan luot anh vao 
    };
    finder.popup(); // Cửa sổ này được sử dụng để mở cửa sổ
  }


  // Gọi hàm khi người dùng chọn ảnh cho album
  HT.browseServerAlbum = () => {
    
      var type = 'Images';
 
    var finder = new CKFinder();
    finder.resourceType = type;
    finder.selectActionFunction = function (fileUrl, data, allFiles) {
      var html = '';

      for (var i = 0; i < allFiles.length; i++) {
        var image = allFiles[i].url;
        html += '<li class="ui-state-default">';
        html += '<div class="thumb">';
        html += '<span class="span image img-scaledown" style="width:100px; height:100px;">';
        html += '<img src="' + image + '"  alt="'+image+'">';
        html += '<input type="hidden" name="album[]" value="'+image+'">';
        html += '</span>';
        html += '<button class="delete-image"><i class="fa fa-trash"></i></button>';
        html += '</div>';
        html += '</li>';
      }
      $('.click-to-upload').addClass('hidden');
      $('#sortable').append(html);
      $('.upload-list').removeClass('hidden');
    };
    finder.popup();
     // console.log(fileUrl);

  };

  // phan nay la nut xoa anh trong phan abuml anh 
  HT.deletePicture = () => {
  $(document).on('click', '.delete-image', function() {
    let _this = $(this);
    _this.parents('.ui-state-default').remove();
      if($('.ui-state-default').length == 0){
        $('.click-to-upload').removeClass('hidden')
        $('.upload-list').addClass('hidden');
      }


  });
};








  $(document).ready(function(){
    HT.uploadImageToInput();
     HT.setupCkeditor();
      HT.uploadImageAvatar();
       HT.multipleUpdateImageCkeidtor();
        HT.uploadAlbum();
        HT.deletePicture();
  });
})(jQuery);



  //object.siblings('input'):

//object.siblings('input') chọn tất cả các anh chị em của phần tử object mà là các thẻ <input>. Nó lựa chọn các phần tử có cùng cấp cha với object và là thẻ <input>.

