"use strict";

// Class Definition
var KTForm = function() {
    var _login;

    // var _showForm = function(form) {
    //     var cls = 'login-' + form + '-on';
    //     var form = 'kt_login_' + form + '_form';

    //     _login.removeClass('login-forgot-on');
    //     _login.removeClass('login-signin-on');
    //     _login.removeClass('login-signup-on');

    //     _login.addClass(cls);

    //     KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    // }


    var _handleForm = function(e) {
        var validation;
        var form = KTUtil.getById('frm_giaovien');
        var form1 = KTUtil.getById('frm_edit');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			form,
			{
				fields: {
					email: {
                        validators: {
                            emailAddress: {
								message: 'Email chưa đúng định dang'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
          
		);

        validation = FormValidation.formValidation(
            form1,
			{
				fields: {
					email: {
                        validators: {
                            emailAddress: {
								message: 'Email chưa đúng định dang'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
        );

    }


    // Public Functions
    return {
        // public functions
        init: function() {
            _handleForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTForm.init();
});
