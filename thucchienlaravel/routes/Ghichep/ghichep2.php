module post:
-post_catalogues: luu cac nhom bai viet : tin tuc , thoi su , su kien ...
-posts: luu chi tiet cac bai viet : messi ghi ban ...
-post_catalogue_post :pivot moi quan he giua hai bang post_catalogues va post
-languages : luu ngon ngu 

-post_cataloguee_languages  :luu moi quan he giua post_catalogue va  languages 

-post_translate :


2,
n-n
da ngon ngu 
languages: viet ,anh ,han ,phap ,nhat...

*bang language
-id
-canonical
-name
-image
-user_id
-deleted_at



* bang post-catalogues:
-id
-parent_id(luu ma cua danh muc cha )
-lft (gia tri ben tria cua node )
-rgt(gia tri ben phai cua node)
-level(cap cua cai node do )
-image(anh dai dien )
-icon(anh nho )
-album (danh sach anh )
-vieed(luu lai luot xem )
-deteted_at(xoa mem )
-publish(trang thai )
-order(sap xep cac danh muc )
-user_id(nguoi tao ra danh muc)


*post_catalogues_languages 
-post_catalogue_id
-name(ten bai viet  )
-description (mo ta ngan )
-canoanical(duong dan truy cap vao danh muc )
-conten (noi dung cua danh muc )
-meta-title:tieu de seo
-meta_description: mo ta seo 
-meta-keyword: tu khoa seo

*bang posts
-id
-post_catalogue_id
-image
-album
-icon
-order
-publish
-deleted_at
-user_id


*bang post_catalogue_post
-post_id
-language_id
-viewed

-name(ten bai viet  )
-description (mo ta ngan )
-canoanical(duong dan truy cap vao danh muc )
-conten (noi dung cua danh muc )
-meta-title:tieu de seo
-meta_description: mo ta seo 
-meta-keyword: tu khoa seo




3,tin tuc 
bang da -thi su-thoi tiet-suc khoe ..
+bong da trong nuoc
  vlangue vha han ..
+ bong da quoc te 
	giai ngoia hang anh ...



