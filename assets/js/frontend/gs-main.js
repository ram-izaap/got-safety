

$(document).ready(function() {
    if (window.matchMedia("(min-width: 992px)").matches) {
        $(".content-bar").height($(".inner-full").height());
        $(".right-bar").height($(".inner-full").height());
    }
    if (window.matchMedia("(min-width: 769px)").matches) {
        $(".left-bar").height($(".inner-full").height());
    }
    if (window.matchMedia("(min-width: 768px)").matches) {
        $(".home-right").height($(".content-area").height());
    };

    function init() {
        var imgDefer = document.getElementsByTagName('img');
        for (var i = 0; i < imgDefer.length; i++) {
            if (imgDefer[i].getAttribute('data-src')) {
                imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
            }
        }
    }
    window.onload = init;
    /*$(function() {
        var $formLogin = $('#login-form');
        var $formLost = $('#lost-form');
        var $formRegister = $('#register-form');
        var $divForms = $('#div-forms');
        var $modalAnimateTime = 300;
        var $msgAnimateTime = 150;
        var $msgShowTime = 2000;
        $("form").submit(function() {
            switch (this.id) {
                case "login-form":
                    var $lg_username = $('#login_username').val();
                    var $lg_password = $('#login_password').val();
                    if ($lg_username == "ERROR") {
                        msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "error", "glyphicon-remove", "Login error");
                    } else {
                        msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "success", "glyphicon-ok", "Login OK");
                    }
                    return false;
                    break;
                case "lost-form":
                    var $ls_email = $('#lost_email').val();
                    if ($ls_email == "ERROR") {
                        msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "error", "glyphicon-remove", "Send error");
                    } else {
                        msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "success", "glyphicon-ok", "Send OK");
                    }
                    return false;
                    break;
                case "register-form":
                    var $rg_username = $('#register_username').val();
                    var $rg_email = $('#register_email').val();
                    var $rg_password = $('#register_password').val();
                    if ($rg_username == "ERROR") {
                        msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "Register error");
                    } else {
                        msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "success", "glyphicon-ok", "Register OK");
                    }
                    return false;
                    break;
                default:
                    return false;
            }
            return false;
        });
        $('#login_register_btn').click(function() {
            modalAnimate($formLogin, $formRegister)
        });
        $('#register_login_btn').click(function() {
            modalAnimate($formRegister, $formLogin);
        });
        $('#login_lost_btn').click(function() {
            modalAnimate($formLogin, $formLost);
        });
        $('#lost_login_btn').click(function() {
            modalAnimate($formLost, $formLogin);
        });
        $('#lost_register_btn').click(function() {
            modalAnimate($formLost, $formRegister);
        });
        $('#register_lost_btn').click(function() {
            modalAnimate($formRegister, $formLost);
        });

        function modalAnimate($oldForm, $newForm) {
            var $oldH = $oldForm.height();
            var $newH = $newForm.height();
            $divForms.css("height", $oldH);
            $oldForm.fadeToggle($modalAnimateTime, function() {
                $divForms.animate({
                    height: $newH
                }, $modalAnimateTime, function() {
                    $newForm.fadeToggle($modalAnimateTime);
                });
            });
        }

        function msgFade($msgId, $msgText) {
            $msgId.fadeOut($msgAnimateTime, function() {
                $(this).text($msgText).fadeIn($msgAnimateTime);
            });
        }

        function msgChange($divTag, $iconTag, $textTag, $divClass, $iconClass, $msgText) {
            var $msgOld = $divTag.text();
            msgFade($textTag, $msgText);
            $divTag.addClass($divClass);
            $iconTag.removeClass("glyphicon-chevron-right");
            $iconTag.addClass($iconClass + " " + $divClass);
            setTimeout(function() {
                msgFade($textTag, $msgOld);
                $divTag.removeClass($divClass);
                $iconTag.addClass("glyphicon-chevron-right");
                $iconTag.removeClass($iconClass + " " + $divClass);
            }, $msgShowTime);
        }
    });*/
    $(document).on('click', '.number-spinner button', function() {
        var btn = $(this),
            oldValue = btn.closest('.number-spinner').find('input').val().trim(),
            newVal = 0;
        if (btn.attr('data-dir') == 'up') {
            newVal = parseInt(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                newVal = parseInt(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        btn.closest('.number-spinner').find('input').val(newVal);
    });
    var __slice = [].slice;
    /*(function($, window) {
        var Starrr;
        Starrr = (function() {
            Starrr.prototype.defaults = {
                rating: void 0,
                numStars: 5,
                change: function(e, value) {}
            };

            function Starrr($el, options) {
                var i, _, _ref, _this = this;
                this.options = $.extend({}, this.defaults, options);
                this.$el = $el;
                _ref = this.defaults;
                for (i in _ref) {
                    _ = _ref[i];
                    if (this.$el.data(i) != null) {
                        this.options[i] = this.$el.data(i);
                    }
                }
                this.createStars();
                this.syncRating();
                this.$el.on('mouseover.starrr', 'i', function(e) {
                    return _this.syncRating(_this.$el.find('i').index(e.currentTarget) + 1);
                });
                this.$el.on('mouseout.starrr', function() {
                    return _this.syncRating();
                });
                this.$el.on('click.starrr', 'i', function(e) {
                    return _this.setRating(_this.$el.find('i').index(e.currentTarget) + 1);
                });
                this.$el.on('starrr:change', this.options.change);
            }
            Starrr.prototype.createStars = function() {
                var _i, _ref, _results;
                _results = [];
                for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                    _results.push(this.$el.append("<i class='fa fa-star-o'></i>"));
                }
                return _results;
            };
            Starrr.prototype.setRating = function(rating) {
                if (this.options.rating === rating) {
                    rating = void 0;
                }
                this.options.rating = rating;
                this.syncRating();
                return this.$el.trigger('starrr:change', rating);
            };
            Starrr.prototype.syncRating = function(rating) {
                var i, _i, _j, _ref;
                rating || (rating = this.options.rating);
                if (rating) {
                    for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                        this.$el.find('i').eq(i).removeClass('fa-star-o').addClass('fa-star');
                    }
                }
                if (rating && rating < 5) {
                    for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                        this.$el.find('i').eq(i).removeClass('fa-star').addClass('fa-star-o');
                    }
                }
                if (!rating) {
                    return this.$el.find('i').removeClass('fa-star').addClass('fa-star-o');
                }
            };
            return Starrr;
        })();
        return $.fn.extend({
            starrr: function() {
                var args, option;
                option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
                return this.each(function() {
                    var data;
                    data = $(this).data('star-rating');
                    if (!data) {
                        $(this).data('star-rating', (data = new Starrr($(this), option)));
                    }
                    if (typeof option === 'string') {
                        return data[option].apply(data, args);
                    }
                });
            }
        });
    })(window.jQuery, window);
    $(function() {
        return $(".starrr").starrr();
    });
    $(document).ready(function() {
        $('#stars').on('starrr:change', function(e, value) {
            $('#count').html(value);
        });
        $('#stars-existing').on('starrr:change', function(e, value) {
            $('#count-existing').html(value);
        });
    });
    $(function() {
        $('#slide-submenu').on('click', function() {
            $(this).closest('.list-group').fadeOut('slide', function() {
                $('.mini-submenu').fadeIn();
            });
        });
        $('.mini-submenu').on('click', function() {
            $(this).next('.list-group').toggle('slide');
            $('.mini-submenu').hide();
        })
    })*/
});
$(function() {
    $(".dropdown").hover(function() {
        $('.dropdown-menu', this).stop(true, true).fadeIn("fast");
        $(this).toggleClass('open');
        $('b', this).toggleClass("caret caret-up");
    }, function() {
        $('.dropdown-menu', this).stop(true, true).fadeOut("fast");
        $(this).toggleClass('open');
        $('b', this).toggleClass("caret caret-up");
    });
});
	
$("input[name='pay_method']").click(function(){
	val = $(this).val();
	if(val==1)
	{
	  $(".auth_div").hide();
	  $(".paypal_div").show();
	}
	else
	{
	  $(".auth_div").show();
	  $(".paypal_div").hide();
	}
});



$("input[name='plan']").click(function(){
  val = $(this).val();
  value = val.split("-");
  $("input[name='plan_name']").val(value[0]);
  $("input[name='plan_cost']").val(value[1]);

  val = $("input[name='pay_method']:checked").val();
  if(val==1)
  {
    $(".auth_div").hide();
    $(".paypal_div").show();
  }
  else
  {
    $(".auth_div").show();
    $(".paypal_div").hide();
  }
});





