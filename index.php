<?php

error_reporting(-1);
ini_set('display_errors','On');

$factory = require_once(__DIR__ . '/../scales/Scales.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<script type="text/javascript" src="../scales/audio/audio.js"></script>

<script type="text/javascript">
	ChordsPlayer.instrument = 'rhodes'
	ChordsPlayer.strum = 50
	ChordsPlayer.root = '../scales/audio/samples'

	EventPhaser = {
		fire: function (key,octave) {
			var chord = document.querySelector('#octave-' + octave).value
			ChordsPlayer.play(ChordsDataBase[chord][key])
		}
	}

	ChordsDataBase = <?php echo json_encode(Undercloud\Scales\Chords::exportCartesian()); ?>
</script>

<style>

body {
	background: url(bg.jpg);
	background-size: cover;
	padding: 0;
	margin: 0;
	text-align: center;
}

.keyboard-wrap {
    opacity: 0.90;
    background: #0a303b;
    padding: 20px;
    margin: 30px auto;
    border-radius: 10px;
    width: 300px;
    box-shadow: 2px 2px 5px #111e22;
}

.keyboard {
    width: 300px;
    height: 100px;
    font-size: 0;
    position: relative;
    border-radius: 5px;
    overflow: hidden;
    margin: 0 auto;
}

.key {
	cursor: pointer;
	background: #385158;
    height: 100%;
    width: 14.28%;
    display: inline-block;
    vertical-align: top;
    border: 4px solid #0a303b;
    box-sizing: border-box;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}

.key-black {
	cursor: pointer;
    background: #213f45;
    height: 70%;
    display: inline-block;
    vertical-align: top;
    position: absolute;
    width: 14.28%;
    box-sizing: border-box;
    border: 4px solid #0a303b;
    margin-left: -7.14%;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}

.key:active {
	background: #607074;
}

.key-black:active {
	background: #4c656a;
}

.keyboard-tools {
    margin-bottom: 20px;
    background: #072128;
    border-radius: 5px;
}

.keyboard-selector {
	width: 100%;
	background: transparent;
	border: none;
	color: #fff;
	padding: 10px;
	appearance: none;
	font-size: 13px;
    font-family: cursive;
}

select:focus {
	color: #252525;
}

.keyboard-cell {
	display: inline-block;
	text-align: left;
	vertical-align: top;
	width: 50%;
}
</style>

<?php
	$chosed = array(
		'maj7',
		'm7',
		'7',
		'dim7',
		'm7b5'
	);
?>

<?php foreach(range(0,4) as $octave): ?>
<div class="keyboard-cell">
	<div class="keyboard-wrap">
		<div class="keyboard-tools">
			<select id="octave-<?echo $octave; ?>" class="keyboard-selector" onchange="this.blur()">
				<?php foreach(Undercloud\Scales\Chords::names() as $name): ?>
				<option value="<? echo $name; ?>" <? echo $chosed[$octave] == $name ? 'selected' : '' ?> >
					<? echo $name; ?>	
				</option>
				<? endforeach; ?>
			</select>
		</div>

		<div class="keyboard">
			<div onclick="EventPhaser.fire('C', <?echo $octave; ?>)" class="key"></div>
			<div onclick="EventPhaser.fire('C#',<?echo $octave; ?>)" class="key-black"></div>
			<div onclick="EventPhaser.fire('D', <?echo $octave; ?>)" class="key"></div>
			<div onclick="EventPhaser.fire('D#',<?echo $octave; ?>)" class="key-black"></div>
			<div onclick="EventPhaser.fire('E', <?echo $octave; ?>)" class="key"></div>
			<div onclick="EventPhaser.fire('F', <?echo $octave; ?>)" class="key"></div>
			<div onclick="EventPhaser.fire('F#',<?echo $octave; ?>)" class="key-black"></div>
			<div onclick="EventPhaser.fire('G', <?echo $octave; ?>)" class="key"></div>
			<div onclick="EventPhaser.fire('G#',<?echo $octave; ?>)" class="key-black"></div>
			<div onclick="EventPhaser.fire('A', <?echo $octave; ?>)" class="key"></div>
			<div onclick="EventPhaser.fire('A#',<?echo $octave; ?>)" class="key-black"></div>
			<div onclick="EventPhaser.fire('B', <?echo $octave; ?>)" class="key"></div>
		</div>
	</div>
</div><!--
--><? endforeach; ?>
</body>
</html>

