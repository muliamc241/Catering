<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>rating</title>
	<link rel="stylesheet" href=" <?php echo base_url('rating/css/star-rating.css' )?>">
	<link rel="stylesheet" href=" <?php echo base_url('rating/css/bootstrap.css' )?>">
</head>

<body>
	<div class="text-center">
    <p> <form method="post" action="<?= base_url('user/reated') ?>">
        <h4>Rate Data</h4>
        <input id="rating-input" type="text" name="bin" />
        <button type="submit">kirim</button>
        </form>
    </p>
    </div>
    
    <script type="text/javascript" src="<?php echo base_url('rating/js/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('rating/js/star-rating.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('rating/js/bootstrap.js') ?>"></script>
    <script type="text/javascript">
	$(document).ready(function(){
		var $inp = $('#rating-input');
		
		//$inp.attr('value','4');
			
		$inp.rating({
                min: 0,
                max: 5,
                step: 1,
                size: 'sm',
                showClear: false
            });
		$inp.on('rating.change', function () {
			// alert('Nilai rating : '+$('#rating-input').val());
		});
	});
</script>
</body>
</html>
