
	<div id="f">
		<div class="container">
			<div class="row">
				<!-- ADDRESS -->
				<div class="col-lg-3">
					<h4>we are at</h4>
					<p>
						contact@sabrcosnult.com<br/>
					</p>
				</div><! --/col-lg-3 -->

				<div class="col-lg-3">
					<h4>Contact Us</h4>
					<p>
            <a href="mailto:contact.us@sabrconsult.com">contact.us@sabrconsult.com</a><br/>
					</p>
				</div><! --/col-lg-3 -->

				<div class="col-lg-3">
					<h4>Info</h4>
					<p>
						<i class="fa fa-angle-right"></i> <a href="https://github.com/sabr-p">Code for Invictus.io</a><br/>
					</p>
				</div><!-- /col-lg-3 -->


			</div><! --/row -->
		</div><!-- /container -->
	</div><!-- /f -->



    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/retina.js"></script>
    <script src="assets/js/invictus.js"></script>
	<script>
		$(window).scroll(function() {
			$('.si').each(function(){
			var imagePos = $(this).offset().top;

			var topOfWindow = $(window).scrollTop();
				if (imagePos < topOfWindow+400) {
					$(this).addClass("slideUp");
				}
			});
		});
	</script>
    <script>
	    $('#myTab a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		})
	</script>
