$( "#read-more-1").click(function() {
  $( "#complete-1" ).slideToggle( "fast" );
      var $this = $(this);
        $this.toggleClass("open");

        if ($this.hasClass("open")) {
            $this.html("Less");
        } else {
            $this.html("Read more");
        }
});
$( "#read-more-2").click(function() {
  $( "#complete-2" ).slideToggle( "fast" );
      var $this = $(this);
        $this.toggleClass("open");

        if ($this.hasClass("open")) {
            $this.html("Less");
        } else {
            $this.html("Read more");
        }
});
$( "#read-more-3").click(function() {
  $( "#complete-3" ).slideToggle( "fast" );
      var $this = $(this);
        $this.toggleClass("open");

        if ($this.hasClass("open")) {
            $this.html("Less");
        } else {
            $this.html("Read more");
        }
});
$( "#read-more-4").click(function() {
  $( "#complete-4" ).slideToggle( "fast" );
      var $this = $(this);
        $this.toggleClass("open");

        if ($this.hasClass("open")) {
            $this.html("Less");
        } else {
            $this.html("Read more");
        }
});



// Faq Arrow Change Start //
jQuery(function($) {
  $(".panel-heading").on('click', function() {
    $(this).toggleClass('is-active').next(".panel-collapse").stop().slideToggle(500);
  });
});
// Faq Arrow Change end //


