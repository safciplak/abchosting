</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; ABC HOSTING 2018</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<!--<script src="ttps://blackrockdigital.github.io/startbootstrap-shop-homepage/vendor/jquery/jquery.min.js"></script>-->
<!--<script src="ttps://blackrockdigital.github.io/startbootstrap-shop-homepage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>-->

<script>
  // Starrr plugin (https://github.com/dobtco/starrr)
  var __slice = [].slice;

  (function ($, window) {
    var Starrr;

    Starrr = (function () {
      Starrr.prototype.defaults = {
        rating: void 0,
        numStars: 5,
        change: function (e, value) {
        }
      };

      function Starrr($el, options) {
        var i, _, _ref,
          _this = this;

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
        this.$el.on('mouseover.starrr', 'span', function (e) {
          return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
        });
        this.$el.on('mouseout.starrr', function () {
          return _this.syncRating();
        });
        this.$el.on('click.starrr', 'span', function (e) {
          return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
        });
        this.$el.on('starrr:change', this.options.change);
      }

      Starrr.prototype.createStars = function () {
        var _i, _ref, _results;

        _results = [];
        for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
          _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
        }
        return _results;
      };

      Starrr.prototype.setRating = function (rating) {
        if (this.options.rating === rating) {
          rating = void 0;
        }
        this.options.rating = rating;
        this.syncRating();
        return this.$el.trigger('starrr:change', rating);
      };

      Starrr.prototype.syncRating = function (rating) {
        var i, _i, _j, _ref;

        rating || (rating = this.options.rating);
        if (rating) {
          for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
            this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
          }
        }
        if (rating && rating < 5) {
          for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
            this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
          }
        }
        if (!rating) {
          return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
        }
      };

      return Starrr;

    })();
    return $.fn.extend({
      starrr: function () {
        var args, option;

        option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
        return this.each(function () {
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

  $(function () {
    return $(".starrr").starrr();
  });

  $(document).ready(function () {

    var correspondence = ["", "Really Bad", "Bad", "Fair", "Good", "Excelent"];

    $('.ratable').on('starrr:change', function (e, value) {

      $(this).closest('.evaluation').children('#count').html(value);
      $(this).closest('.evaluation').children('#meaning').html(correspondence[value]);

      var currentval = $(this).closest('.evaluation').children('#count').html();

      var target = $(this).closest('.evaluation').children('.indicators');
      target.css("color", "black");
      target.children('.rateval').val(currentval);
      target.children('#textwr').html(' ');


      if (value < 3) {
        target.css("color", "red").show();
        // target.children('#textwr').text('What can be improved?');
      } else {
        if (value > 3) {
          target.css("color", "green").show();
          // target.children('#textwr').html('What was done correctly?');
        } else {
          target.hide();
        }
      }

    });


    $('#hearts-existing').on('starrr:change', function (e, value) {
      $('#count-existing').html(value);
    });
  });


  $(function () {
    $('.button-checkbox').each(function () {

      // Settings
      var $widget = $(this),
        $button = $widget.find('button'),
        $checkbox = $widget.find('input:checkbox'),
        color = $button.data('color'),
        settings = {
          on: {
            icon: 'glyphicon glyphicon-check'
          },
          off: {
            icon: 'fa fa-square-o'
          }
        };

      // Event Handlers
      $button.on('click', function () {
        $checkbox.prop('checked', !$checkbox.is(':checked'));
        $checkbox.triggerHandler('change');
        updateDisplay();
      });
      $checkbox.on('change', function () {
        updateDisplay();
      });

      // Actions
      function updateDisplay() {
        var isChecked = $checkbox.is(':checked');

        // Set the button's state
        $button.data('state', (isChecked) ? "on" : "off");

        // Set the button's icon
        $button.find('.state-icon')
          .removeClass()
          .addClass('state-icon ' + settings[$button.data('state')].icon);

        // Update the button's color
        if (isChecked) {
          $button
            .removeClass('btn-default')
            .addClass('btn-' + color + ' active');
        }
        else {
          $button
            .removeClass('btn-' + color + ' active')
            .addClass('btn-default');
        }
      }

      // Initialization
      function init() {

        updateDisplay();

        // Inject the icon if applicable
        if ($button.find('.state-icon').length == 0) {
          $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
        }
      }

      init();
    });
  });


</script>

<script>
  $(".incr-btn").on("click", function (e) {
    var $button = $(this);
    var oldValue = $button.parent().find('.quantity').val();
    $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
    if ($button.data('action') == "increase") {
      var newVal = parseFloat(oldValue) + 1;
    } else {
      // Don't allow decrementing below 1
      if (oldValue > 1) {
        var newVal = parseFloat(oldValue) - 1;
      } else {
        newVal = 1;
        $button.addClass('inactive');
      }
    }
    $button.parent().find('.quantity').val(newVal);
    e.preventDefault();
  });
</script>
<script>
  $('.addToCart').click(function ()
  {
    var productId = $(this).data("id");
    var quantity = $("#quantity_" + productId).val();
    var url = $(this).data("url") + '?productId=' + productId + '&quantity=' + quantity;

    $.ajax({
      url: url, success: function (result)
      {
        $("#cartItemCount").text(Object.keys(JSON.parse(result)).length)
      }
    });
  });

  $('#selectCargo').change(function ()
  {
    var cargoPrice = $(this).val();
    var url = $(this).data("url") + '?cargoPrice=' + cargoPrice;
    $.ajax({
      url: url, success: function (result)
      {
        var result = JSON.parse(result);
        $('#cargoPrice').text(parseFloat(result.cargoPrice).toFixed(2));
        $('#total').text(result.total);
        $('#totalHidden').val(result.total);
      }
    });
  })
</script>

<script>
    $('.checkout-button').click(function()
    {
      var selectCargo = $('#selectCargo').val();
      if(selectCargo != 'null')
      {
        $('#checkoutForm').submit();
      }
      else
      {
        alert('Please select a Pick Up or UPS');
      }
    });
</script>

<script>
    $('.ratable').click(function(){
      var productId = $(this).data('id');
      $('.starrr'+productId).attr('data-rate', $('.starrrcount'+productId).text());


      var rate = $('.starrrcount'+productId).text();

      var url = $(this).data("url") + '?productId='+productId+'&rate=' + rate;
      $.ajax({
        url: url, success: function (result)
        {
          var result = JSON.parse(result);
          if(result.error == 1){
            alert('only can rate once')
          }
        }
      });

    });
</script>
<script>
    $('.remove-cart-item').click(function(){
      var productId = $(this).data('id');
      var url = $(this).data('url') + '?productId='+productId;

      $.ajax({
        url: url, success: function (result)
        {
          window.location.reload();
        }
      });
    });

    $('.quantity').blur(function(){
      var productId = $(this).data('id');
      var quantity = $(this).val();
      var url = $(this).data('url') + '?productId='+productId +'&quantity='+quantity;

      $.ajax({
        url: url, success: function (result)
        {
          window.location.reload();
        }
      });
    });
</script>
</body>

</html>
