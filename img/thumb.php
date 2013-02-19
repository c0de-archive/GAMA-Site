<?php
// Test of thumbnail generation - Temporarly dropped support for bitmap files until I learn how to generate those

require('helper.genthumb.php');
genthumb('2pojdry.jpg');
genthumb('3gyvry5.gif');
genthumb('meow.png');

echo '<img src="thumbs/2pojdry.jpg"><br>';
echo '<img src="thumbs/3gyvry5.gif"><br>';
echo '<img src="thumbs/meow.png"><br>';

?>