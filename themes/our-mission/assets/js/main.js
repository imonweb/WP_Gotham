(function ($) {
  //scroll to top

  $("#scroll_to_top").on("click", function () {
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      800
    );
    return false;
  });

  //slick slider home page initiatives

  $(".home .initiative-items").slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
    appendArrows: $(".kh-slick-arr"),
    prevArrow: `<button id="prev" type="button" class="btn-slick">
    <svg width="70" id="slick-prev" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
    <rect x="0.5" y="0.5" width="69" height="69" rx="34.5" fill="white" stroke="#E8EBF3"/>
    <circle cx="35" cy="35" r="34.5" fill="white" stroke="#EAEBF3"/>
    <circle class="animate-circle" cx="35" cy="35" r="34.5" fill="white" stroke-dasharray="219" stroke-dashoffset="219" stroke-width="1" stroke="#3454D2">
    
    </circle>
    
    <path d="M41.834 35L30.1673 35" stroke="#3454D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M34.5 40L29.5 35L34.5 30" stroke="#3454D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    
  </button>`,
    nextArrow: `<button id="next" type="button" class="btn-slick">
    <svg width="70" id="slick-next" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
    <rect x="0.5" y="0.5" width="69" height="69" rx="34.5" fill="white" stroke="#E8EBF3"/>
    <circle cx="35" cy="35" r="34.5" fill="white" stroke="#EAEBF3"/>
    <circle class="animate-circle" cx="35" cy="35" r="34.5" fill="white" stroke-dasharray="219" stroke-dashoffset="219" stroke-width="1" stroke="#3454D2">
    
    </circle>
         
            <path d="M29.166 35H40.8327" stroke="#3454D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M36.5 30L41.5 35L36.5 40" stroke="#3454D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            </button>`,

    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          // infinite: true,
          // dots: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  $(".home .initiative-items").on(
    "beforeChange",
    function (event, slick, currentSlide, nextSlide) {
      console.log(currentSlide, nextSlide);

      $(".animate-circle").each(function () {
        $(this).removeClass("running");
      });
      let direction = "";
      if (nextSlide > currentSlide) {
        direction = "right";
        $(document.body)
          .find("#slick-next .animate-circle")
          .addClass("running");
        console.log("right");
      } else if (nextSlide < currentSlide) {
        direction = "left";
        $(document.body)
          .find("#slick-prev .animate-circle")
          .addClass("running");
        console.log("left");
      }
    }
  );

  $(".home .initiative-items").on(
    "afterChange",
    function (slick, currentSlide) {
      $(".animate-circle").each(function () {
        $(this).removeClass("running");
      });
    }
  );

  //events tabs

  $(".activities-nav-item").each(function () {
    $(this).on("click", function () {
      $(".activities-nav-item").each(function () {
        $(this).removeClass("active");
      });
      $(this).addClass("active");
      let contId = $(this).attr("data-nav");
      $(".activities-content-tab").each(function () {
        $(this).removeClass("active");
      });
      $(`#${contId}`).addClass("active");
    });
  });

  //initiative filters
  $(".initiatives-posts-filter > div").each(function () {
    $(this).on("click", function () {
      let menu = $(this).find("ul");
      let icon = $(this).find("svg");
      menu.toggleClass("active");
      icon.toggleClass("active");
    });
  });

  //modal
  $(".initiative_info .btn-full-blue").on("click", function (e) {
    e.preventDefault();
    $(".initiatives-modal").addClass("active");
  });
  $(document.body).on("click", ".initiatives-modal .modal-close", function () {
    $(".initiatives-modal").removeClass("active");
  });

  //Sign initiative AJAX
  $("#initiave-form").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: MISSION_DATA.ajax_url,
      type: "POST",
      data: $(this).serialize(),
    })
      .then((res) => {
        console.log(res);

        $(this).find(":input").removeClass("invalid");
        $(this).find("label").removeClass("invalid");
        $(this).find(".invalid-message").remove();
        if (!!res.data.errors) {
          res.data.errors.forEach((err) => {
            if (err.field.includes(".")) {
              $(`${err.field}`)
                .addClass("invalid")
                .append(`<div class="invalid-message">${err.message}</div>`);
            } else {
              $(`input[name="${err.field}"]`, $(this))
                .addClass("invalid")
                .after(`<div class="invalid-message">${err.message}</div>`);

              $(`input[name="${err.field}"]`, $(this))
                .siblings("label")
                .addClass("invalid");
            }
          });
        }

        if (res.success) {
          $(".initiatives-modal-inner").replaceWith(res.data.html);
          $(".initiative-single-content__right button").replaceWith(
            res.data.button
          );
          setTimeout(() => {
            $(".initiatives-modal").removeClass("active");
          }, 2500);
        }
      })
      .fail((err) => {
        console.log(err);
      });
  });

  //handling validation initiative form on input
  $("#initiave-form input").on("input", function () {
    let submitButton = $(this).closest("form").find("button");
    let inputs = $(":input", $(this).closest("form"));
    let errors = [];
    inputs.each(function (i, el) {
      if ($(this).val().trim() === "" && el.nodeName !== "BUTTON") {
        errors.push(true);
      }
    });
    if (errors.some((err) => err === true)) {
      submitButton.text('Please fill in all data');
      submitButton.attr("disabled", true);
      submitButton.removeClass("valid");
    } else {
      submitButton.text('Submit');
      submitButton.attr("disabled", false);
      submitButton.addClass("valid");
    }
  });

  class OurmInitiativeSteps {
	constructor() {
		this.stepContainer = $('.propose-initiate-steps');
		this.steps = $('.propose-initiate-step'); // all steps elments
		this.counterContainer = $('.propose-step span');
		this.progressBar = $('.propose-progress-bar')
		this.currentStep = 0;

		this.validationRules = [
			{step: 1, fields: {
				name: {
					required: {
						value: true,
						message: 'This field is required'
					}
				},
				phone: {
					required: {
						value: true,
						message: 'This field is required'
					  },
	
				  length: {
					value: 12,
					message: 'Phone requires 12 numbers'
				  }
	
				},
				email: {
				  required: {
						value: true,
						message: 'This field is required'
					  },
				  regex: {
					value: /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
					message: 'Invalid email'
				  } 
				},
			}},

			{
				step: 2,
				fields: {
				  title: {
					required: {
						  value: true,
						  message: 'This field is required'
						},
				  },
				},
			  },
			  {
				step: 3,
				fields: {
				  content: {
					required: {
						  value: true,
						  message: 'This field is required'
						},
						
					minLength: {
					  value: 150,
					  message: 'Type at least 150 characters'
					}
				  },
				  accept: {
					  checked: {
						  value: true,
						  message: 'This field is required'
					  }
				  }
				},
			  },
		]

		

		$('#prev-step').on('click', (e) => {
			e.preventDefault();
			this.currentStep--;
			
			if(this.currentStep < 0) {
				this.currentStep = 0;
			}

			this.move();
		})
		this.registerEvents();
		this.runProgressBar()
		
	}
	registerEvents() {
		$('#next-step').on('click', (e) => {
			e.preventDefault();
			//If validation fails just return;
			if(! this.validateFields()) {
				return;
			}

			this.currentStep++;

			if(this.currentStep > this.steps.lenght - 1) {
				this.currentStep = this.steps.lenght - 1;
			}

			this.move();
		})

		$('#submit-step').on('click', (e) => {
			e.preventDefault();
			//If validation fails just return;
			if(! this.validateFields()) {
				return;
			}

			this.submit();
		})
	}

	move() {
		this.steps.each((i,item) => {
			$(item).removeClass('active')
		})
		const stepToShow = this.steps[this.currentStep];
		$(stepToShow).addClass('active');

		this.updateCounter();
		this.runProgressBar();
		this.maybeReplaceButton();
	}

	validateFields() {
		const currentRules = this.validationRules[this.currentStep];
		let invalidFields = [];
		$(this.steps[this.currentStep]).find('.invalid-message').remove();  
		for(let field in currentRules.fields ) {
			for(let property in currentRules.fields[field]) {

				let fieldValue = $(`[name=${field}]`).val();

				switch(property) {
					case 'required':
						if(fieldValue.trim() === '') {
							$(`[name=${field}]`).after(`<div class="invalid-message">${currentRules.fields[field][property].message}</div>`)
							invalidFields.push({property: field, valid: false})
						}
					break;
					case 'length':
						if(fieldValue.length  < currentRules.fields[field][property].value || fieldValue.length > currentRules.fields[field][property].value) {
							$(`[name=${field}]`).after(`<div class="invalid-message">${currentRules.fields[field][property].message}</div>`)
							invalidFields.push({property: field, valid: false})
						}
					break;
					case 'regex':
						if( ! fieldValue.match(currentRules.fields[field][property].value)) {
							$(`[name='${field}']`).after(`<div class="invalid-message">${currentRules.fields[field][property].message}</div>`);	
							invalidFields.push({property:field, valid: false});
						}
					break;
					case 'minLength':
						if( fieldValue.length < currentRules.fields[field][property].value) {
							$(`[name='${field}']`).after(`<div class="invalid-message">${currentRules.fields[field][property].message}</div>`);	
							invalidFields.push({property:field, valid: false});
						}
					break;
					case 'checked':
						let isChecked = $(`[name=${field}]`).is(':checked');
						if( ! isChecked) {
							$(`[name='${field}']`).parent().after(`<div class="invalid-message">${currentRules.fields[field][property].message}</div>`);	
							invalidFields.push({property:field, valid: false});
						}
					break;

				}
			}
			
		}

		if(invalidFields.some(field => !field.valid)) {
			return false;
		}
		return true;
	}

	updateCounter() {
		this.counterContainer.html(`<span>Step ${this.currentStep + 1}</span>`)
	}

	runProgressBar() {
		const percentage = (this.currentStep + 1) / this.steps.length * 100;
		this.progressBar.animate({
			width: `${percentage}%`,
			opacity: 'swing'
		},
		1000, 'swing')
	}

	maybeReplaceButton() {
		if(this.currentStep + 1 === this.steps.length) {
			$(document.body).find('#next-step').replaceWith(`<a href="#" id="submit-step">Submit initiative</a>`);
			this.registerEvents();
			
		}
		else {
			if ($(document.body).find('#next-step').length < 1) {
				$(document.body).find('#submit-step').replaceWith(`<a href="#" id="next-step">Next step
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
			<path d="M4.16797 10H15.8346" stroke="#3454D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M11.5 5L16.5 10L11.5 15" stroke="#3454D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
			</a>`)	
			this.registerEvents();
			}
		}
	}

	submit() {
		//ajax

		$.ajax({
			url: MISSION_DATA.ajax_url,
			type: 'POST',
			data: $('#propose_initiative').serialize()
		})
		.then(res => {
			console.log(res);

			if (res.success) {
				$('.propose-footer-nav').remove();
				$('.propose-initiate-block').remove();
				$('.propose-header-nav').remove();
				$("body").prepend(res.data.html);
			  }
		})
		.fail(err => {
			console.log(err);
		})
	}
  }
  new OurmInitiativeSteps();

  //Comments

  $('.nav-reviews-questions a').on('click', function(e) {
	e.preventDefault();
	$('.nav-reviews-questions a').each(function() {
		$(this).removeClass('active');
	})
	$(this).addClass('active');
	$('.content-reviews-questions').each(function() {
		$(this).removeClass('active');
	})
	$(`${e.target.hash}`).addClass('active');

	$('.reviews-subtitle').hide();
	$('.questions-subtitle').hide();
	
	if(e.target.hash.includes('tab-2')) {
		$('.reviews-subtitle').show();
	}
	if(e.target.hash.includes('tab-3')) {
		$('.questions-subtitle').show();
	}
  })

  $("#leave_review").on("click", function (e) {
	e.preventDefault();
    $(".ourm_modal_wrapper").eq(0).addClass("is-shown");
  });

  $("#leave_question").on("click", function (e) {
	e.preventDefault();
    $(".ourm_modal_wrapper").eq(1).addClass("is-shown");
  });
  $(".ourm-modal-close").on("click", function (e) {
	e.preventDefault();
    $(".ourm_modal_wrapper").removeClass("is-shown");
	$('.ourm_modal_wrapper #comment_parent').each(function() {
		$(this).val('')
	})
  });

  $(document.body).on("click", ".reply-question a", function (e) {
    e.preventDefault();
    $(".ourm_modal_wrapper").eq(1).addClass("is-shown");
    
    let comment_id = $(this).attr("data-commentid");
    $("#question_form #comment_parent").val(comment_id);
  });

  $(document.body).on("click", ".reply-review a", function (e) {
    e.preventDefault();
    $(".ourm_modal_wrapper").eq(0).addClass("is-shown");
    
    let comment_id = $(this).attr("data-commentid");

    $("#review_form #comment_parent").val(comment_id);
  
  });

  //rating comments (reviews)
 $('.ourm-rating svg').on('click', function() {
	$('.ourm-rating svg').each(function() {
		$(this).removeClass('active');
	})
	
	$(this).addClass('active');
	const ratingValues = [5,4,3,2,1];
	$('input[name="rating"]').val(ratingValues[$(this).index()])
 })

 //events
 $('.event-expand').on('click', function() {
	$(this).toggleClass('active');
	$(this).closest('.events-item').toggleClass('active');
 })

 //search

 $('a', $('.search-filter')).on('click', function(e) {
	e.preventDefault();
	const containerElement = $(this).data('container');
	const allContainers = ['projects', 'events', 'news', 'initiatives'];
	$('.search-filter a').each(function() {
		$(this).removeClass('active')
	})
	$(this).addClass('active');
	if(containerElement === 'all') {
		allContainers.forEach(el => {
			$(`.${el}`).show();
		})
		return;
	}
 	
	allContainers.forEach(el => {
		$(`.${el}`).hide();
	})
	
	$(`.${containerElement}`).show();
 })
})(jQuery);
