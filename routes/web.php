<?php

use Illuminate\Support\Facades\Route;



// ============= MODULE ADMIN ========
Route::group(['prefix'=>'admin-page'],function(){
	Route::get('/','AdminController@index');
	Route::post('delete-account','AdminController@deleteAccount');
	Route::get('search-account','AdminController@searchAaccount');
	Route::get('post-report','AdminController@postReport');
	Route::post('delete-post-report','AdminController@deletePostReport');
});
// =============MODULE GROUP POST=========
Route::group(['prefix'=>'group-post'],function(){
	// admin
	Route::post('delete-post-report','GroupPostController@deletePostReport');
	Route::post('browse-post','GroupPostController@browsePost');
	Route::post('admin/accept-ajax','GroupPostController@acceptMember');
	Route::get('admin/{id}/post-pending','GroupPostController@postPending');
	Route::get('admin/{id}/post-report','GroupPostController@postReport');
	Route::get('admin/{id}/all-post','GroupPostController@allPost');
	Route::get('admin/{id}/join-group','GroupPostController@joinGroup');
	Route::get('admin/{id}','GroupPostController@adminGroup');
	Route::get('admin/{id}/members','GroupPostController@membersGroup');
	Route::post('admin/leave-group-member','GroupPostController@leaveGroupMember');
	Route::post('admin/update-group-post','GroupPostController@updateGroupPost');
	Route::get('admin/delete-group/{id}','GroupPostController@deleteGroup');
	// =====USER==== 
	Route::post('delete-post','GroupPostController@deletePost');
	// Edit
	// 1. bai viet da dong gop
	Route::get('edit/{group_id}/{user_id}','GroupPostController@editPost');
	Route::post('get-post-edit','GroupPostController@getPostEdit');
	Route::post('update-post','GroupPostController@updatePost');
	Route::post('report','GroupPostController@reportPost');
	Route::post('post/comment','GroupPostController@commentPostGroup');
	Route::post('create-post','GroupPostController@createPost');
	Route::get('detail/{id}','GroupPostController@groupPostDetail');
	Route::get('/','GroupPostController@group')->middleware('loginMiddle');
	Route::post('join-group-ajax','GroupPostController@joinGroupAjax');
	Route::get('search','GroupPostController@searchGroup');
	Route::post('create-ajax','GroupPostController@createGroupAjax');
	Route::post('ajax-upload-images','GroupPostController@uploadImagePostGroupAjax');
	Route::get('leave-group/{id_user}/{id_group}','GroupPostController@leaveGroup');

});
Route::get('carwl','UserController@carwl');
// =========== MODULE TEAM PHUOT ======
Route::group(['prefix'=>'team'],function(){
	Route::get('/','TeamController@teamIndex');
	Route::get('search','TeamController@searchTeam');
	
	// I. chia se bai viet cong khai
	Route::get('post-share','TeamController@postShare');
	// 1. Tao team phuot
	Route::post('create-team','TeamController@createTeam');
	//2. Chi tiet ve team phuot
	Route::get('{id}','TeamController@detailTeam')->middleware('loginMiddle');
	//3. Tham gia vao team
	Route::post('join-team','TeamController@joinTeam');
	//4. Lay view chat (ajax)
	Route::get('get-view-chat-room/{team_id}','TeamController@getViewChatRooom');
	//5. chat room 
	Route::post('send-message-ajax','TeamController@sendMessage');
	// 6. Lay view thong tin ca nhan (ajax)
	Route::get('get-view-profile-member/{team_id}','TeamController@getViewProfileMember');
	// 7. Cap nhat thong tin ca nhan (ajax)
	Route::post('update-profile-member','TeamController@updateProfileMember');
	// 8. Lay view danh sach thanh vien
	Route::get('get-view-member-team/{team_id}','TeamController@getViewMemberTeam');
	// 9. Lay view ke hoach (ajax)
	Route::get('get-view-plan/{team_id}','TeamController@getViewPlan');
	// 9. Tao vat dung, chuan bi trong team
	Route::post('create-tool','TeamController@createTool');
	// 10. Xác nhan vat dung
	Route::post('comfirm-tool','TeamController@comfirmTool');
	// 11. Xac nhan vat dung (ajax)
	Route::post('comfirm-tool-ajax','Teamcontroller@comfirmToolAjax');
	// 12. Tra ve view thong ke khi thay doi binh chon
	Route::get('get-view-thongke/{team_id}','Teamcontroller@getViewThongKe');
	// 13. Cap nhat lai binh chon nhung vat dung
	Route::post('update-comfirm-tool-ajax','Teamcontroller@updateComfirmToolAjax');
	// 14. get view binh chon (ajax)
	Route::get('get-view-voted/{team_id}','TeamController@getViewVoted');
	// 15. Xoa cong cu vat dung
	Route::post('delete-tool','TeamController@deleteTool');
	// 16. get modal cap nhat bai viet (ajax)
	Route::post('get-modal-update-team','Teamcontroller@getModalUpdateTeam');
	// 17. Cap nhat lai thong tin tren team
	Route::post('update-team-plan','Teamcontroller@updateTeamPlan');
	// 18. Cap nhat lai thong tin day du cho chuyen di
	Route::post('update-info-trip-team','Teamcontroller@updateInfoTripTeam');
	// 19. Tao Bai viet chia se, check in dia diem
	Route::post('chek-in','TeamController@postCheckinShare');
	// 20. Binh luan tren bai chia se
	Route::post('comment-post-share','TeamController@commentPostShare');
	// 21. Cap nhat, chinh sua lai bai viet (post-share)
	Route::post('update-post-share','TeamController@updatePostShare');
	// 22. Lay view noi dung bai viet da chia se, hien thi len modal (Ajax)
	Route::get('get-view-content-post-share/{id}','TeamController@getViewContentPostShare');
	// 23. Xoa bai viet chia se
	Route::get('delete-post-share/{id}','TeamController@deletePostShare');
	// 24. Thanh vien rời nhóm
	Route::get('leave-team/{id}','Teamcontroller@leaveTeam');
	// 25. Chuyển quyền nhóm trưởng
	Route::get('change-leader/{user_id}/{team_id}','TeamController@changeLeader');
	// 26. Moi thanh vien ra khoi nhom
	Route::get('delete-member-ajax/{user_id}/{team_id}','TeamController@deleteMemberAjax');
	// 27. Xoa, giai tan nhom
	Route::get('delete-team/{team_id}','TeamController@deleteTeam');
});

