/**
 *  Pages Authentication
 */

'use strict';
const formAuthentication = document.querySelector('#formAuthentication');

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // Form validation for Add new record
    if (formAuthentication) {
      const fv = FormValidation.formValidation(formAuthentication, {
        fields: {
          username: {
            validators: {
              notEmpty: {
                message: 'يجب ادخل اسم المستخدم'
              },
              stringLength: {
                min: 6,
                message: 'يجب أن يكون اكثر من 6 احرف'
              }
            }
          },
          email: {
            validators: {
              notEmpty: {
                message: 'يجب اداخل بريد الكتروني'
              },
              emailAddress: {
                message: 'بريد الكتروني غير صالح'
              }
            }
          },
          'email-username': {
            validators: {
              notEmpty: {
                message: 'يجب إدخال اسم المستخدم'
              },
              stringLength: {
                min: 6,
                message: 'يجب ان يكون اعلى من 6 احرف'
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: 'يجب ادخال كلمة المرور'
              },
              stringLength: {
                min: 6,
                message: 'يجب ان تكون كلمة المرور اعلى من 6'
              }
            }
          },
          'confirm-password': {
            validators: {
              notEmpty: {
                message: 'الرجاء تأكيد كلمة المرور'
              },
              identical: {
                compare: function () {
                  return formAuthentication.querySelector('[name="password"]').value;
                },
                message: 'كلمة المرور غير مطابقة'
              },
              stringLength: {
                min: 6,
                message: 'كلمة المرور يجب ان تكون اكثر من 6 احرف'
              }
            }
          },
          terms: {
            validators: {
              notEmpty: {
                message: 'الرجاء الموافقة على الشروط والأحكام'
              }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-3'
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),

          defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
          autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      });
    }

    //  Two Steps Verification
    const numeralMask = document.querySelectorAll('.numeral-mask');

    // Verification masking
    if (numeralMask.length) {
      numeralMask.forEach(e => {
        new Cleave(e, {
          numeral: true
        });
      });
    }
  })();
});
