$(function () {
  'use strict';

  var bsStepper = document.querySelectorAll('.bs-stepper'),
    modernVerticalWizard = document.querySelector('.modern-vertical-wizard-user');

  // Adds crossed class
  if (typeof bsStepper !== undefined && bsStepper !== null) {
    for (var el = 0; el < bsStepper.length; ++el) {
      bsStepper[el].addEventListener('show.bs-stepper', function (event) {
        var index = event.detail.indexStep;
        var numberOfSteps = $(event.target).find('.step').length - 1;
        var line = $(event.target).find('.step');

        // The first for loop is for increasing the steps,
        // the second is for turning them off when going back
        // and the third with the if statement because the last line
        // can't seem to turn off when I press the first item. ¯\_(ツ)_/¯

        for (var i = 0; i < index; i++) {
          line[i].classList.add('crossed');

          for (var j = index; j < numberOfSteps; j++) {
            line[j].classList.remove('crossed');
          }
        }
        if (event.detail.to == 0) {
          for (var k = index; k < numberOfSteps; k++) {
            line[k].classList.remove('crossed');
          }
          line[0].classList.remove('crossed');
        }
      });
    }
  }

  // Horizontal Wizard
  // --------------------------------------------------------------------
  if (typeof modernVerticalWizard !== undefined && modernVerticalWizard !== null) {
    var numberedStepper = new Stepper(modernVerticalWizard),
    $form = $(modernVerticalWizard).find('form');
    $form.each(function () {
      var $this = $(this);
      $this.validate({
        rules: {
          prenom: {
            required: true
          },
          nom: {
            required: true
          },
          genre: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
          profil: {
            required: true
          },
          type: {
            required: true
          }
        }
      });
    });

    $(modernVerticalWizard)
      .find('.btn-next')
      .each(function () {
        $(this).on('click', function (e) {
          e.preventDefault();
          var isValid = $('#form-user').valid();
          if (isValid) {
            numberedStepper.next();
          } else {
            e.preventDefault();
          }
        });
      });

    $(modernVerticalWizard)
      .find('.btn-prev')
      .on('click', function (e) {
        e.preventDefault();
        numberedStepper.previous();
      });

    $(modernVerticalWizard)
      .find('.btn-submit')
      .on('click', function () {
        var isValid = $('#form-user').valid();
        if (isValid) {
          alert('DEBUT');
          $('#form-user').submit(function(){return true;});
          alert('FIN');
        }
        e.preventDefault();
      });
  }

});