// =============MODULE PLACE =============
Route::post('place/search-place-on-map-ajax','HomeController@searchPlaceOnMapAjax');
// Ban do marker các địa điểm
Route::group(['prefix'=>'maps'],function(){
	Route::get('/','HomeController@mapsInfomation');
	Route::get('direction','HomeController@mapDirection');
	
});
// -- Chi tiết về địa điểm (topic)--
Route::group(['prefix'=>'topic'],function(){
	Route::post('comment/{topic_id}','PlaceController@commentTopic');
	Route::post('comment-ajax','PlaceController@commentAjax');
	Route::post('rating/{topic_id}','PlaceController@ratingTopic');
	Route::get('post/detail/{id}','PlaceController@postTopicDetail');
	Route::get('{id}','PlaceController@topicDetail');
	// 1. Dong gop hinh anh cho dia diem
	Route::post('add-images','PlaceController@addImages');
	// 2. Tim kiem dia diem tren map
	Route::post('search-place','HomeController@searchPlaceOnMap');
	// 3. Xoa binh luan ajax
	Route::post('delete-comment-ajax','PlaceController@deleteCommentAjax');
	// 4. Bao cao ve bai viet tren topic
	Route::post('report-post','PlaceController@reportPost');
	// 5. Xoa bai viet tren topic
	Route::post('delete-post','PlaceController@deletePost');
	// 6. Chinh sua bai viet tren topic
	Route::get('edit-post/{id}','PlaceController@editPostReview');
	Route::post('edit-post','PlaceController@postEditPostReview');

	
});

