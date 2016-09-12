<div class="container-fluid" id="ani_wrapper">
<div class="container" id="animation">
	<img src="img/ani/1.jpg" id="ani">
</div>
</div>
<script src="js/animation.js"></script>
<footer class="container-fluid">
<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<div id="social">
				<div class="row">
				<h3>Pratite nas na društvenim mrežama</h3>
				<div class="col-sm-3"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></div>
				<div class="col-sm-3"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></div>
				<div class="col-sm-3"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></i></a></div>
				<div class="col-sm-3"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></div>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			
		</div>
		<div class="col-sm-3">
		<div id="footer_kontakt">
		<h4>Kontakt</h4>
		<a href="Home/Contact">
		<i class="fa fa-map-o" aria-hidden="true"></i><br>
		<i class="fa fa-phone" aria-hidden="true"></i><br>
		<i class="fa fa-envelope-o" aria-hidden="true"></i>
		</a>
		</div>	
		</div>
		<div class="col-sm-3">
		<div id="footer_nav_kategorije">
		<h4>Kategorije</h4>
		<ul>
<?php
	foreach ($kategorije as $kategorija) {
		echo "<li><a href='Home/Sadnice/$kategorija->naziv_kategorije'>" . $kategorija->naziv_kategorije . " &raquo;</a></li>";
	}
?>
		</ul>
		</div>
		</div>
	</div>
</div>
<div class="container-fluid text-center">
	<div class="row">
	<div id="copyright">
		Miloš Kuruzović 2016 &copy;
	</div>
	</div>
</div>
</footer>
</body>
</html>