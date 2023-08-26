"use strict";

// Class definition
var KTUserEdit = function () {
	// Base elements
	var avatar;

	var initUserForm = function() {
		avatar = new KTImageInput('kt_user_edit_avatar');
	}

	return {
		// public functions
		init: function() {
			initUserForm();
		}
	};
}();
// ảnh 2
var KTUserEdit2 = function () {
	// Base elements
	var avatar;

	var initUserForm = function() {
		avatar = new KTImageInput('kt_user_edit_anh2');
	}

	return {
		// public functions
		init: function() {
			initUserForm();
		}
	};
}();

jQuery(document).ready(function() {
	KTUserEdit.init();
	KTUserEdit2.init();
});