// -- Thêm địa điểm mới --
Route::get('add-place','PlaceController@addPlace');
Route::post('post-add-place','PlaceController@postAddPlace');
// -- live search topic--
Route::post('live-search-topic','PlaceController@liveSearchTopic');
Route::post('add-topic-ajax','PlaceController@addTopicAjax');


// =============MODULE USER==============
Route::get('/','HomeController@home_view');
Route::get('home','HomeController@home_view');
// thong tin tai khoan
Route::post('view-profile-ajax','UserController@viewProfileAjax');
Route::post('update-profile-ajax','UserController@updateProfileAjax');
Route::post('update-image-ajax','UserController@updateImageAjax');
// doi mat khau tai khoan
Route::post('change-pass-ajax','UserController@changePassAjax');
// quen mat khau
Route::get('forgot-pass','UserController@getForgotPass');
Route::post('post-forgot-pass','UserController@postForgotPass');
Route::get('newpass-vertifi','UserController@getNewPassVertifi');
Route::post('post-newpass-vertifi','UserController@postNewPassVertifi');
Route::get('set-new-pass','UserController@getSetNewPass');
Route::post('post-set-new-pass','UserController@postSetNewPass');
// profile ca nhan
Route::group(['prefix'=>'chat'],function(){
	Route::get('hoangven','ChatController@hoangven');
	Route::get('get-box-messages/{id}','ChatController@getBoxMessages');
	Route::post('send-message-ajax','ChatController@sendMessage');
	Route::get('video','ChatController@chatVideo');
});
Route::group(['prefix'=>'user'],function(){
	Route::get('{id}','UserController@profileUser');
	Route::get('{id}/forum','UserController@userForum');
	Route::get('{id}/create-topic','UserController@userCreateTopic');
	Route::get('{id}/review-topic','UserController@userReviewTopic');
	Route::get('{id}/friends','UserController@userFriends');
	
	// === Tab ban be
	// 1. Tim ban
	Route::get('search-all/friend','UserController@searchAllFriend');
	// 2. Yeu cau ket ban
	Route::post('send-request-add-friend','UserController@sendRequestAddFriend');
	// 3. Xoa yeu cau ket ban
	Route::post('delete-request-add-friend','UserController@deleteRequestAddFriend');
	// 4. Chap nhan yeu cau ket ban
	Route::post('accept-request-add-friend','UserController@acceptRequestAddFriend');
	// 5. Get tab ban be, yeu cau ket, yeu cau da gui, tat ca ban be
	Route::post('get-tab-friend','UserController@getTabFriends');
	// 6. Xoa ban be
	Route::post('delete-friend','UserController@deleteFriend');
	// 7. Xem trang ca nhan cua nguoi dung khac
	Route::get('{id}/info','UserController@infoAccountUser');
	// 8. Xem trang ca nhan (Ban be)
	Route::get('{id}/info/friends','UserController@frinedAccountUser');
	// 9. Lay view ajax ban be co the pjt
	Route::get('get-view-friend/suggestions','UserController@friendSuggestions');
	// 10. Thong bao 
	Route::post('notification','UserController@notificationAction');
	// 11. Danh dau thong bao da doc
	Route::post('notification-update','UserController@notificationUpdate');
	// 12. Xoa thong bao
	Route::post('delete-notification','UserController@deleteNotification');

});
// Route::get('get-view-friend-suggestions','UserController@friendSuggestions');

Route::get('login','UserController@getLogin');
Route::post('post-login','UserController@postLogin');
Route::get('logout','UserController@logout');
// dang ki
Route::get('register','UserController@getRegister');
Route::post('register','UserController@postRegister')->name('register');
// xac minh tai khoan
Route::get('account-vertifi','UserController@accountVertifi');
Route::post('post-account-vertifi','UserController@postAccountVertifi');

Route::get('login/{provider}', 'UserController@redirect');
Route::get('login/callback/{provider}', 'UserController@callback');