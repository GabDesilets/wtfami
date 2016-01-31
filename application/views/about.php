<?php echo form_open('login/authenticate_user'); ?>
<div class="container">
	<div class="row" >
		<div class="col s8">
			<div class="row">
				<h3 class="bold">D&eacute;couvre ta r&eacute;gion</h3>
				<h6>Conserve une trace des chemins et des endroits qui t'ont marqu&eacute;.</h6>
				<h6>Partage tes d&eacute;couvertes avec tout le monde.</h6>
			</div>
		</div>
		<div class="col s4" style="padding:30px 0 0 0">
			<img src="<?php echo base_url('application/img/ad.jpg');?>" width="75%" height="75%" />
		</div>
	</div>
</div>
<?php echo form_close(); ?>