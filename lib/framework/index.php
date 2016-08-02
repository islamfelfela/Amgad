<?php
$widgets = [
  'widgets/Cat_Widget.php',
];

foreach ($widgets as $file) {
  require_once $file;
}
